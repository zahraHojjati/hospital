@extends('admin.layouts.master-admin')
@section('title')
    داشبورد
@endsection
@section('content')
    <div class="col-12 mt-5 jusify-content-center">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <div class="card">
                    <a href="{{ route('admin.insurances.index') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="mt-0 text-right">
                                        <span class="font-weight-semibold">تعداد بیمه ها</span>
                                        <h3 class="mb-0 mt-1 text-primary">{{$insurancesCount}}</h3>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="icon1 bg-primary-transparent my-auto  float-left">
                                        <i class="fe fe-file-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <div class="card">
                    <a href="{{ route('admin.doctors.index') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="mt-0 text-right"><span class="font-weight-semibold">تعداد دکتر ها</span>
                                        <h3 class="mb-0 mt-1 text-success">{{$doctorsCount}}</h3>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="icon1 bg-success-transparent my-auto  float-left">
                                        <i class="fe fe-file-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <div class="card">
                    <a href="{{ route('admin.surgeries.index') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="mt-0 text-right"><span
                                            class="font-weight-semibold">تعداد جراحی ها</span>
                                        <h3 class="mb-0 mt-1 text-danger">{{$surgeriesCount}}</h3></div>
                                </div>
                                <div class="col-5">
                                    <div class="icon1 bg-danger-transparent my-auto  float-left">
                                        <i class="fe fe-file-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <div class="card">
                    <a href="{{ route('admin.payments.index') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="mt-0 text-right"><span
                                            class="font-weight-semibold">تعداد صورت حساب ها</span>
                                        <h3 class="mb-0 mt-1 text-warning">{{$paymentsCount}}</h3></div>
                                </div>
                                <div class="col-5">
                                    <div class="icon1 bg-warning-transparent my-auto  float-left">
                                        <i class="fe fe-file-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header border-0 justify-content-between bg-gradient-warning">
                        <div class="d-flex">
                            <p class="card-title font-weight-bolder ml-2">صورتحساب های پرداخت نشده</p>
                        </div>
                        <div>
                            <a href="{{route("admin.invoices.index")}}" class="btn btn-outline-primary">مشاهده همه</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="hr-table-wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                                           id="hr-table">
                                        <thead>
                                        <tr>
                                            <th class="text-center border-top">شناسه</th>
                                            <th class="text-center border-top">نام دکتر</th>
                                            <th class="text-center border-top">مبلغ کل (تومان)</th>
                                            <th class="text-center border-top">تاریخ ثبت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td class="text-center"><a
                                                        href="{{ route('admin.invoices.show', $invoice) }}"> {{ $invoice->id }} </a>
                                                </td>
                                                <td class="text-center"> {{ $invoice->doctor->name }}
                                                    ({{ $invoice->doctor->speciality->title }})
                                                </td>
                                                <td class="text-center"> {{ number_format($invoice->amount) }} </td>
                                                <td class="text-center"> {{ $invoice->createdAt() }} </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header border-0 justify-content-between bg-gradient-success">
                        <div class="d-flex">
                            <p class="card-title font-weight-bolder ml-2">آخرین فعالیت ها</p>
                        </div>
                        <div>
                            <a href="{{route("admin.LogActivity.index")}}" class="btn btn-outline-primary">مشاهده همه</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="hr-table-wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                                           id="hr-table">
                                        <thead>
                                        <tr>
                                            <th class="text-center border-top">شناسه</th>
                                            <th class="text-center border-top">توضیحات</th>
                                            <th class="text-center border-top">زمان اتفاق</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($logs as $log)
                                            <tr>
                                                <td class="text-center">{{ $log->id }}</td>
                                                <td class="text-center">{{ $log->description }}</td>
                                                <td class="text-center">{{ $log->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
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
@endsection


