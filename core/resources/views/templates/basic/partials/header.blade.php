<header class="header">
    <div class="header__bottom px-xl-5">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-xl p-0 align-items-center">
                <div class="logo">
                    <a href="{{ route('home') }}" class="site-logo site-title"><img
                            src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}"
                            alt="@lang('image')"></a>
                </div>

                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="menu-toggle"></span>
                </button>


                <button class="header-search-open-btn">
                    <i class="las la-search"></i>
                </button>
                <form action="{{ route('search') }}" class="header-search-form header-search-form-mobile"
                    method="GET">
                    <input type="text" name="search" placeholder=" @lang('Search here...')"
                        class="header-search-form__input text-light" value="{{ request()->search ?? null }}">
                    <button type="submit" class="header-search-form__btn"><i class="las la-search"></i></button>
                </form>

                <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
                    <div class="header-search-area ms-auto">
                        <form action="{{ route('search') }}" class="header-search-form" method="GET">
                            <input type="text" name="search" placeholder="Search here..."
                                class="header-search-form__input text-white" value="{{ request()->search ?? null }}">
                            <button type="submit" class="header-search-form__btn"><i
                                    class="las la-search"></i></button>
                        </form>
                    </div>
                    {{-- menu's --}}
                    <ul class="navbar-nav main-menu ms-auto menus">
                        <li class="nav-item {{ menuActive('home') }}"><a
                                href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>

                        @foreach ($pages as $k => $data)
                            <li class="nav-item {{ menuActive('pages', [$data->slug]) }}">
                                <a href="{{ route('pages', [$data->slug]) }}" class="nav-link">{{ __($data->name) }}</a>
                            </li>
                        @endforeach

                        @guest
                            <li class="nav-item">
                                <a href="{{ route('user.login') }}" class="btn btn-md btn--gradient d-flex align-items-center px-2"><i class="las la-user fs--18px"></i> @lang('Login')</a>
                            </li>
                        @endguest

                        @auth

                            <li class="nav-item">
                                <a href="{{ route('user.home') }}">
                                    {{ __(ucwords(auth()->user()->username)) }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.logout') }}"  class="btn btn-md btn--gradient d-flex align-items-center px-3"><i
                                        class="las la-sign-out-alt fs--18px"></i> @lang('Logout')</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </div><!-- header__bottom end -->
</header>
