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
                                    <th>@lang('Sl')</th>
                                    <th>@lang('Guest ID ')</th>
                                    <th>@lang('Item ID ')</th>
                                    <th>@lang('Time Found ')</th>
                                    <th>@lang('Date Found ')</th>
                                   
                                        <th>@lang('Action')</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                  @foreach($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item->user?->firstname }} {{ $item->user?->lastname }} ({{ $item->user?->id }})</td>

                                        <td>{{ $item->item_id }}</td>
                                        <td>{{ $item->colour }}</td>
                                        
                                        <td>{{ $item->date }}</td>
                                      
                                            <td>
                                               
                                                    <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.foundbyedit',$item->id)}}"> <i class="la la-pencil"></i>@lang('Edit')
                                                    </a>
                                                       <a class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.foundbydelete',$item->id)  }}" data-question="Are you sure, you want to delete this bed?">
                                                          <i class="la la-trash"></i>Delete</a>
                                                   
                                               
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
  <x-confirmation-modal />
@endsection
    @push('scripts')
     <script>
        (function($) {
            "use strict";
            $(document).on('click', '.confirmationBtn', function() {
                var modal = $('#confirmationModal');
                let data = $(this).data();
                modal.find('.question').text(`${data.question}`);
                modal.find('form').attr('action', `${data.action}`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush

    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.foundbycreate') }}"><i class="las la-plus"></i>@lang('Add New')</a>
    @endpush

