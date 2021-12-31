@extends('frontend.layouts.main')
@section('content')
    <!-- Main content -->
    <section class="slice py-7">
        <div class="container">
            <div class="row row-grid align-items-center">
                <div class="col-12 col-md-5 col-lg-6 order-md-2 text-center">
                    <!-- Image -->
                    <figure class="w-100">
                        <img alt="Image placeholder" src="{{asset('client_assets')}}/img/svg/illustrations/chef.png" class="img-fluid mw-md-120">
                    </figure>
                </div>
                <div class="col-12 col-md-7 col-lg-6 order-md-1 pr-md-5">
                    <!-- Heading -->
                    <h1 class="display-4 text-center text-md-left mb-3">
                        Short on staff? <strong class="text-primary">We got you covered</strong>
                    </h1>
                    <!-- Text -->
                    <p class="lead text-center text-md-left text-muted">
                        Book your required staff and we will get back to you.
                    </p>
                    <!-- Buttons -->
                    <div class="text-center text-md-left mt-5">
                        <a href="{{route('booking')}}" class="btn btn-primary btn-icon">
                            <span class="btn-inner--text">Book Staff</span>
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                        </a>
{{--                        <a href="https://webpixels.io/illustrations" class="btn btn-neutral btn-icon d-none d-lg-inline-block" target="_blank">See Illustrations</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="slice slice-lg pt-lg-6 pb-0 pb-lg-6 bg-section-secondary">
        <div class="container">
            <!-- Title -->
            <!-- Section title -->
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-6">
                    <span class="badge badge-soft-success badge-pill badge-lg">
                        Get started
                    </span>
                    <h2 class=" mt-4">Why Us?</h2>
                    <div class="mt-2">
{{--                        <p class="lead lh-180">Use Atomic Design to build components, sections and, then, pages.</p>--}}
                    </div>
                </div>
            </div>
            <!-- Card -->
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body pb-5">
                            <div class="pt-4 pb-5">
                                <img src="{{asset('client_assets')}}/img/svg/illustrations/reliable.png" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                            </div>
                            <h5 class="h4 lh-130 mb-3">COMPETENT & RELIABLE</h5>
                            <p class="text-muted mb-0">We make sure our staff can do the job. You are relying on us so we take every step to ensure our staff are reliable.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body pb-5">
                            <div class="pt-4 pb-5">
                                <img src="{{asset('client_assets')}}/img/svg/illustrations/right.png" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                            </div>
                            <h5 class="h4 lh-130 mb-3">RIGHT PEOPLE FOR EVERY JOB</h5>
                            <p class="text-muted mb-0" id="less3">We provide right people with for right work for more efficient ....
                                <a onclick="showMore(3)" class="text-primary"> Read More</a>
                            </p>
                            <p class="text-muted mb-0" id="more3">We provide right people with for right work for more efficient and effectiveness. At Frontline, our team is dedicated to helping employers and candidates connect.
                                <a onclick="showLess(3)"class="text-primary"> Show Less</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body pb-5">
                            <div class="pt-4 pb-5">
                                <img src="{{asset('client_assets')}}/img/svg/illustrations/relation.png" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                            </div>
                            <h5 class="h4 lh-130 mb-3">LONG-TERM RELATIONSHIPS</h5>
                            <p class="text-muted mb-0" id="less2">We’ve chosen to focus on the hospitality industry, and over the ...
                                <a onclick="showMore(2)" class="text-primary"> Read More</a>
                            </p>
                            <p class="text-muted mb-0" id="more2">We’ve chosen to focus on the hospitality industry, and over the years we’ve developed an intimate understanding of this industry, so we’re perfectly positioned to meet your needs. It matters to us that our clients end up in positions where they can thrive – and we are always ready lend more hands in need. By building long-term relationships, we believe we can help them achieve their long-term goals.
                                <a onclick="showLess(2)" class="text-primary"> Show Less</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="slice slice-lg">
        <div class="container">
            <div class="py-6">
                <div class="row row-grid justify-content-between align-items-center">
                    <div class="col-lg-5 order-lg-2">
                        <h5 class="h3">We Provide</h5>
                        <p class="lead my-4">
                            Whether it’s a RESTAURANT, HOTEL, PUB, EVENTS/CATERING/FUNCTION
                        </p>
                        <ul class="list-unstyled mb-0">
                            <li class="py-2">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="h6 mb-0">Chef – Head</span>
                                    </div>
                                </div>
                            </li>
                            <li class="py-2">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="h6 mb-0">Chef - Sous</span>
                                    </div>
                                </div>
                            </li>
                            <li class="py-2">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="h6 mb-0">Chef – Commis</span>
                                    </div>
                                </div>
                            </li>
                            <li class="py-2">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="h6 mb-0">Chef - Demi</span>
                                    </div>
                                </div>
                            </li>
                            <li class="py-2">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="h6 mb-0">Kitchen Helper</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="card mb-0 mr-lg-5">
                            <div class="card-body p-2">
                                <img alt="Image placeholder" src="{{asset('client_assets')}}/img/svg/illustrations/staff.png" class="img-fluid shadow rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <Script>
        $(window).on('load', function() {
            showLess(2);
            showLess(3);
        })
        function showMore(id){
            var showid = "more"+id;
            var hideid = "less"+id;
            $('#'+showid).show();
            $('#'+hideid).hide();
        }
        function showLess(id){
            var showid = "less"+id;
            var hideid = "more"+id;
            $('#'+showid).show();
            $('#'+hideid).hide();
        }
    </Script>
@endsection


