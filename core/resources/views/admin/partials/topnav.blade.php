<!-- navbar-wrapper start -->
<nav class="navbar-wrapper bg--dark d-print-none" style="position:sticky;top:0;z-index:9">
    <div class="navbar__left">
        <button class="res-sidebar-open-btn me-3" type="button"><i class="las la-bars"></i></button>
        <form class="navbar-search">
            <input autocomplete="off" class="navbar-search-field" id="searchInput" name="#0" placeholder="@lang('Search here...')" type="search">
            <i class="las la-search"></i>
            <ul class="search-list"></ul>
        </form>
        @php
            $accommodations = \App\Models\Accommodation::distinct()->get();
        @endphp
        <form class="mx-10" id="change_accommodation" method="post" action="{{ route('admin.change_accommodation') }}">
            @csrf
            <!--<label for="accommodation">{{ __('Accommodation')}}<span class="text-red">*</span></label>-->
            <select onchange="$('#change_accommodation').submit();" name="admin_accommodation_id" id="admin_accommodation_id" class="form-select">
                <option value="" selected>All Accommodations</option>
                    @isset($accommodations)
                        @foreach ($accommodations as $accommodation)
                            @if($accommodation->name <> '')
                            <option {{ auth()->guard('admin')->user()->accommodation_id == $accommodation->id ? 'selected' : ''  }} value="{{$accommodation->id}}">{{$accommodation->name}}</option>
                            @endif
                        @endforeach
                    @endisset
            </select>
        </form>
        
        
    </div>
    <div class="navbar__right">
        <ul class="navbar__action-list">
                

            @can(['admin.notification.read', 'admin.notifications'])
                <li class="dropdown">
                    <button aria-expanded="false" aria-haspopup="true" class="primary--layer" data-bs-toggle="dropdown" data-display="static" type="button" class="position-relative">
                        <i class="las la-bell text--primary @if ($adminNotificationCount > 0) icon-left-right @endif"></i>
                        <span class="position-absolute top-0 start-5 @if($adminNotificationCount > 0) icon-left-right @endif text-dark bg-white rounded-circle" style="width: 15px; left:1px; font-size:10px">{{ $adminNotificationCount }}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--md p-0 border-0 box--shadow1 dropdown-menu-right">
                        <div class="dropdown-menu__header">
                            <span class="caption">@lang('Notification')</span>
                            @if ($adminNotificationCount > 0)
                                <p>@lang('You have') {{ $adminNotificationCount }} @lang('unread notification')</p>
                            @else
                                <p>@lang('No unread notification found')</p>
                            @endif
                        </div>
                        <div class="dropdown-menu__body">
                            @foreach ($adminNotifications as $notification)
                                <a class="dropdown-menu__item" href="@if (can('admin.notification.read')) {{ route('admin.notification.read', $notification->id) }} @else javascript:void(0) @endif">
                                    <div class="navbar-notifi">
                                        <div class="navbar-notifi__right">
                                            <h6 class="notifi__title">{{ __($notification->title) }}</h6>
                                            <span class="time"><i class="far fa-clock"></i>
                                                {{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        @can('admin.notifications')
                            <div class="dropdown-menu__footer">
                                <a class="view-all-message" href="{{ route('admin.notifications') }}">@lang('View all notification')</a>
                            </div>
                        @endcan
                    </div>
                </li>
            @endcan

            <li class="dropdown">
                <button aria-expanded="false" aria-haspopup="true" class="" data-bs-toggle="dropdown" data-display="static" type="button">
                    <span class="navbar-user">
                        <span class="navbar-user__thumb"><img alt="image" src="{{ getImage('assets/admin/images/profile/' .auth()->guard('admin')->user()->image) }}"></span>
                        <span class="navbar-user__info">
                            <span class="navbar-user__name">{{ auth()->guard('admin')->user()->username }}</span>
                        </span>
                        <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2" href="{{ route('admin.profile') }}">
                        <i class="dropdown-menu__icon las la-user-circle"></i>
                        <span class="dropdown-menu__caption">@lang('Profile')</span>
                    </a>

                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2" href="{{ route('admin.password') }}">
                        <i class="dropdown-menu__icon las la-key"></i>
                        <span class="dropdown-menu__caption">@lang('Password')</span>
                    </a>

                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2" href="{{ route('admin.logout') }}">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->
