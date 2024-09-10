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
                                    <th>@lang('S.N.') </th>
                                    <th>@lang('Username') | @lang('Email')</th>
                                    <th>@lang('Room Qty') | @lang('Room Type')</th>
                                    <th>@lang('Check In') | @lang('Check Out')</th>
                                    <th>@lang('Booked For')</th>
                                    <th>@lang('Fare /Night') | @lang('Total Fare')</th>
                                    @can(['admin.request.booking.approve', 'admin.request.booking.cancel'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookingRequests as $bookingRequest)
                                    <tr>
                                        <td> {{ $bookingRequest->id }}</td>
                                        <td>
                                            <span class="small">

                                                @can('admin.users.detail')
                                                    <a href="{{ route('admin.users.detail', $bookingRequest->user_id) }}">
                                                        <span>@</span>{{ $bookingRequest->user->username }}
                                                    </a>
                                                @else
                                                    {{ $bookingRequest->user->username }}
                                                @endcan
                                            </span>
                                            <br>
                                            <span>+{{ $bookingRequest->user->mobile }}</span>
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
                                            {{ showDateTime($bookingRequest->check_out, 'd M, Y') }}
                                        </td>

                                        <td>
                                            {{ $bookingRequest->bookFor() }} @lang('Night')
                                            <br>
                                            <span>
                                                {{ $bookingRequest->number_of_rooms }} @lang('Room')
                                            </span>
                                        </td>
                                        <td>
                                            {{ __($general->cur_sym) }}{{ showAmount($bookingRequest->unit_fare) }}
                                            <span class="text--danger">+ {{ showAmount($bookingRequest->taxPercentage()) }}% {{ __($general->tax_name) }}</span>
                                            <br>
                                            <span class="fw-bold">{{ __($general->cur_sym) }}{{ showAmount($bookingRequest->total_amount) }}</span>
                                        </td>

                                        @can(['admin.request.booking.approve', 'admin.request.booking.cancel'])
                                            <td>
                                                @can('admin.request.booking.approve')
                                                    <a class="btn btn-sm btn-outline--success ms-1" href="{{ route('admin.request.booking.approve', $bookingRequest->id) }}"><i class="las la-check"></i>@lang('Approve')</a>
                                                @endcan

                                                @can('admin.request.booking.cancel')
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn ms-1" data-action="{{ route('admin.request.booking.cancel', $bookingRequest->id) }}" data-question="@lang('Are you sure, you want to cancel this booking request?')">
                                                        <i class="las la-times-circle"></i>@lang('Cancel')
                                                    </button>
                                                @endcan
                                            </td>
                                        @endcan
                                    </tr>
                                
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    @can('admin.request.booking.cancel')
        <x-confirmation-modal />
    @endcan
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="User/Email" />
    @can('admin.booking.active')
        <a class="btn btn--success" href="{{ route('admin.booking.active') }}"><i class="las la-check-circle"></i>@lang('Active Bookings')</a>
    @endcan

    @can('admin.request.booking.canceled')
        <a class="btn btn-outline--danger" href="{{ route('admin.request.booking.canceled') }}"><i class="las la-times-circle"></i>@lang('Canceled Requests')</a>
    @endcan
@endpush
