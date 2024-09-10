@php
    $contactContent = getContent('contact_us.content', true);
    $socialElements = getContent('social_icon.element', false, null, true);
@endphp

<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row gy-2 align-items-center">
                <div class="col-lg-5 d-sm-block d-none">
                    <ul class="header-info-list justify-content-lg-start justify-content-center">
                        <li>
                            <a href="mailto:{{ $contactContent->data_values->email_address }}"><i class="fas fa-envelope"></i> {{ $contactContent->data_values->email_address }}</a>
                        </li>

                        <li>
                            <a href="tel:{{ $contactContent->data_values->contact_number }}"><i class="fas fa-phone-alt"></i> +{{ $contactContent->data_values->contact_number }}</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-7">
                    <div class="header-top-right justify-content-lg-end justify-content-center">
                        <div class="header-top-action-wrapper">
                            @if ($general->multi_language)
                                @php
                                    $language = App\Models\Language::all();
                                @endphp
                                <div class="language-select">
                                    <i class="fas fa-globe"></i>
                                    <select class="langSel">
                                        @foreach ($language as $item)
                                            <option @if (session('lang') == $item->code) selected @endif value="{{ $item->code }}">{{ __($item->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @guest
                                <a class="header-user-btn" href="{{ route('user.login') }}"><i class="las la-sign-in-alt"></i> @lang('Login')</a>
                                <a class="header-user-btn ms-2" href="{{ route('user.register') }}"><i class="las la-user"></i>
                                    @lang('Register')</a>
                            @endguest

                            @auth
                                <a class="header-user-btn" href="{{ route('user.home') }}"><i class="la la-dashboard"></i> @lang('Dashboard')</a>
                                <a class="header-user-btn ms-2" href="{{ route('user.logout') }}"><i class="las la-sign-out-alt"></i> @lang('Logout')</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container">
            <nav class="navbar navbar-expand-xl align-items-center">
                <a class="site-logo site-title" href="{{ route('home') }}">
                    <img alt="logo" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}">
                </a>
                <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler ms-auto" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" type="button">

                    <div class="navbar-toggler__icon">
                        <i class="las la-bars"></i>
                    </div>
                </button>
                <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
                    <ul class="navbar-nav main-menu ms-auto">
                        <li><a class="{{ menuActive('home') }}" href="{{ route('home') }}">@lang('HOME')</a></li>
                        @if (@$pages)
                            @foreach ($pages as $data)
                                <li>
                                    <a class="@if (request()->url() == route('pages', [$data->slug])) active @endif" href="{{ route('pages', [$data->slug]) }}">{{ __(strtoupper($data->name)) }}</a>
                                </li>
                            @endforeach
                        @endif
                        <li>
                            <a class="{{ menuActive('blog') }}" href="{{ route('blog') }}">@lang('UPDATES')</a>
                        </li>

                        <li>
                            <a class="{{ menuActive('contact') }}" href="{{ route('contact') }}">@lang('CONTACT')</a>
                        </li>
                    </ul>
                    <div class="nav-right justify-content-xl-end ps-0 ps-xl-5">
                        <a class="btn btn-sm btn--base" href="{{ route('room.types') }}"><i class="las la-hand-point-right"></i> @lang('BOOK ROOM')</a>

                    </div>

                </div>
            </nav>
        </div>
    </div>
</header>
