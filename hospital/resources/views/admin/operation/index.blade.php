@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a href="">عمل ها</a></li>
            </ol>
        </div>
        @include('admin.operation.includes.filter')
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <a href="{{ route('admin.operations.create')}}" class="btn btn-info btn-group-sm"> ثبت عمل جدید <i class="fe feather-plus"></i></a></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                        <thead class="text-white text-center" style="background-color: #8686ac">
                        <tr>
                            <th class="text-white">ردیف</th>
                            <th class="text-white">نام عمل</th>
                            <th class="text-white">قیمت (تومان)</th>
                            <th class="text-white">تاریخ ثبت</th>
                            <th class="text-white">وضعیت</th>
                            <th class="text-white">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="text-center btn-light">
                        @php $counter = 1; @endphp
                        @forelse ($operations as $operation)
                            <tr>
                                <td class="text-center">{{ $counter }}</td>
                                <td class="text-center">{{ $operation->name }}</td>
                                <td class="text-center">{{ number_format($operation->price) }}</td>
                                <td class="text-center">{{verta($operation->created_at)->format('Y/m/d')}}</td>
                                <td class="text-center">
                                    @if ($operation->status == "1")
                                        <span class='badge badge-success'> فعال </span>
                                    @else
                                        <span class='badge badge-danger'> غیر غعال </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="ml-2 d-flex justify-content-center align-items-baseline">
                                        @php $id = $operation->id @endphp
                                        <a href="{{ route('admin.operations.edit', $id) }}">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning ml-1 small">
                                                    <i class="fe fe-edit text-white"></i>
                                                </button>
                                            </div>
                                        </a>

                                        <button class="btn btn-danger"
                                                onclick="confirmDelete('delete-{{ $operation->id }}')"><i
                                                class="fa fa-trash text-white small"></i></button>
                                        <form action="{{ route('admin.operations.destroy', $operation) }}"
                                              method="post"
                                              id="delete-{{ $operation->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @php $counter++; @endphp
                        @empty
                            <tr>
                                <td colspan="7">
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
        @endsection
