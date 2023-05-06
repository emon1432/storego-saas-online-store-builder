@extends('storefront.layout.theme10')

@section('page-title')
    {{ __('Home') }}
@endsection

@push('css-page')
@endpush
@php
$imgpath=\App\Models\Utility::get_file('uploads/');
$productImg = \App\Models\Utility::get_file('uploads/is_cover_image/');
$catimg = \App\Models\Utility::get_file('uploads/product_image/');
$default =\App\Models\Utility::get_file('uploads/theme10/header/brand_logo.jpg');
$s_logo = \App\Models\Utility::get_file('uploads/store_logo/');

@endphp
@section('content')
    <!-- Main Banner -->
    @foreach ($getStoreThemeSetting as $ThemeSetting)
        @if (isset($ThemeSetting['section_name']) &&
            $ThemeSetting['section_name'] == 'Home-Header' &&
            $ThemeSetting['section_enable'] == 'on')
            @php
                $homepage_header_img_key = array_search('Background Image', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_img = $ThemeSetting['inner-list'][$homepage_header_img_key]['field_default_text'];

                $homepage_header_title_key = array_search('Title', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_title = $ThemeSetting['inner-list'][$homepage_header_title_key]['field_default_text'];

                $homepage_header_subtxt_key = array_search('Sub text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_subtxt = $ThemeSetting['inner-list'][$homepage_header_subtxt_key]['field_default_text'];

                $homepage_header_btn_key = array_search('Button', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_btn = $ThemeSetting['inner-list'][$homepage_header_btn_key]['field_default_text'];
            @endphp

            <div class="position-relative">

                <div class="position-relative home-banner">
                    <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0">
                        <div class="swiper-wrapper">

                            <section class=" py-6 w-100 swiper-slide" data-offset-top="#header-main"
                                style="background-image: url({{ $imgpath . $homepage_header_img }}); background-position: right bottom 20%; background-repeat: no-repeat;">
                                <div class="container">
                                    <div class="row justify-content-between">
                                        <div class="col-md-7 col-xl-6">
                                            <h2 class="store-title text-primary">
                                                {{ $homepage_header_title }}
                                            </h2>
                                            <p class="col-md-10 col-10 mx-auto mx-md-0 mt-4 px-0 store-dcs">
                                                {{ $homepage_header_subtxt }}
                                            </p>
                                            <div>
                                                <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                                    class="btn btn-primary mt-3">
                                                    {{ $homepage_header_btn }}
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </section>

                        </div>
                    </div>
                    <!-- Add Pagination -->

                </div>

            </div>
        @endif
    @endforeach

    <section class="bg-transparent position-relative zindex-100">
        <div class="container">
            <div class="bg-primary p-4">
                <form action="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}" method="get">
                    @csrf
                    <div class="d-flex form-group position-relative mb-0 flex-wrap">
                        <div class="col-md-8 px-0 mb-2 mb-md-0">
                            <span class="left-3 position-absolute top-2">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0 8.25C0 12.8063 3.69365 16.5 8.25 16.5C10.1548 16.5 11.9088 15.8545 13.3052 14.7702C13.3578 14.8815 13.4302 14.9858 13.5222 15.0778L20.1222 21.6778C20.5518 22.1074 21.2482 22.1074 21.6778 21.6778C22.1074 21.2482 22.1074 20.5518 21.6778 20.1222L15.0778 13.5222C14.9858 13.4302 14.8815 13.3578 14.7702 13.3052C15.8545 11.9088 16.5 10.1548 16.5 8.25C16.5 3.69365 12.8063 0 8.25 0C3.69365 0 0 3.69365 0 8.25ZM2.2 8.25C2.2 4.90868 4.90868 2.2 8.25 2.2C11.5913 2.2 14.3 4.90868 14.3 8.25C14.3 11.5913 11.5913 14.3 8.25 14.3C4.90868 14.3 2.2 11.5913 2.2 8.25Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <input class="font-size-12 pl-5 form-control h-100 py-3 rounded-0 border-0 bg-white shadow-none"
                                type="text" placeholder="Type car part..." name="search_data">
                        </div>

                        <li class="nav-item dropdown col-md-3 mb-2 mb-md-0 px-0 px-md-3 category-li">
                            <a class="align-items-center justify-content-between d-flex font-size-12 pr-0 w-100 bg-white h-100 px-3 py-3 py-md-0"
                                href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <span class="category-dropdown">
                                </span>


                                <svg id="catIcon" width="10" height="10" viewBox="0 0 10 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 0.999958C6 0.447696 5.55228 3.88832e-07 5 4.37114e-07C4.44771 4.85396e-07 4 0.447696 4 0.999958L4 6.58593L1.70711 4.29313C1.31658 3.90263 0.683417 3.90263 0.292892 4.29313C-0.097633 4.68364 -0.0976329 5.31678 0.292892 5.70729L4.29289 9.70712C4.48043 9.89465 4.73478 10 5 10C5.26522 10 5.51957 9.89465 5.70711 9.70712L9.70711 5.70729C10.0976 5.31678 10.0976 4.68364 9.70711 4.29313C9.31658 3.90262 8.68342 3.90262 8.29289 4.29313L6 6.58593L6 0.999958Z"
                                        fill="black" />
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                @foreach ($categories as $key => $category)
                                    <a class="dropdown-item font-size-12 text-capitalize category-options productTab"
                                        id="electronic-tab" data-toggle="tab" role="tab" aria-controls="home"
                                        aria-selected="false" href="javascript:void(0);"
                                        data-active='{{ $category }}'>{{ $category }}</a>
                                @endforeach
                            </div>
                        </li>

                        <div class="col-md-1 px-0">
                            <button class="bg-dark btn-block border-0 h-100 px-3 py-3 py-md-2 rounded-0 top-0"
                                type="submit">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_8_776)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.5 12C0.5 11.4477 0.947715 11 1.5 11L21.0858 11L14.7932 4.7071C14.4026 4.31657 14.4027 3.6834 14.7932 3.29288C15.1837 2.90236 15.8169 2.90238 16.2074 3.29291L24.2071 11.2929C24.5976 11.6834 24.5976 12.3166 24.2071 12.7071L16.2074 20.7071C15.8169 21.0976 15.1837 21.0976 14.7932 20.7071C14.4027 20.3166 14.4026 19.6834 14.7932 19.2929L21.0858 13L1.5 13C0.947715 13 0.5 12.5523 0.5 12Z"
                                            fill="white"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Products -->
    <section class="bestsellers-section mt-0 pt-5 custom-bkg">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="font-weight-300 my-0 text-dark title-size">{{__('Popular parts')}}</h2>
                <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}" class="btn btn-primary">{{__('GO TO SHOP')}}</a>
            </div>

            {{-- @dd($products) --}}
            <div class="bestsellers-tabs mt-5">
                @foreach ($products as $key => $items)
                    <div class="col-lg-12 tab-content category-tab {{ $key == 'Start shopping' ? 'active ' : '' }}"
                        id="{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $key) !!}" role="tabpanel" aria-labelledby="shopping-tab"
                        data-content='{{ $key }}'>

                        <div class="swiper-wrapper">
                            @foreach ($items as $key => $product)
                                @if ($key < 4)
                                    <div class="col-lg-3 col-sm-6 col-md-4 product-box swiper-slide">
                                        <div class="border-0 card card-product rounded-0 shadow">
                                            <div
                                                class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">

                                                @if ($product->enable_product_variant == 'on')

                                                <span
                                                class="badge badge-primary rounded-0 font-weight-300 font-size-12 py-2 px-3">
                                                {{ __('Variant') }}
                                            </span>
                                            @else
                                                <span
                                                    class="badge badge-primary rounded-0 font-weight-300 font-size-12 py-2 px-3">
                                                    {{ \App\Models\Utility::priceFormat($product->price - $product->last_price) }}
                                                    {{ __('off') }}
                                                </span>
                                                @endif
                                                @if (Auth::guard('customers')->check())
                                                    @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                        @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100  add_to_wishlist wishlist_{{ $product->id }}"
                                                                data-id="{{ $product->id }}">
                                                                <i class="far fa-heart text-primary"></i>
                                                            </button>
                                                        @else
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100 "
                                                                data-id="{{ $product->id }}" disabled>
                                                                <i class="fas fa-heart text-primary"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100  add_to_wishlist wishlist_{{ $product->id }}"
                                                            data-id="{{ $product->id }}">
                                                            <i class="far fa-heart text-primary"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button"
                                                        class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100  add_to_wishlist wishlist_{{ $product->id }}"
                                                        data-id="{{ $product->id }}">
                                                        <i class="far fa-heart text-primary"></i>
                                                    </button>
                                                @endif


                                            </div>
                                            <div class="card-image col-8 mx-auto pt-4 pb-4">
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
                                            <div class="card-body pt-0 pb-4 px-4 px-md-3 px-lg-4">
                                                <h6 class="mb-0">
                                                    <a class="font-weight-600"
                                                        href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h6>
                                                <span class="font-weight-600 text-black-50 text-small">
                                                    {{ __('Category:') }}
                                                    {{ $product->categories->name }}
                                                </span>
                                                <div class="mb-2">
                                                    <span class="font-weight-600 text-lg text-primary">
                                                        @if ($product->enable_product_variant == 'on')
                                                            {{ __('In variant') }}
                                                        @else
                                                            {{ \App\Models\Utility::priceFormat($product->price) }}
                                                        @endif
                                                    </span>
                                                    <del class="font-size-12 font-weight-600 text-black-50 ml-2">
                                                        @if ($product->enable_product_variant == 'off')
                                                            {{ \App\Models\Utility::priceFormat($product->last_price) }}
                                                        @endif
                                                    </del>
                                                </div>
                                                @if ($product->enable_product_variant == 'on')
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                        class="border-0 btn btn-block btn-primary ">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="border-0 btn btn-block btn-primary  add_to_cart"
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
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                @endforeach
            </div>

        </div>

    </section>


    <!-- Image with Text -->
    @foreach ($getStoreThemeSetting as $ThemeSetting)
        @if (isset($ThemeSetting['section_name']) &&
            $ThemeSetting['section_name'] == 'Latest-Category' &&
            $ThemeSetting['section_enable'] == 'on')
            @php
                $homepage_header_title_key = array_search('Title', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_title = $ThemeSetting['inner-list'][$homepage_header_title_key]['field_default_text'];

                $homepage_header_subtxt_key = array_search('Sub text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_subtxt = $ThemeSetting['inner-list'][$homepage_header_subtxt_key]['field_default_text'];

                $homepage_header_btn_key = array_search('Button', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_btn = $ThemeSetting['inner-list'][$homepage_header_btn_key]['field_default_text'];
            @endphp

            <section class="image-with-text pb-4 pb-md-7">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-4 mb-md-0 text-center text-md-left">
                            <h2 class="title-size font-weight-300 text-primary mb-4">
                                {{ $homepage_header_title }}
                            </h2>
                            <p class="font-size-12">
                                {{ $homepage_header_subtxt }}
                            </p>
                            <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                class="btn btn-primary">
                                {{ $homepage_header_btn }}
                            </a>
                        </div>
                        <div class="col-md-8 mb-4 mb-md-0">
                            <div class="row">
                                @foreach ($latest2category as $key_c => $category)
                                    @if ($key_c < 2)
                                        <div class="{{ $key_c == 0 ? 'col-md-6 mb-4 mb-md-0' : 'col-md-6' }}">

                                            <div class="featured-item">
                                                @if (!empty($category->categorie_img) && \Storage::exists('uploads/product_image/' . $category->categorie_img))
                                                    <img alt="Image placeholder"
                                                        src="{{ $catimg. (!empty($category->categorie_img) ? $category->categorie_img : 'default.jpg')}}">
                                                @else
                                                    <img alt="Image placeholder"
                                                        src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}">
                                                @endif
                                                <div
                                                    class="caption position-absolute bottom-0 left-0 w-100 d-flex justify-content-between align-items-end pl-4">
                                                    <div>
                                                        <h2 class="font-weight-300 text-white"> {{ $category->name }}</h2>
                                                    </div>
                                                    <a href="{{ route('store.categorie.product', [$store->slug, $category->name]) }}"
                                                        class="btn btn-primary px-3">
                                                        <svg width="25" height="24" viewBox="0 0 25 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_20_4009)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M0.5 12C0.5 11.4477 0.947715 11 1.5 11L21.0858 11L14.7932 4.7071C14.4026 4.31657 14.4027 3.6834 14.7932 3.29288C15.1837 2.90236 15.8169 2.90238 16.2074 3.29291L24.2071 11.2929C24.5976 11.6834 24.5976 12.3166 24.2071 12.7071L16.2074 20.7071C15.8169 21.0976 15.1837 21.0976 14.7932 20.7071C14.4027 20.3166 14.4026 19.6834 14.7932 19.2929L21.0858 13L1.5 13C0.947715 13 0.5 12.5523 0.5 12Z"
                                                                    fill="#F7F6F1" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_20_4009">
                                                                    <rect width="24" height="24" fill="white"
                                                                        transform="matrix(-1 0 0 1 24.5 0)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    {{-- @DD($getStoreThemeSetting) --}}
    @foreach ($getStoreThemeSetting as $ThemeSetting)
        @if (isset($ThemeSetting['section_name']) &&
            $ThemeSetting['section_name'] == 'Latest-Products' &&
            $ThemeSetting['section_enable'] == 'on')
            @php
                $latestCatTitle_key = array_search('Title', array_column($ThemeSetting['inner-list'], 'field_name'));
                $latestCatTitle = $ThemeSetting['inner-list'][$latestCatTitle_key]['field_default_text'];

                $latestCatSubText_key = array_search('Sub text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $latestCatSubText = $ThemeSetting['inner-list'][$latestCatSubText_key]['field_default_text'];

                $latestCatButton_key = array_search('Button', array_column($ThemeSetting['inner-list'], 'field_name'));
                $latestCatButton = $ThemeSetting['inner-list'][$latestCatButton_key]['field_default_text'];

                $latestCatTagImg_key = array_search('Category Tag Image', array_column($ThemeSetting['inner-list'], 'field_name'));
                $latestCatTagImg = $ThemeSetting['inner-list'][$latestCatTagImg_key]['field_default_text'];

                $latestCatbackGround_key = array_search('Category Background Image', array_column($ThemeSetting['inner-list'], 'field_name'));
                $latestCatbackGround = $ThemeSetting['inner-list'][$latestCatbackGround_key]['field_default_text'];
                // dD($latestCatbackGround);
            @endphp
            {{-- @DD($latestCatbackGround) --}}
            <section class="bg-cover pt-5 w-100" data-offset-top="#header-main"
                style="background-image: url({{ $imgpath. $latestCatbackGround }}); background-position: center center; background-repeat: no-repeat;">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-5 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                            <img src="{{ $imgpath. $latestCatTagImg}}" class="col-4 px-0 mb-4">
                            <h2 class="font-weight-300 text-white">
                                {{ $latestCatTitle }}
                            </h2>
                            <p class="mt-4 store-dcs text-white">
                                {{ $latestCatSubText }}
                            </p>
                            <div>
                                <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                    class="btn btn-white mt-3">
                                    {{ $latestCatButton }}
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-6 mb-n6">

                            <div class="row">
                                {{-- @DD($latestProduct10) --}}
                                @foreach ($latestProduct10 as $keys => $latestProduct)
                                    <div class="col-md-6 product-box">
                                        <div class="border-0 card card-product rounded-0 shadow">
                                            <div
                                                class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                                @if ($latestProduct->enable_product_variant == 'on')

                                                <span
                                                class="badge badge-primary rounded-0 font-weight-300 font-size-12 py-2 px-3">

                                                {{ __('Variant') }}
                                            </span>
                                            @else
                                                <span
                                                    class="badge badge-primary rounded-0 font-weight-300 font-size-12 py-2 px-3">

                                                    {{ \App\Models\Utility::priceFormat($latestProduct->price - $latestProduct->last_price) }}
                                                    {{ __('off') }}
                                                </span>
                                                @endif
                                                @if (Auth::guard('customers')->check())
                                                    @if (!empty($wishlist) && isset($wishlist[$latestProduct->id]['product_id']))
                                                        @if ($wishlist[$latestProduct->id]['product_id'] != $latestProduct->id)
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100  add_to_wishlist wishlist_{{ $latestProduct->id }}"
                                                                data-id="{{ $latestProduct->id }}">
                                                                <i class="far fa-heart text-primary"></i>
                                                            </button>
                                                        @else
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100 "
                                                                data-id="{{ $latestProduct->id }}" disabled>
                                                                <i class="fas fa-heart text-primary"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100  add_to_wishlist wishlist_{{ $latestProduct->id }}"
                                                            data-id="{{ $latestProduct->id }}">
                                                            <i class="far fa-heart text-primary"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button"
                                                        class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100  add_to_wishlist wishlist_{{ $latestProduct->id }}"
                                                        data-id="{{ $latestProduct->id }}">
                                                        <i class="far fa-heart text-primary"></i>
                                                    </button>
                                                @endif

                                            </div>
                                            <div class="card-image col-8 mx-auto pt-4 pb-4">
                                                <a
                                                    href="{{ route('store.product.product_view', [$store->slug, $latestProduct->id]) }}">
                                                    @if (!empty($latestProduct->is_cover) && \Storage::exists('uploads/is_cover_image/' . $latestProduct->is_cover))
                                                        <img alt="Image placeholder"
                                                            src="{{ $productImg . $latestProduct->is_cover }}"
                                                            class="img-center img-fluid">
                                                    @else
                                                        <img alt="Image placeholder"
                                                            src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                            class="img-center img-fluid">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="card-body pt-0 pb-4 px-4 px-md-3 px-lg-4">
                                                <h6 class="mb-0">

                                                    <a class="font-weight-600"
                                                        href="{{ route('store.product.product_view', [$store->slug, $latestProduct->id]) }}">

                                                        {{ $latestProduct->name }}
                                                    </a>
                                                </h6>
                                                <span class="font-weight-600 text-black-50 text-small">
                                                    {{ __('Category:') }}
                                                    {{ $latestProduct->categories->name }}
                                                </span>
                                                <div class="mb-2">
                                                    <span class="font-weight-600 text-lg text-primary">
                                                        @if ($latestProduct->enable_product_variant == 'on')
                                                            {{ __('In variant') }}
                                                        @else
                                                            {{ \App\Models\Utility::priceFormat($latestProduct->price) }}
                                                        @endif
                                                    </span>
                                                    <del class="font-size-12 font-weight-600 text-black-50 ml-2">
                                                        @if ($latestProduct->enable_product_variant == 'off')
                                                            {{ \App\Models\Utility::priceFormat($latestProduct->last_price) }}
                                                        @endif
                                                    </del>
                                                </div>
                                                @if ($latestProduct->enable_product_variant == 'on')
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $latestProduct->id]) }}"
                                                        class="border-0 btn btn-block btn-primary ">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="border-0 btn btn-block btn-primary  add_to_cart"
                                                        data-id="{{ $latestProduct->id }}">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    <!-- Articles Categories-->
    @if ($getStoreThemeSetting[3]['section_enable'] == 'on')
        <section class="slice categorie-section pt-8 pb-4 position-relative">
            <div class="container">
                <div class="row justify-content-between align-items-center mb-md-5 text-center text-md-left">
                    @foreach ($getStoreThemeSetting as $storethemesetting)
                        @if (isset($storethemesetting['section_name']) &&
                            $storethemesetting['section_name'] == 'Home-Categories' &&
                            !empty($pro_categories))
                            @php
                                $Titlekey = array_search('Title', array_column($storethemesetting['inner-list'], 'field_name'));
                                $Title = $storethemesetting['inner-list'][$Titlekey]['field_default_text'];

                                $Description_key = array_search('Description', array_column($storethemesetting['inner-list'], 'field_name'));
                                $Description = $storethemesetting['inner-list'][$Description_key]['field_default_text'];
                            @endphp
                            <div class="col-md-6">
                                <h2 class="text-primary title-size-1 font-weight-300 mb-3 mb-md-0">
                                    {{ $Title }}
                                </h2>
                            </div>
                            <div class="col-md-5">
                                <p class="font-size-12">
                                    {{ $Description }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    @foreach ($pro_categories as $key => $pro_categorie)
                        <div class="col-sm-6 col-md-4 mb-3  ">
                            <div class="shadow">
                                <div class="cat-box">

                                    @if (!empty($pro_categorie->categorie_img) &&
                                        \Storage::exists('uploads/product_image/' . $pro_categorie->categorie_img))
                                        <img alt="Image placeholder"
                                            src="{{$catimg . (!empty($pro_categorie->categorie_img) ? $pro_categorie->categorie_img : 'default.jpg') }}">
                                    @else
                                        <img alt="Image placeholder"
                                            src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}">
                                    @endif
                                    <a href="{{ route('store.categorie.product', [$store->slug, $pro_categorie->name]) }}"
                                        class="badge badge-white font-size-12 left-4 ls-15 mb-0 position-absolute px-3 py-3 rounded-5 text-primary top-4 zindex-100 ">
                                        {{ $pro_categorie->name }}</a>
                                    <a href="{{ route('store.categorie.product', [$store->slug, $pro_categorie->name]) }}"
                                        class="bottom-0 btn btn-primary position-absolute px-3 right-0 text-primary">
                                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_20_4058)">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0.5 12C0.5 11.4477 0.947715 11 1.5 11L21.0858 11L14.7932 4.7071C14.4026 4.31657 14.4027 3.6834 14.7932 3.29288C15.1837 2.90236 15.8169 2.90238 16.2074 3.29291L24.2071 11.2929C24.5976 11.6834 24.5976 12.3166 24.2071 12.7071L16.2074 20.7071C15.8169 21.0976 15.1837 21.0976 14.7932 20.7071C14.4027 20.3166 14.4026 19.6834 14.7932 19.2929L21.0858 13L1.5 13C0.947715 13 0.5 12.5523 0.5 12Z"
                                                    fill="#F7F6F1" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_20_4058">
                                                    <rect width="24" height="24" fill="white"
                                                        transform="matrix(-1 0 0 1 24.5 0)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <!-- Products -->
    <section class="bestsellers-section mt-0 pt-5">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="font-weight-300 my-0 text-dark title-size">{{ __('Top Rated Products') }}</h2>
                <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}" class="btn btn-primary">{{__('GO TO SHOP')}}</a>
            </div>


            <div class="bestsellers-tabs mt-5">
                <div class="col-lg-12 ">
                    <div class="swiper-container swiper-container-horizontal" data-swiper-items="1"
                        data-swiper-space-between="0" data-swiper-sm-items="2" data-swiper-xl-items="4">
                        <div class="swiper-wrapper">
                            @if (count($topRatedProducts) > 0)
                                @foreach ($topRatedProducts as $k => $topRatedProduct)

                                    <div class="col-lg-3 col-sm-6 col-md-4 product-box swiper-slide">
                                        <div class="border-0 card card-product rounded-0 shadow">
                                            <div
                                                class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                                @if ($topRatedProduct->product->enable_product_variant == 'on')

                                                <span
                                                class="badge badge-primary rounded-0 font-weight-300 font-size-12 py-2 px-3">
                                                {{ __('Variant') }}
                                            </span>
                                            @else
                                                <span
                                                    class="badge badge-primary rounded-0 font-weight-300 font-size-12 py-2 px-3">

                                                    {{ \App\Models\Utility::priceFormat($topRatedProduct->product->price - $topRatedProduct->product->last_price) }}
                                                    {{ __('off') }}
                                                </span>
                                                @endif
                                                @if (Auth::guard('customers')->check())
                                                    @if (!empty($wishlist) && isset($wishlist[$topRatedProduct->product->id]['product_id']))
                                                        @if ($wishlist[$topRatedProduct->product->id]['product_id'] != $topRatedProduct->product->id)
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                                data-id="{{ $topRatedProduct->product->id }}">
                                                                <i class="far fa-heart text-primary"></i>
                                                            </button>
                                                        @else
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100 "
                                                                data-id="{{ $topRatedProduct->product->id }}" disabled>
                                                                <i class="fas fa-heart text-primary"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                            data-id="{{ $topRatedProduct->product->id }}">
                                                            <i class="far fa-heart text-primary"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button"
                                                        class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                        data-id="{{ $topRatedProduct->product->id }}">
                                                        <i class="far fa-heart text-primary"></i>
                                                    </button>
                                                @endif

                                            </div>
                                            <div class="card-image col-8 mx-auto pt-4 pb-4">
                                                <a
                                                    href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}">
                                                    @if (!empty($topRatedProduct->product->is_cover) && \Storage::exists('uploads/is_cover_image/' . $topRatedProduct->product->is_cover))
                                                        <img alt="Image placeholder"
                                                            src="{{ $productImg . $topRatedProduct->product->is_cover }}"
                                                            class="img-center img-fluid">
                                                    @else
                                                        <img alt="Image placeholder"
                                                            src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                            class="img-center img-fluid">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="card-body pt-0 pb-4 px-4 px-md-3 px-lg-4">
                                                <h6 class="mb-0">

                                                    <a class="font-weight-600"
                                                        href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}">
                                                        {{ $topRatedProduct->product->name }}
                                                    </a>
                                                </h6>
                                                <span class="font-weight-600 text-black-50 text-small">
                                                    {{ __('Category:') }}
                                                    {{ $topRatedProduct->product->product_category() }}
                                                </span>
                                                <div class="mb-2">
                                                    <span class="font-weight-600 text-lg text-primary">
                                                        @if ($topRatedProduct->product->enable_product_variant == 'on')
                                                            {{ __('In variant') }}
                                                        @else
                                                            {{ \App\Models\Utility::priceFormat($topRatedProduct->product->price) }}
                                                        @endif
                                                    </span>
                                                    <del class="font-size-12 font-weight-600 text-black-50 ml-2">
                                                        @if ($topRatedProduct->product->enable_product_variant == 'off')
                                                            {{ \App\Models\Utility::priceFormat($topRatedProduct->product->last_price) }}
                                                        @endif
                                                    </del>
                                                </div>
                                                @if ($topRatedProduct->product->enable_product_variant == 'on')
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}"
                                                        class="border-0 btn btn-block btn-primary ">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="border-0 btn btn-block btn-primary  add_to_cart"
                                                        data-id="{{ $topRatedProduct->product->id }}">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                </div>
            </div>

        </div>

    </section>


    <!-- Image with Text -->
    @foreach ($getStoreThemeSetting as $ThemeSetting)
        @if (isset($ThemeSetting['section_name']) &&
            $ThemeSetting['section_name'] == 'Top-Purchased' &&
            $ThemeSetting['section_enable'] == 'on')
            @php
                $homepage_header_img_key = array_search('Background Image', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_img = $ThemeSetting['inner-list'][$homepage_header_img_key]['field_default_text'];

                $homepage_header_title_key = array_search('Title', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_title = $ThemeSetting['inner-list'][$homepage_header_title_key]['field_default_text'];

                $homepage_header_subtext_key = array_search('Sub text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_subtext = $ThemeSetting['inner-list'][$homepage_header_subtext_key]['field_default_text'];

                $homepage_header_btn_key = array_search('Button Text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_btn = $ThemeSetting['inner-list'][$homepage_header_btn_key]['field_default_text'];
            @endphp
            <section class="image-with-text pt-md-4 custom-img-text position-relative">


                @foreach ($mostPurchased as $products_data)
                @php
                    $details = App\Models\Order::productImg($products_data->product_id);
                @endphp
                <div class="col-md-6 pl-0">
                    <a href="{{ route('store.product.product_view', [$store->slug, $products_data->id]) }}">
                        @if (!empty($details->is_cover) && \Storage::exists('uploads/is_cover_image/' . $details->is_cover))
                            <img alt="Image placeholder"
                                src="{{ $productImg. $details->is_cover }}"
                                class=" img-fluid ">
                        @else
                            <img alt="Image placeholder"
                                src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                class=" img-fluid ">
                        @endif
                    </a>
                </div>
                @endforeach
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0 ml-auto">
                            <h4 class="mb-4 text-primary title-size font-weight-300">
                                {{ $homepage_header_title }}
                            </h4>
                            <p class="font-size-12 font-weight-300 mb-4">
                                {{ $homepage_header_subtext }}
                            </p>
                            <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                class="btn btn-primary">
                                {{ $homepage_header_btn }}
                            </a>

                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach


    <!-- Testimonials (v1) -->
    @foreach ($getStoreThemeSetting as $storethemesetting)
        @if (isset($storethemesetting['section_name']) &&
            $storethemesetting['section_name'] == 'Home-Testimonial' &&
            $storethemesetting['array_type'] == 'inner-list' &&
            $storethemesetting['section_enable'] == 'on')
            @php
                $Heading_key = array_search('Heading', array_column($storethemesetting['inner-list'], 'field_name'));
                $Heading = $storethemesetting['inner-list'][$Heading_key]['field_default_text'];

            @endphp
            <section class="slice testimonial-section pb-4 pb-lg-7 pt-md-5">
                <div class="container pt-4">

                    <h2 class="font-weight-300 title-size mb-3">
                        {{ $Heading }}
                    </h2>

                    <div class="testimonial-slider position-relative">
                        <div class="swiper-js-container position-relative">

                            <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                                data-swiper-sm-items="1" data-swiper-md-items="2" data-swiper-xl-items="3">
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
                                                    @if ($storethemesetting['homepage-testimonial-card-enable'][$i] == 'on')
                                                        <div class="swiper-slide p-3">
                                                            <div
                                                                class="border-0 card rounded-0 shadow-none bg-transparent">
                                                                <div class="card-body p-3 border border-primary">
                                                                    <h6 class="text-primary font-weight-300 mb-4">
                                                                        {{ $storethemesetting['homepage-testimonial-card-description'][$i] }}
                                                                    </h6>
                                                                    <div
                                                                        class="d-md-flex justify-content-between align-items-center">
                                                                        <p
                                                                            class="align-items-center d-flex text-black-50 font-size-12 mb-0">
                                                                            <span class="badge-circle badge-md  mr-3">
                                                                                <img alt="Image placeholder"
                                                                                    src="{{ $imgpath . $storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text'] }}"
                                                                                    class="w-100">
                                                                            </span>
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
                                                        <div class="border-0 card rounded-0 shadow-none bg-transparent">
                                                            <div class="card-body p-3 border border-primary">
                                                                <h6 class="text-primary font-weight-300 mb-4">
                                                                    {{ $storethemesetting['inner-list'][3]['field_default_text'] }}
                                                                </h6>
                                                                <div
                                                                    class="d-md-flex justify-content-between align-items-center">
                                                                    <p
                                                                        class="align-items-center d-flex text-black-50 font-size-12 mb-0">
                                                                        <span class="badge-circle badge-md  mr-3">
                                                                            <img alt="Image placeholder"
                                                                                src="{{ $imgpath . (!empty($storethemesetting['inner-list'][1]['field_default_text']) ? $storethemesetting['inner-list'][1]['field_default_text'] : 'avatar.png') }}"
                                                                                class="w-100">
                                                                        </span>
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

                            <!-- Add Arrow -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>

                </div>
            </section>
        @endif
    @endforeach

    {{-- brand logo --}}
    @if ($getStoreThemeSetting[7]['section_enable'] == 'on')
        <div class="insta-section py-5 py-md-6">
            <div class="container">

                <div class="row align-items-center mb-4">
                    <div class="col-md-3">
                        <h2 class="font-weight-300 mb-0 mb-3 text-center text-md-left text-primary title-size"><span
                                class="text-dark d-block"></span>
                            {{ $getStoreThemeSetting[7]['inner-list'][1]['field_default_text'] }}</h2>
                    </div>
                    <div class="col-md-6">
                        <p class="font-size-12">
                            {{ $getStoreThemeSetting[7]['inner-list'][2]['field_default_text'] }}
                        </p>
                    </div>
                </div>



                @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                    @if (isset($storethemesetting['section_name']) &&
                        $storethemesetting['section_name'] == 'Home-Brand-Logo' &&
                        $storethemesetting['section_enable'] == 'on')
                        @foreach ($storethemesetting['inner-list'] as $image)
                            @if ($image['field_slug'] == 'homepage-brand-logo-input')
                                @if (!empty($image['image_path']))
                                    <div class="swiper-js-container position-relative w-100">
                                        <div class="swiper-container" data-swiper-items="1"
                                            data-swiper-space-between="25" data-swiper-items="2" data-swiper-sm-items="4"
                                            data-swiper-lg-items="6">
                                            <div class="swiper-wrapper">
                                                @foreach ($image['image_path'] as $img)
                                                    <div class="insta-item swiper-slide">
                                                        <a href="#"
                                                            class="position-relative d-block rounded-md overflow-hidden">
                                                            <img src="{{ $imgpath . (!empty($img) ? $img : 'theme5/brand_logo/brand_logo.png') }}"
                                                                alt="Footer logo"
                                                                class="img-fluid position-absolute top-0 left-0 w-100 h-100">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- Add Arrow -->
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                @else
                                    <center>
                                        <a href="" class="d-block overflow-hidden position-relative rounded-md">

                                            <img src="{{ $default}}"
                                                alt="Footer logo" class=" img-fluid "
                                                style="max-height: 169px; border-radius: 1.2rem !important;">
                                        </a>
                                    </center>
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </div>
        </div>
    @endif

    {{-- email subs --}}

    @foreach ($getStoreThemeSetting as $storethemesetting)
        @if (isset($storethemesetting['section_name']) &&
            $storethemesetting['section_name'] == 'Home-Email-Subscriber' &&
            $storethemesetting['section_enable'] == 'on')
            @php
                $SubscriberTitle_key = array_search('Subscriber Title', array_column($storethemesetting['inner-list'], 'field_name'));
                $SubscriberTitle = $storethemesetting['inner-list'][$SubscriberTitle_key]['field_default_text'];
            @endphp
            <div class="container">
                <div class="bg-primary p-3 p-md-4 p-lg-5">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-5">
                            <h4 class="font-weight-300 mb-md-0 text-white"><span class="font-weight-500 d-block">
                                    {{ $SubscriberTitle }}
                                </span>
                            </h4>
                        </div>
                        <div class="col-md-5">
                            {{ Form::open(['route' => ['subscriptions.store_email', $store->id], 'method' => 'POST']) }}
                            <div class="d-flex form-group position-relative">

                                {{ Form::email('email', null, ['class' => 'font-size-12 form-control h-100 py-3 rounded-0 border-0 bg-white shadow-none', 'aria-label' => 'Enter your email address...', 'placeholder' => __('Enter Your Email Address...')]) }}
                                <button class="bg-dark border-0 h-100 position-absolute px-3 right-0 rounded-0 top-0"
                                    type="submit">
                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_8_776)">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M0.5 12C0.5 11.4477 0.947715 11 1.5 11L21.0858 11L14.7932 4.7071C14.4026 4.31657 14.4027 3.6834 14.7932 3.29288C15.1837 2.90236 15.8169 2.90238 16.2074 3.29291L24.2071 11.2929C24.5976 11.6834 24.5976 12.3166 24.2071 12.7071L16.2074 20.7071C15.8169 21.0976 15.1837 21.0976 14.7932 20.7071C14.4027 20.3166 14.4026 19.6834 14.7932 19.2929L21.0858 13L1.5 13C0.947715 13 0.5 12.5523 0.5 12Z"
                                                fill="white" />
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            {{ Form::close() }}
                            <p class="font-size-12 text-white mb-0">
                                {{ __('Enter your address and accept the activation link') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@push('script-page')
    <script>
        $("#start_shopping").click(function() {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#shopping_section").offset().top
            }, 2000);
        });
    </script>

    <script>
        $(document).on('change', '.variant-selection', function() {

            var variants = [];

            $(this).each(function(index, element) {

                variants.push(element.value);
            });

            let product_id = $(this).closest(".card-body").find('.product_id').val();
            let variation_price = $(this).closest(".card-product").find('.variation_price');

            if (variants.length > 0) {

                $.ajax({
                    url: '{{ route('get.products.variant.quantity') }}',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        variants: variants.join(' : '),
                        product_id: product_id
                    },
                    success: function(data) {
                        variation_price.html(data.price);
                        $('#variant_id').val(data.variant_id);
                        $('#variant_qty').val(data.quantity);
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.category-options').eq(0).click();
        });

        $('.category-options').on('click', function() {

            var catNames = $(this).html();
            $('.category-dropdown').html(catNames);

            $(this).removeClass('active');
            $(this).addClass('active');

            var catNames_active = $(this).attr('data-active');
            $('.category-tab').removeClass('active');
            $('.category-tab[data-content="' + catNames_active + '"]').addClass('active');

        });
    </script>
@endpush
