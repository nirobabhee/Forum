@extends($activeTemplate.'layouts.profile')
@section('content')
    <!-- profile section start -->
    <div class="col-lg-8">
        <h3 class="mb-3">@lang('About')</h3>
        @if (@$user->address->bio)
        <p>{{ __(@$user->address->bio) }}</p>
        @else
        <div class="no-data-wrapper">
            <h4 class="mt-3">@lang('No Data Found')</h4>
            <img src="{{ asset($activeTemplateTrue . 'images/no-data.png') }}" alt="image">
          </div>

        @endif
    </div>
    <!-- profile section end -->

@endsection
