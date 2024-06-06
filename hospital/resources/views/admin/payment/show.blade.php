@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.payments.index')}}">پرداخت ها</a></li>
            <li class="breadcrumb-item" style="color: blue"> مشاهده جزئیات</li>
        </ol>
        <div class="card-header d-flex justify-content-first" style="background-color: #5dacf2">
            <h2 class="card-title" style="font-family:'2  Koodak'"> مشاهده جزئیات پرداخت </h2>
        </div>
        <div class="card">
            <div class="card-header">
                {{--                <p class="card-title" style="font-weight: bolder;padding-top: 2%">پرداخت شماره :  {{ $payment->id }}--}}
                {{--                <hr>--}}
                {{--                <div class="d-flex">--}}
                {{--                    <a href="{{route("admin.payments.edit", ['payment' => $payment])}}" class="btn btn-info ml-2">--}}
                {{--                        <i class="fe fe-edit text-white"></i>--}}
                {{--                    </a>--}}
                {{--                    <button onclick="confirmDelete('delete-{{ $payment->id }}')" class="btn btn-danger ml-2">--}}
                {{--                        <i class="fe fe-trash-2 text-white"></i>--}}
                {{--                    </button>--}}
                {{--                    <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST"--}}
                {{--                          id="delete-{{ $payment->id }}" style="display: none">--}}
                {{--                        @csrf--}}
                {{--                        @method('DELETE')--}}
                {{--                    </form>--}}
                <a href="{{route("admin.payments.index")}}" class="btn btn-warning ">
                    <i class="fe fe-log-out text-white"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row d-flex justify-content-between">

                <div class="d-flex flex-column justify-content-between">

                    <div class="d-flex align-items-center">
                        <span class="fs-20 font-weight-bolder">صورتحساب شماره :</span>
                        <span class="fs-18 mr-2">{{ $payment->id }}</span>
                    </div>
                    <br>
                    <div class="d-flex align-items-center">
                        <span class="fs-20 font-weight-bolder">نام پزشک :</span>
                        <span class="fs-18 mr-2">{{ $payment->invoice->doctor->name }}</span>
                    </div>
                    <br>
                    <div class="d-flex align-items-center">
                        <span class="fs-20 font-weight-bolder">تخصص :</span>
                        <span class="fs-18 mr-2">{{ $payment->invoice->doctor->speciality->title }}</span>
                    </div>
                    <br>
                    <div class=" d-flex align-items-center ">
                        <span class="fs-20 font-weight-bolder">  مبلغ کل پرداختی :</span>
                        <span class="fs-18 mr-2">{{ $payment->invoice->getSumPaymentAmount() }}</span>
                    </div>
                    <br>
                    <div class=" d-flex align-items-center ">
                        <span class="fs-20 font-weight-bolder"> نوع پرداخت :</span>
                        @if($payment->pay_type == 'cash')
                            <span class="fs-18 mr-2"> نقدی</span>
                        @else
                            <span class="fs-18 mr-2">چک </span>
                        @endif

                    </div>
                    <br>
                    <div class=" d-flex align-items-center ">
                        <span class="fs-20 font-weight-bolder">  باقیمانده :</span>
                        <span class="fs-18 mr-2">{{ $payment->invoice->getRemainingAmount() }}</span>
                    </div>
                    <br>
                    @if($payment->pay_type == 'cheque')
                        <div class=" d-flex align-items-center ">
                            <span class="fs-20 font-weight-bolder">تاریخ سر رسید :</span>
                            <span class="fs-18 mr-2">{{verta($payment->due_date)->format('Y/m/d')  }}</span>
                        </div>
                    @endif
                    {{--                        <div class=" d-flex align-items-center ">--}}
                    {{--                            <span class="fs-20 font-weight-bolder">وضعیت :</span>--}}
                    {{--                            @if($payment->status == 1)--}}
                    {{--                                <span class="fs-18 mr-2 text-success">تسویه شد </span>--}}
                    {{--                            @else--}}
                    {{--                                <span class="fs-18 mr-2 text-danger "> تسویه نشد </span>--}}
                    {{--                            @endif--}}
                    {{--                        </div>--}}
                </div>
                @if($payment->pay_type == 'cheque')
                    <div style="height: 300px; width: 40%;">
                        <figure class="h-100 w-100">
                            <a href="{{Storage::url($payment->receipt)}}" target="blank"><img
                                    src="{{Storage::url($payment->receipt)}}" style="height: 100%;width: 90%"></a>
                        </figure>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
