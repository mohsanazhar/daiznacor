@extends('layouts.master-without-nav')

@section('title')
@lang('translation.500-error')
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
                                <div class="card auth-card h-100 border-0 shadow-none p-sm-3 overflow-hidden mb-0" style="background-color: #e3e3e3!important;">
                                    <div class="card-body p-4 d-flex justify-content-between flex-column" >
                                        <div class="auth-image mb-3" style="display: flex;justify-content: center;flex: 1 1 auto;align-items: center;flex: 1 1 auto;">
                                            <img src="/build/images/logo-light-full.png" alt="" height="70" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-7">
                                <div class="card mb-0 border-0 shadow-none">
                                    <div class="card-body p-4 p-sm-5 m-lg-4">
                                        <div class="error-img text-center px-5">
                                            <img src="/build/images/error500.png" class="img-fluid" alt="">
                                        </div>
                                        <div class="mt-4 text-center pt-3">
                                            <div class="position-relative">
                                                <h4 class="fs-18 error-subtitle text-uppercase mb-0">Error Interno del Servidor</h4>
                                                <div class="mt-4">
                                                    <a href="/" class="btn btn-primary"><i class="mdi mdi-home me-1"></i>Volver al inicio</a>
                                                </div>
                                            </div>
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
