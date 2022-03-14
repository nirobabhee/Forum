@extends($activeTemplate.'layouts.auth_user')
@section('content')
<div class="card-header text-left bg-primary justify-content-between d-flex">
    <h4 class="text-white d-inline">@lang('Edit Post')</h4>
    <a class="btn btn--gradient" href="{{ route('user.home') }}">@lang('Post
        list')</a>
</div>
    <div class="container card">
        <form class="mt-3" action="{{ route('user.post.update', $post->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="row my-3">
                <div class="form-group col-lg-6">
                    <label>@lang('Category') <small class="text-danger">*</small></label>
                    <select name="category" class="form--control" id="category">
                        <option value="">@lang('Select One')</option>
                        @foreach ($categories as $category)
                            <option data-subcategories="{{ $category->subcategories }}" value="{{ $category->id }}">
                                {{ __($category->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label>@lang('Subcategory')</label>
                    <select name="subcategory" class="form--control " id="subcategory">
                        <option>@lang('Select Subcategory')</option>
                    </select>
                </div>
                <div class="form-group col-lg-12">
                    <label>@lang('Title') <small class="text-danger">*</small></label>
                    <input type="text" autocomplete="off" class="form--control" name="title"
                        placeholder="@lang('Post Title *')" minlength="3" value="{{ __($post->title) }}">
                </div>

                <div class="form-group col-lg-12">
                    <label>@lang('Description') <small class="text-danger">*</small></label>
                    <textarea autocomplete="off" class="form--control " name="description"
                        placeholder="@lang('Your Post Description')">{{ __($post->description) }}</textarea>
                </div>
                <div class="form-group ">
                    <label>@lang('Tags') <small class="text-danger">*</small></label>
                    <select name="tags[]" class="form--control select2-auto-tokenize" multiple="multiple">
                        @if ($post->tags)
                            @foreach ($post->tags as $option)
                                <option value="{{ $option }}" selected>{{ __($option) }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small class="ml-2 text-facebook">@lang('Separate multiple keywords by') <code>,</code>(@lang('comma'))
                        @lang('or') <code>@lang('enter')</code> @lang('key')</small>
                </div>
                <div class="col-lg-12 text-end">
                    <button type="submit" class="btn btn--gradient">@lang('Update Now')</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {


            $('[name=category]').val(`{{ $post->category_id }}`);

            $('[name=category]').on('change', function() {

                let subcategories = $(this).find(':selected').data('subcategories');

                let html = `<option value='' disabled selected>@lang('Please Select')</option>`;

                $.each(subcategories, function(i, val) {
                    html += `<option value="${val.id}">${val.name}</option>`
                });

                $('[name=subcategory]').html(html);
            }).change();

            $('[name=subcategory]').val(`{{ $post->sub_category_id }}`);

        });


        // select-2 init
        $('.select2-multi-select').select2();
        $(".select2-auto-tokenize").select2({
            tags: true,
            tokenSeparators: [',']
        });
    </script>
@endpush
