{{--@php $user = auth()->user(); @endphp--}}
<aside class="app-sidebar" style="background-color: #3d455a">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{route('admin.dashboard.index')}}">
            <img src="{{ asset('assets/images/logo/logo3.png') }}" class="header-brand-img dark-logo"
                 alt="HospitalLogo" style="width: 130px;height: 70px">
            {{--                <img src="{{ storage_path('storage/images/settings/logo'.$logo) }}" class="header-brand-img dark-logo"--}}
            {{--                     alt="HospitalLogo" style="width: 130px;height: 70px">--}}
        </a>

    </div>
    <div class="app-sidebar3">
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
                <div class="user-pic">
                    <a href="{{--route('admin.profile.index')--}}"><img class="avatar-xxl rounded-circle mb-1"
                                                                        src={{asset('assets/images/users/hospital.jpg')}} ></a>

                </div>
                <div class="user-info">
                    <h5 class=" mb-2" style="font-family:'2  Koodak'">مرکز جراحی </h5>
                    <span class="text-muted app-sidebar__user-name text-sm"> پنل مدیریت </span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category mt-4">داشبورد</li>
            <li class="slide">
            <li><a href="{{route('admin.dashboard.index')}}" class="slide-item"><i
                        class="feather feather-home sidemenu_icon"></i> داشبورد </a></li>

            @can('view users')
                {{--            @if($user->can('view users') || $user->can('create users') || $user->can('update users') || $user->can('delete users'))--}}
                <li><a href="{{route('admin.users.index')}}" class="slide-item"><i class="feather feather-users"></i>
                        لیست کاربران </a></li>
            @endcan
            {{--            @endif--}}

            @can('view operations')
                {{--            @if($user->can('view operations') || $user->can('create operations') || $user->can('update operations') || $user->can('delete operations'))--}}
                <li><a href="{{route('admin.operations.index')}}" class="slide-item"><i
                            class="feather feather-book sidemenu_icon"></i> لیست عمل ها</a></li>
            @endcan
            {{--            @endif--}}

            @can('view doctors')
                {{--            @if($user->can('view doctors') || $user->can('create doctors') || $user->can('update doctors') || $user->can('delete doctors'))--}}
                <li><a href="{{route('admin.doctors.index')}}" class="slide-item"><i
                            class="feather feather-user-check"></i> پزشکان </a></li>
            @endcan
            {{--            @endif--}}

            @can('view doctor_roles')
                <li><a href="{{route('admin.doctorRoles.index')}}" class="slide-item"><i
                            class="feather feather-user"></i> نقش پزشکان </a></li>
            @endcan

            @can('view specialities')
                <li><a href="{{route('admin.specialities.index')}}" class="slide-item"><i
                            class="feather feather-list"></i> لیست تخصص ها </a></li>
            @endcan

            @can('view insurances')
                {{--            @if($user->can('view insurances') || $user->can('create insurances') || $user->can('update insurances') || $user->can('delete insurances'))--}}
                <li><a href="{{route('admin.insurances.index')}}" class="slide-item"><i
                            class="feather feather-bookmark"></i> بیمه </a></li>
            @endcan
            {{--            @endif--}}


            @can('view surgeries')
                {{--            @if($user->can('view surgeries') || $user->can('create surgeries') || $user->can('update surgeries') || $user->can('delete surgeries'))--}}
                <li><a href="{{route('admin.surgeries.index')}}" class="slide-item"><i
                            class="feather feather-alert-triangle"></i> لیست جراحی</a></li>
            @endcan
            {{--            @endif--}}


            @can('view logs')
                <li><a href="{{route('admin.LogActivity.index')}}" class="slide-item"><i
                            class="feather feather-bell"></i> لیست فعالبتها </a></li>
            @endcan

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="feather feather-clipboard sidemenu_icon"></i>
                    <span class="side-menu__label">پرداخت </span><i class="angle fa fa-angle-left"></i>
                </a>
                <ul class="slide-menu">
                    <li><a href="{{route('admin.paymentDoctor.index')}}" class="slide-item"><i
                                class="icon feather feather-dollar-sign"></i> پرداخت به دکتر </a></li>

                    @can('view invoices')
                        {{--                    @if($user->can('view invoices') || $user->can('update invoices') || $user->can('delete invoices'))--}}
                        <li><a href="{{route('admin.invoices.index')}}" class="slide-item"><i
                                    class="icon feather feather-inbox"></i> صورتحساب دکتر </a></li>
                    @endcan
                    {{--                    @endif--}}

                    @can('view payments')
                        {{--                    @if($user->can('view payments') || $user->can('update payments') || $user->can('delete payments'))--}}
                        <li><a href="{{route('admin.payments.index')}}" class="slide-item"><i
                                    class="icon feather feather-inbox"></i> تسویه حساب با دکتر </a></li>
                    @endcan
                    {{--                    @endif--}}
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="feather feather-clipboard sidemenu_icon"></i>
                    <span class="side-menu__label">گزارشات  </span><i class="angle fa fa-angle-left"></i>
                </a>
                <ul class="slide-menu">
                    <li><a href="{{route('admin.doctorReports.index')}}" class="slide-item"><i
                                class="icon feather feather-dollar-sign"></i> گزارش مالی پزشکان </a></li>
                    <li><a href="{{route('admin.insuranceReports.index')}}" class="slide-item"><i
                                class="icon feather feather-dollar-sign"></i> گزارش بیمه بیمار </a></li>
                </ul>
            </li>

            @can('view setting groups')
                {{--            @if($user->can('view settings') || $user->can('update settings'))--}}
                <li><a href="{{route('admin.settings.index')}}" class="slide-item"><i class="icon icon-settings"></i>تنظیمات
                    </a></li>
            @endcan
            {{--            @endif--}}


            @can('view notifications')
                <li><a href="{{route('admin.notifications.index')}}" class="slide-item"><i
                            class="feather feather-bell"></i>اعلان ها </a></li>
            @endcan

            <li class="slide ">
                <form action="{{route('admin.logout')}}" method="POST">
                    @csrf
                    <button type="submit" name="logout" class="dropdown-item d-flex" data-toggle="slide">
                        <i class="icon icon-logout"></i>
                        <span style="color: white"> خروج </span></a>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
