@extends('storefront.layout.theme5')

@section('page-title')
    {{ __('Home') }}
@endsection

@push('css-page')
    <style>
        .product-box .product-price {
            justify-content: unset;
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

    {{-- HEADER IMG --}}
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

            @endphp

            <section class="contain-product container mt-7">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="banner-contain">
                            <h1>
                                {{ !empty($homepage_header_title) ? $homepage_header_title : 'Home Accessories' }}
                            </h1>
                            <p>
                                {{ !empty($homepage_header_Sub_text) ? $homepage_header_Sub_text : 'There is only that moment and the incredible certainty that everything under the sun has been written by one hand only.' }}
                            </p>
                            <a href="#"
                                class="btn btn-sm btn-primary btn-icon shadow hover-shadow-lg hover-translate-y-n3"
                                id="pro_scroll">
                                <span class="btn-inner--text">
                                    {{ !empty($homepage_header_Button) ? $homepage_header_Button : __('Start shopping') }}
                                </span>
                                <span class="btn-inner--icon">
                                    <i class="fas fa-shopping-basket"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-product">

                            <img width="350" height="433"
                                src="{{ $imgpath. $homepage_header_Bckground_Image }}"
                                alt="image" />

                        </div>
                    </div>
                    @if ($theme3_product != null)
                        <div class="col-lg-4 col-md-6">
                            <div class="product-box">
                                <div class="card card-product">
                                    <div class="box-rate">
                                        <div class="static-rating static-rating-sm">
                                            @if ($store->enable_rating == 'on')
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @php
                                                        $icon = 'fa-star';
                                                        $color = '';
                                                        $newVal1 = $i - 0.5;
                                                        if ($theme3_product->product_rating() < $i && $theme3_product->product_rating() >= $newVal1) {
                                                            $icon = 'fa-star-half-alt';
                                                        }
                                                        if ($theme3_product->product_rating() >= $newVal1) {
                                                            $color = 'text-primary';
                                                        }
                                                    @endphp
                                                    <i class="star fas {{ $icon . ' ' . $color }}"></i>
                                                @endfor
                                            @endif
                                        </div>
                                        <div class="card-product-actions">
                                            @if (Auth::guard('customers')->check())
                                                @if ($theme3_product['enable_product_variant'] != 'on')
                                                    @if (!empty($wishlist) && isset($wishlist[$theme3_product->id]['product_id']))
                                                        @if ($wishlist[$theme3_product->id]['product_id'] != $theme3_product->id)
                                                            <button type="button"
                                                                class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $theme3_product->id }}"
                                                                data-id="{{ $theme3_product->id }}">
                                                                <i class="far fa-heart"></i>
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="action-item wishlist-icon bg-light-gray"
                                                                data-id="{{ $theme3_product->id }}" disabled>
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button type="button"
                                                            class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $theme3_product->id }}"
                                                            data-id="{{ $theme3_product->id }}">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                            @else
                                                <button type="button"
                                                    class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $theme3_product->id }}"
                                                    data-id="{{ $theme3_product->id }}">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-image">
                                        <a
                                            href="{{ route('store.product.product_view', [$store->slug, $theme3_product->id]) }}">
                                            @if ($theme3_product_image->count() > 0 &&
                                                \Storage::exists('uploads/product_image/' . $theme3_product_image[0]['product_images']))
                                                <img class="img-center img-fluid" width="135" height="167"
                                                    src="{{ $catimg . $theme3_product_image[0]['product_images'] }}"
                                                    alt="New collection" title="New collection">
                                            @else
                                                <img class="img-center img-fluid" width="135" height="167"
                                                    src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}"
                                                    alt="New collection" title="New collection">
                                            @endif
                                        </a>

                                    </div>
                                    <div class="card-body pt-0">
                                        <h6><a href="{{ route('store.product.product_view', [$store->slug, $theme3_product->id]) }}"
                                                class="t-black13">{{ $theme3_product->name }}</a></h6>
                                        @if ($theme3_product['enable_product_variant'] != 'on')
                                            <div class="product-price mt-3">
                                                <span
                                                    class="card-price t-black15 mb-2">{{ \App\Models\Utility::priceFormat($theme3_product->price) }}</span>
                                            </div>
                                            <div class="p-button">
                                                <button type="button" class="action-item pcart-icon bg-primary">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </button>
                                                <a href="#" class="btn btn-sm btn-white btn-icon add_to_cart"
                                                    data-id="{{ $theme3_product['id'] }}">
                                                    <span class="btn-inner--text text-primary">
                                                        {{ __('Add to cart') }}
                                                    </span>
                                                    <span class="btn-inner--icon">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        @else
                                            <div class="product-price mt-3">
                                                <span class="card-price t-black15 mb-2">{{ __('In Variant') }}</span>
                                            </div>
                                            <div class="p-button">
                                                <button type="button" class="action-item pcart-icon bg-primary">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </button>
                                                <a href="{{ route('store.product.product_view', [$store->slug, $theme3_product['id']]) }}"
                                                    class="btn btn-sm btn-white btn-icon">
                                                    <span class="btn-inner--text text-primary">
                                                        {{ __('Add to cart') }}
                                                    </span>
                                                    <span class="btn-inner--icon">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif
    @endforeach

    {{-- BRAND LOGO --}}
    <div class="client-logo">
        <div class="container">
            <div class="row">
                @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                    @if (isset($storethemesetting['section_name']) &&
                        $storethemesetting['section_name'] == 'Home-Brand-Logo' &&
                        $storethemesetting['section_enable'] == 'on')
                        @foreach ($storethemesetting['inner-list'] as $image)
                            @if (!empty($image['image_path']))
                                @foreach ($image['image_path'] as $img)
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                        <a href="#">
                                            <img src="{{ $imgpath . (!empty($img) ? $img : 'theme5/brand_logo/brand_logo.png') }}"
                                                alt="Brand logo">
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{ $default }}"
                                            alt="Footer logo">
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{ $default }}"
                                            alt="Footer logo">

                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{ $default }}"
                                            alt="Footer logo">
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{ $default }}"
                                            alt="Footer logo">

                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{ $default }}"
                                            alt="Footer logo">
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{ $default }}"
                                            alt="Footer logo">
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </div>
        </div>
    </div>

    <!-- Products categories-->
    @if (isset($storethemesetting['enable_categories']) &&
        $storethemesetting['enable_categories'] == 'on' &&
        !empty($pro_categories))
        <section class="electronic-access-section">
            <div class="container">
                <div class="row">
                    @foreach ($pro_categories as $key => $pro_categorie)
                        @if ($product_count[$key] > 0)
                            <div class="col-lg-6 mt-2">
                                <div class="small-product small_product_custom">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            @if (!empty($pro_categorie->categorie_img) &&
                                                \Storage::exists('uploads/product_image/' . $pro_categorie->categorie_img))
                                                <img width="178" height="209"
                                                    src="{{ $catimg . $pro_categorie->categorie_img }}"
                                                    class="small-img" alt="image" />
                                            @else
                                                <img width="178" height="209"
                                                    src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}"
                                                    class="small-img" alt="image" />
                                            @endif
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="small-pro-detail">
                                                <h2>{{ $pro_categorie->name }}</h2>
                                                <p>{{ __('Products') }}:
                                                    {{ !empty($product_count[$key]) ? $product_count[$key] : '0' }}</p>
                                                <a href="{{ route('store.categorie.product', [$store->slug, $pro_categorie->name]) }}"
                                                    class="btn btn-sm btn-primary btn-icon shadow hover-shadow-lg hover-translate-y-n3">
                                                    <span class="btn-inner--text">{{ __('Start shopping') }}</span>
                                                    <span class="btn-inner--icon">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Start shopping --}}
    @if ($products['Start shopping']->count() > 0)
        <section class="bestsellers-section" id="pro_items">
            <div class="container">
                <div class="row">
                    <div class="pr-title mb-4">
                        <div class="">
                            <h3 class="mt-4 store-title text-primary">{{ __('Products') }}</h3>
                            <div class="p-tablist">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach ($categories as $key => $category)
                                        <li class="nav-item">
                                            <a href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" data-id="{{ $key }}"
                                                class="nav-link  {{ $category == 'Start shopping' ? 'active' : '' }} productTab"
                                                id="electronic-tab" data-toggle="tab" role="tab"
                                                aria-controls="home" aria-selected="false">
                                                {{ __($category) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                class="btn btn-sm btn-primary btn-icon shadow hover-shadow-lg hover-translate-y-n3">
                                <span class="btn-inner--text">{{ __('Start shopping') }}</span>
                                <span class="btn-inner--icon">
                                    <i class="fas fa-shopping-basket"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="tab-content bestsellers-tabs" id="myTabContent">
                        @foreach ($products as $key => $items)
                            <div class="tab-pane fade {{ $key == 'Start shopping' ? 'active show' : '' }}"
                                id="{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $key) !!}" role="tabpanel" aria-labelledby="shopping-tab">
                                <div class="col-lg-12">
                                    <div class="row">
                                        @if ($items->count() > 0)
                                            @foreach ($items as $product)
                                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                                    <div class="product-box">
                                                        <div class="card card-product card-fluid">
                                                            <div class="box-rate">
                                                                <div class="static-rating static-rating-sm">
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
                                                                                    $color = 'text-primary';
                                                                                }
                                                                            @endphp
                                                                            <i
                                                                                class="star fas {{ $icon . ' ' . $color }}"></i>
                                                                        @endfor
                                                                    @endif
                                                                </div>
                                                                <div class="card-product-actions">
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
                                                                                    data-id="{{ $product->id }}"
                                                                                    disabled>
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
                                                            <div class="card-image py-3">
                                                                <a
                                                                    href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                                    @if (!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/' . $product->is_cover))
                                                                        <img class="img-center img-fluid"
                                                                            style="width:135px; height:167px"
                                                                            src="{{ $productImg . $product->is_cover }}"
                                                                            alt="New collection" title="New collection">
                                                                    @else
                                                                        <img class="img-center img-fluid"
                                                                            style="width:135px; height:167px"
                                                                            src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                                            alt="New collection" title="New collection">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <h6><a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                                        class="t-black13">{{ $product->name }}</a></h6>
                                                                @if ($product['enable_product_variant'] != 'on')
                                                                    <div class="product-price mt-3">
                                                                        <span
                                                                            class="card-price t-black15 mb-2">{{ \App\Models\Utility::priceFormat($product->price) }}</span>
                                                                    </div>
                                                                    <div class="p-button">
                                                                        <button type="button"
                                                                            class="action-item pcart-icon bg-primary">
                                                                            <i class="fas fa-shopping-basket"></i>
                                                                        </button>
                                                                        <a href="#"
                                                                            class="btn btn-sm btn-white btn-icon add_to_cart"
                                                                            data-id="{{ $product['id'] }}">
                                                                            <span class="btn-inner--text text-primary">
                                                                                {{ __('Add to cart') }}
                                                                            </span>
                                                                            <span class="btn-inner--icon">
                                                                                <i class="fas fa-shopping-basket"></i>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div class="product-price mt-3">
                                                                        <span
                                                                            class="card-price t-black15 mb-2">{{ __('In Variant') }}</span>
                                                                    </div>
                                                                    <div class="p-button">
                                                                        <button type="button"
                                                                            class="action-item pcart-icon bg-primary">
                                                                            <i class="fas fa-shopping-basket"></i>
                                                                        </button>
                                                                        <a href="{{ route('store.product.product_view', [$store->slug, $product['id']]) }}"
                                                                            class="btn btn-sm btn-white btn-icon">
                                                                            <span class="btn-inner--text text-primary">
                                                                                {{ __('Add to cart') }}
                                                                            </span>
                                                                            <span class="btn-inner--icon">
                                                                                <i class="fas fa-shopping-basket"></i>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
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
    @else
        <div class="container mt-10 mb-5">
            {{ __('No data found') }}
        </div>
    @endif

    {{-- EMAIL SUBSCRIPTION --}}

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

            <section class="alwase-on-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-lg-12 col-xl-7 text-center">
                            <div class="mb-5">
                                <h1 class="store-title text-primary">
                                    {{ !empty($SubscriberTitle) ? $SubscriberTitle : 'Always on time' }}</h1>
                                <p class="lead mt-2 store-dcs">
                                    {{ !empty($SubscriberDescription) ? $SubscriberDescription : 'Subscription here' }}</p>
                            </div>
                            {{ Form::open(['route' => ['subscriptions.store_email', $store->id], 'method' => 'POST']) }}
                            <div class="form-group form-subscribe">
                                <div class="input-group input-group-lg input-group-merge">
                                    {{ Form::email('email', null, ['class' => 'form-control form-control-flush', 'aria-label' => 'Enter your email address', 'placeholder' => __('Enter Your Email Address')]) }}
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary btn-icon scroll-me">
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

    <!-- Top Rated Products -->
    @if (count($topRatedProducts) > 0)
        <section class="top-product mt-5">
            <div class="container">
                <div class="row">
                    <div class="pr-title">
                        <h3 class=" mt-4 store-title text-primary">{{ __('Top rated products') }}</h3>
                        <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                            class="btn btn-sm btn-primary rounded-pill btn-icon">
                            <span class="btn-inner--text">{{ __('Show more products') }}</span>
                            <span class="btn-inner--icon">
                                <i class="fas fa-shopping-basket"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($topRatedProducts as $k => $topRatedProduct)
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="product-box">
                                <div class="card card-product">

                                    <div class="box-rate">
                                        <div class="static-rating static-rating-sm">
                                            @if ($store->enable_rating == 'on')
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @php
                                                        $icon = 'fa-star';
                                                        $color = '';
                                                        $newVal1 = $i - 0.5;
                                                        if ($topRatedProduct->product->product_rating() < $i && $topRatedProduct->product->product_rating() >= $newVal1) {
                                                            $icon = 'fa-star-half-alt';
                                                        }
                                                        if ($topRatedProduct->product->product_rating() >= $newVal1) {
                                                            $color = 'text-primary';
                                                        }
                                                    @endphp
                                                    <i class="star fas {{ $icon . ' ' . $color }}"></i>
                                                @endfor
                                            @endif
                                        </div>
                                        <div class="card-product-actions">
                                            @if (Auth::guard('customers')->check())
                                                @if (!empty($wishlist) && isset($wishlist[$topRatedProduct->product->id]['product_id']))
                                                    @if ($wishlist[$topRatedProduct->product->id]['product_id'] != $topRatedProduct->product->id)
                                                        <button type="button"
                                                            class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                            data-id="{{ $topRatedProduct->product->id }}">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                    @else
                                                        <button type="button"
                                                            class="action-item wishlist-icon bg-light-gray"
                                                            data-id="{{ $topRatedProduct->product->id }}" disabled>
                                                            <i class="fas fa-heart"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button type="button"
                                                        class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                        data-id="{{ $topRatedProduct->product->id }}">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button type="button"
                                                    class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                    data-id="{{ $topRatedProduct->product->id }}">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-image py-3">
                                        <a
                                            href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}">
                                            @if (!empty($pro_categorie->categorie_img) &&
                                                \Storage::exists('uploads/is_cover_image/' . $topRatedProduct->product->is_cover))
                                                <img class="img-center img-fluid" style="width:135px; height:167px"
                                                    src="{{ $productImg . $topRatedProduct->product->is_cover }}"
                                                    alt="New collection" title="New collection">
                                            @else
                                                <img class="img-center img-fluid" style="width:135px; height:167px"
                                                    src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                    alt="New collection" title="New collection">
                                            @endif

                                        </a>
                                    </div>
                                    <div class="card-body pt-0">
                                        <h6><a href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}"
                                                class="t-black13">{{ $topRatedProduct->product->name }}</a></h6>
                                        @if ($topRatedProduct->product->enable_product_variant != 'on')
                                            <div class="product-price mt-3">
                                                <span
                                                    class="card-price t-black15 mb-2">{{ \App\Models\Utility::priceFormat($topRatedProduct->product->price) }}</span>
                                            </div>
                                            <div class="p-button">
                                                <button type="button" class="action-item pcart-icon bg-primary">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </button>
                                                <a href="#" class="btn btn-sm btn-white btn-icon add_to_cart"
                                                    data-id="{{ $topRatedProduct->product->id }}">
                                                    <span class="btn-inner--text text-primary">
                                                        {{ __('Add to cart') }}
                                                    </span>
                                                    <span class="btn-inner--icon">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        @else
                                            <div class="product-price mt-3">
                                                <span class="card-price t-black15 mb-2">{{ __('In Variant') }}</span>
                                            </div>
                                            <div class="p-button">
                                                <button type="button" class="action-item pcart-icon bg-primary">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </button>
                                                <a href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}"
                                                    class="btn btn-sm btn-white btn-icon">
                                                    <span class="btn-inner--text text-primary">
                                                        {{ __('Add to cart') }}
                                                    </span>
                                                    <span class="btn-inner--icon">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Testimonials (v1) -->
    @foreach ($getStoreThemeSetting as $storethemesetting)
    {{-- @DD($storethemesetting['section_name'] == 'Home-Testimonial') --}}
    @if (isset($storethemesetting['section_name']) &&
        $storethemesetting['section_name'] == 'Home-Testimonial' &&
        $storethemesetting['array_type'] == 'inner-list' &&
        $storethemesetting['section_enable'] == 'on')
    <section class="slice testimonial-section ">
        <div class="container-fulid">
            <div class="row testimonial-slider">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="mb-5">

                                @php
                                    $Heading_key = array_search('Heading', array_column($storethemesetting['inner-list'], 'field_name'));
                                    $Heading = $storethemesetting['inner-list'][$Heading_key]['field_default_text'];

                                    $HeadingSubText_key = array_search('Heading Sub Text', array_column($storethemesetting['inner-list'], 'field_name'));
                                    $HeadingSubText = $storethemesetting['inner-list'][$HeadingSubText_key]['field_default_text'];
                                @endphp
                                <h3 class=" mt-4 store-title text-primary">
                                    {{ !empty($Heading) ? $Heading : 'Testimonials' }}</h3>
                                <div class="mt-3">
                                    <p class="lead lh-180 store-dcs">
                                        {{ !empty($HeadingSubText)
                                            ? $HeadingSubText
                                            : 'There is only that moment and the incredible certainty that <br> everything
                                                                                                                                                                                                                                                                                                                                                                                    under the sun has been written by one hand only.' }}
                                    </p>
                                </div>

                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="swiper-js-container overflow-hidden">
                        <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                            data-swiper-sm-items="2" data-swiper-xl-items="2">
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
                                                            <p class="t-dcs t-gray">
                                                                {{ $storethemesetting['homepage-testimonial-card-description'][$i] }}
                                                            </p>
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <img alt="Image placeholder"
                                                                        src="{{ $imgpath. $storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text'] }}"
                                                                        class="avatar  rounded-circle">
                                                                </div>
                                                                <div class="pl-3">
                                                                    <h5 class="t-author t-black14">
                                                                        {{ $storethemesetting['homepage-testimonial-card-title'][$i] }}
                                                                    </h5>
                                                                    <small class="d-block t-author-dcs">
                                                                        {{ $storethemesetting['homepage-testimonial-card-sub-text'][$i] }}</small>
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
                                                            <p class="t-dcs t-gray">
                                                                {{ $storethemesetting['inner-list'][4]['field_default_text'] }}
                                                            </p>
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <img alt=""
                                                                        src="{{ $imgpath . (!empty($storethemesetting['inner-list'][1]['field_default_text']) ? $storethemesetting['inner-list'][1]['field_default_text'] : 'avatar.png') }}"
                                                                        class="avatar rounded-circle">
                                                                </div>
                                                                <div class="pl-3">
                                                                    <h5 class="t-author t-black14">
                                                                        {{-- @dd( $storethemesetting['inner-list']) --}}
                                                                        {{ $storethemesetting['inner-list'][2]['field_default_text'] }}

                                                                    </h5>
                                                                    <small class="d-block t-author-dcs">
                                                                        {{ $storethemesetting['inner-list'][3]['field_default_text'] }}</small>
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
                            <!-- Add Pagination -->
                            <!-- <div class="swiper-pagination w-100 mt-4 d-flex align-items-center justify-content-center"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endif
    @endforeach
    <!-- Top Enable Features -->

    <section class="store-promotions common-space70">
        <div class="container">
            <div class="row">
                @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                    @if ($storethemesetting['section_name'] == 'Home-Promotions' && $storethemesetting['section_enable'] == 'on')
                        @if (isset($storethemesetting['homepage-promotions-font-icon']) ||
                            isset($storethemesetting['homepage-promotions-title']) ||
                            isset($storethemesetting['homepage-promotions-description']))
                            @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                <div class="col-lg-3 col-sm-6">
                                    <div class="store-box">
                                        <div class="icon text-primary mr-3">
                                            {!! $storethemesetting['homepage-promotions-font-icon'][$i] !!}
                                        </div>
                                        <div class="s-data">
                                            <strong class="text-primary">
                                                {{ $storethemesetting['homepage-promotions-title'][$i] }}</strong>
                                            <p class=" mt-2 mb-0 t-gray">
                                                {{ $storethemesetting['homepage-promotions-description'][$i] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @else
                            @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                <div class="col-lg-3 col-sm-6">
                                    <div class="store-box">
                                        <div class="icon text-primary mr-3">
                                            {!! $storethemesetting['inner-list'][0]['field_default_text'] !!}
                                        </div>
                                        <div class="s-data">
                                            <strong class="text-primary">
                                                {{ $storethemesetting['inner-list'][1]['field_default_text'] }}</strong>
                                            <p class=" mt-2 mb-0 t-gray">
                                                {{ $storethemesetting['inner-list'][2]['field_default_text'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>
