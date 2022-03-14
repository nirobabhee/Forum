@extends($activeTemplate.'layouts.auth_user')
@section('content')
        <div class="container">
            <div class="row justify-content-center">

                            <div class="container card">
                                <form class="mt-3" action="" method="post">
                                    @csrf
                                    <div class="card-header text-left bg-primary justify-content-between d-flex">
                                        <h4 class="text-white d-inline">@lang('Password Reset')</h4>
                                    </div>
                                    <div class="row my-3">
                                        <div class="form-group col-lg-12">
                                            <label for="password">@lang('Current Password')</label>
                                            <input id="password" type="text" class="form-control form--control"
                                                name="current_password" required autocomplete="current-password"
                                                placeholder="@lang('Current Password')">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="password">@lang('Password')</label>
                                            <input id="password" type="password" class="form--control" name="password"
                                                required autocomplete="current-password" placeholder="@lang('Password')">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="confirm_password">@lang('Confirm Password')</label>
                                            <input id="password_confirmation" type="password"
                                                class="form-control form--control" name="password_confirmation" required
                                                autocomplete="current-password" placeholder="@lang('Confirm Password')">
                                        </div>




                                        <div class="col-lg-12 text-end">
                                            <button type="submit" class="btn btn--gradient">@lang('Change
                                                Password')</button>
                                        </div>

                                    </div>
                                </form>
                            </div>


            </div>
        </div>
@endsection
