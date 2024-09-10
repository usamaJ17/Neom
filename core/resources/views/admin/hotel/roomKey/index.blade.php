
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
                                    <th>@lang('S.N')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Room')</th>
                                    <th>@lang('Bed')</th>
                                    <th>@lang('Bed Key')</th>
                                    <th>@lang('Spare Key')</th>
                                    @can(['admin.hotel.roomKey.all.*'])
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roomkeys as $roomkey)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $roomkey->room?->accommodation?->name }} </td>
                                        <td> {{ $roomkey->room?->bed_name }} </td>
                                        <td> {{ $roomkey->bed?->room_number }} </td>
                                        <td> {{ $roomkey->room_key }} </td>
                                        <td> {{ $roomkey->spare_key }} </td>
                                       
                                       <td>
                                            <div class="button--group">
                                                @can('admin.hotel.roomKey.save')
                                                    <button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="@lang('Update Accommodation')" data-resource="{{ $roomkey }}" type="button">
                                                        <i class="la la-pencil"></i>@lang('Edit')
                                                    </button>
                                                @endcan
                                                @can('admin.hotel.roomKey.delete')
                                                    <form action="{{ route('admin.hotel.roomKey.delete', ['id' => $roomkey->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete room key?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="event_id" value="{{ $roomkey->event_id }}">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
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

  

 @can('admin.hotel.accommodations.save')
        {{-- Add METHOD MODAL --}}
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Add Room Key')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.hotel.roomKey.save') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Room key')</label>
                                <div class="input-group">
                                    <input class="form-control" name="room_key" required step="0.01" type="text" id="room_Key" value="{{ old('room_key') }}">
                                    <span class="input-group-text" onclick="generateRoomKey()"><i class="fa fa-random"></i></span>
                                </div>
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
                                <label> @lang('Room')</label>
                                <select class="form-select" name="room" id="bed_id" required value="{{ old('room_id')}}">
                                    <option value="">Select Room</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label> @lang('Bed')</label>
                                <select class="form-select" name="bed_type_id" id="room_id" required value="{{ old('bed_type_id')}}">
                                    <option value="">Select Bed</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label> @lang('Spare key') (Optional) </label>
                                <div class="input-group">
                                    <input class="form-control" name="spare_key" step="0.01" type="text" id="spare_key" value="{{ old('spare_key') }}">
                                    <span class="input-group-text" onclick="generateSpareKey()"><i class="fa fa-random"></i></span>
                                </div>
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
    @can('admin.hotel.roomKey.all')
        <x-confirmation-modal />
    @endcan
@endsection
@can('admin.hotel.roomKey.all')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add Room Key')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    @endpush
@endcan

@push('script')
<script>
            $(document).ready(function () {
            $('#accommodation').change(function () {
                var accommodationId = $(this).val();
                var room_id = $('#room_id');
                var bed_id = $('#bed_id');
        
                room_id.empty(); // Clear the dropdown before appending options
                bed_id.empty(); // Clear the dropdown before appending options
        
                if (accommodationId) {
                    $.get('{{ route('admin.hotel.room.room', ['accommodation_id' => ':accommodation_id']) }}'.replace(':accommodation_id', accommodationId), function (data) {
                        room_id.append('<option value="">Select Bed</option>');
                        bed_id.append('<option value="">Select Room</option>');
                        $.each(data.rooms, function (key, value) {
                            bed_id.append('<option value="' + value.id + '">'+value.bed_name+'</option>');
                        });
                        bed_id.prop('disabled', data.rooms.length === 0);
                    });
                } else {
                    room_id.prop('disabled', true);
                    bed_id.prop('disabled', true);
                }
            });
            $('#bed_id').change(function () {
                var bed_id = $(this).val();
                var room_id = $('#room_id');
        
                room_id.empty(); // Clear the dropdown before appending options
        
                if (bed_id) {
                    $.get('{{ route('admin.bed.get', ['room_id' => ':room_id']) }}'.replace(':room_id', bed_id), function (data) {
                        room_id.append('<option value="">Select Bed</option>');
                        $.each(data, function (key, value) {
                            room_id.append('<option value="' + value.id + '">' + value.room_number + '</option>');
                        });
        
                        room_id.prop('disabled', data.length === 0);
                    });
                } else {
                    room_id.prop('disabled', true);
                }
            });
        });

</script>
<script>
    function generateSpareKey() {
      
         var randomRoomKey = Math.floor(Math.random() * 100000000);

        document.getElementById('spare_key').value = randomRoomKey;
    }
    function generateRoomKey() {
      
         var randomRoomKey = Math.floor(Math.random() * 100000000);

        document.getElementById('room_Key').value = randomRoomKey;
    }
</script>
@endpush




