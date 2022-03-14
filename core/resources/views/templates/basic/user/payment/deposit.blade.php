@extends($activeTemplate.'layouts.auth_user')

@section('content')

    <div class="container">
        <div class="row">
            @foreach ($gatewayCurrency as $data)
                <div class="col-lg-4 col-md-4 mb-5 getway">

                    <div class="card-sl p-2">
                        <div class="card-image mb-2">
                            <img src="{{ $data->methodImage() }}" alt="{{ __($data->name) }}">
                        </div>
                        <a href="javascript:void(0)" data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                            data-currency="{{ $data->currency }}" data-method_code="{{ $data->method_code }}"
                            data-min_amount="{{ showAmount($data->min_amount) }}"
                            data-max_amount="{{ showAmount($data->max_amount) }}"
                            data-base_symbol="{{ $data->baseSymbol() }}"
                            data-fix_charge="{{ showAmount($data->fixed_charge) }}"
                            data-percent_charge="{{ showAmount($data->percent_charge) }}" data-bs-toggle="modal"
                            data-bs-target="#depositModal" class="card-button btn--gradient deposit "> @lang('Withdraw')</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- -------Modal------ --}}
    <div class="modal fade" id="depositModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title method-name" id="depositModalLabel"></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.deposit.insert') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p class="text-danger depositLimit"></p>
                        <p class="text-danger depositCharge"></p>
                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency">
                            <input type="hidden" name="method_code" class="edit-method-code">
                        </div>
                        <div class="form-group">
                            <label>@lang('Enter Amount'):</label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form--control form-control-lg" name="amount"
                                    placeholder="@lang('Amount')" required value="{{ old('amount') }}">
                                <div class=" input-group-append">
                                    <span class="form--control input-group-text">{{ __($general->cur_text) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
                        <div class="prevent-double-click">
                            <button type="submit" class="btn btn--gradient confirm-btn">@lang('Confirm')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.deposit').on('click', function() {
                var name = $(this).data('name');
                var currency = $(this).data('currency');
                var method_code = $(this).data('method_code');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var baseSymbol = "{{ $general->cur_text }}";
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `@lang('Deposit Limit'): ${minAmount} - ${maxAmount}  ${baseSymbol}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge =
                    `@lang('Charge'): ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' +percentCharge + ' % ' : ''}`;
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`@lang('Payment By ') ${name}`);
                $('.currency-addon').text(baseSymbol);
                $('.edit-currency').val(currency);
                $('.edit-method-code').val(method_code);
            });

            $('.prevent-double-click').on('click', function() {
                $(this).addClass('button-none');
                // $(this).html('<i class="las la-spinner fa-spin"></i> @lang('Processing')...');
            });
        })(jQuery);
    </script>
@endpush


@push('style')
    <style>
        /*  Helper Styles */
        body {
            font-family: Varela Round;
            background: #f1f1f1;
        }

        a {
            text-decoration: none;
        }

        /* Card Styles */

        .card-sl {
            border-radius: 8px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .card-image img {
            max-height: 100%;
            max-width: 100%;
            border-radius: 8px 8px 0px 0;
        }

        .card-action {
            position: relative;
            float: right;
            margin-top: -25px;
            margin-right: 20px;
            z-index: 2;
            color: #E26D5C;
            background: #fff;
            border-radius: 100%;
            padding: 15px;
            font-size: 15px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);
        }

        .card-action:hover {
            color: #fff;
            background: #E26D5C;
            -webkit-animation: pulse 1.5s infinite;
        }

        .card-button {
            display: flex;
            justify-content: center;
            padding: 10px 0;
            width: 100%;
            background-color: #1F487E;
            color: #fff;
            border-radius: 0 0 8px 8px;
        }

        .card-button:hover {
            text-decoration: none;
            background-color: #1D3461;
            color: #fff;

        }

    </style>
@endpush
