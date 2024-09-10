@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('admin.handedOvertoupdate',$data->id)}}" enctype="multipart/form-data" method="POST">
              @csrf
            @method('post')
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
                                        <option value="{{ $row->id }}" {{ $row->id==$data->item_id ? 'selected':'' }}>{{$row->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name" class="required">Name : </label>
                                <input class="form-control" name="name" type="text" value="{{ $data->name }}" placeholder="Type name"
                                    id="name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="number" class="required">Mobile Number :</label>
                                <input class="form-control" name="number" type="text" value="{{ $data->number }}" placeholder="Type number id"
                                    id="number">
                            </div>
                        </div>
                       
                        <div class="col-12">
                            <div class="form-group">
                                <label for="designation" class="required">Designation :</label>
                                <input class="form-control" name="designation" type="file" value="{{ $data->designation }}" placeholder="Type designation" id="designation">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="signature" class="required">Signature :</label>
                                <input class="form-control" name="signature" type="file" value="{{ $data->signature }}" placeholder="Type Signature" id="Signature">
                            </div>
                             <div class="form-group">
                                <img src="{{ asset('/image/'.$data->signature) }}" width="120">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group mb-0 mt-3">
                               <button class="btn btn--primary w-100 h-45" type="submit">Update</button>
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