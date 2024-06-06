@extends('admin.layouts.master-admin')
@section('title')
    جزئیات صورت حساب
@endsection
@section('content')
    <div class="row">
        @include('includes._errors')
        <div class="col-lg-12 col-md-12">
            <div class="card-body">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">داشبورد</li>
                    <li class="breadcrumb-item"> صورتحساب</li>
                    <li class="breadcrumb-item" style="color: blue"> مشاهده</li>
                </ol>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="page-leftheader">
                                    <h4 class="page-title">مشاهده جزئیات صورت حساب دکتر
                                        : {{$invoice->doctor->name}}</h4>
                                </div>
                            </div>
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
                                            <div class="rounded my-5"
                                                 style="width: 100%; height:1px; background-color: darkgrey;"></div>
                                            <div class="row mt-3 mr-1">
                                                <div class="col px-0">
                                                    <span class="fs-20">توضیحات :</span>
                                                    <p class="fs-18 mt-2 mr-1">{{$invoice->description}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-bottom-0">
                                <h3 class="card-title" style="font-family: '2  Nazanin';font-weight: bold">لیست جراحی
                                    های این
                                    صورت حساب</h3>
                            </div>
                            <br>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered card-table table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>شناسه</th>
                                            {{--                        <th>عمل ها</th>--}}
                                            <th>مبلغ سهم در جراحی(تومان)</th>
                                            <th>نقش دکتر</th>
                                            <th>تاریخ جراحی</th>
                                            <th>مبلغ پرداخت شده</th>
                                            <th>مبلغ باقی مانده</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $counter = 0; @endphp
                                        @forelse ($surgeries as $surgery)
                                            @php $counter++; @endphp
                                            <tr>
                                                <td>{{ $counter }}</td>
                                                <td>{{$surgery->surgery_id}}</td>
                                                {{--                            <td>{{$surgery->surgery->operations->name}}</td>--}}
                                                <td>{{number_format($surgery->amount)}}</td>
                                                <td>{{$surgery->doctorRole->title}}</td>
                                                <td>{{verta($surgery->surgery->surgeried_at)->format('Y/m/d')}}</td>
                                                <td>{{$invoice->getSumPaymentAmount()}}</td>
                                                <td>{{$invoice->getRemainingAmount()}}</td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-warning ">هیچ محتوایی وجود ندارد...</div>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header border-0 justify-content-between ">
                                        <div class="d-flex">
                                            <p class="card-title ml-2" style="font-weight: bolder;">پرداختی ها</p>
                                            <span class="fs-15 ">({{ $invoice->payments->count() }})</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div id="hr-table-wrapper"
                                                 class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <table
                                                        class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                                        id="hr-table">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center border-top">شناسه</th>
                                                            <th class="text-center border-top">مبلغ (تومان)</th>
                                                            <th class="text-center border-top">نحوه پرداخت</th>
                                                            <th class="text-center border-top">تاریخ پرداخت</th>
                                                            <th class="text-center border-top">وضعیت</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @forelse ($invoice->payments->sortByDesc('id') as $payment)
                                                            <tr>
                                                                <td class="text-center">{{ $payment->id }}</td>
                                                                <td class="text-center">{{ number_format($payment->amount) }}</td>
                                                                <td class="text-center">{{ $payment->getPaymentType() }}</td>
                                                                <td class="text-center">{{ $payment->created_at }}</td>
                                                                <td class="text-center">
                                                                    @if ($payment->status)
                                                                        <span class='badge badge-success'> موفق </span>
                                                                    @else
                                                                        <span class='badge badge-danger'> ناموفق </span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6">
                                                                    <div class="text-center">
                                                                        <span class="text-danger">پرداختی برای این صورتحساب صورت نگرفته</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
