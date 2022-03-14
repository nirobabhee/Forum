@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="container">
        <div class="col-xl-12">
            <div class="account-wrapper">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="account-thumb bg_img h-100 d-flex flex-wrap align-items-center justify-content-center rounded-3"
                            style="background-image: url({{ asset($activeTemplateTrue . 'images/bg/bg1.jpg') }});">
                            <div class="text-center">
                                <h2 class="text-white">@lang('Welcome to') {{ $general->sitename }} @lang("'s World")
                                </h2>
                                <p class="text-white mt-2">@lang('Iusto ipsum dolor sit amet consectetur
                                    adipisicing.
                                    Dicta eaque recusandae dolore repellendus.')</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="account-content">
                            <div class="text-center mb-5">
                                <h2 class="account-content__title">@lang('Reset Password')</h2>
                            </div>
                            <form action="{{ route('user.password.update') }}" method="POST" class="cmn-form mt-30">
                                @csrf

                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label class="mb-0">@lang('Reset Password')</label>
                                    <input id="password" type="password"
                                        class="form--control @error('password') is-invalid @enderror style--two" placeholder="Enter new password"
                                        name="password" required>
                                    @if ($general->secure_password)
                                        <div class="input-popup">
                                            <p class="error lower">@lang('1 small letter minimum')</p>
                                            <p class="error capital">@lang('1 capital letter minimum')</p>
                                            <p class="error number">@lang('1 number minimum')</p>
                                            <p class="error special">@lang('1 special character minimum')</p>
                                            <p class="error minimum">@lang('6 character password')</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="mb-0">@lang('Confirm Password')</label>
                                    <input id="password-confirm" type="password" class="form--control style--two" placeholder="Enter confirm password"
                                        name="password_confirmation" required>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="w-100">
                                        <button type="submit" class="btn btn-sm w-100 btn--gradient">
                                            @lang('Reset Password')
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group row mb-5 mt-3">
                               <small> <a href="{{ route('user.login') }}">@lang('Login Here')</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- account-wrapper end -->
        </div>
    </div>


@endsection
@push('style')
    <style>
        .hover-input-popup {
            position: relative;
        }

        .hover-input-popup:hover .input-popup {
            opacity: 1;
            visibility: visible;
        }

        .input-popup {
            position: absolute;
            bottom: 130%;
            left: 50%;
            width: 280px;
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -ms-border-radius: 5px;
            -o-border-radius: 5px;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        .input-popup::after {
            position: absolute;
            content: '';
            bottom: -19px;
            left: 50%;
            margin-left: -5px;
            border-width: 10px 10px 10px 10px;
            border-style: solid;
            border-color: transparent transparent #1a1a1a transparent;
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .input-popup p {
            padding-left: 20px;
            position: relative;
        }

        .input-popup p::before {
            position: absolute;
            content: '';
            font-family: 'Line Awesome Free';
            font-weight: 900;
            left: 0;
            top: 4px;
            line-height: 1;
            font-size: 18px;
        }

        .input-popup p.error {
            text-decoration: line-through;
        }

        .input-popup p.error::before {
            content: "\f057";
            color: #ea5455;
        }

        .input-popup p.success::before {
            content: "\f058";
            color: #28c76f;
        }

    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            @if ($general->secure_password)
                $('input[name=password]').on('input',function(){
                secure_password($(this));
                });
            @endif
        })(jQuery);
    </script>
@endpush
