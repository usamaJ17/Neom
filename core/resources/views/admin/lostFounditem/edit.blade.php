@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('admin.lostFounditemupdate',$data->id) }}" enctype="multipart/form-data" method="POST">
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
                                <label for="location" class="required">Location : </label>
                                <input class="form-control" name="location" type="text" value="{{ $data->location }}" placeholder="Type location"
                                    id="location">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description" class="required">Found Item Description :
                                </label>
                                <textarea class="form-control" id="description" name="description" placeholder="For testing purpose"
                                    rows="6">{{ $data->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="brand" class="required">Brand : </label>
                                <input class="form-control" name="brand" type="text" value="{{ $data->brand }}" placeholder="Type brand" id="brand">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="colour" class="required">Colour : </label>
                                <input class="form-control" name="colour" type="text" value="{{ $data->colour }}" placeholder="Type colour" id="colour">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="specification" class="required">Other Specification :</label>
                                <textarea class="form-control" id="specification" name="specification"
                                    rows="6" placeholder="For testing purpose">{{ $data->specification }}</textarea>
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
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.lostFounditem') }}"><i class="la la-undo"></i>@lang('Back')</a>
    @endpush