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
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Room No')</th>
                                    <th>@lang('Bed Name')</th>
                                    <th>@lang('Bed Type')</th>
                                    <th>@lang('Status')</th>
                                    @can('admin.hotel.room.status')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td> {{ $room->accommodation?->name }}</td>
                                        <td> {{ $room->room?->bed_name }}</td>
                                        <td> {{ $room->room_number }}</td>
                                        <td>{{ __($room->bedType?->name) }}</td>
                                        <td> @php echo $room->statusBadge @endphp </td>
                                            <td>
                                                 <button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="@lang('Update Room')" data-resource="{{ $room }}" type="button">
                                                        <i class="la la-pencil"></i>@lang('Edit')
                                                    </button>
                                               
                                        @can('admin.hotel.room.status')
                                                @if ($room->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.hotel.room.status', $room->id) }}" data-question="@lang('Are your to enable this room?')" type="button">
                                                        <i class="la la-eye-slash"></i>@lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.hotel.room.status', $room->id) }}" data-question="@lang('Are your to disable this room?')" type="button">
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
    @can('admin.hotel.room.status')
        <x-confirmation-modal />
    @endcan
@endsection


