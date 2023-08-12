<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TransactionController extends Controller
{
  public function midtransHandler(Request $request)
  {
    $data = $request->all();
    $signatureKey = $data['signature_key'];

    $orderId = $data['order_id'];
    $statusCode = $data['status_code'];
    $grossAmount = $data['gross_amount'];
    $serverKey = env('MIDTRANS_SERVER_KEY');

    $mySignatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

    $transactionStatus = $data['transaction_status'];
    $type = $data['payment_type'];
    $fraudStatus = $data['fraud_status'];
    $transactionTime = $data['transaction_time'];

    if ($signatureKey !== $mySignatureKey) {
      return response()->json([
        'status' => 'error',
        'message' => 'Invalid Signature Key'
      ]);
    }
    $realOrderId = explode('-', $orderId);
    $transation = Transaction::find($realOrderId[0]);
    if (!$transation) {
      return response()->json([
        'status' => 'error',
        'message' => 'Transaction not found'
      ]);
    }

    if ($transation->transaction_status === 'success') {
      return response()->json([
        'status' => 'error',
        'message' => 'Transaction already success'
      ]);
    }

    if ($transactionStatus == 'capture') {
      if ($fraudStatus == 'challenge') {
        $transation->transaction_status = 'challenge';
      } else if ($fraudStatus == 'accept') {
        $transation->transaction_status = 'success';
      }
    } else if ($transactionStatus == 'settlement') {
      $transation->transaction_status = 'success';
    } else if (
      $transactionStatus == 'cancel' ||
      $transactionStatus == 'deny' ||
      $transactionStatus == 'expire'
    ) {
      $transation->transaction_status = 'failure';
    } else if ($transactionStatus == 'pending') {
      $transation->transaction_status = 'pending';
    }

    $detailTransasction = [
      'payment_status' => $transactionStatus,
      'payment_type' => $type,
      'transaction_id' => $realOrderId[0],
      'payment_amount' => $grossAmount,
      'payment_date' => $transactionTime,
    ];
    TransactionDetail::create($detailTransasction);
    $transation->save();

    // if ($transation->transaction_status == 'success') {
    //   // memberikan akses premium ke user
    //   createPremiumAccess([
    //     'user_id' => $transation->user_id,
    //     'course_id' => $transation->course_id,
    //   ]);
    // }

    return response()->json([
      'status' => 'success',
      'message' => 'Transaction success'
    ]);
  }

  public function finish()
  {
    return view('pages.user.page.transaction_status');
  }
}
