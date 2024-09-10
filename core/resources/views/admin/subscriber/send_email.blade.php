@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <form action="{{ route('admin.subscriber.send.email') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>@lang('Subject')</label>
                                <input class="form-control" name="subject" required type="text" value="{{ old('subject') }}" />
                            </div>
                            <div class="form-group col-md-12">
                                <label>@lang('Body')</label>
                                <textarea class="form-control nicEdit" name="body" rows="10">{{ old('body') }}</textarea>
                            </div>

                        </div>
                    </div>
                    @can('admin.subscriber.send.email')
                        <div class="card-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endsection

@can('admin.subscriber.index')
    @push('breadcrumb-plugins')
        <x-back route="{{ route('admin.subscriber.index') }}" />
    @endpush
@endcan
