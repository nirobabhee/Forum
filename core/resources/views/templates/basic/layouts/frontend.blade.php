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

    <!-- Template Main CSS File -->
    <link href="{{ asset($activeTemplateTrue . 'css/style.css') }}" rel="stylesheet">
    @stack('style-lib')

    @stack('style')

<body>
    <!-- scroll-to-top start -->
    <div class="scroll-to-top mb-4">
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
        </div>
    </div>
    <!-- header-section start  -->
    @include($activeTemplate."partials.header")
    <!-- header-section end  -->
    <div class="main-wrapper">
        <!-- board section start -->
        <section class="pt-50 pb-50">
            <div class="container-fluid">
                <div class="row px-lg-4">
                    {{-- ---Left Aside-- --}}
                    @include($activeTemplate."partials.left_aside")
                    {{-- ---End Left Aside-- --}}
                    {{-- -------Start Main Section--------- --}}
                    <main class="xxxl-8 col-lg-6 px-lg-4">
                        @yield('content')
                    </main>
                    {{-- -------End Main Section--------- --}}
                    @php
                        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
                    @endphp
                    {{-- ---Right Aside-- --}}
                    @include($activeTemplate."partials.right_aside")
                    {{-- ---End Right Aside-- --}}
                </div>
            </div>
        </section>
        <!-- board section end -->
    </div><!-- main-wrapper end -->
    <div class="modal fade" id="cookieModal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cookieModalLabel">@lang('Cookie Policy')</h5>

                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark cookie-info">
                    @php echo @$cookie->data_values->description @endphp
                    <a class="btn btn-sm btn--base mt-3" href="{{ @$cookie->data_values->link }}"
                        target="_blank">@lang('Read Policy')</a>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('cookie.accept') }}" class="btn btn-primary">@lang('Accept')</a>
                </div>
            </div>
        </div>
    </div>
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


        })(jQuery);

        $(document).ready(function() {
            @if (@$cookie->data_values->status && !session('cookie_accepted'))
                $('#cookieModal').modal('show');
            @endif

        });
    </script>
    <style>
        .cookie-info * {
            color: #000
        }

    </style>

</body>

</html>
