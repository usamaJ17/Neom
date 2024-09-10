@php
$bannerCon = getContent('banner.content', true);
@endphp
@if (!request()->routeIs('home'))
    <section class="inner-hero bg_img" style="background-image: url('{{ getImage('assets/images/frontend/banner/' . (isset($bannerCon->data_values->breadcrumb_image) ? $bannerCon->data_values->breadcrumb_image : '' ), '') }}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2 class="title text-white">{{ __($pageTitle) }}</h2>
                </div>
            </div>
        </div>
    </section>
@endif
