
@extends('storefront.layout.theme6')
@section('page-title')
    {{ ucfirst($pageoption->name) }}
@endsection
@push('css-page')

@endpush
@php
    if(!empty(session()->get('lang')))
    {
        $currantLang = session()->get('lang');
    }else{
        $currantLang = $store->lang;
    }
    $languages=\App\Models\Utility::languages();
@endphp

@section('content')

<div class="wrapper">
    <section class="blog-section padding-top padding-bottom">
       <div class="container">
          <div class="row">
             <div class="col-lg-8 col-12 mx-auto">
                <div class="blog-car-view">
                   <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="h4 d-inline-block font-weight-bold mb-0 pt-4"> {{ ucfirst($pageoption->name) }}</h5>
                   </div>
                   {!! $pageoption->contents !!}
                </div>
             </div>
       </div>
    </section>
 </div>
@endsection


