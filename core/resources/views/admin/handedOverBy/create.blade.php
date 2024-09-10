@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route ('admin.handedOverBystore') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('post')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        General Information </h5>
                </div>
                <div class="card-body general-info">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name" class="required">Name : </label>
                                <input class="form-control" name="name" type="text" value="" placeholder="Type name"
                                    id="name" required>
                            </div>
                        </div>
                        
                        @php
                        $users = \App\Models\User::all();
                        $items = \App\Models\LostFound::all();
                        @endphp
                        <div class="col-12">
                            <div class="form-group">
                                <label for="guest" class="required">Guest Id : </label>
                                <select name="guest" id="guest" class="form-control" required>
                                    <option value="">--Select Guest--</option>
                                    @foreach($users as $row)
                                        <option value="{{ $row->id }}">{{ $row->firstname}} {{ $row->lastname}} ({{$row->id}})</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                       <div class="col-12">
                            <div class="form-group">
                                <label for="guest" class="required">Item Id: </label>
                                <select name="item_id" class="form-control" required>
                                    <option value="">--Select Item--</option>
                                    @foreach($items as $row)
                                        <option value="{{ $row->id }}">{{$row->id}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="designation" class="required">Designation :</label>
                                <input class="form-control" name="designation" type="text" value="" placeholder="Type designation" id="designation" required>
                            </div>
                        </div>
                        
                        <div id="signature_one">
                             <div class="col-12" id="signature_one">
                                <div class="form-group">
                                    <label for="Signature" class="required">Signature :</label>
                                    <input class="form-control" name="signature" type="file" value="" placeholder="Type Signature" id="Signature" required>
                                </div>
                            </div>   
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="form-group mb-0 mt-3">
                               <button class="btn btn--primary w-100 h-45" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.handedOverBy') }}"><i class="la la-undo"></i>@lang('Back')</a>
    @endpush