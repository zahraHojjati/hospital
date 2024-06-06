<div class="card">
    <div class="card-header border-0">
        <p class="card-title" style="font-weight: bolder;">جستجو پیشرفته</p>
        <a href="{{route("admin.operations.index")}}" class="action-btns1 mr-5">
            <i class="feather feather-search text-warning"></i>
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="{{ route("admin.operations.index") }}" class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-3 col-xxl-2">
                        <div class="form-group">
                            <label class="font-weight-bold">عمل :</label>
                            <input type="text" name="name" class="form-control" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-3 form-group">
                        <label class="font-weight-bold">وضعیت :</label>
                        <select name="status" class="form-control">
                            <option value="all">همه</option>
                            <option value="0" @selected(request("status") == "0")>غیر فعال</option>
                            <option value="1" @selected(request("status") == "1")>فعال</option>
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="from_date_show" class="font-weight-bold">از تاریخ :</label>
                        <input class="form-control fc-datepicker" id="from_date_show" type="text" autocomplete="off"/>
                        <input name="started_date" id="from_date" type="hidden" value="{{ request("started_date") }}"/>
                    </div>

                    <div class="col-3 form-group">
                        <label for="to_date_show" class="font-weight-bold">تا تاریخ :</label>
                        <input class="form-control fc-datepicker" id="to_date_show" type="text" autocomplete="off"/>
                        <input name="finished_date" id="to_date" type="hidden" value="{{ request("finished_date") }}"/>
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
        $('#from_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#from_date',
            targetTextSelector: '#from_date_show',
            englishNumber: false,
            toDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
        $('#to_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#to_date',
            targetTextSelector: '#to_date_show',
            englishNumber: false,
            toDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
    </script>
@endsection


