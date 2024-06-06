@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a href="">بیمه</a></li>
            </ol>
            @include('admin.insurance.includes.filter')
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.insurances.create')}}" class="btn btn-info btn-group-sm"> ثبت بیمه
                        جدید <i class="fe feather-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                            <thead class="text-white text-center" style="background-color: #8686ac">
                            <tr>
                                <th class="text-white">ردیف</th>
                                <th class="text-white">#</th>
                                <th class="text-white">نام بیمه</th>
                                <th class="text-white">نوع بیمه</th>
                                <th class="text-white">تخفیف</th>
                                <th class="text-white">وضعیت</th>
                                <th class="text-white">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="text-center btn-light">
                            @php $counter = 0; @endphp
                            @foreach ($insurances as $insurance)
                                @php $counter++; @endphp
                                <tr>
                                    <td class="text-center">{{ $counter }}</td>
                                    <td>{{$insurance->id}}</td>
                                    <td>{{$insurance->name}}</td>
                                    @if($insurance->type == 'basic')
                                        <td>پایه</td>
                                    @else
                                        <td>تکمیلی</td>
                                    @endif
                                    <td>{{$insurance->discount}}</td>
                                    <td>
                                        @if($insurance->status == 1)
                                            <span class="badge badge-success" style="width: 50px!important;">فعال</span>
                                        @else
                                            <span class="badge badge-danger">غیر فعال</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="ml-2 d-flex justify-content-center align-items-baseline">
                                            @php $id = $insurance->id @endphp
                                            <a href="{{ route('admin.insurances.edit', $id) }}">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-warning ml-1 small">
                                                        <i class="fe fe-edit text-white"></i>
                                                    </button>
                                                </div>
                                            </a>
                                            <button class="btn btn-danger"
                                                    onclick="confirmDelete('delete-{{ $insurance->id }}')"><i
                                                    class="fa fa-trash text-white small"></i></button>
                                            <form action="{{ route('admin.insurances.destroy', $insurance) }}"
                                                  method="post"
                                                  id="delete-{{ $insurance->id }}" style="display: none">
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

