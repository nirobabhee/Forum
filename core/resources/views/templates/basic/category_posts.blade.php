@extends($activeTemplate.'layouts.frontend')
@section('content')
    @forelse ($categories as $item)
        @foreach ($item->posts->where('status', 1) as $post)
            <div class="single-post">
                <span class="forum-badge">{{ __($item->name) }}</span>
                <div class="single-post__thumb">
                    <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $post->user->image, imagePath()['profile']['user']['size']) }}"
                        alt="@lang('Profile Image')">
                    <img src="" alt="image">
                </div>
                <div class="single-post__content">
                    <h3 class="single-post__title">
                        <a
                            href="{{ route('post.details', $post->id) }}">{{ __(shortDescription($post->title, 80)) }}</a>
                    </h3>

                    <ul class="single-post__meta d-flex align-items-center mt-1">
                        <li>@lang('Post By') <a href="{{ route('post.user.profile', $post->user->id) }}"
                                class="text--base"><i class="las la-user"></i>{{ __($post->user->username) }}</a>
                        </li>
                        <li><i class="las la-clock"></i> {{ diffForHumans($post->created_at) }}</li>
                    </ul>
                </div>
                <div class="single-post__footer">
                    <p class="mt-2">{{ __(shortDescription($post->description)) }} <a
                            href="{{ route('post.details', $post->id) }}">@lang('see more')</a></p>
                    <div class="single-post__action-list d-flex flex-wrap align-items-center mt-3">
                        <ul class="left">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Up Vote" id="saveUpDownVote"
                                data-post="{{ $post->id }}" data-type="up-vote"><a
                                    href="{{ route('post.details', $post->id) }}" class="text--success"><i
                                        class="las la-arrow-up text--success"></i>
                                    <span>{{ $post->up_vote }}</span></a></li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Down Vote" id="saveUpDownVote"
                                data-post="{{ $post->id }}" data-type="down-vote">
                                <a href="{{ route('post.details', $post->id) }}"><i class="las la-arrow-down"></i>
                                    <span>{{ $post->down_vote }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="right">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Views"><a href="#0"><i
                                        class="las la-eye"></i> {{ $post->view }} @lang('views')</a></li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Comments"><a
                                    href="{{ route('post.details', $post->id) }}"><i class="las la-comments"></i>
                                    {{ count($post->comments) }}
                                    @lang('Comments')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    @empty
    <div class=" no-data-wrapper">
        <h4 class="mt-3">{{ __($emptyMessage) }}</h4>
        <img src="{{ asset($activeTemplateTrue . 'images/no-data.png') }}" alt="image">
    </div>
    @endforelse
    <nav class="mt-3">
        @if ($categories->hasPages())
            <ul class="pagination pagination-md justify-content-end">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

            </ul>
            {{ paginateLinks($categories) }}
        @endif
    </nav>
@endsection
