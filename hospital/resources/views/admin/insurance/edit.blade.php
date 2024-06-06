@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1"><a href="{{route('admin.insurances.index')}}">پزشک</a></li>
                <li class="breadcrumb-item1 active"><a href="#">ویرایش پزشک</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header border-bottom-0">
                    <h3 class="card-title">فرم ویرایش بیمه </h3>
                </div>
                <div class="card-body pb-2">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <div class="col-12">
                                <form action="{{ route("admin.insurances.update", $insurance->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label">نام بیمه : </label>
                                                <input class="form-control mb-4"
                                                       placeholder="نام بیمه را وارد کنید"
                                                       type="text" name="name" value="{{$insurance->name}}">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">نوع بیمه : </label>
                                                <select name="type" class="form-control" required>
                                                    <option value="none">انتخاب</option>
                                                    <option value="basic" @selected($insurance->type == "basic")>پایه</option>
                                                    <option value="supplementary" @selected($insurance->type == "supplementary")>مکمل</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">تخفیف : </label>
                                                <input class="form-control mb-4" placeholder="قیمت را وارد کنید"
                                                       type="text" name="discount" value="{{$insurance->discount}}">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">وضعیت : </label>
                                                <select name="status"
                                                        class="form-control custom-select select2">
                                                    @if($insurance->status==1)
                                                        <option value="{{1}}" selected>فعال</option>
                                                        <option value="{{0}}">غیرفعال</option>
                                                    @else
                                                        <option value="{{1}}">فعال</option>
                                                        <option value="{{0}}" selected>غیرفعال</option>
                                                    @endif
                                                </select>
                                            </div>

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
@endsection

