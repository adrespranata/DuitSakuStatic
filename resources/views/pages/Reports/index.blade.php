@extends('master')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('includes.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <form method="POST" action="{{ route('Reports.store') }}">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-header">
                        {{ __('Create Incomes') }}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="year">Pilih Tahun</label>
                                    <select name="year" id="year" class="form-control">
                                        @for ($i = date('Y'); $i >= 2000; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="month">Pilih Bulan</label>
                                    <select name="month" id="month" class="form-control">
                                        @for ($m = 1; $m <= 12; $m++)
                                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary ml-2">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card shadow mb-4">
                        <div class="card-header">
                            {{ __('Total Incomes and Expenses') }}
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Incomes') }}</th>
                                            <th>{{ __('Expenses') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rp. {{ number_format($incomeReport, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($expensesReport, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
