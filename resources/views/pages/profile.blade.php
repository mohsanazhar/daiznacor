@extends('layouts.master')
@section('title')
@lang('translation.settings')
@endsection
@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="card overflow-hidden profile-setting-img">
            <div class="profile-user rounded profile-basic" style="background-image: url('build/images/profile-bg.jpg');background-size: cover;background-position: center;">
                <div class="bg-overlay bg-primary"></div>
                <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                    <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input d-none">
                    <label for="profile-foreground-img-file-input" class="btn btn-light">
                        <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                    </label>
                </div>
            </div>

            <div class="card-body">
                <div class="position-relative mb-3">
                    <div class="mt-n5">
                        <img src="/build/images/users/avatar-2.jpg" alt="" class="avatar-lg rounded-circle p-1 mt-n4">
                    </div>
                </div>
                <!-- Nav tabs -->
                <div class="row align-items-center mt-3 gy-3">
                    <div class="col-md order-1">
                        <ul class="nav nav-pills animation-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="true">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Datos Personales</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#changePassword" role="tab" aria-selected="false" tabindex="-1">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Cambiar contraseña</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#2fa" role="tab" aria-selected="false" tabindex="-1">
                                    <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">2FA</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#notification" role="tab" aria-selected="false" tabindex="-1">
                                    <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Notificaciones</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#reminder" role="tab" aria-selected="false" tabindex="-1">
                                    <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">@lang('translation.reminders')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="col-md-auto order-md-2">
                        <div class="flex-shrink-0">
                            <a href="pages-profile-settings" class="btn btn-secondary"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!--end col-->
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="firstnameInput" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="Info">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="lastnameInput" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="lastnameInput" placeholder="Enter your lastname" value="Pantramites">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="phonenumberInput" placeholder="Enter your phone number" value="+507 61523333">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" value="diaz@kortecpro.com">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="JoiningdatInput" class="form-label">Fecha de registro</label>
                                        <input type="text" class="form-control" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                        <button type="button" class="btn btn-soft-success">Cancelar</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        <form action="pages-profile-settings">
                            <div class="row g-2 justify-content-lg-between align-items-center">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="oldpasswordInput" class="form-label">Contraseña actual*</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                            <button class="btn btn-link position-absolute top-0 end-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="auth-pass-inputgroup">
                                        <label for="password-input" class="form-label">Nueva contraseña*</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control password-input" id="password-input" onpaste="return false" placeholder="Enter new password" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="auth-pass-inputgroup">
                                        <label for="confirm-password-input" class="form-label">Confirmar contraseña*</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control password-input" onpaste="return false" id="confirm-password-input" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>

                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="card bg-light passwd-bg" id="password-contain">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <h5 class="fs-13">Contraseña debe incluir:</h5>
                                            </div>
                                            <div class="">
                                                <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                                <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                                <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                                <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end row-->
                        </form>
                        <x-profile.component.browser />
                    </div>
                    <!-- 2FA Section -->
                    <div class="tab-pane" id="2fa" role="tabpanel">
                        <x-profile.page.two-factor />
                    </div>
                    <!-- Notification Section -->
                    <div class="tab-pane" id="notification" role="tabpanel">
                        <x-profile.page.notification />
                    </div>
                    <div class="tab-pane" id="reminder" role="tabpanel">
                        <x-profile.page.reminders />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/passowrd-create.init.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
