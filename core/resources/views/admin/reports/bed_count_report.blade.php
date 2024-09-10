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
                                    <th>@lang('Accommodation Name')</th>
                                    <th>@lang('Vacant Beds')</th>
                                    <th>@lang('Occupied Beds')</th>
                                    <th>@lang('Total Beds')</th>
                                </tr>
                            </thead>
                             @isset($bed_reports)
                                <tbody>
                                    @php
                                        $total_vacant   = 0;
                                        $total_occupied = 0;
                                        $grand_total    = 0;
                                    @endphp
                                @foreach ($bed_reports as $bed)
                               
                                    @php
                                        $vacant         = $bed['total_beds'] - $bed['occupied_beds'];
                                        $total_vacant   += $vacant;
                                        $total_occupied += $bed['occupied_beds'];
                                        $grand_total    += $bed['total_beds']
                                    @endphp
                                <tr>
                                    <td>{{ $bed['accommodation']}}</td>
                                    <td>
                                        @foreach($bed['bed_types'] as $type)
                                        <span class="badge badge--success">Bed Type {{$type->name}} : {{$bed['beds']->where('bed_type_id',$type->id)->count() - $bed['occupieds']->where('bed_type_id',$type->id)->count()}}</span>
                                        @endforeach
                                        <span class="badge badge--success">Total : {{ $bed['total_beds'] - $bed['occupied_beds']}}</span>
                                    </td>
                                    <td>
                                        @foreach($bed['bed_types'] as $type)
                                        <span class="badge badge--success">Bed Type {{$type->name}} : {{$bed['occupieds']->where('bed_type_id',$type->id)->count()}}</span>
                                        @endforeach
                                        <span class="badge badge--success">Total : {{ $bed['occupied_beds']}}</span>
                                    </td>
                                    <td>{{ $bed['total_beds']}}</td>
                                   </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <th>Grand Total</th>
                                <th>{{$total_vacant}}</th>
                                <th>{{$total_occupied}}</th>
                                <th>{{$grand_total}}</th>
                                </tfoot>
                            @endisset
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