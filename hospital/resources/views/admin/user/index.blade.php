@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
            <li class="breadcrumb-item1 active"><a href="">کاربران</a></li>
        </ol>
        @include('includes._errors')
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <a href="{{ route('admin.users.create')}}" class="btn btn-info btn-group-sm">ثبت ادمین جدید  <i class="fe feather-plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                        <thead class="text-white text-center" style="background-color: #8686ac">
                        <tr>
                            <th class="text-white">ردیف</th>
{{--                            <th class="text-white">#</th>--}}
                            <th class="text-white">نام و نام خانوادگی</th>
                            <th class="text-white">شماره تلفن</th>
                            <th class="text-white">آدرس ایمیل</th>
                            <th class="text-white">تاریخ ثبت</th>
{{--                            <th class="text-white">وضعیت </th>--}}
                            <th class="text-white">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="text-center btn-light">
                        @php $counter = 0; @endphp
                        @foreach ($users as $user)
                            @php $counter++; @endphp
                            <tr>
                                <td class="text-center">{{ $counter }}</td>
{{--                                <td>{{$user->id}}</td>--}}
                                <td>{{$user->name}}</td>
                                <td>{{$user->mobile}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{verta($user->created_at)->format('Y/m/d')}}</td>
                                <td>
                                    <div class="ml-2 d-flex justify-content-center align-items-baseline">
                                    @php $id = $user->id @endphp
                                    <a href="{{ route('admin.users.edit', $id) }}">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning ml-1 small">
                                                <i class="fe fe-edit text-white"></i>
                                            </button>
                                        </div>
                                    </a>

                                    <button class="btn btn-danger"
                                            onclick="confirmDelete('delete-{{ $user->id }}')"><i
                                            class="fa fa-trash text-white small"></i></button>
                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                          method="post"
                                          id="delete-{{ $user->id }}" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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

