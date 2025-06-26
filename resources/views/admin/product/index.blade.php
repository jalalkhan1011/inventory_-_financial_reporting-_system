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
            <div class="col-lg-8 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#Sl</th>
                                        <th>Name</th>
                                        <th>Purchase Price</th>
                                        <th>Sale Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i =0; @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $product->p_name ?: '' }}</td>
                                            <td>{{ number_format($product->p_p_price, 2 ?: 0.0) }}</td>
                                            <td>{{ number_format($product->p_s_price, 2 ?: 0.0) }}</td>
                                            <td>{{ $product->p_stock ?: 0 }}</td>
                                            <td>
                                                <ul class="list-inline m-0">
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('products.product.edit', $product->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit"><i
                                                                class="fas fa-edit"></i> Edit</a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <form action="{{ route('products.product.destroy', $product->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this product?');"><i
                                                                    class="fas fa-trash"></i> Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Color System -->

            </div>

            <div class="col-lg-4 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Create product</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.product.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="p_name">Product Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="p_name" name="p_name"
                                    value="{{ old('p_name') }}" required placeholder="Product Name">
                                <div class="clearfix"></div>
                                @if ($errors->has('p_name'))
                                    <span class="form-text">
                                        <strong class="text-danger form-control-sm">{{ $errors->first('p_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="p_p_price">Purchase Price<span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="p_p_price" value="{{ old('p_p_price') }}"
                                    id="p_p_price" step="0.01" placeholder="0.00" required>
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
                                <input type="number" class="form-control" name="p_s_price" value="{{ old('p_s_price') }}"
                                    id="p_s_price" step="0.01" placeholder="0.00" required>
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
                                <input type="number" class="form-control" name="p_stock" value="{{ old('p_stock', 0) }}"
                                    id="p_stock">
                                <div class="clearfix"></div>
                                @if ($errors->has('p_stock'))
                                    <span class="form-text">
                                        <strong
                                            class="text-danger form-control-sm">{{ $errors->first('p_stock') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
