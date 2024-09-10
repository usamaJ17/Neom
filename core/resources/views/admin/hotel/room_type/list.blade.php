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
                                    <th>@lang('Name')</th>
                                    <th>@lang('Rooms')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Adult')</th>
                                    <th>@lang('Feature Status')</th>
                                    <th>@lang('Status')</th>
                                    @can(['admin.hotel.room.type.*'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($typeList as $type)
                                    <tr>
                                        <td>{{ $type->name }}</td>
                                        <td>{{ $type->rooms_count }}</td>
                                        <td>{{ $type->accommodation->name }}</td>
                                        <td>{{ $type->total_adult }}</td>
                                        <td>@php echo $type->featureBadge  @endphp</td>

                                        <td>@php echo $type->statusBadge  @endphp</td>
                                        @can(['admin.hotel.room.type.*'])
                                            <td>
                                                @can('admin.hotel.room.type.edit')
                                                    <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.hotel.room.type.edit', $type->id) }}"> <i class="la la-pencil"></i>@lang('Edit')
                                                    </a>
                                                @endcan
                                                @can('admin.hotel.room.type.status')
                                                    @if ($type->status == 0)
                                                        <button class="btn btn-sm btn-outline--success ms-1 confirmationBtn" data-action="{{ route('admin.hotel.room.type.status', $type->id) }}" data-question="@lang('Are you sure to enable this room type?')">
                                                            <i class="la la-eye"></i>@lang('Enable')
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline--danger ms-1 confirmationBtn" data-action="{{ route('admin.hotel.room.type.status', $type->id) }}" data-question="@lang('Are you sure to disable this room type?')">
                                                            <i class="la la-eye-slash"></i>@lang('Disable')
                                                        </button>
                                                    @endif
                                                @endcan
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
    @can('admin.hotel.room.type.status')
        <x-confirmation-modal />
    @endcan
@endsection
@can('admin.hotel.room.type.create')
    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.hotel.room.type.create') }}"><i class="las la-plus"></i>@lang('Add New')</a>
    @endpush
@endcan
