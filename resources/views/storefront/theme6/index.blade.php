@extends('storefront.layout.theme6')

@section('page-title')
    {{ __('Home') }}
@endsection

@push('css-page')
@endpush
@php
$imgpath=\App\Models\Utility::get_file('uploads/');
$productImg = \App\Models\Utility::get_file('uploads/is_cover_image/');
$catimg = \App\Models\Utility::get_file('uploads/product_image/');
$default =\App\Models\Utility::get_file('uploads/theme6/header/blog01.jpg');
$s_logo = \App\Models\Utility::get_file('uploads/store_logo/');

@endphp
@section('content')

    <div class="swiper-js-container position-relative home-banner">
        <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0">
            <div class="swiper-wrapper">
                {{-- home header --}}
                @php
                    $homepage_header_text = $homepage_header_btn = $homepage_header_bg_img = '';

                    $homepage_header_2_key = array_search('Home-Header', array_column($getStoreThemeSetting, 'section_name'));
                    if ($homepage_header_2_key != '') {
                        $homepage_header_2 = $getStoreThemeSetting[$homepage_header_2_key];
                    }
                @endphp
                {{-- @Dd($homepage_header_2) --}}
                @for ($i = 0; $i < $homepage_header_2['loop_number']; $i++)
                    @php
                        // dd($homepage_header_2['inner-list']);
                        foreach ($homepage_header_2['inner-list'] as $homepage_header_2_value) {
                            if ($homepage_header_2_value['field_slug'] == 'homepage-header-sub-title') {
                                $homepage_header_sub_title = $homepage_header_2_value['field_default_text'];
                            }
                            if ($homepage_header_2_value['field_slug'] == 'homepage-header-title') {
                                $homepage_header_text = $homepage_header_2_value['field_default_text'];
                            }
                            if ($homepage_header_2_value['field_slug'] == 'homepage-sub-text') {
                                $homepage_header_sub_text = $homepage_header_2_value['field_default_text'];
                            }
                            if ($homepage_header_2_value['field_slug'] == 'homepage-header-button') {
                                $homepage_header_btn = $homepage_header_2_value['field_default_text'];
                            }
                            if ($homepage_header_2_value['field_slug'] == 'homepage-header-bg-image') {
                                $homepage_header_bg_img = $homepage_header_2_value['field_default_text'];
                            }

                            if (!empty($homepage_header_2[$homepage_header_2_value['field_slug']])) {
                                if ($homepage_header_2_value['field_slug'] == 'homepage-header-sub-title') {
                                    $homepage_header_sub_title = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-header-title') {
                                    $homepage_header_text = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-sub-text') {
                                    $homepage_header_sub_text = $homepage_header_2_value['field_default_text'];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-header-button') {
                                    $homepage_header_btn = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-header-bg-image') {
                                    $homepage_header_bg_img = $homepage_header_2[$homepage_header_2_value['field_slug']][$i]['field_prev_text'];
                                }
                            }
                        }
                    @endphp
                    @if ($getStoreThemeSetting[1]['section_enable'] == 'on')
                        <section class="slice slice-xl bg-cover bg-size--cover w-100 swiper-slide"
                            data-offset-top="#header-main"
                            style="background-image: url({{ $imgpath . $homepage_header_bg_img }}); background-position: center center;">
                            <div class="container pb-md-6 pt-6 pt-md-8">
                                <div class="row  swiper-slide">
                                    <div class="col-lg-9 offset-1 offset-md-0">
                                        <h6 class="font-size-12 ls-3 t-white text-uppercase">
                                            {{ __($homepage_header_sub_title) }}</h6>
                                        <h2 class="font-merriweather h1 position-relative pr-md-6 store-title text-white">
                                            {{ __($homepage_header_text) }}
                                        </h2>
                                        <p class="lead text-white mt-4 store-dcs col-md-8 px-0">
                                            {{ __($homepage_header_sub_text) }}
                                        </p>
                                        <div>
                                            <a href="#" class="btn mr-4 btn-outline-white mt-4 rounded-0"
                                                id="start_shopping">
                                                {{ __($homepage_header_btn) }}
                                            </a>
                                            {{-- <a href="#" class="btn btn-primary mt-4 rounded-0">SPRAWDŹ NASZE HERBATY</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <span class="custom-slide-text text-white ls-15 font-size-12">Discover the beauty of tea</span> --}}
                        </section>
                    @endif
                @endfor
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination mt-4 d-flex align-items-center justify-content-center"></div>
        <span class="leaf01">
            <svg width="113" height="49" viewBox="0 0 113 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M110.525 22.2417C109.535 21.3226 86.0332 0 56.487 0C26.9408 0 3.46533 21.3226 2.47524 22.2417L0 24.5L2.47524 26.7583C3.46533 27.6774 26.9408 49 56.487 49C86.0332 49 109.535 27.6774 110.525 26.7583L113 24.5L110.525 22.2417ZM100.963 26.5482C91.2633 33.7762 80.1827 38.8996 68.4201 41.5948L83.3496 26.5482H100.963ZM83.9488 22.4517L69.2018 7.58892C80.6645 10.3639 91.4623 15.4169 100.963 22.4517H83.9488ZM62.3493 6.48607L78.1907 22.4517H57.3468L42.8342 7.82532C47.3154 6.74189 51.9048 6.178 56.513 6.14468C58.5974 6.14468 60.5254 6.30225 62.4535 6.48607H62.3493ZM51.5626 26.5482L38.2746 39.9405C28.8756 36.9165 20.0178 32.3952 12.0374 26.5482H51.5626ZM12.0113 22.4517C19.9935 16.5856 28.8616 12.0547 38.2746 9.03323L51.5626 22.4517H12.0113ZM42.8082 41.1747L57.3207 26.5482H77.5132L61.5937 42.5927C59.9262 42.724 58.2327 42.8553 56.3828 42.8553C51.8443 42.8061 47.3257 42.2423 42.9124 41.1747H42.8082Z"
                    fill="#94CE79" />
            </svg>
        </span>
        @if ($getStoreThemeSetting[1]['section_enable'] == 'on')
            <span class="leaf02">
                <img src="{{ asset('assets/theme6/img/image-with-text01.png') }}" class="img-fluid">
            </span>
        @endif
        <span class="leaf03">
            <img src="{{ asset('assets/theme6/img/slider-leaf01.png') }}" class="img-fluid">
        </span>
    </div>

    <!-- Products -->
    <section class="bestsellers-section">
        {{-- @DD($getStoreThemeSetting) --}}
        @foreach ($getStoreThemeSetting as $storesetting)
            @if ($storesetting['section_name'] == 'Quote' && $storesetting['section_enable'] == 'on')
                @php
                    foreach ($storesetting['inner-list'] as $value) {
                        $quote = $value['field_default_text'];
                    }
                @endphp
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 mb-4 pr-title">
                            <h5 class="font-weight-300 mt-4 text-secondary">
                                <span class="font-weight-500">
                                    {{ $quote }}
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        @if (count($topRatedProducts) > 0)
            <div class="bestsellers-tabs">
                <div class="col-lg-12 swiper-js-container">
                    <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                        data-swiper-sm-items="2" data-swiper-xl-items="4" data-swiper-slidesOffsetBefore="500">
                        <div class="swiper-wrapper">
                            {{-- @DD($topRatedProducts[5]) --}}
                            {{-- @DD($topRatedProducts[5]->product->id) --}}
                            @foreach ($topRatedProducts as $k => $topRatedProduct)

                                <div class="product-box swiper-slide d-flex">
                                    <div class="border-0 card card-product rounded-0 w-100">
                                        <div
                                            class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                            <span
                                                class="badge badge-secondary font-size-12 font-weight-300 ls-1 px-4 py-3 text-uppercase rounded-0">
                                                {{__('Bestseller')}}
                                            </span>
                                            @if (Auth::guard('customers')->check())
                                                @if (!empty($wishlist) && isset($wishlist[$topRatedProduct->product->id]['product_id']))
                                                    @if ($wishlist[$topRatedProduct->product->id]['product_id'] != $topRatedProduct->product->id)
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                            data-id="{{ $topRatedProduct->product->id }}">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button" class="bg-transparent border-0 p-0 "
                                                            data-id="{{ $topRatedProduct->product->id }}" disabled>
                                                            <i class="fas fa-heart"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button"
                                                        class="bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                        data-id="{{ $topRatedProduct->product->id }}">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button data-toggle="tooltip" data-original-title="Wishlist" type="button"
                                                    class="bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                    data-id="{{ $topRatedProduct->product->id }}">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                            @endif

                                        </div>
                                        <div class="card-image col-6 mx-auto pt-5 pb-4">
                                            <a
                                                href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}">
                                                @if (!empty($topRatedProduct->product->is_cover) &&
                                                    \Storage::exists('uploads/is_cover_image/' . $topRatedProduct->product->is_cover))
                                                    <img alt="Image placeholder"
                                                        src="{{ $productImg. $topRatedProduct->product->is_cover }}"
                                                        class="img-center img-fluid">
                                                @else
                                                    <img alt="Image placeholder"
                                                        src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                        class="img-center img-fluid">
                                                @endif
                                            </a>

                                        </div>
                                        <div class="card-body pt-0 text-center">
                                            <h6 class="mb-3">
                                                <span class="d-block">{{ $topRatedProduct->product->name }}</span>
                                                {{-- <a class="t-black13"
                                                    href="#">with orange petals</a> --}}
                                            </h6>
                                            <span class="card-price mb-4">
                                                @if ($topRatedProduct->product->enable_product_variant == 'on')
                                                    {{ __('In variant') }}
                                                @else
                                                    {{ \App\Models\Utility::priceFormat($topRatedProduct->product->price) }}
                                                @endif
                                            </span>
                                            <p class="text-sm">
                                                <span class="td-gray">{{ __('Category') }}:</span>
                                                {{ $topRatedProduct->product->product_category() }}
                                            </p>

                                            @if ($topRatedProduct->product->enable_product_variant == 'on')
                                                <a href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}"
                                                    class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline">
                                                    {{ __('ADD TO CART') }}
                                                </a>
                                            @else
                                                <a href="javascript:void(0)"
                                                    class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline add_to_cart"
                                                    data-id="{{ $topRatedProduct->product->id }}">
                                                    {{ __('ADD TO CART') }}
                                                </a>
                                            @endif



                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <!-- Add Arrow -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        @endif

    </section>
    {{-- email subscriber --}}
    @foreach ($getStoreThemeSetting as $storethemesetting)
        @if (isset($storethemesetting['section_name']) &&
            $storethemesetting['section_name'] == 'Home-Email-Subscriber' &&
            $storethemesetting['section_enable'] == 'on')
            @php
                $SubscriberTitle_key = array_search('Subscriber Title', array_column($storethemesetting['inner-list'], 'field_name'));
                $SubscriberTitle = $storethemesetting['inner-list'][$SubscriberTitle_key]['field_default_text'];

                $SubscriberBG_key = array_search('Subscriber Background Image', array_column($storethemesetting['inner-list'], 'field_name'));
                $SubscriberBG = $storethemesetting['inner-list'][$SubscriberBG_key]['field_default_text'];

            @endphp
            <section class="bg-cover bg-size--cove pb-10 pt-4"
                style="background-image: url({{$imgpath . $SubscriberBG }}); background-position: center center; background-size: cover;">
                <div class="container pb-250">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-lg-12 col-xl-12 text-center">
                            <center>
                                <div class="mb-5">
                                    {{ Form::open(['route' => ['subscriptions.store_email', $store->id], 'method' => 'POST']) }}
                                    <h2 class="font-weight-300 text-secondary">
                                        <span class="font-weight-500">
                                            {{ !empty($SubscriberTitle) ? $SubscriberTitle : 'Subscribe to us and stay up to date with the information' }}
                                        </span>
                                    </h2>
                                    <div class="d-flex col-6 align-middle">

                                        {{ Form::email('email', null, ['class' => 'font-size-12 form-control h-100 py-3 rounded-0 border-0 bg-white shadow-none', 'aria-label' => 'Enter your email address', 'placeholder' => __('Enter Your Email Address')]) }}
                                        <button type="submit"
                                            class="btn btn-primary px-5 rounded-0">{{ __('Subscribe') }}</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach



    @foreach ($getStoreThemeSetting as $key => $storethemesetting)
        @if ($storethemesetting['section_name'] == 'Home-Promotions' && $storethemesetting['array_type'] == 'inner-list')
            @php
                $section_enable = !empty($storethemesetting['section_enable']) ? $storethemesetting['section_enable'] : '';
            @endphp
        @endif
    @endforeach

    @if ($section_enable == 'on')
        <section class="image-with-text position-relative">
            <div class="container py-5 py-md-0">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-sm-12 col-md-5 ">
                        @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                            @if ($storethemesetting['section_name'] == 'Home-Promotions' &&
                                $storethemesetting['array_type'] == 'multi-inner-list')
                                @if (isset($storethemesetting['homepage-promotions-font-icon']) ||
                                    isset($storethemesetting['homepage-promotions-title']) ||
                                    isset($storethemesetting['homepage-promotions-description']))
                                    @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                        <div class="mb-4 d-flex align-items-flex-start">
                                            <div class="icon text-secondary promotions-icons">
                                                {!! $storethemesetting['homepage-promotions-font-icon'][$i] !!}
                                            </div>
                                            <div class="store-text">
                                                <strong class="text-secondary">
                                                    {{ $storethemesetting['homepage-promotions-title'][$i] }}
                                                </strong>
                                                <p class=" mt-2 mb-0 t-gray">
                                                    {{ $storethemesetting['homepage-promotions-description'][$i] }}
                                                </p>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                        <div class="mb-4 d-flex align-items-flex-start">

                                            <div class="icon text-secondary promotions-icons">
                                                {!! $storethemesetting['inner-list'][0]['field_default_text'] !!}
                                            </div>
                                            <div class="store-text">
                                                <strong class="text-secondary">
                                                    {{ $storethemesetting['inner-list'][1]['field_default_text'] }}
                                                </strong>
                                                <p class=" mt-2 mb-0 t-gray">
                                                    {{ $storethemesetting['inner-list'][2]['field_default_text'] }}
                                                </p>
                                            </div>

                                        </div>
                                    @endfor
                                @endif
                            @endif
                        @endforeach


                    </div>


                </div>

            </div>
            </div>


            <div class="col-md-6 px-0 ml-auto position-relative">
                @foreach ($getStoreThemeSetting as $storethemesetting)
                    @php
                        $promotion_img = '';
                        if ($storethemesetting['section_name'] == 'Home-Promotions' && $storethemesetting['array_type'] == 'inner-list') {
                            $promotion_img = $storethemesetting['inner-list'][0]['field_default_text'];

                            echo '<img src="' . $imgpath . $promotion_img . '" class="img-fluid">';
                        }
                        // <img src="{{ asset(Storage::url('uploads/' . $promotion_img)) }}" class="img-fluid">
                    @endphp
                @endforeach
                {{-- <img src="{{ asset('assets/theme6/img/image-with-text01.png') }}" class="img-fluid additional-img"> --}}
            </div>

        </section>
    @endif

    @foreach ($getStoreThemeSetting as $storethemesetting)
        @if ($storethemesetting['section_name'] == 'Banner-Image')
            @php
                $test = $getStoreThemeSetting[0]['section_enable'] == 'on' ? $storethemesetting['inner-list'][0]['field_default_text'] : '';
            @endphp
            <section class="featured-product position-relative pt-5 pt-md-0 tabs-wrapper">

                <img src="{{ $imgpath  . $test }}"
                    class="{{ $getStoreThemeSetting[0]['section_enable'] == 'on' ? 'img-fluid d-none d-md-block' : 'banner-off' }}"
                    id="shopping_section">

                <div class="container">
                    @if (count($theme6_product_random) > 0)
                        <div class="row">
                            <div class="col-lg-12 product-box title-head ">
                                <ul class="tabs" role="tablist" id="myTab">
                                    @foreach ($categories as $key => $category)
                                        <li class="">
                                            <a href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" data-id="{{ $key }}"
                                                class="{{ $key == 0 ? 'active' : '' }} productTab" id="electronic-tab"
                                                data-toggle="tab" role="tab" aria-controls="home"
                                                aria-selected="false">
                                                {{ __($category) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="show-more-link ">
                                    <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                        class="btn btn-primary rounded-0 px-5">{{ __('Show More') }}</a>
                                </div>
                            </div>

                            <div class="row product-row tabs-container" id="myTabContent">

                                @foreach ($products as $key => $items)
                                    <div class="tab-content {{ $key == 'Start shopping' ? 'active ' : '' }}"
                                        id="{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $key) !!}" role="tabpanel" aria-labelledby="shopping-tab">
                                        {{-- @foreach ($theme6_product_random as $k => $random) --}}

                                        @foreach ($items as $key => $product)
                                            @if ($key < 4)
                                                <div class="col-lg-3 col-sm-6 product-box d-flex">
                                                    <div class="border-0 bg-white card card-product rounded-0 w-100">
                                                        <div
                                                            class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                                            <span
                                                                class="badge badge-secondary font-size-12 font-weight-300 ls-1 px-4 py-3 text-uppercase rounded-0">
                                                                {{ __('Bestseller') }}
                                                            </span>

                                                            @if (Auth::guard('customers')->check())
                                                                @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                                    @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                                        <button data-toggle="tooltip"
                                                                            data-original-title="Wishlist" type="button"
                                                                            class="bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                            data-id="{{ $product->id }}">
                                                                            <i class="far fa-heart"></i>
                                                                        </button>
                                                                    @else
                                                                        <button data-toggle="tooltip"
                                                                            data-original-title="Wishlist" type="button"
                                                                            class="bg-transparent border-0 p-0 "
                                                                            data-id="{{ $product->id }}" disabled>
                                                                            <i class="fas fa-heart"></i>
                                                                        </button>
                                                                    @endif
                                                                @else
                                                                    <button data-toggle="tooltip"
                                                                        data-original-title="Wishlist" type="button"
                                                                        class="bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                        data-id="{{ $product->id }}">
                                                                        <i class="far fa-heart"></i>
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <button data-toggle="tooltip"
                                                                    data-original-title="Wishlist" type="button"
                                                                    class="bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                    data-id="{{ $product->id }}">
                                                                    <i class="far fa-heart"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        <div
                                                            class="card-image col-6 mx-auto pt-5 pb-4 d-flex justify-content-center align-items-center">

                                                            <a
                                                                href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                                @if (!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/' . $product->is_cover))
                                                                    <img alt="Image placeholder"
                                                                        src="{{ $productImg . $product->is_cover }}"
                                                                        class="img-center img-fluid">
                                                                @else
                                                                    <img alt="Image placeholder"
                                                                        src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                                        class="img-center img-fluid">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="card-body pt-0 text-center">
                                                            <h6 class="mb-3"><span
                                                                    class="d-block">{{ $product->name }}</span>

                                                            </h6>
                                                            <p class="text-sm">
                                                                <span class="td-gray">{{ __('Category') }}:</span>
                                                                {{ $product->product_category() }}
                                                            </p>
                                                            <span class="card-price mb-4">
                                                                @if ($product->enable_product_variant == 'on')
                                                                    {{ __('In variant') }}
                                                                @else
                                                                    {{ \App\Models\Utility::priceFormat($product->price) }}
                                                                @endif
                                                            </span>

                                                            @if ($product->enable_product_variant == 'on')
                                                                <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                                    class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline">
                                                                    {{ __('ADD TO CART') }}
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0)"
                                                                    class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline add_to_cart"
                                                                    data-id="{{ $product->id }}">
                                                                    {{ __('ADD TO CART') }}
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif
    @endforeach

    {{-- category --}}
    @foreach ($getStoreThemeSetting as $storethemesetting)
        @if (isset($storethemesetting['section_name']) &&
            $storethemesetting['section_name'] == 'Home-Categories' &&
            $storethemesetting['section_enable'] == 'on' &&
            !empty($pro_categories))
            @php
                // dd($storethemesetting);
                $Titlekey = array_search('Title', array_column($storethemesetting['inner-list'], 'field_name'));
                $Title = $storethemesetting['inner-list'][$Titlekey]['field_default_text'];

                $Description_key = array_search('Description', array_column($storethemesetting['inner-list'], 'field_name'));
                $Description = $storethemesetting['inner-list'][$Description_key]['field_default_text'];
            @endphp

            <section class="categorie-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-5 text-center">
                                <h4 class="font-weight-300 my-3 text-secondary">
                                    {{ !empty($Title) ? $Title : 'Categories' }}</h4>
                                <p class="font-size-12 my-3 text-secondary">
                                    {{ !empty($Description)
                                        ? $Description
                                        : 'There is only that moment and the incredible certainty <br> that everything under the sun has been written by one hand only.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($pro_categories as $key => $pro_categorie)
                            <div class="col-lg-4 col-sm-4 categories-box">
                                <div class="position-relative">
                                    <div class="cat-box">
                                        @if (!empty($pro_categorie->categorie_img) &&
                                            \Storage::exists('uploads/product_image/' . $pro_categorie->categorie_img))
                                            <img alt="Image placeholder"
                                                src="{{ $catimg. (!empty($pro_categorie->categorie_img) ? $pro_categorie->categorie_img : 'default.jpg') }}">
                                        @else
                                            <img alt="Image placeholder"
                                                src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}">
                                        @endif
                                    </div>
                                    <div class="cat-dcs text-left px-4 px-sm-2 px-md-4">
                                        {{-- <h6 class="font-size-12 font-weight-300 ls-3 t-white text-uppercase mb-3">GUIDES
                                        </h6> --}}
                                        <h3 class="t-white text-left col-lg-8 px-0 mb-3">{{ $pro_categorie->name }}</h3>
                                        <a href="{{ route('store.categorie.product', [$store->slug, $pro_categorie->name]) }}"
                                            class="btn btn-outline-white py-2 rounded-0">{{ __('VIEW MORE') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif
    @endforeach



    <!-- Testimonials (v1) -->
    <section class="slice testimonial-section">

        <div class="container pt-4">
            @foreach ($getStoreThemeSetting as $storethemesetting)
                @if (isset($storethemesetting['section_name']) &&
                    $storethemesetting['section_name'] == 'Home-Testimonial' &&
                    $storethemesetting['array_type'] == 'inner-list' &&
                    $storethemesetting['section_enable'] == 'on')
                    @php
                        $Heading_key = array_search('Heading', array_column($storethemesetting['inner-list'], 'field_name'));
                        $Heading = $storethemesetting['inner-list'][$Heading_key]['field_default_text'];

                        $HeadingSubText_key = array_search('Heading Sub Text', array_column($storethemesetting['inner-list'], 'field_name'));
                        $HeadingSubText = $storethemesetting['inner-list'][$HeadingSubText_key]['field_default_text'];
                    @endphp
                    <div class="fluid-paragraph mt-3 text-center">
                        <h3 class=" font-weight-300 my-3 text-secondary">
                            {{ !empty($Heading) ? $Heading : '' }}
                        </h3>
                    </div>
                    <div class="fluid-paragraph mt-3 text-center">
                        <p class="lead lh-180 store-dcs">
                            {{ !empty($HeadingSubText) ? $HeadingSubText : '' }}
                        </p>
                    </div>
                @endif
            @endforeach

            <div class="row testimonial-slider">
                <div class="col-lg-12">
                    <div class="swiper-js-container overflow-hidden">

                        <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                            data-swiper-sm-items="2" data-swiper-xl-items="3">
                            <div class="swiper-wrapper">
                                @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                                    @if (isset($storethemesetting['section_name']) &&
                                        $storethemesetting['section_name'] == 'Home-Testimonial' &&
                                        $storethemesetting['array_type'] == 'multi-inner-list')
                                        @if (isset($storethemesetting['homepage-testimonial-card-image']) ||
                                            isset($storethemesetting['homepage-testimonial-card-title']) ||
                                            isset($storethemesetting['homepage-testimonial-card-sub-text']) ||
                                            isset($storethemesetting['homepage-testimonial-card-description']) ||
                                            isset($storethemesetting['homepage-testimonial-card-enable']))
                                            @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                            @if($storethemesetting['homepage-testimonial-card-enable'][$i] == 'on')
                                                <div class="swiper-slide p-3">
                                                    <div
                                                        class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                                        <div class="card-body pb-0">
                                                            <div>
                                                                {{ $storethemesetting['homepage-testimonial-card-title'][$i] }}
                                                            </div>
                                                            <div class="message position-relative">
                                                                <span class="starting">
                                                                    <svg width="14" height="10"
                                                                        viewBox="0 0 14 10" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                                            fill="#615144" />
                                                                    </svg>
                                                                </span>
                                                                <p class="font-italic t-dcs text-secondary">
                                                                    {{ $storethemesetting['homepage-testimonial-card-description'][$i] }}
                                                                </p>
                                                                <span class="closing">
                                                                    <svg width="14" height="10"
                                                                        viewBox="0 0 14 10" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                                            fill="#615144" />
                                                                    </svg>
                                                                </span>
                                                            </div>

                                                            <div>
                                                                <img alt="Image placeholder"
                                                                    src="{{ $imgpath. $storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text'] }}"
                                                                    class="w-25">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endfor
                                        @else
                                            @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                                <div class="swiper-slide p-3">
                                                    <div
                                                        class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                                        <div class="card-body pb-0">
                                                            <div>
                                                                {{ $storethemesetting['inner-list'][2]['field_default_text'] }}
                                                            </div>
                                                            <div class="message position-relative">
                                                                <span class="starting">
                                                                    <svg width="14" height="10"
                                                                        viewBox="0 0 14 10" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                                            fill="#615144" />
                                                                    </svg>
                                                                </span>
                                                                <p class="font-italic t-dcs text-secondary">
                                                                    {{ $storethemesetting['inner-list'][3]['field_default_text'] }}
                                                                </p>
                                                                <span class="closing">
                                                                    <svg width="14" height="10"
                                                                        viewBox="0 0 14 10" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                                            fill="#615144" />
                                                                    </svg>
                                                                </span>
                                                            </div>

                                                            <div>
                                                                <img alt="Image placeholder"
                                                                    src="{{ $imgpath. (!empty($storethemesetting['inner-list'][1]['field_default_text']) ? $storethemesetting['inner-list'][1]['field_default_text'] : 'avatar.png') }}"
                                                                    class="w-25">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    @endif
                                @endforeach


                            </div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination w-100 mt-4 d-flex align-items-center justify-content-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="insta-section pt-4 pt-md-6 mt-5">
        <div class="container">
            {{-- <h2 class="font-weight-300 text-center text-secondary">Meet our social media</h2>
            <h6 class="font-weight-300 mb-4 pb-2 text-center text-primary">@teahouse</h6> --}}
            <div class="row">
                @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                    @if (isset($storethemesetting['section_name']) &&
                        $storethemesetting['section_name'] == 'Home-Brand-Logo' &&
                        $storethemesetting['section_enable'] == 'on')
                        @foreach ($storethemesetting['inner-list'] as $image)
                            @if (!empty($image['image_path']))
                                @foreach ($image['image_path'] as $img)
                                    <div class="col-4 col-lg-2 col-md-3 col-sm-4 insta-item">
                                        <a href="#" class=" d-block">
                                            <img src="{{ $imgpath . (!empty($img) ? $img : 'theme5/brand_logo/brand_logo.png') }}"
                                                alt="Footer logo" class="img-fluid position-absolute top-0 left-0 w-100 ">
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-4 col-lg-2 col-md-3 col-sm-4 insta-item">
                                    <a href="#" class="position-relative d-block">
                                        <img src="{{ $default}}" alt="Footer logo"
                                            class="img-fluid position-absolute top-0 left-0 w-100 h-100">
                                    </a>

                                </div>
                                <div class="col-4 col-lg-2 col-md-3 col-sm-4 insta-item">
                                    <a href="#" class="position-relative d-block">
                                        <img src="{{ $default}}" alt="Footer logo"
                                            class="img-fluid position-absolute top-0 left-0 w-100 h-100">
                                    </a>

                                </div>
                                <div class="col-4 col-lg-2 col-md-3 col-sm-4 insta-item">
                                    <a href="#" class="position-relative d-block">
                                        <img src="{{ $default}}" alt="Footer logo"
                                            class="img-fluid position-absolute top-0 left-0 w-100 h-100">
                                    </a>

                                </div>
                                <div class="col-4 col-lg-2 col-md-3 col-sm-4 insta-item">
                                    <a href="#" class="position-relative d-block">
                                        <img src="{{ $default}}" alt="Footer logo"
                                            class="img-fluid position-absolute top-0 left-0 w-100 h-100">
                                    </a>

                                </div>
                                <div class="col-4 col-lg-2 col-md-3 col-sm-4 insta-item">
                                    <a href="#" class="position-relative d-block">
                                        <img src="{{ $default}}" alt="Footer logo"
                                            class="img-fluid position-absolute top-0 left-0 w-100 h-100">
                                    </a>

                                </div>
                                <div class="col-4 col-lg-2 col-md-3 col-sm-4 insta-item">
                                    <a href="#" class="position-relative d-block">
                                        <img src="{{ $default}}" alt="Footer logo"
                                            class="img-fluid position-absolute top-0 left-0 w-100 h-100">
                                    </a>

                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('script-page')
    <script>
        $(document).ready(function() {
            $("#electronic-tab").trigger('click');
            // $('#Furniture').addClass('active');
            $("#myTab li:eq(0)").addClass('active');
            $("#myTab li a:eq(0)").trigger('click');
            $("#myTab li a:eq(0)").addClass('active');
        });
        // Tab js
        $('ul.tabs li').click(function() {
            // alert('hello')
            var $this = $(this);
            var $theTab = $(this).attr('data-tab');
            if ($this.hasClass('active')) {} else {
                $this.closest('.tabs-wrapper').find('ul.tabs li, .tabs-container .tab-content').removeClass(
                    'active');
                $('.tabs-container .tab-content[id="' + $theTab + '"], ul.tabs li[data-tab="' + $theTab + ']')
                    .addClass('active');
            }
            $('ul.tabs li').removeClass('active');
            $(this).addClass('active');
            // $('.product-tab-slider').slick('refresh');
        });

        $(".productTab").click(function(e) {
            e.preventDefault();
            $('.productTab').removeClass('active')

        });


        $("#start_shopping").click(function() {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#shopping_section").offset().top
            }, 2000);
        });
    </script>
@endpush
