<!-- ========== App Menu ========== -->
@php
$seg = request()->segment(1);
$seg2 = request()->segment(2);
@endphp
<style>
    .navbar-menu .navbar-nav .nav-sm .nav-link.active {
        color: white !important;
        background: #171e1c29;
        border-radius: 4%;
    }
</style>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <div class="pt-3">
            <a href="index" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="/build/images/logo-dark.png" alt="" height="50">
                </span>
                <span class="logo-lg">
                    <img src="/build/images/logo-dark.png" alt="" height="50">
                </span>
            </a>
            <a href="index" class="logo logo-light">
                <span class="logo-sm">
                    <img src="/build/images/logo-light.png" alt="" height="40">
                </span>
                <span class="logo-lg">
                    <img src="/build/images/logo-light.png" alt="" height="40">
                </span>
            </a>
        </div>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link menu-link"> <i class="bi bi-speedometer2"></i> <span data-key="t-dashboard">@lang('translation.dashboards')</span> </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">@lang('translation.modules')</span></li>

                
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#insuranceCar" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInsuranceCar">
                        <i class="bi bi-card-text"></i> <span data-key="t-insuranceCar">@lang('translation.insuranceCar')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="insuranceCar">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/cars/create" class="nav-link"data-key="t-newPolicy" >@lang('translation.new')</a>
                                <a href="/cars" class="nav-link" data-key="t-listPolicy">@lang('translation.list')</a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link menu-link {{($seg=="cars")?"active":""}}" href="#cars" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInsuranceCar">
                        <i class="bi bi-car-front"></i> <span data-key="t-insuranceCar">@lang('translation.cars')</span>
                    </a>
                    <div class="collapse menu-dropdown {{($seg=="cars")?"show":""}}" id="cars">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{($seg2=="list-cars" || $seg2=="create-car")?"active":""}}">
                                <a href="{{route('listCar.create')}}" class="nav-link {{($seg2=="create-car")?"active":""}}" data-key="t-newPolicy" >@lang('translation.new')</a>
                                <a href="{{ route('listCar') }}" class="nav-link {{($seg2=="list-cars")?"active":""}}" data-key="t-listPolicy">@lang('translation.list')</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{($seg=="companies")?"active":""}}" href="#companies" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInsuranceCar">
                        <i class="bi bi-window-dock"></i> <span data-key="t-insuranceCar">@lang('translation.companies')</span>
                    </a>
                    <div class="collapse menu-dropdown {{($seg=="companies")?"show":""}}" id="companies">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{($seg2=="")?"active":""}}">
                                <a href="{{route('lisCompany.create')}}" class="nav-link {{($seg2=="create-company")?"active":""}}" data-key="t-newPolicy" >@lang('translation.new')</a>
                                <a href="{{ route('lisCompany') }}" class="nav-link {{($seg2=="list-company")?"active":""}}" data-key="t-listPolicy">@lang('translation.list')</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{($seg=="policies")?"active":""}}" href="#policies" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInsuranceCar">
                        <i class="bi bi-folder"></i> <span data-key="t-insuranceCar">@lang('translation.policies')</span>
                    </a>
                    <div class="collapse menu-dropdown {{($seg=="policies")?"show":""}}" id="policies">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{($seg=="policies")?"active":""}}">
                                <a href="{{route('policy.create')}}" class="nav-link{{($seg2=="create-policy")?"active":""}}" data-key="t-newPolicy" >@lang('translation.new')</a>
                                <a href="{{ route('listPolicy') }}" class="nav-link {{($seg2=="list-policies")?"active":""}}" data-key="t-listPolicy">@lang('translation.list')</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{($seg=="media")?"active":""}}">
                    <a href="{{ route('listMedia')}}" class="nav-link menu-link"> <i class="bi bi-image"></i> <span data-key="t-policies">@lang('translation.media')</span> </a>
                </li>
                <li class="nav-item {{($seg=="customEvents")?"active":""}}">
                    <a href="{{ route('customEvents')}}" class="nav-link menu-link"> <i class="bi bi-bell"></i> <span data-key="t-policies">@lang('translation.reminders')</span> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{($seg=="settings")?"active":""}}" href="#settings" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInsuranceCar">
                        <i class="bi bi-folder"></i> <span data-key="t-insuranceCar">@lang('translation.settings')</span>
                    </a>
                    <div class="collapse menu-dropdown {{($seg=="settings")?"show":""}}" id="settings">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{($seg=="settings")?"active":""}}">
                                <a href="{{route('list-province')}}" class="nav-link{{($seg2=="create-policy")?"active":""}}" data-key="t-newPolicy" >@lang('translation.province')</a>
                                <a href="{{route('list-district')}}" class="nav-link{{($seg2=="create-policy")?"active":""}}" data-key="t-newPolicy" >@lang('translation.district')</a>
                                <a href="{{route('policy.create')}}" class="nav-link{{($seg2=="create-policy")?"active":""}}" data-key="t-newPolicy" >@lang('translation.corregimiento')</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="/cars/paperwork" >
                        <i class="bi bi-symmetry-vertical"></i> <span data-key="t-carPaperwork">@lang('translation.carPaperwork')</span>
                    </a>
                </li> -->

                <!-- <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-apps">@lang('translation.manage')</span></li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#users" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="user">
                        <i class="bi bi-people"></i> <span data-key="t-users">@lang('translation.users')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="users">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('userCreate')}}" class="nav-link"data-key="t-newPolicy" >@lang('translation.new')</a>
                                <a href="{{ route('userList')}}" class="nav-link" data-key="t-listPolicy">@lang('translation.list')</a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#companies" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="companies">
                        <i class="bi bi-window-dock"></i> <span data-key="t-reminder">@lang('translation.companies')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="companies">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" data-key="t-newCompany" data-bs-toggle="modal" data-bs-target="#addCompanyModal" style="cursor: pointer;">@lang('translation.new')</a>
                                <a href="{{ route('lisCompany')}}" class="nav-link" data-key="t-listPolicy">@lang('translation.list')</a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#reminder" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="reminder">
                        <i class="bi bi-calendar3"></i> <span data-key="t-reminder">@lang('translation.reminder')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="reminder">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('customEvents')}}" class="nav-link"data-key="t-newPolicy" >@lang('translation.customEvents')</a>
                                <a href="{{ route('settingReminder')}}" class="nav-link" data-key="t-listPolicy">@lang('translation.setting')</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>