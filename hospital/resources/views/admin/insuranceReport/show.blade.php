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
                             <span>
                گزارش بیمه
                <span class="fs-16 font-weight-bolder">{{ $insurance->name }} ({{$insurance->discount}} درصد) </span>
                از تاریخ {{ verta($fromDate)->format('Y/m/d')}}
                تا تاریخ {{ verta($toDate)->format('Y/m/d') }}
              </span>
                        </div>
                    </div>
                    <div class="card-header d-flex justify-content-end">
                        <input type="hidden" name="doctor_id" value="">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-bordered border-bottom" id="job-list" >
                                <thead style="background-color: #8686ac">
                                <tr>
                                    <th class="border-bottom-0 text-center text-white">ردیف</th>
                                    <th class="border-bottom-0 text-center text-white">نام بیمار</th>
                                    <th class="border-bottom-0 text-center text-white">کدملی بیمار</th>
                                    <th class="border-bottom-0 text-center text-white">عمل ها</th>
                                    <th class="border-bottom-0 text-center text-white">مبلغ کل (تومان)</th>
                                    <th class="border-bottom-0 text-center text-white"> سهم بیمه</th>
                                    <th class="border-bottom-0 text-center text-white">تاریخ ترخیص</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($surgeries as $surgery)
                                    <tr>
                                        <td class="text-center">{{ $surgery->id }}</td>
                                        <td class="text-center">{{ $surgery->patient_name }}</td>
                                        <td class="text-center">{{ $surgery->patient_national_code }}</td>
                                        <td class="text-center">
                                            @php
                                                $countOfOperations = $surgery->operations->count();
                                                $counter = 1;
                                            @endphp
                                            @foreach ($surgery->operations as $operation)
                                                <span class="fs-14 mr-1"> {{ $operation->name }} </span>
                                                @if ($counter < $countOfOperations)
                                                    <span class="fs-14 mr-1"> - </span>
                                                @endif
                                                @php $counter++; @endphp
                                            @endforeach
                                        </td>
                                        <td class="text-center">{{ number_format($surgery->getTotalPrice()) }}</td>
                                        <td class="text-center">{{ number_format($surgery->getInsuranceContribution()) }}</td>
                                        <td class="text-center">{{verta($surgery->released_at )->format('Y/m/d')}}</td>
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
                                    <tr>
                                        <td colspan="8" style="background-color: #fbc0d5">
                                            <div class="d-flex justify-content-between text-center">
                                                <div>
                                                    <span class="font-weight-bold">جمع کل عمل (تومان): </span>
                                                    <span> {{ number_format($insurance->sumSurgeriesTotalPrice($surgeries)) }} </span>
                                                </div>
                                            </div>
                                        </td>
                                    <tr>
                                        <td colspan="8" style="background-color: #7abaff">
                                            <div class="d-flex justify-content-between text-center">
                                                <div>
                                                <span
                                                    class="font-weight-bold">سهم بیمه (تومان): </span>
                                                    <span> {{ number_format($insurance->sumSurgeriesInsuranceContribution($surgeries)) }} </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="background-color: #8fd19e">
                                            <div class="d-flex justify-content-between text-center">
                                                <div>
                                                    <span class="font-weight-bold">مبلغ کل عمل با کسر بیمه (تومان): </span>
                                                    <span> {{ number_format($insurance->sumSurgeriesTotalPrice($surgeries) - $insurance->sumSurgeriesInsuranceContribution($surgeries)) }} </span>
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


