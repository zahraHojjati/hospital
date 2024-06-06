@extends('admin.layouts.master-admin')
@section('content')
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title" style="font-family: '2  Koodak';margin-right: 10px"> گزارش بیمه بیمار </h4>
        </div>
    </div>
    <!--End Page header-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route("admin.insuranceReports.show") }}" class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold">نوع بیمه :</label><span class="text-danger">&starf;</span>
                                        <select name="insurance_type" id="insuranceType" class="form-control" required>
                                            <option value="">انتخاب</option>
                                            <option value="basic">پایه</option>
                                            <option value="supplementary">تکمیلی</option>
                                        </select>
                                        @error('insurance_type')
                                        <span class="text-danger fs-12">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold">انتخاب بیمه :</label><span
                                            class="text-danger">&starf;</span>
                                        <select name="insurance_id" id="insuranceOptions" class="form-control" required>
                                            <option value="">انتخاب</option>
                                        </select>
                                        @error('insurance_id')
                                        <span class="text-danger fs-12">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group">
                                        <label for="from_date_show" class="font-weight-bold">از تاریخ :</label><span
                                            class="text-danger">&starf;</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="feather feather-calendar"></i>
                                                </div>
                                            </div>
                                            <input class="form-control fc-datepicker" id="from_date_show" type="text"
                                                   autocomplete="off"/>
                                            <input name="from_date" id="from_date" type="hidden"/>
                                            @error('from_date')
                                            <span class="text-danger fs-12">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group">
                                        <label for="to_date_show" class="font-weight-bold">تا تاریخ :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="feather feather-calendar"></i>
                                                </div>
                                            </div>
                                            <input class="form-control fc-datepicker" id="to_date_show" type="text"
                                                   autocomplete="off"/>
                                            <input name="to_date" id="to_date" type="hidden"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <button class="col-12 btn btn-primary align-self-center">جستجو</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $(".select2").select2();
    </script>

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

    <script>
        $(document).ready(function () {
            $('#insuranceType').change(function () {
                var type = $(this).val();
                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: 'http://127.0.0.1:8000/admin/get-insurances',
                    type: 'POST',
                    data: {type: type},
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function (response) {
                        $('#insuranceOptions').html(response);
                    }
                });
            });
        });

    </script>

@endsection
