@extends('layouts.auth')
@push('title')
    Login
@endpush
@section('content')
<div class="row m-0">
    <div class="col-12 p-0">
        <div class="login-card">
            <div style="width:100%">
                <div><a class="logo" href="index.html"><img class="img-fluid for-light"
                            src="../assets/images/logo/logo2.png" alt="looginpage"></a></div>
                <div class="login-main" id="loginform">
                    @if (Session::has('invalid_login'))
                        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                            role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            <strong>{{ __('Invalid Email or Password') }}</strong>
                        </div>
                    @endif
                    <form class="theme-form" method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <h4 class="text-center">{{ __('Log In') }}</h4>
                        {{-- <p class="text-center">Enter your email & password to login</p> --}}
                        <div class="form-group">
                            <label class="col-form-label"><strong>{{ __('Email / Phone / Username') }}</strong></label>
                            <input class="form-control" id="user_email" name="user_credential" type="text" placeholder="Enhter Your Email or Phone or Username"  value="{{ old('user_credential') }}"/>
                            @error('user_credential')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><strong>{{ __('User Password') }}</strong></label>
                            <div class="form-input position-relative">
                                <input class="form-control" id="user_password" name="user_password" type="password" >
                                <div class="show-hide"><span class="show"> </span></div>
                            </div>
                            @error('user_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                <input id="checkbox1" type="checkbox">
                                <label class="text-muted" for="checkbox1">Remember password</label>
                            </div>
                            <div class="d-flex">
                                <div class="ms-auto">
                                    <a href="javascript:void(0)" id="to-recover" class="link font-weight-medium"><i
                                        class="fa fa-lock me-1"></i> {{ __('Forgot Password') }} ?</a>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <button class=" btn btn-info d-block w-100 waves-effect waves-light" type="submit">
                                    {{ __('Log In') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-main" id="recoverform" style="display: none;">
                    <form class="col-12" action="index.html">
                        <!-- email -->
                        <h4 class="text-center">{{ __('Forget Password') }}</h4>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="forget_email">{{ __('User Email') }}</label>
                                <input class="form-control" id="forget_email" type="email" required="" />
                            </div>
                        </div>

                        <!-- pwd -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="btn d-block w-100 btn-primary text-uppercase" type="submit" name="action">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                            <div class="form-group mt-2">
                                <div class="d-flex">
                                    <div class="ms-auto">
                                        <a href="javascript:void(0)" id="to-sign-in" class="link font-weight-medium">
                                            {{ __('Already Have An Account') }} ?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $("#to-recover").on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $("#to-sign-in").on("click", function() {
            $("#recoverform").slideUp();
            $("#loginform").fadeIn();
        });
    </script>
@endpush
