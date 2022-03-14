@extends($activeTemplate.'layouts.frontend')
@section('content')
    @forelse ($forums as $forum)
        <div class="forum-block">
            <div class="forum-block__header">
                <h4 class="forum-block__title">{{ __($forum->name) }} </h4>
            </div>
            <div class="forum-block__body">
                @foreach ($forum->categories as $categories)

                    @foreach ($categories->posts->where('status', 1) as $post)
                        <div class="single-thread">
                            <div class="single-thread__left">
                                <h5 class="single-thread__title"><a
                                        href="{{ route('post.details', $post->id) }}">{{ __(shortDescription($post->title, 80)) }}</a>
                                </h5>
                                <p class="mt-2">{{ __(shortDescription($post->description)) }} <a
                                        href="{{ route('post.details', $post->id) }}">@lang('see more')</a></p>
                            </div>
                            <div class="single-thread__right">
                                <div class="top">
                                    <ul class="top__list">
                                        <li>
                                            <span class="fs--14px">@lang('Forum Topics')</span>
                                            <h3>{{ count($categories->posts->where('status', 1)) }}</h3>
                                        </li>
                                        <li>
                                            <span class="fs--14px">@lang('Activities')</span>
                                            <h6 class="fs--14px"> {{ diffForHumans($post->updated_at) }}
                                            </h6>
                                        </li>
                                    </ul>
                                </div>
                                <div class="bottom">
                                    <span class="fs--14px mb-2">@lang('Post Author')</span>
                                    <div class="latest-topic">
                                        <div class="latest-topic__thumb">
                                            <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $post->user->image, imagePath()['profile']['user']['size']) }}"
                                                alt="@lang('Profile Image')">
                                            <img />
                                        </div>
                                        <div class="latest-topic__content">
                                            <h6 class="latest-topic__title"><a href="{{route('post.user.profile', $post->user->id)}}">
                                                    {{ __($post->user->username) }}
                                                </a></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- single-thread end -->
                    @endforeach
                @endforeach
            </div>
        </div><!-- forum-block end -->
    @empty
        <div class="container-fluid d-flex justify-content-center">
            <span class="navbar-brand mb-0 h1">{{ __($emptyMessage) }}</span>
        </div>
    @endforelse



        @if ($forums->hasPages())
            <div class="mt-3">
                {{ paginateLinks($forums) }}
            </div>

        @endif

@endsection
