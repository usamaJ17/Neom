@extends($activeTemplate . 'layouts.frontend')
@section('content')

    <div class="section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <h5 class="mb-2 text-center">@lang('Verify Email Address')</h5>
                        @if(!auth()->guard('admin')->check())
                       
                        <form action="{{ route('user.verify.email') }}" method="POST" class="submit-form">
                            @csrf
                            <p class="verification-text mb-2 text-center">@lang('A 6 digit verification code sent to your email address'): {{ showEmailAddress(auth()->user()->email) }}</p>

                            @include($activeTemplate . 'partials.verification_code')

                            <div class="mb-3">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>

                            <div class="mb-3">
                                <p>
                                    @lang('If you don\'t get any code'), <a href="{{ route('user.send.verify.code', 'email') }}"> @lang('Try again')</a>
                                </p>

                                @if ($errors->has('resend'))
                                    <small class="text-danger d-block">{{ $errors->first('resend') }}</small>
                                @endif
                            </div>
                        </form>
                       @else
                        
                        <form action="{{ route('admin.verify.email') }}" method="POST" class="submit-form">
                            @csrf
                            <p class="verification-text mb-2 text-center">@lang('A 6 digit verification code sent to your email address'): {{ showEmailAddress(auth()->guard('admin')->user()->email) }}</p>

                            @include($activeTemplate . 'partials.verification_code')

                            <div class="mb-3">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>

                            <div class="mb-3">
                                <p>
                                    @lang('If you don\'t get any code'), <a href="{{ route('admin.send.verify.code', 'email') }}"> @lang('Try again')</a>
                                </p>

                                @if ($errors->has('resend'))
                                    <small class="text-danger d-block">{{ $errors->first('resend') }}</small>
                                @endif
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
