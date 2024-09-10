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
                                    <th>@lang('Username') | @lang('Email')</th>
                                    <th>@lang('Room Qty') | @lang('Room Type')</th>
                                    <th>@lang('Check In') | @lang('Check Out')</th>
                                    <th>@lang('Fare /Night') | @lang('Total Fare')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookingRequests as $bookingRequest)
                                    <tr>
                                        <td>
                                            <span class="small">
                                                @can('admin.users.detail')
                                                    <a href="{{ route('admin.users.detail', $bookingRequest->user_id) }}"><span>@</span>{{ $bookingRequest->user->username }}</a>
                                                @else
                                                    {{ $bookingRequest->user->username }}
                                                @endcan
                                            </span>
                                            <br>
                                            <span>{{ $bookingRequest->user->email }}</span>
                                        </td>

                                        <td>
                                            <span class="text--info fw-bold">
                                                {{ $bookingRequest->number_of_rooms }}
                                            </span>
                                            <br>
                                            <span class="fw-bold">{{ __($bookingRequest->roomType->name) }}</span>
                                        </td>

                                        <td>
                                            {{ showDateTime($bookingRequest->check_in, 'd M, Y') }}
                                            <br>
                                            <span class="text--info">@lang('to')</span>
                                            {{ showDateTime($bookingRequest->check_out, 'd M, Y') }}
                                        </td>

                                        <td>
                                            {{ __($general->cur_sym) }}{{ showAmount($bookingRequest->unit_fare) }}
                                            <br>
                                            <span class="fw-bold">{{ __($general->cur_sym) }}{{ showAmount($bookingRequest->total_amount) }}</span>
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
    <x-confirmation-modal />

    {{-- detail modal --}}
    <div class="modal fade" id="detailModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Booking Details')</h5>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Username/Email" />
    @can('admin.request.booking.all')
        <x-back route="{{ route('admin.request.booking.all') }}" />
    @endcan
@endpush
