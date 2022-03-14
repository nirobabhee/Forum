@extends($activeTemplate.'layouts.auth_user')
@section('content')
    <div class="card-header text-left bg-primary justify-content-between d-flex">
        <h4 class="text-white d-inline">@lang('Create Post')</h4>
        <a class="btn btn--gradient" href="{{ route('user.home') }}">@lang('All Post
            ')</a>

    </div>
    <div class="container card">
        <form class="mt-3" action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row my-3">

                <div class="form-group col-lg-6">
                    <label>@lang('Category') <small class="text-danger">*</small></label>
                    <select name="category" class="form--control" id="category" required>
                        <option value="">@lang('Select One')</option>
                        @foreach ($categories as $category)
                            <option data-subcategories="{{ $category->subcategories }}" value="{{ $category->id }}">
                                {{ __($category->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('Subcategory')</label>
                    <select name="subcategory" class="form--control select2-basic" id="subcategory">
                        <option>@lang('Select Subcategory') </option>

                    </select>
                </div>

                <div class="form-group col-lg-12">
                    <label>@lang('Title')<small class="text-danger">*</small></label>
                    <input type="text" autocomplete="off" class="form--control" name="title" value="{{ old('title') }}"
                        placeholder="@lang('Post Title')" minlength="3" required>
                </div>

                <div class="form-group col-lg-12">
                    <label>@lang('Description') <small class="text-danger">*</small></label>
                    <textarea autocomplete="off" class="form--control " name="description"
                        placeholder="@lang('Your Post Description')">{{ old('description') }}</textarea>
                </div>
                <div class="form-group col-lg-12">
                    <label>@lang('Tags') <small class="text-danger">*</small></label>
                    <select name="tags[]" class="form--control select2-auto-tokenize" multiple="multiple" required>
                    </select>
                    <small>@lang('Separate multiple keywords by') <code>,</code>(@lang('comma')) @lang('or')

                        <code>@lang('enter')</code> @lang('key')</small>
                </div>
                @if (auth()->user()->point >= $general->post_point)
                    <div class="col-lg-12 text-end">
                        <button type="submit" class="btn btn--gradient">@lang('Submit Now')</button>
                    </div>
                @else
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div>
                            <span class="text-info">@lang('Insufficient point for post ')  <span><a
                                href="{{ route('user.purchase.point.form') }}">@lang('Purchase Point.')</a></span>
                        </div>
                        <button class="btn btn--gradient disabled">@lang('Submit Now')</button>
                    </div>
            </div>
            @endif
    </div>
    </form>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $('[name=category]').on('change', function() {

                let subcategories = $(this).find(':selected').data('subcategories');
                console.log(subcategories);

                let html = `<option value='' disabled selected>@lang('Please Select')</option>`;

                $.each(subcategories, function(i, val) {
                    html += `<option value="${val.id}">${val.name}</option>`
                });

                $('[name=subcategory]').html(html);
            }).change();

        });

        // select-2 init
        $('.select2-multi-select').select2();
        $(".select2-auto-tokenize").select2({
            tags: true,
            tokenSeparators: [',']
        });
    </script>
@endpush
@push('style')
    <style>
        .select2-container--default .select2-selection--multiple {
            border-radius: 3px;
            cursor: text;
            padding-bottom: 15px;
            padding-right: 8px;
            margin-top: 3px;
        }

    </style>
@endpush
