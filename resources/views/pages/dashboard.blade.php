@extends('master')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('includes.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Incomes (Total)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                        {{ number_format($incomes, 0, ',', '.') }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-wallet fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($totalAmountByCategory as $index => $total)
                    @php
                        $borderColors = [
                            'border-left-success',
                            'border-left-info',
                            'border-left-warning',
                            'border-left-secondary',
                        ];
                        $dynamicBorder = $borderColors[$index % count($borderColors)];
                    @endphp
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card {{ $dynamicBorder }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ $total->category->name }} (Total)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                            {{ number_format($total->total_amount, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-wallet fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Expenses (Total)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                        {{ number_format($expenses, 0, ',', '.') }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-wallet fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($totalAmountByCategoryExpenses as $index => $total)
                    @php
                        $borderColors = [
                            'border-left-success',
                            'border-left-info',
                            'border-left-warning',
                            'border-left-secondary',
                        ];
                        $dynamicBorder = $borderColors[$index % count($borderColors)];
                    @endphp
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card {{ $dynamicBorder }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ $total->category->name }} (Total)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                            {{ number_format($total->total_amount, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-wallet fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- Content Row -->

            <!-- Content Row - Incomes -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-8">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Incomes Statistics</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="incomeAreaCharts"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-4"> <!-- Use col-lg-4 instead of col-lg-5 -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Incomes Sources</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="incomePieCharts"></canvas>
                            </div>
                            <div id="additionalLabels" class="mt-4 text-center small">
                                <!-- Labels will be added dynamically here -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Content Row - Incomes -->

            <!-- Content Row - Expanses -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-8">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Expanses Statistics</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="expenseAreaCharts"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-4"> <!-- Use col-lg-4 instead of col-lg-5 -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Expanses Sources</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="expansesPieCharts"></canvas>
                            </div>
                            <div id="additionalLabelsExpanses" class="mt-4 text-center small">
                                <!-- Labels will be added dynamically here -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Content Row - Expanses -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    @push('post_scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
        <!-- Page level custom scripts -->
        <script src="{{ asset('js/chart/Incomes/chart-area-incomes.js') }}"></script>
        <script src="{{ asset('js/chart/Incomes/chart-pie-incomes.js') }}"></script>
        <script src="{{ asset('js/chart/Expanses/chart-area-expanses.js') }}"></script>
        <script src="{{ asset('js/chart/Expanses/chart-pie-expanses.js') }}"></script>
    @endpush
@endsection
