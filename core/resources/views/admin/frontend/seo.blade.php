@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.frontend.sections.content', 'seo') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input name="type" type="hidden" value="data">
                        <input name="seo_image" type="hidden" value="1">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ getImage(getFilePath('seo') . '/' . @$seo->data_values->image, getFileSize('seo')) }})">
                                                    <button class="remove-image" type="button"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input accept=".png, .jpg, .jpeg" class="profilePicUpload" id="profilePicUpload1" name="image_input" type="file">
                                                <label class="bg--primary" for="profilePicUpload1">@lang('Upload Image')</label>
                                                <small class="mt-2">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png')</b>. @lang('Image will be resized into') {{ getFileSize('seo') }}@lang('px'). </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8 mt-xl-0 mt-4">
                                <div class="form-group select2-parent position-relative">
                                    <label>@lang('Meta Keywords')</label>
                                    <small class="ms-2 mt-2  ">@lang('Separate multiple keywords by') <code>,</code>(@lang('comma')) @lang('or') <code>@lang('enter')</code> @lang('key')</small>
                                    <select class="form-control select2-auto-tokenize" multiple="multiple" name="keywords[]" required>
                                        @if (@$seo->data_values->keywords)
                                            @foreach ($seo->data_values->keywords as $option)
                                                <option selected value="{{ $option }}">{{ __($option) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Meta Description')</label>
                                    <textarea class="form-control" name="description" required rows="3">{{ @$seo->data_values->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Social Title')</label>
                                    <input class="form-control" name="social_title" required type="text" value="{{ @$seo->data_values->social_title }}" />
                                </div>
                                <div class="form-group">
                                    <label>@lang('Social Description')</label>
                                    <textarea class="form-control" name="social_description" required rows="3">{{ @$seo->data_values->social_description }}</textarea>
                                </div>
                                @can('admin.frontend.sections.content')
                                    <div class="form-group">
                                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.select2-auto-tokenize').select2({
                dropdownParent: $('.select2-parent'),
                tags: true,
                tokenSeparators: [',']
            });
        })(jQuery);
    </script>
@endpush
