@extends($activeTemplate.'layouts.auth_user')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($withdrawMethod as $data)
                <div class="col-md-4">
                    <div class="card-sl p-2">
                        <div class="card-image mb-2">
                            <img src="{{ getImage(imagePath()['withdraw']['method']['path'] . '/' . $data->image, imagePath()['withdraw']['method']['size']) }}"
                                alt="{{ __($data->name) }}">
                        </div>

                        <a href="javascript:void(0)" data-id="{{ $data->id }}" data-resource="{{ $data }}"
                            data-min_amount="{{ showAmount($data->min_limit) }}"
                            data-max_amount="{{ showAmount($data->max_limit) }}"
                            data-fix_charge="{{ showAmount($data->fixed_charge) }}"
                            data-percent_charge="{{ showAmount($data->percent_charge) }}"
                            data-processing_hours="{{ $data->delay }}" data-base_symbol="{{ __($general->cur_text) }}"
                            data-bs-toggle="modal" data-bs-target="#withdrawModal"
                            class="card-button btn--gradient withdraw "> @lang('Withdraw')</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="withdrawModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title method-name" id="withdrawModalLabel">@lang('Withdraw')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.withdraw.money') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p class="text-danger withdrawLimit"></p>
                        <p class="text-danger withdrawCharge"></p>
                        <p class="text-danger processingHours"></p>

                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency form-control">
                            <input type="hidden" name="method_code" class="edit-method-code  form-control">
                        </div>

                        <div class="form-group">
                            <label>@lang('Enter Amount'):</label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form--control form-control-lg"
                                    onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount"
                                    placeholder="0.00" required="" value="{{ old('amount') }}">

                                <div class="input-group-prepend">
                                    <span
                                        class="form--control input-group-text addon-bg currency-addon">{{ __($general->cur_text) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--gradient">@lang('Confirm')</button>
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
            $('.withdraw').on('click', function() {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var withdrawLimit =
                    `@lang('Withdraw Limit'): ${minAmount} - ${maxAmount}  {{ __($general->cur_text) }}`;

                $('.withdrawLimit').text(withdrawLimit);
                var withdrawCharge =
                    `@lang('Charge'): ${fixCharge} {{ __($general->cur_text) }} ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.withdrawCharge').text(withdrawCharge);
                var processHours = `@lang('Processing Hour'): ${$(this).data('processing_hours')} `;
                $('.processingHours').text(processHours);
                $('.method-name').text(`@lang('Withdraw Via') ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
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
