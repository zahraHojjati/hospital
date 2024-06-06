@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1"><a href="{{route('admin.doctors.index')}}">پزشک</a></li>
                <li class="breadcrumb-item1 active"><a href="#">ویرایش پزشک</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="card">

                <div class="card-header border-bottom-0 d-flex justify-content-between">
                    <p class="card-title font-weight-bolder">ویرایش دکتر</p>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.doctors.update', $doctor)}}" method="POST">

                        @method("PATCH")
                        @csrf

                        <div class="row">

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">نام دکتر :</label><span
                                        class="text-danger">&starf;</span>
                                    <input type="text" name="name" value="{{ $doctor->name }}" class="form-control"
                                           required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">انتخاب تخصص :</label><span class="text-danger">&starf;</span>
                                    <select name="speciality_id" class="form-control select2" required>
                                        @foreach ($specialities as $speciality)
                                            <option
                                                value="{{ $speciality->id }}"
                                                @selected ($doctor->speciality->id == $speciality->id)>
                                                {{ $speciality->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">کد ملی :</label>
                                    <input type="text" name="national_code" value="{{ $doctor->national_code }}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">شماره نظام پزشکی :</label>
                                    <input type="text" name="medical_number" value="{{ $doctor->medical_number }}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">تلفن همراه :</label><span class="text-danger">&starf;</span>
                                    <input type="text" name="mobile" value="{{ $doctor->mobile }}" class="form-control"
                                           required>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">آدرس ایمیل :</label><span class="text-danger">&starf;</span>
                                    <input type="email" name="email" value="{{ $doctor->email }}" class="form-control"
                                           >
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">کلمه عبور :</label>
                                    <input type="password" name="password" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">تکرار کلمه عبور :</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">وضعیت :</label><span
                                        class="text-danger">&starf;</span>
                                    <select name="status" class="form-control" required>
                                        <option value="1" @selected($doctor->status == '1')> فعال</option>
                                        <option value="0" @selected($doctor->status == '0')> غیر فعال</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">انتخاب نقش :</label><span class="text-danger">&starf;</span>
                                    <select name="doctor_roles[]" class="form-control select2" required multiple>
                                        @foreach ($doctorRoles as $role)
                                            <option
                                                value="{{ $role->id }}"
                                                @selected ($doctor->doctorRoles->contains($role->id))>
                                                {{ $role->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-warning mt-3" style="width: 10% ">ویرایش  </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection

        @section('scripts')
            <script>
                $(".multi-select2").select2({
                    tags: true
                });
                $(".select2").select2();
            </script>
@endsection
