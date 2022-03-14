@extends($activeTemplate.'layouts.frontend')
@section('content')
    @forelse ($forums as $forum)
        <div class="forum-block">
            <div class="forum-block__header">
                <h4 class="forum-block__title">{{ __($forum->name) }}</h4>
            </div>
            <div class="forum-block__body">
                @foreach ($forum->categories as $categoriesPost)
                    @foreach ($categoriesPost->posts->where('status', 1) as $post)
                        <div class="single-thread">
                            <div class="single-thread">
                                <div class="single-post__thumb">
                                    <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $post->user->image, imagePath()['profile']['user']['size']) }}"
                                        alt="@lang('Profile Image')">
                                    <img />
                                </div>
                                <div class="single-post__content">
                                    <h3 class="single-post__title"><a
                                            href="{{ route('post.details', $post->id) }}">{{ __(shortDescription($post->title, 70)) }}</a>
                                    </h3>
                                    <ul class="single-post__meta d-flex align-items-center mt-1">
                                        <li>@lang('Post By') <a href="{{ route('post.user.profile', $post->user->id) }}"
                                                class="text--base"><i class="las la-user"></i>
                                                {{ __($post->user->username) }}</a></li>
                                        <li><i class="las la-clock"></i> {{ diffForHumans($post->updated_at) }}</li>
                                    </ul>
                                </div>

                                <div class="single-post__footer">
                                    <p class="mt-2">{{ __(shortDescription($post->description,200)) }} <a
                                            href="{{ route('post.details', $post->id) }}">@lang('see more..')</a></p>
                                    <div class="single-post__action-list d-flex flex-wrap justify-content-between mt-3">
                                        <ul class="left">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Up Vote"><a
                                                    href="{{ route('post.details', $post->id) }}"
                                                    class="text--success"><i class="las la-arrow-up text--success"></i>
                                                    {{ $post->up_vote }}</a></li>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Down Vote"><a
                                                    href="{{ route('post.details', $post->id) }}"><i
                                                        class="las la-arrow-down"></i> {{ $post->down_vote }}</a></li>
                                        </ul>
                                        <ul class="right">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Views"><a
                                                    href="{{ route('post.details', $post->id) }}"><i
                                                        class="las la-eye"></i> {{ $post->view }} @lang('views')</a>
                                            </li>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Comments"><a
                                                    href="{{ route('post.details', $post->id) }}"><i
                                                        class="las la-comments"></i>
                                                    {{ count($post->comments) }}</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div><!-- single-thread end -->
                    @endforeach
                    {{-- <nav class="mt-3">
                        @if ($forum->categories->hasPages())
                            <ul class="pagination pagination-md justify-content-end">
                                <li class="page-item"> {{ paginateLinks($forum->categories) }}</li>
                            </ul>
                        @endif
                    </nav> --}}
                @endforeach
            </div>
        </div><!-- forum-block end -->
    @empty
        <div class="text-center"> {{ __($emptyMessage) }}</div>
    @endforelse



@endsection
