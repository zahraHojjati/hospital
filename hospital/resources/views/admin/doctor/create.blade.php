@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card-body">
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1"><a href="{{route('admin.doctors.index')}}">پزشک</a></li>
                <li class="breadcrumb-item1 active"><a href="#">ایجاد پزشک</a></li>
            </ol>
        </div>
    </div>
    @include('includes._errors')
    <div class="row">
        <div class="card">
            <div class="card-header border-bottom-0">
                <h3 class="card-title" style="font-family: '2  Koodak'">فرم ثبت پزشک </h3>
            </div>
            <div class="card-body pb-2">
                <div class="row row-sm">
                    <div class="col-lg">
                        <div class="col-12">
                            <form action="{{ route("admin.doctors.store") }}" method="POST"
                                  class="form-horizontal">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label"> نام پزشک :<span
                                                    class="text-danger">&starf;</span> </label>
                                            <input class="form-control mb-4"
                                                   placeholder="نام عمل را وارد کنید"
                                                   type="text" name="name" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label">تخصص :
                                                <span class="text-danger">&starf;</span></label>
                                            <select name="speciality_id"
                                                    class="form-control custom-select select2">
                                                @foreach($specialities as $speciality)
                                                    <option value="{{$speciality->id}}">{{$speciality->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label">کد ملی :</label>
                                            <input class="form-control mb-4" placeholder=" کد ملی را وارد کنید"
                                                   type="text"
                                                   name="national_code" value="{{ old('national_code') }}">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label"> شماره نظام پزشکی :</label>
                                            <input class="form-control mb-4"
                                                   placeholder=" شماره نظام پزشکی را وارد کنید"
                                                   type="text"
                                                   name="medical_number" value="{{ old('medical_number') }}">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label"> شماره تماس :
                                                <span class="text-danger">&starf;</span></label>
                                            <input class="form-control mb-4"
                                                   placeholder=" شماره نظام پزشکی را وارد کنید"
                                                   type="text"
                                                   name="mobile" value="{{ old('mobile') }}" required>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label">  ایمیل :
                                            <input class="form-control mb-4"
                                                   placeholder=" آدرس ایمیل را وارد کنید"
                                                   type="email"
                                                   name="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label"> رمز عبور :
                                                <span class="text-danger">&starf;</span></label>
                                            <input class="form-control mb-4"
                                                   placeholder=" شماره نظام پزشکی را وارد کنید"
                                                   type="password"
                                                   name="password" required>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label">تکرار رمز عبور :
                                                <span class="text-danger">&starf;</span></label>
                                            <input class="form-control mb-4" placeholder="رمز عبور را مجدد وارد کنید"
                                                   type="password" name="password" value="">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">انتخاب نقش پزشک :
                                                <span class="text-danger">&starf;</span></label>
                                            <select class="form-control js-example-basic-multiple-limit" name="doctor_roles[]"
                                                    multiple="multiple">
                                                @foreach ($doctorRoles as $doctorRole)
                                                    <option
                                                        value="{{ $doctorRole->title }}">{{ $doctorRole->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    <div class="col-6">
                                        <label class="form-label">وضعیت :
                                            <span class="text-danger">&starf;</span></label>
                                        <select name="status"
                                                class="form-control custom-select select2">
                                            <option value="1">فعال</option>
                                            <option value="0">غیرفعال</option>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" style="width: 10%">ثبت
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endsection
        @section('scripts')
            <script>
                $(".js-example-basic-multiple-limit").select2({
                    maximumSelectionLength: 100
                });
            </script>
@endsection

