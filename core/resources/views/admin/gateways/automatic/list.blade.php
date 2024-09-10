@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('Gateway')</th>
                                    <th>@lang('Supported Currency')</th>
                                    <th>@lang('Enabled Currency')</th>
                                    <th>@lang('Status')</th>

                                    @can(['admin.gateway.automatic.edit', 'admin.gateway.automatic.status'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gateways->sortBy('alias') as $k=>$gateway)
                                    <tr>
                                        <td>{{ __($gateway->name) }}</td>

                                        <td>
                                            {{ collect($gateway->supported_currencies)->count() }}
                                        </td>
                                        <td>
                                            {{ $gateway->currencies->count() }}
                                        </td>

                                        <td>
                                            @php
                                                echo $gateway->statusBadge;
                                            @endphp
                                        </td>
                                        @can(['admin.gateway.automatic.edit', 'admin.gateway.automatic.status'])
                                            <td>
                                                <div class="button--group">
                                                    @can('admin.gateway.automatic.edit')
                                                        <a class="btn btn-sm btn-outline--primary editGatewayBtn" href="{{ route('admin.gateway.automatic.edit', $gateway->alias) }}">
                                                            <i class="la la-pencil"></i> @lang('Edit')
                                                        </a>
                                                    @endcan

                                                    @can('admin.gateway.automatic.status')
                                                        @if ($gateway->status == Status::DISABLE)
                                                            <button class="btn btn-sm btn-outline--success ms-1 confirmationBtn" data-action="{{ route('admin.gateway.automatic.status', $gateway->id) }}" data-question="@lang('Are you sure to enable this gateway?')">
                                                                <i class="la la-eye"></i> @lang('Enable')
                                                            </button>
                                                        @else
                                                            <button class="btn btn-sm btn-outline--danger ms-1 confirmationBtn" data-action="{{ route('admin.gateway.automatic.status', $gateway->id) }}" data-question="@lang('Are you sure to disable this gateway?')">
                                                                <i class="la la-eye-slash"></i> @lang('Disable')
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <x-confirmation-modal />
@endsection
@push('breadcrumb-plugins')
    <div class="d-inline">
        <div class="input-group justify-content-end">
            <input class="form-control bg--white" name="search_table" placeholder="@lang('Search')..." type="text">
            <button class="btn btn--primary input-group-text"><i class="fa fa-search"></i></button>
        </div>
    </div>
@endpush
