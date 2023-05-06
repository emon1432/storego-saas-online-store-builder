
@extends('storefront.layout.theme6')
@section('page-title')
    {{ __('Blog') }}
@endsection
@push('css-page')
@endpush
@php
if (!empty(session()->get('lang'))) {
    $currantLang = session()->get('lang');
} else {
    $currantLang = $store->lang;
}
$languages = \App\Models\Utility::languages();
$imgpath=\App\Models\Utility::get_file('uploads/store_logo/');

@endphp
@section('content')
    <div class="wrapper">
        <section class="blog-section padding-top padding-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="blog-car-view">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="name">{{$blogs->title}}</span>
                                <span class="date">{{\App\Models\Utility::dateFormat($blogs->created_at)}}</span>
                            </div>
                            <div class="img-wrapper">
                                @if (!empty($blogs->blog_cover_image) && \Storage::exists('uploads/store_logo/' . $blogs->blog_cover_image))
                                    <img alt="Image placeholder"
                                        src="{{ $imgpath . $blogs->blog_cover_image }}"
                                        class="img-fluid rounded">
                                @else
                                    <img alt="Image placeholder"
                                        src="{{ asset(Storage::url('uploads/store_logo/default.jpg')) }}"
                                        class="img-fluid rounded">
                                @endif
                            </div>
                            <ul class="blog-content">
                                <li>
                                    {{-- <b> The standard Lorem Ipsum passage, used since the 1500s</b> --}}
                                    <p>
                                        {!! $blogs->detail !!}
                                    </p>
                                </li>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('script')
@endpush

