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
                                    <th>@lang('Name')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Quantity')</th>
                                     <!--<th>@lang('Room')</th>-->
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bedAccessory as $item)
                                    <tr>
                                        <td>{{ $item->id }}.</td>
                                        <td>{{ __($item->name) }}</td>
                                        <td>{{ __($item->accommodation->name) }}</td>
                                        <td>{{ __($item->quantity) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Update Bed Accessories')" data-resource="{{ $item }}" type="button">
                                                <i class="la la-pencil"></i>@lang('Edit')
                                            </button>
                                            <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.hotel.accessories.delete', $item->id) }}" data-question="@lang('Are you sure, you want to delete this bed?')" type="button">
                                                <i class="la la-trash"></i>@lang('Delete')
                                            </button>
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
                    <form action="{{ route('admin.hotel.accessories.save') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Name')</label>
                                <input class="form-control" name="name" required type="text" value="{{ old('name') }}">
                            </div>
                            
                            <div class="form-group">
                                <label> @lang('Quantity')</label>
                                <input class="form-control" name="quantity" required type="number" value="{{ old('quantity') }}">
                            </div>
                            
                             <div class="form-group">
                                <label> @lang('Accommodation')</label>
                                       
                                    <select class="form-control"  name="accommodation_id" id="accommodation">
                                            <option disable selected value="">Select an Accommodation</option>
                                        @foreach ($accommodations as $accommodation)
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

        <x-confirmation-modal />
@endsection
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Bed Accessories')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    @endpush
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
                var room_id = $('#room_id');
        
                room_id.empty(); // Clear the dropdown before appending options
        
                if (accommodationId) {
                    $.get('{{ route('admin.hotel.room.room', ['accommodation_id' => ':accommodation_id']) }}'.replace(':accommodation_id', accommodationId), function (data) {
                        $.each(data, function (key, value) {
                            room_id.append('<option value="' + value.id + '">' + value.room_number + '</option>');
                        });
        
                        room_id.prop('disabled', data.length === 0);
                    });
                } else {
                    room_id.prop('disabled', true);
                }
            });
        
            // Trigger the change event to populate amenities during edit
            // $('#accommodation').trigger('change');
            
    //          $(window).on('load', function() {
    //     $('#accommodation').trigger('change');
    // });
        });


</script>
@endpush
