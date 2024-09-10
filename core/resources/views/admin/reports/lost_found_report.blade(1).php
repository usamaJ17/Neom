@extends('admin.layouts.app')
@section('style')
    <style>
        p, li, span
        {
            color: #ffffff !important;
        }
    </style>
@endsection
@section('panel')

                        <table class="table" id="beds">
                            <thead>
                                <tr>
                                    <th class="text-start">S.N</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Total Items')</th>
                                </tr>
                            </thead>
                                <tbody>
                                <tr>
                                    <td class="text-start">1</td>
                                    <td class="text-start">Lost & Found</td>
                                    <td>{{$lost_found}}</td>
                                </tr>
                                <tr>
                                    <td class="text-start">2</td>
                                    <td class="text-start">Founded By</td>
                                    <td>{{$founded_by}}</td>
                                </tr>
                                <tr>
                                    <td class="text-start">3</td>
                                    <td class="text-start">Handed Over By</td>
                                    <td>{{$handed_over_by}}</td>
                                </tr>
                                <tr>
                                    <td class="text-start">4</td>
                                    <td class="text-start">Handed Over To</td>
                                    <td>{{$handed_over_to}}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <th class="text-start">Grand Total</th>
                                <th></th>
                                <th>{{$lost_found+$founded_by+$handed_over_by+$handed_over_to}}</th>
                                </tfoot>
                        </table>
                    
@endsection

@push('script')
<script>
  $(document).ready(function() {
      new DataTable('#beds', {
          layout: {
              topStart: {
                  buttons: ['excel', 'pdf']
              }
          }
      });
} );
 </script>

@endpush