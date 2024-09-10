@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.hotel.room.type.save', @$roomType ? $roomType->id : 0) }}" enctype="multipart/form-data" method="POST">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            @lang('General Information')
                        </h5>
                    </div>
                    <div class="card-body general-info">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input class="form-control" name="name" required type="text" value="{{ old('name', @$roomType->name) }}">
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label>@lang('Total Adult')</label>
                                    <input class="form-control" min="1" name="total_adult" required type="number" value="{{ old('total_adult', @$roomType->total_adult) }}">
                                </div>
                            </div>


                            <!--<div class="col-xl-4 col-lg-6 col-md-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <label class="required" for="fare">@lang('Fare') /@lang('Night')</label>-->
                            <!--        <div class="input-group">-->
                            <!--            <input class="form-control" id="fare" name="fare" required type="number" value="{{ old('fare', getAmount(@$roomType->fare)) }}">-->
                            <!--            <span class="input-group-text">{{ __(@$general->cur_text) }}</span>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <!--<div class="col-xl-4 col-lg-6 col-md-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>@lang('Cancellation Fee') /@lang('Night')</label>-->
                            <!--        <div class="input-group">-->
                            <!--            <input class="form-control cancellationFee" min="0" name="cancellation_fee" required step="any" type="number" value="{{ @$roomType->cancellation_fee }}">-->
                            <!--            <span class="input-group-text">{{ __($general->cur_text) }}</span>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="col-xl-4 col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label> @lang('Accommodations')</label>
                                    <select class="form-select" name="accommodation" id="accommodation">
                                        <option value="">Select Accommodation</option>
                                        @foreach ($accommodations as $accommodation)
                                            <option value="{{ $accommodation->id }}" {{ @$roomType->accommodation_id == $accommodation->id ? 'selected' : '' }}>{{ $accommodation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label> @lang('Amenities')</label>
                                    <select class="select2-multi-select" multiple="multiple" name="amenities[]" id="amenity">
                                        @foreach ($amenities as $amenity)
                                            <option value="{{ $amenity->id }}" {{ @$roomType && @$roomType->amenities->contains($amenity->id) ? 'selected' : '' }}>
                                                {{ $amenity->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label> @lang('Complements')</label>
                                   
                                    <select class="select2-multi-select" multiple="multiple" name="complements[]">
                                       
                                        @foreach ($complements as $complement)
                                            <option value="{{ $complement->id }}" {{ @$roomType && @$roomType->complements->contains($complement->id) ? 'selected' : '' }}>
                                                {{ $complement->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label>@lang('Keywords')</label>
                                    <select class="form-control select2-auto-tokenize" multiple="multiple" name="keywords[]"></select>
                                    <small class="ml-2 mt-2">@lang('Separate multiple keywords by') <code>,</code>(@lang('comma'))
                                        @lang('or') <code>@lang('enter')</code> @lang('key')</small>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label> @lang('Featured') </label>
                                    <input @if (@$roomType->feature_status) checked @endif data-bs-toggle="toggle" data-height="50" data-off="@lang('Unfeatured')" data-offstyle="-danger" data-on="@lang('Featured')" data-onstyle="-success" data-size="large" data-width="100%" name="feature_status" type="checkbox">
                                    <small class="ml-2 mt-2"><code><i class="las la-info-circle"></i> @lang('Featured rooms will be displayed in featured rooms section.')</code></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            @lang('Images')
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="input-images pb-3"></div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            @lang('Description')
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="description" name="description" rows="6">{{ @$roomType->description ?? old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            @lang('Cancellation Policy')
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="form--control" name="cancellation_policy" rows="6">{{ old('cancellation_policy', @$roomType->cancellation_policy) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @can('admin.hotel.room.type.save')
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </form>
        </div>
    </div>
@endsection

@can('admin.hotel.room.type.all')
    @push('breadcrumb-plugins')
        <x-back route="{{ route('admin.hotel.room.type.all') }}" />
    @endpush
@endcan

@push('script-lib')
    <script src="{{ asset('assets/global/js/image-uploader.min.js') }}"></script>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/global/css/image-uploader.min.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            let bedTypes = @json($bedTypes);


            @if (isset($images))
                let preloaded = @json($images);
            @else
                let preloaded = [];
            @endif

            $('.input-images').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'images',
                preloadedInputName: 'old',
                maxSize: 2 * 1024 * 1024,
                maxFiles: 6
            });

            $('.select2-multi-select').select2({
                dropdownParent: $('.general-info')
            });

            $('.select2-auto-tokenize').select2({
                dropdownParent: $('.general-info'),
                tags: true,
                tokenSeparators: [',']
            });


            // room js
            $('[name=total_room]').on('input', function() {
                var totalRoom = $(this).val();
                if (totalRoom) {
                    let content = '<div class="row border-top pt-3">';
                    for (var i = 1; i <= totalRoom; i++) {
                        content += getRoomContent(i);
                    }
                    content += '</div>';
                    $('.room').html(content);
                }
            });

            function getRoomContent(number) {
                return `
                <div class="col-md-3 number-field-wrapper room-content">
                    <div class="form-group">
                        <label for="room" class="required">@lang('Room') - <span class="serialNumber">${number}</span></label>
                        <div class="input-group">
                            <input type="text" name="room[]" class="form-control roomNumber" required>
                            <button type="button" class="input-group-text bg-danger border-0 btnRemove" data-name="room"><i class="las la-times"></i></button>
                        </div>
                    </div>
                </div>`;
            }


            function setTotalRoom() {
                var totalRoom = $('.roomNumber').length;
                console.log(totalRoom);
                $('[name=total_room]').val(totalRoom);
            }

            //bed js
            $('[name=total_bed]').on('input', function() {
                var totalBed = $(this).val();
                if (totalBed) {
                    let content = '<div class="row border-top pt-3">';
                    for (var i = 1; i <= totalBed; i++) {
                        content += getBedContent(i);
                    }
                    content += '</div>';
                    $('.bed').html(content);
                }
            });

            function getBedContent(number) {
                return `
                    <div class="col-md-3 number-field-wrapper bed-content">
                        <div class="form-group">
                            <label for="bed" class="required">@lang('Bed') - <span class="serialNumber">${number}</span></label>
                            <div class="input-group"><select class="form-control bedType" name="bed[${number}]">
                                        <option value="">@lang('Select One')</option>
                                        
                                    </select><button type="button" class="input-group-text bg-danger border-0 btnRemove" data-name="bed"><i class="las la-times"></i></button>
                            </div>
                        </div>
                    </div>`;
            }

            function setTotalBed() {
                var totalBed = $('.bedType').length;
                $('[name=total_bed]').val(totalBed);
            }

            // function allBedType() {
            //     var options;
            //     $.each(bedTypes, function(i, e) {
            //         options += `<option value="${e.name}">${e.name}</option>`;
            //     });
            //     return options;
            // }


            //common js
            $('[name=total_bed]').on('input', function() {
                var totalBed = $(this).val();
                if (totalBed) {
                    let content = '<div class="row border-top pt-3">';
                    for (var i = 1; i <= totalBed; i++) {
                        content += getBedContent(i);
                    }
                    content += '</div>';
                    $('.bed').html(content);
                }
            });

            $(document).on('click', '.btnRemove', function() {
                $(this).closest('.number-field-wrapper').remove();
                let divName = null;
                if ($(this).data('name') == 'bed') {
                    setTotalBed();
                    divName = $('.bed-content').find('.serialNumber');
                } else {
                    divName = $('.room-content').find('.serialNumber');
                    setTotalRoom();
                }
                resetSerialNumber(divName);
            });

            function resetSerialNumber(divName) {
                $.each(divName, function(i, e) {
                    $(e).text(i + 1)
                });
            }

            $('.addMore').on('click', function() {
                if ($(this).parents().hasClass('room')) {
                    var total = $('.roomNumber').length;
                    total += 1;

                    $('.room .row').append(getRoomContent(total));
                    setTotalRoom();
                    return;
                }

                var total = $('.bedType').length;
                total += 1;

                $('.bed .row').append(getBedContent(total));
                setTotalBed();
            });

            // Edit part
            let roomType = @json(@$roomType);
            if (roomType) {
                $.each(roomType.amenities, function(i, e) {
                    $(`select[name="amenities[]"] option[value=${e.id}]`).prop('selected', true);
                });

                $.each(roomType.complements, function(i, e) {
                    $(`select[name="complements[]"] option[value=${e.id}]`).prop('selected', true);
                });

                $('.select2-multi-select').select2({
                    dropdownParent: $('.general-info')
                });

                var keyword = $('select[name="keywords[]"]');
                keyword.html('');

                let options = '';

                $.each(roomType.keywords, function(index, value) {
                    options += `<option value="${value}" selected>${value}</option>`
                });


                keyword.append(options);
                keyword.select2({
                    dropdownParent: $('.general-info'),
                    tags: true,
                    tokenSeparators: [',']
                });
            }
        })(jQuery);
    </script>
    <script>
            $(document).ready(function () {
            $('#accommodation').change(function () {
                var accommodationId = $(this).val();
                var amenityDropdown = $('#amenity');
        
                amenityDropdown.empty(); // Clear the dropdown before appending options
        
                if (accommodationId) {
                    $.get('{{ route('admin.hotel.amenity.amenities', ['accommodation_id' => ':accommodation_id']) }}'.replace(':accommodation_id', accommodationId), function (data) {
                        $.each(data, function (key, value) {
                            amenityDropdown.append('<option value="' + value.id + '">' + value.title + '</option>');
                        });
        
                        amenityDropdown.prop('disabled', data.length === 0);
                    });
                } else {
                    amenityDropdown.prop('disabled', true);
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
