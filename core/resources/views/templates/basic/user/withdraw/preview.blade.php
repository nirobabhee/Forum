@extends($activeTemplate.'layouts.auth_user')

@section('content')
    <div class="container">
        <div class="custom--card">
            <div class="card-body">
                <div class="profile-section">
                    <div class="profile-header">
                        <div class="container">
                            <div class="row justify-content-around">
                                <div class="col-lg-4 text-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <span style="font-size: 48px; color: Dodgerblue;">
                                                <i class="las la-money-bill-wave-alt"></i>
                                            </span>
                                            <h3>
                                                {{ showAmount($withdraw->user->balance) . ' ' . $general->cur_text }}
                                            </h3>
                                            <p class="font-weight-bold">@lang('Current Balance') </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="withdraw-details">
                                                <small class="font-weight-bold">@lang('Request Amount') :</small>
                                                <span
                                                    class="font-weight-bold pull-right">{{ showAmount($withdraw->amount) }}
                                                    {{ __($general->cur_text) }}</span>
                                            </div>
                                            <div class="withdraw-details text-danger">
                                                <small class="font-weight-bold">@lang('Withdrawal Charge') :</small>
                                                <span
                                                    class="font-weight-bold pull-right">{{ showAmount($withdraw->charge) }}
                                                    {{ __($general->cur_text) }}</span>
                                            </div>
                                            <div class="withdraw-details text-info">
                                                <small class="font-weight-bold">@lang('After Charge') :</small>
                                                <span
                                                    class="font-weight-bold pull-right">{{ showAmount($withdraw->after_charge) }}
                                                    {{ __($general->cur_text) }}</span>
                                            </div>
                                            <div class="withdraw-details">
                                                <small class="font-weight-bold">@lang('Conversion Rate') : <br>1
                                                    {{ __($general->cur_text) }} = </small>
                                                <span class="font-weight-bold pull-right">
                                                    {{ showAmount($withdraw->rate) }}
                                                    {{ __($withdraw->currency) }}</span>
                                            </div>
                                            <div class="withdraw-details text-success">
                                                <span class="font-weight-bold">@lang('You Will Get') :</span>
                                                <span
                                                    class="font-weight-bold pull-right">{{ showAmount($withdraw->final_amount) }}
                                                    {{ __($withdraw->currency) }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 text-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <span style="font-size: 48px; color: Dodgerblue;">
                                                <i class="las la-money-bill-wave-alt"></i>
                                            </span>
                                            <h3>{{ showAmount($withdraw->user->balance - $withdraw->amount) . ' ' . $general->cur_text }}
                                            </h3>
                                            <p class="font-weight-bold">@lang('Remaining Balance') </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-details-wrapper" id="1">
                        <div class="container card">

                            <form action="{{ route('user.withdraw.submit') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($withdraw->method->user_data)
                                    @foreach ($withdraw->method->user_data as $k => $v)
                                        @if ($v->type == 'text')
                                            <div class="form-group">
                                                <label class="m-3"><strong>{{ __($v->field_level) }}
                                                        @if ($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <input type="text" name="{{ $k }}" class="form--control"
                                                    value="{{ old($k) }}" placeholder="{{ __($v->field_level) }}"
                                                    @if ($v->validation == 'required') required @endif>
                                                @if ($errors->has($k))
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @elseif($v->type == 'textarea')
                                            <div class="form-group">
                                                <label><strong>{{ __($v->field_level) }}
                                                        @if ($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <textarea name="{{ $k }}" class="form--control"
                                                    placeholder="{{ __($v->field_level) }}" rows="3"
                                                    @if ($v->validation == 'required') required @endif>{{ old($k) }}</textarea>
                                                @if ($errors->has($k))
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @elseif($v->type == 'file')
                                            <label><strong>{{ __($v->field_level) }}
                                                    @if ($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new " data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                        data-trigger="fileinput">
                                                        <img class="w-100" src="{{ getImage('/') }}"
                                                            alt="@lang('Image')">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail wh-200-150">
                                                    </div>
                                                    <div class="img-input-div">
                                                        <span class="form--control btn btn-info btn-file">
                                                            <span class="fileinput-new "> @lang('Select')
                                                                {{ __($v->field_level) }}</span>
                                                            <span class="fileinput-exists"> @lang('Change')</span>
                                                            <input type="file" name="{{ $k }}" accept="image/*"
                                                                @if ($v->validation == 'required') required @endif>
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists mt-2"
                                                            data-bs-dismiss="fileinput"> @lang('Remove')</a>
                                                    </div>
                                                </div>
                                                @if ($errors->has($k))
                                                    <br>
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                @if (auth()->user()->ts)
                                    <div class="form-group">
                                        <label>@lang('Google Authenticator Code')</label>
                                        <input type="text" name="authenticator_code" class="form-control" required>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn--gradient btn-block btn-lg mt-3 text-center">@lang('Confirm')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
