@extends($activeTemplate.'layouts.auth_user')
@php
$getInstruction = getContent('sales_point_instruction.content', true);
@endphp

@section('content')
    <div class="container">
        <div class="custom--card">
            <div class="card-body">
                <!-- profile section start -->
                <div class="profile-section">
                    <div class="card-header text-left  justify-content-between d-flex">
                        <h4 class="d-inline">@lang('Convert to Balance')</h4>
                        <h5 class="d-inline text-primary">@lang('Available Points'): {{ getAmount(auth()->user()->point) }}
                        </h5>
                    </div>
                    <form class="mt-3" action="{{ route('user.store.convert.point') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>@lang('Point')</label>
                            <input type="number" name="point" class="form--control" placeholder="Enter your desire point."
                                min="{{ $general->limit_convert_point }}" value="old('point')">
                        </div>
                        <ul class="list-group mb-3 list-group-flush d-none" id="list">
                            <li class="list-group-item"><code>@lang('Minimum start to :')
                                    {{ $general->limit_convert_point }} @lang('Points')</code> </li>
                            <li class="list-group-item"><code>@lang('Point per value :')
                                    {{ showAmount($general->convert_price) }} {{ $general->cur_text }}</code> </li>
                            <li class="list-group-item"><code>@lang('Total converted amount:') <span id="amount"></span>
                                </code></li>
                        </ul>
                        <button type="submit" class="btn btn--gradient">@lang('Covert Now')</button>
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
                var x = document.getElementById('list');
                if ($(this).val()) {
                    x.classList.remove("d-none");
                    x.classList.add("d-block");
                }
                if ($(this).val() == "") {
                    x.classList.remove("d-block");
                    x.classList.add("d-none");
                }
                var point = $('[name=point]').val();
                if (point > 0) {
                    var value = '{{ $general->convert_price }}';
                    var finalAmount = parseFloat(point * value).toFixed(2) + ' ' +
                        ' {{ $general->cur_text }}';
                }
                // check if number is 0
                else if (point >= 0) {
                    var finalAmount = 'Invalid';
                }
                $('#amount').text(finalAmount);
            });
        })
    </script>
@endpush
