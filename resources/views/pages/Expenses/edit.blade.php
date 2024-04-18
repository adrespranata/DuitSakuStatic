@extends('master')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('includes.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <form method="POST" action="{{ route('Expenses.update', $expenses->id) }}">
                @csrf
                @method('PUT')
                <div class="card shadow mb-4">
                    <div class="card-header">
                        {{ __('Edit Expenses') }}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($expenseCategory as $EC)
                                            <option value="{{ $EC->id }}"
                                                {{ $EC->id == $expenses->category_id ? 'selected' : '' }}>
                                                {{ $EC->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="payment_type_id">Payment Type</label>
                                    <select name="payment_type_id" id="payment_type_id" class="form-control">
                                        @foreach ($paymentType as $payType)
                                            <option value="{{ $payType->id }}"
                                                {{ $payType->id == $expenses->payment_type_id ? 'selected' : '' }}>
                                                {{ $payType->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('payment_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date"
                                        class="form-control @error('date') is-invalid @enderror"
                                        value="{{ $expenses->date }}">
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" name="amount" id="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        value="{{ number_format($expenses->amount, 0, ',', '.') }}">
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                rows="3">{{ $expenses->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ route('Expenses') }}" class="btn btn-sm btn-secondary">
                            Close
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary ml-2">
                            Save Data
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->

    </div>
@endsection
