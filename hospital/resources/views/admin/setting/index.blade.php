@extends('admin.layouts.master-admin')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">داشبورد</li>
        <li class="breadcrumb-item" style="color: blue"> تنظیمات</li>
    </ol>
    <div class="col-12 d-flex mt-5">
        <div class="col-md-12 col-lg-4">
            <div class="card bg-gradient-teal">
                <div class="card-header d-flex justify-content-center">
                    <div class="card-title">
                        <img src="{{asset('assets/images/png/icons8-info-64.png')}}">
                    </div>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p style="text-align: center;color: white">تنظیمات عمومی</p>
                        <footer style="color: white;font-size: small;text-align: center">
                            تنظیمات عمومی سایت مانند لوگو و پروفایل و  تلفن و غیره... در این بخش قرار میگیرد.
                        </footer>
                        <div class="form-group d-flex justify-content-center mt-5">
                            <a class="btn btn-white ml-2 bx-border-radius"
                               href="{{route('admin.settings.edit',['general'])}}">
                                ویرایش
                            </a>
                        </div>
                    </blockquote>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-4">
            <div class="card bg-gradient-danger">
                <div class="card-header d-flex justify-content-center">
                    <div class="card-title">
                        <img src="{{asset('assets/images/png/icons8-des-médias-sociaux-64.png')}}">
                    </div>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p style="text-align: center;color: white">شبکه های اجتماعی</p>
                        <footer style="color: white;font-size: small;text-align: center">
                            تنظیمات مربوط به شبکه های اجتماعی مثل اینستاگرام ، تلگرام و ... در این بخش قرار میگیرد.
                        </footer>
                        <div class="form-group d-flex justify-content-center mt-5">
                            <a class="btn btn-white ml-2 bx-border-radius"
                               href="{{route('admin.settings.edit',['social'])}}">
                                ویرایش
                            </a>
                        </div>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
@endsection
