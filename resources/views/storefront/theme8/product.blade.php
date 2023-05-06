@extends('storefront.layout.theme8')
@section('page-title')
    {{ __('Home') }}
@endsection
@push('css-page')
@endpush
@php
    $imgpath=\App\Models\Utility::get_file('uploads/is_cover_image/');

@endphp
@section('content')
    {{-- @DD($products['Start shopping']) --}}

    <section class="my-cart-section pt-5 mb-5">
        @if ($products['Start shopping']->count() > 0)
            <div class="container">
                <!-- Shopping cart table -->
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-2">
                        <h3 class="font-weight-400 m-md-0 text-secondary">
                            {{ __('Product') }}
                        </h3>
                    </div>
                    <div class="col-md-12 col-lg-10">
                        <div class="nav nav-tabs nav-fill border-0 justify-content-end" id="nav-tab" role="tablist">
                            <div class="product-tab d-flex border border-secondary no-gutters">
                                <ul class="tabs bg-primary" role="tablist" id="myTab">

                                    {{-- @foreach ($categories as $key => $category)
                                        <li class="{{ $category == $categorie_name ? 'active' : '' }} product-tab-main">
                                            <a href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" data-id="{{ $key }}"
                                                class="  tab-a border-0 btn btn-block text-secondary m-0 rounded-0 productTab"
                                                id="electronic-tab" data-toggle="tab" role="tab" aria-controls="home"
                                                aria-selected="false">
                                                {{ __($category) }}
                                            </a>
                                        </li>
                                    @endforeach --}}
                                    @foreach ($categories as $key => $category)
                                        <li class="{{ $category == $categorie_name ? 'active' : '' }} bg-primary">
                                            <a href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" data-id="{{ $key }}"
                                                class="{{ $key == 0 ? 'active' : '' }} productTab bg-primary"
                                                id="electronic-tab" data-toggle="tab" role="tab" aria-controls="home"
                                                aria-selected="false">
                                                {{ __($category) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bestsellers-tabs" id="nav-tabContent">

                    @foreach ($products as $key => $items)
                        <div class="tab-content row {{($key==$categorie_name)?'active show':''}} "
                            id="{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $key) !!}" role="tabpanel" aria-labelledby="shopping-tab">

                            @foreach ($items as $key => $product)
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
                                                        src="{{ $imgpath. $product->is_cover }}"
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
                                                        <select name="product[{{ $key }}]" id="pro_variants_name"
                                                            class="btn btn-outline-primary d-flex font-size-12 font-weight-400 justify-content-between px-3 rounded-pill w-100 variant-selection  pro_variants_name{{ $key }}">
                                                            <option value=""> {{ __('Select') }}</option>
                                                            @foreach ($variant->variant_options as $key => $values)
                                                                <option value="{{ $values }}">{{ $values }}
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
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                            data-id="{{ $product->id }}">
                                                            <i class="far fa-heart "></i>
                                                        </button>
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button" class="mr-4 bg-transparent border-0 p-0 "
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
                                                <button data-toggle="tooltip" data-original-title="Wishlist" type="button"
                                                    class="mr-4 bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                    data-id="{{ $product->id }}">
                                                    <i class="far fa-heart "></i>
                                                </button>
                                            @endif
                                        </div>
                                        @if ($product->enable_product_variant == 'on')
                                            {{-- <a href="#" type="button"
                                                class="btn btn-primary btn-block rounded-pill add_to_cart" data-flag="1"
                                                data-id="{{ $product->id }}">
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
                            @endforeach
                        </div>
                    @endforeach
                </div>

            </div>
            </div>
        @endif
    </section>
@endsection
@push('script-page')
    <script>
        // $(document).ready(function() {
        //     @if ($categorie_name == 'Start shopping')

        //         $('#Furniture').addClass('active');
        //         $("#myTab li:eq(0)").addClass('active');
        //     @endif
        //     // $("#myTab li a:eq(0)").addClass('active');
        // });
        // Tab js
        $('#myTab li').click(function() {
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
        $(document).on('click', '.qty-plus', function() {
            $(this).prev().val(+$(this).prev().val() + 1);
        });
        $(document).on('click', '.qty-minus', function() {
            if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
        });
        $(document).ready(function() {
            $('.tab-a').click(function() {
                $(".tab-pane").removeClass('tab-active');
                $(".tab-pane[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
                $(".tab-a").removeClass('active-a');
                $(this).parent().find(".tab-a").addClass('active-a');
            });
        });

        $(document).on('change', '.variant-selection', function() {
            var variants = [];

            let selected1 = $(this).parent().parent().find('.variant-selection');
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
                        product_id:product_id

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
