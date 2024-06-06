@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a href="">پزشک</a></li>
            </ol>
            @include('admin.doctor.includes.filter')
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.doctors.create')}}" class="btn btn-info btn-group-sm"> ثبت پزشک جدید <i class="fe feather-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                            <thead class="text-white text-center" style="background-color: #8686ac">
                            <tr>
                                <th class="text-center border-top text-white">شناسه</th>
                                <th class="text-center border-top text-white">نام و نام خانوادگی</th>
                                <th class="text-center border-top text-white">تخصص</th>
                                <th class="text-center border-top text-white">نقش ها</th>
                                <th class="text-center border-top text-white">کد نظام پزشکی</th>
                                <th class="text-center border-top text-white">وضعیت</th>
                                <th class="text-center border-top text-white">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="text-center btn-light">
                            @forelse ($doctors as $doctor)
                                <tr>
                                    <td class="text-center">{{ $doctor->id }}</td>
                                    <td class="text-center">{{ $doctor->name }}</td>
                                    <td class="text-center">{{ $doctor->speciality->title }}</td>
                                    <td class="text-center">
                                        @php
                                            $countOfDoctorRoles = $doctor->doctorRoles->count();
                                            $counter = 1;
                                        @endphp
                                        @foreach ($doctor->doctorRoles as $doctorRole)
                                            <span> {{ $doctorRole->title }} </span>
                                            @if ($counter < $countOfDoctorRoles)
                                                <span> - </span>
                                            @endif
                                            @php $counter++; @endphp
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $doctor->medical_number  }}</td>
                                    <td class="text-center">
                                        @if ($doctor->status == "1")
                                            <span class='badge badge-success'> فعال </span>
                                        @else
                                            <span class='badge badge-danger'> غیر غعال </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="ml-2 d-flex justify-content-center align-items-baseline">
                                            @php $id = $doctor->id @endphp
                                            <a href="{{ route('admin.doctors.edit', $id) }}">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-warning ml-1 small">
                                                        <i class="fe fe-edit text-white"></i>
                                                    </button>
                                                </div>
                                            </a>
                                            @php $id = $doctor->id @endphp
                                            <a href="{{ route('admin.doctors.show', $id) }}">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary ml-1 small">
                                                        <i class="fe fe-eye text-white"></i>
                                                    </button>
                                                </div>
                                            </a>

                                            <button class="btn btn-danger"
                                                    onclick="confirmDelete('delete-{{ $doctor->id }}')"><i
                                                    class="fa fa-trash text-white small"></i></button>
                                            <form action="{{ route('admin.doctors.destroy', $doctor) }}"
                                                  method="post"
                                                  id="delete-{{ $doctor->id }}" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <div class="text-center">
                                            <span class="text-danger">هیچ داده ای یافت نشد</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
