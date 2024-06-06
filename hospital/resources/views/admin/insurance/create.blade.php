@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card-body">
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1"><a href="{{route('admin.insurances.index')}}">پزشک</a></li>
                <li class="breadcrumb-item1 active"><a href="#">ایجاد پزشک</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header border-bottom-0">
                <h3 class="card-title" style="font-family: '2  Baran'">فرم ثبت بیمه </h3>
            </div>
            <div class="card-body pb-2">
                <div class="row row-sm">
                    <div class="col-lg">
                        <div class="col-12">
                            <form action="{{ route("admin.insurances.store") }}" method="POST"
                                  class="form-horizontal">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label"> نام بیمه :<span
                                                    class="text-danger">&starf;</span> </label>
                                            <input class="form-control mb-4"
                                                   placeholder="نام عمل را وارد کنید"
                                                   type="text" name="name">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label">نوع بیمه :
                                                <span class="text-danger">&starf;</span></label>
                                            <select name="type" class="form-control" required>
                                                <option value="none">انتخاب</option>
                                                <option value="basic">پایه</option>
                                                <option value="supplementary">مکمل</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label"> تخفیف :
                                            <span class="text-danger">&starf;</span></label>
                                            <input class="form-control mb-4" type="number" name="discount" minlength="0" maxlength="100">
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label">وضعیت :
                                                <span class="text-danger">&starf;</span></label>
                                            <select name="status"
                                                    class="form-control custom-select select2">
                                                <option value="1">فعال</option>
                                                <option value="0">غیرفعال</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary" style="width: 10%">ثبت
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

