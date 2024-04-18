@extends('master')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('includes.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Payment Type List</h6>
                    <div>
                        <a href="{{ route('PaymentType.create') }}" class="btn btn-sm btn-primary">
                            {{ __('Create New') }}
                        </a>
                    </div>
                </div>
                <div id="deletePayType" data-url="{{ route('PaymentType.destroy', ':id') }}"></div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('No') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Expense Category') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentTypes as $payType)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payType->name }}</td>
                                        <td>{{ $payType->expenseCategory->name }}</td>
                                        <td>{{ $payType->description ? $payType->description : '-' }}</td>
                                        <td>

                                            <a href="{{ route('PaymentType.edit', $payType->id) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>

                                            <button class="btn btn-sm btn-secondary deletePayType" id="deletePayType"
                                                data-id="{{ $payType->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    {{-- Push Script --}}
    @push('post_scripts')
        <script src="{{ asset('js/backend/PaymentType/PaymentType.js') }}"></script>
    @endpush
    {{-- End Push Script --}}
@endsection
