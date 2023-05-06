@extends('layouts.admin')
@php
    $logo = asset(Storage::url('uploads/logo/'));
    $company_logo = \App\Models\Utility::getValByName('company_logo');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $store_logo = asset(Storage::url('uploads/store_logo/'));
    $lang = \App\Models\Utility::getValByName('default_language');
    if (Auth::user()->type == 'Owner') {
        $store_lang = $store->lang;
    }
@endphp
@section('page-title')
    {{ __('Store Theme Setting') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('settings') }}">{{ __(' Store Settings') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Store Theme Setting') }}</li>
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-bold mb-0 text-white">{{ __('Store Theme Setting') }}</h5>
    </div>
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{ asset('custom/libs/summernote/summernote-bs4.css') }}">
    <style>
        hr {
            margin: 8px;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            @if (Auth::user()->type == 'Owner')
                                @if ($theme == 'theme1')
                                    <a href="#Top_Bar_Setting" id="Top_Bar_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Top Bar Setting') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                                @if ($theme == 'theme3' || $theme == 'theme4' || $theme == 'theme6')
                                    <a href="#Banner_Img_Setting" id="Banner_Img_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Banner Image') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if ($theme == 'theme1' ||
                                    $theme == 'theme2' ||
                                    $theme == 'theme4' ||
                                    $theme == 'theme5' ||
                                    $theme == 'theme6' ||
                                    $theme == 'theme8' ||
                                    $theme == 'theme9' ||
                                    $theme == 'theme10' ||
                                    $theme == 'theme7')
                                    <a href="#Header_Setting" id="Header_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Home Header') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                                @if ($theme == 'theme10')
                                    <a href="#latest_categories" id="latest_categories_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Latest Categories') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if ($theme == 'theme10')
                                <a href="#latest_Products" id="latest_products_tab"
                                    class="list-group-item list-group-item-action border-0">{{ __('Latest Products') }}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            @endif
                             @if ($theme == 'theme10')
                             <a href="#Categories" id="Categories_tab"
                             class="list-group-item list-group-item-action border-0">{{ __('Home Categories') }}
                             <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                         </a>
                            @endif
                            @if ($theme == 'theme10')
                            <a href="#top_purchased" id="Features_Setting_tab"
                                class="list-group-item list-group-item-action border-0">
                                {{ __('Top Purchased') }}
                                <div class="float-end">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                            </a>
                        @endif
                                @if ($theme == 'theme1' ||
                                    $theme == 'theme2' ||
                                    $theme == 'theme4' ||
                                    $theme == 'theme3' ||
                                    $theme == 'theme5' ||
                                    $theme == 'theme6' ||
                                    $theme == 'theme8' ||
                                    $theme == 'theme7')
                                    <a href="#Features_Setting" id="Features_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Home Promotions') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                                @if ($theme == 'theme7' || $theme == 'theme8')
                                    <a href="#top_purchased" id="Features_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">
                                        {{ __('Top Purchased') }}
                                        <div class="float-end">
                                            <i class="ti ti-chevron-right"></i>
                                        </div>
                                    </a>
                                @endif

                                @if ($theme == 'theme8')
                                    <a href="#product_header" id="Features_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Product Section Header') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                                @if ($theme == 'theme8')
                                    <a href="#latest_product" id="Footer_1_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Latest Product') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                                @if ($theme == 'theme1' ||
                                    $theme == 'theme2' ||
                                    $theme == 'theme4' ||
                                    $theme == 'theme5' ||
                                    $theme == 'theme6' ||
                                    $theme == 'theme8' ||
                                    $theme == 'theme9' ||
                                    $theme == 'theme7')
                                    <a href="#Email_Subscriber_Setting" id="Email_Subscriber_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Home Email Subscriber') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                                @if ($theme == 'theme9')
                                    <a href="#top_purchased" id="Features_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">
                                        {{ __('Top Purchased') }}
                                        <div class="float-end">
                                            <i class="ti ti-chevron-right"></i>
                                        </div>
                                    </a>
                                @endif
                                @if ($theme == 'theme9')
                                    <a href="#Features_Setting" id="Features_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Home Promotions') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                                @if ($theme == 'theme9')
                                    <a href="#Banner_Setting" id="Features_Setting_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Central Banner') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if ($theme == 'theme1' ||
                                    $theme == 'theme2' ||
                                    $theme == 'theme4' ||
                                    $theme == 'theme3' ||
                                    $theme == 'theme6' ||
                                    $theme == 'theme8' ||
                                    $theme == 'theme9' ||
                                    $theme == 'theme7')
                                    <a href="#Categories" id="Categories_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Home Categories') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if ($theme == 'theme1' ||
                                    $theme == 'theme2' ||
                                    $theme == 'theme3' ||
                                    $theme == 'theme4' ||
                                    $theme == 'theme5' ||
                                    $theme == 'theme6' ||
                                    $theme == 'theme9' ||
                                    $theme == 'theme10' ||
                                    $theme == 'theme8' ||
                                    $theme == 'theme7')
                                    <a href="#Testimonials" id="Testimonials_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Home Testimonial') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if ($theme == 'theme1' ||
                                    $theme == 'theme2' ||
                                    $theme == 'theme4' ||
                                    $theme == 'theme5' ||
                                    $theme == 'theme6' ||
                                    $theme == 'theme10' ||
                                    $theme == 'theme7')
                                    <a href="#Brand_Logo" id="Brand_Logo_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Brand Logo') }}<div
                                            class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                @endif
                                @if ($theme == 'theme10')
                                <a href="#Email_Subscriber_Setting" id="Email_Subscriber_Setting_tab"
                                    class="list-group-item list-group-item-action border-0">{{ __('Home Email Subscriber') }}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            @endif
                                @if ($theme == 'theme1' ||
                                    $theme == 'theme2' ||
                                    $theme == 'theme5' ||
                                    $theme == 'theme6' ||
                                    $theme == 'theme7' ||
                                    $theme == 'theme9' ||
                                    $theme == 'theme10' ||
                                    $theme == 'theme8')
                                    <a href="#Footer_1" id="Footer_1_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Home Footer 1') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                                @if ($theme == 'theme3' || $theme == 'theme4')
                                    <a href="#Footer_1" id="Footer_1_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Home Footer 1') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif

                                @if ($theme == 'theme1' ||
                                    $theme == 'theme2' ||
                                    $theme == 'theme3' ||
                                    $theme == 'theme4' ||
                                    $theme == 'theme5' ||
                                    $theme == 'theme6' ||
                                    $theme == 'theme8' ||
                                    $theme == 'theme10' ||
                                    $theme == 'theme9' ||
                                    $theme == 'theme7')
                                    <a href="#Footer_2" id="Footer_2_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Home Footer 2') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                                @if ($theme == 'theme6')
                                    <a href="#Quote" id="Quote_tab"
                                        class="list-group-item list-group-item-action border-0">{{ __('Landing Quote') }}
                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
                @if (Auth::user()->type == 'Owner')

                    <div class="col-xl-9">

                        {{-- @dd($getStoreThemeSetting) --}}

                        <div class="col-lg-12 col-sm-12 col-md-12 ">
                            <div class="row">
                                {{ Form::open(['route' => ['store.storeeditproducts', [$store->slug, $theme]], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                {{-- top bar setting --}}
                                @if ($theme == 'theme1')
                                    @php
                                        $storethemesetting = \App\Models\Utility::demoStoreThemeSetting($store->id, $store->theme_dir);
                                    @endphp
                                    <div class="active" id="Top_Bar_Setting">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <div>
                                                            <h5>{{ __('Top Bar Setting') }}</h5>
                                                            <small>
                                                                {{ __('Note: This detail will use to change header setting.') }}</small>
                                                        </div>
                                                        <div class="text-end">
                                                            <div class="form-check form-switch ">
                                                                <input type="hidden" name="enable_top_bar"
                                                                    value="off">
                                                                @if (!empty($storethemesetting['enable_top_bar']))
                                                                    <input type="checkbox"
                                                                        class="form-check-input mx-2 off switch"
                                                                        data-toggle="switchbutton" name="enable_top_bar"
                                                                        id="enable_top_bar"
                                                                        {{ $storethemesetting['enable_top_bar'] == 'on' ? 'checked="checked"' : '' }}>
                                                                @else
                                                                    <input type="checkbox"
                                                                        class="form-check-input mx-2 off switch"
                                                                        data-toggle="switchbutton" name="enable_top_bar"
                                                                        id="enable_top_bar">
                                                                @endif
                                                                {{-- <label class="form-check-label" for="enable_top_bar">{{__('Enable Header Img')}}</label> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class=" setting-card">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {{ Form::label('top_bar_title', __('Top Bar Title'), ['class' => 'col-form-label']) }}
                                                                        {{ Form::text('top_bar_title', !empty($storethemesetting['top_bar_title']) ? $storethemesetting['top_bar_title'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Top Bar Title')]) }}
                                                                        @error('top_bar_title')
                                                                            <span class="invalid-top_bar_title"
                                                                                role="alert">
                                                                                <strong
                                                                                    class="text-danger">{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {{ Form::label('top_bar_number', __('Top Bar Number'), ['class' => 'col-form-label']) }}
                                                                        {{ Form::text('top_bar_number', !empty($storethemesetting['top_bar_number']) ? $storethemesetting['top_bar_number'] : '', ['class' => 'form-control', 'placeholder' => __('Top Bar Number')]) }}
                                                                        @error('top_bar_number')
                                                                            <span class="invalid-top_bar_number"
                                                                                role="alert">
                                                                                <strong
                                                                                    class="text-danger">{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {{ Form::label('top_bar_whatsapp', __('Whatsapp'), ['class' => 'col-form-label']) }}
                                                                        {{ Form::text('top_bar_whatsapp', !empty($storethemesetting['top_bar_whatsapp']) ? $storethemesetting['top_bar_whatsapp'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Whatsapp')]) }}
                                                                        @error('top_bar_whatsapp')
                                                                            <span class="invalid-top_bar_whatsapp"
                                                                                role="alert">
                                                                                <strong
                                                                                    class="text-danger">{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {{ Form::label('top_bar_instagram', __('Instagram'), ['class' => 'col-form-label']) }}
                                                                        {{ Form::text('top_bar_instagram', !empty($storethemesetting['top_bar_instagram']) ? $storethemesetting['top_bar_instagram'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Instagram')]) }}
                                                                        @error('top_bar_instagram')
                                                                            <span class="invalid-top_bar_instagram"
                                                                                role="alert">
                                                                                <strong
                                                                                    class="text-danger">{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {{ Form::label('top_bar_twitter', __('Twitter'), ['class' => 'col-form-label']) }}
                                                                        {{ Form::text('top_bar_twitter', !empty($storethemesetting['top_bar_twitter']) ? $storethemesetting['top_bar_twitter'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Twitter')]) }}
                                                                        @error('top_bar_twitter')
                                                                            <span class="invalid-top_bar_twitter"
                                                                                role="alert">
                                                                                <strong
                                                                                    class="text-danger">{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {{ Form::label('top_bar_messenger', __('Messenger'), ['class' => 'col-form-label']) }}
                                                                        {{ Form::text('top_bar_messenger', !empty($storethemesetting['top_bar_messenger']) ? $storethemesetting['top_bar_messenger'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Messenger')]) }}
                                                                        @error('top_bar_messenger')
                                                                            <span class="invalid-top_bar_messenger"
                                                                                role="alert">
                                                                                <strong
                                                                                    class="text-danger">{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- @dd($getStoreThemeSetting) --}}
                                @foreach ($getStoreThemeSetting as $json_key => $section)
                                    @php
                                        $id = '';

                                        if ($section['section_name'] == 'Home-Brand-Logo') {
                                            $id = 'Brand_Logo';
                                        }
                                        if ($section['section_name'] == 'Home-Header') {
                                            $id = 'Header_Setting';
                                            $class = 'card';
                                        }
                                        if ($section['section_name'] == 'Home-Promotions') {
                                            $id = 'Features_Setting';
                                        }
                                        if ($section['section_name'] == 'Home-Email-Subscriber') {
                                            $id = 'Email_Subscriber_Setting';
                                        }
                                        if ($section['section_name'] == 'Home-Categories') {
                                            $id = 'Categories';
                                        }
                                        if ($section['section_name'] == 'Home-Testimonial') {
                                            $id = 'Testimonials';
                                        }
                                        if ($section['section_name'] == 'Home-Footer-1') {
                                            $id = 'Footer_1';
                                        }
                                        if ($section['section_name'] == 'Home-Footer-2') {
                                            $id = 'Footer_2';
                                        }
                                        if ($section['section_name'] == 'Banner-Image') {
                                            $id = 'Banner_Img_Setting';
                                        }
                                        if ($section['section_name'] == 'Quote') {
                                            $id = 'Quote';
                                        }
                                        if ($section['section_name'] == 'Top-Purchased') {
                                            $id = 'top_purchased';
                                        }
                                        if ($section['section_name'] == 'Product-Section-Header') {
                                            $id = 'product_header';
                                        }
                                        if ($section['section_name'] == 'Latest Product') {
                                            $id = 'latest_product';
                                        }
                                        if ($section['section_name'] == 'Central-Banner') {
                                            $id = 'Banner_Setting';
                                        }
                                        if ($section['section_name'] == 'Latest-Category') {
                                            $id = 'latest_categories';
                                        }
                                        if ($section['section_name'] == 'Latest-Products') {
                                            $id = 'latest_Products';
                                        }

                                    @endphp
                                    <input type="hidden" name="array[{{ $json_key }}][section_name]"
                                        value="{{ $section['section_name'] }}">
                                    <input type="hidden" name="array[{{ $json_key }}][section_slug]"
                                        value="{{ $section['section_slug'] }}">
                                    <input type="hidden" name="array[{{ $json_key }}][array_type]"
                                        value="{{ $section['array_type'] }}">
                                    <input type="hidden" name="array[{{ $json_key }}][loop_number]"
                                        value="{{ $section['loop_number'] }}">
                                    @php
                                        $loop = 1;
                                        $section = (array) $section;
                                    @endphp

                                    @if ($json_key == 0 ||
                                        ($json_key - 1 > -1 && $getStoreThemeSetting[$json_key - 1]['section_slug'] != $section['section_slug']))
                                        <div class="card " id="{{ $id }}">
                                            <div class="card-header d-flex justify-content-between">
                                                <div>
                                                    <h5> {{ $section['section_name'] }} </h5>
                                                </div>
                                                <div class="text-end">
                                                    <div class="form-check form-switch ">
                                                        <input type="hidden"
                                                            name="array[{{ $json_key }}][section_enable]{{ $section['section_enable'] }}"
                                                            value="off">
                                                        <input type="checkbox" class="form-check-input mx-2 off switch"
                                                            data-toggle="switchbutton"
                                                            name="array[{{ $json_key }}][section_enable]{{ $section['section_enable'] }}"
                                                            id="array[{{ $json_key }}]{{ $section['section_slug'] }}"
                                                            {{ $section['section_enable'] == 'on' ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                    <div class="card-body">
                                        @php $loop1 = 1; @endphp
                                        @if ($section['array_type'] == 'multi-inner-list')
                                            @php
                                                $loop1 = (int) $section['loop_number'];
                                            @endphp
                                        @endif

                                        @for ($i = 0; $i < $loop1; $i++)
                                            <div class="row">

                                                @foreach ($section['inner-list'] as $inner_list_key => $field)
                                                    <?php $field = (array) $field; ?>

                                                    <input type="hidden"
                                                        name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_name]"
                                                        value="{{ $field['field_name'] }}">
                                                    <input type="hidden"
                                                        name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_slug]"
                                                        value="{{ $field['field_slug'] }}">
                                                    <input type="hidden"
                                                        name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_help_text]"
                                                        value="{{ $field['field_help_text'] }}">
                                                    <input type="hidden"
                                                        name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_default_text]"
                                                        value="{{ $field['field_default_text'] }}">
                                                    <input type="hidden"
                                                        name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_type]"
                                                        value="{{ $field['field_type'] }}">

                                                    @if ($field['field_type'] == 'text')
                                                        @if ($field['field_name'] == 'Footer Quick Link Header Name 1' ||
                                                            $field['field_name'] == 'Footer Quick Link Header Name 2' ||
                                                            $field['field_name'] == 'Footer Quick Link Header Name 3' ||
                                                            $field['field_name'] == 'Footer Quick Link Header Name 4')
                                                            <div class="col-sm-12">
                                                            @else
                                                                <div class="col-sm-6">
                                                        @endif
                                                        <div class="form-group">
                                                            <label
                                                                class="float-start form-label">{{ $field['field_name'] }}</label>
                                                            @php
                                                                $checked1 = $field['field_default_text'];
                                                                if (!empty($section[$field['field_slug']][$i])) {
                                                                    $checked1 = $section[$field['field_slug']][$i];
                                                                }
                                                            @endphp
                                                            @if ($section['array_type'] == 'multi-inner-list')
                                                                <input type="text"
                                                                    name="array[{{ $json_key }}][{{ $field['field_slug'] }}][{{ $i }}]"
                                                                    class="form-control" value="{{ $checked1 }}"
                                                                    placeholder="{{ $field['field_help_text'] }}">
                                                            @else
                                                                <input type="text"
                                                                    name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_default_text]"class="form-control"
                                                                    value="{{ $field['field_default_text'] }}"
                                                                    placeholder="{{ $field['field_help_text'] }}">
                                                            @endif
                                                        </div>
                                            </div>
                                        @endif

                                        @if ($field['field_type'] == 'text area')
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">{{ $field['field_name'] }}</label>
                                                    @php
                                                        $checked1 = $field['field_default_text'];
                                                        if (!empty($section[$field['field_slug']][$i])) {
                                                            $checked1 = $section[$field['field_slug']][$i];
                                                        }
                                                    @endphp
                                                    @if ($section['array_type'] == 'multi-inner-list')
                                                        <textarea class="form-control" name="array[{{ $json_key }}][{{ $field['field_slug'] }}][{{ $i }}]"
                                                            rows="3" placeholder="{{ $field['field_help_text'] }}">{{ $checked1 }}</textarea>
                                                    @else
                                                        <textarea class="form-control"
                                                            name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_default_text]" {{-- name="array[{{ $section['section_slug'] }}][{{ $field['field_slug'] }}]" --}}
                                                            rows="3" placeholder="{{ $field['field_help_text'] }}">{{ $field['field_default_text'] }}</textarea>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        @if ($field['field_type'] == 'photo upload')
                                            <div class="col-sm-6">
                                                @if ($section['array_type'] == 'multi-inner-list')
                                                    @php
                                                        $checked2 = $field['field_default_text'];
                                                        if (!empty($section[$field['field_slug']])) {
                                                            $checked2 = $section[$field['field_slug']][$i];
                                                            if (is_array($checked2)) {
                                                                $checked2 = $checked2['field_prev_text'];
                                                            }
                                                        }
                                                        $imgdisplay = \App\Models\Utility::get_file('uploads/');

                                                    @endphp
                                                    <div class="form-group">
                                                        <label class="form-label">{{ $field['field_name'] }}</label>
                                                        <input type="hidden"
                                                            name="array[{{ $json_key }}][{{ $field['field_slug'] }}][{{ $i }}][field_prev_text]"
                                                            value="{{ $checked2 }}">
                                                        <input type="file"
                                                            name="array[{{ $json_key }}][{{ $field['field_slug'] }}][{{ $i }}][image]"
                                                            class="form-control"
                                                            placeholder="{{ $field['field_help_text'] }}">
                                                    </div>

                                                    @if (isset($checked2) && !is_array($checked2))
                                                        <img src="{{ asset(Storage::url('uploads/' . $checked2)) }}"
                                                            style="width: auto; max-height: 80px;">
                                                    @else
                                                        <img src="{{$imgdisplay}}{{$field['field_default_text']}}"
                                                            style="width: auto; max-height: 80px;">
                                                    @endif
                                                @else
                                                    @php
                                                        $imgdisplay = \App\Models\Utility::get_file('uploads/');
                                                    @endphp
                                                    <div class="form-group">
                                                        <label class="form-label">{{ $field['field_name'] }}</label>
                                                        <input type="hidden"
                                                            name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_prev_text]"
                                                            value="{{ $field['field_default_text'] }}">
                                                        <input type="file"
                                                            name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_default_text]"
                                                            class="form-control"
                                                            placeholder="{{ $field['field_help_text'] }}">
                                                    </div>

                                                    <img src="{{$imgdisplay}}{{$field['field_default_text']}} "
                                                        id="{{ $field['field_slug'] == 'header-tag' || $field['field_slug'] == 'product-header-tag' || $field['field_slug'] == 'tag-image' || $field['field_slug'] == 'homepage-footer-logo8' || $field['field_slug'] == 'homepage-category-tag-image' ? 'shadow-img' : '' }}"
                                                        class="{{$field['field_slug'] == 'homepage-category-tag-image' ? 'homepage-category-tag-image' : ''}}"

                                                        @if (!empty($getStoreThemeSetting['dashboard'])) style=""
                                                        @else
                                                        style="width: auto; height: 65px;"
                                                        @endif

                                                        @if ($field['field_slug'] == 'homepage-footer-logo')
                                                        style="width: auto; height: 80px;"
                                                        @else
                                                        style="width: 200px; height: 200px;"
                                                        @endif

                                                        {{-- @if ()
                                                        style="width: auto; height: 28px;"
                                                        @endif --}}
                                                        >

                                                @endif
                                            </div>
                                        @endif

                                        @if ($field['field_type'] == 'button')
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">{{ $field['field_name'] }}</label>
                                                    <input type="text"
                                                        name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_default_text]"
                                                        class="form-control" value="{{ $field['field_default_text'] }}"
                                                        placeholder="{{ $field['field_help_text'] }}">
                                                </div>
                                            </div>
                                        @endif

                                        @php
                                            $checked = '';
                                            if ($field['field_slug'] == 'homepage-quick-link-enable') {
                                                $checked = $field['field_default_text'] == 'on' ? 'checked' : '';
                                            }
                                            if ($field['field_slug'] == 'homepage-testimonial-card-enable') {
                                                // echo $field['field_default_text'];
                                                $checked = $field['field_default_text'] == 'on' ? 'checked' : '';
                                                // dd($checked);
                                            }
                                        @endphp

                                        @if ($field['field_type'] == 'checkbox')
                                            @if ($field['field_name'] == 'Enable Testimonial' ||
                                                $field['field_name'] == 'Enable Quick Link 1' ||
                                                $field['field_name'] == 'Enable Quick Link 2' ||
                                                $field['field_name'] == 'Enable Quick Link 3' ||
                                                $field['field_name'] == 'Enable Quick Link 4')
                                                <hr>
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                @else
                                                    <div class="col-sm-6 d-flex justify-content-end">
                                            @endif
                                            <label class="form-label float-start">{{ $field['field_name'] }}</label>
                                            <div class="form-check form-switch  mb-2">
                                                @if ($section['array_type'] == 'multi-inner-list')
                                                    @php
                                                        $checked1 = '';

                                                        if (!empty($section[$field['field_slug']][$i]) && $section[$field['field_slug']][$i] == 'on') {
                                                            $checked1 = 'checked';
                                                        } else {
                                                            if (!empty($section['section_enable']) && $section['section_enable'] == 'on') {
                                                                $checked1 = 'checked';
                                                            }
                                                        }

                                                    @endphp

                                                    <input type="hidden"
                                                        name="array[{{ $json_key }}][{{ $field['field_slug'] }}][{{ $i }}]"
                                                        value="off">
                                                    <input type="checkbox" class="form-check-input mx-2"
                                                        name="array[{{ $json_key }}][{{ $field['field_slug'] }}][{{ $i }}]"
                                                        id="array[{{ $section['section_slug'] }}][{{ $field['field_slug'] }}]"
                                                        {{ $checked1 }}>
                                                @else
                                                    @php
                                                        $checked = '';
                                                        if (!empty($field['field_default_text']) && $field['field_default_text'] == 'on') {
                                                            $checked = 'checked';
                                                        }
                                                    @endphp
                                                    <input type="hidden"
                                                        name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_default_text]"
                                                        value="off">
                                                    <input type="checkbox" class="form-check-input mx-2"
                                                        name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][field_default_text]"
                                                        id="array[{{ $section['section_slug'] }}][{{ $field['field_slug'] }}]"
                                                        {{ $checked }}>
                                                @endif

                                                <label class="form-check-label"
                                                    for="array[ {{ $section['section_slug'] }}][{{ $field['field_slug'] }}]">
                                                </label>
                                            </div>
                                    </div>
                                @endif

                                @if ($field['field_type'] == 'multi file upload')
                                    <div class="form-group">
                                        <label class="form-label">{{ $field['field_name'] }}</label>

                                        <input type="file"
                                            name="array[{{ $json_key }}][inner-list][{{ $inner_list_key }}][multi_image][]"
                                            class="form-control custom-input-file" multiple>
                                    </div>
                                    <div id="img-count" class="badge badge-success rounded-pill"></div>
                                    <div class="col-12">
                                        <div class="card-wrapper p-3 lead-common-box">
                                            @if (!empty($field['image_path']))
                                                @foreach ($field['image_path'] as $key => $file_pathh)
                                                    <div class="card mb-3 border shadow-none product_Image"
                                                        data-value="{{ $file_pathh }}">
                                                        <div class="px-3 py-3">
                                                            <div class="row align-items-center">
                                                                <div class="col ml-n2">
                                                                    <p class="card-text small text-muted">

                                                                        <img class="rounded"
                                                                            src="{{ asset(Storage::url('uploads/' . $file_pathh)) }}"
                                                                            width="70px" alt="Image placeholder"
                                                                            data-dz-thumbnail>
                                                                    </p>
                                                                </div>
                                                                <div class="col-auto actions">
                                                                    <a class="action-item"
                                                                        href=" {{ asset(Storage::url('uploads/' . $file_pathh)) }}"
                                                                        download="" data-toggle="tooltip"
                                                                        data-original-title="{{ __('Download') }}">
                                                                        <i class="fas fa-download"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-auto actions">
                                                                    <a name="deleteRecord"
                                                                        class="action-item deleteRecord"
                                                                        data-name="{{ $file_pathh }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                @endforeach
            </div>
            @endfor

        </div>
        @if ($json_key + 1 <= count($getStoreThemeSetting) - 1)
            {{-- @DD($getStoreThemeSetting[$json_key+1]) --}}
            @if ($getStoreThemeSetting[$json_key + 1]['section_slug'] != $section['section_slug'])
    </div>
    @endif
    @endif
    @endforeach

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-footer">
                    <div class="col-sm-12 px-2">
                        <div class="text-end">
                            {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}



    </div>
    </div>
    </div>
    @endif

    </div>
    <!-- [ sample-page ] end -->
    </div>
    </div>
@endsection
@push('script-page')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"></script>
    <script>
        function check_theme(color_val) {
            $('.theme-color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.repeater').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                isFirstItemUndeletable: true
            })
        });

        $(".deleteRecord").click(function() {
            var name = $(this).data("name");
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: '{{ route('brand.file.delete', [$store->slug, $theme, '_name']) }}'.replace('_name',
                    name),
                type: 'DELETE',
                data: {
                    "name": name,
                    "_token": token,
                },
                success: function(response) {
                    show_toastr('Success', response.success, 'success');
                    $('.product_Image[data-value="' + response.name + '"]').remove();
                },
                error: function(response) {
                    show_toastr('Error', response.error, 'error');
                }
            });
        });
    </script>
    <script src="{{ asset('custom/libs/summernote/summernote-bs4.js') }}"></script>
    <script>
        var Dropzones = function() {
            var e = $('[data-toggle="dropzone1"]'),
                t = $(".dz-preview");
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            e.length && (Dropzone.autoDiscover = !1, e.each(function() {
                var e, a, n, o, i;
                e = $(this), a = void 0 !== e.data("dropzone-multiple"), n = e.find(t), o = void 0, i = {
                    url: "{{ route('store.storeeditproducts', [$store->slug, $theme]) }}",
                    headers: {
                        'x-csrf-token': CSRF_TOKEN,
                    },
                    thumbnailWidth: null,
                    thumbnailHeight: null,
                    previewsContainer: n.get(0),
                    previewTemplate: n.html(),
                    maxFiles: 10,
                    parallelUploads: 10,
                    autoProcessQueue: true,
                    uploadMultiple: true,
                    acceptedFiles: a ? null : "image/*",
                    success: function(file, response) {
                        if (response.status == "success") {
                            show_toastr('success', response.success, 'success');
                            {{-- // window.location.href = "{{route('product.index')}}"; --}}
                        } else {
                            show_toastr('Error', response.msg, 'error');
                        }
                    },
                    error: function(file, response) {
                        // Dropzones.removeFile(file);
                        if (response.error) {
                            show_toastr('Error', response.error, 'error');
                        } else {
                            show_toastr('Error', response, 'error');
                        }
                    },
                    init: function() {
                        var myDropzone = this;
                    }

                }, n.html(""), e.dropzone(i)
            }))
        }()

        $("#eventBtn").click(function() {
            $("#BigButton").clone(true).appendTo("#fileUploadsContainer").find("input").val("").end();
        });
        $("#testimonial_eventBtn").click(function() {
            $("#BigButton2").clone(true).appendTo("#fileUploadsContainer2").find("input").val("").end();
        });

        $(document).on('click', '#remove', function() {
            var qq = $('.BigButton').length;

            if (qq > 1) {
                var dd = $(this).attr('data-id');

                $(this).parents('#BigButton').remove();
            }
        });
        $("input[type='file']").on("change", function() {
            var numFiles = $(this).get(0).files.length
            $('#img-count').html(numFiles + ' Images selected');
        })
    </script>
@endpush
