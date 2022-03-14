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

        </div>
    </div>
    <!-- header-section start  -->
    @include($activeTemplate."partials.header")
    <!-- header-section end  -->
    <div class="main-wrapper">
        <!-- board section start -->
        <div class="profile-section">
            <div class="profile-header bg_img"
                style="background-image: url('{{ asset($activeTemplateTrue . 'images/bg/bg1.jpg') }}');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="profile-thumb">
                                <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $user->image, imagePath()['profile']['user']['size']) }}"
                                    alt="@lang('Profile Image')">
                                <img />
                            </div>
                            @if (auth()->user())
                                @if (auth()->user()->id == $user->id)
                                    <h3 class="profile-name text-white mt-3">
                                        @lang('Others See ')<i class="las la-eye"></i>
                                    </h3>
                                @else
                                    <h3 class="profile-name text-white mt-3">
                                        {{ __($user->firstname . ' ' . $user->lastname) }}</h3>
                                @endif
                            @else
                                <h3 class="profile-name text-white mt-3">
                                    {{ __($user->firstname . ' ' . $user->lastname) }}</h3>
                            @endif
                            <ul
                                class="profile-info-list d-flex flex-wrap align-items-center text-white justify-content-center mt-1">
                                <li><i class="las la-flag"></i> {{ __(@$user->address->country) }}</li>
                                <li><i class="las la-user-clock"></i> @lang('Since')
                                    {{ $user->created_at->format('Y') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="profile-nav p-0 navbar navbar-expand-md">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#profileNavbar" aria-controls="profileNavbar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="las la-bars"></i> <span>@lang('menu')</span>
                    </button>
                    <div class="collapse navbar-collapse" id="profileNavbar">
                        <ul class="profile-menu profile m-auto">
                            <li class=""><a href="{{ route('post.user.profile', $user->id) }}"><i
                                        class="las la-user-circle"></i> @lang('Bio')</a></li>
                            <li><a href=" {{ route('user.posts', $user->id) }}"><i class="las la-clipboard-list"></i>
                                    @lang('Posts')</a></li>
                            <li><a href="{{ route('user.answered', $user->id) }}"><i
                                        class="las la-clipboard-check"></i> @lang('Answered')</a></li>
                            <li><a href="{{ route('user.upVote', $user->id) }}"><i class="las la-arrow-up"></i>
                                    @lang('Up Vote')</a></li>
                            <li><a href="{{ route('user.downVote', $user->id) }}"><i class="las la-arrow-down"></i>
                                    @lang('Down Vote')</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="profile-details-wrapper">
                <div class="container">
                    <div class="row justify-content-center">
                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
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

        //active route
        let link = $('.profile li a');
        let activateRoute = '{{ url()->current() }}';

        $.each(link, function(index, value) {
            if (value.href == activateRoute) {
                let li = value.closest('li');
                $(li).addClass('active');
            }
        });
    </script>


</body>

</html>
