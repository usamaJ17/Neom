<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="card-title">@lang('Payment Info')</h5>
            @can('admin.booking.details')
                <a class="btn btn-sm btn--primary" href="{{ route('admin.booking.details', $booking->id) }}"> <i class="las la-desktop"></i>@lang('View Details')</a>
            @endcan
        </div>
        <div class="list">
            <div class="list-item">
                <span>@lang('Total Fare')</span>
                <span class="text-end">+{{ $general->cur_sym . showAmount($totalFare) }}</span>
            </div>

            <div class="list-item">
                <span>{{ __($general->tax_name) }} @lang('Charge')</span>
                <span class="text-end">+{{ $general->cur_sym . showAmount($totalTaxCharge) }}</span>
            </div>

            <div class="list-item">
                <span>@lang('Canceled Fare')</span>
                <span class="text-end">-{{ $general->cur_sym . showAmount($canceledFare) }}</span>
            </div>

            <div class="list-item">
                <span>@lang('Canceled') {{ __($general->tax_name) }} @lang('Charge')</span>
                <span class="text-end">-{{ $general->cur_sym . showAmount($canceledTaxCharge) }}</span>
            </div>

            <div class="list-item">
                <span>@lang('Extra Service Charge')</span>
                <span class="text-end">+{{ $general->cur_sym . showAmount($booking->service_cost) }}</span>
            </div>

            <div class="list-item">
                <span>@lang('Other Charges')</span>
                <span class="text-end">+{{ $general->cur_sym . showAmount($booking->extraCharge()) }}</span>
            </div>

            <div class="list-item">
                <span>@lang('Cancellation Fee')</span>
                <span class="text-end">+{{ $general->cur_sym . showAmount($booking->cancellation_fee) }}</span>
            </div>

            <div class="list-item">
                <span class="fw-bold">@lang('Total Amount')</span>
                <span class="fw-bold text-end"> = {{ $general->cur_sym . showAmount($booking->total_amount) }}</span>
            </div>

        </div>
    </div>
</div>
