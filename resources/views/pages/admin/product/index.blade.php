@extends('layouts.admin')

@section('title')
    Product - RnD Furniture
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Prodcut</h3>
                    <p class="text-subtitle text-muted">Detail List Product</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="d-flex justify-content-between">
                    <div class="card-header">
                        Product
                    </div>
                    <a href="{{ route('product.create') }}" class="mx-4 my-4">
                        <button type="button" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus"></i>
                            Add Product
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url($item->image_product) }}" alt="image" width="100"
                                            height="100">
                                    </td>
                                    <td>{{ $item->name_product }}</td>
                                    <td>{{ $item->price_product }}</td>
                                    <td>{{ $item->stock_product }}</td>
                                    <td>
                                        <span class="badge bg-warning">Active</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('themes/admin/assets/css/pages/simple-datatables.css') }}">
@endpush

@push('addon-script')
    <script src="{{ asset('themes/admin/assets/js/extensions/simple-datatables.js') }}"></script>
@endpush
