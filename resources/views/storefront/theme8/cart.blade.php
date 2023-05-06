@extends('storefront.layout.theme8')

@section('page-title')
    {{ __('Home') }}
@endsection

@push('css-page')
@endpush

@section('content')
    @php
$imgpath=\App\Models\Utility::get_file('uploads/is_cover_image/');
        $cart = session()->get($store->slug);
    @endphp
    @if (!empty($cart['products']) || ($cart['products'] = []))

        <section class="my-cart-section pt-5">
            <div class="container">
                <!-- Shopping cart table -->
                <div class="row align-items-center">
                    <div class="col-md-3 col-lg-2">
                        <h3 class="font-weight-400 m-md-0 text-primary">{{__('My Cart')}}</h3>
                    </div>
                    <div class="col-md-9 col-lg-10">
                        <div class="nav nav-tabs nav-fill border-0" id="nav-tab" role="tablist">
                            <div class="payment-step border border-primary row no-gutters w-100 overflow-hidden rounded-pill">
                                <div class="col-sm-4">
                                        <a href="{{ route('store.cart', $store->slug) }}"  class="active-a tab-a border-0 btn btn-block text-primary m-0 rounded-0 rounded-pill">1 -
                                            {{ __('My Cart') }}</a>
                                </div>
                                <div class="col-sm-4">
                                        <a href="{{ route('user-address.useraddress', $store->slug) }}" class="border-0 tab-a btn btn-block m-0 text-primary rounded-0 rounded-pill">2 -
                                            {{ __('Customer') }}</a>
                                </div>
                                <div class="col-sm-4">
                                        <a href="{{ route('store-payment.payment', $store->slug) }}" class="border-0 tab-a btn btn-block m-0 text-primary rounded-0 rounded-pill">3 -
                                            {{ __('Payment') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-content theme6 py-3 px-3 px-sm-0" id="nav-tabContent">

                    <div class="tab-pane tab-active" data-id="tab1">
                        <div class="table-responsive my-cart mt-5 pl-3 pl-md-0">
                            <table class="table table-cards align-items-center">
                                <tbody class="list">
                                    @if (!empty($products))
                                        @php
                                            $sub_tax = 0;
                                            $total = 0;
                                            $counter = 1;
                                        @endphp
                                        @foreach ($products['products'] as $key => $product)
                                            @if ($product['variant_id'] != 0)
                                                <tr class="alert border-primary" data-id="{{ $key }}">
                                                    <td class="px-0 border-0">
                                                        <span
                                                            class="badge-circle badge-lg bg-white border border-primary ml-n3 text-primary">{{ $counter++ }}</span>
                                                    </td>
                                                    <td class="border-0">
                                                        @if (!empty($product['image']))
                                                            <img alt="" src="{{ $imgpath.$product['image'] }}"
                                                                class="" style="width:50px;">
                                                        @else
                                                            <img alt=""
                                                                src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                                class="" style="width:50px;">
                                                        @endif
                                                    </td>
                                                    <td scope="row" class="border-0">
                                                        <div class="media align-items-center">
                                                            <a href="{{ route('store.product.product_view', [$store->slug, $product['id']]) }}"
                                                                class="font-weight-400 h6 mb-0 text-primary">
                                                                <h4 class="font-weight-500 mb-0 text-primary">
                                                                    {{ $product['product_name'] . ' - ' . $product['variant_name'] }}
                                                                </h4>

                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="price border-0">
                                                        <div class="media-body pl-3">
                                                            <span class="mb-2 p-title t-gray">{{ __('Price') }}</span>
                                                            <div class="lh-100">
                                                                <span class="font-weight-400 mb-0 p-price text-primary">
                                                                    {{ \App\Models\Utility::priceFormat($product['variant_price']) }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="qty-box">
                                                        <span class="font-weight-bold t-gray p-title">{{__('Quantity')}}</span>
                                                        <div class="count-input" data-id="{{$key}}">
                                                            <input type="button" value="<" class="qty-minus product_qty">
                                                            <input type="text" value="{{$product['quantity']}}" data-id="{{$product['product_id']}}" class="bx-cart-qty qty form-control form-control-sm text-center product_qty_input" id="product_qty">
                                                            <input type="button" value=">" class="qty-plus product_qty">
                                                        </div>
                                                    </td>
                                                    <td class="border-0">
                                                        <span
                                                            class="font-weight-bold t-gray p-title">{{ __('Tax') }}</span>
                                                        @php
                                                            $total_tax = 0;
                                                        @endphp
                                                        @if (!empty($product['tax']))
                                                            @foreach ($product['tax'] as $tax)
                                                                @php
                                                                    $sub_tax = ($product['variant_price'] * $product['quantity'] * $tax['tax']) / 100;
                                                                    $total_tax += $sub_tax;
                                                                @endphp
                                                                <p class="t-gray p-title">
                                                                    {{ $tax['tax_name'] . ' ' . $tax['tax'] . '%' . ' (' . $sub_tax . ')' }}
                                                                </p>
                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="border-0">
                                                        <span class="p-title text-dark">{{ __('Total') }}</span>
                                                        @php
                                                            $totalprice = $product['variant_price'] * $product['quantity'] + $total_tax;
                                                            $total += $totalprice;
                                                        @endphp
                                                        <p class="font-weight-500 pt-price text-primary">
                                                            {{ \App\Models\Utility::priceFormat($totalprice) }}
                                                        </p>
                                                    </td>
                                                    <td class="text-right border-0">
                                                        <!-- Actions -->
                                                        <div class="actions ml-3">
                                                            <a href="#!" class="action-item mr-0" data-toggle="tooltip"
                                                                data-original-title="{{ __('Move to trash') }}"
                                                                data-confirm="{{ __('Are You Sure?') . ' | ' . __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-product-cart-{{ $key }}').submit();">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M17.7071 1.70711C18.0976 1.31658 18.0976 0.683417 17.7071 0.292893C17.3166 -0.0976311 16.6834 -0.0976311 16.2929 0.292893L9 7.58579L1.70711 0.292893C1.31658 -0.0976311 0.683418 -0.0976311 0.292894 0.292893C-0.0976295 0.683417 -0.0976295 1.31658 0.292894 1.70711L7.58579 9L0.292893 16.2929C-0.0976311 16.6834 -0.0976311 17.3166 0.292893 17.7071C0.683418 18.0976 1.31658 18.0976 1.70711 17.7071L9 10.4142L16.2929 17.7071C16.6834 18.0976 17.3166 18.0976 17.7071 17.7071C18.0976 17.3166 18.0976 16.6834 17.7071 16.2929L10.4142 9L17.7071 1.70711Z"
                                                                        fill="#615144" />
                                                                </svg>
                                                            </a>
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['delete.cart_item', [$store->slug, $product['product_id'], $product['variant_id']]],
                                                                'id' => 'delete-product-cart-' . $key,
                                                            ]) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="alert border-primary" data-id="{{ $key }}">
                                                    <td class="px-0 border-0">
                                                        <span
                                                            class="badge-circle badge-lg bg-white border border-primary ml-n3 text-primary">
                                                            {{ $counter++ }}
                                                        </span>
                                                    </td>
                                                    <td class="border-0">
                                                        @if (!empty($product['image']))
                                                            <img alt="Image placeholder"
                                                                src="{{$imgpath.$product['image'] }}" class=""
                                                                style="width:50px;">
                                                        @else
                                                            <img alt="Image placeholder"
                                                                src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                                class="" style="width:50px;">
                                                        @endif
                                                    </td>
                                                    <td scope="row" class="border-0">
                                                        <div class="media align-items-center">
                                                            <a class="font-weight-400 h6 mb-0 text-primary"
                                                                href="{{ route('store.product.product_view', [$store->slug, $product['id']]) }}">
                                                                <h4 class="font-weight-500 mb-0 text-primary">
                                                                    {{ $product['product_name'] }}</h4>
                                                                {{-- with orange petals --}}
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="price border-0">
                                                        <div class="media-body pl-3">
                                                            <span class="mb-2 p-title t-gray">{{ __('Price') }}</span>
                                                            <div class="lh-100">
                                                                <span class="font-weight-400 mb-0 p-price text-primary">
                                                                    {{ \App\Models\Utility::priceFormat($product['price']) }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="qty-box">
                                                        <span class="font-weight-bold t-gray p-title">{{__('Quantity')}}</span>
                                                        <div class="count-input" data-id="{{$key}}">
                                                            <input type="button" value="<" class="qty-minus product_qty">
                                                            <input type="text" value="{{$product['quantity']}}" data-id="{{$product['product_id']}}" class="bx-cart-qty qty form-control form-control-sm text-center product_qty_input" id="product_qty">
                                                            <input type="button" value=">" class="qty-plus product_qty">
                                                        </div>
                                                    </td>
                                                    <td class="border-0">
                                                        <span
                                                            class="font-weight-bold t-gray p-title">{{ __('Tax') }}</span>
                                                        @php
                                                            $total_tax = 0;
                                                        @endphp
                                                        @if (!empty($product['tax']))
                                                            @foreach ($product['tax'] as $tax)
                                                                @php
                                                                    $sub_tax = ($product['price'] * $product['quantity'] * $tax['tax']) / 100;
                                                                    $total_tax += $sub_tax;
                                                                @endphp
                                                                <p class="t-gray p-title ">
                                                                    {{ $tax['tax_name'] . ' ' . $tax['tax'] . '%' . ' (' . $sub_tax . ')' }}
                                                                </p>
                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="border-0">
                                                        <span class="p-title text-dark">{{ __('Total') }}</span>
                                                        @php
                                                            $totalprice = $product['price'] * $product['quantity'] + $total_tax;
                                                            $total += $totalprice;
                                                        @endphp
                                                        <p class="font-weight-500 pt-price text-primary">
                                                            {{ \App\Models\Utility::priceFormat($totalprice) }}
                                                        </p>
                                                    </td>
                                                    <td class="text-right border-0">
                                                        <!-- Actions -->
                                                        <div class="actions ml-3">
                                                            <a href="#!" class="action-item mr-0"
                                                                data-toggle="tooltip"
                                                                data-original-title="{{ __('Move to trash') }}"
                                                                data-confirm="{{ __('Are You Sure?') . ' | ' . __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-product-cart-{{ $key }}').submit();">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M17.7071 1.70711C18.0976 1.31658 18.0976 0.683417 17.7071 0.292893C17.3166 -0.0976311 16.6834 -0.0976311 16.2929 0.292893L9 7.58579L1.70711 0.292893C1.31658 -0.0976311 0.683418 -0.0976311 0.292894 0.292893C-0.0976295 0.683417 -0.0976295 1.31658 0.292894 1.70711L7.58579 9L0.292893 16.2929C-0.0976311 16.6834 -0.0976311 17.3166 0.292893 17.7071C0.683418 18.0976 1.31658 18.0976 1.70711 17.7071L9 10.4142L16.2929 17.7071C16.6834 18.0976 17.3166 18.0976 17.7071 17.7071C18.0976 17.3166 18.0976 16.6834 17.7071 16.2929L10.4142 9L17.7071 1.70711Z"
                                                                        fill="#615144" />
                                                                </svg>
                                                            </a>
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['delete.cart_item', [$store->slug, $product['product_id'], $product['variant_id']]],
                                                                'id' => 'delete-product-cart-' . $key,
                                                            ]) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Cart information -->
                        <div class="row justify-content-between align-items-center mt-4">
                            <div class="col-md-8 col-lg-6 mb-4 mb-md-0 ml-auto">
                                <div
                                    class="align-items-center bg-primary d-sm-flex justify-content-between px-3 px-sm-4 py-3">
                                    <div class="d-flex align-items-end mb-3 mb-sm-0">
                                        <span class="lh-100 mr-2 text-white cart-total">
                                            {{__('Total: ')}}
                                        </span>
                                        <span class="cart-total font-weight-600 text-white">
                                            {{ \App\Models\Utility::priceFormat(!empty($total) ? $total : 0) }}</span>
                                    </div>

                                    @if ($store_settings['is_checkout_login_required'] == null ||
                                        ($store_settings['is_checkout_login_required'] == 'off' && !Auth::guard('customers')->user()))
                                        <a href="#"
                                            class="btn
                                        btn-primary px-5 rounded-0"
                                            data-toggle="modal"
                                            data-target="#checkoutModal">{{ __('Proceed to checkout') }}</a>
                                    @else
                                        <a href="{{ route('user-address.useraddress', $store->slug) }}"
                                            class="btn
                                        btn-primary px-5 rounded-0">{{ __('Proceed to checkout') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr class="border-primary mt-md-6 mb-5">

                        <!-- Products -->
                    </div>


                    <div class="tab-pane" data-id="tab2">
                        <div class="row mt-5">
                            <div class="col-xl-8 col-lg-7">
                                <form>
                                    <!-- General -->
                                    <div class="actions-toolbar py-2 mb-4">
                                        <h4 class="font-weight-400 mb-1 text-primary">Billing information</h4>
                                        <p class="font-weight-300 mb-0 text-black-50 text-sm">Fill the form below so we can
                                            send you the order's invoice.</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">First name</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Enter Your first name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Last name</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Enter Your Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Phone</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="48 695-456-504">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Email</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Enter Your Last Email Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Address</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Billing Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Country</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Billing Country">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">City</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Billing City">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Postal code</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Billing Postal Code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Location</label>
                                                <select class="form-control" data-toggle="select" title="City">
                                                    <option selected disabled>Select Location</option>
                                                    <option value="1">Bucharest</option>
                                                    <option value="2">Bacau</option>
                                                    <option value="3">Cluj Napoca</option>
                                                    <option value="4">Piatra Neamt</option>
                                                    <option value="5">Sibiu</option>
                                                    <option value="6">Timisoara</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4 mt-4 py-2">
                                        <div class="left-cart">
                                            <h4 class="font-weight-400 mb-1 text-primary">Shipping informations</h4>
                                            <p class="font-weight-300 mb-0 text-black-50 text-sm">Fill the form below so we
                                                can
                                                send you the orders invoice.</p>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Address</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Shipping address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Country</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Shipping Country">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">City</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Shipping City">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Postal code</label>
                                                <input class="form-control text-primary" type="text"
                                                    placeholder="Shipping Postal Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mt-sm-4 text-center text-sm-right">
                                        <a href="shop-landing.html" class="text-primary">
                                            Return to shop
                                        </a>
                                        <a href="#" class="btn btn-primary ml-sm-4 px-5 rounded-0">
                                            PROCEED TO
                                            CHECKOUT
                                        </a>
                                    </div>
                                </form>
                            </div>

                            <div class="col-xl-4 col-lg-5 mt-5 mt-lg-0 col-md-7 mx-md-auto">
                                <div data-toggle="sticky" data-sticky-offset="30">
                                    <div class="card shadow-none border-primary rounded-0" id="card-summary">

                                        <div class="bg-primary card-header py-3 rounded-0">
                                            <div class="row align-items-center">
                                                <h3 class="font-weight-300 mb-0 ml-3 text-white">Summary</h3>
                                            </div>
                                        </div>

                                        <div class="card-body p-0">

                                            <div class="border-bottom border-primary m-0 py-3 row">
                                                <div class="col-7">
                                                    <div class="media align-items-center">
                                                        <img alt="Image placeholder" class="mr-2"
                                                            src="./assets/img/google-assistant.png" style="width: 42px;">
                                                        <div class="media-body ml-2">
                                                            <div class="sum-title lh-100">
                                                                <h6 class="mb-0 font-weight-300 text-primary">APPLE TEA
                                                                </h6>
                                                                <p
                                                                    class="font-size-12 font-weight-300 mb-0 text-primary">
                                                                    with orange petals</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="align-items-center col-5 d-flex justify-content-between lh-100">
                                                    <div>
                                                        <small class="text-primary">Price</small>
                                                        <h5 class="font-weight-500 mb-0 text-primary">$12.90</h5>
                                                    </div>
                                                    <span>
                                                        <a href="#">
                                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M13.7722 1.32775C14.0759 1.02401 14.0759 0.531547 13.7722 0.227806C13.4685 -0.0759353 12.976 -0.0759353 12.6722 0.227806L7 5.90006L1.32775 0.227806C1.02401 -0.0759353 0.531548 -0.0759353 0.227807 0.227806C-0.075934 0.531547 -0.075934 1.02401 0.227807 1.32775L5.90006 7L0.227806 12.6723C-0.0759353 12.976 -0.0759353 13.4685 0.227806 13.7722C0.531547 14.0759 1.02401 14.0759 1.32775 13.7722L7 8.09994L12.6722 13.7722C12.976 14.0759 13.4685 14.0759 13.7722 13.7722C14.0759 13.4685 14.0759 12.976 13.7722 12.6723L8.09994 7L13.7722 1.32775Z"
                                                                    fill="#615144" />
                                                            </svg>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="border-bottom border-primary m-0 py-3 row">
                                                <div class="col-7">
                                                    <div class="media align-items-center">
                                                        <img alt="Image placeholder" class="mr-2"
                                                            src="./assets/img/google-assistant.png" style="width: 42px;">
                                                        <div class="media-body ml-2">
                                                            <div class="sum-title lh-100">
                                                                <h6 class="mb-0 font-weight-300 text-primary">APPLE TEA
                                                                </h6>
                                                                <p
                                                                    class="font-size-12 font-weight-300 mb-0 text-primary">
                                                                    with orange petals</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="align-items-center col-5 d-flex justify-content-between lh-100">
                                                    <div>
                                                        <small class="text-primary">Price</small>
                                                        <h5 class="font-weight-500 mb-0 text-primary">$12.90</h5>
                                                    </div>
                                                    <span>
                                                        <a href="#">
                                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M13.7722 1.32775C14.0759 1.02401 14.0759 0.531547 13.7722 0.227806C13.4685 -0.0759353 12.976 -0.0759353 12.6722 0.227806L7 5.90006L1.32775 0.227806C1.02401 -0.0759353 0.531548 -0.0759353 0.227807 0.227806C-0.075934 0.531547 -0.075934 1.02401 0.227807 1.32775L5.90006 7L0.227806 12.6723C-0.0759353 12.976 -0.0759353 13.4685 0.227806 13.7722C0.531547 14.0759 1.02401 14.0759 1.32775 13.7722L7 8.09994L12.6722 13.7722C12.976 14.0759 13.4685 14.0759 13.7722 13.7722C14.0759 13.4685 14.0759 12.976 13.7722 12.6723L8.09994 7L13.7722 1.32775Z"
                                                                    fill="#615144" />
                                                            </svg>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Subtotal -->
                                            <div class="border-0 m-0 py-3 row">
                                                <div class="col-7">
                                                    <p class="lh-1 mb-0 text-sm">Tax</p>
                                                    <p class="font-size-12 mb-0">SGST 5% (6.45)</p>
                                                </div>
                                                <div
                                                    class="align-items-center col-5 d-flex justify-content-between lh-100">
                                                    <div>
                                                        <small class="text-primary">Price</small>
                                                        <h5 class="font-weight-500 mb-0 text-primary">$12.90</h5>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <a href="#"
                                                        class="btn btn-block btn-primary mt-4 rounded-0">PROCEED TO
                                                        CHECKOUT</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane" data-id="tab3">
                        <div class="row mt-5">
                            <div class="col-xl-8 col-lg-7">
                                <form>
                                    <div class="card">
                                        <div class="border border-primary border-sm box-space rounded-0 shadow-none">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4 col-sm-5">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="radio" class="custom-control-input"
                                                            name="radio-payment" id="radio-payment-cash">
                                                        <label class="custom-control-label h6 mb-0 lh-180"
                                                            for="radio-payment-cash">Cash On Delivery </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-5">
                                                    <p class="text-muted mt-2 mb-0 text-small">Cash on delivery is a type
                                                        of
                                                        transaction in which payment for a good is made at the time of
                                                        delivery.
                                                    </p>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 text-right">
                                                    <svg width="26" height="24" viewBox="0 0 26 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M0 2.52632C0 1.13107 1.16406 0 2.6 0H7.8H14.3H15.6H23.4C24.118 0 24.7 0.565535 24.7 1.26316C24.7 1.96078 24.118 2.52632 23.4 2.52632H22.1257L23.2771 8.12006C23.4862 8.27991 23.6713 8.47196 23.8241 8.69186L25.555 11.1835C25.845 11.601 26 12.0932 26 12.5969V18.9474C26 20.3426 24.8359 21.4737 23.4 21.4737H22.9621C22.2319 22.9673 20.6651 24 18.85 24C17.0349 24 15.4681 22.9673 14.7379 21.4737H14.3H9.96214C9.23189 22.9673 7.66506 24 5.85 24C3.96665 24 2.35056 22.8882 1.65902 21.3032C0.688193 20.9368 0 20.0202 0 18.9474V2.52632ZM15.6 2.52632H19.4998C19.4998 2.60801 19.5081 2.69089 19.5252 2.77404L20.5143 7.57895H15.6V2.52632ZM13 2.52632H7.8L7.79955 2.52632H2.6V11.3684H13V2.52632ZM13 13.8947H2.6V16.4849C3.42584 15.666 4.57685 15.1579 5.85 15.1579C8.14221 15.1579 10.0385 16.8049 10.3539 18.9474H13V13.8947ZM15.6 16.4849C16.4258 15.666 17.5769 15.1579 18.85 15.1579C21.1422 15.1579 23.0385 16.8049 23.3539 18.9474H23.4V12.5969L21.6691 10.1053H15.6V16.4849ZM16.9 19.5789C16.9 18.5325 17.773 17.6842 18.85 17.6842C19.927 17.6842 20.8 18.5325 20.8 19.5789C20.8 20.6254 19.927 21.4737 18.85 21.4737C17.773 21.4737 16.9 20.6254 16.9 19.5789ZM5.85 17.6842C4.77304 17.6842 3.9 18.5325 3.9 19.5789C3.9 20.6254 4.77304 21.4737 5.85 21.4737C6.92696 21.4737 7.8 20.6254 7.8 19.5789C7.8 18.5325 6.92696 17.6842 5.85 17.6842Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card rounded-0 border-0 shadow">
                                        <div class="box-space">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-5">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="radio" class="custom-control-input"
                                                            name="radio-payment" id="radio-payment-card">
                                                        <label class="custom-control-label h6 mb-0 lh-180"
                                                            for="radio-payment-card">Credit Card (Strip)</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <p class="text-muted mt-2 mb-0 text-small">Safe money transfer using
                                                        your
                                                        bank account. We support Mastercard, Visa, Maestro and Skrill.</p>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-2 text-right">
                                                    <span>
                                                        <svg width="89" height="48" viewBox="0 0 89 48"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <rect x="32.0723" y="22.4502" width="56.9279"
                                                                height="24.8559" fill="url(#pattern0)" />
                                                            <rect width="86.5946" height="21.6486"
                                                                fill="url(#pattern1)" />
                                                            <defs>
                                                                <pattern id="pattern0"
                                                                    patternContentUnits="objectBoundingBox" width="1"
                                                                    height="1">
                                                                    <use xlink:href="#image0_0_1"
                                                                        transform="translate(-0.000782466) scale(0.00156495 0.00358423)" />
                                                                </pattern>
                                                                <pattern id="pattern1"
                                                                    patternContentUnits="objectBoundingBox" width="1"
                                                                    height="1">
                                                                    <use xlink:href="#image1_0_1"
                                                                        transform="translate(0 -0.000705219) scale(0.000705219 0.00282087)" />
                                                                </pattern>
                                                                <image id="image0_0_1" width="640" height="279"
                                                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAoAAAAEXCAYAAAA9RvVFAAAABmJLR0QA/wD/AP+gvaeTAAAgAElEQVR4nO3de5xVdb3/8fdn7bkAgoAoyn32DN7AAWXMyk7GrzStTOv4w1NHK4XZG8Sw9KgwM1qrYvaAeKyso80F5WSWQlnqsbv3zKywU3hDh7mQ4BUFxWEue38/548ZDA2Rgb32Z6+138/HY6vgsL4vhmHPZ6+9LgARERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERERFRyIh1ABER0b66duqi0u2ZHScA8iEAMwAcAWASgAMBFAHoBvCaAG0KXa+QtfDcvbUbVj4ugBqmE5niAEhERKFTH6+eIfCSgJ4DYNTgtyBtgN6oTlbWdTY9l/VAojzHAZCIiEJjaVn1+2KefEUVpyE738N6IFjlJF1/xYYb/56F7RGFAgdAIiLKe6kJF45BSe9yAHMRzPeuN6Dy9d6y8df49/npALZPlFc4ABIRUV5LlVd/HCqrABwS+GKCRwF8trat+enA1yIy5FkHEBERvZNUefICqNyBXAx/AKCYBcUfUhXzPpCT9YiMcAAkIqK81FCeqIHqdQBiOV56NJz36/qyxKk5XpcoZ/gWMBER5Z36ePI/BHq1cUa3B+/UJe2NDxh3EGUdB0AiIsorDWXzT1NxdyEP3qVS4OWimB63uLXlWesWomwy/8tFRES009KJCyaouO8jT74/CXBwJiO3+LP9IusWomziF3Se8qcvHD50e+8kF5MJTnW8qHeYijtQICMB7HwM28MmHIBt//ihdim8HgAQUVVgq+fwqkK2CtxWiPdqBpmtnnhbiyW29Y0hW7b6j6/pDfC3SPvIn+0XDdm4+WjnMAviZql4j9S1Nf3QuosoG7ySzHehOTrhY+99oGTjposAXGMdYqlh8gWj1UvPEJFKhc5Q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" />
                                                                <image id="image1_0_1" width="1418" height="355"
                                                                    xlink:href="data:image/png;base64,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" />
                                                            </defs>
                                                        </svg>

                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mt-3">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label t-gray font-600">Name on
                                                            card</label>
                                                        <input class="form-control" type="text" placeholder="Rafał">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label t-gray font-600">Last Name on
                                                            card</label>
                                                        <input class="form-control" type="text"
                                                            placeholder="Enter Your Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border-0 rounded-0 shadow">
                                        <div class="box-space">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="radio" class="custom-control-input"
                                                            name="radio-payment" id="radio-payment-Paypal">
                                                        <label class="custom-control-label h6 mb-0 lh-180"
                                                            for="radio-payment-Paypal">Paypal</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <p class="text-muted mt-2 mb-0 text-small">Pay your order using the
                                                        most
                                                        known and secure platform for online money transfers. You will be
                                                        redirected to PayPal to finish complete your purchase.</p>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 text-right">
                                                    <img alt="Image placeholder" src="./assets/img/paypa.png"
                                                        width="77" class="ml-2 img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border-0 rounded-0 shadow">
                                        <div class="box-space">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="radio" class="custom-control-input"
                                                            name="radio-payment" id="radio-payment-Whatsapp">
                                                        <label class="custom-control-label h6 mb-0 lh-180"
                                                            for="radio-payment-Whatsapp">Whatsapp</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <p class="text-muted mt-2 mb-0 text-small">Click to chat. The click to
                                                        chat
                                                        feature lets customers click an URL in order to directly start a
                                                        chat
                                                        with another person or business via WhatsApp. ... QR code. As you
                                                        know,
                                                        having to add a phone number to your contacts in order to start up a
                                                        WhatsApp message can take a little while. ....</p>
                                                </div>
                                                <div class="col-md-3 col-md-3 col-sm-3 text-right">
                                                    <img alt="Image placeholder" src="./assets/img/whatsapp-logo.png"
                                                        width="130" class="ml-2 img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-space bg-translucent-neutral">
                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label t-gray font-600">Name on
                                                            card</label>
                                                        <input class="form-control border-primary text-primary"
                                                            type="text" placeholder="Enter phone Number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card border-0 rounded-0 shadow">
                                        <div class="box-space">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 col-sm-5">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="radio" class="custom-control-input"
                                                            name="radio-payment" id="radio-payment-Direct">
                                                        <label class="custom-control-label h6 mb-0 lh-180"
                                                            for="radio-payment-Direct">Direct Bank Transfer</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-5">
                                                    <p class="text-muted mt-2 mb-0 text-small">Bank: UNITED COMMUNITY BANK
                                                        <br>Bank Account Number: 67265159299
                                                    </p>
                                                    <p class="text-muted mt-2 mb-0 text-small">Routing Number:
                                                        71119865<br>IBAN: IN97350997896859414902082924</p>
                                                </div>
                                                <div class="col-md-2 col-sm-2 text-right">
                                                    <img alt="Image placeholder" src="./assets/img/direct-icon.png"
                                                        width="36" class="ml-2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mt-sm-4 text-center text-sm-right">
                                        <a href="shop-landing.html" class="text-primary">Return to shop</a>
                                        <a href="#" class="btn btn-primary ml-4 px-5 rounded-0">PROCEED TO
                                            CHECKOUT</a>
                                    </div>
                                </form>
                            </div>

                            <div class="col-xl-4 col-lg-5 mt-5 mt-lg-0 col-md-7 mx-md-auto">
                                <div data-toggle="sticky" data-sticky-offset="30">
                                    <div class="card shadow-none border-primary rounded-0" id="card-summary">

                                        <div class="bg-primary card-header py-3 rounded-0">
                                            <div class="row align-items-center">
                                                <h3 class="font-weight-300 mb-0 ml-3 text-white">Summary</h3>
                                            </div>
                                        </div>

                                        <div class="card-body p-0">

                                            <div class="border-bottom border-primary m-0 py-3 row">
                                                <div class="col-7">
                                                    <div class="media align-items-center">
                                                        <img alt="Image placeholder" class="mr-2"
                                                            src="./assets/img/google-assistant.png" style="width: 42px;">
                                                        <div class="media-body ml-2">
                                                            <div class="sum-title lh-100">
                                                                <h6 class="mb-0 font-weight-300 text-primary">APPLE TEA
                                                                </h6>
                                                                <p
                                                                    class="font-size-12 font-weight-300 mb-0 text-primary">
                                                                    with orange petals</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="align-items-center col-5 d-flex justify-content-between lh-100">
                                                    <div>
                                                        <small class="text-primary">Price</small>
                                                        <h5 class="font-weight-500 mb-0 text-primary">$12.90</h5>
                                                    </div>
                                                    <span>
                                                        <a href="#">
                                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M13.7722 1.32775C14.0759 1.02401 14.0759 0.531547 13.7722 0.227806C13.4685 -0.0759353 12.976 -0.0759353 12.6722 0.227806L7 5.90006L1.32775 0.227806C1.02401 -0.0759353 0.531548 -0.0759353 0.227807 0.227806C-0.075934 0.531547 -0.075934 1.02401 0.227807 1.32775L5.90006 7L0.227806 12.6723C-0.0759353 12.976 -0.0759353 13.4685 0.227806 13.7722C0.531547 14.0759 1.02401 14.0759 1.32775 13.7722L7 8.09994L12.6722 13.7722C12.976 14.0759 13.4685 14.0759 13.7722 13.7722C14.0759 13.4685 14.0759 12.976 13.7722 12.6723L8.09994 7L13.7722 1.32775Z"
                                                                    fill="#615144" />
                                                            </svg>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="border-bottom border-primary m-0 py-3 row">
                                                <div class="col-7">
                                                    <div class="media align-items-center">
                                                        <img alt="Image placeholder" class="mr-2"
                                                            src="./assets/img/google-assistant.png" style="width: 42px;">
                                                        <div class="media-body ml-2">
                                                            <div class="sum-title lh-100">
                                                                <h6 class="mb-0 font-weight-300 text-primary">APPLE TEA
                                                                </h6>
                                                                <p
                                                                    class="font-size-12 font-weight-300 mb-0 text-primary">
                                                                    with orange petals</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="align-items-center col-5 d-flex justify-content-between lh-100">
                                                    <div>
                                                        <small class="text-primary">Price</small>
                                                        <h5 class="font-weight-500 mb-0 text-primary">$12.90</h5>
                                                    </div>
                                                    <span>
                                                        <a href="#">
                                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M13.7722 1.32775C14.0759 1.02401 14.0759 0.531547 13.7722 0.227806C13.4685 -0.0759353 12.976 -0.0759353 12.6722 0.227806L7 5.90006L1.32775 0.227806C1.02401 -0.0759353 0.531548 -0.0759353 0.227807 0.227806C-0.075934 0.531547 -0.075934 1.02401 0.227807 1.32775L5.90006 7L0.227806 12.6723C-0.0759353 12.976 -0.0759353 13.4685 0.227806 13.7722C0.531547 14.0759 1.02401 14.0759 1.32775 13.7722L7 8.09994L12.6722 13.7722C12.976 14.0759 13.4685 14.0759 13.7722 13.7722C14.0759 13.4685 14.0759 12.976 13.7722 12.6723L8.09994 7L13.7722 1.32775Z"
                                                                    fill="#615144" />
                                                            </svg>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Subtotal -->
                                            <div class="border-0 m-0 py-3 row">
                                                <div class="col-7">
                                                    <p class="lh-1 mb-0 text-sm">Tax</p>
                                                    <p class="font-size-12 mb-0">SGST 5% (6.45)</p>
                                                </div>
                                                <div
                                                    class="align-items-center col-5 d-flex justify-content-between lh-100">
                                                    <div>
                                                        <small class="text-primary">Price</small>
                                                        <h5 class="font-weight-500 mb-0 text-primary">$12.90</h5>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <a href="#"
                                                        class="btn btn-block btn-primary mt-4 rounded-0">PROCEED TO
                                                        CHECKOUT</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </section>
    @else
        <div class="wrapper">
            <section class="empty-card-section">
                <div class="container">
                    <div class="empty-card-main">
                        <div class="img-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                id="8fc77738-ee79-4216-bfe1-e1f5c470859a" data-name="Layer 1" width="1015.56"
                                height="783.53" viewBox="0 0 1015.56 783.53" class="injected-svg svg-inject img-fluid">
                                <defs>
                                    <linearGradient id="55e18adb-5a4b-48dc-a3c1-f250c98f7014-0" x1="535.54"
                                        y1="705.46" x2="535.54" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="gray" stop-opacity="0.25"></stop>
                                        <stop offset="0.54" stop-color="gray" stop-opacity="0.12"></stop>
                                        <stop offset="1" stop-color="gray" stop-opacity="0.1"></stop>
                                    </linearGradient>
                                    <linearGradient id="dcaa3d52-8271-46b6-bbc0-03906cb73c47-0" x1="237.19"
                                        y1="818.89" x2="237.19" y2="359.58"
                                        xlink:href="#55e18adb-5a4b-48dc-a3c1-f250c98f7014"></linearGradient>
                                </defs>
                                <title>online shopping</title>
                                <path
                                    d="M729.3,184.55c-42.28,26.74-97.12,25-145.17,11.1s-92.2-38.69-139-56.3A490.89,490.89,0,0,0,323,110.59c-59.67-6.17-126.3,1.34-167.88,44.57-46.3,48.15-42.75,135,7.33,179.18,25.47,22.48,58.83,33.51,87.92,51.06s56,46.7,53.53,80.58c-2.29,31.36-28.95,55.43-56.54,70.53-21.33,11.67-47.6,24.41-50.17,48.58-2.48,23.39,19.6,41.72,40.69,52.14,68.8,34,153.56,33.67,222.09-.86,24.45-12.32,46.93-28.7,72.57-38.3,67.33-25.21,141.51.17,212.8,9.45a469.33,469.33,0,0,0,181-11.91c35.3-9.42,70.74-23.82,95.54-50.65,17.88-19.35,29-43.83,39.49-68q16.73-38.68,32.16-77.9c6.18-15.7,12.26-31.7,13.85-48.5,2.89-30.43-9.28-60.51-25.87-86.2C1042.11,203.37,975.8,160.49,904,149.6S756.21,160,700.51,206.53"
                                    transform="translate(-92.22 -58.23)" class="fill-primary" opacity="0.1"></path>
                                <ellipse cx="135.74" cy="756.99" rx="135.74" ry="26.54"
                                    class="fill-primary" opacity="0.1"></ellipse>
                                <ellipse cx="538.99" cy="701.56" rx="284.54" ry="26.54"
                                    class="fill-primary" opacity="0.1"></ellipse>
                                <path
                                    d="M824.35,570.83s39.89-70.66,100-91c25.21-8.55,47.22-24.62,62.27-46.58A207.22,207.22,0,0,0,1005,400.18"
                                    transform="translate(-92.22 -58.23)" fill="none" stroke="#535461"
                                    stroke-miterlimit="10" stroke-width="2"></path>
                                <path
                                    d="M1042.73,387.12c-6.85,6.64-38.73,13.51-38.73,13.51s7.83-31.65,14.67-38.3a17.27,17.27,0,0,1,24.06,24.79Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M1024.7,444.41c-9.36,1.85-39.85-9.71-39.85-9.71s23.77-22.32,33.12-24.18a17.28,17.28,0,1,1,6.73,33.89Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M959,506.4c-9-3.12-29.5-28.49-29.5-28.49s31.79-7.28,40.8-4.16A17.28,17.28,0,1,1,959,506.4Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M898.79,542.11C889.38,540.56,864.9,519,864.9,519s30.1-12.54,39.51-11a17.27,17.27,0,1,1-5.62,34.08Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M958.26,410c0,9.54,17.26,37.21,17.26,37.21s17.28-27.66,17.29-37.2a17.28,17.28,0,0,0-34.55,0Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M888.34,452.63c2.85,9.1,27.59,30.34,27.59,30.34s8.22-31.56,5.37-40.66a17.27,17.27,0,1,0-33,10.32Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M826.06,503.42c1.27,9.46,22.08,34.57,22.08,34.57s13.43-29.71,12.16-39.17a17.27,17.27,0,1,0-34.24,4.6Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M1042.73,387.12c-6.85,6.64-38.73,13.51-38.73,13.51s7.83-31.65,14.67-38.3a17.27,17.27,0,0,1,24.06,24.79Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.25"></path>
                                <path
                                    d="M1024.7,444.41c-9.36,1.85-39.85-9.71-39.85-9.71s23.77-22.32,33.12-24.18a17.28,17.28,0,1,1,6.73,33.89Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.25"></path>
                                <path
                                    d="M959,506.4c-9-3.12-29.5-28.49-29.5-28.49s31.79-7.28,40.8-4.16A17.28,17.28,0,1,1,959,506.4Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.25"></path>
                                <path
                                    d="M898.79,542.11C889.38,540.56,864.9,519,864.9,519s30.1-12.54,39.51-11a17.27,17.27,0,1,1-5.62,34.08Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.25"></path>
                                <path
                                    d="M958.26,410c0,9.54,17.26,37.21,17.26,37.21s17.28-27.66,17.29-37.2a17.28,17.28,0,0,0-34.55,0Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.25"></path>
                                <path
                                    d="M888.34,452.63c2.85,9.1,27.59,30.34,27.59,30.34s8.22-31.56,5.37-40.66a17.27,17.27,0,1,0-33,10.32Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.25"></path>
                                <path
                                    d="M826.06,503.42c1.27,9.46,22.08,34.57,22.08,34.57s13.43-29.71,12.16-39.17a17.27,17.27,0,1,0-34.24,4.6Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.25"></path>
                                <path
                                    d="M826.65,569.42s7.83-80.76,54.49-123.71a123,123,0,0,0,38.06-67.82,207,207,0,0,0,3.4-37.66"
                                    transform="translate(-92.22 -58.23)" fill="none" stroke="#535461"
                                    stroke-miterlimit="10" stroke-width="2"></path>
                                <path
                                    d="M951.85,313c-3.57,8.85-29.93,28-29.93,28s-5.68-32.11-2.11-41a17.27,17.27,0,0,1,32,12.91Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M958.57,372.66c-7.8,5.49-40.36,7.28-40.36,7.28s12.69-30,20.49-35.53a17.27,17.27,0,0,1,19.87,28.25Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M923.66,455.94c-9.5.8-38.51-14.09-38.51-14.09s26.11-19.53,35.62-20.33a17.27,17.27,0,1,1,2.89,34.42Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M883.06,513c-9.23,2.39-40.34-7.38-40.34-7.38s22.44-23.67,31.67-26.06A17.27,17.27,0,0,1,883.06,513Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M883.88,368.1c3.87,8.72,30.86,27,30.86,27s4.59-32.28.73-41a17.27,17.27,0,0,0-31.59,14Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M837.24,435.44c6.3,7.16,37.53,16.55,37.53,16.55s-5.28-32.18-11.57-39.35a17.28,17.28,0,0,0-26,22.8Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M800.89,507.11c5,8.13,34.19,22.66,34.19,22.66s.24-32.61-4.75-40.74a17.27,17.27,0,1,0-29.44,18.08Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <polygon
                                    points="281.84 0 281.84 27.38 281.84 705.46 789.24 705.46 789.24 27.38 789.24 0 281.84 0"
                                    fill="url(#55e18adb-5a4b-48dc-a3c1-f250c98f7014-0)"></polygon>
                                <rect x="286.29" y="6.19" width="498.5" height="26.89" fill="#f6f7f9">
                                </rect>
                                <g opacity="0.2">
                                    <rect x="286.29" y="6.19" width="498.5" height="26.89"
                                        class="fill-primary"></rect>
                                </g>
                                <rect x="286.29" y="33.08" width="498.5" height="666.19" fill="#f6f7f9">
                                </rect>
                                <circle cx="299.4" cy="19.63" r="4.56" fill="#f6f7f9"></circle>
                                <circle cx="311.76" cy="19.63" r="4.56" fill="#f6f7f9"></circle>
                                <circle cx="324.12" cy="19.63" r="4.56" fill="#f6f7f9"></circle>
                                <g opacity="0.2">
                                    <rect x="375.26" y="74.15" width="320.55" height="12.55"
                                        class="fill-primary"></rect>
                                </g>
                                <rect x="653.22" y="74.15" width="42.59" height="12.55" class="fill-primary">
                                </rect>
                                <g opacity="0.2">
                                    <rect x="329.32" y="330.62" width="201.72" height="144.49"
                                        class="fill-primary" opacity="0.2"></rect>
                                </g>
                                <g opacity="0.2">
                                    <rect x="329.32" y="143.19" width="201.72" height="144.49"
                                        class="fill-primary" opacity="0.2"></rect>
                                </g>
                                <g opacity="0.2">
                                    <rect x="329.32" y="515.61" width="201.72" height="144.49"
                                        class="fill-primary" opacity="0.2"></rect>
                                </g>
                                <g opacity="0.2">
                                    <rect x="540.04" y="330.62" width="201.72" height="144.49"
                                        class="fill-primary" opacity="0.2"></rect>
                                </g>
                                <g opacity="0.2">
                                    <rect x="540.04" y="143.19" width="201.72" height="144.49"
                                        class="fill-primary" opacity="0.2"></rect>
                                </g>
                                <g opacity="0.2">
                                    <rect x="540.04" y="515.61" width="201.72" height="144.49"
                                        class="fill-primary" opacity="0.2"></rect>
                                </g>
                                <path
                                    d="M1023.79,692.73s7.14,9.33-3.29,23.41-19,26-15.55,34.76c0,0,15.73-26.16,28.54-26.52S1037.88,708.46,1023.79,692.73Z"
                                    transform="translate(-92.22 -58.23)" fill="#3acc6c"></path>
                                <path
                                    d="M1023.79,692.73a11.49,11.49,0,0,1,1.46,2.92c12.5,14.68,19.15,28.38,7.14,28.73-11.18.32-24.61,20.32-27.82,25.37a11.06,11.06,0,0,0,.38,1.15s15.73-26.16,28.54-26.52S1037.88,708.46,1023.79,692.73Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M1037.06,704.62c0,3.28-.37,5.94-.82,5.94s-.83-2.66-.83-5.94.46-1.74.92-1.74S1037.06,701.33,1037.06,704.62Z"
                                    transform="translate(-92.22 -58.23)" fill="#ffd037"></path>
                                <path
                                    d="M1041.61,708.54c-2.88,1.57-5.4,2.52-5.61,2.12s1.94-2,4.82-3.57,1.75-.42,2,0S1044.49,707,1041.61,708.54Z"
                                    transform="translate(-92.22 -58.23)" fill="#ffd037"></path>
                                <path
                                    d="M986.11,692.73s-7.14,9.33,3.29,23.41,19,26,15.55,34.76c0,0-15.73-26.16-28.54-26.52S972,708.46,986.11,692.73Z"
                                    transform="translate(-92.22 -58.23)" fill="#3acc6c"></path>
                                <path
                                    d="M986.11,692.73a11.49,11.49,0,0,0-1.46,2.92c-12.5,14.68-19.15,28.38-7.14,28.73,11.19.32,24.61,20.32,27.82,25.37a9.11,9.11,0,0,1-.38,1.15s-15.73-26.16-28.54-26.52S972,708.46,986.11,692.73Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M972.84,704.62c0,3.28.37,5.94.83,5.94s.82-2.66.82-5.94-.46-1.74-.91-1.74S972.84,701.33,972.84,704.62Z"
                                    transform="translate(-92.22 -58.23)" fill="#ffd037"></path>
                                <path
                                    d="M968.29,708.54c2.89,1.57,5.4,2.52,5.62,2.12s-1.95-2-4.83-3.57-1.75-.42-2,0S965.41,707,968.29,708.54Z"
                                    transform="translate(-92.22 -58.23)" fill="#ffd037"></path>
                                <ellipse cx="912.73" cy="752.6" rx="74.6" ry="11.45"
                                    class="fill-primary" opacity="0.1"></ellipse>
                                <path
                                    d="M1043.35,738.33l-.36,2.91-.5,4.12-.21,1.71-.5,4.12-.22,1.72-.5,4.11-5.71,46.8c-.51,4.18-7.33,7.43-15.57,7.43H990.12c-8.24,0-15-3.25-15.56-7.43L968.84,757l-.5-4.11-.21-1.72-.51-4.12-.21-1.71-.5-4.12-.36-2.91C966.27,736,970,734,974.62,734h60.67C1039.94,734,1043.64,736,1043.35,738.33Z"
                                    transform="translate(-92.22 -58.23)" fill="#65617d"></path>
                                <polygon points="950.77 683.01 950.27 687.12 875.19 687.12 874.69 683.01 950.77 683.01"
                                    fill="#9d9cb5"></polygon>
                                <polygon points="950.06 688.84 949.56 692.96 875.91 692.96 875.4 688.84 950.06 688.84"
                                    fill="#9d9cb5"></polygon>
                                <polygon points="949.34 694.67 948.84 698.79 876.62 698.79 876.12 694.67 949.34 694.67"
                                    fill="#9d9cb5"></polygon>
                                <path
                                    d="M683.83,229.34s-1.83-4.57,10.51-3.43,47.77,5.08,63.09,1.63,24.45-4.55,23.54,0-26.51,14.83-26.51,14.83l-33.15,3.43-24.45-3.89-13.13-7.77Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M781,227.54c-.92,4.55-26.51,14.83-26.51,14.83l-33.15,3.43-24.45-3.88-13.12-7.77.09-4.8a2,2,0,0,1,.7-2.21c1.13-1,3.77-1.78,9.81-1.22,12.35,1.14,47.77,5.07,63.09,1.62,12.48-2.81,20.86-4.06,23-2A2,2,0,0,1,781,227.54Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M800.7,296.77a143.09,143.09,0,0,0-58.82,26.05,10.91,10.91,0,0,0-4.69-5.57,16.47,16.47,0,0,0-4.76-2c-1.53-.39-3,.54-4.35,1.88a24.63,24.63,0,0,0-3.87,5.73c-23.31-16-58.67-26.21-58.67-26.21v-3.2c0-.63.11-1.39.23-2.25s.27-1.62.46-2.55c3-15.26,14.86-50.13,14.86-50.13h3.67l9.74,0,26,5.4,29.25-1.79L779.21,236l3.82-.8c6.37,5,13.6,40,16.44,54.9.36,1.89.64,3.45.85,4.6C800.57,296,800.7,296.77,800.7,296.77Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M670.38,290.16c.77-14.65,12.41-46.4,14.38-51.67h-3.67s-12.56,37-15.11,51.44a.36.36,0,0,0,0,.11c-.07.39-.14.77-.19,1.13-.12.86-.2,1.62-.23,2.25v3.2s35.36,10.22,58.67,26.21a24.63,24.63,0,0,1,3.87-5.73C719.19,309,685.4,295.8,670.38,290.16Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M800.32,294.66c-.09-.51-.2-1.1-.32-1.75-.15-.84-.33-1.79-.53-2.85h0c-2.84-14.92-10.07-49.93-16.44-54.9l-3.82.8c2.32,6.23,17.27,46.91,16,54.85-25,5-50.34,21.25-58,26.44a10.91,10.91,0,0,1,4.69,5.57,143.09,143.09,0,0,1,58.82-26.05S800.57,296,800.32,294.66Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M671.3,289.24c.76-14.65,12.41-46.4,14.38-51.66H682s-12.56,37-15.11,51.43c0,0,0,.08,0,.11q-.11.6-.18,1.14c-.12.86-.2,1.62-.23,2.25v3.2s35.35,10.21,58.67,26.21a24.21,24.21,0,0,1,3.86-5.73C720.1,308.11,686.32,294.88,671.3,289.24Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M670.38,290.16c.77-14.65,12.41-46.4,14.38-51.67h-3.67s-12.56,37-15.11,51.44a.36.36,0,0,0,0,.11c-.07.39-.14.77-.19,1.13-.12.86-.2,1.62-.23,2.25v3.2s35.36,10.22,58.67,26.21a24.63,24.63,0,0,1,3.87-5.73C719.19,309,685.4,295.8,670.38,290.16Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M799.41,293.74l-.32-1.75c-.16-.84-.33-1.78-.53-2.85h0c-2.83-14.91-10.07-49.92-16.44-54.9l-3.81.81c2.32,6.23,17.27,46.91,16,54.85-25,5-50.35,21.25-58,26.43a10.93,10.93,0,0,1,4.69,5.58,142.94,142.94,0,0,1,58.81-26.06S799.66,295.1,799.41,293.74Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M800.32,294.66c-.09-.51-.2-1.1-.32-1.75-.15-.84-.33-1.79-.53-2.85h0c-2.84-14.92-10.07-49.93-16.44-54.9l-3.82.8c2.32,6.23,17.27,46.91,16,54.85-25,5-50.34,21.25-58,26.44a10.91,10.91,0,0,1,4.69,5.57,143.09,143.09,0,0,1,58.82-26.05S800.57,296,800.32,294.66Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path d="M679.07,256.57s23.2,14.6,28.62-6.78l5.16,1.38s1.7,23.69-35.32,10.17Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M679.07,254.74s23.2,14.6,28.62-6.78l5.16,1.38s1.7,23.69-35.32,10.17Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path d="M752.07,250.48s3,17.47,34.79,9l-1.12-3.3s-21.71,9-29.58-6.63Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M752.07,248.65s3,17.47,34.79,9l-1.12-3.3s-21.71,9-29.58-6.63Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path d="M730.91,250.25v36.46h5.64s7.8-2.81,7.62-19.2-1.37-20.8-1.37-20.8Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M730,249.34V285.8h5.64s7.8-2.81,7.62-19.2-1.38-20.8-1.38-20.8Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M783,237c-2.3,4.28-23.18,11.31-26.87,12.52l-.56.18s-1.32.34-3.53.8c-6.72,1.4-21.7,4-33,1.72-1.64-.32-3.34-.67-5.07-1l-4-.87c-13-2.89-26.45-6.67-28.84-10,0,0,.65-10.87,2.84-10.58s26.64,10.58,26.64,10.58l.35.05c.63.08,2.06.26,4.07.49,7.94.87,24.67,2.25,33.67-.16.43-.12.83-.24,1.22-.38.68-.23,1.39-.47,2.12-.74,11.58-4.1,28.92-11.44,28.92-11.44S785.54,232.29,783,237Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M781,227.54c-.92,4.55-26.51,14.83-26.51,14.83l-33.15,3.43-24.45-3.88-13.12-7.77.09-4.8a2,2,0,0,1,.7-2.21c4.35,1.32,26,10.43,26,10.43l.35.05c.63.08,2.06.26,4.07.49,7.94.87,24.67,2.25,33.67-.16.43-.12.83-.24,1.22-.38.68-.22,1.39-.47,2.12-.74,10.47-3.71,25.66-10.07,28.47-11.25A2,2,0,0,1,781,227.54Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M783,235.16c-2.3,4.28-23.18,11.3-26.87,12.51l-.56.19s-1.32.33-3.53.79c-6.72,1.4-21.7,4-33,1.72-1.64-.32-3.34-.67-5.07-1l-4-.87c-13-2.89-26.45-6.67-28.84-10,0,0,.65-10.87,2.84-10.57s26.64,10.57,26.64,10.57l.35.05c.63.08,2.06.27,4.07.49,7.94.87,24.67,2.25,33.67-.16.43-.12.83-.24,1.22-.38.68-.22,1.39-.47,2.12-.74,11.58-4.1,28.92-11.44,28.92-11.44S785.54,230.47,783,235.16Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <circle cx="642.65" cy="188.48" r="3.66" opacity="0.1"></circle>
                                <circle cx="642.65" cy="187.56" r="3.66" class="fill-primary"></circle>
                                <path d="M715.9,239l-1,10.32-4-.87,1-9.94C712.46,238.61,713.9,238.8,715.9,239Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M715,239l-1,10.32-4-.87,1-9.94C711.55,238.61,713,238.8,715,239Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M755.24,247.67l-.56.19s-1.31.33-3.53.79l-3.41-9.79c.43-.12.84-.24,1.23-.38.68-.22,1.39-.47,2.12-.74Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M756.16,247.67l-.56.19s-1.32.33-3.53.79l-3.41-9.79c.43-.12.83-.24,1.22-.38.68-.22,1.39-.47,2.12-.74Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <g opacity="0.5">
                                    <path
                                        d="M498.24,221a26.4,26.4,0,0,1,13.29,3.69s12.18,1.48,18.82,0,10-6.64,11.26-5.17,1.29,15.32,1.29,15.32l-5.72,15.32-12.92,9.59-20.48-5.9L497,236.52Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <path
                                        d="M542.9,234.86l-5.72,15.32-12.92,9.59-20.48-5.9L497,236.52l1.29-15.5h.3a27.12,27.12,0,0,1,13,3.7s12.18,1.48,18.82,0c6.31-1.4,9.63-6.14,11-5.34h0a.62.62,0,0,1,.21.16C542.9,221,542.9,234.86,542.9,234.86Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M542.9,234.86l-5.72,15.32-12.92,9.59-20.48-5.9L497,236.52l1.29-15.5h.3c1.14,4.89,6,20.33,21.48,21.42,15.92,1.11,20.44-17.83,21.38-23.05a.62.62,0,0,1,.21.16C542.9,221,542.9,234.86,542.9,234.86Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M498.24,221s3.32,21.59,21.78,22.88,21.59-24.36,21.59-24.36,26.76,8.77,33,24.41,10.89,28.19,10.89,28.19-2,3.5-4.25,3.87-17.53,10.89-17.53,10.89-.18,29.9,1.48,31.74,1.11,9.78-3.88,9.41-39.49-8.12-69-1.66c0,0-12.36,4.43-12-2.77s.92-35.43.92-35.43-18.64-8.12-19.74-8.12-3.88-1.46-.93-6.27,6.65-21.22,6.65-21.22S474.62,229,498.24,221Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <path d="M555.63,259.77s5.54,4.06,4.25,7.2S555.63,259.77,555.63,259.77Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path d="M563.75,263.67a10,10,0,0,0,0,5.51" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M567.44,273.8s.74,5-1.47,5.53" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M492.15,258.48s-10.33,9-6.83,12.55" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M485.69,280.26s-.17,9.41,2.68,10.15" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M515.4,311.81s7-4.79,8.86-4.61" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M522.4,316.8s7.58-5.36,9.61-5" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                </g>
                                <g opacity="0.5">
                                    <path d="M687,402.65s60.38,2.86,90.4,1.1l-.66,7.92-53.12,7-15.72-4.84Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <path
                                        d="M777.44,403.75l-.66,7.92-53.11,7-15.73-4.84L687,402.65s1.24.07,3.45.16h0c13.1.57,60.27,2.41,86.17,1Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M798.34,516.37c-11.66,7-52.13.22-52.13.22l-11.22-40-12.54,40.69c-17.81,6.38-54.55-2.86-54.55-2.86l14.3-88,2.47-12.13L687,402.65l22.66,6.82s6.81,4.62,35.19,3.3,32.55-9,32.55-9c1.25.36,2.44,4.77,3.64,10.25,1.74,8,3.51,18.26,5.6,21.65C790.2,441.37,798.34,516.37,798.34,516.37Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <path
                                        d="M781.08,414.88C755.78,428.77,734,428.39,734,428.39c-5.39.66-49.33-13.23-49.33-13.23L687,403.53l22.66,6.82s6.81,4.62,35.19,3.3,32.55-9,32.55-9C778.69,405,779.88,409.4,781.08,414.88Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M777.44,403.75l-.66,7.92-53.11,7-15.73-4.84L687,402.65s1.24.07,3.45.16h0l19.2,5.78s6.81,4.62,35.19,3.3c22.29-1,29.65-6,31.78-8.09Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M781.08,414C755.78,427.89,734,427.51,734,427.51c-5.39.66-49.33-13.23-49.33-13.23L687,402.65l22.66,6.82s6.81,4.62,35.19,3.3,32.55-9,32.55-9C778.69,404.11,779.88,408.52,781.08,414Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <circle cx="646.07" cy="364.87" r="2.31" opacity="0.1"></circle>
                                    <circle cx="646.07" cy="363.99" r="2.31" fill="none"
                                        class="stroke-primary" stroke-miterlimit="10"></circle>
                                    <path d="M679.23,463.58s4.07,12.1,6.93,11.88S679.23,463.58,679.23,463.58Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path d="M676.59,475.46s2.53,7.26,5.17,8.47" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M676.59,483.05s4,5.06,6.37,6.27" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M784,437.3s3.74,5.61,0,6.82" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M785.7,446.42c-4.34-5.15-1.66,7-1.66,7S786.81,447.74,785.7,446.42Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path d="M787.89,452.69s-6.6,9.79-5.28,10.89" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path
                                        d="M700.58,437.51c-8.09,0-16.53-3.66-17-3.88l.36-.81c.16.08,16.31,7.09,25.05,1.83,3.3-2,5.15-5.52,5.51-10.5l.88.07c-.38,5.28-2.38,9-5.94,11.18A17,17,0,0,1,700.58,437.51Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M700.58,436.63c-8.09,0-16.53-3.66-17-3.88l.36-.8c.16.07,16.31,7.08,25.05,1.82,3.3-2,5.15-5.52,5.51-10.5l.88.07c-.38,5.28-2.38,9-5.94,11.18A17,17,0,0,1,700.58,436.63Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <path
                                        d="M767,438.17a13.69,13.69,0,0,1-6-1.29c-6.56-3.16-7.62-10.9-7.67-11.23l.88-.11c0,.08,1.05,7.61,7.18,10.55,5.46,2.63,13.21,1,23-5l.45.75C777.87,436.06,771.9,438.17,767,438.17Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M767,437.29a13.69,13.69,0,0,1-6-1.29c-6.56-3.16-7.62-10.9-7.67-11.23l.88-.11c0,.08,1.05,7.61,7.18,10.55,5.46,2.63,13.21,1,23-5l.45.75C777.87,435.18,771.9,437.29,767,437.29Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                </g>
                                <path
                                    d="M503.34,404s11.35,15.85,19.06,14.31,8.47-3.23,15.32-14.31l5.62,12.93-6.62,16-7.84,10.15-16.62-2.61-5.38-18.16Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path
                                    d="M543.34,416.92l-6.62,16-7.84,10.15-16.62-2.61-5.38-18.16L503.34,404s1,1.38,2.56,3.28c3.81,4.55,11.06,12.11,16.5,11,7.6-1.52,8.45-3.19,15.05-13.86l.27-.45Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M543.34,416.92l-6.62,16-7.84,10.15-16.62-2.61-5.38-18.16L503.34,404s1,1.38,2.56,3.28c2.48,8,7.81,20.83,16.5,20.72,9.81-.11,13.77-16.36,15.05-23.55l.27-.45Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M497.34,403.53s-3.85-.46-1.85,4.31,5.69,20.46,3.85,23.69-.92,12-8.92,13.7l2.3,9.07s.46,20-.46,22.93-1.08,19.07-.77,20.76.16,12.77-1.07,13.24-2,5.84,2,6.76,21.07,1.39,24.15,2.31,24.92,0,24.92,0,9.23-1.23,11.54-2,2.77-2.61,2-6.15-4.31-29.23-3.54-32.46.93-34.77.93-34.77-6-2-6-7.85-2.31-21.54,2.46-31.38c0,0-3.85-2.64-4.46-2.17S538,402.3,538,402.3s-3,26.77-15.55,26.92-18.14-26.92-18.14-26.92S504.42,399.84,497.34,403.53Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path d="M515.49,489.38s2.59,6.31,6.91,7.23S515.49,489.38,515.49,489.38Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M511.49,494.3s8.36,6.77,8,8.16" transform="translate(-92.22 -58.23)"
                                    opacity="0.1"></path>
                                <path d="M494.72,454.3s6.62,4.46,6.62,7.69" transform="translate(-92.22 -58.23)"
                                    opacity="0.1"></path>
                                <path d="M499.18,468.3s-1.84-6.46-3.07-7.84" transform="translate(-92.22 -58.23)"
                                    opacity="0.1"></path>
                                <path d="M496.11,470.76s2.77,5.54,3.07,7.08" transform="translate(-92.22 -58.23)"
                                    opacity="0.1"></path>
                                <path d="M549.8,459.53s-8.61,2.62-7.85,5.85" transform="translate(-92.22 -58.23)"
                                    opacity="0.1"></path>
                                <path d="M541.91,489.38s11.28-13.08,7.89-12.77S541.91,489.38,541.91,489.38Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <g opacity="0.1">
                                    <path
                                        d="M546.41,437.07c0-2.7-.49-7.5-.55-12.85-.06,6.14.55,11.82.55,14.85,0,5.72,5.73,7.75,6,7.84,0-1.25,0-2,0-2S546.41,442.92,546.41,437.07Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                    <path
                                        d="M555,514.15a15.57,15.57,0,0,1,.27,1.59,10,10,0,0,0-.27-3.59c-.66-3-3.34-22.26-3.62-29.78C551.08,487.51,554.3,510.79,555,514.15Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                    <path
                                        d="M491.35,494.2c0-5.49.31-13.06.91-15,.49-1.56.59-7.94.58-13.58,0,5.06-.15,10.2-.58,11.58C491.58,479.38,491.32,488.76,491.35,494.2Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                    <path
                                        d="M497.34,405.53c7.07-3.69,6.92-1.23,6.92-1.23s5.54,27.08,18.14,26.92S538,404.3,538,404.3s5.85,1.69,6.46,1.22,2.66,1,3.79,1.72c.21-.53.43-1.05.68-1.55,0,0-3.85-2.64-4.47-2.17S538,402.3,538,402.3s-3,26.77-15.55,26.92-18.14-26.92-18.14-26.92.15-2.46-6.92,1.23c0,0-3.13-.36-2.26,3.09C495.63,405.33,497.34,405.53,497.34,405.53Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                    <path
                                        d="M490.41,513.23c1-.37,1.27-7.22,1.21-11-.05,3.8-.4,8.69-1.21,9s-1.2,2-.89,3.63C489.68,514,490,513.37,490.41,513.23Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                    <path
                                        d="M499.34,433.53a8.6,8.6,0,0,0,.47-4.11,5.27,5.27,0,0,1-.47,2.11c-1.85,3.23-.93,12-8.93,13.7l.48,1.88C498.37,445.17,497.53,436.7,499.34,433.53Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                </g>
                                <path d="M543.78,591.64c-3.78,6.88-42.15,0-42.15,0l.1-.69.76-5.33h40.43l.77,5.32Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <path d="M543.78,591.64c-3.78,6.88-42.15,0-42.15,0l.1-.69c1.84,0,29.6-.66,42,0Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M501.63,591.64h0s-6.88,1.72-17.55,30.62-14.45,66.24-14.45,66.24-6,10.16,19.61,10.84c0,0-2.06,6.71,12.39,5.68S514,704,514,704s9.29-5.85,13.42-4.82,6.71,1.38,11.18,5.16,18.76,2.24,18.93-.68a27,27,0,0,0,0-4.31s21.85,1.38,17.72-14.45-7.57-41.81-7.57-41.81-11.18-50.75-23.92-51.44S501.63,591.64,501.63,591.64Z"
                                    transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                <rect x="449.23" y="655.13" width="88.12" height="0.69"
                                    transform="translate(-296.91 1028.29) rotate(-84.73)" opacity="0.1"></rect>
                                <rect x="467.99" y="657.45" width="92.39" height="0.69"
                                    transform="translate(-237.83 1111.17) rotate(-89.78)" opacity="0.1"></rect>
                                <path d="M535.18,611.6" transform="translate(-92.22 -58.23)" fill="none"
                                    class="stroke-primary" stroke-miterlimit="10"></path>
                                <rect x="536.56" y="611.56" width="0.69" height="92.8"
                                    transform="translate(-116.25 -37.87) rotate(-2.13)" opacity="0.1"></rect>
                                <path
                                    d="M557.2,699.35C556,646.5,547,610.32,546.89,610l.67-.17c.09.36,9.14,36.61,10.33,89.55Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M502.83,596.8s-1.2.69,0,4" transform="translate(-92.22 -58.23)"
                                    opacity="0.1"></path>
                                <path d="M506.28,596.8s-3.27,2.06,0,5.51" transform="translate(-92.22 -58.23)"
                                    opacity="0.1"></path>
                                <path d="M536.9,596.8s4.47,4.3,3.44,5.51" transform="translate(-92.22 -58.23)"
                                    opacity="0.1"></path>
                                <path d="M540.5,595.77s.7,5.16,3.28,6.54" transform="translate(-92.22 -58.23)"
                                    opacity="0.1"></path>
                                <g opacity="0.5">
                                    <path
                                        d="M723.12,587.52S740,580.8,747.3,589s-5,18.18-5,18.18l-5.16,10.3L725,616.15l-2.86-14.24Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <path
                                        d="M742.3,607.13l-5.16,10.3L725,616.14l-2.86-14.23,1-14.39.27-.1c2.14-.79,16.59-5.83,23.5,1.11a5.35,5.35,0,0,1,.41.42C754.6,597.11,742.3,607.13,742.3,607.13Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M742.3,607.13l-5.16,10.3L725,616.14l-2.86-14.23,1-14.39.27-.1c2.09,11.45,7.67,16.28,8.61,17l.14.1,3.43-.28c6.67-3.68,10.19-12.43,11.32-15.74a5.35,5.35,0,0,1,.41.42C754.6,597.11,742.3,607.13,742.3,607.13Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M771.78,646.35s-3.72,47.38-2.71,53.1-2.15,6.15-2.15,6.15-13.46,3-16,1-6.87-2.39-6.87-2.39-10,2.29-14.46.58-11.88-1-11.88-1-5.72,3.44-7.3,2.72-3.58-.43-8.16-1.71-7.16-2.44-4.73-10.31.3-32.78.15-35.79-1.57-10.3-3.58-19,3.43-6.87,3.43-6.87c12.75-6.58,7.45-19.47,5.45-25.19s1.14-6,2.71-6,7.59-5.15,7.59-5.15l2.44-2.19,7.44-6.68C725,600.13,731,605.38,732,606.16l.14.11,3.43-.29c8.3-4.57,11.73-17,11.73-17,1,1.7,3.23,3.64,5.72,5.44a98,98,0,0,0,10.17,6.3c6,3.58,1.58,7.16,1.58,7.16-7.3,24.9,3,26,3,26C775.36,635,771.78,646.35,771.78,646.35Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <path d="M715.53,601.69s-2.15,1.15-2.15,2.43" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M716.82,604.12s-2.86,3-2.36,3.87" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M716.82,608s-2.15,2.29-1.29,3.58" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path
                                        d="M731.14,607.88l-9,8.69c-.33-9.66-5-17.39-7.3-20.65l7.44-6.68C724.1,601.85,730.15,607.1,731.14,607.88Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M732,606.16l-9,8.7c-.32-9.67-5-17.39-7.29-20.66l7.44-6.68C725,600.13,731,605.38,732,606.16Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <path
                                        d="M753.88,596.11c-3.6,5.62-10.29,20.46-10.29,20.46l-7.16-8.87c8.3-4.58,11.73-17,11.73-17C749.16,592.36,751.39,594.3,753.88,596.11Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                    <path
                                        d="M753,594.39c-3.59,5.63-10.29,20.47-10.29,20.47L735.57,606c8.3-4.57,11.73-17,11.73-17C748.3,590.65,750.53,592.59,753,594.39Z"
                                        transform="translate(-92.22 -58.23)" class="fill-primary"></path>
                                    <path d="M747.74,686.14s-1.53,13-2.41,13.74" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M760.33,688.43s1.72,9.3,1,11.45" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M723.69,689s-1.57,8.73,0,9.73" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M714.4,687.71s-1.3,10.31-1,12.17" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M762.48,637.47s-4,3.15-3.72,4" transform="translate(-92.22 -58.23)"
                                        opacity="0.1"></path>
                                    <path d="M765.34,639.48s-7.66,6.44-3.83,5.72S765.34,639.48,765.34,639.48Z"
                                        transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                </g>
                                <path
                                    d="M341,455l.05-.07-.09-.07h0l-.54-.36.11.08a1.79,1.79,0,0,0-2.36.52l-.22.31h0l-12.15,17.48L323.68,476c-6.41-1.93-16.82,6.19-22.09,10.85-.33.29-.64.56-.92.82-.42-.94-.67-1.54-.67-1.54-.26,2.86-10.36,7.15-12.72,8.71a8.5,8.5,0,0,1-3.52,1.18c.34-10.87-8.07-22.31-8.07-22.31l-20.55-26.15a23.08,23.08,0,0,1,2.1-13.87c.17-.34.34-.68.53-1h.1a22.74,22.74,0,0,0-1.29,6.83c.05,1.77,1.69,10.35,4,10a1.26,1.26,0,0,0,1.18-.56c1.84-2.14,2-5.78,1.91-9.15a18.75,18.75,0,0,1-.33,2.95c.15-2.8-.17-5.76-.17-7.87,0-.84,0-1.67.06-2.51l.25,0c0,.32,0,.66,0,1,0-.35,0-.69,0-1l.26,0a27.61,27.61,0,0,0,12.55-5.82,6.73,6.73,0,0,0,4.72-2.21,4.59,4.59,0,0,1-.89,4.28c2.75-.13,5.08-2.27,6.14-4.78a16.68,16.68,0,0,0,.78-8,55.59,55.59,0,0,1-.59-8.13,29.91,29.91,0,0,0,.24-4.43,8.54,8.54,0,0,0-.24-1.34h.08a2,2,0,0,0,1.43-.56c1.14-.88,1.51-2.6,1.8-3.92a33.38,33.38,0,0,0,1.06-9.31c-.06.95-.18,1.91-.32,2.86.25-3.6-.25-7.1-2.63-9.71-1.64-1.79-3.93-2.84-6.13-3.89a4.49,4.49,0,0,1-2-1.43,5.79,5.79,0,0,1-.62-2.48c-.77-5.26-5.72-8.92-10.65-11-6.34-2.76-14-3.94-20.05-.66-3,1.59-5.3,4.08-8,6.11-3.38,2.57-7.28,4.37-10.89,6.61s-7,5.08-8.77,8.94c-2.65,6-.66,12.8-.33,19.31.53,10.25-3.69,21-12.05,27a10.81,10.81,0,0,0-2.65,2.29,2.86,2.86,0,0,0-.22,3.27c.43.56,1.11.88,1.58,1.41.95,1.08.76,2.73.39,4.11a25.77,25.77,0,0,1-7,11.86c.15,1.06,1.46,1.48,2.53,1.64a58.25,58.25,0,0,0,8.55.62h1.23c-.13.33-.27.68-.41,1.05-1.55,4.08-3.56,10.36-2.89,14.2,1,6.06,4.2,33.77,2.62,38.63S214.65,549,214.65,549s.55,2.72,1.5,6.78c-2.47,5.82-5.29,12.28-6.7,14.87-2.84,5.19-1.44,31.69,8.35,43.47,0,0,4,5.72,3,7.79s.18,5.72.18,5.72l1.55,34.29a88.88,88.88,0,0,1-.72,10.48c-4.18,5.17-10.62,12.71-13.65,13.94-4.69,1.91-39.67,44.34-39.67,44.34s.28.51.83,1.34l-1,1.14-6.71,7.78-.53.61c-1.26-.24-9.65-1.76-16.3-2.24l-.66,0v-.12a24.88,24.88,0,0,0-7,.19,2.25,2.25,0,0,0-1.16.6c-2.27,2.78-3.49,46.42-3.49,46.42s2.42,21.85,10,23.07a4,4,0,0,0,1.2.22H144c5.4-.4,7.88-3.49,9-5.61a8.69,8.69,0,0,0,.75-2s-.88-3.89,1.48-9.26S162,778,162,778s8-8.41,6.57-12.49c.22-.33.48-.69.76-1.1,3-4.28,9.08-12.73,14-18.37.32-.38.64-.73,1-1.08a24.56,24.56,0,0,0,5.58,1.61s7.52-2.94,10.31-9.52c1.19-2.8,5.86-7.76,10.83-12.53l-.16,1.27-.17,41.74a29.83,29.83,0,0,0,5.14,2.83v1a134,134,0,0,1-1.08,17.79l-.15.93c-.62-.44-1.16-.59-1.5-.25-1.54,1.56-2.5,11.52-2.59,16.11,0,.15,0,.3,0,.46-.25,4.58-2.86,11.24,5,11.58,5.88.25,31.23.63,44.79.83a30.15,30.15,0,0,0,20-7.09c4.31-3.69,6.92-8.08,1.05-11.31-.36-.2-.74-.39-1.16-.58l-13-2-22.21-11.34s-.13-6.86-2.8-5.72a7.5,7.5,0,0,0-2.25.89c-.13-.25-.27-.52-.4-.8a25.55,25.55,0,0,1-2.74-11.56c0-.36,0-.73.05-1.1a22.09,22.09,0,0,0,1.84-1.89s-.17-15.59,1.58-18.53,7.17-32.74,7.17-32.74.17-5.54,3.67-8.83,2.27-12.82,2.27-12.82,4.9-2.6,6.47-11.08,6.65-27,6.65-27,10.49-27.37,9.8-44.68,1-26.33,1-26.33l2.18-40.24,0-.62c.87.66,1.46,1.2,1.46,1.2s0-.16,0-.44c.32.27.5.44.5.44s1.12-18.26.74-25.5c6.12-2.08,15.44-5.5,16-7.24.78-2.59,11.28-10.78,11.28-10.78a1.74,1.74,0,0,1-.64-.24c.33-.15.67-.33,1-.52,6.88-3.68,19.66-14.44,17.51-21l14-20.09A3.41,3.41,0,0,0,341,455Z"
                                    transform="translate(-92.22 -58.23)"
                                    fill="url(#dcaa3d52-8271-46b6-bbc0-03906cb73c47-0)"></path>
                                <path
                                    d="M308.43,503.52a9.12,9.12,0,0,1-3.35,1.27c-4.37.13-8-11.7-8-11.7s1.24-1.26,3.22-3c5.86-5.21,18.15-14.83,23.91-9.45C330.71,486.65,316,499.45,308.43,503.52Z"
                                    transform="translate(-92.22 -58.23)" fill="#ecb4b6"></path>
                                <path
                                    d="M242,785.65l-16.13,17.41s-14.92.17-12-8.06a30.09,30.09,0,0,0,1.24-5.48,134.65,134.65,0,0,0,1.05-17.62c0-3.86-.06-6.57-.06-6.57s23.49-10.29,21.09.43a20.15,20.15,0,0,0-.48,4.08,25.54,25.54,0,0,0,2.68,11.45A25.91,25.91,0,0,0,242,785.65Z"
                                    transform="translate(-92.22 -58.23)" fill="#ecb4b6"></path>
                                <path
                                    d="M242,785.65l-16.13,17.41s-14.92.17-12-8.06a30.09,30.09,0,0,0,1.24-5.48c2.13,1.65,5.19,6.51,5.19,6.51s10.29,3,13.12-6c1.58-5,4.08-7.53,6-8.74A25.91,25.91,0,0,0,242,785.65Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M279.42,811.87a29.34,29.34,0,0,1-19.64,7c-13.3-.19-38.15-.58-43.92-.82-7.72-.34-5.16-6.93-4.91-11.47,0-.16,0-.3,0-.45.09-4.55,1-14.41,2.54-15.95s6.81,6.86,6.81,6.86,10.29,3,13.12-6,8.58-9.87,8.58-9.87c2.61-1.13,2.74,5.66,2.74,5.66l21.78,11.23,12.78,2c.41.19.78.38,1.13.57C286.21,803.87,283.65,808.21,279.42,811.87Z"
                                    transform="translate(-92.22 -58.23)" fill="#c17174"></path>
                                <circle cx="146.96" cy="735.39" r="0.94" fill="#fff"
                                    opacity="0.25"></circle>
                                <circle cx="155.8" cy="739.77" r="0.94" fill="#fff"
                                    opacity="0.25"></circle>
                                <circle cx="160.34" cy="741.8" r="0.94" fill="#fff"
                                    opacity="0.25"></circle>
                                <circle cx="169.77" cy="745.42" r="0.94" fill="#fff"
                                    opacity="0.25"></circle>
                                <circle cx="164.97" cy="743.88" r="0.94" fill="#fff"
                                    opacity="0.25"></circle>
                                <path
                                    d="M279.42,811.87a29.34,29.34,0,0,1-19.64,7c-13.3-.19-38.15-.58-43.92-.82-7.72-.34-5.16-6.93-4.91-11.47l48.47,3s19.85-3,21-8.92C286.21,803.87,283.65,808.21,279.42,811.87Z"
                                    transform="translate(-92.22 -58.23)" fill="#c17174"></path>
                                <path
                                    d="M279.42,811.87a29.34,29.34,0,0,1-19.64,7c-13.3-.19-38.15-.58-43.92-.82-7.72-.34-5.16-6.93-4.91-11.47l48.47,3s19.85-3,21-8.92C286.21,803.87,283.65,808.21,279.42,811.87Z"
                                    transform="translate(-92.22 -58.23)" fill="#fff" opacity="0.25"></path>
                                <path
                                    d="M189.19,741.92a33.47,33.47,0,0,0-4.86,4.88c-4.81,5.58-10.76,14-13.71,18.18-1.14,1.64-1.83,2.67-1.83,2.67l-6.44-.95s-6.94-10.63-6.85-10.88S161,744.15,161,744.15l2.09-2.45,6.59-7.7,3-3.48S195,737.72,189.19,741.92Z"
                                    transform="translate(-92.22 -58.23)" fill="#ecb4b6"></path>
                                <path
                                    d="M170.62,765c-1.14,1.64-1.83,2.67-1.83,2.67l-6.44-.95s-6.94-10.63-6.85-10.88S161,744.15,161,744.15l2.09-2.45.68.13h1.64c-5.75,6,.42,19.2.42,19.2S168.49,761.28,170.62,765Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M163.43,778.44s-4.29,9.26-6.61,14.58-1.46,9.17-1.46,9.17a9,9,0,0,1-.73,2,10.1,10.1,0,0,1-8.78,5.56h-.42c-7.82-.2-10.3-22.9-10.3-22.9s1.2-43.21,3.43-46a2.14,2.14,0,0,1,1.13-.6,24,24,0,0,1,6.89-.19c7.07.51,16.16,2.25,16.16,2.25h1.63c-5.75,6,.42,19.21.42,19.21s2.75.25,4.89,4.11S163.43,778.44,163.43,778.44Z"
                                    transform="translate(-92.22 -58.23)" fill="#c17174"></path>
                                <circle cx="61.77" cy="707.35" r="0.94" fill="#fff"
                                    opacity="0.25"></circle>
                                <circle cx="61.3" cy="714.84" r="0.94" fill="#fff"
                                    opacity="0.25"></circle>
                                <path
                                    d="M154,804a10.1,10.1,0,0,1-8.78,5.56h-.41c-7.82-.2-10.31-22.9-10.31-22.9s1.2-43.21,3.43-46a2.14,2.14,0,0,1,1.13-.6,24,24,0,0,1,6.89-.19c-.13,7.77-.5,32.32,0,34.76S150.88,797.49,154,804Z"
                                    transform="translate(-92.22 -58.23)" fill="#c17174"></path>
                                <path
                                    d="M154,804a10.1,10.1,0,0,1-8.78,5.56h-.41c-7.82-.2-10.31-22.9-10.31-22.9s1.2-43.21,3.43-46a2.14,2.14,0,0,1,1.13-.6,24,24,0,0,1,6.89-.19c-.13,7.77-.5,32.32,0,34.76S150.88,797.49,154,804Z"
                                    transform="translate(-92.22 -58.23)" fill="#fff" opacity="0.25"></path>
                                <path
                                    d="M144.8,809.58c-7.82-.2-10.31-22.9-10.31-22.9s1.2-43.21,3.43-46a2.14,2.14,0,0,1,1.13-.6c1.64,2.44,3.08,7.84,1.78,19.72-2.44,22.51.5,23.93.5,23.93S145,802.86,144.8,809.58Z"
                                    transform="translate(-92.22 -58.23)" fill="#c17174"></path>
                                <path
                                    d="M144.8,809.58c-7.82-.2-10.31-22.9-10.31-22.9s1.2-43.21,3.43-46a2.14,2.14,0,0,1,1.13-.6c1.64,2.44,3.08,7.84,1.78,19.72-2.44,22.51.5,23.93.5,23.93S145,802.86,144.8,809.58Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M308.43,503.52a9.12,9.12,0,0,1-3.35,1.27c-4.37.13-8-11.7-8-11.7s1.24-1.26,3.22-3C301.73,493.29,305.67,501.92,308.43,503.52Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M280.39,499.26s3.6.26,5.91-1.28,12.22-5.79,12.48-8.62c0,0,5.91,14.4,9.26,14.92,0,0-10.29,8.1-11.06,10.67s-20.84,8.88-20.84,8.88Z"
                                    transform="translate(-92.22 -58.23)" fill="#ff748e"></path>
                                <path
                                    d="M280.39,499.26s3.6.26,5.91-1.28,12.22-5.79,12.48-8.62c0,0,5.91,14.4,9.26,14.92,0,0-10.29,8.1-11.06,10.67s-20.84,8.88-20.84,8.88Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M189.19,741.92a33.47,33.47,0,0,0-4.86,4.88c-7.76-3.25-12.76-9.89-14.66-12.8l3-3.48S195,737.72,189.19,741.92Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M225.89,669s-12.58,16.81-17.18,18.7-38.89,43.9-38.89,43.9,7.37,13.55,20.92,15.77c0,0,7.37-2.91,10.12-9.43S225.21,713,225.21,713Z"
                                    transform="translate(-92.22 -58.23)" fill="#5e5a6b"></path>
                                <path
                                    d="M225.89,669s-12.58,16.81-17.18,18.7-38.89,43.9-38.89,43.9,7.37,13.55,20.92,15.77c0,0,7.37-2.91,10.12-9.43S225.21,713,225.21,713Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M187.78,725.25a54.84,54.84,0,0,0,11.45,0C206,724.6,200.9,728.72,187.78,725.25Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M184.69,729.62s9,5.14,12.48,2.57S193.82,734.67,184.69,729.62Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M237.21,765.76a20.15,20.15,0,0,0-.48,4.08c-6.95,6.31-15.32,4.36-20.55,2.06,0-3.86-.06-6.57-.06-6.57S239.61,755,237.21,765.76Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M278.88,542.05l-.25,4.74-2.14,39.85s-1.72,8.92-1,26.06S265.85,657,265.85,657s-5,18.35-6.52,26.75-6.34,11-6.34,11,1.2,9.43-2.23,12.69-3.6,8.74-3.6,8.74-5.32,29.5-7,32.42-1.55,18.35-1.55,18.35c-11.14,13.2-27.43,1.2-27.43,1.2l.17-41.33s4.63-38.07,8.06-43.39,3.43-19.89,3.43-19.89l-1.53-34s-1.22-3.6-.17-5.66-2.93-7.71-2.93-7.71c-9.61-11.67-11-37.91-8.19-43s11.12-25.72,11.12-25.72l11.47-6.69,20.73.61Z"
                                    transform="translate(-92.22 -58.23)" fill="#5e5a6b"></path>
                                <path d="M230.1,744.15s2.71,9.39,4.89,10.42S230.1,744.15,230.1,744.15Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M233.83,712.9s7,5.54,10,5.53S233.83,712.9,233.83,712.9Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M276.14,480.74v11.32l-7.47-3.22-7.45-3.21L245,469.68s-12.83-8.33-19.69-15.92c-3.92-4.33-5.89-8.42-2.44-10.58a21.5,21.5,0,0,0,4.49-3.93,73.82,73.82,0,0,0,8.94-13.2c.11-.19.22-.38.32-.57,3.34-6.13,5.55-11.36,5.55-11.36s9.4,3,15.44,7.28c.49.34.95.69,1.39,1.05,3.37,2.76,5.05,6,1.94,9.16a24,24,0,0,0-2.21,2.64h0a21.67,21.67,0,0,0-1.38,2.16c-.18.34-.36.67-.52,1a23.06,23.06,0,0,0-2.06,13.73Z"
                                    transform="translate(-92.22 -58.23)" fill="#ecb4b6"></path>
                                <path
                                    d="M274.77,400c.39.68.93,1.26,1.29,1.95a9.37,9.37,0,0,1,.57,4.8,27.3,27.3,0,0,0,.5,7.66c.53,2.26,1.52,4.44,1.6,6.76.11,3.27-1.59,6.3-3.23,9.13a6.57,6.57,0,0,0,4.7-2.19,4.56,4.56,0,0,1-.86,4.23c2.69-.13,5-2.25,6-4.73a16.49,16.49,0,0,0,.77-8,54.6,54.6,0,0,1-.58-8.05,29.43,29.43,0,0,0,.23-4.39c-.25-2.91-2-5.44-3.76-7.8l-3.48-4.78a2.46,2.46,0,0,0-1-.91C274.23,392.28,273.85,398.34,274.77,400Z"
                                    transform="translate(-92.22 -58.23)" fill="#464353"></path>
                                <path
                                    d="M261,431.61a24,24,0,0,0-2.21,2.64h0a21.67,21.67,0,0,0-1.38,2.16c-.18.34-.36.67-.52,1a27,27,0,0,1-20.21-10.92c-.11-.15-.22-.3-.32-.46.11-.19.22-.38.32-.57,3.34-6.13,5.55-11.36,5.55-11.36s9.4,3,15.44,7.28c.49.34.95.69,1.39,1.05C262.39,425.21,264.07,428.41,261,431.61Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M285.38,409.44A27,27,0,0,1,263.27,436a27.31,27.31,0,0,1-4.9.44h-.12c-.29,0-.59,0-.88,0a27,27,0,1,1,28-27Z"
                                    transform="translate(-92.22 -58.23)" fill="#ecb4b6"></path>
                                <path
                                    d="M261.91,476.2s13.6,7.67,10.12,1.2l-17.75-26.24h0l20.15,25.89s12.86,17.67,5.83,29.84c0,0-1,10.12.17,12.52s-.34,28-.34,28-4.81-4.46-7.38-3.61S252,546.17,252,546.17Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M278.88,542.05l-.25,4.74c-1.63-1.18-3.9-2.5-5.41-2-2.57.86-20.74,2.41-20.74,2.41l.83-5.91Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M262.42,476.2s13.61,7.67,10.12,1.2l-17.75-26.24h0l20.15,25.89s12.86,17.67,5.83,29.84c0,0-1,10.12.17,12.52s-.34,28-.34,28-4.8-4.46-7.37-3.61-20.75,2.41-20.75,2.41Z"
                                    transform="translate(-92.22 -58.23)" fill="#464353"></path>
                                <path
                                    d="M269.69,489.35c-.79,8.25-4.18,18.06-4.18,18.06S263.11,531.76,260,539s-1.72,17.15-3.43,35.5c-.62,6.61-2.75,11.15-5.62,14.21-4.72,5-11.46,6.09-16.78,5.78l-1.26-.1c-8.58-.85-16.81-42.18-16.81-42.18s-3.94-35.16-2.4-40S212.18,480,211.15,474c-.66-3.81,1.31-10,2.83-14.06.89-2.34,1.62-4,1.62-4s2.92-9.26,7.72-14.06a7.08,7.08,0,0,1,5.09-2.14,12.73,12.73,0,0,1,6.35,2,1.77,1.77,0,0,1,.22.15s31.22,31.9,34.13,39.27C269.92,483.23,270,486.17,269.69,489.35Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M268.67,488.84c-.8,8.24-4.19,18.05-4.19,18.05s-2.4,24.36-5.49,31.56-1.71,17.15-3.43,35.5c-.62,6.6-2.75,11.14-5.62,14.21-4.72,5-11.46,6.08-16.78,5.78l-1.26-.1c-8.58-.86-16.81-42.19-16.81-42.19s-3.94-35.15-2.4-39.95-1.54-32.24-2.57-38.25c-.66-3.8,1.31-10,2.83-14.06.89-2.34,1.62-3.95,1.62-3.95s2.92-9.26,7.72-14.06a7,7,0,0,1,5.09-2.13,12.52,12.52,0,0,1,6.35,2l.22.14s31.22,31.9,34.13,39.27C268.89,482.71,269,485.66,268.67,488.84Z"
                                    transform="translate(-92.22 -58.23)" fill="#ff748e"></path>
                                <path d="M233.7,614.38s-7.08,6.3-9.52,6S233.7,614.38,233.7,614.38Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M235.58,620.43s-7.46,3.46-9.69,4S232.7,619.54,235.58,620.43Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M264.44,525.76s11.06.13,12.73,3.6S268,524.34,264.44,525.76Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M262.89,531.8s8.49,1.8,11.06,3.86S262.89,531.8,262.89,531.8Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M248.62,510.84s-1,34.85-4.82,39.36S248.62,510.84,248.62,510.84Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M239.1,609.36S232,640.1,246.24,642s9.84-35,9.84-35Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M238.58,608.85s-7.06,30.74,7.15,32.66,9.83-35,9.83-35Z"
                                    transform="translate(-92.22 -58.23)" fill="#ecb4b6"></path>
                                <path
                                    d="M285.21,406.46a10.41,10.41,0,0,1-1-1.87c-1.89-3.94-6.75-2-10.31-.13L272,406.91a15.25,15.25,0,0,0-2.17,3.35,25.35,25.35,0,0,0-.91,3c-.49,1.74-1.21,3.4-1.86,5.1A59.29,59.29,0,0,0,263.27,436a27.31,27.31,0,0,1-4.9.44h-.12l0-.12c.18-.68.33-1.37.47-2.06h0a35.68,35.68,0,0,0,.27-11.8c0-.09,0-.17,0-.26-.13-.87-.3-1.75-.37-2.62-.33.6-.65,1.21-1,1.83-2.15,4-4.41,8-8.47,9.75a17.37,17.37,0,0,1-5.15,1.16,29.38,29.38,0,0,0-6.44,1.07,4,4,0,0,0-1.87,1.13,5.52,5.52,0,0,0-.94,2.82,22.73,22.73,0,0,1-1,3.91,34.28,34.28,0,0,1-8.4,12.52l-.93.9a17.41,17.41,0,0,1-5.56,3.85,17,17,0,0,1-5.89.88c.89-2.34,1.62-3.95,1.62-3.95s2.92-9.26,7.72-14.06a7,7,0,0,1,5.09-2.13,75.53,75.53,0,0,0,9.26-13.77,27,27,0,1,1,48.57-19Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M286.93,385.39c-1.6-1.78-3.85-2.82-6-3.85a4.57,4.57,0,0,1-1.95-1.42,5.94,5.94,0,0,1-.6-2.45c-.75-5.22-5.61-8.83-10.44-10.95-6.22-2.73-13.69-3.9-19.66-.66-2.9,1.58-5.19,4.05-7.81,6.06-3.32,2.54-7.14,4.32-10.68,6.54s-6.92,5-8.6,8.86c-2.6,5.9-.65,12.67-.32,19.11.51,10.16-3.62,20.77-11.82,26.78a10.32,10.32,0,0,0-2.6,2.27,2.85,2.85,0,0,0-.21,3.23c.41.56,1.09.88,1.54,1.4.94,1.07.75,2.7.38,4.08a25.52,25.52,0,0,1-6.86,11.73c.14,1.06,1.42,1.47,2.47,1.63a56.1,56.1,0,0,0,8.39.61,14.1,14.1,0,0,0,11.73-4.73c5-4.7,9.23-10.57,10.36-17.33a5.71,5.71,0,0,1,.94-2.82,4.23,4.23,0,0,1,1.87-1.13c3.73-1.28,8-.65,11.59-2.23,4.68-2,7-7,9.45-11.58.08.87.24,1.75.38,2.63a35.56,35.56,0,0,1-.7,14.12c-.67,2.61-1.64,5.21-1.57,7.9.05,2,2.08,12.45,4.75,9.32s1.69-10.05,1.69-13.93a59.55,59.55,0,0,1,3.93-21.25c.64-1.69,1.37-3.36,1.86-5.1a27.33,27.33,0,0,1,.9-3,15.67,15.67,0,0,1,2.18-3.35l1.91-2.45c3.56-1.89,8.42-3.81,10.31.13.72,1.51,1.11,3.18,3,1.71,1.11-.87,1.47-2.58,1.76-3.88C289.69,395.94,290.67,389.53,286.93,385.39Z"
                                    transform="translate(-92.22 -58.23)" fill="#464353"></path>
                                <path
                                    d="M250.74,479.8c-.73-18.47-26.58-22.29-32.61-4.82a2.53,2.53,0,0,0-.12.36c-3.95,11.83-2.23,41.79-2.23,41.79s.51,20.12,2.4,26.81,7.2,25.89,7.2,29,4.93,14.92,7,15.78,3.12,7.54,3.63,8.74,2,16.81,2,16.81,19.38-1.2,19.72-4.29-4.29-18.18-4.29-18.18-3.41-6.17-3.85-11.14S246.47,573.43,247,570s-1.55-5.14-1.55-7.37-1.54-8.23-1.54-8.23-3.26-2.58-2.74-5.66-4.63-9.26-3.26-11.49,1.71-7.72,1.71-7.72,1.72-24.69,2.92-31.38,8.23-17.49,8.23-17.49S250.76,480.35,250.74,479.8Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M249.94,588.16c-4.72,5-11.46,6.08-16.78,5.78-.62-2.34-1.52-5.22-2.83-5.76-2.08-.86-7-12.69-7-15.77s-5.31-22.3-7.2-29-2.4-26.8-2.4-26.8-1.72-30,2.23-41.8c0-.11.07-.23.12-.35,6-17.48,31.88-13.65,32.61,4.82,0,.55,0,.85,0,.85s-7,10.8-8.23,17.49S237.56,529,237.56,529s-.35,5.49-1.72,7.72,3.77,8.41,3.26,11.49,2.74,5.66,2.74,5.66,1.54,6,1.54,8.24,2.06,3.94,1.55,7.37,2.23,5.66,2.67,10.63A27.72,27.72,0,0,0,249.94,588.16Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path
                                    d="M249.71,479.29c-.73-18.47-26.58-22.29-32.61-4.82l-.12.35c-3.95,11.84-2.23,41.8-2.23,41.8s.51,20.11,2.4,26.8,7.2,25.9,7.2,29,4.93,14.92,7,15.78,3.12,7.55,3.63,8.75,2,16.8,2,16.8,19.38-1.2,19.72-4.28-4.28-18.18-4.28-18.18-3.42-6.18-3.86-11.15-3.18-7.2-2.66-10.63-1.55-5.15-1.55-7.38-1.54-8.23-1.54-8.23-3.26-2.57-2.74-5.66-4.63-9.26-3.26-11.49,1.71-7.71,1.71-7.71,1.72-24.7,2.92-31.39,8.23-17.49,8.23-17.49S249.73,479.84,249.71,479.29Z"
                                    transform="translate(-92.22 -58.23)" fill="#ff748e"></path>
                                <path d="M217.88,526.79c.51-.52,10.29-11.32,13.37-7.46S217.88,526.79,217.88,526.79Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <path d="M218.78,535.15c.38-.39,9.77-.77,12.09-6S218.78,535.15,218.78,535.15Z"
                                    transform="translate(-92.22 -58.23)" opacity="0.1"></path>
                                <g opacity="0.1">
                                    <path
                                        d="M208.08,440.31a2.65,2.65,0,0,1,.51.93,4,4,0,0,0-.51-3.5c-.46-.53-1.13-.84-1.55-1.4,0,0-.05-.09-.08-.14a2.65,2.65,0,0,0,.08,2.71C207,439.47,207.62,439.79,208.08,440.31Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                    <path
                                        d="M221.17,407c0-1,0-2,0-2.92-.18-3.5-.83-7.09-1-10.6-.21,4.3.75,8.81,1,13.17C221.17,406.75,221.16,406.86,221.17,407Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                    <path
                                        d="M261.25,449.94c-2.38,2.79-4.25-5.24-4.66-8.41a13.19,13.19,0,0,0-.09,1.66c.06,2,2.08,12.45,4.75,9.32,1.81-2.12,2-5.73,1.88-9.06C263,446,262.6,448.36,261.25,449.94Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                    <path
                                        d="M258.77,421.17a34.41,34.41,0,0,1,.37,4.06,35.14,35.14,0,0,0-.37-6.64c-.13-.87-.3-1.75-.38-2.63-2.47,4.62-4.76,9.56-9.44,11.59-3.63,1.57-7.86.95-11.59,2.23a4,4,0,0,0-1.87,1.13,5.58,5.58,0,0,0-.94,2.82c-1.14,6.76-5.38,12.63-10.37,17.33a14.1,14.1,0,0,1-11.73,4.73,57.32,57.32,0,0,1-8.38-.61,6.33,6.33,0,0,1-1.26-.33c-.39.44-.8.86-1.22,1.27.14,1.06,1.43,1.47,2.48,1.63a56,56,0,0,0,8.38.61,14.1,14.1,0,0,0,11.73-4.73c5-4.7,9.23-10.57,10.37-17.33a5.61,5.61,0,0,1,.94-2.82,4.12,4.12,0,0,1,1.87-1.13c3.73-1.28,8-.65,11.59-2.23,4.68-2,7-7,9.44-11.58C258.47,419.41,258.64,420.29,258.77,421.17Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                    <path
                                        d="M288.79,398.82c-.29,1.3-.66,3-1.77,3.88-1.88,1.46-2.26-.2-3-1.71-1.89-3.94-6.75-2-10.31-.13l-1.91,2.45a15.25,15.25,0,0,0-2.17,3.35,23.57,23.57,0,0,0-.9,3c-.5,1.74-1.22,3.4-1.87,5.09A59.85,59.85,0,0,0,262.94,436c0,.33,0,.69,0,1.06a59.7,59.7,0,0,1,3.91-19.73c.65-1.69,1.37-3.36,1.87-5.1a23.57,23.57,0,0,1,.9-3,15.25,15.25,0,0,1,2.17-3.35l1.91-2.45c3.56-1.89,8.42-3.81,10.31.13.73,1.51,1.11,3.18,3,1.71,1.11-.87,1.48-2.58,1.77-3.88a33.91,33.91,0,0,0,1-9.22A44.09,44.09,0,0,1,288.79,398.82Z"
                                        transform="translate(-92.22 -58.23)"></path>
                                </g>
                                <path
                                    d="M312.18,496.18l.53.36a2.12,2.12,0,0,1-.55-3L336,459a2.11,2.11,0,0,1,2.95-.54l-.53-.37a3.41,3.41,0,0,1,.87,4.74L316.92,495.3A3.42,3.42,0,0,1,312.18,496.18Z"
                                    transform="translate(-92.22 -58.23)" fill="#464353"></path>
                                <path
                                    d="M325.63,453.79h.49a0,0,0,0,1,0,0v46.26a0,0,0,0,1,0,0h-.49a1.74,1.74,0,0,1-1.74-1.74V455.54a1.74,1.74,0,0,1,1.74-1.74Z"
                                    transform="translate(235.71 -158.44) rotate(34.56)" fill="#9f9eff"></path>
                                <rect x="334.37" y="463.08" width="0.43" height="3.77" rx="0.17"
                                    ry="0.17" transform="translate(230.62 -165.99) rotate(34.56)" fill="#464353">
                                </rect>
                                <path
                                    d="M841.62,340.23A17.27,17.27,0,1,1,824.35,323,17.27,17.27,0,0,1,841.62,340.23Zm-19.27,9.14,12.82-12.81a1.12,1.12,0,0,0,0-1.57l-1.58-1.58a1.1,1.1,0,0,0-1.57,0l-10.45,10.45L816.69,339a1.13,1.13,0,0,0-1.58,0l-1.57,1.58a1.1,1.1,0,0,0,0,1.57l7.24,7.24a1.1,1.1,0,0,0,1.57,0Z"
                                    transform="translate(-92.22 -58.23)" fill="#3acc6c"></path>
                                <path
                                    d="M632.41,529.77a17.27,17.27,0,1,1-17.27-17.27A17.27,17.27,0,0,1,632.41,529.77Zm-19.27,9.14L626,526.1a1.11,1.11,0,0,0,0-1.58L624.38,523a1.11,1.11,0,0,0-1.58,0L612.35,533.4l-4.88-4.88a1.1,1.1,0,0,0-1.57,0l-1.58,1.57a1.13,1.13,0,0,0,0,1.58l7.24,7.24a1.11,1.11,0,0,0,1.58,0Z"
                                    transform="translate(-92.22 -58.23)" fill="#3acc6c"></path>
                                <path
                                    d="M632.41,718.43a17.27,17.27,0,1,1-17.27-17.27A17.27,17.27,0,0,1,632.41,718.43Zm-19.27,9.14L626,714.76a1.11,1.11,0,0,0,0-1.58l-1.57-1.57a1.11,1.11,0,0,0-1.58,0l-10.45,10.45-4.88-4.88a1.1,1.1,0,0,0-1.57,0l-1.58,1.57a1.13,1.13,0,0,0,0,1.58l7.24,7.24a1.11,1.11,0,0,0,1.58,0Z"
                                    transform="translate(-92.22 -58.23)" fill="#3acc6c"></path>
                            </svg>
                        </div>
                        <div class="bottom-div mt-5">
                            <h4>{{ __('Your card is empty') }}</h4>
                            <p>
                                {{ __('Your cart is currently empty. Return to our shop and check out the latest offers.
                                              We have some great items that are waiting for you.') }}
                            </p>
                            <a href="{{ route('store.slug', $store->slug) }}" class="btn btn-primary mt-4 rounded-0">
                                {{ __('Return to shop') }} </a>
                        </div>
                    </div>
                </div>
    @endif
@endsection
{{-- checkout modal --}}
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModal"
    aria-hidden="true">
    <div class="modal-dialog modal-md rounded-pill ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Checkout As Guest Or Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="form-group col-6 d-flex justify-content-center col-form-label mb-0">
                    <a href="{{ route('customer.login', $store->slug) }}"
                        class="btn btn-secondary btn-light rounded-pill">{{ __('Countinue to sign in') }}</a>
                </div>
                <div class="form-group col-6 d-flex justify-content-center col-form-label mb-0">
                    <a href="{{ route('user-address.useraddress', $store->slug) }}"
                        class="btn btn-primary ms-2 rounded-pill">{{ __('Countinue as guest') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script-page')
    <script>
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

        $(document).on('click', '.product_qty', function (e) {
            e.preventDefault();
            var currEle = $(this);
            var product_id = $(this).siblings(".bx-cart-qty").attr('data-id');
            var arrkey = $(this).parents('tr').attr('data-id');

            setTimeout(function () {
                if (currEle.hasClass('qty-minus') == true) {
                    qty_id = currEle.next().val()
                } else {
                    qty_id = currEle.prev().val()
                }

                if (qty_id == 0 || qty_id == '' || qty_id < 0) {
                    location.reload();
                    return false;
                }

                $.ajax({
                    url: '{{route('user-product_qty.product_qty',['__product_id',$store->slug,'arrkeys'])}}'.replace('__product_id', product_id).replace('arrkeys', arrkey),
                    type: "post",
                    headers: {
                        'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "product_qty": qty_id,
                    },
                    success: function (response) {
                        if (response.status == "Error") {
                            show_toastr('Error', response.error, 'error');
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            location.reload(); // then reload the page.(3)
                        }
                    },
                    error: function (result) {
                        console.log('error12');
                    }
                });
            }, 100);
        })

        $(".product_qty_input").on('blur', function (e) {
            e.preventDefault();

            var product_id = $(this).attr('data-id');
            var arrkey = $(this).parents('div').attr('data-id');
            var qty_id = $(this).val();
            console.log(product_id, arrkey, qty_id);

            setTimeout(function () {
                if (qty_id == 0 || qty_id == '' || qty_id < 0) {
                    location.reload();
                    return false;
                }

                $.ajax({
                    url: '{{route('user-product_qty.product_qty',['__product_id',$store->slug,'arrkeys'])}}'.replace('__product_id', product_id).replace('arrkeys', arrkey),
                    type: "post",
                    headers: {
                        'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "product_qty": qty_id,
                    },
                    success: function (response) {
                        if (response.status == "Error") {
                            show_toastr('Error', response.error, 'error');
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            location.reload(); // then reload the page.(3)
                        }
                    },
                    error: function (result) {
                        // console.log('error12');
                    }
                });
            }, 500);
        });

    </script>
@endpush
