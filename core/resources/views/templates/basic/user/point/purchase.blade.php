@extends($activeTemplate.'layouts.auth_user')
@section('content')
    <div class="container">
        <div class="custom--card">
            <div class="card-body">
                <!-- profile section start -->
                <div class="profile-section">
                    <div class="card-header text-left  justify-content-between d-flex">
                        <h4 class="d-inline">@lang('Purchase Point')</h4>
                    </div>

                    <form class="mt-3" action="{{ route('user.store.purchase.point') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>@lang('Point')</label>
                            <input type="number" name="point" class="form--control" placeholder="Enter a number" min="1" value="old('point')" autocomplete="off">
                        </div>

                        <ul class="list-group mb-3 list-group-flush" id="list">

                            <li class="list-group-item d-flex flex-wrap justify-content-between">
                                <span>@lang('Current Balance')</span>
                                <span class="text--info">
                                    {{ showAmount(auth()->user()->balance) }} {{ $general->cur_text }}
                                </span>
                            </li>

                            <li class="list-group-item d-flex flex-wrap justify-content-between">
                                <span>1 @lang('Point')</span>
                                <span class="text-danger">
                                    {{ showAmount($general->purchase_price) }} {{ $general->cur_text }}</span>
                                </span>
                            </li>

                            <li class="list-group-item d-flex flex-wrap justify-content-between">
                                <span>@lang('Payable Amount')</span>
                                <span id="amount">0 {{ $general->cur_text}}</span>
                            </li>
                        </ul>
                        <button type="submit" class="btn btn--gradient">@lang('Purchase Now')</button>
                    </form>
                </div>
                <!-- profile section end -->

            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('[name=point]').keyup(function() {
                var x = $('#list');
                if ($(this).val()) {
                    x.removeClass("d-none");
                }else{
                    x.addClass("d-none");
                }

                var point = $(this).val();
                var value = '{{ $general->purchase_price }}';

                var finalAmount = parseFloat(point * value).toFixed( 2 );
                $('#amount').text(`${finalAmount} {{$general->cur_text}}`);
            });
        })
    </script>
@endpush
