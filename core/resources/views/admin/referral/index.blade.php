@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Level')</th>
                                    <th>@lang('Points')</th>
                                    <th>@lang('Updated At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-label="@lang('Level')">{{ $referral->level }}</td>
                                    <td data-label="@lang('Point')">{{ $referral->point }}</td>
                                    <td data-label="@lang('Updated At')">{{ diffForHumans($referral->updated_at) }}</td>
                                    <td data-label="@lang('Action')">
                                        <button class="btn btn-sm btn--primary text--small editReferralBtn"
                                            data-resourse="{{ $referral }}"><i
                                                class="las la-edit text--shadow"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table><!-- table end -->

                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <!--Update category Modal -->
    <div class="modal fade" id="updateReferralModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('Update Referral')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="edit-route" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Refferal Point</label>
                            <input type="text" class="form-control edit-referral-point"
                                placeholder="@lang('Update Referral Point')" name="point" />
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn--primary">@lang('Update Referral')</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection
@push('script')
    <script>
        (function($) {
            $('.editReferralBtn').on('click', function() {
                var modal = $('#updateReferralModal');
                var resourse = $(this).data('resourse');
                console.log(resourse);
                $('.referral-id').val(resourse.id);
                $('.edit-referral-point').val(resourse.point);

                modal.modal('show');

                modal.find('.edit-route').attr('action',
                    `{{ route('admin.referral.update') }}`);
            });
            $('#updateReferralModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });

        })(jQuery);



    </script>
@endpush
