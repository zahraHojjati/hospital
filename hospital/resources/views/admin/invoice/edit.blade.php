@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1"><a href="{{route('admin.invoices.index')}}">صورت حساب</a></li>
                <li class="breadcrumb-item1 active"><a href="#">ویرایش صورت حساب</a></li>
            </ol>
        </div>
        <div>
            <a href="{{route('admin.invoices.index')}}" class="btn btn-outline-warning ">بازگشت</a>
        </div>
    </div>
    @include('includes._errors')
    <form action="{{route('admin.invoices.update', $invoice->id)}}" method="POST" enctype="multipart/form-data" class="col-xs-11 justify-content-center">
        @csrf
        @method('PUT')
        <div class="page-item">
            <h5 class="page-title">ویرایش صورت حساب دکتر : {{$invoice->doctors->name}}</h5>
        </div>
        <br>
        <div class="card">
            <div class="container">
                <div class="card-body">
                    <div class="row d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="fs-20">مبلغ کل صورت حساب (تومان) : </span>
                            <span class="fs-18 mr-2">{{number_format($invoice->amount)}}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="fs-20">وضعیت صورت حساب : </span>
                            @if($invoice->status == 1)
                                <span class="fs-18 mr-2 text-success">پرداخت شده</span>
                            @else
                                <span class="fs-18 mr-2 text-danger">پرداخت نشده</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="description" class="font-weight-bold" >توضیحات : </label>
                    <textarea class="form-control" name="description" id="description"
                              rows="3">{!! old('description', $invoice->description) !!}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group m-0">
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="btn btn-warning" onclick="not1()">به روز رسانی</button>
            </div>
        </div>
    </form>
@endsection
