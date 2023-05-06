@extends('storefront.layout.theme6')

@section('page-title')
    {{ __('Home') }}
@endsection

@push('css-page')
@endpush
@php
$imgpath=\App\Models\Utility::get_file('uploads/product_image/');
$proimg=\App\Models\Utility::get_file('uploads/is_cover_image/');

@endphp
@section('content')

    <section class="product-section pt-3">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="product-slider">
                        <div class="carousel-container position-relative row ">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                                <div class="carousel-inner">
                                    @foreach ($products_image as $key => $productss)
                                        <div class="carousel-item  {{ $key == 0 ? 'active' : '' }}"
                                            data-slide-number="{{ $key }}">
                                            @if (!empty($products_image[$key]->product_images))
                                                <img src="{{ $imgpath . $products_image[$key]->product_images }}"
                                                    class="d-block w-100" alt="..."
                                                    data-remote="{{ $imgpath . $products_image[$key]->product_images }}"
                                                    data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
                                            @else
                                                <img src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}"
                                                    class="d-block w-100" alt="..."
                                                    data-remote="{{ $imgpath . $products_image[$key]->product_images }}"
                                                    data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Carousel Navigation -->
                            <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                            @foreach ($products_image as $key => $productss)
                                                <div id="carousel-selector-{{ $key }}"
                                                    class="thumb col-lg-4 col-sm-4 col-4 px-1 py-2 "
                                                    data-target="#myCarousel" data-slide-to="{{ $key }}">
                                                    @if (!empty($products_image[$key]->product_images))
                                                        <img src="{{ $imgpath. $products_image[$key]->product_images }}"
                                                            class="img-fluid" alt="...">
                                                    @else
                                                        <img src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}"
                                                            class="img-fluid" alt="...">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- /row -->
                    </div> <!-- /container -->
                </div>

                <div class="col-lg-5 pl-lg-5">
                    <div class="pd-rate">
                        @foreach ($product_ratings as $product_key => $product_rating)
                            @if ($product_rating->rating_view == 'on')
                                <div class="p-rateing d-flex">
                                    <span class="static-rating static-rating-sm d-block">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i
                                                class="star fas fa-star {{ $product_rating->ratting > $i ? 'text-primary' : '' }}"></i>
                                        @endfor
                                    </span>
                                    <p class="mb-0 ml-3"><span class="font-size-12 text-secondary"> {{ $avg_rating }}/5
                                            ({{ $user_count }} {{ __('reviews') }})
                                        </span></p>
                                </div>
                            @endif
                        @endforeach
                        <div class="p-rate ">
                            @if (Auth::guard('customers')->check())
                                @if (!empty($wishlist) && isset($wishlist[$products->id]['product_id']))
                                    @if ($wishlist[$products->id]['product_id'] != $products->id)
                                        <button type="button"
                                            class="action-item wishlist-icon add_to_wishlist wishlist_{{ $products->id }}"
                                            data-id="{{ $products->id }}">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    @else
                                        <button type="button" class="action-item wishlist-icon"
                                            data-id="{{ $products->id }}" disabled>
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    @endif
                                @else
                                    <button type="button"
                                        class="action-item wishlist-icon add_to_wishlist wishlist_{{ $products->id }}"
                                        data-id="{{ $products->id }}">
                                        <i class="far fa-heart"></i>
                                    </button>
                                @endif
                            @else
                                <button type="button"
                                    class="action-item wishlist-icon add_to_wishlist wishlist_{{ $products->id }}"
                                    data-id="{{ $products->id }}">
                                    <i class="far fa-heart"></i>
                                </button>
                            @endif
                        </div>

                    </div>

                    <p class="font-size-12 mt-3 mb-2 text-secondary">Category: {{ $product_categorie }}</p>
                    <!-- Product title -->
                    <h2 class="product-title font-weight-500 text-secondary mb-0">{{ $products->name }}</h2>
                    {{-- <h2 class="font-weight-400 text-secondary mb-3">with orange petals</h2> --}}
                    <p class="font-size-12 product-detail text-secondary">
                        {!! $products->detail !!}
                    </p>

                    <div class="row">
                        @if ($products->enable_product_variant == 'on')
                            <input type="hidden" id="product_id" value="{{ $products->id }}">
                            <input type="hidden" id="variant_id" value="">
                            <input type="hidden" id="variant_qty" value="">
                            <div class="col-md-5">
                                <p class="mb-0">VARIATION:</p>
                                @foreach ($product_variant_names as $key => $variant)
                                    <div class="dropdown w-100">
                                        <p class="mb-0">{{ $variant->variant_name }}</p>
                                        <select name="product[{{ $key }}]" id="pro_variants_name"
                                            class="btn btn-outline-secondary d-flex font-size-12 font-weight-400 justify-content-between px-3 rounded-0 w-100 variant-selection  pro_variants_name{{ $key }}">
                                            <option value=""> {{ __('Select') }}</option>
                                            @foreach ($variant->variant_options as $key => $values)
                                                <option value="{{ $values }}">{{ $values }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="product-price mb-4">
                        <span class="mb-0 p-price text-secondary variation_price">
                            @if ($products->enable_product_variant == 'on')
                                {{ \App\Models\Utility::priceFormat(0) }}
                            @else
                                {{ \App\Models\Utility::priceFormat($products->price) }}
                            @endif
                            {{-- <sub class="bottom-0 text-lg">USD</sub> --}}
                        </span>
                        <span class="mb-0 sub-price ml-4">
                            {{ \App\Models\Utility::priceFormat($products->last_price) }}
                            {{-- <sub class="bottom-0 font-size-12">USD</sub> --}}
                        </span>
                    </div>
                    <a href="#"
                        class="btn btn-block btn-primary font-size-12 py-4 rounded-0 text-underline add_to_cart"
                        data-id="{{ $products->id }}">
                        {{ __('Add to cart') }}
                    </a>
                    <div class="mt-4 d-flex cart-buttons">
                        <p class="mb-0 font-size-12 text-secondary mr-5">CATEGORY: {{ $product_categorie }}</p>
                        <p class="mb-0 font-size-12 text-secondary ">SKU: {{ $products->SKU }}</p>
                    </div>
                    @if (!empty($products->custom_field_1) && !empty($products->custom_value_1))
                        <div class="cart-buttons">
                            <div class="mb-0 t-black14"><span class="t-gray">{{ $products->custom_field_1 }} : </span>
                                {{ $products->custom_value_1 }}</div>
                        </div>
                    @endif
                    @if (!empty($products->custom_field_2) && !empty($products->custom_value_2))
                        <div class="cart-buttons">
                            <div class="mb-0 t-black14"><span class="t-gray">{{ $products->custom_field_2 }} : </span>
                                {{ $products->custom_value_2 }}</div>
                        </div>
                    @endif
                    @if (!empty($products->custom_field_3) && !empty($products->custom_value_3))
                        <div class="cart-buttons">
                            <div class="mb-0 t-black14"><span class="t-gray">{{ $products->custom_field_3 }} : </span>
                                {{ $products->custom_value_3 }}</div>
                        </div>
                    @endif
                    @if (!empty($products->custom_field_4) && !empty($products->custom_value_4))
                        <div class="cart-buttons">
                            <div class="mb-0 t-black14"><span class="t-gray">{{ $products->custom_field_4 }} : </span>
                                {{ $products->custom_value_4 }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


    <section class="product-details">

        <div class="container">
            <hr class="mb-0 border-secondary">
            <div class="row">
                <div class="border-right border-secondary col-md-6 pr-md-0 order-2 order-md-1">
                    <div class="customer-product-review pr-4 py-4  border-secondary">
                        <div class="review-title mb-2 mt-0">
                            <h5 class="font-weight-400 text-secondary">
                                <span class="r-title">
                                    {{ $avg_rating }}/5
                                </span>
                                <span class="h6 font-weight-500 text-secondary">
                                    ({{ $user_count }} {{ __('reviews') }})
                                </span>
                            </h5>
                            @if(Auth::guard('customers')->check())
                            <a href="#" class="btn btn-sm btn-primary btn-icon-only rounded-circle float-right text-white" data-size="lg" data-toggle="modal" data-url="{{route('rating',[$store->slug,$products->id])}}" data-ajax-popup="true" data-title="{{__('Create New Rating')}}">
                                <i class="fas fa-plus"></i>
                            </a>
                            @endif
                        </div>

                        <div class="pd-rate">
                            <div class="p-rateing d-flex">
                                <span class="static-rating static-rating-sm d-block">
                                    @if ($store_setting->enable_rating == 'on')
                                        @for ($i = 1; $i <= 5; $i++)
                                            @php
                                                $icon = 'fa-star';
                                                $color = '';
                                                $newVal1 = $i - 0.5;
                                                if ($avg_rating < $i && $avg_rating >= $newVal1) {
                                                    $icon = 'fa-star-half-alt';
                                                }
                                                if ($avg_rating >= $newVal1) {
                                                    $color = 'text-primary';
                                                }
                                            @endphp
                                            <i class="star fas {{ $icon . ' ' . $color }}"></i>
                                        @endfor
                                    @endif
                                </span>
                                <p class="mb-0 ml-3 font-size-12 text-secondary"> {{ $avg_rating }}/5
                                    ({{ $user_count }} {{ __('reviews') }})</p>
                            </div>

                        </div>
                        <!-- Product title -->
                        @if (!empty($product_rating))
                            <p class="font-italic font-size-12 mb-0 mt-2 product-detail text-secondary">
                                {{ $product_rating->description }}
                            </p>
                            <div class="mt-2">
                                <p class="mb-0 align-items-center d-flex mb-0 text-secondary font-size-12">
                                    <span class="avatar avatar-sm bg-secondary rounded-pill mr-3">
                                    </span>
                                    <b>{{ $product_rating->name }} :</b>
                                    {{ $product_rating->title }}
                                </p>
                            </div>
                        @endif
                    </div>

                </div>

                <div class="col-md-6 pt-4 pl-md-5 order-1 order-md-2">

                    {{-- @if (!empty($products->description))
                        <h4 class="font-weight-400 text-secondary mb-4"> {{__('DESCRIPTION')}}</h4>
                        <p class="font-size-12 text-secondary mb-4">
                            {!! $products->description !!}
                        </p>
                    @endif

                    @if (!empty($products->specification))
                        <h4 class="font-weight-400 text-secondary mb-4"> {{__('SPECIFICATION')}}</h4>
                        <p class="font-size-12 text-secondary mb-4">
                            {!! $products->specification !!}
                        </p>
                    @endif

                    @if (!empty($products->detail))
                        <h4 class="font-weight-400 text-secondary mb-4"> {{__('DETAILS')}}</h4>
                        <p class="font-size-12 text-secondary mb-4">
                            {!! $products->detail !!}
                        </p>
                    @endif --}}
                    @if (!empty($products->description))
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne" class="productdesc">
                                        {{ __('DESCRIPTION') }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-body">
                                    {!! $products->description !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!empty($products->specification))
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h5 class="mb-0">
                                    <a class="collapsed productdesc" data-toggle="collapse" href="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        {{ __('SPECIFICATION') }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body">
                                    {!! $products->specification !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!empty($products->detail))
                        <div class="card">
                            <div class="card-header" role="tab" id="headingThree">
                                <h5 class="mb-0">
                                    <a class="collapsed productdesc" data-toggle="collapse" href="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        {{ __('DETAILS') }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="card-body">
                                    {!! $products->detail !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>


            </div>
            <hr class="border-secondary mt-0">

        </div>

    </section>


    <!-- Products -->
    <section class="bestsellers-section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mb-4 pr-title">
                    <h4 class="font-weight-300 mt-4 text-secondary">Related Products</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 px-0 swiper-js-container">
                    <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                        data-swiper-sm-items="2" data-swiper-xl-items="4" data-swiper-slidesOffsetBefore="500">
                        <div class="swiper-wrapper">
                            @foreach ($all_products as $key => $product)
                                @if ($product->id != $products->id)
                                    <div class="col-lg-4 col-sm-6 product-box swiper-slide">
                                        <div class="border-0 card card-product rounded-0">
                                            <div
                                                class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                                <span
                                                    class="badge badge-secondary font-size-12 font-weight-300 ls-1 px-4 py-3 text-uppercase rounded-0">Bestseller</span>
                                                {{-- <button type="button" class="bg-transparent border-0 p-0" data-toggle="tooltip"
                                            data-original-title="Wishlist">
                                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M14.0544 19.4845C13.6446 19.4831 13.2771 19.2318 13.1272 18.8504C12.9773 18.4689 13.0753 18.0346 13.3744 17.7545C17.1344 14.2545 19.5944 10.7545 20.1344 8.03453C20.4667 5.75176 19.3678 3.49828 17.3644 2.35453C15.6444 1.51453 13.6944 2.22453 11.8744 4.35453L9.87444 6.58453C9.50717 6.99874 8.87365 7.0368 8.45944 6.66953C8.04523 6.30226 8.00717 5.66874 8.37444 5.25453L10.3744 3.03453C13.8144 -0.96547 17.0244 -0.0254695 18.2444 0.56453C21.0759 2.09811 22.6251 5.25685 22.1044 8.43453C21.2644 12.6545 17.1044 17.0045 14.7444 19.2245C14.556 19.3959 14.3092 19.4889 14.0544 19.4845ZM11.9143 21.5547C12.2457 21.1129 12.1561 20.4861 11.7143 20.1547C8.31431 17.6047 2.94431 12.2747 2.09431 8.03473C1.8014 6.06461 2.55997 4.08475 4.09431 2.81473C5.16781 1.91299 6.67758 1.74349 7.92431 2.38473C8.42187 2.60712 9.00587 2.39015 9.23754 1.89685C9.4692 1.40354 9.2632 0.815577 8.77431 0.574727C6.84232 -0.385391 4.52741 -0.12731 2.85431 1.23473C0.717456 2.96735 -0.334316 5.7073 0.094313 8.42473C1.09431 13.5847 7.33431 19.4247 10.4743 21.7547C10.9161 22.0861 11.5429 21.9966 11.8743 21.5547H11.9143Z"
                                                    fill="#616161" />
                                            </svg>
                                        </button> --}}
                                                @if (Auth::guard('customers')->check())
                                                    @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                        @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                            <button type="button"
                                                                class="action-item wishlist-icon add_to_wishlist wishlist_{{ $product->id }}"
                                                                data-id="{{ $product->id }}">
                                                                <i class="far fa-heart"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="action-item wishlist-icon"
                                                                data-id="{{ $product->id }}" disabled>
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button type="button"
                                                            class="action-item wishlist-icon add_to_wishlist wishlist_{{ $product->id }}"
                                                            data-id="{{ $product->id }}">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button type="button"
                                                        class="action-item wishlist-icon add_to_wishlist wishlist_{{ $product->id }}"
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
                                                            src="{{ $proimg. $product->is_cover }}"
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
                                                    {{-- <span class="d-block">
                                                APPLE TEA
                                            </span> --}}
                                                    <a class="t-black13"
                                                        href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                        {{ $product->name }}</a>
                                                </h6>
                                                <span class="card-price mb-4">
                                                    @if ($product->enable_product_variant == 'on')
                                                        {{ __('In variant') }}
                                                    @else
                                                        {{ \App\Models\Utility::priceFormat($product->price) }}
                                                    @endif
                                                </span>
                                                {{-- <button type="button"
                                            class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline">
                                            {{__('ADD TO CART')}}</button> --}}
                                                @if ($product->enable_product_variant == 'on')
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                        class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline">
                                                        {{ __('Add To Cart') }}

                                                    </a>
                                                @else
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                        class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline"
                                                        data-id="{{ $product->id }}">
                                                        {{ __('Add To Cart') }}

                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
@endsection

@push('script-page')
    <script>
        $(document).on('change', '#pro_variants_name', function() {
            var variants = [];
            $(".variant-selection").each(function(index, element) {
                variants.push(element.value);
            });
            if (variants.length > 0) {

                $.ajax({
                    url: '{{ route('get.products.variant.quantity') }}',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        variants: variants.join(' : '),
                        product_id: $('#product_id').val()
                    },

                    success: function(data) {
                        $('.variation_price').html(data.price);
                        $('#variant_id').val(data.variant_id);
                        $('#variant_qty').val(data.quantity);
                    }
                });
            }
        });
    </script>
@endpush
