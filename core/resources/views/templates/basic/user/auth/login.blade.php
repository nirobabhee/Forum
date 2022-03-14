@extends($activeTemplate.'layouts.master')

@php
    $authMessage = getContent('welcome_auth.content', true);
@endphp

@section('content')
    <div class="container">
        <!-- account section start -->
        <section class="pt-50 pb-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="account-wrapper">
                            <div class="row gy-4">
                                <div class="col-lg-6">
                                    <div class="account-thumb bg_img h-100 d-flex flex-wrap align-items-center justify-content-center rounded-3"
                                        style="background-image: url({{ asset($activeTemplateTrue . 'images/bg/bg1.jpg') }});">
                                        <div class="text-center">
                                            <h2 class="text-white">@lang('Welcome to') {{ $general->sitename }}
                                                @lang("'s World")</h2>
                                            <p class="text-white mt-2">{{ __(@$authMessage->data_values->message) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="account-content">
                                        <div class="text-center mb-5">
                                            <h2 class="account-content__title">@lang('Get Started')</h2>
                                            <p class="mt-2 fs--14px">@lang("Haven't an account?")' <a
                                                    href="{{ route('user.register') }}">@lang('Sign Up')</a>
                                            </p>
                                        </div>
                                        <form method="POST" action="{{ route('user.login') }}"
                                            onsubmit="return submitUserForm();">
                                            @csrf
                                            <div class="form-group">
                                                <label class="mb-0">@lang('Username or Email')</label>
                                                <input type="text" name="username" autocomplete="off"
                                                    class="form--control style--two"
                                                    placeholder="@lang('Enter email address')"
                                                    value="{{ old('username') }}" placeholder="@lang('Username or Email')"
                                                    required>

                                            </div>
                                            <div class="form-group">
                                                <label class="mb-0">{{ __('Password') }}</label>
                                                <input type="password" name="password" autocomplete="off"
                                                    class="form--control style--two" placeholder="@lang('Enter password')"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                            id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="remember">
                                                            @lang('Remember Me')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="col-md-4">
                                                </div>
                                                <div class="col-md-6 ">
                                                    @php echo loadReCaptcha() @endphp
                                                </div>
                                            </div>
                                            @include($activeTemplate.'partials.custom_captcha')
                                            <div class="form-group text-center mb-0">
                                                <div class="col-md-12">
                                                    <a href="{{ route('user.password.request') }}">
                                                        @lang('Forgot Your Password?')
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="text-center mt-4">
                                                <button type="submit" id="recaptcha"
                                                    class="btn btn--gradient w-100">@lang('Login
                                                    Now')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- account-wrapper end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- account section end -->
    </div>
@endsection

@push('script')
    <script>
        "use strict";

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
    </script>
@endpush
