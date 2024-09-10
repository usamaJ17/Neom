@extends('admin.layouts.app')
@section('panel')
    <div id="app">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row justify-content-between mt-3">
                            <div class="col-md-7">
                                <ul>
                                    <li>
                                        <h5>@lang('Language Keywords of') {{ __($lang->name) }}</h5>
                                    </li>
                                </ul>
                            </div>
                            @can('admin.language.store.key')
                                <div class="col-md-5 mt-md-0 mt-3">
                                    <button class="btn btn-sm btn-outline--primary float-end" data-bs-target="#addModal" data-bs-toggle="modal" type="button"><i class="fa fa-plus"></i> @lang('Add New Key') </button>
                                </div>
                            @endcan
                        </div>
                        <hr>
                        <div class="table-responsive--sm table-responsive">
                            <table class="table table--light tabstyle--two custom-data-table white-space-wrap" id="myTable">
                                <thead>
                                    <tr>
                                        <th>
                                            @lang('Key')
                                        </th>
                                        <th>
                                            {{ __($lang->name) }}
                                        </th>
                                        @can(['admin.language.update.key', 'admin.language.delete.key'])
                                            <th class="w-85">@lang('Action')</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($json as $k => $language)
                                        <tr>
                                            <td class="white-space-wrap">{{ $k }}</td>
                                            <td class="text-left white-space-wrap">{{ $language }}</td>

                                            @can(['admin.language.update.key', 'admin.language.delete.key'])
                                                <td>
                                                    @can('admin.language.update.key')
                                                        <a class="editModal btn btn-sm btn-outline--primary" data-bs-target="#editModal" data-bs-toggle="modal" data-key="{{ $k }}" data-title="{{ $k }}" data-value="{{ $language }}" href="javascript:void(0)">
                                                            <i class="la la-pencil"></i> @lang('Edit')
                                                        </a>
                                                    @endcan

                                                    @can('admin.language.delete.key')
                                                        <a class="btn btn-sm btn-outline--danger deleteKey" data-bs-target="#DelModal" data-bs-toggle="modal" data-key="{{ $k }}" data-value="{{ $language }}" href="javascript:void(0)">
                                                            <i class="la la-trash"></i> @lang('Remove')
                                                        </a>
                                                    @endcan
                                                </td>
                                            @endcan
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @can('admin.language.store.key')
            <div aria-hidden="true" aria-labelledby="addModalLabel" class="modal fade" id="addModal" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addModalLabel"> @lang('Add New')</h4>
                            <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                                <i class="las la-times"></i>
                            </button>
                        </div>

                        <form action="{{ route('admin.language.store.key', $lang->id) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="key">@lang('Key')</label>
                                    <input class="form-control" id="key" name="key" required type="text" value="{{ old('key') }}">

                                </div>
                                <div class="form-group">
                                    <label for="value">@lang('Value')</label>
                                    <input class="form-control" id="value" name="value" required type="text" value="{{ old('value') }}">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn--primary w-100 h-45" type="submit"> @lang('Submit')</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endcan

        @can('admin.language.update.key')
            <div aria-hidden="true" aria-labelledby="editModalLabel" class="modal fade" id="editModal" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editModalLabel">@lang('Edit')</h4>
                            <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><i class="las la-times"></i></button>
                        </div>

                        <form action="{{ route('admin.language.update.key', $lang->id) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group ">
                                    <label class="form-title" for="inputName"></label>
                                    <input class="form-control" name="value" required type="text">
                                </div>
                                <input name="key" type="hidden">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endcan

        <!-- Modal for DELETE -->
        @can('admin.language.delete.key')
            <div aria-hidden="true" aria-labelledby="DelModalLabel" class="modal fade" id="DelModal" role="dialog" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DelModalLabel"> @lang('Confirmation Alert!')</h5>
                            <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><i class="las la-times"></i></button>
                        </div>
                        <div class="modal-body">
                            <p>@lang('Are you sure to delete this key from this language?')</p>
                        </div>
                        <form action="{{ route('admin.language.delete.key', $lang->id) }}" method="post">
                            @csrf
                            <input name="key" type="hidden">
                            <input name="value" type="hidden">
                            <div class="modal-footer">
                                <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('No')</button>
                                <button class="btn btn--primary" type="submit">@lang('Yes')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    </div>

    {{-- Import Modal --}}
    @can('admin.language.import.lang')
        <div class="modal fade" id="importModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang('Import Keywords')</h4>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><i class="las la-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Import From')</label>
                            <select class="form-control select_lang" required>
                                <option value="">@lang('Select One')</option>
                                <option value="999">@lang('System')</option>
                                @foreach ($list_lang as $data)
                                    <option @if ($data->id == $lang->id) class="d-none" @endif value="{{ $data->id }}">{{ __($data->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('Close')</button>
                        <button class="btn btn--primary import_lang" type="button"> @lang('Import Now')</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
@can('admin.language.import.lang')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn--primary box--shadow1 importBtn" type="button"><i class="la la-download"></i>@lang('Import Keywords')</button>
    @endpush
@endcan

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('click', '.deleteKey', function() {
                var modal = $('#DelModal');
                modal.find('input[name=key]').val($(this).data('key'));
                modal.find('input[name=value]').val($(this).data('value'));
            });
            $(document).on('click', '.editModal', function() {
                var modal = $('#editModal');
                modal.find('.form-title').text($(this).data('title'));
                modal.find('input[name=key]').val($(this).data('key'));
                modal.find('input[name=value]').val($(this).data('value'));
            });


            $(document).on('click', '.importBtn', function() {
                $('#importModal').modal('show');
            });
            $(document).on('click', '.import_lang', function(e) {
                var id = $('.select_lang').val();

                if (id == '') {
                    notify('error', 'Invalide selection');

                    return 0;
                } else {
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.language.import.lang') }}",
                        data: {
                            id: id,
                            toLangid: "{{ $lang->id }}",
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data == 'success') {
                                notify('success', 'Import Data Successfully');
                                window.location.href = "{{ url()->current() }}"
                            }
                        }
                    });
                }

            });
        })(jQuery);
    </script>
@endpush
