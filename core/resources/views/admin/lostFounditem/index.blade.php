@extends('admin.layouts.app')
@section('panel')
    <div class="row">
         <div class="d-flex mb-3 gap-2">
            <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.foundby')}}"> <i class="la la-pencil"></i>@lang('Found By') </a>
            <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.handedOverBy')}}"> <i class="la la-pencil"></i>@lang('Handed Over By') </a>
            <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.handedOverto')}}"> <i class="la la-pencil"></i>@lang('Handed Over To') </a>
        </div>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable">
                            <thead>
                                <tr>
                                    <th>@lang('SL')</th>
                                    <th>@lang('Location')</th>
                                    <th>@lang('Brand ')</th>
                                    <th>@lang('Colour ')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>

                                        <td>{{ $row->location }}</td>
                                        
                                        <td>{{ $row->brand }}</td>
                                        <td>{{ $row->colour }}</td>
                                      
                                            <td>
                                               
                                                <a target="_blank" class="btn btn-sm btn-outline--primary" href="{{ route('admin.lostFounditemreport',$row->id)}}"> <i class="la la-list"></i>@lang('Report')
                                                </a>
                                                
                                                <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.lostFounditemedit',$row->id)}}"> <i class="la la-pencil"></i>@lang('Edit')
                                                </a>
                                                <a class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.lostFounditemdelete',$row->id)  }}" data-question="Are you sure, you want to delete this bed?">
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
        <div class="d-flex mb-30 flex-wrap gap-3 justify-content-between align-items-center mt-5">
    <h6 class="page-title">Founded By</h6>
    <div class="d-flex flex-wrap justify-content-end gap-2 align-items-center breadcrumb-plugins">
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.foundbycreate') }}"><i class="las la-plus"></i>Add Found By</a>
        </div>
</div>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable2">
                            <thead>
                                <tr>
                                    <th>@lang('Sl')</th>
                                    <th>@lang('Guest ID ')</th>
                                    <th>@lang('Time Found ')</th>
                                    <th>@lang('Date Found ')</th>
                                   
                                        <th>@lang('Action')</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                  @foreach($foundby as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item->user?->firstname }} {{ $item->user?->lastname }} ({{ $item->user?->id }})</td>

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
        
        <div class="d-flex mb-30 flex-wrap gap-3 justify-content-between align-items-center mt-5">
    <h6 class="page-title">Handed Over By</h6>
    <div class="d-flex flex-wrap justify-content-end gap-2 align-items-center breadcrumb-plugins">
                <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.handedOverBycreate') }}"><i class="las la-plus"></i>@lang('Add Handed Over By')</a>
        </div>
</div>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable3">
                            <thead>
                                <tr>
                                    <th>@lang('Sl')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Guest ID ')</th>
                                    <th>@lang('Designation')</th>
                                        <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($handedby as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item->name }}</td>

                                        <td>{{ $item->user?->firstname }} {{ $item->user?->lastname }} ({{ $item->user?->id }})</td>
                                        
                                        <td>{{ $item->designation }}</td>
                                      
                                            <td>
                                               
                                                    <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.handedOverByedit',$item->id)}}"> <i class="la la-pencil"></i>@lang('Edit')
                                                    </a>
                                                      <a class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.handedOverBydelete',$item->id)  }}" data-question="Are you sure, you want to delete this bed?">
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
        
        <div class="d-flex mb-30 flex-wrap gap-3 justify-content-between align-items-center mt-5">
    <h6 class="page-title">Handed Over To</h6>
    <div class="d-flex flex-wrap justify-content-end gap-2 align-items-center breadcrumb-plugins">
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.handedOvetocreate') }}"><i class="las la-plus"></i>@lang('Add Handed Over To')</a>
        </div>
</div>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table" id="datatable4">
                            <thead>
                                <tr>
                                    <th>@lang('Sl')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Mobile Number ')</th>
                                    <th>@lang('Designation')</th>
                                        <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                   @foreach($handedto as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item->name }}</td>

                                        <td>{{ $item->number }}</td>
                                        
                                        <td>{{ $item->designation }}</td>
                                      
                                            <td>
                                               
                                                  
                                                     <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.handedOvertoedit',$item->id)}}"> <i class="la la-pencil"></i>@lang('Edit')
                                                    </a>
                                                        <a class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.handedOvertodelete',$item->id)  }}" data-question="Are you sure, you want to delete this bed?">
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
    @push('script')
        <script>
              $(document).ready(function() {
                  new DataTable('#datatable2', {
                      layout: {
                          topStart: {
                              buttons: ['excel', 'pdf']
                          }
                      }
                  });
                  new DataTable('#datatable3', {
                      layout: {
                          topStart: {
                              buttons: ['excel', 'pdf']
                          }
                      }
                  });
                  new DataTable('#datatable4', {
                      layout: {
                          topStart: {
                              buttons: ['excel', 'pdf']
                          }
                      }
                  });
            } );
 </script>
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
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.lostFounditemcreate') }}"><i class="las la-plus"></i>@lang('Add New')</a>
    @endpush

