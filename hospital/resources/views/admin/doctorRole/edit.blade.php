@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1"><a href="{{route('admin.doctorRoles.index')}}">نقش پزشک</a></li>
                <li class="breadcrumb-item1 active"><a href="#">ویرایش نقش</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header border-bottom-0">
                    <h3 class="card-title">فرم ویرایش نقش ها </h3>
                </div>
                <div class="card-body pb-2">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <div class="col-12">
                                <form action="{{ route("admin.doctorRoles.update", $doctorRole->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label"> نقش : </label>
                                                <input class="form-control mb-4"
                                                       placeholder="نام عمل را وارد کنید"
                                                       type="text" name="title" value="{{$doctorRole->title}}">
                                            </div>
                                                    <div class="col-6">
                                                        <label class="form-label">  الزامی است :<span
                                                                class="text-danger">&starf;</span> </label>
                                                        <select name="required"
                                                                class="form-control custom-select select2">
                                                            @if($doctorRole->required==1)
                                                                <option value="{{1}}" selected>بله</option>
                                                                <option value="{{0}}">خیر</option>
                                                            @else
                                                                <option value="{{1}}">بله</option>
                                                                <option value="{{0}}" selected>خیر</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                        </div>
                                    </div>
                                            <div class="form-group">
                                                <div class="row">
                                                            <div class="col-6">
                                                                <label class="form-label">  سهم پزشک :<span
                                                                        class="text-danger">&starf;</span> </label>
                                                                <input class="form-control mb-4"
                                                                       placeholder="عدد را وارد کنید"
                                                                       type="text" name="quota" required>
                                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">وضعیت : </label>
                                                <select name="status"
                                                        class="form-control custom-select select2">
                                                    @if($doctorRole->status==1)
                                                    <option value="{{1}}" selected>فعال</option>
                                                    <option value="{{0}}">غیرفعال</option>
                                                        @else
                                                            <option value="{{1}}">فعال</option>
                                                            <option value="{{0}}" selected>غیرفعال</option>
                                                        @endif
                                                </select>
                                            </div>
                                                </div>
                                            </div>
                                        <div class="form-group m-0">
                                            <div class="form-group d-flex justify-content-first">
                                                <button type="submit" class="btn btn-warning" style="width: 10%">بروز
                                                    رسانی
                                                </button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

