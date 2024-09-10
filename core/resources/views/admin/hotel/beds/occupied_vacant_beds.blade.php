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
                                    <th>@lang('Bed')</th>
                                    <th>@lang('Accommodation')</th>
                                     <th>@lang('Room')</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bedTypes as $item)
                                    <tr>
                                        <td>{{ $bedTypes->firstItem() + $loop->index }}</td>
                                        <td>{{ __($item->name) }}</td>
                                        <td>{{ __($item->accommodation->name) }}</td>
                                        <td>{{ __($item->room->room_number) }}</td>
                                        
                                    </tr>
                              
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

 
@endsection