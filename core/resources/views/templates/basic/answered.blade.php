@extends($activeTemplate.'layouts.profile')
@section('content')
    <div class="col-lg-10">
        @forelse ($posts as $post)
            <div class="single-post">
                <span class="forum-badge">{{ __($post->category->forum->name) }}</span>
                <div class="single-post__thumb">
                    <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $post->user->image, imagePath()['profile']['user']['size']) }}"
                        alt="@lang('Profile Image')">
                    <img />
                </div>
                <div class="single-post__content">
                    <h3 class="single-post__title"><a href="{{ route('post.details', $post->id) }}">
                            {{ __($post->title) }}</a></h3>
                    <ul class="single-post__meta d-flex align-items-center mt-1">
                        <li>@lang('Post By ')<a href="{{ route('user.posts', $post->user->id) }}" class="text--base"><i
                                    class="las la-user"></i> {{ __($post->user->username) }}</a></li>
                        <li><i class="las la-clock"></i>{{ diffForHumans($post->created_at) }}</li>
                    </ul>
                </div>
                <div class="single-post__footer">

                    <p class="mt-2">{{ __(shortDescription($post->description)) }} <a
                        href="{{ route('post.details', $post->id) }}">@lang('see more')</a></p>
                    <div class="single-post__action-list d-flex flex-wrap align-items-center mt-3">
                        <ul class="left">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Up Vote"><a href="{{ route('post.details', $post->id) }}"
                                    class="text--success"><i class="las la-arrow-up text--success"></i>
                                    {{ $post->down_vote }}</a></li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Down Vote"><a href="{{ route('post.details', $post->id) }}"><i
                                        class="las la-arrow-down"></i> {{ $post->up_vote }}</a></li>
                        </ul>
                        <ul class="right">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Views"><i
                                        class="las la-eye"></i> {{ $post->view }}</li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Comments"><a
                                    href="{{ route('post.details', $post->id) }}"><i class="las la-comments"></i>
                                    {{ count($post->comments) }}</a></li>
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
        <nav class="mt-3">
            @if ($posts->hasPages())
                <ul class="pagination-md justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                </ul>
                {{ paginateLinks($posts) }}
            @endif
        </nav>
    </div>
    <!-- profile section end -->
@endsection
