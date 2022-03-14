@extends($activeTemplate.'layouts.auth_user')
@section('content')
    <div class="container card">
        <form class="mt-3" action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-header text-left bg-primary justify-content-between d-flex">
                <h4 class="text-white d-inline">@lang('Profile of ') {{ auth::user()->username }}</h4>
            </div>
            <div class="row my-3">
                <div class="form-group col-lg-6">
                    <label>@lang('First Name')</label>
                    <input name="firstname" type="text" class="form--control" placeholder="@lang('First Name')"
                        value="{{ @Auth::user()->firstname }}" minlength="3">
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('Last Name')</label>
                    <input name="lastname" type="text" class="form--control" placeholder="@lang('Last Name')"
                        value="{{ @Auth::user()->lastname }}" minlength="3">
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('Username')</label>
                    <input name="username" type="text" class="form--control" placeholder="@lang('Enter username')"
                        value="{{ auth::user()->username }}" minlength="6">
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('Mobile number')</label>
                    <input name="mobile" type="number" class="form--control" placeholder="@lang('Enter mobile number')"
                        value="{{ @auth::user()->mobile }}">
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('Address')</label>
                    <input name="address" type="text" class="form--control" placeholder="@lang('Enter Address')"
                        value="{{ @Auth::user()->address->address }}">
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('State')</label>
                    <input name="state" type="text" class="form--control" placeholder="@lang('Enter Address')"
                        value="{{ @auth::user()->address->state }}">
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('Zip Code')</label>
                    <input name="zip" type="text" class="form--control" placeholder="@lang('Enter Address')"
                        value="{{ @auth::user()->address->zip }}">
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('City')</label>
                    <input name="city" type="text" class="form--control" placeholder="@lang('Enter Address')"
                        value="{{ @auth::user()->address->city }}">
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('Country')</label>
                    <input name="country" type="text" class="form--control" placeholder="@lang('Enter Address')"
                        value="{{ @auth::user()->address->country }}">
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('Profile Photo')</label>
                    <input type="file" class="form--control" name="image" accept="image/*"
                        placeholder="@lang('Profile image')">
                    <code>@lang('Update Image, size:')
                        {{ imagePath()['profile']['user']['size'] }}</code>
                </div>

               
                <div class="form-group col-lg-12">
                    <label>@lang('Bio')</label>
                    <textarea class="form--control" name="bio" placeholder="@lang('Update your short Bio')" cols="30"
                        rows="10">{{ @auth::user()->address->bio }}</textarea>
                </div>
                <div class="col-lg-12 text-end">
                    <button type="submit" class="btn btn--gradient">@lang('Update
                        Now')</button>
                </div>
            </div>
        </form>
    </div>
@endsection
