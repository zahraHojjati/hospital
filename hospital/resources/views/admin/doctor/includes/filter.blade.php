<div class="card">
    <div class="card-header border-0">
        <p class="card-title" style="font-weight: bolder;">جستجو پیشرفته</p>
        <a href="{{route("admin.doctors.index")}}" class="action-btns1 mr-5">
            <i class="feather feather-search text-warning"></i>
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="{{ route("admin.doctors.index") }}" class="col-12">
                <div class="row">
                    <div class="col-4 form-group">
                        <label class="font-weight-bold">نام دکتر :</label>
                        <select name="name" class="form-control">
                            <option value="all">همه</option>
                            @foreach ($doctors as $doctor)
                                <option
                                    value="{{ $doctor->name }}"
                                    @selected(request('name') == $doctor->name)>
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label class="font-weight-bold">انتخاب تخصص :</label>
                        <select name="speciality_id" class="form-control">
                            <option value="all">همه</option>
                            @foreach ($specialities as $speciality)
                                <option
                                    value="{{ $speciality->id }}"
                                    @selected(request('speciality_id') == $speciality->id)>
                                    {{ $speciality->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4 form-group">
                        <div class="form-group">
                            <label class="font-weight-bold">کد نظام پزشکی :</label>
                            <input type="text" name="medical_number" class="form-control" value="{{ request('medical_number') }}">
                        </div>
                    </div>
                </div>

                <div class="col-12 form-group">
                    <button class="col-12 btn btn-primary align-self-center">جستجو</button>
                </div>
            </form>
        </div>
    </div>
</div>

