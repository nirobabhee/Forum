@extends($activeTemplate.'layouts.master')
@php
$getContact = getContent('contact_us.content', true);
@endphp
@section('content')
    <!-- contact section start -->
    <section class="conatact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="contact-wrapper">
                        <div class="text-center">
                            <h2 class="">{{ __($getContact->data_values->title) }}</h2>
                            <p>{{ __($getContact->data_values->short_details) }}</p>
                        </div>
                        <div class="row mt-5 gy-4">
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <i class="las la-map-marker"></i>
                                    <p>{{ __($getContact->data_values->contact_details) }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <i class="las la-phone"></i>
                                    <p><a href="tel:{{$getContact->data_values->contact_number}}">{{ __($getContact->data_values->contact_number) }}</a></p>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-item">
                                    <i class="las la-envelope"></i>
                                    <p><a href="mailto:{{$getContact->data_values->email_address}}">{{ __($getContact->data_values->email_address) }}</a></p>

                                </div>
                            </div>
                        </div><!-- row end -->
                        <form class="mt-5" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>@lang('Name')<span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="@if (auth()->user()) {{ auth()->user()->fullname }} @else {{ old('name') }} @endif" @if (auth()->user()) readonly @endif required class="
                                        form--control" placeholder="@lang('Full name')">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>@lang('Email')<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form--control"
                                        placeholder="@lang('Email addres')" value="@if (auth()->user()) {{ auth()->user()->email }} @else {{ old('email') }} @endif" @if (auth()->user()) readonly @endif required>
                                    </div>
                                    <div class=" form-group col-lg-12">
                                    <label>@lang('Subject')<span class="text-danger">*</span></label>
                                    <input type="text" name="subject" class="form--control"
                                        placeholder="@lang('Your subject')" value="{{ old('subject') }}" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>@lang('Message')<span class="text-danger">*</span></label>
                                    <textarea name="message" class="form--control"
                                        placeholder="@lang('Your message')">{{ old('message') }}</textarea>
                                </div>
                                <div class="col-lg-12 text-end">
                                    <button type="submit" class="btn btn--gradient">@lang('Submit Now')</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- contact-wrapper end -->
                </div>
            </div>
        </div>
    </section>
    <!-- contact section end -->
@endsection
