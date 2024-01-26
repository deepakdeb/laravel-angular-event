@extends('layouts.app')
@section('content')
    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-light-600S">
        <div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-1 mb-3">Sign In</h1>
                    <nav class="d-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sign In</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- /section -->
    
    <section class="wrapper bg-light">
        <div class="container pb-14 pb-md-16">
            <div class="row">
                <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                    <div class="card">
                        <div class="card-body p-11">
                            @if ($msg = Session::get('success'))
                                <div class="alert alert-success">
                                    {{ $msg }}
                                </div>
                            @endif
                            <h2 class="mb-3 text-start">Welcome Back</h2>
                            <p class="lead mb-6 text-start">Fill your email and password to sign in.</p>
                            <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate id="loginForm">
                                @csrf
                                <div class="mb-4">
                                    <label class="text-start" for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="your@email.com" autocomplete="off"
                                        value="{{ old('email') }}" />
                                </div>
                                @error('email')
                                    <div class="text-red">{{ $message }}</div>
                                @enderror

                                <div class="password-field mb-4 position-relative">
                                    <label for="password">Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Your password" autocomplete="off" />
                                        <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                    </div>

                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="text-start mb-4">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember_me" />
                                        <span class="form-check-label">Remember me on this device</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Sign
                                    In</button>
                            </form>
                            <!-- /form -->
                            <div class="text-center">
                                @if (Route::has('register'))
                                    <p class="mb-0">Don't have an account? <a href="{{ route('register') }}"
                                            class="hover">Sign up</a></p>
                                @endif
                            </div>

                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->


    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#loginForm").validate({
                errorClass: 'text-danger',
                rules: {
                    password: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter a email",
                        email: "Please enter a valid email",
                    },
                    password: {
                        required: "Please enter a password",
                    }
                }
            });

            $("#loginForm").on('submit', function(e) {
                if (!$("#loginForm").valid()) {
                    return false;
                }
            });
        });
    </script>
@endsection
