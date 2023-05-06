@extends('storefront.layout.theme8')

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

                        @if ($store_setting->enable_rating == 'on')
                                <div class="p-rateing d-flex">
                                    <span class="static-rating static-rating-sm d-block">
                                        @for ($i = 0; $i < 5; $i++)
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
                                            <i
                                                class="star fas fa-star {{ $icon . ' ' . $color }}"></i>
                                        @endfor
                                    </span>
                                    <p class="mb-0 ml-3"><span class="font-size-12 text-secondary"> {{ $avg_rating }}/5
                                            ({{ $user_count }} {{ __('reviews') }})
                                        </span></p>
                                </div>
                            @endif

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
                                        <select name="product[{{ $key }}]" id="pro_variants_name0"
                                            class="first btn btn-outline-primary d-flex font-size-12 font-weight-400 justify-content-between px-3 rounded-0 w-100 variant-selection  pro_variants_name{{ $key }}">
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
                        <span class="mb-0 p-price text-primary variation_price0">
                            @if ($products->enable_product_variant == 'on')
                                {{ \App\Models\Utility::priceFormat(0) }}
                            @else
                                {{ \App\Models\Utility::priceFormat($products->price) }}
                            @endif
                            {{-- {{ \App\Models\Utility::priceFormat($products->price) }} --}}
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
                                    data-url="{{ route('rating', [$store->slug, $products->id]) }}" data-ajax-popup="true"
                                    data-title="{{ __('Create New Rating') }}">
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
                    <h4 class="font-weight-300 mt-4 text-primary">Related Products</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 px-0 swiper-js-container">
                    <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                        data-swiper-sm-items="2" data-swiper-xl-items="4" data-swiper-slidesOffsetBefore="500">
                        <div class="swiper-wrapper tab-content remove-d-none">
                            @foreach ($all_products as $key => $product)
                                @if ($product->id != $products->id)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-5 mb-md-0 product-box mt-3">
                                        <div class="border-0 card-product rounded-0">
                                            <h6 class="text-uppercase border-bottom border-primary pb-2 d-inline-block">
                                                <a
                                                    href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </h6>
                                            <p class="mb-0 font-size-12 ">
                                                {{ $product->product_category() }}
                                            </p>
                                            <div class="card-image col-5 col-md-9 mx-auto pb-2 pt-3">
                                                <a
                                                    href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                    @if (!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/' . $product->is_cover))
                                                        <img alt="Image placeholder"
                                                            src="{{ $proimg . $product->is_cover }}"
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
                                                    <input type="hidden" id="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" id="variant_id" value="">
                                                    <input type="hidden" id="variant_qty" value="">


                                                    @php $json_variant = json_decode($product->variants_json); @endphp
                                                    @foreach ($json_variant as $key => $json)
                                                        @php $variant_name = $json->variant_name; @endphp
                                                    @endforeach

                                                    <span class="d-block font-size-12 mb-1 ">
                                                        {{ $variant_name }} :
                                                    </span>


                                                    @foreach ($json_variant as $key => $variant)
                                                        <div class="dropdown w-100 mb-3">
                                                            <select name="product[{{ $key }}]"
                                                                id="pro_variants_name"
                                                                class="btn btn-outline-primary d-flex font-size-12 font-weight-400 justify-content-between px-3 rounded-pill w-100 variant-selection1  pro_variants_name{{ $key }}">
                                                                <option value=""> {{ __('Select') }}</option>
                                                                @foreach ($variant->variant_options as $key => $values)
                                                                    <option value="{{ $values }}">
                                                                        {{ $values }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                <div class="d-flex justify-content-between">
                                                    <span
                                                        class="card-price mb-3  font-weight-500 {{ $product->enable_product_variant == 'on' ? 'variation_price' : '' }} ">
                                                        @if ($product->enable_product_variant == 'on')
                                                            {{ __('In variant') }}
                                                        @else
                                                            {{ \App\Models\Utility::priceFormat($product->price) }}
                                                        @endif
                                                    </span>

                                                    @if (Auth::guard('customers')->check())
                                                        @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                            @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                                <button data-toggle="tooltip"
                                                                    data-original-title="Wishlist" type="button"
                                                                    class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                    data-id="{{ $product->id }}">
                                                                    <i class="far fa-heart "></i>
                                                                </button>
                                                            @else
                                                                <button data-toggle="tooltip"
                                                                    data-original-title="Wishlist" type="button"
                                                                    class="mr-4 bg-transparent border-0 p-0 "
                                                                    data-id="{{ $product->id }}" disabled>
                                                                    <i class="fas fa-heart "></i>
                                                                </button>
                                                            @endif
                                                        @else
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                data-id="{{ $product->id }}">
                                                                <i class="far fa-heart "></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                            data-id="{{ $product->id }}">
                                                            <i class="far fa-heart "></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                @if ($product->enable_product_variant == 'on')
                                                    {{-- <a href="#" type="button"
                                                        class="btn btn-primary btn-block rounded-pill add_to_cart"
                                                        data-flag="1" data-id="{{ $product->id }}">
                                                        {{ __('ADD TO CART') }}
                                                    </a> --}}
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}" type="button"
                                                        class="btn btn-primary btn-block rounded-pill add_to_cart" data-flag="1" data-id="{{ $product->id }}">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" type="button" data-flag="0"
                                                        class="btn btn-primary btn-block rounded-pill add_to_cart"
                                                        data-id="{{ $product->id }}" data-flag="0">
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
        $(document).on('change', '#pro_variants_name0', function() {
            var variants = [];
            $(".first").each(function(index, element) {
                variants.push(element.value);
                console.log(variants);
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
                        $('.variation_price0').html(data.price);
                        $('#variant_id').val(data.variant_id);
                        $('#variant_qty').val(data.quantity);
                    }
                });
            }
        });

        $(document).on('change', '.variant-selection1', function() {
            var variants = [];

            let selected1 = $(this).parent().parent().find('.variant-selection1');
            $(selected1).each(function(index, element) {
                variants.push(element.value);
            });
            let product_id = $(this).closest(".card-body").find('#product_id').val();
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
