@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two" id="datatable">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('User')</th>
                                    <th>@lang('Accommodation')</th>
                                     <th>@lang('Room')</th>
                                     <th>@lang('Room Type')</th>
                                     <th>@lang('Bed')</th>
                                     <th>@lang('Fine Items')</th>
                                     <th>@lang('Damage Items')</th>
                                     <th>@lang('Status')</th>
                                      <th>@lang('Remarks')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roomitem_inspections as $inspections)
                                    <tr>
                                        <td>{{ $inspections->id }}</td>
                                        
                                        <td>{{ __($inspections->admin->name) }}</td>
                                        <td>{{ __($inspections->accommodation->name) }}</td>
                                        <td>{{ __($inspections->room?->bed_name) }}</td>
                                        <td>{{ __($inspections->room?->roomType?->name) }}</td>
                                        <td>{{ __($inspections->bed?->room_number) }}</td>
                                         <td>
                                            @if($inspections->room_item_id)
                                            @foreach(json_decode($inspections->room_item_id) as $row)
                                            @php
                                            $item = \App\Models\RoomItem::find($row);
                                            @endphp
                                            <span class="badge badge--success">{{$item?->name}}</span>
                                            @endforeach
                                            @endif
                                        </td>
                                         <td>
                                            @if($inspections->damage_room_item_id)
                                            @foreach(json_decode($inspections->damage_room_item_id) as $row)
                                            @php
                                            $item = \App\Models\RoomItem::find($row);
                                            @endphp
                                            <span class="badge badge--success">{{$item?->name}}</span>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>{{ __($inspections->status) }}</td>
                                        <td>{{ __($inspections->remarks) }}</td>
                                    </tr>
                               
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
              
            </div>
        </div>
    </div>

 @can('admin.hotel.bed.store')
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
                    <form action="{{ route('admin.hotel.room-item.store.inspection') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            
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
                                <label> @lang('Room')</label>
                                       
                                    <select class="form-control"  name="room_id" id="room_id" required>
                                            <option disable selected value="">Select Room</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label> @lang('Bed')</label>
                                       
                                    <select class="form-control"  name="bed_id" id="bed_id" required>
                                            <option disable selected value="">Select Bed</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label> @lang('Fine Items')</label>
                                       
                                    <select multiple="multiple"  name="room_item_id[]" id="room_item_id">
                                    </select>
                            </div>
                            <div class="form-group">
                                <label> @lang('Damage Items')</label>
                                       
                                    <select multiple="multiple"  name="damage_room_item_id[]" id="damage_room_item_id">
                                    </select>
                            </div>
                             <div class="form-group">
                                 <label for="status">Status</label>
                                    <div>
                                        <input type="radio" id="checkin" name="status" value="checkin" checked>
                                        <label for="checkin">Checkin</label>
                                
                                        <input type="radio" id="checkout" name="status" value="checkout">
                                        <label for="checkout">Checkout</label>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea id="remarks" name="remarks" rows="4" cols="50"></textarea>
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


    <!--@can('admin.hotel.bed.delete')-->
    <!--    <x-confirmation-modal />-->
    <!--@endcan-->
@endsection
@can('admin.hotel.bed.save')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('RoomItem Inspecction')" type="button">
            <i class="las la-plus"></i>@lang('RoomItem Inspecction ')
        </button>
    @endpush
@endcan
@push('script')
<link rel="stylesheet" href="https://springstubbe.us/projects/jquery-multiselect/styles/index.css?1647360365" type ="text/css" />
<script type="text/javascript" src="https://springstubbe.us/projects/jquery-multiselect/scripts/index.js?1647362994"></script>

    <script>
     $('select[multiple]').multiselect({
    search   : true,
    selectAll: true,
    texts    : {
        placeholder: 'Select Items',
        search     : 'Search Items'
    }
});
    </script>
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
                var room_id = $('#room_id');
                var room_item_id = $('#room_item_id');
                var damage_room_item_id = $('#damage_room_item_id');
                var options = [];
        
                room_id.empty(); 
                room_item_id.empty(); 
                damage_room_item_id.empty(); 
        
                if (accommodationId) {
                    $.get('{{ route('admin.hotel.room.room', ['accommodation_id' => ':accommodation_id']) }}'.replace(':accommodation_id', accommodationId), function (data) {
                        room_id.append('<option value="">Select Bed</option>');
                        $.each(data.rooms, function (key, value) {
                            room_id.append('<option value="' + value.id + '">' + value.bed_name + '</option>');
                        });
                        $.each(data.items, function (key, value) {
                            // room_item_id.append('<option value="' + value.id + '">' + value.name + '</option>');
                            options.push({
                                name   : value.name,
                                value  : value.id,
                            });
                        });
                        // $.each(data.items, function (key, value) {
                        //     damage_room_item_id.append('<option value="' + value.id + '">' + value.name + '</option>');
                        // });
        
                        $('select[multiple]').multiselect('loadOptions',options);
                        room_id.prop('disabled', data.rooms.length === 0);
                        room_item_id.prop('disabled', data.items.length === 0);
                        damage_room_item_id.prop('disabled', data.items.length === 0);
                    });
                } else {
                    room_id.prop('disabled', true);
                    room_item_id.prop('disabled', true);
                    damage_room_item_id.prop('disabled', true);
                }
            });
            $('#room_id').change(function () {
                var room_id = $(this).val();
                var bed_id = $('#bed_id');
                bed_id.empty(); 
                if (room_id) {
                    $.get('{{ route('admin.bed.get', ['room_id' => ':room_id']) }}'.replace(':room_id', room_id), function (data) {
                        bed_id.append('<option value="">Select Bed</option>');
                        $.each(data, function (key, value) {
                            bed_id.append('<option value="' + value.id + '">' + value.room_number + '</option>');
                        });
                    bed_id.prop('disabled', data.length === 0);
                    });
                } else {
                    bed_id.prop('disabled', true);
                }
            });
        
        });


</script>
@endpush
