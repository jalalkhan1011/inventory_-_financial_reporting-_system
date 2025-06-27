@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Financial Report</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-3 mb-4"></div>
            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Journal Search</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="start_date">From</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                        value="{{ $start }}" required placeholder="Start Date">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="end_date">To</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                        value="{{ $end }}" required placeholder="End Date">
                                </div>
                                <div class="form-group col-md-2" style="margin-top: 32px">
                                    <button class="btn btn-sm btn-success"> <i class="fas fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Color System -->

            </div>

            <div class="col-lg-3 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Summary</h6>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Total Sales: {{ number_format($financialReport['sale'], 2) }}</li>
                            <li>Total Discounts: {{ number_format($financialReport['discount'], 2) }}</li>
                            <li>Total VAT: {{ number_format($financialReport['vat'], 2) }}</li>
                            <li>Total Paid: {{ number_format($financialReport['paid'], 2) }}</li>
                            <li>Total due: {{ number_format($financialReport['due'], 2) }}</li>
                            <li>Total Profit: {{ number_format($financialReport['profit'], 2) }}</li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Journal Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Sale ID</th>
                                        <th>Type</th>
                                        <th>Amount (TK)</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i =0; @endphp
                                    @foreach ($journalInfo as $jinfo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                             <td>{{ $jinfo->sale_id ?: '' }}</td>
                                            <td>{{ $jinfo->j_type ?: '' }}</td>
                                            <td>{{ number_format($jinfo->j_total, 2 ?: 0) }}</td> 
                                            <td>{{ $jinfo->created_at->format('Y-m-d') }}</td> 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Color System -->

            </div>
        </div>

    </div>
@endsection
