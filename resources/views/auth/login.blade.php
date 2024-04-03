<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ $title }}</title>
    {{-- Section styles --}}
    @include('includes.head')
    {{-- Section styles --}}
</head>

<body class="bg-customs">

    <div class="container d-flex flex-column justify-content-center align-items-center">
        <!-- Image Section -->
        <div class="col-lg-6 d-none d-lg-block">
            <!-- Place your image here -->
        </div>

        <!-- Form Section -->
        <div class="col-lg-6">
            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5 mt-5">

                    <div class="card-header text-center">{{ __('Silahkan Masuk') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <form class="user" method="POST" action="{{ route('auth') }}">
                                        @csrf

                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                aria-describedby="emailHelp" placeholder="Enter Email Address..."
                                                name="email" aria-label="Email"
                                                value="{{ old('email', env('EMAIL_DEFAULT')) }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                placeholder="Password" value="{{ env('PASSWORD_DEFAULT') }}">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Section Script --}}
    @include('includes.script')
    {{-- Section Script End --}}

</body>

</html>
