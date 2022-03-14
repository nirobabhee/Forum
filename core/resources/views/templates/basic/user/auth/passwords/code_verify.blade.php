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
                            <h2 class="text-white">@lang('Welcome to') {{$general->sitename}} @lang("'s World")</h2>
                            <p class="text-white mt-2">@lang('Iusto ipsum dolor sit amet consectetur
                                adipisicing.
                                Dicta eaque recusandae dolore repellendus.')</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="account-content">
                        <div class="text-center mb-5">
                            <h2 class="account-content__title">@lang('Varification Code')</h2>
                        </div>
                        <form action="{{ route('user.password.verify.code') }}" method="POST"
                        class="cmn-form mt-30">
                        @csrf

                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group">
                            <label class="mb-0">@lang('Verification
                                Code')</label>
                            <input type="text" name="code" id="code" class="form--control style--two"
                            placeholder="Enter valid code">

                        </div>

                        <div class="form-group row mb-5">
                            <div class="w-100">
                                <button type="submit" class="btn btn-sm w-100 btn--gradient">
                                    @lang('Verify Code')
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
                       <p>@lang('Please check including your Junk/Spam Folder. if not found, you can')
                        <a href="{{ route('user.password.request') }}">@lang('Try to send again')</a>.</p>
                    </div>

                    </div>
                </div>

            </div>
        </div><!-- account-wrapper end -->

    </div>
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
