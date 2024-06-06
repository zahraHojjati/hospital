<div class="app-header header">
    <div class="container-fluid">
        <div class="d-flex">
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#">
                    <i class="feather feather-menu"></i>
                </a>
                <a class="close-toggle" href="#">
                    <i class="feather feather-x"></i>
                </a>
            </div>
            <div class="d-flex order-lg-2 my-auto mr-auto">
                <div class="dropdown header-fullscreen">
                    <div class="dropdown header-message">
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow  animated">
                            <div class="header-dropdown-list message-menu" id="message-menu">
                                <a class="dropdown-item border-bottom" href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                         <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="{{asset('assets/images/users/1.jpg')}}"></span>
                                        </div>
                                    </div>
                                </a>

                                <a class="dropdown-item border-bottom" href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                        <span class="avatar avatar-md brround align-self-center cover-image"  data-image-src="{{asset('assets/images/users/4.jpg')}}"></span>
                                        </div>
                                    </div>

                                    <a class="dropdown-item border-bottom" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                            <span class="avatar avatar-md brround align-self-center cover-image"  data-image-src="{{asset('assets/images/users/6.jpg')}}"></span>
                                            </div>
                                            <div class="d-flex">
                                                <div class="pl-3">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex order-lg-2 my-auto mr-auto">
                        <a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#"
                           data-toggle="search">
                            <i class="feather feather-search search-icon header-icon"></i>
                        </a>
                        <div class="dropdown header-notify">
                            <a class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
                                <i class="feather feather-bell header-icon"></i>
                                @php
                                $notifications=\App\Models\Notification::query()
                                ->where('viewed_at','=',null)
                                ->get();
                                $notificationCount=$notifications->count();
                                @endphp
                                @if($notificationCount !=0)
                                    <span class="badge badge-danger side-badge">{{$notificationCount}}</span>
                                @endif
                            </a>
                        </div>
                        <div class="dropdown header-flags">
                            <a class="nav-link icon" data-toggle="dropdown">
                                <img
                                    src="{{asset('assets/images/flags/flag-png/—Pngtree—iran flag pin badge_8678881.png')}}"
                                    class="h-24" alt="img">
                            </a>
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow animated">

                            </div>
                        </div>
                        <div class="dropdown header-fullscreen">
                            <a class="nav-link icon full-screen-link">
                                <i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
                                <i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
                            </a>
                        </div>
                        <div class="dropdown header-message">
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow  animated">
                                <div class="header-dropdown-list message-menu" id="message-menu">
                                    <a class="dropdown-item border-bottom" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                            <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="../../assets/images/users/1.jpg"  style="background: url(&quot;../../assets/images/users/1.jpg&quot;) center center;"></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown profile-dropdown">
                    <a href="#" class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
												<span>
													<img src="{{asset('assets/images/users/16.jpg')}}" alt="img"
                                                         class="avatar avatar-md bradius">
												</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow animated">
                        <div class="p-3 text-center border-bottom">
                            <a href="#" class="text-center user pb-0 font-weight-bold"> هاشم مقدری</a>
                            <p class="text-center user-semi-title">برنامه نویس</p>
                        </div>
                        <a class="dropdown-item d-flex" href="{{--route('admin.profile.index')--}}">
                            <i class="feather feather-user ml-3 fs-16 my-auto"></i>
                            <div class="mt-1">مشخصات</div>
                        </a>
                        <a class="dropdown-item d-flex" href="{{--route('admin.setting.index')--}}">
                            <i class="feather feather-settings ml-3 fs-16 my-auto"></i>
                            <div class="mt-1">تنظیمات</div>
                        </a>
                        <a class="dropdown-item d-flex" href="#">
                            <i class="feather feather-mail ml-3 fs-16 my-auto"></i>
                            <div class="mt-1">پیام</div>
                        </a>
                        <a class="dropdown-item d-flex" href="#" data-toggle="modal"
                           data-target="#changepasswordnmodal">
                            <i class="feather feather-edit-2 ml-3 fs-16 my-auto"></i>
                            <div class="mt-1">تغییر کلمه عبور</div>
                        </a>
                        <form action="{{--route('admin.logout')--}}" method="POST">
                            @csrf
                            <button type="submit" name="logout" class="dropdown-item d-flex"
                                    data-toggle="slide">
                                    <i class="feather feather-log-out ml-3 fs-16 my-auto"></i>
                                    <div class="mt-1" style="margin-right: 3%">خروج</div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

