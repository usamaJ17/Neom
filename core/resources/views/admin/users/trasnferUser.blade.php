@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Guest Name')</th>
                                    <th>@lang('Prev Accommodation')</th>
                                    <th>@lang('Current Accommodation')</th>
                                    <th>@lang('Prev Booking')</th>
                                    <th>@lang('Prev Booking Bed Name')</th>
                                    <th>@lang('Prev Booking Room Type')</th>
                                    <th>@lang('Prev Booking Bed Number')</th>
                                    <th>@lang('Current Booking')</th>
                                    <th>@lang('Current Booking Bed Name')</th>
                                    <th>@lang('Current Booking Room Type')</th>
                                    <th>@lang('Current Booking Bed Number')</th>
                                    <th>@lang('Booked')</th>
                                    <th>@lang('Transfer By')</th>
                                    <th>@lang('Transfer Date')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transferStaff as $staff)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $staff->user->firstname.' '.$staff->user->lastname }}</td>
                                        <td>{{ $staff->preaccommodation?->name }}</td>
                                        <td>{{ $staff->accommodation?->name }}</td>
                                        <td>
                                            @if($staff->prevBooking)
                                            {{ $staff->prevBooking->booking_number }}<br>
                                            <span class="fw-bold">Total Beds : {{$staff->prevBooking->bookedRooms->count()}}</span><br>
                                            @if ($staff->prevBooking->key_status)
                                                <small class="badge badge--success">Check In</small>
                                                @else
                                                @php echo $staff->prevBooking->statusBadge; @endphp
                                            @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($staff->prevBooking)
                                            @foreach($staff->prevBooking->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Bed Name : {{ __($item->room->room_number) }}<br>
                                            </span>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($staff->prevBooking)
                                            @foreach($staff->prevBooking->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Room Type : {{ optional($item->room->room->roomType)->name }}<br>
                                            </span>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($staff->prevBooking)
                                            @foreach($staff->prevBooking->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Room Number : {{ $item->room->room->bed_name }}
                                            </span>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($staff->user?->booking()->where('status',1)->latest()->first())
                                            {{ $staff->user?->booking()->where('status',1)->latest()->first()->booking_number }}<br>
                                            <span class="fw-bold">Total Beds : {{$staff->user?->booking()->where('status',1)->latest()->first()->bookedRooms->count()}}</span><br>
                                            @if ($staff->user?->booking()->where('status',1)->latest()->first()->key_status)
                                                <small class="badge badge--success">Check In</small>
                                                @else
                                                @php echo $staff->user?->booking()->where('status',1)->latest()->first()->statusBadge; @endphp
                                            @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($staff->user?->booking()->where('status',1)->latest()->first())
                                            @foreach($staff->user?->booking()->where('status',1)->latest()->first()->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Bed Name : {{ __($item->room->room_number) }}<br>
                                            </span>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($staff->user?->booking()->where('status',1)->latest()->first())
                                            @foreach($staff->user?->booking()->where('status',1)->latest()->first()->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Room Type : {{ optional($item->room->room->roomType)->name }}<br>
                                            </span>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($staff->user?->booking()->where('status',1)->latest()->first())
                                            @foreach($staff->user?->booking()->where('status',1)->latest()->first()->bookedRooms as $item)
                                            <span class="d-block fw-bold">
                                                Room Number : {{ $item->room->room->bed_name }}
                                            </span>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $staff->is_booked ? 'Yes': 'No' }}</td>
                                        <td>{{ $staff->admin->name }}</td>
                                        <td>{{ $staff->transfer_date }}</td>
                                       
                                    </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <x-confirmation-modal />

    @can('admin.staff.save')
        <!-- Create Update Modal -->
        <div class="modal fade" id="cuModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>

                    <form action="{{ route('admin.users.transferSave') }}" method="POST">
                        @csrf
                        <div class="modal-body">

                             <div class="form-group">
                                <label>@lang('Guest')</label>
                                <select class="form-control" name="staff_id" required>
                                    <option disabled selected value="">@lang('Select One')</option>
                                    @foreach ($allStaff as $staff)
                                        <option value="{{ $staff->id }}">Guest : {{ $staff->firstname }} {{$staff->lastname}} - Current : {{$staff->accommodation?->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                          
                            
                             <div class="form-group">
                                <label>@lang('Accommodation')</label>
                                <select class="form-control" name="accommodation_id" required>
                                    <option disabled selected value="">@lang('Select One')</option>
                                    @foreach ($accommodations as $accommodation)
                                        <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>@lang('Transfer Date')</label>
                                <input class="form-control" name="transfer_date" required type="date">
                            </div>

                        </div>
                        <div class="align-items-center d-flex justify-content-between p-3">
                            <input class="btn btn--primary" name="type" value="Transfer without booking" type="submit">
                            <input class="btn btn--primary" value="Transfer with booking" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="cuModal2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">In Building Transfer Guest</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>

                    <form action="{{ route('admin.users.transferSave') }}" method="POST">
                        @csrf
                        <div class="modal-body">

                             <div class="form-group">
                                <label>@lang('Guest')</label>
                                <select class="form-control" name="staff_id" required id="user_id" onchange="getBookings()">
                                    <option disabled selected value="">@lang('Select One')</option>
                                    @foreach ($allStaff as $staff)
                                        <option value="{{ $staff->id }}">Guest : {{ $staff->firstname }} {{$staff->lastname}} - Current : {{$staff->accommodation?->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                          
                            
                             <div class="form-group">
                                <label>@lang('Booking')</label>
                                <select class="form-control" name="booking_id" id="booking_id" required>
                                    <option disabled selected value="">@lang('Select One')</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>@lang('Transfer Date')</label>
                                <input class="form-control" name="transfer_date" required type="date">
                            </div>

                        </div>
                        <div class="align-items-center d-flex justify-content-end p-3">
                            <input class="btn btn--primary" value="Transfer" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@push('breadcrumb-plugins')

    <!-- Modal Trigger Button -->
    @can('admin.staff.transferSave')
        <button class="btn btn-sm btn-outline--primary" data-bs-toggle="modal" data-bs-target="#cuModal2" type="button">
            <i class="las la-plus"></i>@lang('In Building Transfer Guest')
        </button>
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Transfer Guest')" type="button">
            <i class="las la-plus"></i>@lang('Transfer Guest')
        </button>
    @endcan
@endpush

@push('style-lib')
    <style>
        .table td, .table th {
    border-top: 1px solid black !important;
}
    </style>
@endpush

@push('script')

<script>
            function getBookings(){
                var staffId = $('#user_id').val();
                var booking_id = $('#booking_id');
        
                booking_id.empty(); // Clear the dropdown before appending options
        
                if (staffId) {
                    $.get('/admin/get-bookings/:staff_id'.replace(':staff_id', staffId), function (data) {
                        $.each(data, function (key, value) {
                            booking_id.append('<option value="' + value.id + '">' + value.booking_number + '</option>');
                        });
                        booking_id.prop('disabled', data.length === 0);
                    });
                } else {
                    booking_id.prop('disabled', true);
                }
            };
</script>

@endpush