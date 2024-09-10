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
                                    <th>@lang('Bed Name')</th>
                                    <th>@lang('Bed Type')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Room')</th>
                                    <th>@lang('Bed Status')</th>
                                    <th>@lang('Status')</th>
                                    @can('admin.hotel.room.status')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $room->room_number }}</td>
                                        <td> {{ $room->bedType?->name }}</td>
                                        <td>{{ optional($room->accommodation)->name }}</td>
                                        <td> {{ $room->room?->bed_name }}</td>
                                        <td>
                                            @if($room->roomStatus?->status == 'Awaiting Cleaning')
                                             <span class="badge badge--primary">{{ $room->roomStatus?->status}}</span> 
                                             @endif
                                             @if($room->roomStatus?->status == 'Under Maintenance')
                                             <span class="badge badge--warning">{{ $room->roomStatus?->status}}</span> 
                                             @endif
                                             @if($room->roomStatus?->status == 'Ready To Go')
                                             <span class="badge badge--success">{{ $room->roomStatus?->status}}</span> 
                                             @endif
                                            </td>
                                        <td> @php echo $room->statusBadge @endphp </td>
                                            <td>
                                                 <button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="@lang('Update Bed')" data-resource="{{ $room }}" type="button">
                                                        <i class="la la-pencil"></i>@lang('Edit')
                                                    </button>
                                                 @can('admin.hotel.room.delete')
                                                <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.hotel.room.delete', $room->id) }}" data-question="@lang('Are you sure, you want to delete this bed?')" type="button">
                                                    <i class="la la-trash"></i>@lang('Delete')
                                                </button>
                                            @endcan
                                        @can('admin.hotel.room.status')
                                                @if ($room->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.hotel.room.status', $room->id) }}" data-question="@lang('Are you sure to disable this bed?')" type="button">
                                                        <i class="la la-eye-slash"></i>@lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.hotel.room.status', $room->id) }}" data-question="@lang('Are you sure to enable this bed?')" type="button">
                                                        <i class="la la-eye"></i>@lang('Enable')
                                                    </button>
                                                @endif
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
 @can('admin.hotel.room.store')
 @php
        $bed_types = \App\Models\NewBedType::when(auth()->guard('admin')->user()->accommodation_id,function($q){
            $q->where('accommodation_id',auth()->guard('admin')->user()->accommodation_id);
        })->get();
        $new_rooms = \App\Models\BedType::when(auth()->guard('admin')->user()->accommodation_id,function($q){
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
                  
                    <form action="{{ route('admin.hotel.room.save') }}" method="POST">
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
                                    <label> @lang('Select Room')</label>
                                    <select class="form-control" name="room_id" id="room_id" required>
                                        <option disable selected value="">Select Room</option>
                                        @foreach ($new_rooms as $accommodation)
                                            <option value="{{ $accommodation->id }}">{{ $accommodation->bed_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                <label> @lang('Bed Name')</label>
                                <input class="form-control" name="room_number" required type="text" value="{{ old('room_number') }}">
                            </div>
                            <div class="form-group">
                                <label> @lang('Bed Type')</label>
                                <select class="form-control"  name="bed_type_id" id="bed_type_id" required>
                                    <option disable selected value="">Select a Bed Type</option>
                                    @foreach ($bed_types as $accommodation)
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
    @can('admin.hotel.room.status')
        <x-confirmation-modal />
    @endcan
@endsection


@can('admin.hotel.room.store')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Bed')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    @endpush
@endcan
@push('script')

<script>
    
              $(document).ready(function () {
            $(document).ready(function () {
            $('#accommodation').change(function () {
                var accommodationId = $(this).val();
                var room_id = $('#room_id');
                var bed_type_id = $('#bed_type_id');
        
                room_id.empty(); // Clear the dropdown before appending options
                bed_type_id.empty(); // Clear the dropdown before appending options
        
                if (accommodationId) {
                    $.get('{{ route('admin.room.get', ['accommodation_id' => ':accommodation_id']) }}'.replace(':accommodation_id', accommodationId), function (data) {
                        $.each(data.beds, function (key, value) {
                            room_id.append('<option value="' + value.id + '">' + value.bed_name + '</option>');
                        });
                        
                        $.each(data.bedtypes, function (key, value) {
                            bed_type_id.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
        
                        room_id.prop('disabled', data.beds.length === 0);
                        bed_type_id.prop('disabled', data.bedtypes.length === 0);
                    });
                } else {
                    room_id.prop('disabled', true);
                    bed_type_id.prop('disabled', true);
                }
            });
        
        });
        });

    


</script>
@endpush