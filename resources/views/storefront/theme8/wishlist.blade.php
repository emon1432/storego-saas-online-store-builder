@extends('storefront.layout.theme8')
@section('page-title')
    {{ __('Wish list') }}
@endsection
@push('css-page')
@endpush
@php
    $imgpath=\App\Models\Utility::get_file('uploads/is_cover_image/');

    @endphp
@section('content')
    <section class="my-cart-section pt-5 mb-5">
        <div class="container">
            <div class="tab-content  theme6 py-3 px-3 px-sm-0 tabs-container " id="nav-tabContent">

                <div class=" pro-cards ">
                    <div class="row">
                        @foreach ($products as $k => $product)

                            <div class="col-lg-3 col-md-4 col-sm-6 mb-5 mb-md-0 product-box">
                                <div class="border-0 card-product rounded-0">
                                    <h6 class="text-uppercase border-bottom border-primary pb-2 d-inline-block">
                                        <a
                                            href="{{ route('store.product.product_view', [$store->slug, $product['product_id']]) }}">
                                            {{ $product['product_name'] }}
                                        </a>
                                    </h6>
                                    <p class="mb-0 font-size-12">
                                        {{ \App\Models\Product::getCategoryById($product['product_id']) }}
                                    </p>
                                    <div class="card-image col-5 col-md-9 mx-auto pb-2 pt-3">
                                        <a
                                            href="{{ route('store.product.product_view', [$store->slug,$product['product_id']]) }}">

                                            @if (!empty($product['image']))
                                                <img alt="Image placeholder" src="{{ $imgpath.$product['image']}}"
                                                    class="img-center img-fluid">
                                            @else
                                                <img alt="Image placeholder"
                                                    src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                    class="img-center img-fluid">
                                            @endif
                                        </a>
                                    </div>
                                    @if ($product['enable_product_variant'] == 'on')
                                                <input type="hidden" id="product_id" value="{{ $product['product_id'] }}">
                                                <input type="hidden" id="variant_id" value="">
                                                <input type="hidden" id="variant_qty" value="">


                                                @php $json_variant = json_decode($product['variants_json']); @endphp
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
                                            class="card-price mb-3 text-primary font-weight-500 {{ $product['enable_product_variant'] == 'on' ? 'variation_price' : '' }} ">
                                            @if ($product['enable_product_variant'] == 'on')
                                                {{ __('In variant') }}
                                            @else
                                                {{ \App\Models\Utility::priceFormat($product['price']) }}
                                            @endif
                                        </span>


                                        <button type="button"
                                            class="mr-4 bg-transparent border-0 p-0 wishlist-icon delete_wishlist_item"
                                            id="delete_wishlist_item1" data-id="{{ $product['product_id'] }}">
                                            <i class="fas fa-heart"></i>
                                        </button>

                                    </div>

                                    @if ($product['enable_product_variant'] == 'on')
                                            {{-- <a href="{{ route('store.product.product_view', [$store->slug, $product['product_id']]) }}"
                                                class="btn btn-primary btn-block rounded-pill">
                                                {{ __('ADD TO CART') }}
                                            </a> --}}
                                            <a href="{{ route('store.product.product_view', [$store->slug, $product['product_id']]) }}" type="button"
                                                class="btn btn-primary btn-block rounded-pill add_to_cart" data-flag="1" data-id="{{ $product['product_id'] }}">
                                                {{ __('ADD TO CART') }}
                                            </a>
                                        @else
                                            <a href="javascript:void(0)"
                                                class="btn btn-primary btn-block rounded-pill add_to_cart"
                                                data-id="{{ $product['product_id'] }}">
                                                {{ __('ADD TO CART') }}
                                            </a>
                                        @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script-page')
    <script>
        $(document).on('click', '.delete_wishlist_item', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');

            $.ajax({
                type: "DELETE",
                url: '{{ route('delete.wishlist_item', [$store->slug, '__product_id']) }}'.replace(
                    '__product_id', id),
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status == "success") {
                        show_toastr('Success', response.message, 'success');
                        $('.wishlist_' + response.id).remove();
                        $('.wishlist_count').html(response.count);
                        location.reload();

                    } else {
                        show_toastr('Error', response.message, 'error');
                    }
                },
                error: function(result) {}
            });
        });


        $(document).on('change', '.variant-selection', function() {

            var variants = [];

            let selected1 = $(this).parent().parent().find('.variant-selection');
            $(selected1).each(function(index, element) {
                variants.push(element.value);

            });
            let product_id = $(this).closest(".card-product").find('#product_id').val();
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
