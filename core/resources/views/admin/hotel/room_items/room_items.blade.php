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
                                    <th>@lang('Item Name')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Quantity')</th>
                                    <th>@lang('Tags')</th>
                                    <th>@lang('Status')</th>
                                    @can(['admin.hotel.room-item.*'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roomitems as $item)
                                    <tr>
                                        <td> {{ $item->name }}</td>
                                        <td>{{$item->accommodation->name}}</td>
                                        <td> {{ $item->quantity }} </td>
                                        <td> 
                                        @if($item->tags && is_array(json_decode($item->tags)))
                                            @foreach(json_decode($item->tags) as $row)
                                            <span class="badge badge--success">{{ $row }}</span>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td> {{ $item->status }} </td>
                                        <td>
                                            <div class="button--group">
                                                @can('admin.hotel.room-item.save')
                                                    <button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="@lang('Update Room Item')" data-resource="{{ $item }}" type="button">
                                                        <i class="la la-pencil"></i>@lang('Edit')
                                                    </button>
                                                @endcan
                                                @can('admin.hotel.room-item.status')
                                                    @if ($item->status == Status::DISABLE)
                                                        <button class="btn btn-sm btn-outline--success me-1 confirmationBtn" data-action="{{ route('admin.hotel.room-item.status', $item->id) }}" data-question="@lang('Are you sure to enable this room-item?')" type="button">
                                                            <i class="la la-eye"></i> @lang('Enable')
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.hotel.room-item.status', $item->id) }}" data-question="@lang('Are you sure to disable this room-item?')" type="button">
                                                            <i class="la la-eye-slash"></i> @lang('Disable')
                                                        </button>
                                                    @endif
                                                @endcan
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

    @can('admin.hotel.room-item.save')
        {{-- Add METHOD MODAL --}}
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Add Room Items')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.hotel.room-item.save') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Room Item')</label>
                              
                                <input class="form-control" name="name" required type="text" value="{{ old('name') }}">
                            </div>
                            
                             <div class="form-group">
                                <label> @lang('quantity')</label>
                              
                                <input class="form-control" name="quantity" required type="number" value="{{ old('quantity') }}">
                            </div>
                            
                              <div class="form-group">
                                <label> @lang('Tags')</label>
                                <select class="form-control select2-auto-tokenize" multiple="multiple" name="tags[]" required></select>
                                    <small class="ml-2 mt-2">Separate multiple Tags by <code>,</code>(comma)
                                        or <code>enter</code> key</small>
                            </div>
                            
                            <div class="form-group">
                                <label> @lang('Accommodation')</label>
                                       
                                    <select class="form-control"  name="accommodation_id" class="accommodation">
                                            <option disbale selected value="">Select an Accommodation</option>
                                        @foreach ($accommodations as $accommodation)
                                            <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                                        @endforeach
                                    </select>
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
    @can('admin.hotel.room-item.status')
        <x-confirmation-modal />
    @endcan
@endsection
@can('admin.hotel.room-item.save')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add Room Items')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    @endpush
@endcan


