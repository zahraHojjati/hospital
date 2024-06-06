@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
{{--                <li class="breadcrumb-item1 active"><a style="color: #036262">اعلان شماره : {{$notifications->id}}</a>--}}
{{--                </li>--}}
            </ol>
        </div>
        <div class="card-header border-0 justify-content-between ">
            <div class="d-flex">
                <p class="card-title ml-2" style="font-weight: bolder;">لیست اعلان ها</p>
                <span class="fs-15 ">({{ $notificationsCount }})</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter text-nowrap table-bordered border-bottom">
                <thead class="text-white text-center" style="background-color: #8686ac">
                <tr>
                    <th class="text-white text-center border-top">ردیف</th>
                    <th class="text-white text-center border-top">شناسه</th>
                    <th class="text-white text-center border-top"> عنوان</th>
                    <th class="text-white text-center border-top"> متن </th>
                    <th class="text-white text-center border-top"> وضعیت</th>
                    <th class="text-white text-center border-top"> تاریخ </th>
                </tr>
                </thead>
                <tbody>
                @php $counter = 0; @endphp
                @foreach ($notifications as $notification)
                    @php $counter++; @endphp
                    <tr>
                        <td class="text-center">{{ $counter }}</td>
                        <td class="text-center">{{ $notification->id}}</td>
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
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


