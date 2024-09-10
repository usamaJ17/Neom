@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Staff Name')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Transfer By')</th>
                                    <th>@lang('Transfer Date')</th>
                                  
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transferStaff as $staff)
                                    <tr>
                                        <td>{{ $staff->id }}</td>
                                        <td>{{ $staff->user->firstname }}</td>
                                        <td>{{ $staff->accommodation->name }}</td>
                                        <td>{{ $staff->admin->name }}</td>
                                        <td>{{ $staff->transfer_date }}</td>
                                       
                                    </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <x-confirmation-modal />

    @can('admin.staff.save')
        <!-- Create Update Modal -->
        <div class="modal fade" id="cuModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>

                    <form action="{{ route('admin.staff.transferSave') }}" method="POST">
                        @csrf
                        <div class="modal-body">

                             <div class="form-group">
                                <label>@lang('Guest')</label>
                                <select class="form-control" name="staff_id" required>
                                    <option disabled selected value="">@lang('Select One')</option>
                                    @foreach ($allStaff as $staff)
                                        <option value="{{ $staff->id }}">{{ $staff->firstname }} {{$staff->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                          
                            
                             <div class="form-group">
                                <label>@lang('Accommodation')</label>
                                <select class="form-control" name="accommodation_id" required>
                                    <option disabled selected value="">@lang('Select One')</option>
                                    @foreach ($accommodations as $accommodation)
                                        <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>@lang('Transfer Date')</label>
                                <input class="form-control" name="transfer_date" required type="date">
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
@endsection

@push('breadcrumb-plugins')

    <!-- Modal Trigger Button -->
    @can('admin.staff.transferSave')
        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Guest')" type="button">
            <i class="las la-plus"></i>@lang('Add New')
        </button>
    @endcan
@endpush

@push('script')


@endpush