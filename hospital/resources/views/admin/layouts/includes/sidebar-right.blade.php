<!--/Sidebar-right-->
<div class="sidebar sidebar-right sidebar-animate">
    <div class="card-header border-bottom pb-5">
        <h4 class="card-title">اعلان ها </h4>
        <div class="card-options">
            <a href="#" class="btn btn-sm btn-icon btn-light text-primary" data-toggle="sidebar-right"
               data-target=".sidebar-right"><i class="feather feather-x"></i> </a>
        </div>
    </div>
    <div class="">
        <div class="list-group-item  align-items-center border-0">
            <div class="d-flex">
                <span class="avatar avatar-lg brround mr-3"
                      style="background-image: url(../../assets/images/users/4.jpg)"></span>
                <div class="mt-1">
                    <a href="" class="font-weight-semibold fs-16"><span
                            class="text-muted font-weight-normal"></span></a>
                    <span class="clearfix"></span>
                    @foreach ($notifications as $notify)
                        @if($notify->viewed_at === null)
                            <div class="list-group-item  align-items-center border-0">
                                <div class="d-flex">
                                    <div class="mt-1">
                                        <a href="{{route('admin.notifications.show',$notify->id)}}"
                                           class="font-weight-semibold fs-16"> {{$notify->title}} <span
                                                class="text-muted font-weight-normal"> {{Str::limit($notify->body,17,'')}} </span></a>
                                        <span class="clearfix"></span>
                                        <span
                                            class="text-muted fs-13 ml-auto">{{$notify->created_at->diffForHumans()}}<i
                                                class="mdi mdi-clock text-muted mr-1"></i></span>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{route('admin.notifications.show',$notify->id)}}"
                                           class="mr-0 option-dots" data-toggle="dropdown" role="button"
                                           aria-haspopup="true" aria-expanded="false">
                                            <span class="feather feather-more-horizontal"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                            <li><a href="#"><i class="feather feather-eye ml-2"></i>View</a></li>
                                            <li><a href="#"><i class="feather feather-plus-circle ml-2"></i>Add</a></li>
                                            <li><a href="#"><i class="feather feather-trash-2 ml-2"></i>Remove</a></li>
                                            <li><a href="#"><i class="feather feather-settings ml-2"></i>More</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
