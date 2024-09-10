@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('admin.lostFounditemstore') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('POST')
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
                                <input required class="form-control" name="location" type="text" value="" placeholder="Type location"
                                    id="location">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description" class="required">Found Item Description :
                                </label>
                                <textarea required class="form-control" id="description" name="description"
                                    rows="6" placeholder="For testing purpose"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="brand" class="required">Brand : </label>
                                <input required class="form-control" name="brand" type="text" value="" placeholder="Type brand" id="brand">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="colour" class="required">Colour : </label>
                                <input required class="form-control" name="colour" type="text" value="" placeholder="Type colour" id="colour">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="specification" class="required">Other Specification :</label>
                                <textarea required class="form-control" id="specification" name="specification"
                                    rows="6" placeholder="For testing purpose"></textarea>
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
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.lostFounditem') }}"><i class="la la-undo"></i>@lang('Back')</a>
    @endpush