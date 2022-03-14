@extends($activeTemplate.'layouts.auth_user')
@section('content')
    <div class="row gy-4 justify-content-center mr-2">
        <div class="col-lg-4 col-sm-6">
            <div class="d-widget">
                <a href="{{ route('user.home') }}" class="d-widget__btn" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-original-title="View All"><i class="las la-arrow-right"></i></a>
                <div class="d-widget__icon">
                    <i class="las la-comments"></i>
                </div>
                <div class="d-widget__content">
                    <h6 class="amount"> {{ $posts->count() }}</h6>
                    <p class="caption">@lang('Total Thread')</p>
                </div>
            </div><!-- d-widget end -->
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="d-widget">
                <a href="{{ route('user.transactions', Auth::id()) }}" class="d-widget__btn" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-original-title="View All"><i class="las la-arrow-right"></i></a>
                <div class="d-widget__icon">
                    <i class="las la-money-check"></i>
                </div>
                <div class="d-widget__content">
                    <h6 class="amount">{{ showAmount(auth()->user()->balance) . ' ' . $general->cur_text }}</h6>
                    <p class="caption">@lang('Current Balance')</p>
                </div>
            </div><!-- d-widget end -->
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="d-widget">
                <div class="d-widget__icon">
                    <i class="las la-layer-group"></i>
                </div>
                <div class="d-widget__content">
                    <h6 class="amount">{{ getAmount(auth()->user()->point) }}</h6>
                    <p class="caption">@lang('Total Point')</p>
                </div>
            </div><!-- d-widget end -->
        </div>
    </div><!-- row end -->
    <div class="custom--card mt-5">
        <div class="card-header">
            <h6>@lang('Thread History')</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive--md">
                <table class="table custom--table">
                    <thead>
                        <tr>
                            <th>@lang('Thread Title')</th>
                            <th>@lang('Date')</th>
                            <th>@lang('Up Vote')</th>
                            <th>@lang('Down Vote')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $item)
                            <tr>
                                <td data-label="Thread Title">
                                    <a href="{{ route('post.details', $item->id) }}"
                                        class="text-secondary">{{ __(shortDescription($item->title, 50)) }}</a>
                                </td>
                                <td data-label="Date"> {{ date('d-M-Y', strtotime($item->created_at)) }} </td>
                                <td data-label="Up Vote"><i class="las la-arrow-up text--success"></i>
                                    {{ $item->up_vote }}
                                </td>
                                <td data-label="Down Vote"><i class="las la-arrow-down text--danger"></i>
                                    {{ $item->down_vote }}
                                </td>
                                <td data-label="Action">
                                    <a href="{{ route('user.post.edit', $item->id) }}" class="icon-btn bg--success mb-1"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit"><i
                                            class="las la-edit"></i></a>

                                    <a href="javascript:void(0)" data-id="{{ $item->id }}"
                                        data-status="{{ $item->status }}" data-title="{{ $item->title }}"
                                        class="icon-btn @if ($item->status == 1) bg--info @else bg--danger @endif  statusModalBtn" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="Switch Status"><i
                                            class="las @if ($item->status == 1)  la-eye @else la-low-vision @endif "></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <tfoot>
                    @if ($posts->hasPages())
                        {{ paginateLinks($posts) }}
                    @endif
                </tfoot>
            </div>
        </div>
    </div>

    {{-- Status Post MODAL --}}
    <div id="statusModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="post-status-title"></h6>
                </div>
                <form action="{{ route('user.post.status.change') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <p class="modal-title post-status-msg"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--gradient">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {

            $('.statusModalBtn').on('click', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');
                var title = $(this).data('title');
                var statusMsg;
                if (status) {
                    statusMsg =
                        `@lang('Are you sure to') <span class="text--danger fw-bold">@lang('Deactive') ?</span>`;
                } else {
                    statusMsg =
                        `@lang('Are you sure to') <span class="text--success fw-bold">@lang('Active') ?</span>`;
                }
                $('#statusModal').find('.post-status-msg').html(statusMsg);
                $('#statusModal').find('.post-status-title').html(title);
                $('#statusModal').find('input[name=id]').val($(this).data('id'));
                $('#statusModal').modal('show');
            });

        })(jQuery);
    </script>
@endpush
