@extends('storefront.layout.theme10')

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
                                    {{-- @DD($products_image) --}}
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

                        @forelse ($product_ratings as $product_key => $product_rating)
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
                        @empty
                            <h5 class="font-weight-400 text-primary">
                                <span class="r-title">
                                    {{ $avg_rating }}/5
                                </span>
                                <span class="h6 font-weight-500 text-primary">
                                    ({{ $user_count }} {{ __('reviews') }})
                                </span>
                            </h5>
                        @endforelse

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
                    <p class="font-size-12 mt-3 mb-2 text-primary">Category: {{ $product_categorie }}</p>
                    <!-- Product title -->
                    <h2 class="product-title font-weight-500 text-primary mb-0">{{ $products->name }}</h2>
                    {{-- <h2 class="font-weight-400 text-primary mb-3">with orange petals</h2> --}}
                    <p class="font-size-12 product-detail text-primary">
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
                        </span>
                        <span class="mb-0 sub-price ml-4">
                            {{ \App\Models\Utility::priceFormat($products->last_price) }}
                        </span>
                    </div>
                    <a href="#"
                        class="btn btn-block btn-primary font-size-12 py-4 rounded-0 text-underline add_to_cart"
                        data-id="{{ $products->id }}">
                        {{ __('Add to cart') }}
                    </a>
                    <div class="mt-4 d-flex cart-buttons">
                        <p class="mb-0 font-size-12 text-primary mr-5">CATEGORY: {{ $product_categorie }}</p>
                        <p class="mb-0 font-size-12 text-primary ">SKU: {{ $products->SKU }}</p>
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
            <hr class="mb-0 border-primary">
            <div class="row">
                <div class="border-right border-primary col-md-6 pr-md-0 order-2 order-md-1">
                    <div class="customer-product-review pr-4 py-4  border-primary">
                        <div class="review-title mb-2 mt-0">
                            <h5 class="font-weight-400 text-primary">
                                <span class="r-title">
                                    {{ $avg_rating }}/5
                                </span>
                                <span class="h6 font-weight-500 text-primary">
                                    ({{ $user_count }} {{ __('reviews') }})
                                </span>
                            </h5>
                            @if (Auth::guard('customers')->check())
                                <a href="#"
                                    class="btn btn-sm btn-primary btn-icon-only rounded-circle float-right text-white"
                                    data-size="lg" data-toggle="modal"
                                    data-url="{{ route('rating', [$store->slug, $products->id]) }}"
                                    data-ajax-popup="true" data-title="{{ __('Create New Rating') }}">
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
                                <p class="mb-0 ml-3 font-size-12 text-primary"> {{ $avg_rating }}/5
                                    ({{ $user_count }} {{ __('reviews') }})</p>
                            </div>

                        </div>
                        <!-- Product title -->
                        @if (!empty($product_rating))
                            <p class="font-italic font-size-12 mb-0 mt-2 product-detail text-primary">
                                {{ $product_rating->description }}
                            </p>
                            <div class="mt-2">
                                <p class="mb-0 align-items-center d-flex mb-0 text-primary font-size-12">
                                    <span class="avatar avatar-sm bg-primary rounded-pill mr-3">
                                    </span>
                                    <b>{{ $product_rating->name }} :</b>
                                    {{ $product_rating->title }}
                                </p>
                            </div>
                        @endif
                    </div>

                </div>

                <div class="col-md-6 pt-4 pl-md-5 order-1 order-md-2">

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
            <hr class="border-primary mt-0">

        </div>

    </section>


    <!-- Products -->
    <section class="bestsellers-section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mb-4 pr-title">
                    <h4 class="font-weight-300 mt-4 text-primary">{{ __('Related Products') }}</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 px-0 swiper-js-container">
                    <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                        data-swiper-sm-items="2" data-swiper-xl-items="4" data-swiper-slidesOffsetBefore="500">
                        <div class="swiper-wrapper tab-content d-flex">
                            @foreach ($all_products as $key => $product)
                                @if ($product->id != $products->id)
                                    <div class="col-lg-3 col-sm-6 col-md-4 product-box swiper-slide">
                                        <div class="border-0 card card-product rounded-lg">
                                            <div
                                                class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">

                                                @if (Auth::guard('customers')->check())
                                                    @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                        @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100  add_to_wishlist wishlist_{{ $product->id }}"
                                                                data-id="{{ $product->id }}">
                                                                <i class="far fa-heart text-white"></i>
                                                            </button>
                                                        @else
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100 "
                                                                data-id="{{ $product->id }}" disabled>
                                                                <i class="far fa-heart text-white"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100  add_to_wishlist wishlist_{{ $product->id }}"
                                                            data-id="{{ $product->id }}">
                                                            <i class="far fa-heart text-white"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button"
                                                        class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100  add_to_wishlist wishlist_{{ $product->id }}"
                                                        data-id="{{ $product->id }}">
                                                        <i class="far fa-heart text-white"></i>
                                                    </button>
                                                @endif

                                            </div>
                                            <div class="card-image col-9 mx-auto pt-4 pb-4">

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
                                            <div class="card-body pt-0 pb-4 px-4 px-md-3 px-lg-4">
                                                <h6>
                                                    <a class="font-weight-300 text-primary"
                                                        href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                        <span class="font-weight-600">
                                                            {{ $product->name }}
                                                        </span>
                                                    </a>
                                                </h6>
                                                <div class="mb-3">
                                                    <span class="font-size-12 font-weight-600 text-primary">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            class="mr-1">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M5.6846 1.54449C6.14218 0.144023 8.10781 0.144027 8.5654 1.54449L9.38429 4.05075C9.41301 4.13865 9.4936 4.19876 9.5854 4.20075L12.1696 4.25677C13.5864 4.28749 14.191 6.08576 13.0846 6.97816L10.9486 8.70091C10.8804 8.75594 10.8516 8.84689 10.8757 8.93155L11.6348 11.6008C12.0332 13.0019 10.4448 14.1165 9.27925 13.2537L7.25325 11.7538C7.17694 11.6973 7.07306 11.6973 6.99675 11.7538L4.97074 13.2537C3.80522 14.1165 2.21676 13.0019 2.61521 11.6008L3.37428 8.93155C3.39835 8.84689 3.36961 8.75594 3.30138 8.70091L1.16544 6.97816C0.0590049 6.08576 0.663576 4.28749 2.08036 4.25677L4.6646 4.20075C4.7564 4.19876 4.83699 4.13865 4.86571 4.05075L5.6846 1.54449ZM7.33077 1.95425C7.2654 1.75419 6.9846 1.75419 6.91923 1.95425L6.10034 4.46051C5.89929 5.07584 5.33518 5.49658 4.69255 5.51051L2.10831 5.56653C1.90592 5.57092 1.81955 5.82782 1.97761 5.9553L4.11356 7.67806C4.59113 8.06325 4.79234 8.69988 4.62381 9.2925L3.86474 11.9617C3.80782 12.1619 4.03475 12.3211 4.20125 12.1978L6.22726 10.698C6.76144 10.3025 7.48855 10.3025 8.02274 10.698L10.0487 12.1978C10.2153 12.3211 10.4422 12.1619 10.3853 11.9617L9.62618 9.2925C9.45765 8.69988 9.65887 8.06324 10.1364 7.67806L12.2724 5.9553C12.4305 5.82782 12.3441 5.57092 12.1417 5.56653L9.55745 5.51051C8.91482 5.49658 8.35071 5.07584 8.14966 4.46051L7.33077 1.95425Z"
                                                                fill="#8A8A8A" />
                                                        </svg>
                                                        {{ $product->product_rating() }} /
                                                        {{ __('5.0') }}
                                                    </span>
                                                    <span class="text-primary mx-1">•</span>
                                                    <span class="font-size-12  text-primary">
                                                        <b class="font-weight-600 text-lg text-primary">
                                                            @if ($product->enable_product_variant == 'on')
                                                                {{ __('In variant') }}
                                                            @else
                                                                {{ \App\Models\Utility::priceFormat($product->price) }}
                                                            @endif

                                                        </b>
                                                    </span>
                                                    <span class="font-weight-600 text-lg text-primary sub-price">
                                                        @if ($product->enable_product_variant == 'off')
                                                            {{ \App\Models\Utility::priceFormat($product->last_price) }}
                                                        @endif
                                                    </span>
                                                </div>
                                                {{-- <button type="button"
                                                    class="border-0 btn btn-block btn-primary rounded-pill">
                                                    ADD TO
                                                    CART
                                                </button> --}}

                                                @if ($product->enable_product_variant == 'on')
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                        class="border-0 btn btn-block btn-secondary  rounded-pill">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="border-0 btn btn-block btn-secondary  rounded-pill add_to_cart"
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
