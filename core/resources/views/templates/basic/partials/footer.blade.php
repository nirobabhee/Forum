<footer class="footer-section">
    @php
        $social_icons = getContent('social_icon.element');
    @endphp
    <div class="container-fluid px-xxl-5">
        <div class="row gy-3 align-items-center">
            <div class="col-lg-5 col-sm-8 order-lg-1 order-2 text-sm-start text-center">
                <p>@lang('Copyright ©') {{ \Carbon\Carbon::now()->format('Y') }} <a
                        href="{{ route('home') }}">{{ $general->sitename }}</a>
                    @lang('All Right Reserved')</p>
            </div>
            <div class="col-lg-2 order-lg-2 order-1 text-center">
                <div class="logo">
                    <a href="{{ route('home') }}" class="site-logo site-title"><img
                            src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}"
                            alt="@lang('image')"></a>
                </div>
            </div>
            <div class="col-lg-5 col-sm-4 order-lg-3 order-3">
                <ul
                    class="social-link d-flex flex-wrap align-items-center justify-content-sm-end justify-content-center">
                    @foreach ($social_icons as $icon)
                        <li title="{{ $icon->data_values->title }}"> <a target="_blank"
                                href="{{ $icon->data_values->url }}">@php
                                    echo $icon->data_values->social_icon;
                                @endphp</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>
