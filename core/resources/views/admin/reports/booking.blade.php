@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg--transparent b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table bg-white" id="datatable">
                            <thead>
                                <tr>
                                    <th>@lang('Booking No')</th>
                                    <th>@lang('Bed Name')</th>
                                    <th>@lang('Room Type')</th>
                                    <th>@lang('Room Number')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Total Beds')</th>
                                    <th>@lang('Category')</th>
                                    <th>@lang('Guest Name')</th>
                                    <th>@lang('SAP ID/Employee ID')</th> 
                                    <th>@lang('Nationality')</th> 
                                    <th>@lang('Passport/Iqama')</th> 
                                    <th>@lang('Gender')</th> 
                                    <th>@lang('Department')</th> 
                                    <th>@lang('Designation')</th> 
                                    <th>@lang('Contact Number')</th> 
                                    <th>@lang('Main Company')</th> 
                                    <th>@lang('Project Site')</th> 
                                    <th>@lang('Check In')</th>
                                    <th>@lang('Check Out')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Stay Duration Days')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr >
                                    <!--class="@if ($booking->isDelayed() && !request()->routeIs('admin.booking.checkout.delayed')) delayed-checkout @endif">-->
                                        
                                        <td>
                                            <span class="fw-bold">#{{ $booking->booking_number }}</span>
                                        </td>
                                         <td>
                                            @foreach($booking->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Bed Name : {{ __($item->room->room_number) }}<br>
                                            </span>
                                            @endforeach
                                        </td>
                                         <td>
                                            @foreach($booking->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Room Type : {{ optional($item->room->room->roomType)->name }}<br>
                                            </span>
                                            @endforeach
                                        </td>
                                         <td>
                                            @foreach($booking->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Room Number : {{ $item->room->room->bed_name }}
                                            </span>
                                            @endforeach
                                        </td>
                                        <td>{{$booking->accommodation->name}}</td>
                                        <td>{{$booking->bookedRooms->count()}}</td>
                                        <td>{{$booking->user?->category}}</td>
                                        <td>{{$booking->user?->firstname.' '.$booking->user?->lastname}}</td>
                                        <td>{{$booking->user?->employee_id}}</td>
                                        <td>{{$booking->user?->nationality}}</td>
                                        <td>{{$booking->user?->passport_no}}</td>
                                        <td>{{$booking->user?->gender}}</td>
                                        <td>{{$booking->user?->department}}</td>
                                        <td>{{$booking->user?->designation}}</td>
                                        <td>{{$booking->user?->mobile}}</td>
                                        <td>{{$booking->user?->company}}</td>
                                        <td>{{$booking->user?->project}}</td>
                                        <td>{{ showDateTime($booking->checked_in_at, 'd M, Y') }}</td>
                                        <td>
                                            @if($booking->checked_out_at <> '')
                                                {{ showDateTime($booking->checked_out_at, 'd M, Y') }}
                                           
                                            @endif
                                        </td>
                                            <td>
                                                @if ($booking->status == 1)
                                                <small class="badge badge--success">Active/Check In</small>
                                                @elseif($booking->status == 3)
                                                <small class="badge badge--danger">Cancelled</small>
                                                @elseif($booking->status == 9 && $booking->sign <> '')
                                                <small class="badge badge--danger">Checked-out</small>
                                                @else
                                                
                                                @php echo $booking->statusBadge; @endphp
                                            @endif
                                            </td>
                                            <td>
                                                @php
                                                if($booking->checked_in_at <> '' && $booking->checked_out_at <> '' )
                                                {
                                                    $datework = \Carbon\Carbon::createFromDate($booking->checked_in_at);
                                                    $now = \Carbon\Carbon::parse($booking->checked_out_at);
                                                    $testdate = ($datework->diffInDays($now) + 1) . "Days";
                                                }
                                                else
                                                {
                                                 $testdate = "";
                                                }
                                                
                                            @endphp
                                            <p class="fw-bold text--primary">{{$testdate}}</p>
                                            </td>
                                    </tr>
                               
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <style>
        .table td, .table th {
    border-top: 1px solid black !important;
}
    </style>
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
    </style>

@endpush
