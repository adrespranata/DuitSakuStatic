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
                    <h6 class="m-0 font-weight-bold text-primary">Incomes List</h6>
                    <div>
                        <a href="{{ route('Incomes.create') }}" class="btn btn-sm btn-primary">
                            {{ __('Create New') }}
                        </a>
                    </div>
                </div>
                <div id="deleteIncomes" data-url="{{ route('Incomes.destroy', ':id') }}"></div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('No') }}</th>
                                    <th>{{ __('Category Name') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incomes as $income)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $income->category->name }}</td>
                                        <td>{{ $income->date }}</td>
                                        <td>{{ 'Rp. ' . number_format($income->amount, 0, ',', '.') }}</td>
                                        <td>{{ $income->description }}</td>
                                        <td>

                                            <a href="{{ route('Incomes.edit', $income->id) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>

                                            <button class="btn btn-sm btn-secondary deleteIncomes" id="deleteIncomes"
                                                data-id="{{ $income->id }}">
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
        <script src="{{ asset('js/backend/Incomes/Incomes.js') }}"></script>
    @endpush
    {{-- End Push Script --}}
@endsection
