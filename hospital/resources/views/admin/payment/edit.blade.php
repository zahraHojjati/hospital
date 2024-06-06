@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-lg-12 col-md-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
            <li class="breadcrumb-item1 active"><a href="{{route('admin.payments.index')}}">پرداختی ها </a></li>
            <li class="breadcrumb-item1 active"><a href="">ویرایش پرداختی </a></li>
        </ol>
        @include('includes._errors')
        <div class="card">
            <div class="card-body bg-azure-light">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-3">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bolder fs-17"> نام دکتر : </span>
                            <span
                                class="font-weight-lighter mx-1">{{$payment->invoice->doctor->name}} </span>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bolder fs-17">قیمت کل : </span>
                            <span
                                class="font-weight-lighter mx-1">{{number_format($payment->invoice->amount)}}  تومان </span>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bolder fs-17"> مبلغ پرداخت شده : </span>
                            <span
                                class="font-weight-lighter mx-1">{{number_format($payment->invoice->getSumPaymentAmount())}}  تومان </span>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bolder fs-17"> مبلغ  باقی مانده : </span>
                            <span
                                class="font-weight-lighter mx-1">{{number_format($payment->invoice->getRemainingAmount())}}  تومان </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h3 class="card-title" style="font-family: '2  Baran';font-size: x-large">فرم ویرایش تسویه
                            حساب </h3>
                    </div>
                    <div class="card-body pb-2">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <div class="col-12">
                                    <form action="{{ route("admin.payments.update" , $payment) }}" method="POST"
                                          class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label"> مبلغ :
                                                        <span class="text-danger">&starf;</span></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control comma" name="amount"
                                                               value="{{(number_format($payment->amount))}}">
                                                    </div>
                                                </div>
                                                {{--                                            <div class="col-4">--}}
                                                {{--                                                <label for="created_at">تاریخ پرداخت : <span--}}
                                                {{--                                                        class="text-danger">&starf;</span></label>--}}
                                                {{--                                                <input type="text" class="form-control fc-datepicker"--}}
                                                {{--                                                       name="created_at" id="created_at_show"--}}
                                                {{--                                                       placeholder="تاریخ عمل را اینجا وارد کنید"--}}
                                                {{--                                                       value="{{ verta(old('created_at', today()->format('Y-m-d')))->format('Y-m-d') }}"--}}
                                                {{--                                                       required>--}}
                                                {{--                                                <input name="created_at" id="created_at" type="hidden"--}}
                                                {{--                                                       value="{{ old('created_at', today()->format('Y-m-d')) }}">--}}
                                                {{--                                            </div>--}}
                                                <div class="col-6">
                                                    <label class="form-label"> نوع پرداخت :
                                                        <span class="text-danger">&starf;</span></label>
                                                    <select name="pay_type" class="form-control custom-select select2">
                                                        @if ($payment->pay_type =='cash')
                                                            <option value="cash" selected>نقدی</option>
                                                            <option value="cheque">چک</option>
                                                        @elseif($payment->pay_type =='cheque')
                                                            <option value="cash">نقدی</option>
                                                            <option value="cheque" selected>چک</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-6">
                                            <div class="col-4">
                                                <label class="form-label"> تصویر رسید </label>
                                                <input type="file" class="form-control"
                                                       name="receipt">
                                                <span class="text-muted">
                                                        فرمت های قابل قبول: jpg,jpeg,png,gif
                                                    </span>
                                            </div>
                                            <div class="col-4">
                                                <label for="due_date">تاریخ سررسید : <span
                                                        class="text-danger">&starf;</span></label>
                                                <input type="text" class="form-control fc-datepicker"
                                                       name="due_date" id="due_date_show"
                                                       placeholder="تاریخ عمل را اینجا وارد کنید"
                                                       value="{{ verta(old('due_date', today()->format('Y-m-d')))->format('Y-m-d') }}"
                                                       required>
                                                <input name="due_date" id="due_date" type="hidden"
                                                       value="{{ old('due_date', today()->format('Y-m-d')) }}">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">وضعیت : </label>
                                                <select name="status"
                                                        class="form-control custom-select select2">
                                                    @if($payment->status==1)
                                                        <option value="{{1}}" selected>پرداخت شده</option>
                                                        <option value="{{0}}">پرداخت نشده</option>
                                                    @else
                                                        <option value="{{1}}">پرداخت شده</option>
                                                        <option value="{{0}}" selected>پرداخت نشده</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-6">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="description" class="font-weight-bold">توضیحات : </label>
                                                    <textarea class="form-control" name="description" id="description"
                                                              rows="3">{!! old('description', $payment->invoice->description) !!}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group d-flex justify-content-center"
                                                 style="padding-right: 48%;margin-top: 2%">
                                                <button type="submit" class="btn btn-warning">بروز رسانی</button>
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




