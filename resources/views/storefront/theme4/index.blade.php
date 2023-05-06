@extends('storefront.layout.theme4')
@section('page-title')
    {{ __('Home') }}
@endsection
@push('css-page')
    <style>
        .p-tablist .nav-tabs .nav-item .nav-link.active {
            font-weight: bold;
        }

        .cat-box {
            max-height: 284px;
        }
    </style>
@endpush
@php
$imgpath=\App\Models\Utility::get_file('uploads/');
$productImg = \App\Models\Utility::get_file('uploads/is_cover_image/');
$catimg = \App\Models\Utility::get_file('uploads/product_image/');
$default =\App\Models\Utility::get_file('uploads/theme4/header/brand_logo.png');
$s_logo = \App\Models\Utility::get_file('uploads/store_logo/');

@endphp
@section('content')

    @foreach ($getStoreThemeSetting as $ThemeSetting)
        @if (isset($ThemeSetting['section_name']) &&
            $ThemeSetting['section_name'] == 'Home-Header' &&
            $ThemeSetting['section_enable'] == 'on')
            @php
                $homepage_header_title_key = array_search('Title', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_title = $ThemeSetting['inner-list'][$homepage_header_title_key]['field_default_text'];

                $homepage_header_Sub_text_key = array_search('Sub text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_Sub_text = $ThemeSetting['inner-list'][$homepage_header_Sub_text_key]['field_default_text'];

                $homepage_header_Button_key = array_search('Button', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_Button = $ThemeSetting['inner-list'][$homepage_header_Button_key]['field_default_text'];

                $homepage_header_Bckground_Image_key = array_search('Background Image', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_Bckground_Image = $ThemeSetting['inner-list'][$homepage_header_Bckground_Image_key]['field_default_text'];

                if ($ThemeSetting['section_name'] == 'Home-Header' && $ThemeSetting['section_enable'] == 'on') {
                    $storethemesetting['enable_header_img'] = 'on';
                }

            @endphp

            <section class="slice slice-xl bg-cover bg-size--cover home-banner " data-offset-top="#header-main"
                style="background-image: url({{ $imgpath . $homepage_header_Bckground_Image }});
            background-position: center center;">
                <div class="container py-6">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 col-md-8">
                            <h2 class="h1 text-white store-title mb-5">
                                {{ !empty($homepage_header_title) ? $homepage_header_title : 'Home Accessories' }}
                            </h2>
                            <p class="lead text-white mt-4 w-75">
                                {{ !empty($homepage_header_Sub_text) ? $homepage_header_Sub_text : 'There is only that moment and the incredible certainty that everything under the sun has been written by one hand only.' }}
                            </p>
                            <div class="two-button">
                                <a href="#"
                                    class="big-btn bg-white rounded-pill hover-translate-y-n3 mt-50 d-inline-block"
                                    id="pro_scroll">
                                    <span class="nav-text">
                                        {{ !empty($homepage_header_Button) ? $homepage_header_Button : __('Start shopping') }}
                                    </span>
                                    <i class="fas fa-shopping-basket"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach
    {{-- @DD($storethemesetting['enable_header_img']) --}}
    <section class="store-promotions {{ empty($storethemesetting['enable_header_img']) ? 'pt-8' : '' }}">
        <div class="container">
            <div class="row align-items-center bg-white">
                @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                    @if (isset($storethemesetting['section_name']) &&
                        $storethemesetting['section_name'] == 'Home-Brand-Logo' &&
                        $storethemesetting['section_enable'] == 'on')
                        <div class="col-lg-12">
                            <div class="row">
                                @foreach ($storethemesetting['inner-list'] as $image)
                                    @if (!empty($image['image_path']))
                                        @foreach ($image['image_path'] as $img)
                                            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                                <a href="#">
                                                    <img class="logo-imare"
                                                        src="{{ $imgpath . (!empty($img) ? $img : 'storego-image.png') }}"
                                                        alt="logo">
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                            <a href="#">
                                                <img class="logo-imare"
                                                    src="{{ $default }}"
                                                    alt="Footer logo">
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                            <a href="#">
                                                <img class="logo-imare"
                                                    src="{{ $default }}"
                                                    alt="Footer logo">

                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                            <a href="#">
                                                <img class="logo-imare"
                                                    src="{{ $default }}"
                                                    alt="Footer logo">
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                            <a href="#">
                                                <img class="logo-imare"
                                                    src="{{ $default }}"
                                                    alt="Footer logo">

                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                            <a href="#">
                                                <img class="logo-imare"
                                                    src="{{ $default }}"
                                                    alt="Footer logo">
                                            </a>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                            <a href="#">
                                                <img class="logo-imare"
                                                    src="{{ $default }}"
                                                    alt="Footer logo">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach

                {{-- promotions --}}
                <div class="col-lg-4 col-sm-12 col-md-5 mt-5">
                    @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                        @if ($storethemesetting['section_name'] == 'Home-Promotions' && $storethemesetting['section_enable'] == 'on')
                            @if (isset($storethemesetting['homepage-promotions-font-icon']) ||
                                isset($storethemesetting['homepage-promotions-title']) ||
                                isset($storethemesetting['homepage-promotions-description']))
                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                    <div class="mb-4 d-flex align-items-flex-start">
                                        <div class="icon text-primary">
                                            {!! $storethemesetting['homepage-promotions-font-icon'][$i] !!}
                                        </div>
                                        <div class="store-text">
                                            <strong class="text-primary">
                                                {{ $storethemesetting['homepage-promotions-title'][$i] }}
                                            </strong>
                                            <p class=" mt-2 mb-0 t-gray">
                                                {{ $storethemesetting['homepage-promotions-description'][$i] }}
                                            </p>
                                        </div>
                                    </div>
                                    @if ($i == 2)
                                        <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                            class="btn btn-sm btn-primary rounded-pill btn-icon">
                                            <span class="btn-inner--text">
                                                {{ __('Show more products') }}
                                            </span>
                                            <span class="btn-inner--icon">
                                                <i class="fas fa-shopping-basket"></i>
                                            </span>
                                        </a>
                                    @endif
                                @endfor
                            @else
                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                    <div class="mb-4 d-flex align-items-flex-start">
                                        <div class="mb-4">
                                            <div class="icon text-primary">
                                                {!! $storethemesetting['inner-list'][0]['field_default_text'] !!}
                                            </div>
                                            <div class="store-text">
                                                <strong class="text-primary">
                                                    {{ $storethemesetting['inner-list'][1]['field_default_text'] }}
                                                </strong>
                                                <p class=" mt-2 mb-0 t-gray">
                                                    {{ $storethemesetting['inner-list'][2]['field_default_text'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($i == 2)
                                        <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                            class="btn btn-sm btn-primary rounded-pill btn-icon">
                                            <span class="btn-inner--text">
                                                {{ __('Show more products') }}
                                            </span>
                                            <span class="btn-inner--icon">
                                                <i class="fas fa-shopping-basket"></i>
                                            </span>
                                        </a>
                                    @endif
                                @endfor
                            @endif
                        @endif
                    @endforeach


                </div>

                @foreach ($getStoreThemeSetting as $storethemesetting)
                    @if ($storethemesetting['section_name'] == 'Banner-Image')
                        @if ($storethemesetting['section_enable'] == 'on')
                            <div class="col-lg-8 col-md-7">
                                <img class="image-right out sidw"
                                    src="{{ $imgpath. (!empty($storethemesetting['inner-list'][0]['field_default_text']) ? $storethemesetting['inner-list'][0]['field_default_text'] : 'banner_image.png') }}"
                                    alt="img" width="927" height="627">

                            </div>
                        @else
                            <div class="col-lg-8 col-md-7">


                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    @if (count($topRatedProducts) > 0)
        @php

            foreach ($getStoreThemeSetting as $key => $storethemesetting) {
                if (isset($storethemesetting['section_name']) && $storethemesetting['section_name'] == 'Home-Brand-Logo' && $storethemesetting['section_enable'] == 'on') {
                    $storethemesetting['enable_brand_logo'] = 'on';
                } else {
                    $storethemesetting['enable_brand_logo'] = 'off';
                }
                if ($storethemesetting['section_name'] == 'Home-Promotions' && $storethemesetting['section_enable'] == 'on') {
                    $storethemesetting['enable_features'] = 'on';
                } else {
                    $storethemesetting['enable_features'] = 'off';
                }
                if ($storethemesetting['section_name'] == 'Banner-Image' && $storethemesetting['section_enable'] == 'on') {
                    $storethemesetting['enable_banner_img'] = 'on';
                } else {
                    $storethemesetting['enable_banner_img'] = 'off';
                }
            }
        @endphp
        <section
        class="categorie-section bg-primary  {{ $storethemesetting['enable_brand_logo'] != 'on' || $storethemesetting['enable_features'] != 'on' || $storethemesetting['enable_banner_img'] != 'on' ? 'pt-5' : '' }}">
        <div class="container">
            <div class="row align-items-center">
                    <div class="col-lg-7 col-md-8">
                    @if($getStoreThemeSetting[4]['section_enable'] == 'on')
                        <h3 class=" mt-4 store-title text-white">
                           {{$getStoreThemeSetting[4]['inner-list'][0]['field_default_text']}}
                        </h3>
                        <div class="mt-3">
                            <p class="lead lh-180 text-white">
                               {{$getStoreThemeSetting[4]['inner-list'][1]['field_default_text']}}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-5 text-right col-md-4">
                        <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                            class="btn btn-sm btn-border rounded-pill btn-icon">
                            <span class="btn-inner--text">{{ __('Start shopping') }}</span>
                            <span class="btn-inner--icon">
                                <i class="fas fa-shopping-basket"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    @foreach ($topRatedProducts as $k => $topRatedProduct)
                        <div class="col-lg-4 col-md-6 col-sm-12 categories-box">
                            <div class="cat-box">
                                <div class="cat-dcs">
                                    <h3 class="t-primary mb-3">{{ $topRatedProduct->product->name }}</h3>
                                    <p class="t-primary">{{ __('Category') }}:
                                        {{ $topRatedProduct->product->product_category() }}</p>
                                    <p>{{ __('From pixel-perfect icons and scalable vector') }}</p>
                                    <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                        class="btn pl-0 pr-0 rounded-pill btn-icon">
                                        <span class="btn-inner--text">{{ __('Show more products') }}</span>
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-shopping-basket"></i>
                                        </span>
                                    </a>
                                </div>

                                @if (!empty($topRatedProduct->product->is_cover) &&
                                    \Storage::exists('uploads/is_cover_image/' . $topRatedProduct->product->is_cover))
                                    <img src="{{ $productImg. (!empty($topRatedProduct->product->is_cover) ? $topRatedProduct->product->is_cover : '') }}"
                                        class="right-half" alt="image" style="width: 120px; height: 120px">
                                @else
                                    <img src="{{ asset(Storage::url('uploads/store_logo/default.jpg')) }}"
                                        class="right-half" alt="image" style="width: 120px; height: 120px">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Products -->
    @if ($products['Start shopping']->count() > 0)
        <section id="pro_items" class="top-product accessories-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-8">
                        <div class="pr-title mb-4">
                            <h3 class="mt-4 store-title text-primary">{{ __('Products') }}</h3>
                            <div class="p-tablist">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach ($categories as $key => $category)
                                        <li class="nav-item">
                                            <a href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" data-id="{{ $key }}"
                                                class="nav-link {{ $key == 0 ? 'active' : '' }} productTab"
                                                id="electronic-tab" data-toggle="tab" role="tab"
                                                aria-controls="home" aria-selected="false">
                                                {{ __($category) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right col-md-4">
                        <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                            class="btn btn-sm btn-primary rounded-pill btn-icon">
                            <span class="btn-inner--text">{{ __('Show more products') }}</span>
                            <span class="btn-inner--icon">
                                <i class="fas fa-shopping-basket"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="tab-content bestsellers-tabs" id="myTabContent">
                        @foreach ($products as $key => $items)
                            <div class="tab-pane fade {{ $key == 'Start shopping' ? 'active show' : '' }}"
                                id="{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $key) !!}" role="tabpanel" aria-labelledby="shopping-tab">
                                <div class="col-lg-12">
                                    <div class="row">
                                        @if ($items->count() > 0)
                                            @foreach ($items as $product)
                                                <div class="col-xl-3 col-lg-4 col-sm-6 product-box">
                                                    <div class="card card-product">
                                                        <div class="card-image bg-white">
                                                            <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                                class="d-inline-block w-100 h-100">
                                                                @if (!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/' . $product->is_cover))
                                                                    <img alt="Image placeholder"
                                                                        src="{{ $productImg . $product->is_cover}}"
                                                                        class="img-center img-fluid">
                                                                @else
                                                                    <img alt="Image placeholder"
                                                                        src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                                        class="img-center img-fluid">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <h6><a class="t-black13"
                                                                    href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">{{ $product->name }}</a>
                                                            </h6>
                                                            <p class="text-sm">
                                                                <span class="td-gray">{{ __('Category') }}:</span>
                                                                {{ $product->product_category() }}
                                                            </p>
                                                            <span class="static-rating static-rating-sm">
                                                                @if ($store->enable_rating == 'on')
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @php
                                                                            $icon = 'fa-star';
                                                                            $color = '';
                                                                            $newVal1 = $i - 0.5;
                                                                            if ($product->product_rating() < $i && $product->product_rating() >= $newVal1) {
                                                                                $icon = 'fa-star-half-alt';
                                                                            }
                                                                            if ($product->product_rating() >= $newVal1) {
                                                                                $color = 'text-warning';
                                                                            }
                                                                        @endphp
                                                                        <i class="star fas {{ $icon . ' ' . $color }}"></i>
                                                                    @endfor
                                                                @endif
                                                            </span>
                                                            <div class="product-price mt-3">
                                                                <span class="card-price t-black15">
                                                                    @if ($product->enable_product_variant == 'on')
                                                                        {{ __('In variant') }}
                                                                    @else
                                                                        {{ \App\Models\Utility::priceFormat($product->price) }}
                                                                    @endif
                                                                </span>
                                                                @if ($product->enable_product_variant == 'on')
                                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                                        class="action-item pcart-icon bg-primary">
                                                                        {{ __('Start shopping') }}
                                                                        <i class="ml-2 fas fa-shopping-basket"></i>
                                                                    </a>
                                                                @else
                                                                    <a class="action-item pcart-icon bg-primary add_to_cart"
                                                                        data-id="{{ $product->id }}">
                                                                        {{ __('Start shopping') }} <i
                                                                            class="ml-2 fas fa-shopping-basket"></i>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="actions card-product-actions">
                                                            @if (Auth::guard('customers')->check())
                                                                @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                                    @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                                        <button type="button"
                                                                            class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $product->id }}"
                                                                            data-id="{{ $product->id }}">
                                                                            <i class="far fa-heart"></i>
                                                                        </button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="action-item wishlist-icon bg-light-gray"
                                                                            data-id="{{ $product->id }}" disabled>
                                                                            <i class="fas fa-heart"></i>
                                                                        </button>
                                                                    @endif
                                                                @else
                                                                    <button type="button"
                                                                        class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $product->id }}"
                                                                        data-id="{{ $product->id }}">
                                                                        <i class="far fa-heart"></i>
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <button type="button"
                                                                    class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $product->id }}"
                                                                    data-id="{{ $product->id }}">
                                                                    <i class="far fa-heart"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-12 product-box">
                                                <div class="card card-product">
                                                    <h6 class="m-0 text-center no_record"><i class="fas fa-ban"></i>
                                                        {{ __('No Record Found') }}</h6>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif


    <!-- Products categories-->
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
            <section class="categorie-section light-blue-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-8">
                            <h3 class="mt-4 store-title text-primary">
                                {{ !empty($Title) ? $Title : 'Categories' }}
                            </h3>
                            <div class="mt-3">
                                <p class="lead lh-180 w-75">
                                    {{ !empty($Description) ? $Description : 'There is only that moment and the incredible certainty <br> that everything under the sun has been written by one hand only.' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 text-right">
                            <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                class="btn btn-sm btn-primary rounded-pill btn-icon">
                                <span class="btn-inner--text">{{ __('Show more products') }}</span>
                                <span class="btn-inner--icon">
                                    <i class="ml-2 fas fa-shopping-basket"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        @foreach ($pro_categories as $key => $pro_categorie)
                            {{-- @if ($product_count[$key] > 0) --}}
                            <div class="col-lg-4 col-md-6 col-sm-12 categories-box">
                                <div class="cat-box">
                                    <div class="cat-dcs">
                                        <h3 class="t-primary mb-5">{{ $pro_categorie->name }}</h3>
                                        <p class="t-primary mb-3">{{ __('Products') }}:
                                            {{ !empty($product_count[$key]) ? $product_count[$key] : '0' }}</p>
                                        <a href="{{ route('store.categorie.product', [$store->slug, $pro_categorie->name]) }}"
                                            class="btn pl-0 pr-0 rounded-pill btn-icon">

                                            <span class="btn-inner--text">{{ __('Show more products') }}</span>
                                            <span class="btn-inner--icon">
                                                <i class="fas fa-shopping-basket"></i>
                                            </span>
                                        </a>
                                        @if (!empty($pro_categorie->categorie_img) &&
                                            \Storage::exists('uploads/product_image/' . $pro_categorie->categorie_img))

                                            <img alt="Image placeholder"
                                                src="{{ $catimg . (!empty($pro_categorie->categorie_img) ? $pro_categorie->categorie_img : 'default.jpg') }}"
                                                class="right-half">
                                        @else
                                            <img alt="Image placeholder"
                                                src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}"
                                                class="right-half">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    <!-- subscriber -->

    @foreach ($getStoreThemeSetting as $storethemesetting)
        @if (isset($storethemesetting['section_name']) &&
            $storethemesetting['section_name'] == 'Home-Email-Subscriber' &&
            $storethemesetting['section_enable'] == 'on')
            @php
                // dd($storethemesetting);
                $emailsubs_img_key = array_search('Subscriber Background Image', array_column($storethemesetting['inner-list'], 'field_name'));
                $emailsubs_img = $storethemesetting['inner-list'][$emailsubs_img_key]['field_default_text'];

                $SubscriberTitle_key = array_search('Subscriber Title', array_column($storethemesetting['inner-list'], 'field_name'));
                $SubscriberTitle = $storethemesetting['inner-list'][$SubscriberTitle_key]['field_default_text'];

                $SubscriberDescription_key = array_search('Subscriber Description', array_column($storethemesetting['inner-list'], 'field_name'));
                $SubscriberDescription = $storethemesetting['inner-list'][$SubscriberDescription_key]['field_default_text'];

                $SubscribeButton_key = array_search('Subscribe Button Text', array_column($storethemesetting['inner-list'], 'field_name'));
                $SubscribeButton = $storethemesetting['inner-list'][$SubscribeButton_key]['field_default_text'];
            @endphp

            <section class="slice slice-xl bg-cover bg-size--cover"
                style="background-image: url({{ $imgpath. (!empty($emailsubs_img) ? $emailsubs_img : 'img-17.jpg') }}); background-position: center center;">
                <div class="container py-6">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-lg-12 col-xl-12 text-center">
                            <div class="mb-5">
                                <h1 class="text-white store-title">
                                    {{ !empty($SubscriberTitle) ? $SubscriberTitle : 'Always on time' }}
                                </h1>
                                <p class="lead text-white mt-2 store-dcs">
                                    {{ !empty($SubscriberDescription) ? $SubscriberDescription : 'Subscription here' }}
                                </p>
                            </div>
                            {{ Form::open(['route' => ['subscriptions.store_email', $store->id], 'method' => 'POST']) }}
                            <div class="form-group mb-0 form-subscribe">
                                <div class="input-group input-group-lg input-group-merge">
                                    {{ Form::email('email', null, ['class' => 'form-control bg-white form-control-flush rounded-pill', 'aria-label' => 'Enter your email address', 'placeholder' => __('Enter Your Email Address')]) }}
                                    <div class="input-group-append ml-3">
                                        <button type="submit"
                                            class="btn btn-primary rounded-pill hover-translate-y-n3 btn-icon mr-sm-4 scroll-me">
                                            <span class="btn-inner--text">{{ $SubscribeButton }}</span>
                                            <span class="far fa-paper-plane"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    <!-- Testimonials (v1) -->
@if($getStoreThemeSetting[5]['section_enable'] == 'on')
    <section class="slice testimonial-section">
        <div class="container">
            <div class="text-center">
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
                        <h3 class="mt-4 store-title text-white">
                            {{ !empty($storethemesetting['testimonial_main_heading']) ? $storethemesetting['testimonial_main_heading'] : 'Testimonials' }}
                        </h3>
                        <div class="fluid-paragraph mt-3">
                            <p class="lead lh-180 store-dcs text-white">
                                {{ !empty($storethemesetting['testimonial_main_heading_title'])
                                    ? $storethemesetting['testimonial_main_heading_title']
                                    : 'There is only that moment and the incredible certainty that <br> everything
                                                                    under the sun has been written by one hand only.' }}
                            </p>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="container">
                <div class="row testimonial-slider justify-content-center">
                    <div class="col-lg-10">
                        <div class="swiper-js-container overflow-hidden">
                            <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="1"
                                data-swiper-sm-items="1" data-swiper-xl-items="1">
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
                                                        <div class="card bg-transparent">
                                                            <div class="card-body">
                                                                <p class="t-dcs text-white text-center">
                                                                    {{ $storethemesetting['homepage-testimonial-card-description'][$i] }}
                                                                </p>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <div>
                                                                        <img alt=""
                                                                            src="{{ $imgpath. (!empty($storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text']) ? $storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text'] : 'qo.png') }}"
                                                                            class="avatar rounded-circle">
                                                                    </div>
                                                                    <div class="pl-3">
                                                                        <h5 class="t-author text-white">
                                                                            {{ $storethemesetting['homepage-testimonial-card-title'][$i] }}
                                                                        </h5>
                                                                        <small class="d-block t-author-dcs text-white">
                                                                            {{ $storethemesetting['homepage-testimonial-card-sub-text'][$i] }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endfor
                                            @else
                                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                                    <div class="swiper-slide p-3">
                                                        <div class="card bg-transparent">
                                                            <div class="card-body">
                                                                <p class="t-dcs text-white text-center">
                                                                    {{ $storethemesetting['inner-list'][4]['field_default_text'] }}
                                                                </p>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <div>
                                                                        <img alt="Image placeholder"
                                                                            src="{{ $imgpath. (!empty($storethemesetting['inner-list'][1]['field_default_text']) ? $storethemesetting['inner-list'][1]['field_default_text'] : '') }}"
                                                                            class="avatar  rounded-circle">
                                                                    </div>
                                                                    <div class="pl-3">
                                                                        <h5 class="t-author text-white">
                                                                            {{ $storethemesetting['inner-list'][2]['field_default_text'] }}
                                                                        </h5>
                                                                        <small class="d-block t-author-dcs text-white">
                                                                            {{ $storethemesetting['inner-list'][3]['field_default_text'] }}</small>
                                                                        </small>
                                                                    </div>
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
        </div>
    </section>
@endif

@endsection
@push('script-page')
    <script>
        $(".add_to_cart").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var variants = [];
            $(".variant-selection").each(function(index, element) {
                variants.push(element.value);
            });

            if (jQuery.inArray('', variants) != -1) {
                show_toastr('Error', "{{ __('Please select all option.') }}", 'error');
                return false;
            }
            var variation_ids = $('#variant_id').val();

            $.ajax({
                url: '{{ route('user.addToCart', ['__product_id', $store->slug, 'variation_id']) }}'.replace(
                    '__product_id', id).replace('variation_id', variation_ids ?? 0),
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    variants: variants.join(' : '),
                },
                success: function(response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.success, 'success');
                        $("#shoping_counts").html(response.item_count);
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function(result) {
                    console.log('error');
                }
            });
        });

        $(document).on('click', '.add_to_wishlist', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: '{{ route('store.addtowishlist', [$store->slug, '__product_id']) }}'.replace(
                    '__product_id', id),
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.message, 'success');
                        $('.wishlist_' + response.id).removeClass('add_to_wishlist');
                        $('.wishlist_' + response.id).html('<i class="fas fa-heart"></i>');
                        $('.wishlist_count').html(response.count);
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function(result) {}
            });
        });

        $(".productTab").click(function(e) {
            e.preventDefault();
            $('.productTab').removeClass('active')

        });

        $("#pro_scroll").click(function() {
            $('html, body').animate({
                scrollTop: $("#pro_items").offset().top
            }, 1000);
        });
    </script>
@endpush
