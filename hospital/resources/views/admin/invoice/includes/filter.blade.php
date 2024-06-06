<div class="card">
    <div class="card-header border-0">
        <p class="card-title" style="font-weight: bolder;">جستجو پیشرفته</p>
        <a href="{{route("admin.invoices.index")}}" class="action-btns1 mr-5">
            <i class="feather feather-search text-warning"></i>
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="{{ route("admin.invoices.index") }}" class="col-12">
                <div class="row">
                    <div class="col-4 form-group">
                        <label class="font-weight-bold">نام دکتر :</label>
                        <select name="doctor_id" class="form-control select2">
                            <option value="all">همه</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @selected(request("name") == $doctor->name)>{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label for="from_date_show" class="font-weight-bold"> تاریخ :</label>
                        <input class="form-control fc-datepicker" id="date_invoice" type="text"
                               autocomplete="off"/>
                        <input name="released_at" id="date_invoice" type="hidden"
                               value="{{ request("created_at") }}"/>
                    </div>
                    <div class="col-4 form-group">
                        <label class="font-weight-bold">وضعیت :</label>
                        <select name="status" class="form-control">
                            <option value="all">همه</option>
                            <option value="0" @selected(request("status") == "0")>پرداخت شده</option>
                            <option value="1" @selected(request("status") == "1")>پرداخت نشده</option>
                        </select>
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
        $('#date_invoice').MdPersianDateTimePicker({
            targetDateSelector: '#date_invoice',
            targetTextSelector: '#date_invoice_show',
            englishNumber: false,
            toDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
    </script>
@endsection
