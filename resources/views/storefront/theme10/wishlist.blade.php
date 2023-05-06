@extends('storefront.layout.theme10')
@section('page-title')
    {{ __('Wish list') }}
@endsection
@push('css-page')
@endpush
@php
    $imgpath=\App\Models\Utility::get_file('uploads/is_cover_image/');

    @endphp
@section('content')
    <section class="my-cart-section pt-5 mb-5 ">
        <div class="container">
            <div class="tab-content  py-3 px-3 px-sm-0 tabs-container d-block" id="nav-tabContent">
                <div class=" pro-cards ">

                    <div class="row">

                        @foreach ($products as $k => $product)

                                <div class="col-lg-3 col-sm-6 col-md-4 product-box swiper-slide">
                                    <div class="border-0 card card-product rounded-0 shadow">
                                        <div
                                            class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                            type="button"
                                            class="bg-transparent border-0 p-0 position-absolute right-4 top-3 zindex-100 delete_wishlist_item"
                                            data-id="{{ $product['product_id'] }}" id="delete_wishlist_item1" >
                                            <i class="fas fa-heart text-primary"></i>
                                            </button>
                                        </div>
                                        <div class="card-image col-8 mx-auto pt-4 pb-4">

                                            <a
                                            href="{{ route('store.product.product_view', [$store->slug,$product['product_id']]) }}">

                                            @if (!empty($product['image']))
                                                <img alt="Image placeholder" src="{{ $imgpath.$product['image'] }}"
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
                                                    href="{{ route('store.product.product_view', [$store->slug, $product['product_id']]) }}">
                                                    {{ $product['product_name'] }}
                                                </a>
                                            </h6>
                                            <span class="font-weight-600 text-black-50 text-small">
                                                {{ __('Category:') }}
                                            {{ \App\Models\Product::getCategoryById($product['product_id']) }}
                                            </span>
                                            <div class="mb-2">
                                                <span class="font-weight-600 text-lg text-primary">
                                                    @if ($product['enable_product_variant'] == 'on')
                                                        {{ __('In variant') }}
                                                    @else
                                                    {{ \App\Models\Utility::priceFormat($product['price']) }}
                                                    @endif
                                                </span>
                                                <del class="font-size-12 font-weight-600 text-black-50 ml-2">
                                                    @if ($product['enable_product_variant'] == 'off')
                                                        {{ \App\Models\Utility::priceFormat(\App\Models\Product::getProductById($product['product_id'])->last_price) }}
                                                    @endif
                                                </del>
                                            </div>
                                            @if ($product['enable_product_variant'] == 'on')
                                                <a href="{{ route('store.product.product_view', [$store->slug, $product['product_id']]) }}"
                                                    class="border-0 btn btn-block btn-primary ">
                                                    {{ __('ADD TO CART') }}
                                                </a>
                                            @else
                                                <a href="javascript:void(0)"
                                                    class="border-0 btn btn-block btn-primary  add_to_cart"
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


    </script>
@endpush
