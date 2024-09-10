@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="show-filter mb-3 text-end">
                <button class="btn btn-outline--primary showFilterBtn btn-sm" type="button"><i class="las la-filter"></i> @lang('Filter')</button>
            </div>
            <div class="card responsive-filter-card mb-4">
                <div class="card-body">
                    <form action="">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label>@lang('Keywords') <i class="las la-info-circle text--info" title="@lang('Search by booking number, username or email')"></i></label>
                                <input class="form-control" name="search" type="text" value="{{ request()->search }}">
                            </div>

                            <div class="flex-grow-1">
                                <label>@lang('Check In')</label>
                                <input autocomplete="off" class="datepicker-here1 form-control" data-language="en" data-position='bottom right' data-range="false" name="check_in" type="text" value="{{ request()->check_in }}">
                            </div>

                            <div class="flex-grow-1">
                                <label>@lang('Checkout')</label>
                                <input autocomplete="off" class="datepicker-here1 form-control" data-language="en" data-position='bottom right' data-range="false" name="check_out" type="text" value="{{ request()->check_out }}">
                            </div>

                            <div class="flex-grow-1 align-self-end">
                                <button class="btn btn--primary w-100 h-45"><i class="fas fa-filter"></i> @lang('Filter')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
             <div class="card responsive-filter-card mb-4">
                 <div class="card-header">
                     <!-- <div class="flex-grow-1 align-self-end">-->
                     <!--           <button class="btn btn--primary w-10 h-45"><i class="fas fa-download"></i> @lang('Download Templete')</button>-->
                     <!--</div>-->
                      <a href="{{ route('admin.bookingTemplete')}}" class="btn btn--primary w-10 h-45">
        <i class="fas fa-download"></i> @lang('Download Template')
    </a>
    <p><em>Use Checkin-Checkout format like (YYYY/MM/DD) </em></p>
                 </div>
                <div class="card-body">
                    
                    <form action="{{route('admin.import.booking')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label>@lang('Import Booking Data') </label>
                                <input class="form-control" name="importFile" type="file">
                            </div>

                            <div class="flex-grow-1 align-self-end">
                                <button class="btn btn--primary w-100 h-45"><i class="fas fa-upload"></i> @lang('Upload')</button>
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>

            <div class="card bg--transparent b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table bg-white" id="datatable">
                            <thead>
                                <tr>
                                    
                                    <th>SL.</th>
                                    <th>@lang('Booking Details')</th>
                                    <th>@lang('Guest')</th>
                                    <th>@lang('Check In') | @lang('Check Out')</th>
                                    @if (request()->routeIs('admin.booking.all') || request()->routeIs('admin.booking.active'))
                                        <th>@lang('Status')</th>
                                    @endif

                                    @can(['admin.booking.details', 'admin.booking.booked.rooms', 'admin.booking.service.details', 'admin.booking.payment', 'admin.booking.key.handover', 'admin.booking.merge', 'admin.booking.cancel', 'admin.booking.extra.charge', 'admin.booking.checkout', 'admin.booking.invoice'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr class="@if ($booking->isDelayed() && !request()->routeIs('admin.booking.checkout.delayed')) delayed-checkout @endif">

                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            @if ($booking->key_status)
                                                <span class="text--warning ">
                                                    <i class="las la-key f-size--24"></i>
                                                </span>
                                            @endif

                                            <span class="fw-bold">#{{ $booking->booking_number }}</span><br>
                                            <span class="fw-bold">Accommodation : {{$booking->accommodation->name}}</span><br>
                                            <span class="fw-bold">Total Beds : {{$booking->bookedRooms->count()}}</span><br>
                                            <em class="text-muted text--small">{{ showDateTime($booking->created_at, 'd M, Y h:i A') }}</em><br>
                                            <hr>
                                            @foreach($booking->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Bed Name : {{ __($item->room->room_number) }}<br>
                                                Room Type : {{ optional($item->room->room->roomType)->name }}<br>
                                                Room Number : {{ $item->room->room->bed_name }}
                                            </span>
                                            <hr>
                                            @endforeach
                                        </td>

                                        <td>
                                            @if ($booking->user_id)
                                                <p class="fw-bold text--primary text-start">ID : {{$booking->user?->id}}</p>
                                                <p class="fw-bold text--primary text-start">
                                                    @can('admin.users.detail')
                                                        <a href="{{ route('admin.users.detail', $booking->user_id) }}">Username : <span>@</span>{{ optional($booking->user)->username }}</a>
                                                    @else
                                                        Username : {{ optional($booking->user)->username }}
                                                    @endcan
                                                </p>
                                                <p class="fw-bold text--primary text-start">Name : {{$booking->user?->firstname.' '.$booking->user?->lastname}}</p>
                                                <p class="fw-bold text--primary text-start">SAP ID/ Employee ID : {{$booking->user?->employee_id}}</p>
                                                <p class="fw-bold text--primary text-start">Nationality : {{$booking->user?->nationality}}</p>
                                                <p class="fw-bold text--primary text-start">Passport/Iqama : {{$booking->user?->passport_no}}</p>
                                                <p class="fw-bold text--primary text-start">Gender : {{$booking->user?->gender}}</p>
                                                <p class="fw-bold text--primary text-start">Department : {{$booking->user?->department}}</p>
                                                <p class="fw-bold text--primary text-start">Designation : {{$booking->user?->designation}}</p>
                                                <p class="fw-bold text--primary text-start">Category : {{$booking->user?->category}}</p>
                                                <p class="fw-bold text--primary text-start">Car Plate No : {{$booking->user?->car_no}}</p>
                                                <p class="fw-bold text--primary text-start"><a href="tel:{{ optional($booking->user)->mobile }}">Contact Number : +{{optional($booking->user)->mobile }}</a></p>
                                                <p class="fw-bold text--primary text-start">Main Company : {{$booking->user?->company}}</p>
                                                <p class="fw-bold text--primary text-start">Project Site : {{$booking->user?->project}}</p>
                                            @else
                                                <span class="small">{{ $booking->guest_details->name }}</span>
                                                <br>
                                                <span class="fw-bold">{{ @$booking->guest_details->employee_id }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ showDateTime($booking->check_in, 'd M, Y') }}
                                            @if ($booking->checked_out_at)
                                            <br>
                                            {{ showDateTime($booking->checked_out_at, 'd M, Y') }}
                                            @endif
                                            @if ($booking->status == 9)
                                            <br>
                                            @php
                                            $datework = \Carbon\Carbon::createFromDate($booking->check_in);
                                              $now = \Carbon\Carbon::parse($booking->checked_out_at);
                                              $testdate = $datework->diffInDays($now);
                                            @endphp
                                            <p class="fw-bold text--primary">Total Stay : {{$testdate}} Days</p>
                                            @endif
                                        </td>

                                     

                                        @if (request()->routeIs('admin.booking.all') || request()->routeIs('admin.booking.active'))
                                            <td>
                                                @if ($booking->key_status && $booking->status == 1)
                                                <small class="badge badge--success">Check In</small>
                                                @else
                                                @php echo $booking->statusBadge; @endphp
                                            @endif
                                            </td>
                                        @endif
                                        @can(['admin.booking.details', 'admin.booking.booked.rooms', 'admin.booking.service.details', 'admin.booking.payment', 'admin.booking.key.handover', 'admin.booking.merge', 'admin.booking.cancel', 'admin.booking.extra.charge', 'admin.booking.checkout', 'admin.booking.invoice'])
                                            <td>
                                                <div class="d-flex justify-content-end flex-wrap gap-1">
                                                    @can('admin.booking.details')
                                                        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.booking.details', $booking->id) }}">
                                                            <i class="las la-desktop"></i>@lang('Details')
                                                        </a>
                                                    @endcan
                                                    @if ($booking->key_status && ($booking->status == 1 || $booking->status == 9))
                                                    <button class="btn btn-sm btn-outline--primary" data-bs-toggle="modal" data-bs-target="#checkout-{{$booking->id}}" type="button">
                                                        <i class="la la-pencil"></i>@lang('Edit Checkout')
                                                    </button>
                                                    <!--<button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="@lang('Update Checkout')" data-id="{{ $booking }}" type="button">-->
                                                    <!--    <i class="la la-pencil"></i>@lang('Edit Checkout')-->
                                                    <!--</button>-->
                                                    @endif

                                                    <button aria-expanded="false" class="btn btn-sm btn-outline--info" data-bs-toggle="dropdown" type="button">
                                                        <i class="las la-ellipsis-v"></i>@lang('More')
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        @can('admin.booking.booked.rooms')
                                                            <a class="dropdown-item" href="{{ route('admin.booking.booked.rooms', $booking->id) }}">
                                                                <i class="las la-desktop"></i> @lang('Booked Rooms')
                                                            </a>
                                                        @endcan

                                                        @can('admin.booking.service.details')
                                                            <a class="dropdown-item" href="{{ route('admin.booking.service.details', $booking->id) }}">
                                                                <i class="las la-server"></i> @lang('Extra Services')
                                                            </a>
                                                        @endcan

                                                        @can('admin.booking.payment')
                                                            <a class="dropdown-item" href="{{ route('admin.booking.payment', $booking->id) }}">
                                                                <i class="la la-money-bill"></i> @lang('Payment')
                                                            </a>
                                                        @endcan
                                                        
                                                        @if ($booking->status == Status::BOOKING_ACTIVE)
                                                            @can('admin.booking.key.handover')
                                                                @if (now()->format('Y-m-d') >= $booking->check_in && now()->format('Y-m-d') < $booking->check_out && $booking->key_status == Status::DISABLE)
                                                                    <a class="dropdown-item handoverKeyBtn" data-booked_rooms="{{ $booking->activeBookedRooms->unique('room_id') }}" data-id="{{ $booking->id }}" href="javascript:void(0)">
                                                                        <i class="las la-key"></i> @lang('Handover Keys')
                                                                    </a>
                                                                @endif
                                                            @endcan

                                                            @can('admin.booking.merge')
                                                                <a class="dropdown-item mergeBookingBtn" data-booking_number="{{ $booking->booking_number }}" data-id="{{ $booking->id }}" href="javascript:void(0)">
                                                                    <i class="las la-object-group"></i> @lang('Merge Booking')
                                                                </a>
                                                            @endcan

                                                            @can('admin.booking.cancel')
                                                                <a class="dropdown-item" href="{{ route('admin.booking.cancel', $booking->id) }}">
                                                                    <i class="las la-times-circle"></i> @lang('Cancel Booking')
                                                                </a>
                                                            @endcan

                                                            @can('admin.booking.checkout')
                                                                @if (now() >= $booking->check_out)
                                                                    <a class="dropdown-item" href="{{ route('admin.booking.checkout', $booking->id) }}">
                                                                        <i class="la la-sign-out"></i> @lang('Check Out')
                                                                    </a>
                                                                @endif
                                                            @endcan
                                                        @endif
                                                        @can('admin.booking.invoice')
                                                            <a class="dropdown-item" href="{{ route('admin.booking.invoice', $booking->id) }}" target="_blank"><i class="las la-print"></i> @lang('Print Invoice')</a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                    
                                    <div class="modal fade" id="checkout-{{$booking->id}}" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang(' Checkout')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.bookingCheckout') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                          
                           <input type="hidden" value="{{$booking->id}}" name="id">
                            <div class="form-group flex-fill">
                                    <label>@lang('Check Out Date')</label>
                                    <input autocomplete="off" class="form-control bg--white" data-language="en" name="date" placeholder="@lang('Select Date')" required type="date" value="{{$booking->checked_out_at?->format('Y-m-d')}}">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                               
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
            {{-- Add METHOD MODAL --}}
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang(' Checkout')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.bookingCheckout') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                          
                           <input type="hidden" value="" name="id" id="id">
                            <div class="form-group flex-fill">
                                    <label>@lang('Check Out Date')</label>
                                    <input autocomplete="off" class="form-control bg--white" data-language="en" name="date" placeholder="@lang('Select Date')" required type="date">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    @include('admin.booking.partials.modals')
    <x-confirmation-modal />
@endsection

@can('admin.book.room')
    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn--primary" href="{{ route('admin.book.room') }}">
            <i class="la la-hand-o-right"></i>@lang('Book New')
        </a>
    @endpush
@endcan

@push('script-lib')
    <script src="{{ asset('assets/global/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/global/css/vendor/datepicker.min.css') }}" rel="stylesheet">
    <style>
        .table td, .table th {
    border-top: 1px solid black !important;
}
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.datepicker-here1').datepicker({
                autoClose: true,
                dateFormat: "yyyy-mm-dd"
            });
            
          
        }

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .delayed-checkout {
            background-color: #ffefd640;
        }

        .table-responsive {
            min-height: 600px;
            background: transparent
        }

        .card {
            box-shadow: none;
        }
        .buttons-excel {
            display:none !important;
        }
    </style>

@endpush
