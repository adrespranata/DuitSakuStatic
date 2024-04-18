@extends('master')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('includes.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('updatePicture') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                {{ __('Update Details') }}
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img class="img-profile rounded-circle img-fluid"
                                        src="{{ $userDetails->picture ? asset('img/uploaded/users/' . $userDetails->picture) : asset('img/undraw_profile.svg') }}">
                                </div>
                                <div class="form-group mt-4">
                                    <input type="file" name="picture" accept="image/*">
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-primary ml-2">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <form method="POST" action="{{ route('updateDetails') }}">
                        @csrf
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                {{ __('Updates Details') }}
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="input" name="first_name" id="first_name"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                value="{{ $userDetails->first_name }}">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="middle_name">Middle Name</label>
                                            <input type="input" name="middle_name" id="middle_name"
                                                class="form-control @error('middle_name') is-invalid @enderror"
                                                value="{{ $userDetails->middle_name }}">
                                            @error('middle_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="input" name="last_name" id="last_name"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                value="{{ $userDetails->last_name }}">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ $userDetails->address }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="input" name="city" id="city"
                                                class="form-control @error('city') is-invalid @enderror"
                                                value="{{ $userDetails->city }}">
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="input" name="country" id="country"
                                                class="form-control @error('country') is-invalid @enderror"
                                                value="{{ $userDetails->country }}">
                                            @error('country')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="postal_code">Postal Code</label>
                                            <input type="input" name="postal_code" id="postal_code"
                                                class="form-control @error('postal_code') is-invalid @enderror"
                                                value="{{ $userDetails->postal_code }}">
                                            @error('postal_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-primary ml-2">
                                    Updates
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">

                    <form method="POST" action="{{ route('updatePassword') }}">
                        @csrf
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                {{ __('Updates Password') }}
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" name="old_password" id="old_password"
                                        class="form-control @error('old_password') is-invalid @enderror">
                                    @error('old_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" id="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-primary ml-2">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
@endsection
