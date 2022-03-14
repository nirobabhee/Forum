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
    <!-- custom select box css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/nice-select.css') }}">
    <!-- code preview css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/prism.css') }}">
    <!-- select 2 css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">

    <link href="{{ asset($activeTemplateTrue . 'vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'vendor//bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'vendor/remixicon/remixicon.css') }}" rel="stylesheet">
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
        </div>
    </div>
    <!-- header-section start  -->

    @include($activeTemplate."partials.header")
    <!-- header-section end  -->
    <div class="main-wrapper  section--bg">
        <!-- board section start -->
        <div class="container">
            <section class="pt-50 pb-50">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-8">
                        {{-- Side Menu --}}
                        @include($activeTemplate."partials.profile_left_aside")
                    </div>
                    <div class="col-xl-9 mt-xl-0 mt-5">
                        {{-- Content -display --}}
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>
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
    <script src="{{ asset($activeTemplateTrue . 'js/main.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/app.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/select2.min.js') }}"></script>

    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')
    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });
            @if (@$cookie->data_values->status && !session('cookie_accepted'))
                $('#cookieModal').modal('show');
            @endif
        })(jQuery);
    </script>
    {{-- <style>
        .user-info-list {
            padding-left: 0 !important;
        }

        .user-info-list li p {
            padding-left: 0px;
            padding-top: 1rem;
        }

        ol,
        ul {
            padding-left: 0rem;
             !important
        }

    </style> --}}
</body>

</html>
