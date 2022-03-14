@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div>

        <div class="post-details">
            <span class="post-details__badge">General Information</span>
            <h3 class="post-details__title">What are the most basic life lessons?</h3>
            <div class="d-flex flex-wrap justify-content-between">
                <ul class="post-details__tags mt-2">
                    <li> <a href="#0">PHP</a></li>
                    <li> <a href="#0">HTML</a></li>
                    <li> <a href="#0">CSS</a></li>
                </ul>
                <ul class="post-details__social d-flex flex-wrap align-items-center mt-2">
                    <li class="caption">Share</li>
                    <li> <a href="#0"><i class="lab la-facebook-f"></i></a></li>
                    <li> <a href="#0"><i class="lab la-twitter"></i></a></li>
                    <li> <a href="#0"><i class="lab la-linkedin-in"></i></a></li>
                    <li> <a href="#0"><i class="lab la-reddit"></i></a></li>
                </ul>

            </div>
            <div class="single-post__action-list d-flex flex-wrap align-items-center mt-3">
                <ul class="left">
                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Up Vote"><a href="#0"
                            class="text--success"><i class="las la-arrow-up text--success"></i> 105</a></li>
                    <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Down Vote"><a href="#0"><i
                                class="las la-arrow-down"></i> 10</a></li>
                </ul>
                <ul class="right">
                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Total Views"><a
                            href="#0"><i class="las la-eye"></i> 12 Views</a></li>
                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Total Comments"><a
                            href="#0"><i class="las la-comments"></i> 10 Comments</a></li>
                </ul>
            </div>

            <div class="post-author mt-5">
                <div class="post-author__thumb">
                    <img src="{{ asset($activeTemplateTrue . 'images/contributor/1.jpg') }}" alt="image">
                </div>
                <div class="post-author__content">
                    <h6 class="post-author__name">Fahaddev</h6>
                    <ul class="post-author__meta d-flex align-items-center fs--14px">
                        <li>Post By <a href="#0" class="text--base"><i class="las la-user"></i> Fahaddevs</a></li>
                        <li><i class="las la-clock"></i> 10min ago</li>
                    </ul>
                    <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui sit at, delectus
                        expedita possimus nobis laboriosam corrupti repudiandae dolores cupiditate sapiente laborum illum
                        alias maxime velit quae! Hic suscipit dolore officia doloremque veritatis dolorem perspiciatis,
                        ratione, nesciunt iste, commodi ullam. Excepturi voluptatem consectetur soluta nemo eaque explicabo
                        necessitatibus error! Perferendis necessitatibus sed voluptates, eos quas neque et dolore veritatis
                        ipsam quia sint aperiam debitis dolorum a illo modi autem iure accusantium? Magnam debitis
                        praesentium quisquam officiis quis reprehenderit recusandae placeat minima! Omnis libero quis
                        ducimus suscipit beatae quae quam officiis eligendi nulla pariatur sunt necessitatibus sapiente
                        assumenda cumque, aperiam veritatis.</p>
                </div>
            </div>
        </div><!-- post-details end -->

        <div class="comment-wrapper mt-4">
            <div class="comment-wrapper__thumb">
                <img src="{{ asset($activeTemplateTrue . 'images/contributor/3.jpg') }}" alt="image">
            </div>
            <div class="comment-wrapper__content">
                <form>
                    <textarea name="#0" class="form--control" placeholder="Write your comment"></textarea>
                    <button type="submit" class="btn btn--gradient mt-3">Post Your Comment</button>
                </form>
            </div>
        </div>

        <div class="comment-area mt-5">
            <h4 class="mb-3">10 comments</h4>
            <div class="single-comment">
                <div class="single-comment__thumb">
                    <img src="{{ asset($activeTemplateTrue . 'images/contributor/1.jpg') }}" alt="image">
                </div>
                <div class="single-comment__content">
                    <h6>Ada Washington</h6>
                    <span class="fs--14px">2 days ago</span>
                </div>
                <p class="mt-2 w-100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet molestias optio
                    doloremque sed deleniti. Eaque assumenda exercitationem error, quos consequuntur possimus labore cum at
                    illum quidem ipsa dolores cumque obcaecati.</p>
            </div><!-- single-comment end -->
            <div class="single-comment">
                <div class="single-comment__thumb">
                    <img src="{{ asset($activeTemplateTrue . 'images/contributor/2.jpg') }}" alt="image">
                </div>
                <div class="single-comment__content">
                    <h6>Preston Long</h6>
                    <span class="fs--14px">2 days ago</span>
                </div>
                <p class="mt-2 w-100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet molestias optio
                    doloremque sed deleniti. Eaque assumenda exercitationem error, quos consequuntur possimus labore cum at
                    illum quidem ipsa dolores cumque obcaecati.</p>
            </div><!-- single-comment end -->
            <div class="single-comment">
                <div class="single-comment__thumb">
                    <img src="{{ asset($activeTemplateTrue . 'images/contributor/3.jpg') }}" alt="image">
                </div>
                <div class="single-comment__content">
                    <h6>Max Barton </h6>
                    <span class="fs--14px">2 days ago</span>
                </div>
                <p class="mt-2 w-100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet molestias optio
                    doloremque sed deleniti. Eaque assumenda exercitationem error, quos consequuntur possimus labore cum at
                    illum quidem ipsa dolores cumque obcaecati.</p>
            </div><!-- single-comment end -->
            <div class="single-comment">
                <div class="single-comment__thumb">
                    <img src="{{ asset($activeTemplateTrue . 'images/contributor/4.jpg') }}" alt="image">
                </div>
                <div class="single-comment__content">
                    <h6>Neal Holloway </h6>
                    <span class="fs--14px">2 days ago</span>
                </div>
                <p class="mt-2 w-100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet molestias optio
                    doloremque sed deleniti. Eaque assumenda exercitationem error, quos consequuntur possimus labore cum at
                    illum quidem ipsa dolores cumque obcaecati.</p>
            </div><!-- single-comment end -->
            <div class="single-comment">
                <div class="single-comment__thumb">
                    <img src="{{ asset($activeTemplateTrue . 'images/contributor/5.jpg') }}" alt="image">
                </div>
                <div class="single-comment__content">
                    <h6>Robyn Wade</h6>
                    <span class="fs--14px">2 days ago</span>
                </div>
                <p class="mt-2 w-100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet molestias optio
                    doloremque sed deleniti. Eaque assumenda exercitationem error, quos consequuntur possimus labore cum at
                    illum quidem ipsa dolores cumque obcaecati.</p>
            </div><!-- single-comment end -->
            <div class="single-comment">
                <div class="single-comment__thumb">
                    <img src="{{ asset($activeTemplateTrue . 'images/contributor/6.jpg') }}" alt="image">
                </div>
                <div class="single-comment__content">
                    <h6>Fahaddevs</h6>
                    <span class="fs--14px">2 days ago</span>
                </div>
                <p class="mt-2 w-100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet molestias optio
                    doloremque sed deleniti. Eaque assumenda exercitationem error, quos consequuntur possimus labore cum at
                    illum quidem ipsa dolores cumque obcaecati.</p>
            </div><!-- single-comment end -->
        </div>

    </div>
@endsection

{{-- post-details.html --}}
