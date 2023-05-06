@extends('storefront.layout.theme6')
@section('page-title')
    {{ __('Login') }}
@endsection
@push('css-page')
@endpush
@section('content')
    <div class="wrapper">
        <section class="login-section padding-top padding-bottom">

            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-12 mx-auto">

                        {!! Form::open(array('route' => array('customer.login', $slug,(!empty($is_cart) && $is_cart==true)?$is_cart:false)),['method'=>'POST']) !!}
                            <div class="form-group mb-3 mt-2">
                                <label for="logInEmail" class="form-label mt-2">{{__('Username')}}</label>
                                    {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Your Email')))}}
                            </div>
                            <div class="form-group mb-3 ">
                                <label for="password" class="form-label">{{__('Password')}}</label>
                                {{Form::password('password',array('class'=>'form-control','id'=>'exampleInputPassword1','placeholder'=>__('Enter Your Password')))}}
                            </div>
                            <div class="form-group mt-5 mb-3">
                                <p class="m-0">{{__('By using the system, you accept the')}} <a href=""
                                        class="text-secondary">
                                        {{__('Privacy Policy')}} </a>{{__('and')}} <a href="" class="text-secondary"> {{__('System Regulations.')}}
                                    </a>
                                </p>
                                <button type="submit" class="btn btn-secondary submit-btn mt-3">{{__('Sign In')}}</button>
                            </div>
                        {{Form::close()}}

                        <div class="register-tag text-center mt-5">
                            <p>{{__('Dont have account ?')}} <a href="{{route('store.usercreate',$slug)}}" class="text-secondary"> {{__('register now')}} </a> </p>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
@push('script-page')
@endpush
