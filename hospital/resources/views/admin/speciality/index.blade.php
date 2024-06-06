@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
            <li class="breadcrumb-item1"><a href="">تخصص ها</a></li>
        </ol>
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <a href="{{ route('admin.specialities.create')}}" class="btn btn-info btn-group-sm"> ثبت تخصص جدید <i class="fe feather-plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                        <thead class="text-white text-center" style="background-color: #8686ac">
                        <tr>
                            <th class="text-white">ردیف</th>
                            <th class="text-white">#</th>
                            <th class="text-white">تخصص</th>
                            <th class="text-white">وضعیت</th>
                            <th class="text-white">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="text-center btn-light">
                        @php $counter = 0; @endphp
                        @foreach ($specialities as $speciality)
                            @php $counter++; @endphp
                            <tr>
                                <td class="text-center">{{ $counter }}</td>
                                <td>{{$speciality->id}}</td>
                                <td>{{$speciality->title}}</td>
                                <td>
                                    @if($speciality->status == 1)
                                        <span class="badge badge-success" style="width: 50px!important;">فعال</span>
                                    @else
                                        <span class="badge badge-danger">غیر فعال</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="ml-2 d-flex justify-content-center align-items-baseline">
                                        @php $id = $speciality->id @endphp
                                        <a href="{{ route('admin.specialities.edit', $id) }}">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning ml-1 small">
                                                    <i class="fe fe-edit text-white"></i>
                                                </button>
                                            </div>
                                        </a>

                                        <button class="btn btn-danger"
                                                onclick="confirmDelete('delete-{{ $speciality->id }}')"><i
                                                class="fa fa-trash text-white small"></i></button>
                                        <form action="{{ route('admin.specialities.destroy', $speciality) }}"
                                              method="post"
                                              id="delete-{{ $speciality->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection

