@extends($activeTemplate.'layouts.master')
@php
$getMsg = getContent('welcome_register_messege.content', true);
@endphp

@section('content')
    <div class="container">
        <section class="pt-100 pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="account-wrapper">
                            <div class="row gy-4">
                                <div class="col-lg-6">
                                    <div class="account-thumb bg_img h-100 d-flex flex-wrap align-items-center justify-content-center rounded-3"
                                        style="background-image: url({{ asset($activeTemplateTrue . 'images/bg/bg1.jpg') }});">
                                        <div class="text-center">
                                            <h2 class="text-white">@lang('Welcome to Alochona')</h2>
                                            <p class="text-white mt-2">{{ $getMsg->data_values->message }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="account-content">
                                        <form action="{{ route('user.verify.email') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <p class="text-center">@lang('Your Email'):
                                                    <strong>{{ auth()->user()->email }}</strong>
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label class="text--primary">@lang('Verification Code:')</label>
                                                <input type="text" name="email_verified_code" class="form-control"
                                                    placeholder="@lang('Enter valid verification code!')" id="code">
                                            </div>
                                            <div class="form-group">
                                                <div class="btn-area text-center">
                                                    <button type="submit"
                                                        class="btn btn-sm btn--gradient w-100">@lang('Submit')</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <p>@lang('Please check including your Junk/Spam Folder. if not found, you
                                                    can') <a href="{{ route('user.send.verify.code') }}?type=email"
                                                        class="forget-pass">
                                                        @lang('Resend code')</a></p>
                                                @if ($errors->has('resend'))
                                                    <br />
                                                    <mark><small
                                                            class="text-danger">{{ $errors->first('resend') }}</small></mark>
                                                @endif
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
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('#code').on('input change', function() {
                var xx = document.getElementById('code').value;

                $(this).val(function(index, value) {
                    value = value.substr(0, 7);
                    return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
                });

            });
        })(jQuery)
    </script>
@endpush
