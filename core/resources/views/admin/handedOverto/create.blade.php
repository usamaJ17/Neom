@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('admin.handedOvetostore') }}" enctype="multipart/form-data" method="POST">
           @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        General Information </h5>
                </div>
                <div class="card-body general-info">
                    <div class="row">
                        @php
                        $items = \App\Models\LostFound::all();
                        @endphp
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
                                <label for="name" class="required">Name : </label>
                                <input class="form-control" name="name" type="text" value="" placeholder="Type name"
                                    id="name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="number" class="required">Mobile Number : </label>
                                <input class="form-control" name="number" type="text" value="" placeholder="Type number id"
                                    id="number" required>
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
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.handedOverto') }}"><i class="la la-undo"></i>@lang('Back')</a>
    @endpush