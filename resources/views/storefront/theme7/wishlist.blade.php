@extends('storefront.layout.theme7')
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
                            <div class="col-lg-3 col-sm-6 product-box d-flex  wishlist_{{ $product['product_id'] }} mt-4">
                                <div class="border-0 bg-white card card-product rounded-0 w-100">
                                    <div
                                        class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                        <span
                                            class="badge badge-secondary font-size-12 font-weight-300 ls-1 px-4 py-3 text-uppercase rounded-0">{{ __('Bestseller') }}</span>
                                        <button type="button"
                                            class="ml-3 action-item wishlist-icon delete_wishlist_item"
                                            id="delete_wishlist_item1" data-id="{{ $product['product_id'] }}">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div
                                        class="card-image col-6 mx-auto pt-5 pb-4 d-flex justify-content-center align-items-center">

                                        @if (!empty($product['image']))
                                            <img alt="Image placeholder" src="{{$imgpath.$product['image'] }}"
                                                class="img-center img-fluid">
                                        @else
                                            <img alt="Image placeholder"
                                                src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                class="img-center img-fluid">
                                        @endif
                                    </div>
                                    <div class="card-body pt-0 text-center">
                                        <h6 class="mb-3"><span class="d-block">{{ $product['product_name'] }}</span>

                                        </h6>
                                        <p class="text-sm">
                                            <span class="td-gray">{{ __('Category') }}:</span>
                                            {{ \App\Models\Product::getCategoryById($product['product_id']) }}
                                        </p>
                                        <span class="card-price mb-4">
                                            @if ($product['enable_product_variant'] == 'on')
                                                {{ __('In variant') }}
                                            @else
                                                {{ \App\Models\Utility::priceFormat($product['price']) }}
                                            @endif
                                        </span>

                                        @if ($product['enable_product_variant'] == 'on')
                                            <a href="{{ route('store.product.product_view', [$store->slug, $product['product_id']]) }}"
                                                class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline">
                                                {{ __('ADD TO CART') }}
                                            </a>
                                        @else
                                            <a href="javascript:void(0)"
                                                class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline add_to_cart"
                                                data-id="{{ $product['product_id'] }}">
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
</script>
@endpush
