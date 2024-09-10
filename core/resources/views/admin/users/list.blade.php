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
                                    <th>@lang('ID')</th>
                                    <th>@lang('User')</th>
                                    <th>@lang('Accommodation')</th>
                                    <th>@lang('Email') - @lang('Phone')</th>
                                    <th>@lang('Country')</th>
                                    <th>@lang('Joined At')</th>
                                    @can('admin.users.detail')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{$user->id}}
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $user->fullname }}</span>
                                            @can('admin.users.detail')
                                                <br>
                                                <span class="small">
                                                    <a href="{{ route('admin.users.detail', $user->id) }}"><span>@</span>{{ $user->username }}</a>
                                                </span>
                                            @endcan
                                        </td>
                                        <td>
                                            {{ $user->accommodation?->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}<br> +{{ $user->mobile }}
                                        </td>
                                        <td>
                                            <span class="fw-bold" title="{{ @$user->address->country }}">{{ $user->country_code }}</span>
                                        </td>
                                        <td>
                                            {{ showDateTime($user->created_at) }} <br> {{ diffForHumans($user->created_at) }}
                                        </td>
                                            <td>
                                                 <!--@can('admin.hotel.bed.save')-->
                                                <!--<button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Update User')" data-resource="{{ $user }}" type="button">-->
                                                <!--    <i class="la la-pencil"></i>@lang('Edit')-->
                                               
                                                <!--</button>-->
                                            <!--@endcan-->
                                        @can('admin.users.detail')
                                                <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.users.detail', $user->id) }}">
                                                    <i class="las la-desktop"></i> @lang('Details')
                                                </a>
                                        @endcan
                                            </td>
                                    </tr>
                               
                                @endforeach

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Username / Email" />
@endpush

