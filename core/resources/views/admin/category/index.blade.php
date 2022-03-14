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
                                    <th>@lang('Serial')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Forum')</th>
                                    <th>@lang('Icon')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $key => $item)
                                    <tr>
                                        <td data-label="@lang('Sl')">{{ $key + 1 }}</td>
                                        <td data-label="@lang('Name')">{{ $item->name }}</td>
                                        <td data-label="@lang('forum')">{{ $item->forum->name }}</td>
                                        <td data-label="@lang('Icon')">@php echo $item->icon @endphp</td>
                                        <td data-label="@lang('status')">
                                            @if ($item->status == 0)
                                                <span class="badge badge--warning">@lang('Deactive')</span>
                                            @else
                                                <span class="badge badge--success">@lang('Active')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Created At')">{{ $item->created_at }}</td>

                                        <td data-label="@lang('Action')">
                                            <button class="btn btn-sm btn--primary text--small editCategoryBtn"
                                                data-resourse="{{ $item }}"><i
                                                    class="las la-edit text--shadow"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>

                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                        <tfoot>
                            @if ($categories->hasPages())
                                {{ paginateLinks($categories) }}
                            @endif
                        </tfoot>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <!--Add category Modal -->
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('Add Category')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="forumName">@lang('Name')<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="forumName"
                                placeholder="@lang('Enter category name')" name="name" value="{{ old('name') }}"
                                required />
                        </div>

                        <div class="form-group">
                            <label for="forumName">@lang('Forum')<span class="text-danger">*</span></label>
                            <select name="fourm" class="form-control select2-basic" id="forumName">
                                <option value="">-Select Forum-</option>
                                @foreach ($forums as $key => $fourm)
                                    <option value="{{ $fourm->id }}">{{ _($fourm->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="categoryIcon">@lang('Icon')<span class="text-danger">*</span></label>
                            <div class="input-group has_append">
                                <input type="text" class="form-control icon" id="categoryIcon" name="icon"
                                    placeholder="@lang('Choice icon')" value="{{ old('icon') }}" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary iconPicker" data-icon="las la-home"
                                        role="iconpicker"></button>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn--primary">@lang('Save
                        Category')</button>
                </div>
                </form>
            </div>

        </div>
    </div>

    <!--Update category Modal -->
    <div class="modal fade" id="updateCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('Update Category')</h5>
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
                            <label for="forumName">Category Name</label>
                            <input type="text" class="form-control edit-name" id="forumName"
                                placeholder="@lang('Update Category name')" name="name" />
                        </div>
                        <div class="form-group">
                            <label for="forumName">Forum</label>
                            <select name="fourm" class="form-control select2-basic edit-forum" id="forumName">
                                @foreach ($forums as $key => $fourm)
                                    <option value="{{ $fourm->id }}">{{ _($fourm->name) }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoryIcon">Icon</label>
                            <div class="input-group has_append">
                                <input type="text" class="form-control icon edit-icon" id="categoryIcon" name="icon"
                                    placeholder="@lang('Choice icon')" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary iconPicker" data-icon="las la-home"
                                        role="iconpicker"></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold edit-status checked">@lang('Status')
                            </label>
                            <input type="checkbox" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle"
                                data-on="@lang('Active')" data-off="@lang('Deactive')" data-width="100%" name="status">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn--primary">@lang('Update Category')</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn-sm btn--primary text--small" data-toggle="modal" data-target="#addCategoryModal"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New Category')</button>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            $('.editCategoryBtn').on('click', function() {
                var modal = $('#updateCategoryModal');

                var resourse = $(this).data('resourse');

                console.log(resourse.forum_id);

                $('.edit-name').val(resourse.name);
                modal.find('.edit-forum').val(resourse.forum_id).select2();

                $('.edit-icon').val(resourse.icon);
                var status = resourse.status;
                if (status == 1) {
                    modal.find('input[name=status]').bootstrapToggle('on');
                } else {
                    modal.find('input[name=status]').bootstrapToggle('off');
                }

                modal.modal('show');

                modal.find('.edit-route').attr('action',
                    `{{ route('admin.category.update', '') }}/${resourse.id}`);
            });
            $('#updateCategoryModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('#addCategoryModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('.iconPicker').iconpicker().on('change', function(e) {
                $(this).parent().siblings('.icon').val(`<i class="${e.icon}"></i>`);
            });
        })(jQuery);
    </script>
@endpush
