@extends('master')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('includes.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <form method="POST" action="{{ route('IncomeCategory.update', $incomeCategory->id) }}">
                @csrf
                @method('PUT')
                <div class="card shadow mb-4">
                    <div class="card-header">
                        {{ __('Edit Activities') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ $incomeCategory->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                rows="3">{{ $incomeCategory->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ route('IncomeCategory') }}" class="btn btn-sm btn-secondary">
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
    <!-- End of Main Content -->
@endsection
