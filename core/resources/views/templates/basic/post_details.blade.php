@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="post-details">
        <span class="post-details__badge">{{ __($post->category->forum->name) }}</span>
        <h3 class="post-details__title">{{ __($post->title) }}</h3>
        <div class="d-flex flex-wrap justify-content-between">
            <ul class="post-details__tags mt-2">
                @foreach ($post->tags as $item)
                    <li><span class="badge bg--primary"> {{ __($item) }}</span></li>
                @endforeach
            </ul>

            <ul class="post-details__social d-flex flex-wrap align-items-center mt-2">
                <li class="title">@lang('Share'):</li>

                <li>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                        target="_blank">
                        <i class="lab la-facebook-f"></i>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ urlencode(url()->current()) }}"
                        target="_blank">
                        <i class="lab la-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="https://plus.google.com/share?url={{ urlencode(url()->current()) }}" target="_blank">
                        <i class="lab la-google"></i>
                    </a>
                </li>
                <li>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary"
                        target="_blank">
                        <i class="lab la-linkedin"></i>
                    </a>
                </li>
            </ul>

        </div>
        <div class="single-post__action-list d-flex flex-wrap align-items-center mt-3">
            @auth
                <ul class="left">
                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Up Vote')" class="voteBtn up"
                        data-id="{{ $post->id }}" data-type="1">
                        <div class="{{ $post->up_vote?'text--success':'' }}">
                            <i class="las la-arrow-up"></i>
                            <span class="up_votes">{{ $post->up_vote }}</span>
                        </div>
                    </li>

                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Down Vote')" class="voteBtn down"
                        data-id="{{ $post->id }}" data-type="0">
                        <div class="{{$post->down_vote?'text--success':'' }}"><i class="las la-arrow-down"></i>
                            <span class="down_votes">{{ $post->down_vote }}</span>
                        </div>
                    </li>
                </ul>
            @endauth

            <ul class="right">
                <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Total Views">
                    <div><i class="las la-eye"></i> {{ $post->view }} @lang('views')</div>
                </li>
                <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Total Comments"><div><i class="las la-comments"></i>{{ count($post->comments) }} @lang(' Comments')</div>
                </li>
            </ul>
            
        </div>

        <div class="post-author mt-5">
            <div class="post-author__thumb">
                <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $post->user->image, imagePath()['profile']['user']['size']) }}"
                    alt="@lang('Profile Image')">
                <img src="" alt="image">
                <img />
            </div>
            <div class="post-author__content">
                <h6 class="post-author__name">{{ __($post->user->username) }}</h6>
                <ul class="post-author__meta d-flex align-items-center fs--14px">
                    <li>@lang('Post By') <a href="{{ route('post.user.profile', $post->user->id) }}"
                            class="text--base"><i class="las la-user"></i>
                            {{ __($post->user->username) }}</a></li>
                    <li><i class="las la-clock"></i> {{ diffForHumans($post->created_at) }}</li>
                </ul>
                <p class="mt-3">{{ __($post->description) }}</p>
            </div>
        </div>
    </div><!-- post-details end -->

    @auth
        <div class="single-comment">
            <div class="single-comment__thumb">
                <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . Auth::user()->image, imagePath()['profile']['user']['size']) }}"
                    alt="@lang('Profile Image')">
                <img />
            </div>
            <div class="comment-wrapper__content">
                <form action="{{ route('user.post.comments') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post" value="{{ $post->id }}">
                    <textarea required name="comment" class="form--control" placeholder="Write your comment"></textarea>
                    <button type="submit" class="btn btn--gradient mt-3">@lang('Comment')</button>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-3" role="alert">
            <strong> <a href="{{route('user.login')}}">@lang('Login')</a> @lang('to share your opinion')</strong>
        </div>
    @endauth

    <div class="comment-area mt-5">
        @if (count($post->comments) < 2)
            <h4 class="mb-3">{{ count($post->comments) }} @lang(' Comment')</h4>
        @else
            <h4 class="mb-3">{{ count($post->comments) }} @lang(' Comments')</h4>
        @endif


        @forelse ($post->comments as $comment)
            <ul id="postComments">
                <li>
                    <div class="single-comment">
                        @if (!$comment->user->image)
                            @php
                                $user = $comment->user->username;
                                $partials = strtoupper($user[0][0]);
                            @endphp
                            <div class="single-comment__thumb ">
                                <div class="bg-primary p-2 pb-2 text-white rounded">{{ $partials }}</div>
                            </div>
                        @else
                            <div class="single-comment__thumb ">
                                <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $comment->user->image, imagePath()['profile']['user']['size']) }}"
                                    alt="@lang('Profile Image')">
                                <img />
                                {{-- //commented users Pic --}}
                            </div>
                        @endif
                        <div class="single-comment__content">
                            <h6><a
                                    href="{{ route('post.user.profile', $comment->user->id) }}">{{ __($comment->user->username) }}</a>
                            </h6>
                            <span class="fs--14px">{{ diffForHumans($comment->updated_at) }}</span>
                        </div>
                        <div class="mt-2 w-100">{{ __($comment->comment) }}
                            <hr>
                        </div>
                    </div><!-- single-comment end -->
                </li>
            </ul>

        @empty
            <h4 class="text-center"> @lang('No comment yet')</h4>
        @endforelse
    </div>
    <div class="btn btn--gradient btn-sm text-white" id="loadMore">@lang('..Load More')</div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            // Save Like Or Dislike
            var currentVote = parseInt(`{{  $post->up_vote?1:0 }}`);
            $('.voteBtn').on('click', function() {
                var id = $(this).data('id');
                var type = $(this).data('type');

                console.log(currentVote);

                if(type == currentVote){
                    return false;
                }

                var ud = $(this);

                $.ajax({
                    url: "{{ route('user.vote') }}",
                    type: "get",
                    data: {
                        id: id,
                        type: type,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success == true) {

                            currentVote = currentVote?0:1;


                            $(`.up_votes`).text(response.up_vote);
                            $(`.down_votes`).text(response.down_vote);

                            if(type){
                                $('.up_votes').parent().addClass('text--success');
                                $('.down_votes').parent().removeClass('text--success');
                            }else{
                                $('.down_votes').parent().addClass('text--success');
                                $('.up_votes').parent().removeClass('text--success');
                            }
                        } else {
                            notify('error', response.message);
                        }
                    }
                });
            });
            // --------Commnets Load more btn------//
            $(function() {
                x = 5;
                var size = "{{ count($post->comments) }}";

                $('#postComments li').slice(0, 5).show();
                $('#loadMore').on('click', function(e) {
                    e.preventDefault();
                    x = x + 5;
                    var y = size - x;
                    // console.log(y);
                    $('#postComments li').slice(0, x).slideDown();
                    //
                    if (y <= 0) {
                        $('#loadMore').hide();
                    }

                });

                if (size <= x) {
                    $('#loadMore').hide();
                }
            });
        });
    </script>
@endpush
@push('style')
    <style>
        #postComments li {
            display: none;
        }

        .single-post__action-list .left li i{
            color: unset
        }
    </style>

@endpush
