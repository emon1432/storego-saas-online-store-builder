@extends('storefront.layout.theme8')

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
    {{-- @DD($getStoreThemeSetting) --}}
    @foreach ($getStoreThemeSetting as $ThemeSetting)
        @if (isset($ThemeSetting['section_name']) &&
            $ThemeSetting['section_name'] == 'Home-Header' &&
            $ThemeSetting['section_enable'] == 'on')
            @php
                $homepage_header_img_key = array_search('Header Image', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_img = $ThemeSetting['inner-list'][$homepage_header_img_key]['field_default_text'];

                $homepage_header_Sub_img_key = array_search('Header Tag', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_Sub_img = $ThemeSetting['inner-list'][$homepage_header_Sub_img_key]['field_default_text'];

                $homepage_header_title_key = array_search('Title', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_title = $ThemeSetting['inner-list'][$homepage_header_title_key]['field_default_text'];

                $homepage_header_subtxt_key = array_search('Sub text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_subtxt = $ThemeSetting['inner-list'][$homepage_header_subtxt_key]['field_default_text'];

                $homepage_header_btn_key = array_search('Button', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_btn = $ThemeSetting['inner-list'][$homepage_header_btn_key]['field_default_text'];
            @endphp

            <div class=" position-relative home-banner">
                <div class="" data-swiper-items="1" data-swiper-space-between="0">
                    <div class="">
                        <section class="pt-md-6 pb-10 py-5 w-100" data-offset-top="#header-main"
                            style="background-image:  url({{ $imgpath . $homepage_header_img }}); background-position: center center; background-size: cover;">
                            <div class="container pb-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-8 col-lg-7">
                                        <img src="{{ $imgpath . $homepage_header_Sub_img }}"
                                            class="col-md-2 col-5 px-0 mb-4">
                                        <h2 class="store-title text-uppercase text-white font-weight-600">
                                            {{ $homepage_header_title }}
                                        </h2>
                                        <p class="col-md-10 mt-4 px-0 store-dcs text-white">
                                            {{ $homepage_header_subtxt }}
                                        </p>
                                        <div>
                                            <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                                class="btn btn-outline-white mt-4">
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
                <div class="swiper-pagination mt-4 d-flex align-items-center justify-content-center"></div>

            </div>
        @endif
    @endforeach

    <!-- promotions -->
    @if ($getStoreThemeSetting[1]['section_enable'] == 'on')
        <div class="quick-services {{$getStoreThemeSetting[0]['section_enable'] == 'off' ? 'mt-8' : ''}}">
            <div class="container">
                <div class="row no-gutters bg-primary mt-n7 position-relative zindex-100">
                    @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                        @if ($storethemesetting['section_name'] == 'Home-Promotions' &&
                            $storethemesetting['array_type'] == 'multi-inner-list')
                            @if (isset($storethemesetting['homepage-promotions-font-icon']) ||
                                isset($storethemesetting['homepage-promotions-title']) ||
                                isset($storethemesetting['homepage-promotions-description']))
                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                    <div class="col-md-4">
                                        <div class="py-md-5 py-4 px-4 service-item">
                                            <span class="d-block mb-3">
                                                {!! $storethemesetting['homepage-promotions-font-icon'][$i] !!}
                                            </span>
                                            <h5 class="font-weight-500 text-white mb-3">
                                                {{ $storethemesetting['homepage-promotions-title'][$i] }}
                                            </h5>
                                            <p class="font-size-12 text-white">
                                                {{ $storethemesetting['homepage-promotions-description'][$i] }}</p>
                                        </div>
                                    </div>
                                @endfor
                            @else
                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                    <div class="col-md-4">
                                        <div class="py-md-5 py-4 px-4 service-item">
                                            <span class="d-block mb-3">
                                                {!! $storethemesetting['inner-list'][0]['field_default_text'] !!}
                                            </span>
                                            <h5 class="font-weight-500 text-white mb-3">
                                                {{ $storethemesetting['inner-list'][1]['field_default_text'] }}</h5>
                                            </h5>
                                            <p class="font-size-12 text-white">
                                                {{ $storethemesetting['inner-list'][2]['field_default_text'] }}</p>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Products -->
    <section class="bestsellers-section mt-md-5 mt-lg-6 pb-0 pb-md-6">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <h3 class="font-weight-500 mb-0 text-primary store-title">{{ __('TOP') }}
                        <b>{{ __('PRODUCTS') }}</b>
                    </h3>
                    <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                        class="btn btn-outline-primary">{{ __('GO TO SHOP') }}</a>
                </div>
            </div>
            @if (count($topRatedProducts) > 0)
                <div class="bestsellers-tabs">
                    <div class="row tab-content remove-d-none">
                        @foreach ($topRatedProducts as $k => $topRatedProduct)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-5 mb-md-0 product-box">
                                <div class="border-0 card-product rounded-0">
                                    <h6 class="text-uppercase border-bottom border-primary pb-2 d-inline-block">
                                        <a
                                            href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}">
                                            {{ $topRatedProduct->product->name }}
                                        </a>
                                    </h6>
                                    <p class="mb-0 font-size-12">
                                        {{ $topRatedProduct->product->product_category() }}
                                    </p>
                                    <div class="card-image col-5 col-md-9 mx-auto pb-2 pt-3">
                                        <a
                                            href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}">
                                            @if (!empty($topRatedProduct->product->is_cover) &&
                                                \Storage::exists('uploads/is_cover_image/' . $topRatedProduct->product->is_cover))
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
                                    <div class="card-body">
                                        @if ($topRatedProduct->product->enable_product_variant == 'on')
                                            <input type="hidden" id="product_id" class="product_id"
                                                value="{{ $topRatedProduct->product->id }}">
                                            <input type="hidden" id="variant_id" value="">
                                            <input type="hidden" id="variant_qty" value="">


                                            @php $json_variant = json_decode($topRatedProduct->product->variants_json); @endphp
                                            @foreach ($json_variant as $key => $json)
                                                @php $variant_name = $json->variant_name; @endphp
                                            @endforeach

                                            <span class="d-block font-size-12 mb-1 text-secondary">
                                                {{ $variant_name }}
                                            </span>

                                            @foreach ($json_variant as $key => $variant)
                                                <div class="dropdown w-100 mb-3">
                                                    <select name="product[{{ $key }}]"
                                                        id="pro_variants_name{{ $key }}"
                                                        class="btn btn-outline-primary d-flex font-size-12 font-weight-400 justify-content-between px-3 rounded-pill w-100 variant-selection  pro_variants_name{{ $key }} ">
                                                        <option value=""> {{ __('Select') }}</option>
                                                        @foreach ($variant->variant_options as $key => $values)
                                                            <option value="{{ $values }}">{{ $values }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span
                                            class="card-price mb-3 text-primary font-weight-500 {{ $topRatedProduct->product->enable_product_variant == 'on' ? 'variation_price' : '' }} ">
                                            @if ($topRatedProduct->product->enable_product_variant == 'on')
                                                {{ __('In variant') }}
                                            @else
                                                {{ \App\Models\Utility::priceFormat($topRatedProduct->product->price) }}
                                            @endif
                                        </span>

                                        @if (Auth::guard('customers')->check())
                                            @if (!empty($wishlist) && isset($wishlist[$topRatedProduct->product->id]['product_id']))
                                                @if ($wishlist[$topRatedProduct->product->id]['product_id'] != $topRatedProduct->product->id)
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button"
                                                        class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                        data-id="{{ $topRatedProduct->product->id }}">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                @else
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button" class="mr-4 bg-transparent border-0 p-0 "
                                                        data-id="{{ $topRatedProduct->product->id }}" disabled>
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button data-toggle="tooltip" data-original-title="Wishlist" type="button"
                                                    class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                    data-id="{{ $topRatedProduct->product->id }}">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                            @endif
                                        @else
                                            <button data-toggle="tooltip" data-original-title="Wishlist" type="button"
                                                class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                data-id="{{ $topRatedProduct->product->id }}">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        @endif
                                    </div>
                                    @if ($topRatedProduct->product->enable_product_variant == 'on')
                                        {{-- <a href="#" type="button"
                                            class="btn btn-primary btn-block rounded-pill add_to_cart" data-flag="1"
                                            data-id="{{ $topRatedProduct->product->id }}">
                                            {{ __('ADD TO CART') }}
                                        </a> --}}
                                        <a href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}" type="button"
                                            class="btn btn-primary btn-block rounded-pill add_to_cart" data-flag="1" data-id="{{ $topRatedProduct->product->id }}">
                                            {{ __('ADD TO CART') }}
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" type="button" data-flag="0"
                                            class="btn btn-primary btn-block rounded-pill add_to_cart"
                                            data-id="{{ $topRatedProduct->product->id }}">
                                            {{ __('ADD TO CART') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

        </div>
        @endif
        </div>

    </section>


    <!-- top purchased-->
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
            <section class="image-with-text py-md-5">
                <div class="container py-5 py-md-0">
                    <div class="row align-items-center">
                        <div class="col-md-8 mb-4 mb-md-0">
                            <img src="{{ $imgpath . $homepage_header_img }}"
                                class="col-md-3 col-4 px-0 mb-4">
                            <h4 class="mb-4 store-title text-primary text-uppercase">
                                <span class="font-weight-600">
                                    {{ $homepage_header_title }}
                                </span>
                            </h4>
                            <p class="font-size-12 col-md-10 col-xl-9 px-0 font-weight-300 mb-4 text-secondary">
                                {{ $homepage_header_subtext }}
                            </p>
                            <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                class="btn btn-outline-primary">
                                {{ $homepage_header_btn }}
                            </a>
                        </div>

                        @foreach ($mostPurchased as $products_data)
                            @php
                                $details = App\Models\Order::productImg($products_data->product_id);
                            @endphp
                            <div class="col-md-4 col-sm-7 mx-auto" data-id="{{ $products_data->id }}">
                                {{-- <img src="assets/img/img01.jpg" class="img-fluid"> --}}

                                <a href="{{ route('store.product.product_view', [$store->slug, $products_data->id]) }}">
                                    @if (!empty($details->is_cover) && \Storage::exists('uploads/is_cover_image/' . $details->is_cover))
                                        <img alt="Image placeholder"
                                            src="{{ $productImg . $details->is_cover }}"
                                            class="img-center img-fluid top-purchased">
                                    @else
                                        <img alt="Image placeholder"
                                            src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                            class="img-center img-fluid top-purchased">
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach




    <!-- Image with Text -->.
    @foreach ($getStoreThemeSetting as $ThemeSetting)
        @if (isset($ThemeSetting['section_name']) &&
            $ThemeSetting['section_name'] == 'Product-Section-Header' &&
            $ThemeSetting['section_enable'] == 'on')
            @php
                $homepage_header_img_key = array_search('Product Header Image', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_img = $ThemeSetting['inner-list'][$homepage_header_img_key]['field_default_text'];

                $homepage_header_tagImg_key = array_search('Product Header Tag', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_tagImg = $ThemeSetting['inner-list'][$homepage_header_tagImg_key]['field_default_text'];

                $homepage_header_title_key = array_search('Title', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_title = $ThemeSetting['inner-list'][$homepage_header_title_key]['field_default_text'];

                $homepage_header_subTxt_key = array_search('Sub text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_subTxt = $ThemeSetting['inner-list'][$homepage_header_subTxt_key]['field_default_text'];

                $homepage_header_btn_key = array_search('Button', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_btn = $ThemeSetting['inner-list'][$homepage_header_btn_key]['field_default_text'];
            @endphp
            <section class="image-with-text bg-primary">
                <div class="container py-5 py-md-0">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0 pt-md-4 pt-lg-6">
                            <img src="{{ $imgpath . $homepage_header_tagImg }}"
                                class="col-md-3 col-4 px-0 mb-4">
                            <h4 class="mb-4 store-title text-white text-uppercase">
                                <span class="font-weight-600">
                                    {{ $homepage_header_title }}
                                </span>
                            </h4>
                            <p class="font-size-12 col-md-10 col-xl-9 px-0 font-weight-300 mb-4 text-white">
                                {{ $homepage_header_subTxt }}</p>
                            <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                class="btn btn-outline-white">
                                {{ $homepage_header_btn }}
                            </a>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ $imgpath . $homepage_header_img }}"
                                class="img-fluid mt--200">
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    <!-- Products -->
    <section class="bestsellers-section bg-primary mt-0 pt-4 pt-md-7">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 d-flex align-items-center justify-content-between ">
                    <ul class="tabs " role="tablist" id="myTab">


                        @foreach ($categories as $key => $category)
                            <li class="">
                                <a href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" data-id="{{ $key }}"
                                    class="{{ $key == 0 ? 'active' : '' }} productTab bg-primary" id="electronic-tab"
                                    data-toggle="tab" role="tab" aria-controls="home" aria-selected="false">
                                    {{ __($category) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="show-more-link ">
                        <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                            class="btn btn-outline-white">{{ __('GO TO SHOP') }}</a>
                    </div>
                </div>
            </div>

            <div class="bestsellers-tabs">
                {{-- @dd($products) --}}


                @foreach ($products as $key => $items)
                    <div class="col-lg-12 px-0 tab-content row {{ $key == 'Start shopping' ? 'active ' : '' }} "
                        id="{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $key) !!}" role="tabpanel" aria-labelledby="shopping-tab">

                        @foreach ($items as $key => $product)
                            @if ($key < 4)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-5 mb-md-0 product-box">
                                    <div class="border-0 card-product rounded-0">
                                        <h6 class="text-uppercase border-bottom border-white pb-2 d-inline-block ">
                                            <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                class="text-white">
                                                {{ $product->name }}
                                            </a>
                                        </h6>
                                        <p class="mb-0 font-size-12 text-white">
                                            {{ $product->product_category() }}
                                        </p>
                                        <div class="card-image col-5 col-md-9 mx-auto pb-2 pt-3">
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
                                        <div class="card-body">
                                            @if ($product->enable_product_variant == 'on')
                                                <input type="hidden" id="product_id" value="{{ $product->id }}" class="product_id">
                                                <input type="hidden" id="variant_id" value="">
                                                <input type="hidden" id="variant_qty" value="">


                                                @php $json_variant = json_decode($product->variants_json); @endphp
                                                @foreach ($json_variant as $key => $json)
                                                    @php $variant_name = $json->variant_name; @endphp
                                                @endforeach

                                                <span class="d-block font-size-12 mb-1 text-white">
                                                    {{ $variant_name }} :
                                                </span>


                                                @foreach ($json_variant as $key => $variant)
                                                    <div class="dropdown w-100 mb-3">
                                                        <select name="product[{{ $key }}]"
                                                            id="pro_variants_name{{ $key }}"
                                                            class="btn btn-outline-white d-flex font-size-12 font-weight-400 justify-content-between px-3 rounded-pill w-100 variant-selection  pro_variants_name{{ $key }}">
                                                            <option value=""> {{ __('Select') }}</option>
                                                            @foreach ($variant->variant_options as $key => $values)
                                                                <option value="{{ $values }}">{{ $values }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            {{--   --}}
                                            <span
                                                class="card-price mb-3 text-white font-weight-500 {{ $product->enable_product_variant == 'on' ? 'variation_price' : '' }}">
                                                @if ($product->enable_product_variant == 'on')
                                                    {{ __('In variant') }}
                                                @else
                                                    {{ \App\Models\Utility::priceFormat($product->price) }}
                                                @endif
                                            </span>

                                            @if (Auth::guard('customers')->check())
                                                @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                    @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                            data-id="{{ $product->id }}">
                                                            <i class="far fa-heart text-white"></i>
                                                        </button>
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button" class="mr-4 bg-transparent border-0 p-0 "
                                                            data-id="{{ $product->id }}" disabled>
                                                            <i class="fas fa-heart text-white"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button"
                                                        class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                        data-id="{{ $product->id }}">
                                                        <i class="far fa-heart text-white"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button data-toggle="tooltip" data-original-title="Wishlist"
                                                    type="button"
                                                    class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                    data-id="{{ $product->id }}">
                                                    <i class="far fa-heart text-white"></i>
                                                </button>
                                            @endif
                                        </div>
                                        @if ($product->enable_product_variant == 'on')
                                            {{-- <a href="#" type="button"
                                                class="btn btn-white btn-block rounded-pill add_to_cart" data-flag="1"
                                                data-id="{{ $product->id }}">
                                                {{ __('ADD TO CART') }}
                                            </a> --}}
                                            <a href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}" type="button"
                                                class="btn btn-white btn-block rounded-pill add_to_cart" data-flag="1" data-id="{{ $topRatedProduct->product->id }}">
                                                {{ __('ADD TO CART') }}
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" type="button" data-flag="0"
                                                class="btn btn-white btn-block rounded-pill add_to_cart"
                                                data-id="{{ $product->id }}">
                                                {{ __('ADD TO CART') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </section>
{{-- latest product --}}
    @foreach ($getStoreThemeSetting as $ThemeSetting)
        @if (isset($ThemeSetting['section_name']) &&
            $ThemeSetting['section_name'] == 'Latest Product' &&
            $ThemeSetting['section_enable'] == 'on')
            @php

                $homepage_header_tagImg_key = array_search('Tag Image', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_tagImg = $ThemeSetting['inner-list'][$homepage_header_tagImg_key]['field_default_text'];

                $homepage_header_title_key = array_search('Title', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_title = $ThemeSetting['inner-list'][$homepage_header_title_key]['field_default_text'];

                $homepage_header_subTxt_key = array_search('Sub text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_subTxt = $ThemeSetting['inner-list'][$homepage_header_subTxt_key]['field_default_text'];

            @endphp
            <section class="featured-product mt-5">
                <div class="container">
                    <div class="align-items-center no-gutters row">
                        <div class="bg-primary col-md-10 content p-4 p-lg-5">
                            <img src="{{ $imgpath . $homepage_header_tagImg }}"
                                class="col-md-2 col-sm-5 mb-4 px-0">
                            <h2 class="store-title text-white">

                                <span class="font-weight-600">
                                    {{ $homepage_header_title }}
                                </span>
                            </h2>
                            <div class="row">
                                <div class="col-lg-8 col-md-10">
                                    <div class="row">
                                        <div class="col-md-5 col-lg-6">
                                            <p class="font-size-12 text-white">{{ $homepage_header_subTxt }}</p>
                                        </div>
                                        @if(!empty($latestProduct))
                                        <div class="col-md-7 col-lg-6">
                                            <div class="d-flex justify-content-between align-items-end">
                                                <h2 class="card-price mb-0 text-white font-weight-500 ">
                                                {{$latestProduct->name}}

                                                </h2>
                                                <h4 class="card-price mb-0 text-white font-weight-500 ">

                                                        {{ \App\Models\Utility::priceFormat($latestProduct->price) }}

                                                </h4>

                                            </div>
                                            {{-- <a href="#" class="btn btn-white rounded-pill btn-block mt-4">
                                                {{__('ADD TO CART')}}
                                            </a> --}}
                                            <a href="javascript:void(0)" type="button" data-flag="0"
                                            class="btn btn-white rounded-pill btn-block mt-4 add_to_cart"
                                            data-id="{{ $latestProduct->id }}" data-flag="0">
                                            {{ __('ADD TO CART') }}
                                        </a>

                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!empty($latestProduct))
                        <div class="col-md-3 d-md-block d-none item-image ml-lg-n9 ml-md-n7 px-3">

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
                        @endif
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    <!-- Testimonials (v1) -->
    <section class="slice testimonial-section pb-md-7 pt-3">
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
                        <h2 class=" text-center text-primary text-uppercase mb-3">
                            {{ !empty($Heading) ? $Heading : 'Testimonials' }}
                        </h2>
                    </div>
                    <div class="fluid-paragraph mt-3 text-center">
                        <p class="lead lh-180 store-dcs">
                            {{ !empty($HeadingSubText)
                                ? $HeadingSubText
                                : 'There is only that moment and the incredible certainty that <br> everything under the sun has been written by one hand only.' }}
                        </p>
                    </div>

                    <div class="testimonial-slider position-relative">
                        <div class="swiper-js-container position-relative">

                            <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                                data-swiper-sm-items="2" data-swiper-xl-items="3">
                                <div class="swiper-wrapper">

                                    @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                                        @if (isset($storethemesetting['section_name']) &&
                                            $storethemesetting['section_name'] == 'Home-Testimonial' &&
                                            $storethemesetting['array_type'] == 'multi-inner-list')
                                            {{-- @DD($storethemesetting) --}}
                                            @if (isset($storethemesetting['homepage-testimonial-card-image']) ||
                                                isset($storethemesetting['homepage-testimonial-card-title']) ||
                                                isset($storethemesetting['homepage-testimonial-card-sub-text']) ||
                                                isset($storethemesetting['homepage-testimonial-card-description']) ||
                                                isset($storethemesetting['homepage-testimonial-card-enable']))
                                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                                @if($storethemesetting['homepage-testimonial-card-enable'][$i] == 'on')
                                                    <div class="swiper-slide p-3">
                                                        <div
                                                            class="border-primary card rounded-0 shadow-none text-center bg-transparent">
                                                            <div class="card-body p-3">
                                                                <span class="static-rating static-rating-sm d-block mb-2">

                                                                </span>
                                                                <div class="message">
                                                                    <h4 class="text-primary">
                                                                        {{ $storethemesetting['homepage-testimonial-card-title'][$i] }}!
                                                                    </h4>
                                                                    <p class="font-size-12 text-primary">
                                                                        {{ $storethemesetting['homepage-testimonial-card-description'][$i] }}
                                                                    </p>
                                                                    <p
                                                                        class="align-items-center d-flex justify-content-center text-primary font-size-12 mb-0">
                                                                        <span
                                                                            class="badge-circle badge-md badge-primary mr-3">
                                                                            <img alt="Image placeholder"
                                                                                src="{{ $imgpath . $storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text'] }}">
                                                                        </span>
                                                                        <span class="font-weight-600">
                                                                            {{ $storethemesetting['homepage-testimonial-card-sub-text'][$i] }}
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
                                                            class="border-primary card rounded-0 shadow-none text-center bg-transparent">
                                                            <div class="card-body p-3">
                                                                <span class="static-rating static-rating-sm d-block mb-2">
                                                                    <p class="font-size-12">

                                                                    </p>
                                                                </span>
                                                                <div class="message">
                                                                    <h4 class="text-primary">
                                                                        {{ $storethemesetting['inner-list'][2]['field_default_text'] }}!
                                                                    </h4>
                                                                    <p class="font-size-12 text-primary">
                                                                        {{ $storethemesetting['inner-list'][3]['field_default_text'] }}
                                                                    </p>
                                                                    <p
                                                                        class="align-items-center d-flex justify-content-center text-primary font-size-12 mb-0">
                                                                        <span
                                                                            class="badge-circle badge-md badge-primary mr-3">
                                                                            <img src="{{ $imgpath . $storethemesetting['inner-list'][1]['field_default_text'] }}"
                                                                                alt="">
                                                                        </span>
                                                                        <span class="font-weight-600">
                                                                            {{ $storethemesetting['inner-list'][4]['field_default_text'] }}
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
                @endif
            @endforeach
        </div>
    </section>

    @foreach ($getStoreThemeSetting as $storethemesetting)
        @if (isset($storethemesetting['section_name']) &&
            $storethemesetting['section_name'] == 'Home-Email-Subscriber' &&
            $storethemesetting['section_enable'] == 'on')
            @php
                $SubscriberTitle_key = array_search('Subscriber Title', array_column($storethemesetting['inner-list'], 'field_name'));
                $SubscriberTitle = $storethemesetting['inner-list'][$SubscriberTitle_key]['field_default_text'];

                $SubscriberTitle_btn_key = array_search('Button', array_column($storethemesetting['inner-list'], 'field_name'));
                $SubscriberTitle_btn = $storethemesetting['inner-list'][$SubscriberTitle_btn_key]['field_default_text'];
            @endphp
            <div class="insta-section pb-4">
                <div class="container">

                    <div class="row align-items-center">
                        <div class="align-items-center col-md-7 d-md-flex mb-4 mb-md-0 pr-md-6 text-center text-md-left">

                            <h2 class="store-title text-primary mb-0 ml-4">

                                {{ $SubscriberTitle }}
                            </h2>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                {{ Form::open(['route' => ['subscriptions.store_email', $store->id], 'method' => 'POST']) }}

                                <div class="d-flex col-6 align-middle">

                                    {{ Form::email('email', null, ['class' => 'font-size-12 h-100 py-3 rounded-0 border-0 bg-white shadow-none', 'aria-label' => 'Enter your email address', 'placeholder' => __('Enter Your Email Address')]) }}
                                    <button type="submit"
                                        class="btn btn-primary px-5 rounded-0">{{ $SubscriberTitle_btn }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    @endforeach

    {{-- <!-- Articles -->Categories --}}
    @if ($getStoreThemeSetting[6]['section_enable'] == 'on')
    <section class="slice categorie-section pt-5 pb-4 position-relative">
        <div class="container">
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
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <div class="mb-5 text-center">
                                    <h2 class="my-3 text-primary text-uppercase font-weight-600">{{ $Title }}</h2>
                                    <p class="font-size-12">
                                        {{ $Description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            <div class="justify-content-center">
                <div class="swiper-js-container position-relative">
                    <div class="swiper-container px-3" data-swiper-items="1" data-swiper-space-between="20"
                        data-swiper-sm-items="2" data-swiper-xl-items="3">
                        <div class="swiper-wrapper">
                            @foreach ($pro_categories as $key => $pro_categorie)
                            <div class="swiper-slide categories-box">
                                <div class="bg-body border-primary card mb-0 overflow-hidden rounded-0">
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
                                    <div class="card-body p-4">

                                        <h4 class="text-primary">{{ $pro_categorie->name }}</h4>

                                        <a href="{{ route('store.categorie.product', [$store->slug, $pro_categorie->name]) }}" class="btn btn-primary btn-block">{{__('SHOW MORE')}}</a>
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
        </div>
    </section>
    @endif

@endsection

@push('script-page')
    <script>
        $(document).ready(function() {
            $("#myTab li:eq(0)").addClass('active');
        });
        // Tab js
        $('ul.tabs li').click(function() {
            // alert('hello')
            var $this = $(this);
            var $theTab = $(this).attr('data-tab');

            if ($this.hasClass('active')) {} else {
                $this.closest('.tabs-wrapper').find('ul.tabs li, .tabs-container .tab-content').removeClass('active');
                $('.tabs-container .tab-content[id="' + $theTab + '"], ul.tabs li[data-tab="' + $theTab + ']')
                    .addClass('active');
            }
            $('ul.tabs li').removeClass('active');

            $(this).addClass('active');

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
    <script>
        $(document).on('change', '.variant-selection', function() {

            var variants = [];
            let selected1 = $(this).parent().parent().find('.variant-selection');

            $(selected1).each(function(index, element) {

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
@endpush
