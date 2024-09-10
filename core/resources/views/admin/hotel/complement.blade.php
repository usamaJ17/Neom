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
                                    <th>@lang('Complement')</th>
                                    <th>@lang('Item')</th>
                                    @can('admin.hotel.complement.save')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($complements as $complement)
                                    <tr>
                                        <td>{{ $complement->name }}
                                        </td>

                                        <td>
                                            {{ implode(', ', $complement->item) }}
                                        </td>
                                        @can('admin.hotel.complement.save')
                                            <td>
                                                <button class="btn btn-sm btn-outline--primary editBtn" data-action="{{ route('admin.hotel.complement.save', $complement->id) }}" data-complement="{{ $complement }}">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </button>
                                            </td>
                                        @endcan
                                    </tr>
                                
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('admin.hotel.complement.save')
        <div class="modal fade" id="addModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Complement Name')</label>
                                <input class="form-control" name="name" required type="text" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label class="required"> @lang('Item')</label>
                                <div class="d-flex">
                                    <div class="input-group row gx-0">
                                        <input type="text" class="form-control first-item" name=item[]" required>
                                    </div>
                                    <button class="btn btn--success input-group-text border-0 addItem flex-shrink-0 ms-4" type="button"><i class="las la-plus"></i></button>
                                </div>
                            </div>

                            <div class="append-item d-none"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@can('admin.hotel.complement.save')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary addBtn" data-action="{{ route('admin.hotel.complement.save') }}" type="button"> <i class="las la-plus"></i>@lang('Add New ')</button>
    @endpush
    @push('script')
        <script>
            (function($) {
                "use strict";

                $('.addBtn').on('click', function() {
                    var modal = $('#addModal');
                    modal.find('.modal-title').text('@lang('Add Complement')');
                    modal.find('form').attr('action', $(this).data('action'));
                    var divName = modal.find('.append-item');
                    divName.html('');
                    divName.addClass('d-none');
                    modal.modal('show');
                });

                $('.editBtn').on('click', function() {
                    var modal = $('#addModal');
                    modal.find('.modal-title').text('@lang('Update Complement')')
                    var complement = $(this).data('complement');
                    modal.find('form').attr('action', $(this).data('action'));
                    modal.find('input[name=name]').val(complement.name);

                    var divName = modal.find('.append-item');
                    divName.html('');
                    divName.removeClass('d-none');

                    $.each(complement.item, function(index, element) {
                        if (index == 0) {
                            modal.find('.first-item').val(element);
                        } else {
                            divName.append(`
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="input-group row gx-0">
                                            <input type="text" class="form-control" name=item[]" value="${element}" required>
                                        </div>
                                        <button type="button" class="btn btn--danger input-group-text border-0 removeItem flex-shrink-0 ms-4"><i class="las la-times"></i></button>
                                    </div>
                                </div>
                            `);
                        }

                    });
                    modal.modal('show');
                });

                $(document).on('click', '.addItem', function() {
                    var modal = $(this).parents('.modal');
                    var div = modal.find('.append-item');
                    div.append(`
                    <div class="form-group">
                        <div class="d-flex">
                            <div class="input-group row gx-0">
                                <input type="text" class="form-control" name=item[]" required>
                            </div>
                            <button type="button" class="btn btn--danger input-group-text border-0 removeItem flex-shrink-0 ms-4"><i class="las la-times"></i></button>
                        </div>
                    </div>
                    `);
                    div.removeClass('d-none');
                });

                $(document).on('click', '.removeItem', function() {
                    $(this).parents('.form-group').remove();
                });

                $('#updateModal').on('shown.bs.modal', function(e) {
                    $(document).off('focusin.modal');
                });

                $('#addModal').on('shown.bs.modal', function(e) {
                    $(document).off('focusin.modal');
                });

            })(jQuery);
        </script>
    @endpush
@endcan
