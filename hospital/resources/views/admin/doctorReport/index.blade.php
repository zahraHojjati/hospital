@extends('admin.layouts.master-admin')
@section('content')
    <!--Page header-->
    <div class="page-header d-xl-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title" style="font-family: '2  Koodak';margin-right: 10px"> گزارش مالی پزشکان</h4>
        </div>
    </div>
    <!--End Page header-->
{{--    @php $doctor='doctor' @endphp--}}
    <form action="{{ route("admin.doctorReport.show") }}" class="col-12">
        @csrf
        <!-- Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label"> نام دکتر :<span class="text-danger">&starf;</span></label>
                                    <select name="doctor_id" class="form-control custom-select select2"
                                            data-placeholder="دکتر را انتخاب کنید">
                                        <option value="all"> همه</option>
                                        @foreach ($doctors as $doctor)
                                            <option
                                                value="{{ $doctor->id }}" @selected(request("doctor_id") == $doctor->id)>{{ $doctor->name }}
                                                - {{ $doctor->speciality->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">از تاریخ:<span class="text-danger">&starf;</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div>
                                        <input placeholder="تاریخ ترخیص را وارد کنید"
                                               class="form-control fc-datepicker" id="from_date_show"
                                               type="text"
                                               autocomplete="off"/>
                                        <input required name="from_surgeried_at" id="from_date" type="hidden"
                                               value="{{ request("from_surgeried_at") }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">تا تاریخ:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div>
                                        <input placeholder="تاریخ ترخیص را وارد کنید"
                                               class="form-control fc-datepicker" id="to_date_show"
                                               type="text"
                                               autocomplete="off"/>
                                        <input name="to_surgeried_at" id="to_date" type="hidden"
                                               value="{{ request("to_surgeried_at") }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group mt-5">
                                    <button type="submit" class="col-12 btn btn-primary align-self-center">جستجو</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
