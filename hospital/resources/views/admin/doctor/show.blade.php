@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a href=""> مشاهده مشخصات پزشک</a></li>
            </ol>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter table-bordered border-bottom">
                        <thead class="text-white text-center" style="background-color: #8686ac">
                        <tr>
                            <th class="text-white">ردیف</th>
                            <th class="text-white">#</th>
                            <th class="text-white">نام پزشک</th>
                            <th class="text-white">تخصص</th>
                            <th class="text-white"> شماره ملی</th>
                            <th class="text-white">شماره نظام پزشکی</th>
                            <th class="text-white">موبایل</th>
                            <th class="text-white">ایمیل</th>
                            <th class="text-white">پسورد</th>
                            <th class="text-white">وضعیت</th>
                            <th class="text-white">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="text-center btn-light">
                        @php $counter = 0; @endphp
                        @foreach ($doctors as $doctor)
                            @php $counter++; @endphp
                            <tr>
                                <td class="text-center">{{ $counter }}</td>
                                <td>{{$doctor->id}}</td>
                                <td>{{$doctor->name}}</td>
                                <td>{{$doctor->speciality_id}}</td>
                                <td>{{$doctor->national_code}}</td>
                                <td>{{$doctor->medical_number}}</td>
                                <td>{{$doctor->mobile}}</td>
                                <td>{{$doctor->email}}</td>
                                <td>{{\Illuminate\Support\Str::limit($doctor->password,20)}}</td>
                                <td>
                                    @if($doctor->status == 1)
                                        <span class="badge badge-success" style="width: 50px!important;">فعال</span>
                                    @else
                                        <span class="badge badge-danger">غیر فعال</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="ml-2 d-flex justify-content-center align-items-baseline">
                                        @php $id = $doctor->id @endphp
                                        <a href="{{ route('admin.doctors.edit', $id) }}">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning ml-1 small">
                                                    <i class="fe fe-edit text-white"></i>
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
                        @endforeach
                        </tbody>
                    </table>
                    {{--                {{ $categories->onEachSide(1)->links("vendor.pagination.bootstrap-4") }}--}}
                </div>
            </div>
        </div>
@endsection

