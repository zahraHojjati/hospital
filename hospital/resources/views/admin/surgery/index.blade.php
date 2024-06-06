@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a href="">جراحی</a></li>
            </ol>
            @include('admin.surgery.includes.filter')
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.surgeries.create')}}" class="btn btn-info btn-group-sm"> ثبت جراحی جدید <i
                                class="fe feather-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                            <thead class="text-white text-center" style="background-color: #8686ac">
                            <tr>
                                <th class="text-white">ردیف</th>
                                <th class="text-white">#</th>
                                <th class="text-white">نام و نام خانوادگی بیمار</th>
                                <th class="text-white">کد ملی  بیمار</th>
                                <th class="text-white">دکترها</th>
                                <th class="text-white">عمل (ها)</th>
                                <th class="text-white">تاریخ عمل</th>
                                <th class="text-white">تاریخ ترخیص</th>
                                <th class="text-white">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="text-center btn-light">
                            @php $counter = 0; @endphp
                            @foreach($surgeries as $surgery)
                                @php $counter++; @endphp
                                <tr>
                                    <td class="text-center">{{ $counter }}</td>
                                    <td>{{ $surgery->id }}</td>
                                    <td>{{ $surgery->patient_name }}</td>
                                    <td>{{ $surgery->patient_national_code }}</td>
                                    <td>
                                        {{ implode(', ', $surgery->doctors->pluck('name')->all()) }}
                                    </td>
                                    <td>
                                        {{ implode(', ', $surgery->operations->pluck('name')->all()) }}
                                    </td>
                                    <td>{{verta($surgery->surgeried_at)->format('Y/m/d')}}</td>
                                    <td>{{verta($surgery->released_at)->format('Y/m/d')}}</td>
                                    <td>
                                        <a href="{{route('admin.surgeries.show',$surgery->id)}}" class="btn btn-primary ml-1">
                                            <i class="feather feather-eye " data-toggle="tooltip" data-placement="top" title="نمایش"></i>
                                        </a>

                                        <a href="{{ route('admin.surgeries.edit', $surgery->id) }}"
                                           class="btn btn-warning"><i class="fe fe-edit text-white"></i></a>

                                        <button class="btn btn-danger"
                                                onclick="confirmDelete('delete-{{ $surgery->id }}')"><i
                                                    class="fa fa-trash text-white small"></i></button>
                                        <form action="{{ route('admin.surgeries.destroy', $surgery->id) }}"
                                              method="post"
                                              id="delete-surgery-{{ $surgery->id}}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        {{--                                        <a href="#" class="btn btn-danger" onclick="event.preventDefault();--}}
                                        {{--                                                     document.getElementById('delete-surgery-{{ $surgery->id }}').submit();">حذف</a>--}}
                                        {{--                                        <form id="delete-surgery-{{ $surgery->id }}" action="{{ route('admin.surgeries.destroy', $surgery->id) }}" method="POST" style="display: none;">--}}
                                        {{--                                            @csrf--}}
                                        {{--                                            @method('DELETE')--}}
                                        {{--                                        </form>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection

