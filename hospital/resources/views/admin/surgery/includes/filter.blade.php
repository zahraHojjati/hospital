<div class="card">
    <div class="card-header border-0">
        <p class="card-title" style="font-weight: bolder;">جستجو پیشرفته</p>
        <a href="{{route("admin.surgeries.index")}}" class="action-btns1 mr-5">
            <i class="feather feather-search text-warning"></i>
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="{{ route("admin.surgeries.index") }}" class="col-12">
                <div class="row">
                    <div class="col-6 form-group">
                        <label class="font-weight-bold">نام و نام خانوادگی بیمار :</label>
                        <input type="text" name="patient_name" value="{{ request("patient_name") }}" class="form-control" />
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="font-weight-bold">کد ملی بیمار :</label>
                            <input type="text" name="patient_national_code" class="form-control" value="{{ request('patient_national_code') }}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="from_date_show" class="font-weight-bold">جراحی از تاریخ :</label>
                            <input class="form-control fc-datepicker" id="from_surgeried_date_show" type="text" autocomplete="off"/>
                            <input name="from_surgeried_at" id="from_surgeried_date" type="hidden" value="{{ request("from_surgeried_at") }}"/>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="to_date_show" class="font-weight-bold">تا تاریخ :</label>
                            <input class="form-control fc-datepicker" id="to_surgeried_date_show" type="text" autocomplete="off"/>
                            <input name="to_surgeried_at" id="to_surgeried_date" type="hidden" value="{{ request("to_surgeried_at") }}"/>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="from_date_show" class="font-weight-bold">ترخیص از تاریخ :</label>
                            <input class="form-control fc-datepicker" id="from_released_date_show" type="text" autocomplete="off"/>
                            <input name="from_released_at" id="from_released_date" type="hidden" value="{{ request("from_released_at") }}"/>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="to_date_show" class="font-weight-bold">تا تاریخ :</label>
                            <input class="form-control fc-datepicker" id="to_released_date_show" type="text" autocomplete="off"/>
                            <input name="to_released_at" id="to_released_date" type="hidden" value="{{ request("to_released_at") }}"/>
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
@section('scripts')
    <script>
        $('#from_surgeried_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#from_surgeried_date',
            targetTextSelector: '#from_surgeried_date_show',
            englishNumber: false,
            toDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
        $('#to_surgeried_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#to_surgeried_date',
            targetTextSelector: '#to_surgeried_date_show',
            englishNumber: false,
            toDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
        $('#from_released_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#from_released_date',
            targetTextSelector: '#from_released_date_show',
            englishNumber: false,
            toDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
        $('#to_released_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#to_released_date',
            targetTextSelector: '#to_released_date_show',
            englishNumber: false,
            toDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
    </script>

@endsection
