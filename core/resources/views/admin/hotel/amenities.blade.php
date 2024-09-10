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
                                    <th>@lang('Title')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Icon')</th>
                                    <th>@lang('Status')</th>
                                    @can(['admin.hotel.amenity.*'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($amenities as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{$item->accommodation->name}}</td>
                                        <td> @php echo $item->icon @endphp </td>
                                        <td> @php echo $item->statusBadge @endphp </td>
                                        <td>
                                            <div class="button--group">
                                                @can('admin.hotel.amenity.save')
                                                    <button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="@lang('Update Amenity')" data-resource="{{ $item }}" type="button">
                                                        <i class="la la-pencil"></i>@lang('Edit')
                                                    </button>
                                                @endcan
                                                @can('admin.hotel.amenity.status')
                                                    @if ($item->status == Status::DISABLE)
                                                        <button class="btn btn-sm btn-outline--success me-1 confirmationBtn" data-action="{{ route('admin.hotel.amenity.status', $item->id) }}" data-question="@lang('Are you sure to enable this amenities?')" type="button">
                                                            <i class="la la-eye"></i> @lang('Enable')
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.hotel.amenity.status', $item->id) }}" data-question="@lang('Are you sure to disable this amenities?')" type="button">
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

    @can('admin.hotel.amenity.save')
        {{-- Add METHOD MODAL --}}
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Add Amenties')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.hotel.amenity.save') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Amenities Title')</label>
                              
                                <input class="form-control" name="title" required type="text" value="{{ old('title') }}">
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
                            <div class="form-group">
                                <label> @lang('Icon')</label>
                                <div class="input-group">
                                    <input autocomplete="off" class="form-control iconPicker icon" name="icon" required type="text">
                                    <span class="input-group-text input-group-addon" data-icon="las la-home" role="iconpicker"></span>
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
    @can('admin.hotel.amenity.status')
        <x-confirmation-modal />
    @endcan
@endsection
@can('admin.hotel.amenity.save')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Amenity')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    @endpush
@endcan

@push('style-lib')
    <link href="{{ asset('assets/global/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/fontawesome-iconpicker.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('#cuModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });

            $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                $('.iconPicker').val(`<i class="${e.iconpickerValue}"></i>`);
            });

        })(jQuery);
        
  


    </script>
@endpush
