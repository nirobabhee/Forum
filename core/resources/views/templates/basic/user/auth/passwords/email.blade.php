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
                                <h2 class="account-content__title">@lang('Reset Password')</h2>
                            </div>
                            <form method="POST" action="{{ route('user.password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="mb-0">@lang('Select One')</label>
                                   <select class="form--control style--two" name="type">
                                            <option value="email">@lang('E-Mail Address')</option>
                                            <option value="username">@lang('Username')</option>
                                        </select>

                                </div>

                                <div class="form-group">
                                    <label class="mb-0 my_value">@lang('Username or Email')</label>
                                    <input type="text"
                                    class="form--control style--two @error('value') is-invalid @enderror"
                                    name="value" value="{{ old('value') }}" required autofocus="off">

                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="w-100">
                                        <button type="submit" class="btn btn-sm w-100 btn--gradient">
                                            @lang('Send Password Code')
                                        </button>
                                    </div>
                                </div>
                            </form>
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

            myVal();
            $('select[name=type]').on('change', function() {
                myVal();
            });

            function myVal() {
                $('.my_value').text($('select[name=type] :selected').text());
            }
        })(jQuery)
    </script>
@endpush
