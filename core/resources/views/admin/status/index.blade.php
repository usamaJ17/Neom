
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
                                    <th>@lang('ID')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Room')</th>
                                    <th>@lang('Bed')</th>
                                    <th>@lang('Status')</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statuses as $roomkey)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $roomkey->accommodation?->name }} </td>
                                        <td> {{ $roomkey->room?->room?->bed_name }} </td>
                                        <td> {{ $roomkey->room?->room_number }} </td>
                                        <td>
                                            @if($roomkey->status == 'Awaiting Cleaning')
                                             <span class="badge badge--primary">{{ $roomkey->status}}</span> 
                                             @endif
                                             @if($roomkey->status == 'Under Maintenance')
                                             <span class="badge badge--warning">{{ $roomkey->status}}</span> 
                                             @endif
                                             @if($roomkey->status == 'Ready To Go')
                                             <span class="badge badge--success">{{ $roomkey->status}}</span> 
                                             @endif
                                        </td>
                                       <td>
                                            <div class="button--group">
                                                @if($roomkey->status != 'Awaiting Cleaning')
                                                <a href="{{route('admin.room.status.change',['id'=>$roomkey->id,'status' => 'Awaiting Cleaning'])}}" class="btn btn-sm btn-outline--primary">
                                                    @lang('Awaiting Cleaning')
                                                </a>
                                                @endif
                                                @if($roomkey->status != 'Under Maintenance')
                                                <a href="{{route('admin.room.status.change',['id'=>$roomkey->id,'status' => 'Under Maintenance'])}}" class="btn btn-sm btn-outline--warning">
                                                    @lang('Under Maintenance')
                                                </a>
                                                @endif
                                                @if($roomkey->status != 'Ready To Go')
                                                <a href="{{route('admin.room.status.change',['id'=>$roomkey->id,'status' => 'Ready To Go'])}}" class="btn btn-sm btn-outline--success">
                                                    @lang('Ready To Go')
                                                </a>
                                                @endif
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
                        <h5 class="modal-title"> @lang('Add Room Status')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.room.status.save') }}" method="POST">
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
                                <select class="form-control"  name="bed_id" id="bed_id" required>
                                        <option disable selected value="">Select Room</option>
                                </select>
                            </div>
                             <div class="form-group">
                                <label> @lang('Bed')</label>
                                <select class="form-control"  name="room_id" id="room_id" required>
                                    <option disable selected value="">Select Bed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> @lang('Bed Status')</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="">Select Status</option>
                                        <option value="Awaiting Cleaning"> Awaiting Cleaning </option>
                                        <option value="Under Maintenance"> Under Maintenance </option>
                                        <option value="Ready To Go"> Ready To Go </option>
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
        <x-confirmation-modal />
@endsection
@push('breadcrumb-plugins')
    <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add Room Status')" type="button">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush
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
@endpush