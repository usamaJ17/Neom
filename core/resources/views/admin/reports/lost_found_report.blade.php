@extends('admin.layouts.app')
@section('panel')
<style>
        h6 {
            font-weight:bold;
        }
    </style>
<div class="card p-5">
    <h5 class="mb-2">All Lost and found :</h5>
    
    @foreach($lost_found as $row)
     <div class="d-flex justify-content-between align-items-center border border--black p-3 my-3">
         <h6>Facility Name: NEOM HOSPITAL</h6>
         <h6>Location: {{$row->location}}</h6>
     </div>
     <table class="table">
         <thead>
             
         <tr>
             <th class="border border--black w-50"><h6>Found Item Description :</h6></th>
             <th class="border border--black w-50"><h6 class="text-start">{{$row->description}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black w-50"><h6>Brand : {{$row->brand}}</h6></th>
             <th class="border border--black w-50"><h6 class="text-start">Colour : {{$row->colour}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2"><h6>Other Specification : {{$row->specification}}</h6></th>
         </tr>
         </thead>
         <tbody>
         </tbody>
     </table>
     <hr>
     @endforeach
     <h5 class="mb-2">Found By :</h5>
     @foreach($founded_by as $row)
     <table class="table">
         <thead>
             
         <tr>
             <th class="border border--black w-50"><h6>Found Location :</h6></th>
             <th class="border border--black w-50"><h6 class="text-start">{{$row->location}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2">
                 <div class="d-flex justify-content-between align-items-center">
                     <h6>Found By : {{$row->user?->firstname}}</h6>
                     <h6>Staff ID : {{$row->user?->employee_id}}</h6>
                     <h6>Mobile Number : {{$row->phone}}</h6>
                 </div>
            </th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2">
                 <div class="d-flex justify-content-between align-items-center">
                     <h6>Date Found : {{$row->date}}</h6>
                     <h6>Time Found : {{$row->colour}}</h6>
                     <h6>Signature : <img style="width:100px" src="{{asset('image/'.$row->signature)}}"></h6>
                 </div>
             </th>
         </tr>
         </thead>
         <tbody>
         </tbody>
     </table>
     <hr>
     @endforeach
     <h5 class="mb-2">Handed Over By :</h5>
     @foreach($lost_found as $row)
     <table class="table">
         <thead>
             
         <tr>
             <th class="border border--black w-50"><h6>Name :</h6></th>
             <th class="border border--black"><h6 class="text-start">{{$row->description}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black w-50"><h6>Staff ID :</h6></th>
             <th class="border border--black"><h6 class="text-start">Designation :</h6></th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2">
                <h6>Signature : {{$row->brand}}</h6>
             </th>
         </tr>
         </thead>
         <tbody>
         </tbody>
     </table>
     <hr>
     @endforeach
     <h5 class="mb-2">Handed Over To :</h5>
     @foreach($lost_found as $row)
     <table class="table">
         <thead>
             
         <tr>
             <th class="border border--black w-50"><h6>Name :</h6></th>
             <th class="border border--black"><h6 class="text-start">{{$row->description}}</h6></th>
         </tr>
         <tr>
             <th class="border border--black w-50"><h6>Mobile Number :</h6></th>
             <th class="border border--black"><h6 class="text-start">Designation :</h6></th>
         </tr>
         <tr>
             <th class="border border--black" colspan="2">
                <h6>Signature : {{$row->brand}}</h6>
             </th>
         </tr>
         </thead>
         <tbody>
         </tbody>
     </table>
     <hr>
     @endforeach
</div>
@endsection
