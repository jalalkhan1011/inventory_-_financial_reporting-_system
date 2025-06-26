@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-4 mb-4"></div>

            <div class="col-lg-4 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit product</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.product.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="p_name">Product Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="p_name" name="p_name"
                                    value="{{ old('p_name', $product->p_name) }}" required placeholder="Product Name">
                                <div class="clearfix"></div>
                                @if ($errors->has('p_name'))
                                    <span class="form-text">
                                        <strong class="text-danger form-control-sm">{{ $errors->first('p_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="p_p_price">Purchase Price<span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="p_p_price"
                                    value="{{ old('p_p_price', $product->p_p_price) }}" id="p_p_price" step="0.01"
                                    placeholder="0.00" required>
                                <div class="clearfix"></div>
                                @if ($errors->has('p_p_price'))
                                    <span class="form-text">
                                        <strong
                                            class="text-danger form-control-sm">{{ $errors->first('p_p_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="p_s_price">Sale Price<span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="p_s_price"
                                    value="{{ old('p_s_price', $product->p_s_price) }}" id="p_s_price" step="0.01"
                                    placeholder="0.00" required>
                                <div class="clearfix"></div>
                                @if ($errors->has('p_s_price'))
                                    <span class="form-text">
                                        <strong
                                            class="text-danger form-control-sm">{{ $errors->first('p_s_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="p_stock">Product Stock<span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="p_stock"
                                    value="{{ old('p_stock', $product->p_stock) }}" id="p_stock">
                                <div class="clearfix"></div>
                                @if ($errors->has('p_stock'))
                                    <span class="form-text">
                                        <strong class="text-danger form-control-sm">{{ $errors->first('p_stock') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('products.product.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
