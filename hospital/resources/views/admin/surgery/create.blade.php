@extends('admin.layouts.master-admin')
@section('content')
    <!--Page header-->
    <div class="page-header d-lg-flex d-block">
        <div class="page-leftheader">
            <h4 class="page-title" style="font-family: '2  Koodak'">جراحی ها</h4>
        </div>
        <div class="page-leftheader mr-md-auto">

        </div>
    </div>
    <!--End Page header-->

    <!-- Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('admin.surgeries.store') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="patient_name" class="control-label">نام بیمار <span class="text-danger">&starf;</span></label>
                                    <input type="text" class="form-control" name="patient_name" id="patient_name" placeholder="نام بیمار را اینجا وارد کنید" value="{{ old('patient_name') }}" required autofocus>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="patient_national_code" class="control-label">کد ملی بیمار <span class="text-danger">&starf;</span></label>
                                    <input type="text" class="form-control" name="patient_national_code" id="patient_national_code" placeholder="کد ملی بیمار را اینجا وارد کنید" value="{{ old('patient_national_code') }}" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="document_number" class="control-label">شماره سند <span class="text-danger">&starf;</span></label>
                                    <input type="text" class="form-control" name="document_number" id="document_number" placeholder=" شماره سند را اینجا وارد کنید" value="{{ old('document_number') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="surgeried_at" class="control-label">تاریخ عمل <span class="text-danger">&starf;</span></label>
                                    <input type="text" class="form-control fc-datepicker" name="surgeried_at" id="surgeried_at_date_show"
                                           placeholder="تاریخ عمل را اینجا وارد کنید" value="{{ verta(old('surgeried_at', today()->format('Y-m-d')))->format('Y-m-d') }}"
                                    required>
                                    <input name="surgeried_at" id="surgeried_at" type="hidden"
                                           value="{{ old('surgeried_at', today()->format('Y-m-d')) }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="released_at" class="control-label">تاریخ ترخیص <span
                                            class="text-danger">&starf;</span></label>
                                    <input type="text" class="form-control fc-datepicker" name="released_at" id="released_at_date_show"
                                           placeholder="تاریخ ترخیص را اینجا وارد کنید" value="{{ verta(old('released_at', today()->format('Y-m-d')))->format('Y-m-d') }}"
                                    required>
                                    <input name="released_at" id="released_at" type="hidden"
                                           value="{{ old('released_at', today()->format('Y-m-d')) }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="operations" class="control-label">عمل ها</label>
                                    <span class="text-danger">&starf;</span>
                                    <select class="form-control select2" name="operations[]" id="operations" multiple required>
                                        @foreach($operations as $id => $name)
                                            <option value="{{ $id }}" @selected(in_array($id, old('operations', [])))>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="basic_insurance_id" class="control-label">بیمه پایه</label>
                                    <select class="form-control" name="basic_insurance_id" id="basic_insurance_id">
                                        <option value="" class="text-muted">--  بیمه پایه مورد نظر را انتخاب کنید --</option>
                                        @foreach($basicInsurances as $basicInsurance)
                                            <option value="{{ $basicInsurance->id }}" @selected($basicInsurance->id == old('basic_insurance_id'))>{{ $basicInsurance->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="supp_insurance_id" class="control-label">بیمه تکمیلی</label>
                                    <select class="form-control" name="supp_insurance_id" id="supp_insurance_id">
                                        <option value="" class="text-muted">--  بیمه تکمیلی مورد نظر را انتخاب کنید --</option>
                                        @foreach($suppInsurances as $suppInsurance)
                                            <option value="{{ $suppInsurance->id }}" @selected($suppInsurance->id == old('supp_insurance_id'))>{{ $suppInsurance->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($doctorRoles as $doctorRole)
                                <div class="col">
                                    <div class="form-group">
                                        <label for="role-{{ $doctorRole->id }}" class="control-label">{{ $doctorRole->title }}</label>
                                        @if($doctorRole->required)
                                            <span class="text-danger">&starf;</span>
                                        @endif
                                        <select class="form-control" name="doctors[{{ $doctorRole->id }}]" id="role-{{ $doctorRole->id }}" @required($doctorRole->required)>
                                            <option class="text-muted" value="">-- نام دکتر مورد نظر را انتخاب کنید --</option>
                                            @foreach($doctorRole->doctors as $doctor)
                                                <option value="{{ $doctor->id }}" @selected(in_array($doctor->id, old('doctors', [])))>{{ $doctor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="description" class="control-label">توضیحات</label>
                                    <textarea class="form-control" name="description" id="description"
                                              rows="3">{!! old('description') !!}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">ثبت و ذخیره</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row-->
@endsection
@section('script')
    <script>
        //datetimepicker
        $('#surgeried_at_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#surgeried_at_date',
            targetTextSelector: '#surgeried_at_date_show',
            englishNumber: false,
            toDate: true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });

        $('#released_at_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#released_at_date',
            targetTextSelector: '#released_at_date_show',
            englishNumber: false,
            toDate: true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });
    </script>
@endsection
