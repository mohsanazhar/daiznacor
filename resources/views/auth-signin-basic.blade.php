@extends('layouts.master-without-nav')
@section('title')
@lang('translation.signin')
@endsection
@section('content')

<section class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-0">
                                    <div class="col-lg-5">
                                        <div class="card auth-card bg-primary h-100 border-0 shadow-none p-sm-3 overflow-hidden mb-0">
                                            <div class="card-body p-4 d-flex justify-content-between flex-column">
                                                <div class="auth-image mb-3">
                                                    <img src="/build/images/logo-light-full.png" alt="" height="38" />
                                                    <img src="/build/images/effect-pattern/auth-effect-2.png" alt="" class="auth-effect-2" />
                                                    <img src="/build/images/effect-pattern/auth-effect.png" alt="" class="auth-effect" />
                                                    <img src="/build/images/effect-pattern/auth-effect.png" alt="" class="auth-effect-3" />
                                                </div>
        
                                                <div>
                                                    <h3 class="text-white">Start your journey with us.</h3>
                                                    <p class="text-white-75 fs-15">It brings together your tasks, projects, timelines, files and more</p>
                                                </div>
                                                <div class="text-center text-white-75">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-7">
                                        <div class="card mb-0 border-0 shadow-none">
                                            <div class="card-body px-0 p-sm-5 m-lg-4">
                                                <div class="text-center mt-2">
                                                    <h5 class="text-primary fs-20">Welcome Back !</h5>
                                                    <p class="text-muted">Sign in.</p>
                                                </div>
                                                <div class="p-2 mt-5">
                                                    <form action="index">
                                                
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Username</label>
                                                            <input type="text" class="form-control" id="username" placeholder="Enter username">
                                                        </div>
                                                
                                                        <div class="mb-3">
                                                            <div class="float-end">
                                                                <a href="auth-pass-reset-basic" class="text-muted">Forgot password?</a>
                                                            </div>
                                                            <label class="form-label" for="password-input">Password</label>
                                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input">
                                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                            </div>
                                                        </div>
                                                
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                        </div>
                                                
                                                        <div class="mt-4">
                                                            <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </section>
@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>

@endsection
