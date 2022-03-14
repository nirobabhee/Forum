@extends($activeTemplate.'layouts.master')
@php
$getMsg = getContent('welcome_register_messege.content', true);
$getPolicy = getContent('policy_pages.element');
@endphp
@section('content')

    <div class="container">
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
                                            <h2 class="text-white">@lang('Welcome to '){{ $general->sitename }}</h2>
                                            <p class="text-white mt-2">{{ __($getMsg->data_values->message) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="account-content">
                                        <div class="text-center mb-5">
                                            <h2 class="account-content__title">@lang('Get Started')</h2>
                                            <p class="mt-2 fs--14px">@lang("Haven't an account?") <a
                                                    href="{{ route('user.login') }}">@lang('Login')</a>
                                            </p>
                                        </div>
                                        <form action="{{ route('user.register') }}" method="POST"
                                            onsubmit="return submitUserForm();">
                                            @csrf

                                            @if (session()->get('reference') != null)
                                                <div class="form-group">
                                                    {{-- Refferal- --}}
                                                    <div class="input-group px-5">
                                                        <span class="input-group-text text-primary style--two"
                                                            for="referenceBy float-right" id="basic-addon3">@lang('Referred
                                                            By')</span>

                                                        <input type="text" id="referenceBy" class="form-control style--two"
                                                            value="{{ session()->get('reference') }}" readonly
                                                            aria-describedby="basic-addon3">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label class="mb-0">@lang('First Name')</label>
                                                <input type="text" name="firstname" value="{{old('firstname')}}" autocomplete="off"
                                                    class="form--control style--two" placeholder="@lang('Enter firstname')">
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-0">@lang('Last Name')</label>
                                                <input type="text" name="lastname" autocomplete="off" value="{{old('lastname')}}"
                                                    class="form--control style--two" placeholder="@lang('Enter lastname')">
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-0">@lang('User Name')<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="username" autocomplete="off" value="{{old('username')}}"
                                                    class="form--control style--two checkUser"
                                                    placeholder="@lang('Enter username')">
                                            </div>

                                            <div class="form-group">
                                                <label class="mb-0">{{ __('Country') }}<span
                                                        class="text-danger">*</span></label>
                                                <select name="country" id="country" class="form--control style--two">
                                                    @foreach ($countries as $key => $country)
                                                        <option data-mobile_code="{{ $country->dial_code }}"
                                                            value="{{ $country->country }}"
                                                            data-code="{{ $key }}">{{ __($country->country) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="mb-0">{{ __('Number') }}<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group form--control style--two checkUser">
                                                    <div class="input-prepend">
                                                        <span class="form--control mobile-code code--control">
                                                        </span>

                                                        <input type="hidden" name="mobile_code">
                                                        <input type="hidden" name="country_code">
                                                    </div>
                                                    <input type="number" name="mobile" id="mobile"
                                                        value="{{ old('mobile') }}"
                                                        class="form--control style--two checkAgent"
                                                        placeholder="@lang('Your Phone Number')" min="0">
                                                </div>
                                                <small class="text-danger mobileExist"></small>
                                            </div>

                                            <div class="form-group">
                                                <label class="mb-0">@lang('Email')<span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                    autocomplete="off" class="form--control style--two checkUser"
                                                    placeholder="@lang('Enter email address')" required>
                                            </div>
                                            <div class="form-group hover-input-popup">
                                                <label class="mb-0">@lang('Password')<span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password" autocomplete="off"
                                                    class="form--control style--two" placeholder="@lang('Enter password')"
                                                    required>
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
                                            <div class="from-group">
                                                <label class="mb-0">@lang('Confirm Password')<span
                                                        class="text-danger">*</span></label>
                                                <input id="password-confirm" type="password"
                                                    class="form--control style--two" name="password_confirmation"
                                                    placeholder="Confirm your password" required
                                                    autocomplete="new-password">
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 ">
                                                </div>
                                                <div class="col-md-6 ">
                                                    @php echo loadReCaptcha() @endphp
                                                </div>
                                            </div>
                                            @include($activeTemplate.'partials.custom_captcha')
                                            @if ($general->agree)
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="form-check ">
                                                            <input class="form-check-input" type="checkbox" name="agree"
                                                                id="agree" {{ old('agree') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="agree"> @lang('I agree with')
                                                                @foreach ($getPolicy as $page)
                                                                    <a href="{{ route('policy.page', [$page->id, slug($page->data_values->title)]) }}">{{ $page->data_values->title }}</a>
                                                                    @if (!$loop->last) , @endif
                                                                @endforeach
                                                            </label><span class="text-danger"> *</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn--gradient w-100">@lang('Signup
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
            <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="existModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-center">@lang('You already have an account please Sign in ')</h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                            <a href="{{ route('user.login') }}" class="btn btn-primary">@lang('Login')</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- account section end -->
    </div>
@endsection




@push('style')
    <style>
        .country-code .input-group-prepend .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }

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

        .code--control {
            border-top: 0;
            border-left: 0;

        }

    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
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
        (function($) {
            @if ($mobile_code)
                $(`option[data-code={{ $mobile_code }}]`).attr('selected','');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            @if ($general->secure_password)
                $('input[name=password]').on('input',function(){
                secure_password($(this));
                });
            @endif

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response['data'] && response['type'] == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response['data'] != null) {
                        $(`.${response['type']}Exist`).text(`${response['type']} already exist`);
                    } else {
                        $(`.${response['type']}Exist`).text('');
                    }
                });
            });

        })(jQuery);
    </script>
@endpush
