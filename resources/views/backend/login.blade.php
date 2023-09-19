<!DOCTYPE html>
<html class=" <?php if(getSettings('site_theme') == 'dark'){ echo 'dark-layout'; } ?> loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{getSettings('site_page_title')}}</title>

    <link rel="apple-touch-icon" href="{{URL::asset('public/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('public/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <?php if(getSettings('site_language') == 'en'){   ?>
        <!-- ltr -->

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/vendors.min.css')}}">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/themes/bordered-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/themes/semi-dark-layout.css')}}">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/forms/form-validation.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/pages/authentication.css')}}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('public/assets/css/style.css')}}">
        <!-- END: Custom CSS-->

        <!-- end ltr -->
    <?php }else if(getSettings('site_language') == 'ar'){   ?>
    <!-- start rtl -->
 <!-- BEGIN: Vendor CSS-->
 <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/vendors-rtl.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css-rtl/pages/authentication.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/assets/css-rtl/style.css')}}">
    <!-- end rtl -->
    <?php } ?>
<style type="text/css">
    .alrt_msg{
    position: absolute;
    right: 40px;
    top: 22px;
    }
    .lang_pos{
    position: absolute;
    top: 30px;
    right: 62px;
    }
</style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                       
                        <!-- Left Text-->
                        <div class="d-none d-lg-block col-lg-8 align-items-center p-4">
                             <!-- Brand logo-->
                        <div class="navbar-container d-flex">
                            <a class="px-1" href="{{url('/admin')}}">
                                <h2 class="brand-text text-primary ms-1">{{lang_trans('ewa')}}</h2>
                            </a>
                        </div>
                        <!-- /Brand logo-->
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                                <img class="img-fluid" src="{{asset('public/images/login_bg.png')}}" alt="Login V2" />
                            </div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 position-relative align-items-center auth-bg px-2 p-lg-5">
                             <ul class="nav lang_pos navbar-nav align-items-center">
                                <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(getSettings('site_language') == 'en')
                                        <i class="flag-icon flag-icon-sa"></i>
                                        <span class="selected-language">العربية</span>
                                    @elseif(getSettings('site_language') == 'ar')
                                        <i class="flag-icon flag-icon-us"></i>
                                        <span class="selected-language">English</span>
                                    @endif
                                   </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                                        <a class="dropdown-item" href="{{route('change-setting',['en'])}}" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a>
                                        <a class="dropdown-item" href="{{route('change-setting',['ar'])}}" data-language="sa"><i class="flag-icon flag-icon-sa"></i> Saudi Arab</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <a class="nav-brand d-flex justify-content-center" href="#">
                                    <img class="img-fluid" src="{{asset('public/images/logo.png')}}" alt="Login V2",height= "150" , width="150" />
                                </a>
                                <h2 class="card-title text-center fw-bold mb-1">{{lang_trans('welcome_to')}} {{lang_trans('ewa')}}</h2>
                                <p class="card-text mb-2 text-center text-break">{{lang_trans('please_sign_in_to_your_account_and_start_the_adventure')}}</p>
                                <!-- <form class="auth-login-form mt-2" action="index.html" method="POST"> -->
                                {{ Form::open(array('url'=>route('do-login'),'id'=>"login-form", 'class'=>"auth-login-form mt-2")) }}
                                    <div class="mb-1">
                                        <label class="form-label" for="login-email"> {{lang_trans('txt_email')}}</label>
                                        <input class="form-control" type="text" name="username" placeholder="Username" aria-describedby="login-email" autofocus="" tabindex="1" />
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="login-password"> {{lang_trans('txt_password')}}</label>
                                            <!-- <a href="auth-forgot-password-cover.html"><small>Forgot Password?</small></a> -->
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <!-- <div class="form-check">
                                            <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                                            <label class="form-check-label" for="remember-me"> Remember Me</label>
                                        </div> -->
                                    </div>
                                    @if(!config('app.login_active'))
                                    <button class="btn btn-primary w-100 submit" tabindex="4" >
                                            {{lang_trans('btn_login')}}
                                        </button>
                                    @else
                                        <button class="btn btn-primary w-100" tabindex="4" type="button" onclick="login_alert()" >
                                            {{lang_trans('btn_login')}}
                                        </button>
                                    @endif
                                    <!-- <button class="btn btn-primary w-100" tabindex="4">Sign in</button> -->
                                    <!-- <button class="btn btn-primary w-100" tabindex="4">Sign in</button> -->
                                {{ Form::close() }}
                                    <!-- </form> -->
                                <!-- <p class="text-center mt-2"><span>New on our platform?</span><a href="auth-register-cover.html"><span>&nbsp;Create an account</span></a></p> -->
                                <div class="divider my-2">
                                    <!-- <div class="divider-text">or</div> -->
                                </div>
                                <div class="auth-footer-btn d-flex justify-content-center">
                                    ©{{date('Y')}} {{lang_trans('txt_rights_res')}}.
                                    <!-- <a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a><a class="btn btn-twitter white" href="#"><i data-feather="twitter"></i></a><a class="btn btn-google" href="#"><i data-feather="mail"></i></a><a class="btn btn-github" href="#"><i data-feather="github"></i></a> -->
                                </div>
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger p-1 m-0 alrt_msg" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{URL::asset('public/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{URL::asset('public/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{URL::asset('public/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{URL::asset('public/app-assets/js/scripts/pages/auth-login.js')}}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

        function login_alert(){
            Swal.fire(

                'عذراً! تم تعطيل النظام تلقائيًا لتخلفك عن سداد المستحقات , يرجى التواصل مع الشركة الموفرة للخدمة لإعادة التفعيل',
                '',
                'error'
            );
        }

    </script>
</body>
<!-- END: Body-->

</html>
