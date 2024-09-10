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
                                    <th>@lang('Date')</th>
                                    <th>@lang('Room Number')</th>
                                    <th>@lang('Service')</th>
                                    <th>@lang('Quantity')</th>
                                    <th>@lang('Cost')</th>
                                    <th>@lang('Total')</th>
                                    <th>@lang('Added By')</th>
                                    @can('admin.extra.service.delete')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $service)
                                    <tr>
                                        <td>{{ $service->id }}</td>

                                        <td>
                                            <span class="fw-bold">{{ showDateTime($service->service_date, 'd M, Y') }}</span>
                                        </td>

                                        <td><span class="fw-bold">{{ $service->room->room_number }}</span></td>

                                        <td>{{ __($service->extraService->name) }}</td>

                                        <td>{{ $service->qty }}</td>

                                        <td>{{ $general->cur_sym }}{{ showAmount($service->unit_price) }}</td>

                                        <td>{{ $general->cur_sym }}{{ showAmount($service->total_amount) }}</td>

                                        <td>
                                            <span class="fw-bold">{{ __($service->admin->name) }}</span>
                                        </td>

                                        @can('admin.extra.service.delete')
                                            <td>
                                                <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.extra.service.delete', $service->id) }}" data-question="@lang('Are you sure, you want to delete this service?')">
                                                    <i class="las la-trash-alt"></i>@lang('Delete')
                                                </button>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
              
            </div>
        </div>
    </div>

    @can('admin.extra.service.delete')
        <x-confirmation-modal />
    @endcan
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Room No. / Service Name" />
@endpush
