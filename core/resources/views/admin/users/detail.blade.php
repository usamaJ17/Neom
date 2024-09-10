@extends('admin.layouts.app')

@section('panel')
    <div class="row gy-4">
        <div class="col-12">
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6">
                    <div class="widget-two style--two box--shadow2 b-radius--5 bg--info overflow-hidden">
                        <a class="item-link" href="@if (can('admin.booking.all')) {{ route('admin.booking.all') }}?search={{ $user->username }} @else javascript:void(0) @endif"></a>
                        <div class="widget-two__icon b-radius--5 bg--info">
                            <i class="las la-wallet"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="text-white">{{ $widget['total_bookings'] }}</h3>
                            <p class="text-white">@lang('Total Bookings')</p>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-sm-6">
                    <div class="widget-two style--two box--shadow2 b-radius--5 bg--success overflow-hidden">
                        <a class="item-link" href="@if (can('admin.booking.active')) {{ route('admin.booking.active') }}?search={{ $user->username }} @else javascript:void(0) @endif"></a>
                        <div class="widget-two__icon b-radius--5 bg--success">
                            <i class="las la-ban"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="text-white">{{ $widget['running_bookings'] }}</h3>
                            <p class="text-white">@lang('Running Bookings')</p>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->

                <div class="col-xxl-3 col-sm-6">
                    <div class="widget-two style--two box--shadow2 b-radius--5 bg--warning">
                        <a class="item-link" href="@if (can('admin.request.booking.all')) {{ route('admin.request.booking.all') }}?search={{ $user->username }} @else javascript:void(0) @endif"></a>
                        <div class="widget-two__icon b-radius--5 bg--warning">
                            <i class="las la-wallet"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="text-white">{{ $widget['booking_requests'] }}</h3>
                            <p class="text-white">@lang('Booking Request')</p>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->

                <div class="col-xxl-3 col-sm-6">
                    <div class="widget-two style--two box--shadow2 b-radius--5 bg--3">
                        <a class="item-link" href="@if (can('admin.report.payments.received')) {{ route('admin.report.payments.received') }}?search={{ $user->username }} @else javascript:void(0) @endif"></a>
                        <div class="widget-two__icon b-radius--5 bg--3">
                            <i class="las la-wallet"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="text-white">{{ $general->cur_sym . showAmount($widget['total_payment']) }}</h3>
                            <p class="text-white">@lang('Total Payment')</p>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->
            </div>
        </div>

        <div class="col-12">
            <div class="row gy-4">
                @can('admin.users.notification.log')
                    <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-3">
                        <a class="btn btn--primary btn--shadow w-100 btn-lg" href="{{ route('admin.users.notification.log', $user->id) }}">
                            <i class="las la-bell"></i>@lang('Notifications')
                        </a>
                    </div>
                @endcan
                @can('admin.report.login.history')
                    <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-3">
                        <a class="btn btn--info btn--shadow w-100 btn-lg" href="{{ route('admin.report.login.history') }}?search={{ $user->username }}">
                            <i class="las la-list-alt"></i>@lang('Logins')
                        </a>
                    </div>
                @endcan

                @can('admin.users.login')
                    <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-3">
                        <a class="btn btn--dark btn--shadow w-100 btn-lg" href="{{ route('admin.users.login', $user->id) }}" target="_blank">
                            <i class="las la-sign-in-alt"></i>@lang('Login as Guest')
                        </a>
                    </div>
                @endcan

                @can('admin.users.status')
                    <div class="col-sm-6 col-lg-4 col-xl-3 col-xxl-3">
                        @if ($user->status == Status::USER_ACTIVE)
                            <button class="btn btn--warning btn--gradi btn--shadow w-100 btn-lg userStatus" data-bs-target="#userStatusModal" data-bs-toggle="modal" type="button">
                                <i class="las la-ban"></i>@lang('Ban User')
                            </button>
                        @else
                            <button class="btn btn--success btn--gradi btn--shadow w-100 btn-lg userStatus" data-bs-target="#userStatusModal" data-bs-toggle="modal" type="button">
                                <i class="las la-check"></i>@lang('Unban User')
                            </button>
                        @endif
                    </div>
                @endcan
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">@lang('Information of') {{ $user->fullname }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', [$user->id]) }}" enctype="multipart/form-data" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('First Name')</label>
                                    <input class="form-control" name="firstname" required type="text" value="{{ $user->firstname }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Last Name')</label>
                                    <input class="form-control" name="lastname" required type="text" value="{{ $user->lastname }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Email')</label>
                                    <input class="form-control" name="email" required type="email" value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Mobile Number') </label>
                                    <div class="input-group">
                                        <span class="input-group-text mobile-code"></span>
                                        <input class="form-control checkUser" id="mobile" name="mobile" required type="number" value="{{ old('mobile') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Address')</label>
                                    <input class="form-control" name="address" type="text" value="{{ @$user->address->address }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label>@lang('City')</label>
                                    <input class="form-control" name="city" type="text" value="{{ @$user->address->city }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label>@lang('State')</label>
                                    <input class="form-control" name="state" type="text" value="{{ @$user->address->state }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label>@lang('Zip/Postal')</label>
                                    <input class="form-control" name="zip" type="text" value="{{ @$user->address->zip }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label>@lang('Country')</label>
                                    <select class="form-control" name="country">
                                        @foreach ($countries as $key => $country)
                                            <option data-mobile_code="{{ $country->dial_code }}" value="{{ $key }}">{{ __($country->country) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xl-6 col-md-6 col-sm-3 col-12">
                                <label>@lang('Email Verification')</label>
                                <input @if ($user->ev) checked @endif data-bs-toggle="toggle" data-off="@lang('Unverified')" data-offstyle="-danger" data-on="@lang('Verified')" data-onstyle="-success" data-width="100%" name="ev" type="checkbox">

                            </div>

                            <div class="form-group col-xl-6 col-md-6 col-sm-3 col-12">
                                <label>@lang('Mobile Verification')</label>
                                <input @if ($user->sv) checked @endif data-bs-toggle="toggle" data-off="@lang('Unverified')" data-offstyle="-danger" data-on="@lang('Verified')" data-onstyle="-success" data-width="100%" name="sv" type="checkbox">

                            </div>
                        </div>

                        @can('admin.users.update')
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')
                                        </button>
                                    </div>
                                </div>

                            </div>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- User-Status --}}
    @can('admin.users.status')
        <div class="modal fade" id="userStatusModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            @if ($user->status == Status::USER_ACTIVE)
                                <span>@lang('Ban User')</span>
                            @else
                                <span>@lang('Unban User')</span>
                            @endif
                        </h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            @if ($user->status == Status::USER_ACTIVE)
                                <h6 class="mb-2">@lang('If you ban this user he/she won\'t able to access his/her dashboard.')</h6>
                                <div class="form-group">
                                    <label>@lang('Reason')</label>
                                    <textarea class="form-control" name="reason" required rows="4"></textarea>
                                </div>
                            @else
                                <p><span>@lang('Ban reason was'):</span></p>
                                <p>{{ $user->ban_reason }}</p>
                                <h4 class="text-center mt-3">@lang('Are you sure to unban this user?')</h4>
                            @endif
                        </div>
                        <div class="modal-footer">
                            @if ($user->status == Status::USER_ACTIVE)
                                <button class="btn btn--primary h-45 w-100" type="submit">@lang('Submit')</button>
                            @else
                                <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('No')</button>
                                <button class="btn btn--primary" type="submit">@lang('Yes')</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@push('script')
    <script>
        (function($) {
            "use strict"

            let mobileElement = $('.mobile-code');
            $('select[name=country]').change(function() {
                mobileElement.text(`+${$('select[name=country] :selected').data('mobile_code')}`);
            });
            $('select[name=country]').val('{{ @$user->country_code }}');
            let dialCode = $('select[name=country] :selected').data('mobile_code');
            let mobileNumber = `{{ $user->mobile }}`;
            mobileNumber = mobileNumber.replace(dialCode, '');
            $('input[name=mobile]').val(mobileNumber);
            mobileElement.text(`+${dialCode}`);
        })(jQuery);
    </script>
@endpush
