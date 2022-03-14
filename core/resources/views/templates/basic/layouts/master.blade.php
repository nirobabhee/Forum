<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $general->sitename(__($pageTitle)) }}</title>
    @include('partials.seo')

    <link rel="icon" type="image/png" href="{{ asset($activeTemplateTrue . 'images/favicon.png') }}" sizes="16x16">
    <!-- bootstrap 5  -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/bootstrap.min.css') }}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/all.min.css') }}">
    <!-- lineawesome font -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/line-awesome.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
    <link href="{{ asset($activeTemplateTrue . 'vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset($activeTemplateTrue . 'css/style.css') }}" rel="stylesheet">
    @stack('style-lib')

    @stack('style')

<body>
    <!-- scroll-to-top start -->
    <div class="scroll-to-top">
        <span class="scroll-icon">
            <i class="las la-arrow-up"></i>
        </span>
    </div>
    <!-- scroll-to-top end -->

    <div class="preloader-holder">
        <div class="preloader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- header-section start  -->
    @include($activeTemplate."partials.header")
    <!-- header-section end  -->
    <div class="main-wrapper">
        <!-- board section start -->

        @yield('content')

        {{-- -------End Main Section--------- --}}
        @php
            $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
        @endphp
        <!-- board section end -->
    </div><!-- main-wrapper end -->

    <!-- footer section start -->
    @include($activeTemplate."partials.footer")
    <!-- footer section end -->
    <!-- jQuery library -->
    <script src="{{ asset($activeTemplateTrue . 'js/lib/jquery-3.6.0.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset($activeTemplateTrue . 'js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset($activeTemplateTrue . 'js/app.js') }}"></script>
    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')
    <script>
        (function($) {
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });
            @if (@$cookie->data_values->status && !session('cookie_accepted'))
                $('#cookieModal').modal('show');
            @endif
        })(jQuery);
    </script>

</body>

</html>
