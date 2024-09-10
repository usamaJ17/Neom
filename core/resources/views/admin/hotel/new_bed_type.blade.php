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
                                    <th>@lang('Bed Type Name')</th>
                                    <th>@lang('Accommodation')</th>
                                     <th>@lang('Accessory')</th>
                                    @can('admin.hotel.bed.*')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bedTypes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ __($item->name) }}</td>
                                        <td>{{ __($item->accommodation?->name) }}</td>
                                        <td>
                                            @if($item->accessories_id)
                                            @foreach(json_decode($item->accessories_id) as $row)
                                            @php
                                                $accessory = \App\Models\BedAccessory::find($row);
                                            @endphp
                                            <span class="badge badge--success">{{ $accessory?->name }}</span>
                                            @endforeach
                                            @endif
                                            </td>
                                        <td>
                                            @can('admin.hotel.bed.save')
                                                <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Update Bed')" data-resource="{{ $item }}" type="button">
                                                    <i class="la la-pencil"></i>@lang('Edit')
                                                </button>
                                            @endcan
                                            @can('admin.hotel.bed.delete')
                                                <a class="btn btn-sm btn-outline--danger" href="{{ route('admin.hotel.newbed.delete', $item->id) }}" type="button">
                                                    <i class="la la-trash"></i>@lang('Delete')
                                                </a>
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
                    <form action="{{ route('admin.hotel.newbed.save') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Name')</label>
                                <input class="form-control" name="name" required type="text" value="{{ old('type_name') }}">
                            </div>
                            <div class="form-group">
                                <label> @lang('How many Adult')</label>
                                <input class="form-control" name="adult" required type="text" value="{{ old('type_name') }}">
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
                                <label> @lang('Bed Accessories')</label>
                                    <select multiple="multiple"  name="accessories_id[]" id="accessories_id" required>
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
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Bed Type')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    @endpush
@endcan
@push('script')
    <!--<link rel="stylesheet" href="https://springstubbe.us/skins/default/styles/skin.css?1540571984" type ="text/css" />-->
<link rel="stylesheet" href="https://springstubbe.us/projects/jquery-multiselect/styles/index.css?1647360365" type ="text/css" />
<!--<link rel="stylesheet" href="https://springstubbe.us/skins/default/styles/skin_print.css?1431976655" type ="text/css" media="print" />-->
<!--<script type="text/javascript" src="https://springstubbe.us/skins/default/scripts/skin.js?1591798440"></script>-->
<script type="text/javascript" src="https://springstubbe.us/projects/jquery-multiselect/scripts/index.js?1647362994"></script>

    <script>
     $('select[multiple]').multiselect({
    search   : true,
    selectAll: true,
    texts    : {
        placeholder: 'Select Accessories',
        search     : 'Search Accessories'
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
                var options = [];
            $('#accommodation').change(function () {
                var accommodationId = $(this).val();
                var accessories_id = $('#accessories_id');
        
                accessories_id.empty(); // Clear the dropdown before appending options
        
                if (accommodationId) {
                    $.get('{{ route('admin.accessories.get', ['accommodation_id' => ':accommodation_id']) }}'.replace(':accommodation_id', accommodationId), function (data) {
                        $.each(data, function (key, value) {
                            // accessories_id.append('<option value="' + value.id + '">' + value.name + '</option>');
                            options.push({
                                name   : value.name,
                                value  : value.id,
                            });
                        });
                        
                        $('select[multiple]').multiselect('loadOptions',options);
        
                        accessories_id.prop('disabled', data.length === 0);
                    });
                } else {
                    accessories_id.prop('disabled', true);
                }
            });
        
        });

</script>
@endpush
