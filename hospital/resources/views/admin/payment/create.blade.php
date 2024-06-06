@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a href="{{route('admin.payments.index')}}">پرداختی ها </a></li>
                <li class="breadcrumb-item1 active"><a href="">ثبت پرداختی جدید </a></li>
            </ol>
            @include('includes._errors')
            <div class="card">
                <div class="card-body bg-azure-light">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-xl-3">
                            <div class="d-flex align-items-center">
                                <span class="font-weight-bolder fs-17"> نام دکتر : </span>
                                <span
                                    class="font-weight-lighter mx-1">{{$invoice->doctor->name}} </span>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-3">
                            <div class="d-flex align-items-center">
                                <span class="font-weight-bolder fs-17">قیمت کل : </span>
                                <span
                                    class="font-weight-lighter mx-1">{{number_format($invoice->amount)}}  تومان </span>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-3">
                            <div class="d-flex align-items-center">
                                <span class="font-weight-bolder fs-17"> مبلغ پرداخت شده : </span>
                                <span
                                    class="font-weight-lighter mx-1">{{number_format($invoice->getSumPaymentAmount())}}  تومان </span>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-3">
                            <div class="d-flex align-items-center">
                                <span class="font-weight-bolder fs-17"> مبلغ  باقی مانده : </span>
                                <span
                                    class="font-weight-lighter mx-1">{{number_format($invoice->getRemainingAmount())}}  تومان </span>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="row">
                            <div class="card">
                                <div class="card-header border-bottom-0">
                                    <h3 class="card-title" style="font-family: '2  Baran';font-size: x-large">فرم ثبت
                                        تسویه
                                        حساب </h3>
                                </div>
                                <div class="card-body pb-2">
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <div class="col-12">
                                                <form action="{{ route("admin.payments.store",$invoice)}}" method="POST"
                                                      class="form-horizontal"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label class="form-label"> مبلغ :
                                                                    <span class="text-danger">&starf;</span></label>
                                                                <div class="input-group">
                                                                    <input type="text" name="amount"
                                                                           class="form-control mb-4 comma"
                                                                           placeholder=" مبلغ را وارد کنید">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-label"> نوع پرداخت :
                                                                    <span class="text-danger">&starf;</span></label>
                                                                <select name="pay_type" id="pay_type"
                                                                        class="form-control custom-select select2">
                                                                    <option value="none" class="custom-menu">انتخاب
                                                                    </option>
                                                                    <option value="cash">نقدی</option>
                                                                    <option value="cheque">چک</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row mt-6">
                                                                <div class="col-6">
                                                                    <label class="form-label"> تصویر رسید </label>
                                                                    <input type="file" class="form-control"
                                                                           name="receipt" id="receipt">
                                                                    <span class="text-muted">
                                                        فرمت های قابل قبول: jpg,jpeg,png,gif
                                                    </span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="due_date_show">تاریخ سررسید : <span
                                                                            class="text-danger">&starf;</span></label>
                                                                    <input type="text"
                                                                           class="form-control fc-datepicker"
                                                                           id="due_date_show"
                                                                           placeholder="تاریخ سررسید چک را اینجا وارد کنید"
                                                                           value="{{ verta(old('due_date', today()->format('Y-m-d')))->format('Y-m-d') }}">
                                                                    <input name="due_date" id="due_date" type="hidden"
                                                                           value="{{ old('due_date', today()->format('Y-m-d')) }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-6">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="description" class="font-weight-bold">توضیحات
                                                                        : </label>
                                                                    <textarea class="form-control" name="description"
                                                                              id="description"
                                                                              rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group d-flex justify-content-center"
                                                                 style="padding-right: 45%">
                                                                <button type="submit" class="btn btn-primary"> ثبت و
                                                                    ذخیره
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
                        @endsection
                        @push('script')
                            <script>
                                $(document).ready(function () {
                                    $('input.comma').on('keyup', function (event) {
                                        if (event.which >= 37 && event.which <= 40) return;
                                        $(this).val(function (index, value) {
                                            return value
                                                .replace(/\D/g, "")
                                                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        });
                                    });

                                });

                            </script>
    @endpush


