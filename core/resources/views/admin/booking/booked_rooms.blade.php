@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <h6 class="d-inline">@lang('Booking Number'):</h6> #{{ $booking->booking_number }}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                <div class="d-flex flex-wrap gap-3">

                    @php
                        $bookedBy = actionTakenBy($booking->bookedBy);
                        $approvedBy = actionTakenBy($booking->approvedBy);
                        $checkedOutBy = actionTakenBy($booking->checkedOutBy);
                    @endphp
                    @if ($bookedBy)
                        <span>
                            <span>@lang('Booked By')</span>:
                            <span class="text--info">{{ actionTakenBy($booking->bookedBy) }}</span>
                        </span>
                    @endif

                    @if ($approvedBy)
                        <span>
                            <span>@lang('Approved By')</span>:
                            <span class="text--info">{{ actionTakenBy($booking->approvedBy) }}</span>
                        </span>
                    @endif

                    @if ($checkedOutBy)
                        <span>
                            <span>@lang('Checked Out By')</span>:
                            <span class="text--info">{{ actionTakenBy($booking->checkedOutBy) }}</span>
                        </span>
                    @endif
                </div>

                <div class="d-flex justify-content-end me-3 flex-wrap gap-3 p-2">
                    <div class="d-flex align-items-center gap-1">
                        <span class="custom--label bg--danger"></span>
                        <span>@lang('Canceled')</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span class="custom--label bg--dark"></span>
                        <span>@lang('Checked Out')</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span class="custom--label bg--18"></span>
                        <span>@lang('Booked')</span>
                    </div>

                </div>
            </div>

            <div class="card b-radius--10 overflow-hidden">

                <div class="card-body p-0">

                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th>@lang('Action')</th>
                                    <th>@lang('Booked For')</th>
                                    <th>@lang('Room Numbers')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookedRooms as $key => $bookedRoom)
                                    <tr>
                                        @php
                                            $cancellationFee = $bookedRoom->where('status', Status::ROOM_ACTIVE)->sum('cancellation_fee');
                                            $totalFare = $bookedRoom->where('status', Status::ROOM_ACTIVE)->sum('fare');
                                            $shouldRefund = $totalFare - $cancellationFee;
                                            $activeBooking = $bookedRoom->where('status', Status::ROOM_ACTIVE)->count();
                                            $bookedRoom = $bookedRoom->sortBy('room_id');
                                        @endphp

                                        <td>
                                            <button @if (!$activeBooking || $key < now()->format('Y-m-d') || !can('admin.booking.booked.day.cancel')) disabled @endif class="btn btn--danger cancelBookingBtn" data-booked_for="{{ $key }}" data-fare="{{ showAmount($totalFare) }} {{ __($general->cur_text) }}" data-should_refund="{{ showAmount($shouldRefund) }} {{ __($general->cur_text) }}" type="button">@lang('Cancel Booking')</button>
                                        </td>

                                        <td>
                                            {{ showDateTime($key, 'd M, Y') }}
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-end flex-wrap gap-2">
                                                @foreach ($bookedRoom as $item)
                                                    @if ($item->status == Status::BOOKED_ROOM_CANCELED)
                                                        <div class="bg--danger room-container rounded p-2">
                                                            <span class="d-block text--white">
                                                                Bed Name : {{ __($item->room->room_number) }}
                                                            </span>
                                                            <span class="d-block text--white">
                                                                Room Number : {{ __($item->room->room->bed_name) }}
                                                            </span>
                                                        </div>
                                                    @elseif($item->status == status::BOOKED_ROOM_CHECKOUT)
                                                        <div class="bg--dark room-container rounded p-2">
                                                            <span class="d-block text--white">
                                                                Bed Name : {{ __($item->room->room_number) }}
                                                            </span>
                                                            <span class="d-block text--white">
                                                                Room Type : {{ __($item->room->room->roomType->name) }}<br>
                                                                Room Number : {{ __($item->room->room->bed_name) }}
                                                            </span>
                                                        </div>
                                                    @elseif($item->status == Status::BOOKED_ROOM_ACTIVE)
                                                        <div class="bg--18 room-container rounded p-2">
                                                            <span class="d-block text--white">
                                                                Bed Name : {{ __($item->room->room_number) }}
                                                            </span>
                                                            <span class="d-block text--white">
                                                                Room Type : {{ optional($item->room->room->roomType)->name }}<br>
                                                                Room Number : {{ $item->room->room->bed_name }}
                                                            </span>

                                                            @if (now()->toDateString() <= $item->booked_for)
                                                                @can('admin.booking.booked.room.cancel')
                                                                    <button class="cancel-btn cancelBookingBtn" data-fare="{{ showAmount($item->fare) }} {{ __($general->cur_text) }}" data-id="{{ $item->id }}" data-room_number="{{ $item->room->room_number }}" data-should_refund="{{ showAmount($item->fare - $item->cancellation_fee) }} {{ __($general->cur_text) }}" type="button"><i class="las la-times"></i>
                                                                    </button>
                                                                @endcan
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
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

    {{-- cancel booking --}}
    @can(['admin.booking.booked.day.cancel', 'admin.booking.booked.room.cancel'])
        <div class="modal fade" id="cancelBookingModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input name="booked_for" type="hidden" value="">
                            <div class="row justify-content-center">
                                <div class="col-10 bg--danger p-3 rounded">
                                    <div class="d-flex flex-wrap justify-content-between gap-2">
                                        <h6 class="text-white">@lang('Fare')</h6>
                                        <span class="text-white totalFare"></span>
                                    </div>

                                    <div class="d-flex flex-wrap justify-content-between gap-2 mt-2">
                                        <h6 class="text-white">@lang('Refundable Amount')</h6>
                                        <span class="text-white refundableAmount"></span>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <h6 class="w-100">@lang('Are you sure to cancel this booking?')</h6>
                            <button aria-label="Close" class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('No')</button>
                            <button class="btn btn--primary" type="submit">@lang('Yes')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

@endsection

@can('admin.booking.all')
    @push('breadcrumb-plugins')
        <x-back route="{{ route('admin.booking.all') }}" />
    @endpush
@endcan

@push('script')
    <script>
        (function($) {
            "use strict";
            var previous = @json(url()->previous());
            $(`.sidebar__menu li a[href="${previous}"]`).closest('li').addClass('active');

            $('.cancelBookingBtn').on('click', function() {
                let modal = $('#cancelBookingModal');
                let data = $(this).data();
                let action;
                if (data.booked_for) {
                    action = `{{ route('admin.booking.booked.day.cancel', $booking->id) }}`;
                    modal.find('[name=booked_for]').val(data.booked_for);
                } else {
                    action = `{{ route('admin.booking.booked.room.cancel', '') }}/${data.id}`;
                }

                modal.find('.modal-title').text(`@lang('Cancel Booking')`);
                modal.find('form').attr('action', action);
                modal.find('.totalFare').text(data.fare);
                modal.find('.refundableAmount').text(data.should_refund);
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush
