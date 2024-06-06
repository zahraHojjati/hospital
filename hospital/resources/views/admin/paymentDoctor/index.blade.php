@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            @php $doctor='doctor' @endphp
            <form action="{{ route("admin.paymentDoctor.create") }}" class="col-12">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            <ol class="breadcrumb1">
                                <li class="breadcrumb-item1"><a
                                        href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                                <li class="breadcrumb-item1 active"><a href="{{route("admin.paymentDoctor.index")}}">پرداختی
                                        به پزشک </a></li>
                                {{--                            <li class="breadcrumb-item active"><a style="color: #036262">پرداخت دکتر {{$doctor->name}}</a></li>--}}
                            </ol>
                            @include('includes._errors')
                            <div class="card-header border-0">
                                <p class="card-title" style="font-weight: bolder;">جستجو پیشرفته</p>
                                <a href="{{route("admin.paymentDoctor.index")}}" class="action-btns1 mr-5">
                                    <i class="feather feather-refresh-cw text-warning"></i>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="font-weight-bold">نام دکتر :</label>
                                                    <select name="doctor_id" class="form-control select2" required>
                                                        <option value="all">همه</option>
                                                        @foreach ($doctors as $doctor)
                                                            <option
                                                                value="{{ $doctor->id }}" @selected(request("doctor_id") == $doctor->id)>{{ $doctor->name }}
                                                                - {{ $doctor->speciality->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="from_date_show" class="font-weight-bold">از تاریخ
                                                        :</label>
                                                    <input placeholder="تاریخ ترخیص را وارد کنید"
                                                           class="form-control fc-datepicker" id="from_date_show"
                                                           type="text"
                                                           autocomplete="off"/>
                                                    <input name="from_released_at" id="from_date" type="hidden"
                                                           value="{{ request("from_released_at") }}"/>
                                                </div>

                                                <div class="col-4">
                                                    <label for="to_date_show" class="font-weight-bold">تا تاریخ
                                                        :</label>
                                                    <input placeholder="تاریخ ترخیص را وارد کنید"
                                                           class="form-control fc-datepicker" id="to_date_show"
                                                           type="text"
                                                           autocomplete="off"/>
                                                    <input name="to_released_at" id="to_date" type="hidden"
                                                           value="{{ request("to_released_at") }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group">
                                            <button type="submit" class="col-12 btn btn-primary align-self-center">
                                                جستجو
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#from_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#from_date',
            targetTextSelector: '#from_date_show',
            englishNumber: false,
            toDate: true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
        $('#to_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#to_date',
            targetTextSelector: '#to_date_show',
            englishNumber: false,
            toDate: true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
    </script>
@endsection

