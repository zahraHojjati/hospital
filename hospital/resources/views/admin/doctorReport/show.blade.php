@extends('admin.layouts.master-admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="#" class="action-btns" data-toggle="tooltip" data-placement="top" title=""
                       onclick="javascript:window.print();" data-original-title="Print">
                        <i class="feather feather-printer text-primary"
                           style="font-size: xx-large"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="card-header border-0 justify-content-between ">
                        <div class="d-flex">
                            {{--                        @php $doctor = 'doctor' @endphp--}}
                            <p class="card-title ml-2 " style="font-weight: bolder;">پرداخت به دکتر : {{$doctor->name}}
                                ، از
                                تاریخ {{verta($fromSurgeriedAt)->format('Y/m/d')}} - تا
                                تاریخ {{verta($toSurgeriedAt)->format('Y/m/d')}}</p>
                        </div>
                    </div>
                    <div class="card-header d-flex justify-content-end">
                        <input type="hidden" name="doctor_id" value="">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-bordered border-bottom" id="job-list">
                                <thead style="background-color: #8686ac">
                                <tr>
                                    <th class="border-bottom-0 text-center text-white">ردیف</th>
                                    <th class="border-bottom-0 text-center text-white">نام بیمار</th>
                                    <th class="border-bottom-0 text-center text-white">کدملی بیمار</th>
                                    <th class="border-bottom-0 text-center text-white">عمل ها</th>
                                    <th class="border-bottom-0 text-center text-white">سهم دکتر</th>
                                    <th class="border-bottom-0 text-center text-white"> صورتحساب</th>
                                    <th class="border-bottom-0 text-center text-white">توضیحات</th>
                                    <th class="border-bottom-0 text-center text-white">تاریخ جراحی</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($doctorSurgeries as $doctorSurgery)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $doctorSurgery->surgery->patient_name }}</td>
                                        <td class="text-center">{{ $doctorSurgery->surgery->patient_national_code }}</td>
                                        <td class="text-center">{{ implode(',', $doctorSurgery->surgery->operations->pluck('name')->all()) }}</td>
                                        <td class="text-center">{{ number_format($doctorSurgery->amount) }}</td>
                                        <td class="text-center">
                                            {{--                                            @if(optional($doctorSurgery->pivot->invoice && $doctorSurgery->pivot->invoice->id))--}}
                                            @if ($doctorSurgery->invoice_id)
                                                <span class="badge badge-success"
                                                      style="width: 50px!important;">دارد</span>
                                            @else
                                                <span class="badge badge-danger">ندارد </span>
                                            @endif
                                        </td>
                                        {{--                                            <td>{{ $doctorSurgery->pivot->invoice && $doctorSurgery->pivot->invoice->description }}</td>--}}
                                        <td class="text-center">{{ $doctorSurgery->description }}</td>
                                        <td class="text-center">{{verta($doctorSurgery->surgery->surgeried_at)->format('Y/m/d')}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <div class="text-center">
                                                <span class="text-danger">هیچ داده ای یافت نشد</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                @php
                                    $totalSum = $doctorSurgeries->sum('amount');
                                    $paymentsSum = $doctor->payments->where('status', 1)->sum('amount');
                                @endphp
                                <tr>
                                    <td colspan="8" style="background-color: #fbc0d5">
                                        <div class="d-flex justify-content-between text-center">
                                            <div>
                                                <span class="font-weight-bold">جمع کل (تومان): </span>
                                                <span> {{ number_format($totalSum) }} </span>
                                            </div>
                                        </div>
                                    </td>
                                <tr>
                                    <td colspan="8" style="background-color: #7abaff">
                                        <div class="d-flex justify-content-between text-center">
                                            <div>
                                                <span
                                                    class="font-weight-bold">جمع کل پرداختی ها به دکتر (تومان): </span>
                                                <span> {{ number_format($paymentsSum) }} </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" style="background-color: #8fd19e">
                                        <div class="d-flex justify-content-between text-center">
                                            <div>
                                                <span class="font-weight-bold">باقیمانده (تومان): </span>
                                                <span> {{ number_format($totalSum - $paymentsSum) }} </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection


