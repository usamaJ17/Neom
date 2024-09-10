@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light" id="datatable">
                            <thead>
                                <tr>
                                    <th>@lang('Subject')</th>
                                    <th>@lang('Submitted By')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Priority')</th>
                                    <th>@lang('Last Reply')</th>
                                    @can('admin.ticket.view')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            @can('admin.ticket.view')
                                                <a class="fw-bold" href="{{ route('admin.ticket.view', $item->id) }}"> [@lang('Ticket')#{{ $item->ticket }}] {{ strLimit($item->subject, 30) }} </a>
                                            @else
                                                <span class="fw-bold"> [@lang('Ticket')#{{ $item->ticket }}] {{ strLimit($item->subject, 30) }} </span>
                                            @endcan
                                        </td>

                                        <td>
                                            @if ($item->user_id)
                                                @can('admin.users.detail')
                                                    <a href="{{ route('admin.users.detail', $item->user_id) }}"> {{ __($item->user->fullname) }}</a>
                                                @else
                                                    <p class="fw-bold">{{ __($item->user->fullname) }}</p>
                                                @endcan
                                            @else
                                                <p class="fw-bold"> {{ $item->name }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @php echo $item->statusBadge; @endphp
                                        </td>
                                        <td>
                                            @if ($item->priority == Status::PRIORITY_LOW)
                                                <span class="badge badge--dark">@lang('Low')</span>
                                            @elseif($item->priority == Status::PRIORITY_MEDIUM)
                                                <span class="badge  badge--warning">@lang('Medium')</span>
                                            @elseif($item->priority == Status::PRIORITY_HIGH)
                                                <span class="badge badge--danger">@lang('High')</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ diffForHumans($item->last_reply) }}
                                        </td>
                                        @can('admin.ticket.view')
                                            <td>
                                                <a class="btn btn-sm btn-outline--primary ms-1" href="{{ route('admin.ticket.view', $item->id) }}">
                                                    <i class="las la-desktop"></i> @lang('Details')
                                                </a>
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
    
     @can('admin.ticket.store')
        {{-- Add METHOD MODAL --}}
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Add Ticket')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.ticket.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Subject')</label>
                                <input class="form-control" name="subject" required type="text" value="{{ old('subject') }}">
                            </div>
                            
                          
                            
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Message')</label>
                                <input class="form-control" name="message" required type="text" value="{{ old('message') }}">
                            </div>
                            
                          
                            
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    
    
@endsection

@can('admin.ticket.store')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add Ticket')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    @endpush
@endcan
