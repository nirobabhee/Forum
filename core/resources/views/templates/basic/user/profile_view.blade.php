@extends($activeTemplate.'layouts.auth_user')
@section('content')
    <div class="container">
        <div class="custom--card">
            <div class="card-body">
                <!-- profile section start -->
                <div class="profile-section">
                    <div class="profile-header bg_img"
                        style="background-image: url('{{ asset($activeTemplateTrue . 'images/bg/bg1.jpg') }}');">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div class="profile-thumb">
                                        <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . auth::user()->image, imagePath()['profile']['user']['size']) }}"
                                            alt="@lang('Profile Image')">
                                        <img />
                                    </div>
                                    <h3 class="profile-name text-white mt-3">
                                        {{ @auth::user()->firstname . ' ' . @auth::user()->lastname }}</h3>
                                    <ul
                                        class="profile-info-list d-flex flex-wrap align-items-center text-white justify-content-center mt-1">
                                        @if (auth::user()->address->country)
                                            <li><i class="las la-flag"></i>
                                                {{ @auth::user()->address->country }}</li>
                                        @endif
                                        @if (auth::user()->address->country)
                                            <li><i class="las la-phone"></i> {{ @auth::user()->mobile }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav class="profile-nav p-0 navbar navbar-expand-md">
                        <div class="container">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#profileNavbar" aria-controls="profileNavbar" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class="las la-bars"></i> <span>@lang('menu')</span>
                            </button>
                            <div class="collapse navbar-collapse" id="profileNavbar">
                                <ul class="profile-menu m-auto">
                                    <li><a href="#1"><i class="las la-user-circle"></i>
                                            @lang('Bio')</a></li>
                                    <li><a href="#2"><i class="las la-clipboard-list"></i>
                                            @lang('Posts')</a></li>
                                    <li><a href="#3"><i class="las la-clipboard-check"></i> @lang('Referral Link')</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div class="profile-details-wrapper" id="1">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-11 col-md-12">
                                    <h4 class="p-2 card-header">@lang('About')</h4>
                                    @if (@auth::user()->address->bio)
                                        <div class="card">
                                            <p class="card-body"> {{ @auth::user()->address->bio }}</p>
                                        @else
                                            <div class="no-data-wrapper">
                                                <h4 class="mt-3">@lang('No Data Found')</h4>
                                                <img src="{{ asset($activeTemplateTrue . 'images/no-data.png') }}"
                                                    alt="image">
                                            </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-details-wrapper" id="2">
                    <div class="row justify-content-center">
                        <div class="col-lg-11 col-md-11">
                            <div class="card">
                                <h4 class="p-2 card-header">@lang('Topics')</h4>
                                <div class="card-body">
                                    <div class="table-responsive--md">
                                        <table class="table custom--table">
                                            <thead>
                                                <tr>
                                                    <th title="Title">@lang('Title')</th>
                                                    <th title="Topic Title">@lang('Topic')</th>
                                                    <th title="Sub-Topic Title">@lang('Sub Topic')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($posts as $item)
                                                    <tr>
                                                        <td data-label="Title">
                                                            <a href="{{ route('post.details', $item->id) }}"
                                                                class="text-secondary">
                                                                {{ __(shortDescription($item->title, 50)) }}
                                                            </a>
                                                        </td>
                                                        <td data-label="Thread Title">
                                                            {{ __($item->category->name) }}
                                                        </td>
                                                        <td data-label="Sub-Topic Title">
                                                            @if (!empty($item->subcategories->name))
                                                                {{ __($item->subcategories->name) }}
                                                            @else
                                                                --
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-muted text-center" colspan="100%">
                                                            {{ __($emptyMessage) }}</td>
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
                        </div>
                    </div>
                </div>
                <div class="profile-details-wrapper" id="3">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-11 col-md-11">
                                <div class="form-group">
                                    <h4 class="p-2">@lang('Referral Link')</h4>
                                    <div class="input-group">
                                        <span class="input-group">
                                            <input type="text" step="any" class="form-control form-control-lg"
                                                id="myReferral" value="{{ url('?reference=' . auth()->user()->username) }}"
                                                readonly />
                                            <button onclick="myFunction()" class="input-group-text">@lang('Copy')</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- profile section end -->
        </div>
    </div>
    </div>
@endsection

@push('script')
    <script>
        function myFunction() {
            const copy = document.getElementById("myReferral");
            /* Select the text field */
            copy.select();
            copy.setSelectionRange(0, 99999); /* For mobile devices */
            navigator.clipboard.writeText(copy.value);
            // alert("Copied the text: " + copy.value);
        }
    </script>
@endpush
