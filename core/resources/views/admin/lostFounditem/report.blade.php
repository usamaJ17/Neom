@extends('admin.layouts.app')
@section('panel')
<style>
        h6 {
            font-weight:bold;
        }
    </style>
<div class="card p-5">
    <div class="d-flex justify-content-between align-items-center">
    <h5 class="mb-2">{{$pageTitle}} :</h5>
    <button class="btn btn-info text-white d-print-none" onclick="window.print()">Print/Pdf</button>
    </div>
    
     <div class="d-flex justify-content-between align-items-center border border--black p-3 my-3">
         <h6>Facility Name: NEOM HOSPITAL</h6>
         <h6>Location: {{$data->location}}</h6>
     </div>
     <table class="table">
         <thead>
             
         <tr>
             <th class="border border--black w-50"><h6>Found Item Description :</h6></th>
             <th class="border border--black w-50"><h6 class="text-start">{{$data->description}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black w-50"><h6>Brand : {{$data->brand}}</h6></th>
             <th class="border border--black w-50"><h6 class="text-start">Colour : {{$data->colour}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2"><h6>Other Specification : {{$data->specification}}</h6></th>
         </tr>
         </thead>
         <tbody>
         </tbody>
     </table>
     <hr>
     
     @php
     $found_by = \App\Models\FoundBy::whereItemId($data->id)->latest()->first();
     @endphp
     
     @if($found_by)
     <h5 class="mb-2">Found By :</h5>
     <table class="table">
         <thead>
             
         <tr>
             <th class="border border--black w-50"><h6>Found Location :</h6></th>
             <th class="border border--black w-50"><h6 class="text-start">{{$found_by->location}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2">
                 <div class="d-flex justify-content-between align-items-center">
                     <h6>Found By : {{$found_by->user?->firstname}}</h6>
                     <h6>Staff ID : {{$found_by->user?->employee_id}}</h6>
                     <h6>Mobile Number : {{$found_by->phone}}</h6>
                 </div>
            </th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2">
                 <div class="d-flex justify-content-between align-items-center">
                     <h6>Date Found : {{$found_by->date}}</h6>
                     <h6>Time Found : {{$found_by->colour}}</h6>
                     <h6>Signature : <img style="width:100px" src="{{asset('image/'.$found_by->signature)}}"></h6>
                 </div>
             </th>
         </tr>
         </thead>
         <tbody>
         </tbody>
     </table>
     <hr>
     @endif
     
      @php
     $handed_by = \App\Models\HandedBy::whereItemId($data->id)->latest()->first();
     @endphp
     @if($handed_by)
     
     <h5 class="mb-2">Handed Over By :</h5>
     <table class="table">
         <thead>
             
         <tr>
             <th class="border border--black w-50"><h6>Name :</h6></th>
             <th class="border border--black"><h6 class="text-start">{{$handed_by->name}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black w-50"><h6>Staff ID : {{$handed_by->user?->employee_id}}</h6></th>
             <th class="border border--black"><h6 class="text-start">Designation : {{$handed_by->user?->designation}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2">
                 <h6>Signature : <img style="width:100px" src="{{asset('image/'.$handed_by->signature)}}"></h6>
             </th>
         </tr>
         </thead>
         <tbody>
         </tbody>
     </table>
     <hr>
     
     @endif
     
     @php
     $handed_to = \App\Models\HandedTo::whereItemId($data->id)->latest()->first();
     @endphp
     @if($handed_to)
     
     <h5 class="mb-2">Handed Over To :</h5>
     <table class="table">
         <thead>
             
         <tr>
             <th class="border border--black w-50"><h6>Name :</h6></th>
             <th class="border border--black"><h6 class="text-start">{{$handed_to->name}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black w-50"><h6>Mobile Number : {{$handed_to->number}}</h6></th>
             <th class="border border--black"><h6 class="text-start">Designation : {{$handed_to->user?->designation}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2">
                <h6>Signature : <img style="width:100px" src="{{asset('image/'.$handed_to->signature)}}"></h6>
             </th>
         </tr>
         </thead>
         <tbody>
         </tbody>
     </table>
     <hr>
     @endif
</div>
@endsection
