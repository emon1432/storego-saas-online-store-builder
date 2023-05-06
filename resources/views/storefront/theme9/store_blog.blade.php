@extends('storefront.layout.theme9')
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
$imgpath=\App\Models\Utility::get_file('uploads/store_logo/');
$languages = \App\Models\Utility::languages();

@endphp
@section('content')
    <div class="wrapper mt-10 mb-8">
        <section class="blog-section padding-top padding-bottom mt-5">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-6 col-12 mb-4 d-flex">
                            <a href="{{route('store.store_blog_view',[$store->slug,$blog->id])}}" class="blog-card w-100">
                                @if(!empty($blog->blog_cover_image) && \Storage::exists('uploads/store_logo/'.$blog->blog_cover_image))
                                <img alt="" class="img-fluid" src="{{$imgpath.$blog->blog_cover_image}}">
                            @else
                                <img alt="" class="img-fluid" src="{{asset(Storage::url('uploads/store_logo/default.jpg'))}}">
                            @endif
                                <div class="inner-content text-center">
                                    <h4 class="text-white">
                                        {{ $blog->title }}
                                    </h4>
                                    <span class="date">
                                        {{ \App\Models\Utility::dateFormat($blog->created_at) }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            var blog = {{ sizeof($blogs) }};
            if (blog < 1) {
                window.location.href = "{{ route('store.slug', $store->slug) }}";
            }
        });
    </script>
@endpush
