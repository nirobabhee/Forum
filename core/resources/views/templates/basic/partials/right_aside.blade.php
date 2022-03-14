@php
$getMsg = getContent('welcome_register_messege.content', true);
$getGreeting= getContent('join_greeting.content', true);
@endphp
<aside class="xxxl-2 col-lg-3 d-lg-block d-none">
    @if (!Auth::check())
        <div class="rounded-3 bg--gradient p-4 text-center mb-4">
            <h3 class="fw-normal text-white text-uppercase">{{ __($getGreeting->data_values->message) }}</h3>
            <p class="text-white fs--14px mt-3">{{ __($getMsg->data_values->message) }}</p>
            <a href="{{ route('user.register') }}" class="btn btn--base mt-4">@lang('Registration Now')</a>
        </div>
    @endif

    <div class="sidebar-widget">
        <div class="sidebar-widget__header">
            <h5 class="sidebar-widget__title">@lang('Statistics')</h5>
        </div>
        <div class="sidebar-widget__body">
            <ul class="statistics-list">
                <li class="single-stat">
                    <h3 class="single-stat__number">{{ count($forums) }}</h3>
                    <span class="single-stat__caption fs--14px">@lang('Forums')</span>
                </li>
                <li class="single-stat">
                    <h3 class="single-stat__number">{{ count($categories) }}</h3>
                    <span class="single-stat__caption fs--14px">@lang('Categories')</span>
                </li>
                <li class="single-stat">
                    <h3 class="single-stat__number">{{ count($posts) }}</h3>
                    <span class="single-stat__caption fs--14px">@lang('Threads')</span>
                </li>
                <li class="single-stat">
                    <h3 class="single-stat__number">{{ count($users) }}</h3>
                    <span class="single-stat__caption fs--14px">@lang('Users')</span>
                </li>
            </ul>
        </div>
    </div><!-- sidebar-widget end -->

    @if ($topContributors)
        <div class="sidebar-widget mt-4">
            <div class="sidebar-widget__header">
                <h5 class="sidebar-widget__title">@lang('Top Contributors')</h5>
            </div>
            <div class="sidebar-widget__body">
                <ul class="contributor-list">
                    @foreach ($topContributors as $item)
                        <li class="single-contributor">
                            <div class="single-contributor__thumb">
                                <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $item->user->image, imagePath()['profile']['user']['size']) }}"
                                    alt="@lang('Profile Image')">
                                <img />
                            </div>
                            <h6 class="single-contributor__name"><a
                                    href="{{ route('post.user.profile', $item->user->id) }}">{{ __($item->user->username) }}</a>
                            </h6>
                            <span class="single-contributor__comment fs--14px"><i class="las la-comments"></i>
                                {{ $item->total }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!-- sidebar-widget end -->
    @endif


    @if (count($unAnswered) != 0)
        <div class="sidebar-widget mt-4">
            <div class="sidebar-widget__header">
                <h5 class="sidebar-widget__title">@lang('Unanswered Talks')</h5>
            </div>
            <div class="sidebar-widget__body">
                <ul class="unanswered-list">
                    @foreach ($unAnswered as $item)
                        <li class="single-unanswered">
                            <div class="single-unanswered__top">
                                <div class="single-unanswered__thumb">
                                    <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $item->user->image, imagePath()['profile']['user']['size']) }}"
                                        alt="@lang('Profile Image')">
                                    <img />
                                </div>
                                <div
                                    class="single-unanswered__content d-flex align-items-center justify-content-between">
                                    <h6 class="single-unanswered__name"><a
                                            href="{{ route('post.user.profile', $item->user->id) }}">{{ __($item->user->username) }}
                                        </a></h6>
                                    <p class="fs--12px">
                                        {{ showDateTime($item->created_at, $format = 'd-M-Y') }}</p>
                                </div>

                            </div>
                            <h6 class="single-unanswered__title"><a href="{{ route('post.details', $item->id) }}">
                                    {{ __(shortDescription($item->title, 40)) }}
                                </a></h6>
                            <div class="d-flex">
                                <p class="fs--12px"><i class="las la-comments fs--14px"></i> @lang('0')</p>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!-- sidebar-widget end -->
    @endif

    @if (count($hotPosts) != 0)
        <div class="sidebar-widget mt-4">
            <div class="sidebar-widget__header">
                <h5 class="sidebar-widget__title">@lang('Hot Posts')</h5>
            </div>
            <div class="sidebar-widget__body">
                <ul class="topic-list">
                    @foreach ($hotPosts as $item)
                        <li class="single-topic">
                            <div class="single-topic__thumb">
                                <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $item->user->image, imagePath()['profile']['user']['size']) }}"
                                    alt="@lang('Profile Image')">
                                <img />
                            </div>
                            <div class="single-topic__content">
                                <h6 class="single-topic__title"><a
                                        href="{{ route('post.details', $item->id) }}">{{ __(shortDescription($item->title, 45)) }}
                                    </a>
                                </h6>
                                <span class="fs--12px"><i class="las la-calendar fs--14px"></i>
                                    {{ showDateTime($item->created_at, $format = 'd-M-Y') }} </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!-- sidebar-widget end -->
    @endif
</aside>
