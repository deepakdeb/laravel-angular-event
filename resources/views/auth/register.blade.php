@extends('layouts.app')
@section('content')
    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-light-600"
        data-image-src="{{ url('/assets/img/photos/bg18.png') }}">
        <div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-1 mb-3">Sign Up</h1>
                    <nav class="d-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                        </ol>
                    </nav>
                    <!-- /nav -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->

    <section class="wrapper bg-light">
        <div class="container pb-14 pb-md-16">
            <div class="row">
                <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                    <div class="card">
                        <div class="card-body p-11 text-center">
                            <h2 class="mb-3 text-start">Sign up</h2>
                            <p class="lead mb-6 text-start">Registration takes less than a minute.</p>
                            <form class="text-start mb-3" action="{{ route('register') }}" method="post" autocomplete="off"
                                id="registerForm">
                                @csrf

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="mb-4">
                                    <label for="loginName">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name"
                                        value="{{ old('name') }}" id="loginName" />

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="loginEmail">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Enter email"
                                        value="{{ old('email') }}" id="loginEmail" />

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="password-field mb-4">
                                    <label for="loginPassword">Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" autocomplete="off" id="loginPassword" />
                                        <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                    </div>


                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="password-field mb-4">
                                    <label for="loginPasswordConfirm">Confirm Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="Password" autocomplete="off" id="loginPasswordConfirm" />
                                        <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                              
                                <button type="submit" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Sign
                                    Up</button>
                            </form>
                            <!-- /form -->
                            <p class="mb-0">Already have an account? <a href="{{ route('login') }}"
                                    class="hover">Sign
                                    in</a></p>
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

            // validation rules
            $("#registerForm").validate({
                errorClass: 'text-danger',
                rules: {
                    name: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    'password_confirmation': {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email",
                        email: "Please enter a valid email",
                    },
                    password: {
                        required: "Please enter a password",
                    },
                    'password_confirmation': {
                        required: "Please enter a confirm-password",
                    },
                    name: {
                        required: "Please enter a name",
                    },
                },
                errorElement: 'div',
            });

            //on registerForm submit
            $("#registerForm").on('submit', function(e) {
                //check validation
                if (!$("#registerForm").valid()) {
                    return false;
                }
            });
        });
    </script>
    <style>
        .iti {
            display: block;
        }
    </style>
@endsection
