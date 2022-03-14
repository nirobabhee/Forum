@extends($activeTemplate.'layouts.frontend')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between py-3">
     <h4>@lang('All Forum Posts')</h4>
    <a href="{{ route('user.post.create')}}" class="btn btn--gradient"> <i class="las la-plus-circle"></i> @lang('Create Post')</a>
    </div>

</div>
    @forelse ($posts as $post)
        <div class="single-post mt-3">
            <span class="forum-badge">{{ __($post->category->forum->name) }}</span>
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
                    <li><i class="las la-clock"></i> {{ diffForHumans($post->created_at) }}</li>
                </ul>
            </div>
            <div class="single-post__footer">

                    <p class="mt-2">{{ __(shortDescription($post->description)) }} <a
                            href="{{ route('post.details', $post->id) }}">@lang('see more')</a></p>

                <div class="single-post__action-list d-flex flex-wrap align-items-center mt-3">
                    <ul class="left">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Up Vote"><a href="{{ route('post.details', $post->id)}}"
                                class="text--success"><i class="las la-arrow-up text--success"></i>
                                {{ $post->up_vote }}</a></li>
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Down Vote"><a href="{{ route('post.details', $post->id)}}"><i
                                    class="las la-arrow-down"></i> {{ $post->down_vote }}</a></li>
                    </ul>
                    <ul class="right">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Total Views"><a href="{{ route('post.details', $post->id)}}"><i
                                    class="las la-eye"></i> {{ $post->view }} @lang('views')</a></li>
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
            <ul class="pagination pagination-md justify-content-end">
                <li class="page-item"> {{ paginateLinks($posts) }}</li>
            </ul>
        @endif
    </nav>

@endsection

