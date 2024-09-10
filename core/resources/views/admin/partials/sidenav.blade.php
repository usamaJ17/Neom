<div class="sidebar bg--dark"">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a class="sidebar__main-logo" href="{{ route('admin.dashboard') }}"><img alt="@lang('image')" src="{{ getImage(getFilePath('logoIcon') . '/logo_dark.png') }}"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                @can('admin.dashboard')
                    <li class="sidebar-menu-item {{ menuActive('admin.dashboard') }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="menu-icon las la-home"></i>
                            <span class="menu-title">@lang('Dashboard')</span>
                        </a>
                    </li>
                @endcan

                @can(['admin.hotel.*'])
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a class="{{ menuActive('admin.hotel*', 3) }}" href="javascript:void(0)">
                            <i class="menu-icon las la-city"></i>
                            <span class="menu-title" style="font-size: 0.65rem !important;">Manage Accommodation</span>
                        </a>
                        <div class="sidebar-submenu {{ menuActive('admin.hotel*', 2) }}">
                            <ul>
                                @can('admin.hotel.accommodations.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.accommodations.*') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.accommodations.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Accommodation')</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.hotel.amenity.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.amenity.all') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.amenity.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Amenities')</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('admin.hotel.complement.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.complement.all') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.complement.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Complements')</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('admin.hotel.room.type.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.room.type.*') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.room.type.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Room Types')</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                 @can('admin.hotel.room-item.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.room-item.all*') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.room-item.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Room Items')</span>
                                        </a>
                                    </li>
                                @endcan
                                

                                @can('admin.hotel.bed.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.bed.all') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.bed.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Room')</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('admin.hotel.accessories.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.accessories.all') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.accessories.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Bed Accessories')</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                 @can('admin.hotel.bed.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.newbed.all') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.newbed.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Bed Type')</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('admin.hotel.room.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.room.all*') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.room.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Bed')</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.room.getVacantRoom') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.room.getVacantRoom') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Vacant Bed')</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                 <li class="sidebar-menu-item {{ menuActive('admin.hotel.room.status.*') }}">
                                    <a class="nav-link" href="{{ route('admin.hotel.room.status.list') }}">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Bed Status')</span>
                                    </a>
                                </li>
                            
                                
                                @can('admin.hotel.room.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.roomKey.all*') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.roomKey.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Bed Key')</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('admin.hotel.extra_services.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.extra_services.*') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.extra_services.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Extra Services')</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                     <li class="sidebar__menu-header">@lang('Inspection')</li>
                         @can('admin.hotel.room-item.inspection')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.room-item.inspection*') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.room-item.inspection') }}">
                                            <i class="menu-icon las la-search transform-180"></i>
                                            <span class="menu-title">@lang('Room Items Inspection')</span>
                                        </a>
                                    </li>
                                @endcan
                @endcan
                     <li class="sidebar-menu-item sidebar-dropdown">
                        <a class="{{ menuActive('admin.lostFounditem',3) }} {{ menuActive('admin.foundby',3) }} {{ menuActive('admin.handedOverBy',3) }} {{ menuActive('admin.handedOverto',3) }}" href="javascript:void(0)">
                            <i class="menu-icon las la-city"></i>
                            <span class="menu-title" style="font-size: 0.65rem !important;">Lost and found item</span>
                        </a>
                        <div class="sidebar-submenu {{ menuActive('admin.lostFounditem',2) }} {{ menuActive('admin.foundby',2) }} {{ menuActive('admin.handedOverBy',2) }} {{ menuActive('admin.handedOverto',2) }}">
                            <ul>
                               
                                    <li class="sidebar-menu-item {{ menuActive('admin.lostFounditem') }}">
                                        <a class="nav-link" href="{{ route('admin.lostFounditem') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">All Lost and found item </span>
                                        </a>
                                    </li>
                                   <li class="sidebar-menu-item {{ menuActive('admin.foundby') }}">
                                        <a class="nav-link" href="{{ route('admin.foundby') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">All Found By</span>
                                        </a>
                                    </li>
                                     <li class="sidebar-menu-item {{ menuActive('admin.handedOverBy') }}">
                                        <a class="nav-link" href="{{ route('admin.handedOverBy') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">All Handed Over By</span>
                                        </a>
                                    </li>
                                     <li class="sidebar-menu-item {{ menuActive('admin.handedOverto') }}">
                                        <a class="nav-link" href="{{ route('admin.handedOverto') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">All Handed Over To</span>
                                        </a>
                                    </li>
                              
                              
                            </ul>
                        </div>
                    </li>
                    
                     @can(['admin.booking.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive(['admin.booking.*'], 3) }}" href="javascript:void(0)">
                                <i class="menu-icon las la-list"></i>
                                <span class="menu-title">@lang('Manage Bookings')</span>
                                @if ($delayedCheckoutCount || $refundableBookingCount)
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>

                            <div class="sidebar-submenu {{ menuActive(['admin.booking.*'], 2) }}">
                                <ul>
                                    @can('admin.booking.todays.booked')
                                        <li class="sidebar-menu-item {{ menuActive('admin.booking.todays.booked') }}">
                                            <a class="nav-link" href="{{ route('admin.booking.todays.booked') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Todays Booked')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.booking.todays.checkin')
                                        <li class="sidebar-menu-item {{ menuActive('admin.booking.todays.checkin') }}">
                                            <a class="nav-link" href="{{ route('admin.booking.todays.checkin') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Todays Checkin')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.booking.todays.checkout')
                                        <li class="sidebar-menu-item {{ menuActive('admin.booking.todays.checkout') }}">
                                            <a class="nav-link" href="{{ route('admin.booking.todays.checkout') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Todays Checkout')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.booking.active')
                                        <li class="sidebar-menu-item {{ menuActive('admin.booking.active') }}">
                                            <a class="nav-link" href="{{ route('admin.booking.active') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Active Bookings')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.booking.checked.out.list')
                                        <li class="sidebar-menu-item {{ menuActive('admin.booking.checked.out.list') }}">
                                            <a class="nav-link" href="{{ route('admin.booking.checked.out.list') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Checked Out Bookings')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.booking.canceled.list')
                                        <li class="sidebar-menu-item {{ menuActive('admin.booking.canceled.list') }}">
                                            <a class="nav-link" href="{{ route('admin.booking.canceled.list') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Canceled Bookings')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    <!--@can('admin.booking.refundable')-->
                                    <!--    <li class="sidebar-menu-item {{ menuActive('admin.booking.refundable') }}">-->
                                    <!--        <a class="nav-link" href="{{ route('admin.booking.refundable') }}">-->
                                    <!--            <i class="menu-icon las la-dot-circle"></i>-->
                                    <!--            <span class="menu-title">@lang('Refundable Bookings')</span>-->
                                    <!--            @if ($refundableBookingCount)-->
                                    <!--                <span class="menu-badge pill bg--danger ms-auto">-->
                                    <!--                    {{ $refundableBookingCount }}-->
                                    <!--                </span>-->
                                    <!--            @endif-->
                                    <!--        </a>-->
                                    <!--    </li>-->
                                    <!--@endcan-->

                                    @can('admin.booking.checkout.delayed')
                                        <li class="sidebar-menu-item {{ menuActive('admin.booking.checkout.delayed') }}">
                                            <a class="nav-link" href="{{ route('admin.booking.checkout.delayed') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Delayed Checkout')</span>
                                                @if ($delayedCheckoutCount)
                                                    <span class="menu-badge pill bg--danger ms-auto">
                                                        {{ $delayedCheckoutCount }}
                                                    </span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.booking.all')
                                        <li class="sidebar-menu-item {{ menuActive('admin.booking.all') }}">
                                            <a class="nav-link" href="{{ route('admin.booking.all') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Bookings')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                    
                     
                @can(['admin.upcoming.booking.*', 'admin.book.room', 'admin.booking.*', 'admin.extra.service.*', 'admin.deposit.*', 'admin.delayed.booking.checkout', 'admin.pending.booking.checkin'])
                    <li class="sidebar__menu-header">@lang('Booking')</li>

                    @can('admin.delayed.booking.checkout')
                        <li class="sidebar-menu-item {{ menuActive('admin.delayed.booking.checkout') }}">
                            <a class="nav-link" href="{{ route('admin.delayed.booking.checkout') }}">
                                <i class="menu-icon las la-calendar-day"></i>
                                <span class="menu-title">@lang('Delayed Checkouts')</span>
                                @if ($delayedCheckoutCount)
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        {{ $delayedCheckoutCount }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endcan

                    @can('admin.pending.booking.checkin')
                        <li class="sidebar-menu-item {{ menuActive('admin.pending.booking.checkin') }}">
                            <a class="nav-link" href="{{ route('admin.pending.booking.checkin') }}">
                                <i class="menu-icon la la-spinner"></i>
                                <span class="menu-title">@lang('Pending Check-Ins')</span>
                                @if ($pendingCheckInsCount)
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        {{ $pendingCheckInsCount }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endcan

                    @can('admin.upcoming.booking.checkin')
                        <li class="sidebar-menu-item {{ menuActive('admin.upcoming.booking.checkin') }}">
                            <a class="nav-link" href="{{ route('admin.upcoming.booking.checkin') }}">
                                <i class="menu-icon la la-sign-in"></i>
                                <span class="menu-title">@lang('Upcoming Check-Ins')</span>
                            </a>
                        </li>
                    @endcan

                    @can('admin.upcoming.booking.checkout')
                        <li class="sidebar-menu-item {{ menuActive('admin.upcoming.booking.checkout') }}">
                            <a class="nav-link" href="{{ route('admin.upcoming.booking.checkout') }}">
                                <i class="menu-icon la la-sign-out transform-rotate-180"></i>
                                <span class="menu-title">@lang('Upcoming Checkouts')</span>
                            </a>
                        </li>
                    @endcan

                    @can('admin.book.room')
                        <li class="sidebar-menu-item {{ menuActive('admin.book.room') }}">
                            <a class="nav-link" href="{{ route('admin.book.room') }}">
                                <i class="menu-icon la la-hand-o-right"></i>
                                <span class="menu-title">@lang('Book Room')</span>
                            </a>
                        </li>
                    @endcan

                   

                    @can(['admin.extra.service.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.extra.service*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon las la-clipboard-list"></i>
                                <span class="menu-title">@lang('Extra Service') </span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.extra.service*', 2) }}">
                                <ul>
                                    @can('admin.extra.service.add')
                                        <li class="sidebar-menu-item {{ menuActive('admin.extra.service.add') }}">
                                            <a class="nav-link" href="{{ route('admin.extra.service.add') }}">
                                                <i class="menu-icon las la-plus-circle"></i>
                                                <span class="menu-title">@lang('Add Extra Service')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.extra.service.list')
                                        <li class="sidebar-menu-item {{ menuActive('admin.extra.service.list') }}">
                                            <a class="nav-link" href="{{ route('admin.extra.service.list') }}">
                                                <i class="menu-icon las la-list"></i>
                                                <span class="menu-title">@lang('Added Extra Services')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

{{--                    @can(['admin.deposit.*'])--}}
{{--                        <li class="sidebar-menu-item sidebar-dropdown">--}}
{{--                            <a class="{{ menuActive('admin.deposit*', 3) }}" href="javascript:void(0)">--}}
{{--                                <i class="menu-icon las la-file-invoice-dollar"></i>--}}
{{--                                <span class="menu-title">@lang('Online Payments')</span>--}}
{{--                                @if (0 < $pendingDepositsCount)--}}
{{--                                    <span class="menu-badge pill bg--danger ms-auto">--}}
{{--                                        <i class="fa fa-exclamation"></i>--}}
{{--                                    </span>--}}
{{--                                @endif--}}
{{--                            </a>--}}

{{--                            <div class="sidebar-submenu {{ menuActive('admin.deposit*', 2) }}">--}}
{{--                                <ul>--}}
{{--                                    @can('admin.deposit.pending')--}}
{{--                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.pending') }}">--}}
{{--                                            <a class="nav-link" href="{{ route('admin.deposit.pending') }}">--}}
{{--                                                <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                                <span class="menu-title">@lang('Pending Payments')</span>--}}
{{--                                                @if ($pendingDepositsCount)--}}
{{--                                                    <span class="menu-badge pill bg--danger ms-auto">{{ $pendingDepositsCount }}</span>--}}
{{--                                                @endif--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}

{{--                                    @can('admin.deposit.approved')--}}
{{--                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.approved') }}">--}}
{{--                                            <a class="nav-link" href="{{ route('admin.deposit.approved') }}">--}}
{{--                                                <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                                <span class="menu-title">@lang('Approved Payments')</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}

{{--                                    @can('admin.deposit.successful')--}}
{{--                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.successful') }}">--}}
{{--                                            <a class="nav-link" href="{{ route('admin.deposit.successful') }}">--}}
{{--                                                <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                                <span class="menu-title">@lang('Successful Payments')</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}

{{--                                    @can('admin.deposit.rejected')--}}
{{--                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.rejected') }}">--}}
{{--                                            <a class="nav-link" href="{{ route('admin.deposit.rejected') }}">--}}
{{--                                                <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                                <span class="menu-title">@lang('Rejected Payments')</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}

{{--                                    @can('admin.deposit.failed')--}}
{{--                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.failed') }}">--}}
{{--                                            <a class="nav-link" href="{{ route('admin.deposit.failed') }}">--}}
{{--                                                <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                                <span class="menu-title">@lang('Failed Payments')</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}

{{--                                    @can('admin.deposit.list')--}}
{{--                                        <li class="sidebar-menu-item {{ menuActive('admin.deposit.list') }}">--}}
{{--                                            <a class="nav-link" href="{{ route('admin.deposit.list') }}">--}}
{{--                                                <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                                <span class="menu-title">@lang('All Payments')</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
                @endcan

                @can(['admin.staff.*', 'admin.roles.*', 'admin.users.*', 'admin.subscriber.index'])
                    <li class="sidebar__menu-header">@lang('Actors')</li>

                    @can(['admin.staff.*', 'admin.roles.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive(['admin.staff*', 'admin.roles.*'], 3) }}" href="javascript:void(0)">
                                <i class="menu-icon las la-users"></i>
                                <span class="menu-title">@lang('Manage Guest')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive(['admin.staff*', 'admin.roles.*'], 2) }}">
                                <ul>
                                    @can('admin.staff.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.staff*') }}">
                                            <a class="nav-link" href="{{ route('admin.staff.index') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Guest')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.staff.transferstaff')
                                        <li class="sidebar-menu-item {{ menuActive('admin.staff.transferStaff') }}">
                                            <a class="nav-link" href="{{ route('admin.staff.transferStaff') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Transfer Guest')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.roles.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.roles*') }}">
                                            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Roles')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can(['admin.users.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.users*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon las la-users"></i>
                                <span class="menu-title">@lang('Registered Guests')</span>
                                @if ($bannedUsersCount > 0 || $emailUnverifiedUsersCount > 0 || $mobileUnverifiedUsersCount > 0)
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>

                            <div class="sidebar-submenu {{ menuActive('admin.users*', 2) }}">
                                <ul>
                                    @can('admin.users.active')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.active') }}">
                                            <a class="nav-link" href="{{ route('admin.users.active') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Active Guests')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.users.banned')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.banned') }}">
                                            <a class="nav-link" href="{{ route('admin.users.banned') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Banned Guests')</span>
                                                @if ($bannedUsersCount)
                                                    <span class="menu-badge pill bg--danger ms-auto">{{ $bannedUsersCount }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.users.email.unverified')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.email.unverified') }}">
                                            <a class="nav-link" href="{{ route('admin.users.email.unverified') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email Unverified')</span>

                                                @if ($emailUnverifiedUsersCount)
                                                    <span class="menu-badge pill bg--danger ms-auto">{{ $emailUnverifiedUsersCount }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.users.mobile.unverified')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.mobile.unverified') }}">
                                            <a class="nav-link" href="{{ route('admin.users.mobile.unverified') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Mobile Unverified')</span>
                                                @if ($mobileUnverifiedUsersCount)
                                                    <span class="menu-badge pill bg--danger ms-auto">{{ $mobileUnverifiedUsersCount }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    
                                    <li class="sidebar-menu-item {{ menuActive('admin.users.transfer') }}">
                                        <a class="nav-link" href="{{ route('admin.users.transfer') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Transfer Guests')</span>
                                        </a>
                                    </li>

                                    @can('admin.users.all')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.all') }}">
                                            <a class="nav-link" href="{{ route('admin.users.all') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Guests')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    <hr class="my-0">

                                    @can('admin.users.notification.all')
                                        <li class="sidebar-menu-item {{ menuActive('admin.users.notification.all') }}">
                                            <a class="nav-link" href="{{ route('admin.users.notification.all') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Send Notification to All')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('admin.subscriber.index')
                        <li class="sidebar-menu-item {{ menuActive('admin.subscriber.index') }}">
                            <a class="nav-link" data-default-url="{{ route('admin.subscriber.index') }}" href="{{ route('admin.subscriber.index') }}">
                                <i class="menu-icon las la-thumbs-up"></i>
                                <span class="menu-title">@lang('Subscribers') </span>
                            </a>
                        </li>
                    @endcan
                @endcan

                @can(['admin.ticket.*', 'admin.report*'])
                    <li class="sidebar__menu-header">@lang('Support & Report')</li>
                    @can(['admin.ticket.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.ticket*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon la la-ticket"></i>
                                <span class="menu-title">@lang('Support Tickets') </span>
                                @if (0 < $pendingTicketCount)
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.ticket*', 2) }} ">
                                <ul>
                                    @can('admin.ticket.pending')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.pending') }} ">
                                            <a class="nav-link" href="{{ route('admin.ticket.pending') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Pending Ticket')</span>
                                                @if ($pendingTicketCount)
                                                    <span class="menu-badge pill bg--danger ms-auto">{{ $pendingTicketCount }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.ticket.closed')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.closed') }} ">
                                            <a class="nav-link" href="{{ route('admin.ticket.closed') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Closed Ticket')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.ticket.answered')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.answered') }} ">
                                            <a class="nav-link" href="{{ route('admin.ticket.answered') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Answered Ticket')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.ticket.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.index') }} ">
                                            <a class="nav-link" href="{{ route('admin.ticket.index') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('All Ticket')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can(['admin.report*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.report*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon la la-list"></i>
                                <span class="menu-title">@lang('Reports') </span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.report*', 2) }}">
                                <ul>

                                    @can('admin.report.booking.history')
                                        <li class="sidebar-menu-item {{ menuActive('admin.report.booking.history') }}">
                                            <a class="nav-link" href="{{ route('admin.report.booking.history') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Booking Actions')</span>
                                            </a>
                                        </li>
                                    @endcan

{{--                                    @can('admin.report.payments.received')--}}
{{--                                        <li class="sidebar-menu-item {{ menuActive('admin.report.payments.received') }}">--}}
{{--                                            <a class="nav-link" href="{{ route('admin.report.payments.received') }}">--}}
{{--                                                <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                                <span class="menu-title">@lang('Received Payments')</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}

{{--                                    @can('admin.report.payments.returned')--}}
{{--                                        <li class="sidebar-menu-item {{ menuActive('admin.report.payments.returned') }}">--}}
{{--                                            <a class="nav-link" href="{{ route('admin.report.payments.returned') }}">--}}
{{--                                                <i class="menu-icon las la-dot-circle"></i>--}}
{{--                                                <span class="menu-title">@lang('Returned Payments')</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}

                                    @can('admin.report.notification.history')
                                        <li class="sidebar-menu-item {{ menuActive('admin.report.notification.history') }}">
                                            <a class="nav-link" href="{{ route('admin.report.notification.history') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Notification History')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.report.login.history')
                                        <li class="sidebar-menu-item {{ menuActive(['admin.report.login.history', 'admin.report.login.ipHistory']) }}">
                                            <a class="nav-link" href="{{ route('admin.report.login.history') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Guests Login History')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    
                                    
                                    @can('admin.report.bedCountReport')
                                        <li class="sidebar-menu-item {{ menuActive('admin.report.bedCountReport') }}">
                                            <a class="nav-link" href="{{ route('admin.report.bedCountReport') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Bed Report')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    
                                    {{-- <li class="sidebar-menu-item {{ menuActive('admin.report.lostFoundReport') }}">
                                            <a class="nav-link" href="{{ route('admin.report.lostFoundReport') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Lost & Found Item Report')</span>
                                            </a>
                                        </li> --}}
                                        
                                        <li class="sidebar-menu-item {{ menuActive('admin.report.booking') }}">
                                            <a class="nav-link" href="{{ route('admin.report.booking') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Booking Report')</span>
                                            </a>
                                        </li>

                                </ul>
                            </div>
                        </li>
                    @endcan
                @endcan

                @can(['admin.setting.index', 'admin.setting.system.configuration', 'admin.setting.logo.icon', 'admin.setting.notification.*', 'admin.gateway.*', 'admin.extensions.index', 'admin.language.manage', 'admin.seo'])
                    <li class="sidebar__menu-header">@lang('System Settings')</li>

                    @can('admin.setting.index')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.index') }}">
                            <a class="nav-link" href="{{ route('admin.setting.index') }}">
                                <i class="menu-icon las la-life-ring"></i>
                                <span class="menu-title">@lang('General Setting')</span>
                            </a>
                        </li>
                    @endcan

                    @can('admin.setting.system.configuration')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.system.configuration') }}">
                            <a class="nav-link" href="{{ route('admin.setting.system.configuration') }}">
                                <i class="menu-icon las la-cog"></i>
                                <span class="menu-title">@lang('System Configuration')</span>
                            </a>
                        </li>
                    @endcan

                    @can(['admin.gateway.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.gateway*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon las la-credit-card"></i>
                                <span class="menu-title">@lang('Payment Gateways')</span>

                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.gateway*', 2) }}">
                                <ul>
                                    @can('admin.gateway.automatic.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.gateway.automatic.index') }}">
                                            <a class="nav-link" href="{{ route('admin.gateway.automatic.index') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Automatic Gateways')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.gateway.manual.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.gateway.manual.index') }}">
                                            <a class="nav-link" href="{{ route('admin.gateway.manual.index') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Manual Gateways')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('admin.setting.logo.icon')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.logo.icon') }}">
                            <a class="nav-link" href="{{ route('admin.setting.logo.icon') }}">
                                <i class="menu-icon las la-images"></i>
                                <span class="menu-title">@lang('Logo & Favicon')</span>
                            </a>
                        </li>
                    @endcan

                    @can('admin.extensions.index')
                        <li class="sidebar-menu-item {{ menuActive('admin.extensions.index') }}">
                            <a class="nav-link" href="{{ route('admin.extensions.index') }}">
                                <i class="menu-icon las la-cogs"></i>
                                <span class="menu-title">@lang('Extensions')</span>
                            </a>
                        </li>
                    @endcan

                    @can('admin.language.manage')
                        <li class="sidebar-menu-item {{ menuActive(['admin.language.manage', 'admin.language.key']) }}">
                            <a class="nav-link" data-default-url="{{ route('admin.language.manage') }}" href="{{ route('admin.language.manage') }}">
                                <i class="menu-icon las la-language"></i>
                                <span class="menu-title">@lang('Language') </span>
                            </a>
                        </li>
                    @endcan

                    @can('admin.seo')
                        <li class="sidebar-menu-item {{ menuActive('admin.seo') }}">
                            <a class="nav-link" href="{{ route('admin.seo') }}">
                                <i class="menu-icon las la-globe"></i>
                                <span class="menu-title">@lang('SEO Manager')</span>
                            </a>
                        </li>
                    @endcan
                    @can(['admin.setting.notification.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.setting.notification*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon las la-bell"></i>
                                <span class="menu-title">@lang('Notification Setting')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.setting.notification*', 2) }}">
                                <ul>
                                    @can('admin.setting.notification.global')
                                        <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.global') }}">
                                            <a class="nav-link" href="{{ route('admin.setting.notification.global') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Global Template')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.setting.notification.email')
                                        <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.email') }}">
                                            <a class="nav-link" href="{{ route('admin.setting.notification.email') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email Setting')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.setting.notification.sms')
                                        <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.sms') }}">
                                            <a class="nav-link" href="{{ route('admin.setting.notification.sms') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('SMS Setting')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.setting.notification.templates')
                                        <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.templates') }}">
                                            <a class="nav-link" href="{{ route('admin.setting.notification.templates') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Notification Templates')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                @endcan

                @can(['admin.frontend*'])
                    <li class="sidebar__menu-header">@lang('Frontend Manager')</li>

                    @can('admin.frontend.templates')
                        <li class="sidebar-menu-item {{ menuActive('admin.frontend.templates') }}">
                            <a class="nav-link" href="{{ route('admin.frontend.templates') }}">
                                <i class="menu-icon la la-html5"></i>
                                <span class="menu-title">@lang('Manage Templates')</span>
                            </a>
                        </li>
                    @endcan

                    @can('admin.frontend.manage.pages')
                        <li class="sidebar-menu-item {{ menuActive('admin.frontend.manage.pages') }}">
                            <a class="nav-link" href="{{ route('admin.frontend.manage.pages') }}">
                                <i class="menu-icon la la-list"></i>
                                <span class="menu-title">@lang('Manage Pages')</span>
                            </a>
                        </li>
                    @endcan

                    @can('admin.frontend.sections')
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.frontend.sections*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon la la-puzzle-piece"></i>
                                <span class="menu-title">@lang('Manage Section')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.frontend.sections*', 2) }}">
                                <ul>
                                    @php
                                        $lastSegment = collect(request()->segments())->last();
                                    @endphp
                                    @foreach (getPageSections(true) as $k => $secs)
                                        @if ($secs['builder'])
                                            <li class="sidebar-menu-item @if ($lastSegment == $k) active @endif">
                                                <a class="nav-link" href="{{ route('admin.frontend.sections', $k) }}">
                                                    <i class="menu-icon las la-dot-circle"></i>
                                                    <span class="menu-title">{{ __($secs['name']) }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endcan

                @endcan

                @can(['admin.system.*', 'admin.maintenance.mode', 'admin.setting.cookie', 'admin.setting.custom.css', 'admin.request.report'])
                    <li class="sidebar__menu-header">@lang('Extra')</li>
                    @can('admin.maintenance.mode')
                        <li class="sidebar-menu-item {{ menuActive('admin.maintenance.mode') }}">
                            <a class="nav-link" href="{{ route('admin.maintenance.mode') }}">
                                <i class="menu-icon las la-robot"></i>
                                <span class="menu-title">@lang('Maintenance Mode')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.setting.cookie')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.cookie') }}">
                            <a class="nav-link" href="{{ route('admin.setting.cookie') }}">
                                <i class="menu-icon las la-cookie-bite"></i>
                                <span class="menu-title">@lang('GDPR Cookie')</span>
                            </a>
                        </li>
                    @endcan
                    @can(['admin.system.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.system*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon la la-server"></i>
                                <span class="menu-title">@lang('System')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.system*', 2) }}">
                                <ul>
                                    @can('admin.system.info')
                                        <li class="sidebar-menu-item {{ menuActive('admin.system.info') }}">
                                            <a class="nav-link" href="{{ route('admin.system.info') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Application')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.system.server.info')
                                        <li class="sidebar-menu-item {{ menuActive('admin.system.server.info') }}">
                                            <a class="nav-link" href="{{ route('admin.system.server.info') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Server')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.system.optimize')
                                        <li class="sidebar-menu-item {{ menuActive('admin.system.optimize') }}">
                                            <a class="nav-link" href="{{ route('admin.system.optimize') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Cache')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('admin.setting.custom.css')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.custom.css') }}">
                            <a class="nav-link" href="{{ route('admin.setting.custom.css') }}">
                                <i class="menu-icon lab la-css3-alt"></i>
                                <span class="menu-title">@lang('Custom CSS')</span>
                            </a>
                        </li>
                    @endcan

                @endcan
            </ul>
            <div class="text-uppercase mb-3 text-center">
                <span class="text--primary">{{ $general?->site_name }}</span>
                <span class="text--success">@lang('V'){{ systemDetails()['version'] }} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('style')
    <style>
        .transform-rotate-180 {
            transform: rotate(180deg)
        }
    </style>
@endpush

@push('script')
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
@endpush
