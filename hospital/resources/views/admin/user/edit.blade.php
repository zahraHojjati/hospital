@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-lg-12 col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
            <li class="breadcrumb-item1"><a href="{{route('admin.users.index')}}">کاربران</a></li>
            <li class="breadcrumb-item1 active"><a href="#">ویرایش کاربر</a></li>
        </ol>
        @include('includes._errors')
        <div class="row">
            <div class="card">
                <div class="card-header border-bottom-0">
                    <h3 class="card-title">فرم ویرایش ادمین </h3>
                </div>
                <div class="card-body pb-2">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <div class="col-12">
                                <form action="{{ route("admin.users.update", $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="form-label">نام و نام خانوادگی : </label>
                                                <input class="form-control mb-4"
                                                       placeholder="نام و نام خانوادگی را وارد کنید"
                                                       type="text" name="name" value="{{$user->name}}">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">شماره موبایل : </label>
                                                <input class="form-control mb-4" placeholder="شماره موبایل را وارد کنید"
                                                       type="text" name="mobile" value="{{$user->mobile}}">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">ایمیل : </label>
                                                <input class="form-control mb-4" placeholder="ایمیل را وارد کنید"
                                                       type="email"
                                                       name="email" value="{{$user->email}}">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label"> کلمه عبور
                                                <input class="form-control mb-4" placeholder="کلمه عبور را وارد کنید"
                                                       type="password"
                                                       name="password">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">تکرار کلمه عبور
                                                <input class="form-control mb-4"
                                                       placeholder="کلمه عبور را مجدد وارد کنید" type="password"
                                                       name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="row mt-12">
                                            <div class="col-12">
                                                <div class="form-label mb-4">مجوزها</div>
                                            </div>
                                            @foreach($permissions->chunk(4) as $chunk)
                                                @foreach($chunk as $permission)
                                                    <div class="col-3">
                                                        <div class="form-group px-3">
                                                            <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   name="permissions[]"
                                                                   value="{{$permission->id}}" @checked($user->permissions->contains($permission->id))>
                                                            <span class="custom-control-label">{{$permission->label}}</span>
                                                        </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                        <div class="form-group m-0">
                                            <div class="form-group d-flex justify-content-center">
                                                <button type="submit" class="btn btn-warning" style="width: 10%">بروز
                                                    رسانی
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

