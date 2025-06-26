@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product Sale</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-9 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Sale List</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#Sl</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Discount</th>
                                        <th>VAT</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i =0; @endphp
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $sale->product->p_name ?: '' }}</td>
                                            <td>{{ $sale->qty ?: '' }}</td>
                                            <td>{{ number_format($sale->discount, 2 ?: 0) }}</td>
                                            <td>{{ number_format($sale->vat, 2 ?: 0) }}</td>
                                            <td>{{ number_format($sale->t_amount, 2 ?: 0) }}</td>
                                            <td>{{ number_format($sale->paid, 2 ?: 0) }}</td>
                                            <td>{{ number_format($sale->due, 2 ?: 0) }}</td>
                                            <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Color System -->

            </div>

            <div class="col-lg-3 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product sale</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.sales.sale.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="product_id">Product<span class="text-danger"> *</span></label>
                                <select class="form-control" name="product_id" id="product_id" required>
                                    <option value="" selected disabled>Select product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->p_name }}(Stock:{{ $product->p_stock ?: '' }})</option>
                                    @endforeach
                                </select>
                                <div class="clearfix"></div>
                                @if ($errors->has('product_id'))
                                    <span class="form-text">
                                        <strong
                                            class="text-danger form-control-sm">{{ $errors->first('product_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity<span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="qty" value="{{ old('qty') }}"
                                    id="qty" placeholder="0" required>
                                <div class="clearfix"></div>
                                @if ($errors->has('qty'))
                                    <span class="form-text">
                                        <strong class="text-danger form-control-sm">{{ $errors->first('qty') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount<span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="discount" value="{{ old('discount', 0) }}"
                                    id="discount" step="0.01">
                                <div class="clearfix"></div>
                                @if ($errors->has('discount'))
                                    <span class="form-text">
                                        <strong
                                            class="text-danger form-control-sm">{{ $errors->first('discount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="paid">Paid Amount<span class="text-danger"> *</span></label>
                                <input type="number" class="form-control" name="paid" value="{{ old('paid', 0) }}"
                                    id="paid">
                                <div class="clearfix"></div>
                                @if ($errors->has('paid'))
                                    <span class="form-text">
                                        <strong class="text-danger form-control-sm">{{ $errors->first('paid') }}</strong>
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
