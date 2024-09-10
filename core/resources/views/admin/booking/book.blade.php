@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        @can('admin.room.search')
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.room.search') }}" class="formRoomSearch" method="get">
                            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
                                
                                <div class="form-group flex-fill">
                                    <label>@lang('Accommodation')</label>
                                    <select class="form-control" name="accommodation" id="accommodation" required>
                                        @if(request()->accommodation_id)
                                        @php
                                        $accommodation = \App\Models\Accommodation::findOrFail(request()->accommodation_id);
                                        @endphp
                                        <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                                        @else
                                        <option value="">@lang('Select One')</option>
                                        @foreach ($accommodations as $accommodation)
                                            <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                
                                <div class="form-group flex-fill">
                                    <label>@lang('Room Type') </label>
                                    <select class="form-control" name="room_type" id="room_type" required>
                                        <option value="">@lang('Select One')</option>
                                        @if(request()->accommodation_id)
                                        @php
                                        $room_types = \App\Models\RoomType::whereAccommodationId(request()->accommodation_id)->get();
                                        @endphp
                                        @foreach($room_types as $room_type)
                                        <option value="{{ $room_type->id }}">{{ $room_type->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group flex-fill">
                                    <label>@lang('Check In')</label>
                                    <!--<input autocomplete="off" class="datepicker-here form-control bg--white" data-language="en" data-multiple-dates-separator=" - " data-position='bottom left' data-range="true" name="date" placeholder="@lang('Select Date')" required type="text">-->
                                    <input autocomplete="off" class="form-control bg--white" name="date" placeholder="@lang('Select Date')" required type="date">
                                </div>
                                <div class="form-group flex-fill">
                                    <label>@lang('Room')</label>
                                    <input class="form-control" name="rooms" placeholder="@lang('How many room?')" required type="text" value="1" readonly>
                                </div>
                                
                                <div class="form-group flex-fill">
                                    <label>@lang('Bed Type')</label>
                                    <select class="form-control" name="bed_type_id" id="bed_type_id" required>
                                        <option value="">@lang('Select One')</option>
                                         @if(request()->accommodation_id)
                                        @php
                                        $bed_types = \App\Models\NewBedType::whereAccommodationId(request()->accommodation_id)->get();
                                        @endphp
                                        @foreach($bed_types as $bed_type)
                                        <option value="{{ $bed_type->id }}">{{ $bed_type->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group flex-fill">
                                    <button class="btn btn--primary w-100 h-45 search" type="submit">
                                        <i class="la la-search"></i>@lang('Search')
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endcan
    </div>
    <div class="row booking-wrapper d-none">
        <div class="col-lg-8 mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex justify-content-between booking-info-title mb-0">
                        <h5>@lang('Booking Information')</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="pb-3">
                        <span class="fas fa-circle text--danger" disabled></span>
                        <span class="mr-5">@lang('Booked')</span>
                        <span class="fas fa-circle text--success"></span>
                        <span class="mr-5">@lang('Selected')</span>
                        <span class="fas fa-circle text--primary"></span>
                        <span>@lang('Available')</span>
                        <span class="fas fa-circle"></span>
                        <span>@lang('Cleaning')</span>
                        <span class="fas fa-circle text--warning"></span>
                        <span>@lang('Under Maintenance')</span>
                    </div>
                    <div class="alert alert-info room-assign-alert p-3" role="alert">
                    </div>
                    <div class="bookingInfo">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">
                        <h5>@lang('Book Room')</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.room.book') }}" class="booking-form" id="booking-form" method="POST">
                        @csrf
                        @if(request()->user_id)
                        @php
                        $user = \App\Models\User::findOrFail(request()->user_id);
                        @endphp
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang('Guest')</label>
                                <select class="form-control" name="user_id">
                                    <option value="{{$user->id}}">{{$user->firstname}}</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        <input name="room_type_id" type="hidden">
                        <input name="accommodation" type="hidden">
                        <div class="row">
                            @if(!request()->user_id)
                            <div class="col-12">
                                <div class="form-group">
                                    <label>@lang('Guest Type')</label>
                                    <select onchange="if($('#guest_type').val() == 1){$('#user-div').removeClass('d-none').attr('required',true)}else{$('#user-div').addClass('d-none').attr('required',false)}" id="guest_type" class="form-control" name="guest_type">
                                        <option selected value="0">@lang('Walk-In Guest')</option>
                                        <option value="1">@lang('Existing Guest')</option>
                                    </select>
                                </div>
                            </div>
                            
                        @php
                        $users = \App\Models\User::get();
                        @endphp
                        <div id="user-div" class="col-12 d-none">
                            <div class="form-group">
                                <label>@lang('Guest')</label>
                                <select id="user_Id" class="form-control" name="user">
                                    <option value="">Select Guest</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->firstname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input class="form-control forGuest" name="guest_name" required type="text">
                                </div>
                            </div>
                            
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('SAP ID/ Employee ID')</label>
                                    <input class="form-control" name="employee_id" required type="text">
                                </div>
                            </div>
                            
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Nationality')</label>
                                    <input class="form-control forGuest" name="nationality" required type="text">
                                </div>
                            </div>
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Passport/Iqama')</label>
                                    <input class="form-control forGuest" name="passport" required type="text">
                                </div>
                            </div>
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Gender')</label>
                                     <select class="form-control" name="gender">
                                        <option selected value="male">@lang('Male')</option>
                                        <option value="female">@lang('Female')</option>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Department')</label>
                                    <input class="form-control forGuest" name="department" required type="text">
                                </div>
                            </div>
                            
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Designation')</label>
                                    <input class="form-control forGuest" name="designation" required type="text">
                                </div>
                            </div>
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Category')</label>
                                    <input class="form-control forGuest" name="category" required type="text">
                                </div>
                            </div>
                            
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Contact Number')</label>
                                    <input class="form-control forGuest" name="mobile" required type="text">
                                </div>
                            </div>
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Car Plate No')</label>
                                    <input class="form-control forGuest" name="car_no" required type="text">
                                </div>
                            </div>
                            
                            <!--<div class="col-12">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>@lang('Email')</label>-->
                            <!--        <input class="form-control" name="email" required type="email">-->
                            <!--    </div>-->
                            <!--</div>-->

                            
                            <!--<div class="col-12 guestInputDiv">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>@lang('Address')</label>-->
                            <!--        <input class="form-control forGuest" name="address" required type="text">-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Main Company')</label>
                                    <input class="form-control forGuest" name="company" required type="text">
                                </div>
                            </div>
                            <div class="col-12 guestInputDiv">
                                <div class="form-group">
                                    <label>@lang('Project Site')</label>
                                    <input class="form-control forGuest" name="project" required type="text">
                                </div>
                            </div>
                            @endif
                            
                            <!--<div class="col-12 guestInputDiv">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>@lang('Remarks')</label>-->
                            <!--        <input class="form-control forGuest" name="remarks" required type="text">-->
                            <!--    </div>-->
                            <!--</div>-->
                            

                            <div class="orderList d-none" style="display: none">
                                <ul class="list-group list-group-flush orderItem">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6>@lang('Room')</h6>
                                        <h6>@lang('Days')</h6>
                                        <span>
                                            <h6>@lang('Fare')</h6>
                                        </span>
                                        <span>
                                            <h6>@lang('Subtotal')</h6>
                                        </span>
                                    </li>
                                </ul>
                                    <div class="d-flex justify-content-between align-items-center border-top p-2">
                                        <span>@lang('Subtotal')</span>
                                        <span class="totalFare" data-amount="0"></span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center border-top p-2">
                                        <span>{{ $general->tax_name }} <small>({{ $general->tax }}%)</small></span>
                                        <span><span class="taxCharge" data-percent_charge="{{ $general->tax }}"></span> {{ $general->cur_text }}</span>
                                        <input name="tax_charge" type="hidden">
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center border-top p-2">
                                        <span>@lang('Total Fare')</span>
                                        <span class="grandTotalFare"></span>
                                        <input hidden name="total_amount" type="text">
                                    </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>@lang('Paying Amount')</label>
                                        <input class="form-control" min="0" name="paid_amount" placeholder="@lang('Paying Amount')" step="any" type="number">
                                    </div>
                                </div>
                                </div>
                                

                            @can('admin.room.book')
                                <div class="form-group mb-0">
                                    <button class="btn btn--primary h-45 w-100 btn-book confirmBookingBtn" type="button">@lang('Book Now')</button>
                                </div>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmBookingModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation Alert!')</h5>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure to book this rooms?')</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('No')</button>
                    <button class="btn btn--primary btn-confirm" type="button">@lang('Yes')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@can('admin.booking.all')
    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn--primary" href="{{ route('admin.booking.all') }}">
            <i class="la la-list"></i>@lang('All Bookings')
        </a>
    @endpush
@endcan

@push('style-lib')
    <link href="{{ asset('assets/global/css/vendor/datepicker.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('style')
    <style>
        .booking-table td {
            white-space: unset;
        }

        .modal-open .select2-container {
            z-index: 9 !important;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (!$('.datepicker-here').val()) {
            $('.datepicker-here').datepicker({
                minDate: new Date()
            });
        }


        $('[name=guest_type]').on('change', function() {
            if ($(this).val() == 1) {
                $('.guestInputDiv').addClass('d-none');
                $('.forGuest').attr("required", false);
            } else {
                $('.guestInputDiv').removeClass('d-none');
                $('.forGuest').attr("required", true);
            }
        });


        $('.formRoomSearch').on('submit', function(e) {
            e.preventDefault();

            // let searchDate = $('[name=date]').val();
            // if (searchDate.split(" - ").length < 2) {
            //     notify('error', `@lang('Check-In date and checkout date should be given for booking.')`);
            //     return false;
            // }

            resetDOM();
            let formData = $(this).serialize();
            let url = $(this).attr('action');

            $.ajax({
                type: "get",
                url: url,
                data: formData,
                success: function(response) {
                    $('.bookingInfo').html('');
                    $('.booking-wrapper').addClass('d-none');
                    if (response.error) {
                        notify('error', response.error);
                    } else if (response.html.error) {
                        notify('error', response.html.error);
                    } else {
                        $('.bookingInfo').html(response.html);
                        let roomTypeId = $('[name=room_type]').val();
                        $('[name=room_type_id]').val(roomTypeId);
                        let accommodationId = $('[name=accommodation]').val();
                        console.log(accommodationId);
                        $('[name=accommodation]').val(accommodationId);
                        $('.booking-wrapper').removeClass('d-none');
                    }
                },
                processData: false,
                contentType: false,
            });
        });

        function resetDOM() {
            $(document).find('.orderListItem').remove();
            $('.totalFare').data('amount', 0);
            $('.totalFare').text(`0 {{ __($general->cur_text) }}`);
            $('.taxCharge').text('0');
            $('[name=tax_charge]').val('0');
            $('.grandTotalFare').text(`0 {{ __($general->cur_text) }}`);
            $('[name=total_amount]').val('0');
            $('[name=paid_amount]').val('');
            $('[name=room_type_id]').val('');
            $('[name=accommodation_id]').val('');
        }

        $(document).on('click', '.confirmBookingBtn', function() {
            var modal = $('#confirmBookingModal');
            modal.modal('show');
        });

        $('.btn-confirm').on('click', function() {
            $('#confirmBookingModal').modal('hide');
            $('.booking-form').submit();
        });

        $('.booking-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            let url = $(this).attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        notify('success', response.success);
                        $('.bookingInfo').html('');
                        $('.booking-wrapper').addClass('d-none');
                        $(document).find('.orderListItem').remove();
                        $('.orderList').addClass('d-none');
                        $('.formRoomSearch').trigger('reset');
                    } else {
                        notify('error', response.error);
                    }
                },
            });
        });
        $('.select2-basic').select2({
            dropdownParent: $('.select2-parent')
        });
        
        
        // Room Type
        
         $(document).ready(function () {
        $('#accommodation').change(function () {
            var accommodationId = $(this).val();
            var roomType = $('#room_type');
            var bedType = $('#bed_type_id');

            roomType.empty();
            bedType.empty();

            if (accommodationId) {
              
                 $.get('{{ route('admin.hotel.room.type.roomType', ['accommodation_id' => ':accommodation_id']) }}'.replace(':accommodation_id', accommodationId), function (data) {
                    
                    $.each(data.roomtypes, function (key, value) {
                        roomType.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $.each(data.bedtypes, function (key, value) {
                        bedType.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                  
                    roomType.prop('disabled', data.length === 0);
                    bedType.prop('disabled', data.length === 0);
                });
            } else {

                roomType.prop('disabled', true);
                bedType.prop('disabled', true);
            }
        });
    });
    </script>
@endpush
