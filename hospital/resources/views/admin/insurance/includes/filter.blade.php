<div class="card">
    <div class="card-header border-0">
        <p class="card-title" style="font-weight: bolder;">جستجو پیشرفته</p>
        <a href="{{route("admin.insurances.index")}}" class="action-btns1 mr-5">
            <i class="feather feather-search text-warning"></i>
        </a>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row">
                <form action="{{ route("admin.insurances.index") }}" class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="font-weight-bold">نام بیمه :</label>
                                <select name="name" class="form-control select2">
                                    <option value="all">همه</option>
                                    @foreach ($insurances as $insurance)
                                        <option
                                            value="{{ $insurance->name }}" @selected(request("name") == $insurance->name)>{{ $insurance->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--                    <div class="col-4 form-group">--}}
                        {{--                        <label class="font-weight-bold">نوع بیمه :</label>--}}
                        {{--                        <select name="type" class="form-control">--}}
                        {{--                            <option value="all" @selected(request("type") == "all")>همه</option>--}}
                        {{--                            <option value="basic" @selected(request("type") == "basic")>پایه</option>--}}
                        {{--                            <option value="supplementary" @selected(request("type") == "supplementary")>مکمل</option>--}}
                        {{--                        </select>--}}
                        {{--                    </div>--}}
                        <div class="col-4">
                            <div class="form-group">
                                <label class="font-weight-bold">وضعیت :</label>
                                <select name="status" class="form-control">
                                    <option value="all">همه</option>
                                    <option value="0" @selected(request("status") == "0")>غیر فعال</option>
                                    <option value="1" @selected(request("status") == "1")>فعال</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mt-5">
                                <button class="col-12 btn btn-primary align-self-center">جستجو</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
