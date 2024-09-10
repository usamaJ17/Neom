@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card bl--5-primary">
                <div class="card-body">
                    <p class="text--primary">@lang('While you are adding a new keyword, it will only add to this current language only. Please be careful on entering a keyword, please make sure there is no extra space. It needs to be exact and case-sensitive.')</p>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Code')</th>
                                    <th>@lang('Default')</th>

                                    @can(['admin.language.key', 'admin.language.manage.update', 'admin.language.manage.delete'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($languages as $item)
                                    <tr>
                                        <td>{{ __($item->name) }}</td>
                                        <td><strong>{{ __($item->code) }}</strong></td>
                                        <td>
                                            @if ($item->is_default == Status::YES)
                                                <span class="badge badge--success">@lang('Default')</span>
                                            @else
                                                <span class="badge badge--warning">@lang('Selectable')</span>
                                            @endif
                                        </td>
                                        @can(['admin.language.key', 'admin.language.manage.update', 'admin.language.manage.delete'])
                                            <td>
                                                <div class="button--group">
                                                    @can('admin.language.key')
                                                        <a class="btn btn-sm btn-outline--success" href="{{ route('admin.language.key', $item->id) }}">
                                                            <i class="la la-language"></i> @lang('Translate')
                                                        </a>
                                                    @endcan
                                                    @can('admin.language.manage.update')
                                                        <a class="btn btn-sm btn-outline--primary ms-1 editBtn" data-lang="{{ json_encode($item->only('name', 'text_align', 'is_default')) }}" data-url="{{ route('admin.language.manage.update', $item->id) }}" href="javascript:void(0)">
                                                            <i class="la la-pen"></i> @lang('Edit')
                                                        </a>
                                                    @endcan

                                                    @can('admin.language.manage.delete')
                                                        @if ($item->id != 1)
                                                            <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.language.manage.delete', $item->id) }}" data-question="@lang('Are you sure to remove this language from this system?')">
                                                                <i class="la la-trash"></i> @lang('Remove')
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    {{-- NEW MODAL --}}
    @can('admin.language.manage.store')
        <div aria-hidden="true" aria-labelledby="createModalLabel" class="modal fade" id="createModal" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="createModalLabel"> @lang('Add New Language')</h4>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><i class="las la-times"></i></button>
                    </div>
                    <form action="{{ route('admin.language.manage.store') }}" class="form-horizontal" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <label>@lang('Language Name')</label>
                                <div class="col-sm-12">
                                    <input class="form-control" name="name" required type="text" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label>@lang('Language Code')</label>
                                <div class="col-sm-12">
                                    <input class="form-control" name="code" required type="text" value="{{ old('code') }}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="inputName">@lang('Default Language')</label>
                                    <input data-bs-toggle="toggle" data-height="40px" data-off="@lang('UNSET')" data-offstyle="-danger" data-on="@lang('SET')" data-onstyle="-success" data-width="100%" name="is_default" type="checkbox">
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" id="btn-save" type="submit" value="add">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    {{-- EDIT MODAL --}}
    @can('admin.language.manage.update')
        <div aria-hidden="true" aria-labelledby="editModalLabel" class="modal fade" id="editModal" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editModalLabel">@lang('Edit Language')</h4>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><i class="las la-times"></i></button>
                    </div>
                    <form method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>@lang('Language Name')</label>
                                <div class="col-sm-12">
                                    <input class="form-control" name="name" required type="text" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="inputName">@lang('Default Language')</label>
                                <input data-bs-toggle="toggle" data-height="40px" data-off="@lang('UNSET')" data-offstyle="-danger" data-on="@lang('SET')" data-onstyle="-success" data-width="100%" name="is_default" type="checkbox">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" id="btn-save" type="submit" value="add">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('admin.language.get.key')
        <div aria-hidden="true" aria-labelledby="getLangModalLabel" class="modal fade" id="getLangModal" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="getLangModalLabel">@lang('Language Keywords')</h4>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><i class="las la-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">@lang('All of the possible language keywords are available here. However, some keywords may be missing due to variations in the database. If you encounter any missing keywords, you can add them manually.')</p>
                        <p class="text--primary mb-3">@lang('You can import these keywords from the translate page of any language as well.')</p>
                        <div class="form-group copy-texts-wrapper position-relative">
                            <div class="copy-texts">
                                <span class="copy">@lang('Copy')</span>
                            </div>
                            <textarea class="form-control langKeys key-added" id="langKeys" name="" readonly rows="25"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    
    @can('admin.language.manage.delete')
        <x-confirmation-modal />
    @endcan
@endsection

@can(['admin.language.manage.store', 'admin.language.get.key'])
    @push('breadcrumb-plugins')
        @can('admin.language.manage.store')
            <a class="btn btn-sm btn-outline--primary" data-bs-target="#createModal" data-bs-toggle="modal"><i class="las la-plus"></i>@lang('Add New')</a>
        @endcan
        @can('admin.language.get.key')
            <a class="btn btn-sm btn-outline--info keyBtn" data-bs-target="#getLangModal" data-bs-toggle="modal"><i class="las la-code"></i>@lang('Language Keywords')</a>
        @endcan
    @endpush
@endcan

@push('style')
    <style>
        .copy-texts-wrapper:hover .copy-texts {
            visibility: visible;
            opacity: 1;
        }

        .copy-texts {
            position: absolute;
            left: 0;
            top: 0;
            z-index: 99;
            background: #0000004d;
            width: 100%;
            height: 100%;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: .3s;
            cursor: pointer;
        }

        .copy-texts .copy {
            color: #fff;
            font-size: 40px;
            border-radius: 5px;
            background-color: transparent;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.editBtn').on('click', function() {
                var modal = $('#editModal');
                var url = $(this).data('url');
                var lang = $(this).data('lang');

                modal.find('form').attr('action', url);
                modal.find('input[name=name]').val(lang.name);
                modal.find('select[name=text_align]').val(lang.text_align);
                if (lang.is_default == 1) {
                    modal.find('input[name=is_default]').bootstrapToggle('on');
                } else {
                    modal.find('input[name=is_default]').bootstrapToggle('off');
                }
                modal.modal('show');
            });

            $('.keyBtn').click(function(e) {
                e.preventDefault();
                $.get("{{ route('admin.language.get.key') }}", {}, function(data) {
                    $('.langKeys').text(data);
                });
            });

            $('.copy-texts').click(function() {
                var copyText = document.getElementById("langKeys");
                copyText.select();
                document.execCommand("copy");
                $('.copy').text('Copied');
                setTimeout(() => {
                    $('.copy').text('Copy');
                }, 2000);

            });

        })(jQuery);
    </script>
@endpush
