@extends('storefront.layout.theme7')

@section('page-title')
    {{ __('Home') }}
@endsection

@push('css-page')
@endpush
@php
$imgpath=\App\Models\Utility::get_file('uploads/');
$productImg = \App\Models\Utility::get_file('uploads/is_cover_image/');
$catimg = \App\Models\Utility::get_file('uploads/product_image/');
$default =\App\Models\Utility::get_file('uploads/theme7/header/img01.jpg');
$s_logo = \App\Models\Utility::get_file('uploads/store_logo/');

@endphp
@section('content')
    <!-- Main Banner -->
    <div class="swiper-js-container position-relative home-banner">
        <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0">
            <div class="swiper-wrapper">

                @php
                    $homepage_header_text = $homepage_header_btn = $homepage_header_bg_img = '';
                    $homepage_header_2_key = array_search('Home-Header', array_column($getStoreThemeSetting, 'section_name'));

                    // if ( is_int($homepage_header_2_key)) {
                    if (!empty($getStoreThemeSetting[$homepage_header_2_key])) {
                        $homepage_header_2 = $getStoreThemeSetting[$homepage_header_2_key];
                    }
                @endphp
                @for ($i = 0; $i < $homepage_header_2['loop_number']; $i++)
                    @php
                        foreach ($homepage_header_2['inner-list'] as $homepage_header_2_value) {
                            if ($homepage_header_2_value['field_slug'] == 'homepage-header-title') {
                                $homepage_header_text = $homepage_header_2_value['field_default_text'];
                            }
                            if ($homepage_header_2_value['field_slug'] == 'homepage-sub-text') {
                                $homepage_header_sub_text = $homepage_header_2_value['field_default_text'];
                            }
                            if ($homepage_header_2_value['field_slug'] == 'homepage-header-button') {
                                $homepage_header_btn = $homepage_header_2_value['field_default_text'];
                            }
                            if ($homepage_header_2_value['field_slug'] == 'header-tag') {
                                $homepage_header_tag = $homepage_header_2_value['field_default_text'];
                            }

                            if (!empty($homepage_header_2[$homepage_header_2_value['field_slug']])) {
                                if ($homepage_header_2_value['field_slug'] == 'homepage-header-title') {
                                    $homepage_header_text = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-sub-text') {
                                    $homepage_header_sub_text = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'header-tag') {
                                    $homepage_header_tag = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-header-button') {
                                    $homepage_header_btn = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                }
                            }
                        }
                    @endphp
                    {{-- @DD($homepage_header_text,$homepage_header_sub_text,$homepage_header_btn,$homepage_header_bg_img) --}}
                    @if ($getStoreThemeSetting[0]['section_enable'] == 'on')
                        <section class="py-md-6 py-5 w-100 swiper-slide" data-offset-top="#header-main">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <img src="{{ $imgpath. (!empty($homepage_header_tag['field_prev_text']) ? $homepage_header_tag['field_prev_text'] : $homepage_header_tag) }}"
                                            class="col-md-2 col-5 px-0 mb-3 ">
                                        <h2 class="store-title text-primary"> {{ $homepage_header_text }} </h2>
                                        <p class="col-md-9 mt-4 px-0 store-dcs">

                                            {{ $homepage_header_sub_text }}
                                        </p>
                                        <div>
                                            <a href="#start_shopping"
                                                class="btn btn-outline-primary mt-4">{{ $homepage_header_btn }}</a>
                                        </div>
                                    </div>
                                    @if (sizeof($theme7_product))
                                        <div class="col-md-4 col-6 mx-auto mt-4 mt-md-0">
                                            @if ($theme7_product != null)
                                                <div class=" ml-auto px-0 position-relative img-div">
                                                    @if ($i == 0)
                                                        @if ($theme7_product_image->count() > 0 &&
                                                            \Storage::exists('uploads/product_image/' . $theme7_product_image[0]['product_images']))
                                                            <img class="img-center img-fluid"
                                                                src="{{ $catimg . $theme7_product_image[0]['product_images'] }}"
                                                                alt="New collection" title="New collection">
                                                        @else
                                                            <img class="img-center img-fluid"
                                                                src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}"
                                                                alt="New collection" title="New collection">
                                                        @endif
                                                        {{-- </a> --}}
                                                        <div class="slider-caption text-right">
                                                            @if ($theme7_product[0]['enable_product_variant'] == 'on')
                                                                <a href="{{ route('store.product.product_view', [$store->slug, $theme7_product[0]['id']]) }}"
                                                                    type="button"
                                                                    class="align-items-center bg-white border border-dark d-flex justify-content-center ml-auto plus-btn rounded-pill text-dark"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="ADD TO CART">
                                                                    +
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0)" type="button"
                                                                    class="align-items-center bg-white border border-dark d-flex justify-content-center ml-auto plus-btn rounded-pill text-dark add_to_cart"
                                                                    data-id="{{ $theme7_product[0]['id'] }}"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="ADD TO CART">
                                                                    +
                                                                </a>
                                                            @endif
                                                            <span
                                                                class="font-size-12">{{ $theme7_product[0]['name'] }}</span>
                                                            <h4 class="font-weight-300 mb-1">

                                                                @if ($theme7_product[0]['enable_product_variant'] == 'on')
                                                                    {{ __('In variant') }}
                                                                @else
                                                                    {{ \App\Models\Utility::priceFormat($theme7_product[0]['price']) }}
                                                                @endif
                                                            </h4>
                                                        </div>
                                                    @else
                                                        @if (!empty($theme7_product_image[1]))
                                                            <div class="slider-caption text-right">
                                                                @if ($theme7_product[1]['enable_product_variant'] == 'on')
                                                                    <a href="{{ route('store.product.product_view', [$store->slug, $theme7_product[1]['id']]) }}"
                                                                        type="button"
                                                                        class="align-items-center bg-white border border-dark d-flex justify-content-center ml-auto plus-btn rounded-pill text-dark"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="ADD TO CART">
                                                                        +
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0)" type="button"
                                                                        class="align-items-center bg-white border border-dark d-flex justify-content-center ml-auto plus-btn rounded-pill text-dark add_to_cart"
                                                                        data-id="{{ $theme7_product[1]['id'] }}"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="ADD TO CART">
                                                                        +
                                                                    </a>
                                                                @endif
                                                                <span
                                                                    class="font-size-12">{{ $theme7_product[1]['name'] }}</span>
                                                                <h4 class="font-weight-300 mb-1">

                                                                    @if ($theme7_product[1]['enable_product_variant'] == 'on')
                                                                        {{ __('In variant') }}
                                                                    @else
                                                                        {{ \App\Models\Utility::priceFormat($theme7_product[1]['price']) }}
                                                                    @endif
                                                                </h4>
                                                            </div>
                                                        @endif
                                                    @endif


                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </section>
                    @endif
                @endfor
            </div>
        </div>
        <!-- Add Pagination -->
        @if ($getStoreThemeSetting[0]['section_enable'] == 'on')
            <div class="swiper-pagination mt-4 d-flex align-items-center justify-content-center"></div>

            <div
                class="slider-additional align-items-center border-dark border-right d-none d-lg-flex flex-wrap justify-content-center">
                <span>
                    <img src="{{ $imgpath. (!empty($getStoreThemeSetting[1]['homepage-header-bg-image'][0]['image']) ? $getStoreThemeSetting[1]['homepage-header-bg-image'][0]['image'] : $getStoreThemeSetting[1]['inner-list'][0]['field_default_text']) }}"
                        class="px-3">
                </span>
                {{-- @DD($getStoreThemeSetting) --}}
                <ul class="list-inline footer-social social-icons">
                    @if (isset($getStoreThemeSetting[2]['homepage-sidebar-social-icon']) ||
                        isset($getStoreThemeSetting[2]['homepage-sidebar-social-link']))
                        @if (isset($getStoreThemeSetting[2]['inner-list'][1]['field_default_text']) &&
                            isset($getStoreThemeSetting[2]['inner-list'][0]['field_default_text']))
                            @foreach ($getStoreThemeSetting[2]['homepage-sidebar-social-icon'] as $icon_key => $storethemesettingicon)
                                @foreach ($getStoreThemeSetting[2]['homepage-sidebar-social-link'] as $link_key => $storethemesettinglink)
                                    @if ($icon_key == $link_key)
                                        <li class="py-1">
                                            <a href="{{ $storethemesettinglink }}"
                                                class="d-flex align-items-center justify-content-center">
                                                {!! $storethemesettingicon !!}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    @else
                        @for ($i = 0; $i < $getStoreThemeSetting[2]['loop_number']; $i++)
                            @if (isset($getStoreThemeSetting[2]['inner-list'][1]['field_default_text']) &&
                                isset($getStoreThemeSetting[2]['inner-list'][0]['field_default_text']))
                                <li class="py-1">
                                    <a class="d-flex align-items-center justify-content-center footer-icon"
                                        href="{{ $getStoreThemeSetting[2]['inner-list'][1]['field_default_text'] }}"
                                        target="_blank">
                                        {!! $getStoreThemeSetting[2]['inner-list'][0]['field_default_text'] !!}
                                    </a>
                                </li>
                            @endif
                        @endfor
                    @endif

                </ul>
            </div>
        @endif
    </div>


    <!-- promotions -->
    <div class="quick-services border-bottom border-dark border-top">
        @if ($getStoreThemeSetting[3]['section_enable'] == 'on')
            <div class="container">
                <div class="row no-gutters">
                    @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                        @if ($storethemesetting['section_name'] == 'Home-Promotions' &&
                            $storethemesetting['array_type'] == 'multi-inner-list')
                            @if (isset($storethemesetting['homepage-promotions-font-icon']) ||
                                isset($storethemesetting['homepage-promotions-title']) ||
                                isset($storethemesetting['homepage-promotions-description']))
                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                    <div class="col-md-4">
                                        <div class="py-5 px-4 service-item">
                                            <span class="d-block mb-3">
                                                {!! $storethemesetting['homepage-promotions-font-icon'][$i] !!}
                                            </span>
                                            <h5 class="font-weight-500">
                                                {{ $storethemesetting['homepage-promotions-title'][$i] }}
                                            </h5>
                                            <p class="font-size-12">
                                                {{ $storethemesetting['homepage-promotions-description'][$i] }}
                                            </p>
                                        </div>
                                    </div>
                                @endfor
                            @else
                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                    <div class="col-md-4">
                                        <div class="py-5 px-4 service-item">
                                            <span class="d-block mb-3">
                                                {!! $storethemesetting['inner-list'][0]['field_default_text'] !!}
                                            </span>
                                            <h5 class="font-weight-500">
                                                {{ $storethemesetting['inner-list'][1]['field_default_text'] }}
                                            </h5>
                                            <p class="font-size-12">
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
        @endif
    </div>

    <!-- Products -->
    <section class="bestsellers-section mt-md-5 mt-lg-6 {{ count($products) <= 1 ? 'd-none' : '' }}" id="start_shopping">
        <div class="container">
            <div class="row mb-2">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <h3 class="font-weight-500 mb-0">{{ __('Bestsellers') }}</h3>
                </div>
            </div>

            <div class="p-tablist mb-5">
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    @foreach ($categories as $key => $category)
                        <li class="nav-item">
                            <a class="nav-link border-0 bg-transparent productTab {{ $key == 0 ? 'active' : '' }}"
                                id="all-products-tab" data-toggle="tab" data-id="{{ $key }}"
                                href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" role="tab" aria-controls="all-products"
                                aria-selected="true">
                                {{ __($category) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bestsellers-tabs tab-content" id="myTabContent">
                {{-- @php
                    unset($products['Start shopping']);
                    $countItem = 0;
                @endphp --}}
                @foreach ($products as $key => $items)
                    <div class="tab-pane fade show {{ $key == 'Start shopping' ? 'active ' : '' }} "
                        id="{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $key) !!}" role="tabpanel" aria-labelledby="all-products-tab">
                        <div class="col-lg-12 ">
                            <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                                data-swiper-sm-items="2" data-swiper-xl-items="4" data-swiper-slidesOffsetBefore="500">
                                <div class="swiper-wrapper">
                                    @foreach ($items as $key => $product)
                                        @if ($key < 4)
                                            <div class="col-lg-3 pt-3 col-sm-6 col-md-4 product-box swiper-slide">
                                                <div class="border-0 card card-product rounded-lg">
                                                    <span
                                                        class="badge bg-body border border-dark font-size-12 font-weight-300 font-weight-600 ls-1 px-3 py-2 rounded-pill text-uppercase">
                                                        {{ __('Bestseller') }}
                                                    </span>
                                                    <div class="d-flex justify-content-end mt-1">
                                                        @if (Auth::guard('customers')->check())
                                                            @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                                @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                                    <button data-toggle="tooltip"
                                                                        data-original-title="Wishlist" type="button"
                                                                        class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                        data-id="{{ $product->id }}">
                                                                        <i class="far fa-heart"></i>
                                                                    </button>
                                                                @else
                                                                    <button data-toggle="tooltip"
                                                                        data-original-title="Wishlist" type="button"
                                                                        class="mr-4 bg-transparent border-0 p-0 "
                                                                        data-id="{{ $product->id }}" disabled>
                                                                        <i class="fas fa-heart"></i>
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <button data-toggle="tooltip"
                                                                    data-original-title="Wishlist" type="button"
                                                                    class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                    data-id="{{ $product->id }}">
                                                                    <i class="far fa-heart"></i>
                                                                </button>
                                                            @endif
                                                        @else
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                data-id="{{ $product->id }}">
                                                                <i class="far fa-heart"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="card-image col-6 mx-auto pt-5 pb-4">
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
                                                    <div class="card-body pb-3 pt-0 px-3 text-center">
                                                        <h6 class="mb-2">
                                                            <a
                                                                href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                                {{ $product->name }}
                                                            </a>
                                                        </h6>
                                                        <p class="text-sm">
                                                            <span class="td-gray">{{ __('Category') }}:</span>
                                                            {{ $product->product_category() }}
                                                        </p>
                                                        <span class="card-price mb-3">
                                                            @if ($product->enable_product_variant == 'on')
                                                                {{ __('In variant') }}
                                                            @else
                                                                {{ \App\Models\Utility::priceFormat($product->price) }}
                                                            @endif
                                                        </span>

                                                        @if ($product->enable_product_variant == 'on')
                                                            <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                                type="button" class="btn btn-primary">
                                                                {{ __('ADD TO CART') }}
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)" type="button"
                                                                class="btn btn-primary add_to_cart"
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
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
            <div class="text-center mt-5">
                <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                    class="btn btn-outline-dark">
                    {{ __('Show More') }}
                </a>
            </div>
        </div>

    </section>
    <!--banner logo -->
    @if ($getStoreThemeSetting[4]['section_enable'] == 'on')
        <section class="bg-primary featured-product position-relative py-md-8 py-xl-0">
            <div class="container py-5 py-md-0">
                <div class="row align-items-center">

                    <div class="col-md-7 col-lg-6">
                        {{-- <img src="./assets/img/logo-white.png" class="col-md-3 col-4 px-0 mb-4"> --}}
                        <h2 class="col-lg-10 col-xl-9 px-0 mb-3 ls-1 text-white">
                            {{ $getStoreThemeSetting[4]['inner-list'][0]['field_default_text'] }}
                        </h2>
                        <p class="font-size-12 col-md-10 col-xl-9 px-0 font-weight-300 mb-4 text-white">
                            {{ $getStoreThemeSetting[4]['inner-list'][1]['field_default_text'] }}
                        </p>
                        <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                            class="btn btn-outline-light">
                            {{ $getStoreThemeSetting[4]['inner-list'][3]['field_default_text'] }}
                        </a>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-10 col-xl-8">
                        <div class="row">
                            {{-- @DD($mostPurchased) --}}
                            @foreach ($mostPurchased as $products)
                                {{-- @dd($product,$products) --}}
                                <div class="col-md-6 mb-3 mb-md-0" data-id="{{ $products->id }}">
                                    <div
                                        class="border-0 card mb-0 bg-body card-product d-flex flex-row position-relative rounded-lg align-items-center">
                                        <span
                                            class="badge bg-body border border-dark font-size-12 font-weight-300 font-weight-600 ls-1 px-3 py-2 rounded-pill text-uppercase mt-2">
                                            {{ __('Bestseller') }}
                                        </span>
                                        <div class="card-image col-4 mx-auto pr-3">
                                            <a
                                                href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                @if (!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/' . $product->is_cover))
                                                    <img alt="Image placeholder"
                                                        src="{{ $productImg. $product->is_cover }}"
                                                        class="img-center img-fluid">
                                                @else
                                                    <img alt="Image placeholder"
                                                        src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                        class="img-center img-fluid">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="card-body py-0 pl-0 pr-3">
                                            <h6 class="mb-2"> <a
                                                    href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                    {{ $product->name }}
                                                </a></h6>
                                            <p class="text-sm">
                                                <span class="td-gray">{{ __('Category') }}:</span>
                                                {{ $product->product_category() }}
                                            </p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h4 class="font-weight-300">
                                                    @if ($product->enable_product_variant == 'on')
                                                        {{ __('In variant') }}
                                                    @else
                                                        {{ \App\Models\Utility::priceFormat($product->price) }}
                                                    @endif

                                                </h4>
                                                @if ($product->enable_product_variant == 'on')
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                        type="button" class="btn btn-dark px-4 text-small">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" type="button"
                                                        class="btn btn-dark px-4 text-small add_to_cart"
                                                        data-id="{{ $product->id }}">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 px-0 ml-auto">
                <img src="{{ $imgpath. $getStoreThemeSetting[4]['inner-list'][2]['field_default_text'] }}"
                    class="img-fluid">
                {{-- <img src="" class="img-fluid"> --}}
            </div>
        </section>
    @endif



    <!--category -->
    <section
        class=" border-dark border-top pt-5 pb-4 position-relative {{ count($pro_categories) == 0 ? 'categories-container mt-0' : 'categorie-section' }}">
        @if ($getStoreThemeSetting[6]['section_enable'] == 'on')
        <div class="container">
            <div class="row">
                {{-- category --}}

                    @foreach ($getStoreThemeSetting as $storethemesetting)
                        @if (isset($storethemesetting['section_name']) &&
                            $storethemesetting['section_name'] == 'Home-Categories' &&
                            !empty($pro_categories))
                            @php
                                $Titlekey = array_search('Title', array_column($storethemesetting['inner-list'], 'field_name'));
                                $Title = $storethemesetting['inner-list'][$Titlekey]['field_default_text'];

                                $Description_key = array_search('Description', array_column($storethemesetting['inner-list'], 'field_name'));
                                $Description = $storethemesetting['inner-list'][$Description_key]['field_default_text'];

                                $catImg_key = array_search('Image', array_column($storethemesetting['inner-list'], 'field_name'));
                                $catImg = $storethemesetting['inner-list'][$catImg_key]['field_default_text'];
                            @endphp
                            <div class="col-lg-6 mx-auto">
                                <div class="mb-5 text-center">
                                    <img alt="Image placeholder" src="{{ $imgpath. $catImg }}"
                                        class="col-4 px-0">
                                    <h2 class="my-3 text-primary">{{ $Title }}</h2>
                                    <p class="font-size-12">
                                        {{ $Description }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach

            </div>
            {{-- @if (count($pro_categories) == 0)
            <h5> No records Found.</h5>
            @endif --}}

            <div class="row justify-content-center ">

                @foreach ($pro_categories as $key => $pro_categorie)
                    <div class="col-lg-3 col-sm-6 categories-box">
                        <div class="bg-body card overflow-hidden rounded-lg mb-0">
                            <div class="cat-box">
                                @if (!empty($pro_categorie->categorie_img) &&
                                    \Storage::exists('uploads/product_image/' . $pro_categorie->categorie_img))
                                    <img alt="Image placeholder"
                                        src="{{ $catimg . (!empty($pro_categorie->categorie_img) ? $pro_categorie->categorie_img : 'default.jpg') }}">
                                @else
                                    <img alt="Image placeholder"
                                        src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}">
                                @endif
                            </div>
                            <div class="card-body p-3">

                                <h5>{{ $pro_categorie->name }}</h5>

                                <a href="{{ route('store.categorie.product', [$store->slug, $pro_categorie->name]) }}"
                                    class="btn btn-primary">{{ __('VIEW MORE') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-md-5">
                {{-- <a href="#" class="btn btn-outline-light">GO TO BLOG</a> --}}
            </div>
        </div>
        @endif
    </section>

    <!-- Testimonials (v1) -->

    @if ($getStoreThemeSetting[7]['section_enable'] == 'on')
        <section class="slice testimonial-section bg-primary pb-7 pt-3">
            <div class="container pt-4">
                <h3 class="text-center text-white">{{ $getStoreThemeSetting[7]['inner-list'][0]['field_default_text'] }}
                </h3>
                <div class="row testimonial-slider">
                    <div class="col-lg-10 mx-auto">
                        <div class="swiper-js-container overflow-hidden">

                            <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0">
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
                                                                <div class="message">
                                                                    <h5 class="font-weight-300 text-white">
                                                                        {{ $storethemesetting['homepage-testimonial-card-description'][$i] }}
                                                                    </h5>
                                                                    <p
                                                                        class="align-items-center d-flex justify-content-center mt-5 text-white font-size-12">

                                                                        <img alt="Image placeholder"
                                                                            src="{{ $imgpath. $storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text'] }}"
                                                                            class=" badge-circle badge-md badge-white mr-3">

                                                                        <span class="font-weight-600">
                                                                            {{ $storethemesetting['homepage-testimonial-card-title'][$i] }}
                                                                        </span>
                                                                    </p>
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
                                                                <div class="message">
                                                                    <h5 class="font-weight-300 text-white">
                                                                        {{ $storethemesetting['inner-list'][3]['field_default_text'] }}
                                                                    </h5>
                                                                    <p
                                                                        class="align-items-center d-flex justify-content-center mt-5 text-white font-size-12">

                                                                        <img alt="Image placeholder"
                                                                            src="{{ $imgpath . (!empty($storethemesetting['inner-list'][1]['field_default_text']) ? $storethemesetting['inner-list'][1]['field_default_text'] : 'avatar.png') }}"
                                                                            class=" badge-circle badge-md badge-white mr-3">
                                                                        <span class="font-weight-600">
                                                                            {{ $storethemesetting['inner-list'][2]['field_default_text'] }}
                                                                        </span>
                                                                    </p>
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
                            <div class="swiper-pagination w-100 mt-1 d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    @if ($getStoreThemeSetting[9]['section_enable'] == 'on')
        <div class="insta-section pt-5 pt-md-6">
            <div class="container">
                <h2 class="font-weight-300 text-center mb-3">

                    <span class="font-weight-500">
                        {{ $getStoreThemeSetting[9]['inner-list'][1]['field_default_text'] }}
                    </span>
                </h2>
                <p class="col-md-7 font-size-12 mb-5 mx-auto text-center">
                    {{ $getStoreThemeSetting[9]['inner-list'][2]['field_default_text'] }}
                </p>

                <div class="row justify-content-center">
                    @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                        @if (isset($storethemesetting['section_name']) &&
                            $storethemesetting['section_name'] == 'Home-Brand-Logo' &&
                            $storethemesetting['section_enable'] == 'on')
                            @foreach ($storethemesetting['inner-list'] as $image)
                                @if ($image['field_slug'] == 'homepage-brand-logo-input')
                                    @if (!empty($image['image_path']))
                                        @foreach ($image['image_path'] as $img)
                                            <div class="col-4 col-lg-2 col-md-3 col-sm-4 mb-3 mb-lg-0 insta-item">
                                                <a href="#"
                                                    class="position-relative d-block rounded-lg overflow-hidden">
                                                    <img src="{{ $imgpath . (!empty($img) ? $img : 'theme5/brand_logo/brand_logo.png') }}"
                                                        alt="Footer logo"
                                                        class="img-fluid position-absolute top-0 left-0 w-100 h-100">
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-4 col-lg-2 col-md-3 col-sm-4 mb-3 mb-lg-0 insta-item">
                                            <a href="#"
                                                class="position-relative d-block rounded-lg overflow-hidden">
                                                <img src="{{ $default}}"
                                                    alt="Footer logo"
                                                    class="img-fluid position-absolute top-0 left-0 w-100 h-100">
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    @endif
@endsection

@push('script-page')
    <script>
        $(document).ready(function() {


            // setTimeout(() => {
            //     // $('#Furniture').addClass('active');
            //     // $('#all-products-tab').trigger('click');
            //     // $("#myTab li:eq(0)").addClass('active');
            //     // $("#myTab li a:eq(0)").addClass('active');
            // }, 500);
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
