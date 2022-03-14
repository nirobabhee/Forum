@extends($activeTemplate.'layouts.profile')
@section('content')
    <div class="col-lg-10">
        @forelse ($upVotes as $item)
            <div class="single-post">
                <span class="forum-badge">{{ __($item->post->category->forum->name) }}</span>
                <div class="single-post__thumb">
                    <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' .$item->post->user->image, imagePath()['profile']['user']['size']) }}"
                        alt="@lang('Profile Image')">
                    <img />
                </div>
                <div class="single-post__content">
                    <h3 class="single-post__title"><a href="{{ route('post.details', $item->post->id) }}">
                            {{ __($item->post->title) }}</a></h3>
                    <ul class="single-post__meta d-flex align-items-center mt-1">
                        <li>@lang('Post By ')<a href="{{ route('user.posts', $item->post->user->id) }}" class="text--base"><i
                                    class="las la-user"></i> {{ __($item->post->user->username) }}</a></li>
                        <li><i class="las la-clock"></i>{{ diffForHumans($item->post->created_at) }}</li>
                    </ul>
                </div>
                <div class="single-post__footer">
                    <p class="mt-2">{{ __(shortDescription($item->post->description)) }} <a
                        href="{{ route('post.details', $item->post->id) }}">@lang('see more')</a></p>

                    <div class="single-post__action-list d-flex flex-wrap align-items-center mt-3">
                        <ul class="left">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Up Vote"><a href="{{ route('post.details', $item->post->id) }}"
                                    class="text--success"><i class="las la-arrow-up text--success"></i>
                                    {{ $item->post->up_vote }}</a></li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Down Vote"><a href="{{ route('post.details', $item->post->id) }}"><i
                                        class="las la-arrow-down"></i> {{ $item->post->down_vote }}</a></li>
                        </ul>
                        <ul class="right">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Views"><a href="{{ route('post.details', $item->post->id) }}"><i
                                        class="las la-eye"></i> {{ $item->post->view }}</a></li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Comments"><a
                                    href="{{ route('post.details', $item->post->id) }}"><i class="las la-comments"></i>
                                    {{ count($item->post->comments) }}</a></li>
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
            @if ($upVotes->hasPages())
                <ul class="pagination-md justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                </ul>
                {{ paginateLinks($upVotes) }}
            @endif
        </nav>
    </div>
@endsection
