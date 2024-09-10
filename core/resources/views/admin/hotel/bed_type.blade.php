@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Room Numberss')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Type')</th>
                                    @can('admin.hotel.bed.*')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bedTypes as $item)
                                    <tr>
                                        <td>{{ __($item->bed_name) }}</td>
                                        <td>{{ __($item->accommodation->name) }}</td>
                                        <td>{{ __($item->roomType?->name) }}</td>
                                        <td>
                                            @can('admin.hotel.bed.save')
                                                <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Update Room')" data-resource="{{ $item }}" type="button">
                                                    <i class="la la-pencil"></i>@lang('Edit')
                                                </button>
                                            @endcan
                                            @can('admin.hotel.bed.delete')
                                                <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.hotel.bed.delete', $item->id) }}" data-question="@lang('Are you sure, you want to delete this room?')" type="button">
                                                    <i class="la la-trash"></i>@lang('Delete')
                                                </button>
                                            @endcan
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

    @can('admin.hotel.bed.save')
    @php
    $room_types = \App\Models\RoomType::when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get(); 
        
    $room_items = \App\Models\RoomItem::when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
    @endphp
    
        {{-- Add METHOD MODAL --}}
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.hotel.bed.save') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Room Name')</label>
                                <input class="form-control" name="bed_name" required type="text" value="{{ old('bed_name') }}">
                            </div>
                             <div class="form-group">
                                <label> @lang('Accommodation')</label>
                                <select class="form-control"  name="accommodation_id" id="accommodation" required>
                                        <option disable selected value="">Select an Accommodation</option>
                                    @foreach ($accommodations as $accommodation)
                                        <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                <label> @lang('Room Type')</label>
                                <select class="form-control"  name="room_type_id" id="room_type_id" required>
                                        <option value="">Select Room Type</option>
                                         @foreach ($room_types as $accommodation)
                                        <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                    <label> @lang('Room Items')</label>
                                    <select class="select2-multi-select" multiple="multiple" name="roomitems[]" id="roomitems" required>
                                         @foreach ($room_items as $accommodation)
                                        <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="status"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('admin.hotel.bed.delete')
        <x-confirmation-modal />
    @endcan
@endsection
@can('admin.hotel.bed.save')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Room')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    @endpush
@endcan
@push('script')
    <script>
        (function($) {
            "use strict";

            $('#cuModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });

        })(jQuery);
    </script>
      <script>
            $(document).ready(function () {
            $('#accommodation').change(function () {
                var accommodationId = $(this).val();
                var room_type_id = $('#room_type_id');
                var roomitems = $('#roomitems');
        
                room_type_id.empty(); // Clear the dropdown before appending options
                room_type_id.append('<option value="">Select Room Type</option>');
                roomitems.empty(); // Clear the dropdown before appending options
        
                if (accommodationId) {
                    $.get('{{ route('admin.hotel.room.room', ['accommodation_id' => ':accommodation_id']) }}'.replace(':accommodation_id', accommodationId), function (data) {
                        
                        $.each(data.roomtypes, function (key, value) {
                            room_type_id.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $.each(data.items, function (key, value) {
                            roomitems.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
        
                        room_type_id.prop('disabled', data.roomtypes.length === 0);
                        roomitems.prop('disabled', data.items.length === 0);
                    });
                } else {
                    room_type_id.prop('disabled', true);
                    roomitems.prop('disabled', true);
                }
            });
        
        });


</script>
@endpush
