@extends('layouts.admin')

@section('title')
    Create Product - RnD Furniture
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Create Product</h3>
                    <p class="text-subtitle text-muted">Create Product</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Product</li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="d-flex justify-content-between">
                    <div class="card-header">
                        Create Product
                    </div>
                    <a href="{{ route('product.index') }}" class="mx-4 my-4">
                        <button type="button" class="btn btn-sm btn-outline-warning">
                            <i class="fa fa-plus"></i>
                            Back
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label>Name: </label>
                        <div class="form-group">
                            <input type="text" placeholder="name"
                                class="form-control @error('name_product') is-invalid @enderror" name="name_product">
                            @error('name_product')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <label>Price: </label>
                        <div class="form-group">
                            <input type="number" placeholder="Price"
                                class="form-control @error('price_product') is-invalid @enderror" name="price_product">
                            @error('price_product')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <label>Stok: </label>
                        <div class="form-group">
                            <input type="number" placeholder="Stok"
                                class="form-control @error('stock_product') is-invalid @enderror" name="stock_product">
                            @error('stock_product')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <label>Image: </label>
                        <div class="form-group">
                            <input type="file" class="form-control-file @error('image_product') is-invalid @enderror"
                                name="image_product">
                            @error('image_product')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Submit</span>
                        </button> --}}
                        <button type="submit" class="btn btn-primary btn-sm "><i class="fa fa-save"></i>
                            Simpan</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
