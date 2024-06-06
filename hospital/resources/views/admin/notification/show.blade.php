@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a style="color: #036262">اعلان شماره : {{$notification->id}}</a>
                </li>
            </ol>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                <thead class="text-white text-center" style="background-color: #8686ac">
                <tr>
                    <th class="text-center border-top">
                        <input type="checkbox" id="headerCheckbox">
                    </th>
                    <th class="text-white text-center border-top">شناسه</th>
                    <th class="text-white text-center border-top"> عنوان</th>
                    <th class="text-white text-center border-top">متن</th>
                    <th class="text-white text-center border-top"> بازدید</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $notification->id }}</td>
                        <td class="text-center">{{ $notification->title}}</td>
                        <td class="text-center">{{ $notification->body}}</td>
                        @if($notification->viewed_at == null)
                            <td class="text-center"><span class="badge-danger">مشاهده نشده</span></td>
                        @else
                            <td class="text-center"><span class="badge-success">مشاهده شده </span></td>
                        @endif
                        @if($notification->viewed_at != null)
                            <td class="text-center">{{verta($notification->viewed_at)->format('Y/m/d')}}</td>
                        @endif
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

