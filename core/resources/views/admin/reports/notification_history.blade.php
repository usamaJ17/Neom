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
                                    <th>@lang('User')</th>
                                    <th>@lang('Sent')</th>
                                    <th>@lang('Sender')</th>
                                    <th>@lang('Subject')</th>
                                    @can('admin.report.email.details')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        @if ($log->user != null)
                                            <td data-label="@lang('User')">
                                                <span class="fw-bold">{{ $log->user->fullname }}</span>
                                                @can('admin.users.detail')
                                                    <br>
                                                    <span class="small">
                                                        <a href="{{ route('admin.users.detail', $log->user_id) }}"><span>@</span>{{ $log->user->username }}</a>
                                                    </span>
                                                @endcan
                                            </td>
                                        @else
                                            <td data-label="@lang('User')">
                                                <span class="small">
                                                </span>
                                            </td>
                                        @endif
                                        <td data-label="@lang('Sent')">
                                            {{ showDateTime($log->created_at) }}
                                            <br>
                                            {{ $log->created_at->diffForHumans() }}
                                        </td>
                                        <td data-label="@lang('Sender')">
                                            <span class="fw-bold">{{ __($log->sender) }}</span>
                                        </td>
                                        <td data-label="@lang('Subject')">{{ __($log->subject) }}</td>
                                        @can('admin.report.email.details')
                                            <td data-label="@lang('Action')">
                                                <button @if ($log->notification_type == 'email') data-message="{{ route('admin.report.email.details', $log->id) }}" @else data-message="{{ $log->message }}" @endif class="btn btn-sm btn-outline--primary notifyDetail" data-sent_to="{{ $log->sent_to }}" data-type="{{ $log->notification_type }}" target="_blank"><i class="las la-desktop"></i> @lang('Detail')</button>
                                            </td>
                                        @endcan
                                    </tr>
                                
                                @endforeach
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
              
            </div><!-- card end -->
        </div>
    </div>

    @can('admin.report.email.details')
        <div aria-hidden="true" aria-labelledby="notifyDetailModalLabel" class="modal fade" id="notifyDetailModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notifyDetailModalLabel">@lang('Notification Details')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><i class="las la-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center mb-3">@lang('To'): <span class="sent_to"></span></h3>
                        <div class="detail"></div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection

@if (@$user)
    @push('breadcrumb-plugins')
        @if (@$user)
            @can('admin.users.notification.single')
                <a class="btn btn-outline--primary btn-sm" href="{{ route('admin.users.notification.single', $user->id) }}"><i class="las la-paper-plane"></i> @lang('Send Notification')</a>
            @endcan
        @else
            <form action="" class="form-inline float-sm-end" method="GET">
                <div class="input-group">
                    <input class="form-control bg--white" name="search" placeholder="@lang('Search Username')" type="text" value="{{ request()->search }}">
                    <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        @endif
    @endpush
@endif

@push('script')
    <script>
        $('.notifyDetail').click(function() {
            var message = $(this).data('message');
            var sent_to = $(this).data('sent_to');
            var modal = $('#notifyDetailModal');
            if ($(this).data('type') == 'email') {
                var message = `<iframe src="${message}" height="500" width="100%" title="Iframe Example"></iframe>`
            }
            $('.detail').html(message)
            $('.sent_to').text(sent_to)
            modal.modal('show');
        });
    </script>
@endpush
