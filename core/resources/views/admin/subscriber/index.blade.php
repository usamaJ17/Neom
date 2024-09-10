@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two" id="datatable">
                            <thead>
                                <tr>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Subscribe At')</th>
                                    @can('admin.subscriber.remove')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subscribers as $subscriber)
                                    <tr>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>{{ showDateTime($subscriber->created_at) }}</td>
                                        @can('admin.subscriber.remove')
                                            <td>
                                                <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.subscriber.remove', $subscriber->id) }}" data-question="@lang('Are you sure to remove this subscriber?')" type="button">
                                                    <i class="las la-trash"></i> @lang('Remove')
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
                        </table><!-- table end -->
                    </div>
                </div>
              
            </div><!-- card end -->
        </div>

    </div>

    @can('admin.subscriber.remove')
        <x-confirmation-modal />
    @endcan
@endsection

@can('admin.subscriber.send.email')
    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.subscriber.send.email') }}"><i class="las la-paper-plane"></i>@lang('Send Email')</a>
    @endpush
@endcan
