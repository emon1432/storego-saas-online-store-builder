@extends('storefront.layout.theme6')
@section('page-title')
    {{ __('Register') }}
@endsection
@push('css-page')
@endpush
@section('content')
    <div class="wrapper">
        <section class="register-section padding-top padding-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-12 mx-auto">
                        <h2>{{ __('Customer Register ') }}</h2>

                        {!! Form::open(['route' => ['store.userstore', $slug]], ['method' => 'post']) !!}
                        <div class="form-group mb-3 mt-2">
                            <label for="fullName" class="form-label mt-2">{{ __('Full Name') }}</label>
                            <input name="name" class="form-control" type="text" id="fullName"
                                placeholder="{{ __('Full Name *') }}" required="required">
                        </div>

                    @error('name')
                        <span class="error invalid-email text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group mb-3 mt-2">
                        <label for="registerEmail" class="form-label mt-2">{{ __('Email') }}</label>
                        <input name="email" class="form-control" id="registerEmail" type="email"
                            placeholder="{{ __('Email *') }}" required="required">
                    </div>
                    @error('email')
                        <span class="error invalid-email text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group mb-3 mt-2">
                        <label for="number" class="form-label mt-2">{{ __('Number') }}</label>
                        <input name="phone_number" class="form-control" type="text" placeholder="{{ __('Number *') }}"
                            required="required" id="number">
                    </div>
                    @error('number')
                        <span class="error invalid-email text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group mb-3 ">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input name="password" class="form-control" type="password" placeholder="{{ __('Password *') }}"
                            required="required" id="password">
                    </div>
                    @error('password')
                        <span class="error invalid-email text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group mb-3 ">
                        <label for="confirmPassword" class="form-label">{{ __('Confirm Password') }}</label>
                        <input name="password_confirmation" class="form-control" type="password"
                            placeholder="{{ __('Confirm Password *') }}" required="required" id="confirmPassword">
                    </div>
                    @error('password_confirmation')
                        <span class="error invalid-email text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group mt-5 mb-3">
                        <p class="m-0">{{ __('By using the system, you accept the') }} <a href=""
                                class="text-secondary">
                                {{ __('Privacy Policy') }} </a> {{ __('and') }} <a href=""
                                class="text-secondary"> {{ __('System Regulations.') }} </a>
                        </p>
                        <button type="submit" class="btn btn-secondary submit-btn mt-3">{{ __('Register') }}</button>
                    </div>
                    {!! Form::close() !!}

                    <div class="login-tag text-center mt-5">
                        <p>{{ __('Dont have account ?') }} <a href="{{ route('customer.loginform', $slug) }}"
                                class="text-secondary"> {{ __('login now') }} </a> </p>
                    </div>
                </div>

                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
@push('script-page')
@endpush
