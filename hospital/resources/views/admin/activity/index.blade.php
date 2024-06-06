@extends('admin.layouts.master-admin')
@section('content')
    <div class="col-12 mt-5 justify-content-center">
        <div class="card-body">
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1"><a href="{{route('admin.dashboard.index')}}">داشبورد</a></li>
                <li class="breadcrumb-item1 active"><a href="">لیست فعالیتها</a></li>
            </ol>
            <div class="card">
                <div class="card-header border-0 justify-content-between">
                    <div class="d-flex">
                        <p class="card-title ml-2" style="font-weight: bolder">لیست فعالیتها : </p>
                        <span class="fs-15">{{$logsCount}}</span>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($logs as $log)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{$log->description}}</span>
                                <span>{{$log->created_at->diffForHumans()}}</span>
                            </li>
                        @endforeach
                    </ul>
{{--                    {{$logs->onEachSide(1)->links('vendor.pagination.bootstrap-4')}}--}}
                </div>
                </div>
            </div>
        </div>
@endsection
