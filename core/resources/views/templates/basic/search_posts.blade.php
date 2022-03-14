@extends($activeTemplate.'layouts.frontend')
@section('content')

    @forelse ($posts as $post)
        <div class="single-post">
            <div class="single-post__thumb">
                <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $post->user->image, imagePath()['profile']['user']['size']) }}"
                    alt="@lang('Profile Image')">
                <img />
            </div>
            <div class="single-post__content">
                <h3 class="single-post__title"><a
                        href="{{ route('post.details', $post->id) }}">{{ __($post->title) }}</a></h3>
                <ul class="single-post__meta d-flex align-items-center mt-1">
                    <li>@lang('Post By') <a href="{{ route('post.user.profile', $post->user->id) }}"
                            class="text--base"><i class="las la-user"></i>
                            {{ __($post->user->username) }}</a></li>
                    <li><i class="las la-clock"></i>{{ diffForHumans($post->created_at) }}</li>
                </ul>
            </div>
            <div class="single-post__footer">
                <p class="mt-3">{{ __($post->description) }}</p>
                <div class="single-post__action-list d-flex flex-wrap align-items-center mt-3">
                    @if (auth()->user())
                        <ul class="left">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Up Vote">
                                <a href="{{ route('post.details', $post->id) }}">
                                    <i class="las la-arrow-up text--success up-vote-count"> </i>
                                    {{ $post->up_vote }}
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Down Vote">
                                <a href="{{ route('post.details', $post->id) }}"> <i
                                        class="las la-arrow-down down-vote-count">
                                    </i>
                                    {{ $post->down_vote }}</a>
                            </li>
                        </ul>
                    @else
                        <ul class="left">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="please Login">
                                <i class="las la-arrow-up text--success up-vote-count"> </i>
                                {{ $post->up_vote }}
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Please Login">
                                <i class="las la-arrow-down down-vote-count">
                                </i>
                                {{ $post->down_vote }}
                            </li>
                        </ul>
                    @endif
                    <ul class="right">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Views"><a href="{{ route('post.details', $post->id) }}"><i
                                    class="las la-eye"></i> {{ $post->view }} @lang('views')</a></li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Comments"><a
                                href="{{ route('post.details', $post->id) }}"><i class="las la-comments"></i>
                                {{ count($post->comments) }}
                                @lang('Comments')</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- single-post end -->
    @empty
        <div class=" no-data-wrapper">
            <h4 class="mt-3">{{ __($emptyMessage) }}</h4>
            <img src="{{ asset($activeTemplateTrue . 'images/no-data.png') }}" alt="image">
        </div>
    @endforelse
    @if ($posts->hasPages())
        <nav class="row navbar navbar-light">
            <div class="container-fluid  d-flex justify-content-center">
                <span class="navbar-brand mb-0 h1">
                    @if ($posts->hasPages())
                        {{ paginateLinks($posts) }}
                    @endif
                </span>
            </div>
        </nav>
    @endif

@endsection
