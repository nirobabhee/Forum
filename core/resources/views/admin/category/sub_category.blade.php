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
                                    <th>@lang('Category')</th>
                                    <th>@lang('Icon')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subCategories as $key => $item)
                                    <tr>
                                        <td data-label="@lang('Sl')">{{ $key + 1 }}</td>
                                        <td data-label="@lang('Name')">{{ $item->name }}</td>
                                        <td data-label="@lang('Category')">{{ @$item->category->name }}</td>
                                        <td data-label="@lang('Icon')">@php echo $item->icon @endphp</td>
                                        <td data-label="@lang('Status')">
                                            @if ($item->status == 0)
                                                <span class="badge badge--warning">Deactive</span>
                                            @else
                                                <span class="badge badge--success">Active</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Created At')">{{ $item->created_at }}</td>

                                        <td data-label="@lang('Action')">
                                            <button class="btn btn-sm btn--primary text--small editForumBtn"
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
                            @if ($subCategories->hasPages())
                                {{ paginateLinks($subCategories) }}
                            @endif
                        </tfoot>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <!--Add Subcategory Modal -->
    <div class="modal fade" id="addSubCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('Add Subcategory')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.sub.category.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="subCategoryName">@lang('Name')<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subCategoryName"
                                placeholder="@lang('Enter subcategory name')" name="name" value="{{ old('name') }}"
                                required />
                        </div>

                        <div class="form-group">
                            <label for="categoryName">@lang('Category')<span class="text-danger">*</span></label>
                            <select name="category" class="form-control select2-basic" id="categoryName">
                                <option value="">-Select Category-</option>
                                @foreach ($categories as $key => $categoriy)
                                    <option @if ($categoriy == @$categoriy->categoriy_id) selected @endif value="{{ $categoriy->id }}">
                                        {{ _($categoriy->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="forumIcon">@lang('Icon')<span class="text-danger">*</span></label>
                            <div class="input-group has_append">
                                <input type="text" class="form-control icon" id="forumIcon" name="icon"
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
                        Subcategory')</button>
                </div>
                </form>
            </div>

        </div>
    </div>


    <!--Update Subcategory Modal -->
    <div class="modal fade" id="updateSubCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('Edit Subcategory')</h5>
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
                            <label for="forumName">Name</label>
                            <input type="text" class="form-control edit-name" id="forumName"
                                placeholder="@lang('Update forum name')" name="name" />
                        </div>
                        <div class="form-group">
                            <label for="categoryName">@lang('Category')</label>
                            <select name="category" class="form-control select2-basic edit-category" id="categoryName">
                                @foreach ($categories as $key => $categoriy)
                                    <option value="{{ $categoriy->id }}">
                                        {{ _($categoriy->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="forumIcon">Icon</label>
                            <div class="input-group has_append">
                                <input type="text" class="form-control icon edit-icon" id="forumIcon" name="icon"
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
                    <button type="submit" class="btn btn--primary">@lang('Update Subcategories')</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn-sm btn--primary text--small" data-toggle="modal" data-target="#addSubCategoryModal"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New Subcategory')</button>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            $('.editForumBtn').on('click', function() {
                var modal = $('#updateSubCategoryModal');

                var resourse = $(this).data('resourse');
                console.log(resourse);
                $('.edit-name').val(resourse.name);

                modal.find('.edit-category').val(resourse.category_id).select2();

                $('.edit-icon').val(resourse.icon);
                var status = resourse.status;
                if (status == 1) {
                    modal.find('input[name=status]').bootstrapToggle('on');
                } else {
                    modal.find('input[name=status]').bootstrapToggle('off');
                }
                modal.modal('show');

                modal.find('.edit-route').attr('action',
                    `{{ route('admin.sub.category.update', '') }}/${resourse.id}`);
            });
            $('#updateSubCategoryModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('#addSubCategoryModal').on('shown.bs.modal', function(e) {
                $(document).off('focusin.modal');
            });
            $('.iconPicker').iconpicker().on('change', function(e) {
                $(this).parent().siblings('.icon').val(`<i class="${e.icon}"></i>`);
            });
        })(jQuery);
    </script>
@endpush
