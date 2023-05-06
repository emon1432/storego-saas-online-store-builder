@extends('storefront.layout.theme1')
@section('page-title')
    {{ __('Home') }}
@endsection

@push('css-page')
@endpush

@php
$imgpath=\App\Models\Utility::get_file('uploads/');
$productImg = \App\Models\Utility::get_file('uploads/is_cover_image/');
$catimg = \App\Models\Utility::get_file('uploads/product_image/');
$default =\App\Models\Utility::get_file('uploads/theme1/header/logo4.png');
@endphp

@section('content')
    {{-- @DD($store->store_theme) --}}
    {{-- @dd($getStoreThemeSetting); --}}
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

                $homepage_header_Bckground_Image_key = array_search('Bckground Image', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_Bckground_Image = $ThemeSetting['inner-list'][$homepage_header_Bckground_Image_key]['field_default_text'];
            @endphp
            {{-- @DD($homepage_header_Bckground_Image) --}}
            <section class="slice slice-xl bg-cover bg-size--cover home-banner" data-offset-top="#header-main"
                style="background-image: url({{ $imgpath. $homepage_header_Bckground_Image}});
                     background-position: center center;">
                <span class="mask bg-dark opacity-3"></span>
                <div class="container py-6">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h2 class="h1 text-white store-title">
                                {{ $homepage_header_title }}
                                {{-- {{!empty($storethemesetting['header_title'])?$storethemesetting['header_title']:'Home Accessories'}} --}}
                            </h2>
                            <p class="lead text-white mt-4 store-dcs">
                                {{ $homepage_header_Sub_text }}
                                {{-- {{!empty($storethemesetting['header_desc'])?$storethemesetting['header_desc']:'There is only that moment and the incredible certainty that everything under the sun has been written by one hand only.'}} --}}
                            </p>
                            <button href="#"
                                class="btn btn-white btn-white btn-icon rounded-pill hover-translate-y-n3 mt-4"
                                id="pro_scroll">
                                <span class="btn-inner--text">
                                    {{ $homepage_header_Button }}
                                    {{-- {{ !empty($storethemesetting['button_text'])?$storethemesetting['button_text']:__('Start shopping') }} --}}
                                </span>
                                <span class="btn-inner--icon"><i class="fas fa-angle-right"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            {{-- @endif --}}
        @endif
    @endforeach

    <!-- Features -->
@if($getStoreThemeSetting[1]['section_enable'] == 'on')
    <section class="store-promotions mt-70">
        <div class="container">
            <div class="row">
                @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                    @if ($storethemesetting['section_name'] == 'Home-Promotions')
                        @if (isset($storethemesetting['homepage-promotions-font-icon']) ||
                            isset($storethemesetting['homepage-promotions-title']) ||
                            isset($storethemesetting['homepage-promotions-description']))
                            @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-4">
                                        <div class="icon text-primary">
                                            {!! $storethemesetting['homepage-promotions-font-icon'][$i] !!}
                                        </div>
                                        <strong class="text-primary">
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
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-4">
                                        <div class="icon text-primary">
                                            {!! $storethemesetting['inner-list'][0]['field_default_text'] !!}
                                        </div>
                                        <strong class="text-primary">
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
    </section>
@endif

    <!-- Products -->
    @if ($products['Start shopping']->count() > 0)
        <section id="pro_items" class="bestsellers-section">
            <div class="container">
                <div class="row">
                    <div class="pr-title mb-4">
                        <h3 class=" mt-4 store-title text-primary">{{ __('Products') }}</h3>
                        <div class="p-tablist">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach ($categories as $key => $category)
                                    <li class="nav-item">
                                        <a href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" data-id="{{ $key }}"
                                            class="nav-link {{ $key == 0 ? 'active' : '' }} productTab" id="electronic-tab"
                                            data-toggle="tab" role="tab" aria-controls="home" aria-selected="false">
                                            {{ __($category) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
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
                                                <div class="col-xl-3 col-lg-4 col-sm-6 product-box">
                                                    <div class="card card-fluid card-product">
                                                        <div class="card-image">
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
                                                        <div class="card-body pt-0">
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
                                                            <h6>
                                                                <a class="t-black13"
                                                                    href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                                    {{ $product->name }}
                                                                </a>
                                                            </h6>
                                                            <p class="text-sm">
                                                                <span class="td-gray">{{ __('Category') }}:</span>
                                                                {{ $product->product_category() }}
                                                            </p>
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
                                                                        <i class="fas fa-shopping-basket"></i>
                                                                    </a>
                                                                @else
                                                                    <a class="action-item pcart-icon bg-primary add_to_cart"
                                                                        data-id="{{ $product->id }}">
                                                                        <i class="fas fa-shopping-basket"></i>
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

    <!-- subscriber-->
    @if($getStoreThemeSetting[2]['section_enable'] == 'on')
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
            {{-- @DD($emailsubs_img) --}}
            <section class="slice slice-xl bg-cover bg-size--cover"
                style="background-image: url({{ $imgpath  . $emailsubs_img }}); background-position: center center;">
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
@endif
    <!-- Products -->
    @if (count($topRatedProducts) > 0)
        <section class="top-product">
            <div class="container">
                <div class="row">
                    <div class="pr-title">
                        <h3 class=" mt-4 store-title text-primary">{{ __('Top rated products') }}</h3>
                        <a href="{{ route('store.categorie.product', $store->slug) }}"
                            class="btn btn-sm btn-primary rounded-pill btn-icon">
                            <span class="btn-inner--text">{{ __('Show more products') }}</span>
                            <i class="fas fa-shopping-basket"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    @foreach ($topRatedProducts as $k => $topRatedProduct)
                        <div class="col-xl-3 col-lg-4 col-sm-6 product-box">
                            <div class="card card-product">
                                <div class="card-image">
                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                        @if (!empty($topRatedProduct->product->is_cover) &&
                                            \Storage::exists('uploads/is_cover_image/' . $topRatedProduct->product->is_cover))
                                            <img alt="Image placeholder"
                                                src="{{$productImg . $topRatedProduct->product->is_cover }}"
                                                class="img-center img-fluid">
                                        @else
                                            <img alt="Image placeholder"
                                                src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                class="img-center img-fluid">
                                        @endif
                                    </a>
                                </div>
                                <div class="card-body pt-0">
                                    <span class="static-rating static-rating-sm">
                                        @if ($store->enable_rating == 'on')
                                            @for ($i = 1; $i <= 5; $i++)
                                                @php
                                                    $icon = 'fa-star';
                                                    $color = '';
                                                    $newVal1 = $i - 0.5;
                                                    if ($topRatedProduct->product->product_rating() < $i && $product->product_rating() >= $newVal1) {
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
                                    <h6><a class="t-black13" href="#">{{ $topRatedProduct->product->name }}</a>
                                    </h6>
                                    <p class="text-sm">
                                        <span class="td-gray">{{ __('Category') }}:</span>
                                        {{ $topRatedProduct->product->product_category() }}
                                    </p>
                                    <div class="product-price mt-3">
                                        <span class="card-price t-black15">
                                            @if ($topRatedProduct->product->enable_product_variant == 'on')
                                                {{ __('In variant') }}
                                            @else
                                                {{ \App\Models\Utility::priceFormat($topRatedProduct->product->price) }}
                                            @endif
                                        </span>

                                        @if ($topRatedProduct->product->enable_product_variant == 'on')
                                            <a href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}"
                                                class="action-item pcart-icon bg-primary">
                                                <i class="fas fa-shopping-basket"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)"
                                                class="action-item pcart-icon bg-primary add_to_cart"
                                                data-id="{{ $topRatedProduct->product->id }}">
                                                <i class="fas fa-shopping-basket"></i>
                                            </a>
                                        @endif

                                    </div>
                                </div>
                                <div class="actions card-product-actions">
                                    @if (Auth::guard('customers')->check())
                                        @if (!empty($wishlist) && isset($wishlist[$topRatedProduct->product->id]['product_id']))
                                            @if ($wishlist[$topRatedProduct->product->id]['product_id'] != $topRatedProduct->product->id)
                                                <button type="button"
                                                    class="action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                    data-id="{{ $topRatedProduct->product->id }}">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                            @else
                                                <button type="button" class="action-item wishlist-icon bg-light-gray"
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
                        </div>
                    @endforeach
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

            <section class="categorie-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-5 text-center">
                                <h3 class=" mt-4 store-title text-primary">
                                    {{ !empty($Title) ? $Title : 'Categories' }}
                                </h3>
                                <div class="fluid-paragraph mt-3">
                                    <p class="lead lh-180 store-dcs">
                                        {{ !empty($Description)
                                            ? $Description
                                            : 'There is only that moment and the incredible certainty <br> that everything under the sun has been written by one hand only.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($pro_categories as $key => $pro_categorie)
                            @if ($product_count[$key] > 0)
                                <div class="col-lg-4 col-md-6 col-sm-6 categories-box mb-4">
                                    <div class="cat-box">
                                        @if (!empty($pro_categorie->categorie_img) &&
                                            \Storage::exists('uploads/product_image/' . $product->categorie_img))
                                            <img alt="Image placeholder"
                                                src="{{  $catimg . $pro_categorie->categorie_img }}"
                                                class="product bor-radius" height="350px">
                                        @else
                                            <img alt="Image placeholder"
                                                src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}"
                                                class="product bor-radius" height="350px">
                                        @endif
                                    </div>
                                    <div class="cat-dcs">
                                        <h3 class="t-white">{{ $pro_categorie->name }}</h3>
                                        <p class="t-white">{{ __('Products') }}:
                                            {{ !empty($product_count[$key]) ? $product_count[$key] : '0' }}</p>
                                        <a href="{{ route('store.categorie.product', [$store->slug, $pro_categorie->name]) }}"
                                            class="btn btn-sm btn-primary rounded-pill btn-icon">
                                            <span class="btn-inner--text">{{ __('Show more products') }}</span>
                                            <span class="btn-inner--icon">
                                                <i class="fas fa-shopping-basket"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach


    <!-- Testimonials (v1) -->
    @if($getStoreThemeSetting[4]['section_enable'] == 'on')
    <section class="slice testimonial-section">
        <div class="container-fulid">
            <div class="mb-5 text-center">
                @foreach ($getStoreThemeSetting as $storethemesetting)
                    {{-- @DD($storethemesetting['section_name'] == 'Home-Testimonial') --}}
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

                        <h3 class=" mt-4 store-title text-primary">
                            {{ !empty($Heading) ? $Heading : 'Testimonials' }}
                        </h3>
                        <div class="fluid-paragraph mt-3">
                            <p class="lead lh-180 store-dcs">
                                {{ !empty($HeadingSubText)
                                    ? $HeadingSubText
                                    : 'There is only that moment and the incredible certainty that <br> everything
                                                                                                                                                                                                                                                                                                                                    under the sun has been written by one hand only.' }}
                            </p>
                        </div>
                    @endif
                @endforeach

            </div>
            <div class="container">
                <div class="row testimonial-slider">
                    <div class="col-lg-12">
                        <div class="swiper-js-container overflow-hidden">
                            <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                                data-swiper-sm-items="2" data-swiper-xl-items="3">
                                <div class="row swiper-wrapper">
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
                                                                        <img alt=""
                                                                            src="{{ $imgpath . (!empty($storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text']) ? $storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text'] : 'avatar.png') }}"
                                                                            class="avatar rounded-circle">
                                                                    </div>
                                                                    <div class="pl-3">
                                                                        <h5 class="t-author t-black14">
                                                                            {{ $storethemesetting['homepage-testimonial-card-title'][$i] }}
                                                                        </h5>
                                                                        <small class="d-block t-author-dcs">
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
                                                                <p class="t-dcs t-gray">
                                                                    {{ $storethemesetting['inner-list'][4]['field_default_text'] }}
                                                                </p>
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        {{-- @dd($storethemesetting['inner-list'][1]['field_default_text']) --}}

                                                                        <img alt=""
                                                                            src="{{$imgpath . (!empty($storethemesetting['inner-list'][1]['field_default_text']) ? $storethemesetting['inner-list'][1]['field_default_text'] : 'avatar.png') }}"
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


    <!-- Client Logo -->

    <div class="client-logo">
        <div class="container">
            <div class="row d-flex justify-content-center">
                @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                    @if (isset($storethemesetting['section_name']) &&
                        $storethemesetting['section_name'] == 'Home-Brand-Logo' &&
                        $storethemesetting['section_enable'] == 'on')
                        @foreach ($storethemesetting['inner-list'] as $image)
                            @if (!empty($image['image_path']))
                                @foreach ($image['image_path'] as $img)
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                        <a href="#">
                                            <img src="{{$imgpath . (!empty($img) ? $img : 'storego-image.png') }}"
                                                alt="Footer logo">
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{$default }}"
                                            alt="Footer logo">
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{$default }}"
                                            alt="Footer logo">

                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{$default }}"
                                            alt="Footer logo">
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{$default }}"
                                            alt="Footer logo">

                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 ">
                                    <a href="#">
                                        <img src="{{$default }}"
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
                url: '{{ route('user.addToCart', ['__product_id', $store->slug, 'variation_id']) }}'
                    .replace(
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
