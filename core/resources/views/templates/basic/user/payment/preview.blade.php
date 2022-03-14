@extends($activeTemplate.'layouts.auth_user')
@section('content')
    {{-- @dd($data) --}}
    <div class="container">
        <div class="row justify-content-center m-2">
            <div class="col-md-12">

                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-5 p-3">
                            <img src="{{ $data->gatewayCurrency()->methodImage() }}" alt="{{ $data->name }}"
                                class="img-fluid" />
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="d-flex w-100 justify-content-between list-group-item list-group-item-action">
                                    <h6 class="text-muted"> @lang('Amount'):</h6>
                                    <h6 class="mb-1">{{ showAmount($data->amount) }} </strong>
                                        {{ __($general->cur_text) }}</h5>

                                </div>
                                <div class="d-flex w-100 justify-content-between list-group-item list-group-item-action">
                                    <h6 class="text-muted"> @lang('Charge'):</h6>
                                    <h6 class="mb-1">{{ showAmount($data->charge) }} </strong>
                                        {{ __($general->cur_text) }}</h5>

                                </div>
                                <div class="d-flex w-100 justify-content-between list-group-item list-group-item-action">
                                    <h6 class="text-muted"> @lang('Payable'):</h6>
                                    <h6 class="mb-1">{{ showAmount($data->amount + $data->charge) }}</strong>
                                        {{ __($general->cur_text) }}</h5>

                                </div>
                                <div class="d-flex w-100 justify-content-between list-group-item list-group-item-action">
                                    <h6 class="text-muted"> @lang('Conversion Rate'):</h6>
                                    <h6 class="mb-1">{{ __($general->cur_text) }} =
                                        {{ showAmount($data->rate) }} {{ __($data->baseCurrency()) }}</h5>

                                </div>
                                <div class="d-flex w-100 justify-content-between list-group-item list-group-item-action">
                                    <h6 class="text-muted"> @lang('In') {{ $data->baseCurrency() }}:</h6>
                                    <h6 class="mb-1 ">{{ showAmount($data->final_amo) }}</h5>

                                </div>

                                <div class="d-flex justify-content-center mt-5">
                                    @if (1000 > $data->method_code)
                                        <a href="{{ route('user.deposit.confirm') }}"
                                            class="btn btn--gradient btn-block m-3 font-weight-bold">@lang('Pay Now')</a>
                                    @else
                                        <a href="{{ route('user.deposit.manual.confirm') }}"
                                            class="btn btn--gradient btn-block m-3 font-weight-bold">@lang('Pay Now')</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>






            </div>







        </div>
    </div>
@endsection
