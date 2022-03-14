<aside class="xxxl-2 col-lg-3 d-lg-block d-none">
    <div class="sidebar-widget">
        <div class="sidebar-widget__header">
            <h5 class="sidebar-widget__title">@lang('Forums')</h5>
        </div>
        <div class="sidebar-widget__body">
            <ul class="category-list">
                @foreach ($forums as $item)
                    <li class="sidebar-menu-item"><a href="{{ route('forum.posts', $item->id) }}">
                            @php echo @$item->icon @endphp
                            {{ __(@$item->name) }}</a></li>
                @endforeach
            </ul>
        </div>
    </div><!-- sidebar-widget end -->
    <div class="sidebar-widget mt-4">
        <div class="sidebar-widget__header">
            <h5 class="sidebar-widget__title">@lang('Categories')</h5>
        </div>
        <div class="sidebar-widget__body">
            <ul class="category-list">
                @foreach ($categories as $item)
                    <li class="sidebar-menu-item"><a href="{{ route('category.posts', $item->id) }}">@php echo @$item->icon @endphp
                            {{ __(@$item->name) }}</a></li>
                @endforeach
            </ul>
        </div>
    </div><!-- sidebar-widget end -->

    <!-- //Top Disscussion// -->
    @if (count($disscussions) != 0)
        <div class="sidebar-widget mt-4">
            <div class="sidebar-widget__header">
                <h5 class="sidebar-widget__title">@lang('Top Disscussions')</h5>
            </div>
            <div class="sidebar-widget__body">
                <ul class="discussion-list">
                    @foreach ($disscussions as $item)
                        <li class="single-discussion sidebar-menu-item {{ menuActive('category.posts', $item->id) }}">
                            <h6 class="single-discussion__title">
                                <a href="{{ route('post.details', $item->post_id) }}">{{ __(@$item->post->title) }}
                                </a>
                            </h6>
                            <span class="fs--12px"><i class="las la-comments fs--14px"></i>
                                {{ $item->total }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!-- sidebar-widget end -->
    @endif
</aside>

@push('script')
    <script>
        let navLinkCatFouram = $('.category-list li a');
        let activatedRoute = '{{ url()->current() }}';

        $.each(navLinkCatFouram, function(index, value) {
            if (value.href == activatedRoute) {
                let li = value.closest('li');
                $(li).addClass('active');
            }
        });
    </script>
@endpush
