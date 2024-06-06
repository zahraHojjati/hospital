<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta
        content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard."
        name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords"
          content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>پنل مدیریت {{ config('app.name') }}</title>

    <!--Favicon -->
    <link rel="icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>

    <!-- Bootstrap css -->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet"/>

    <!-- Style css -->
    @include('admin.layouts.includes.style')
</head>
<!-- INTERNAL Notifications  Css -->
<link href="{{asset("assets/plugins/notify/css/jquery.growl-rtl.css")}}" rel="stylesheet"/>
<link href="{{asset("assets/plugins/notify/css/notifIt.css")}}" rel="stylesheet"/>
<body class="app sidebar-mini">
<!---Global-loader-->
<div id="global-loader">
    <img src="{{asset('assets/images/svgs/loader.svg')}}" alt="loader">
</div>
<div class="page">
    <div class="page-main">
        <!--aside open-->
        @include('admin.layouts.includes.aside')
        <!--aside closed-->
        <div class="app-content main-content">
            <div class="side-app">
                <!--app header-->
                @include('admin.layouts.includes.header')
            </div>
            <!--/app header-->
            @yield('content')
            <!--Footer-->
            @include('admin.layouts.includes.footer')
            <!-- End Footer-->
            <!--Change password Modal -->
            <div class="modal fade" id="changepasswordnmodal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-family:'2  Koodak'">تغییر کلمه عبور</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
{{--                        <form action="{{route('admin.profile.changePassword', auth()->user()->id)}}" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('PUT')--}}
{{--                            <div class="modal-body">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label"> کلمه عبور فعلی</label>--}}
{{--                                    <input name="currentPassword" type="password" class="form-control"--}}
{{--                                           placeholder="کلمه عبور فعلی را وارد کنید" value="">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">کلمه عبور جدید</label>--}}
{{--                                    <input name="password" type="password" class="form-control"--}}
{{--                                           placeholder="کلمه عبور جدید را وارد کنید" value="">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">تکرار کلمه عبور</label>--}}
{{--                                    <input name="password_confirmation" type="password" class="form-control"--}}
{{--                                           placeholder="کلمه عبور جدید را مجدد وارد کنید" value="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <a href="#" class="btn btn-danger" data-dismiss="modal">خروج</a>--}}
{{--                                <button type="submit" class="btn btn-warning">تغییر کلمه عبور</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
                    </div>
                </div>
            </div>
            <!-- End Change password Modal  -->
        </div>
        @include('admin.layouts.includes.js')
    </div>
</div>
</body>
</html>


