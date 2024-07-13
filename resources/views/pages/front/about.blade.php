@extends('layouts.app')
@section('title', $title)
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">About</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    @if ($about)
        <div class="container-fluid overflow-hidden py-5 px-lg-0">
            <div class="container about py-5 px-lg-0">
                <div class="row g-5 mx-lg-0">
                    <div class="col-lg-6 ps-lg-0 wow fadeInLeft" data-wow-delay="0.1s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute img-fluid w-100 h-100"
                                src="{{ asset('frontpage/img/about.jpg') }}" style="object-fit: cover;" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 about-text wow fadeInUp" data-wow-delay="0.3s">
                        <h6 class="text-secondary text-uppercase mb-3">About Us</h6>
                        <h1 class="mb-5">Export/Import Services for Indonesian Earth and Sea Products</h1>
                        <div class="mb-5">{!! $about->description !!}</div>
                        <div class="row g-4 mb-5">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <i class="fa fa-globe fa-3x text-primary mb-3"></i>
                                <h5>Global Coverage</h5>
                                <p class="m-0">Connecting Indonesian agricultural and marine products to the rest of the
                                    world with trusted export/import services.</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <i class="fa fa-shipping-fast fa-3x text-primary mb-3"></i>
                                <h5>On Time Delivery</h5>
                                <p class="m-0">Providing the best export/import services with speed, security and
                                    customer satisfaction as priorities.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- About End -->


    <!-- Fact Start -->
    @if ($information)
        <div class="container-xxl py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h6 class="text-secondary text-uppercase mb-3">SOME FACTS</h6>
                        <h1 class="mb-5">{{ $information->title }}</h1>
                        <p class="mb-5">{!! $information->description !!}</p>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-headphones fa-2x flex-shrink-0 bg-primary p-3 text-white"></i>
                            <div class="ps-4">
                                <h6>Call for any query!</h6>
                                <h3 class="text-primary m-0">{{ $information->contact_us }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-4 align-items-center">
                            <div class="col-sm-6">
                                <div class="bg-primary p-4 mb-4 wow fadeIn" data-wow-delay="0.3s">
                                    <i class="fa fa-users fa-2x text-white mb-3"></i>
                                    <h2 class="text-white mb-2" data-toggle="counter-up">{{ $information->happy_client }}
                                    </h2>
                                    <p class="text-white mb-0">Happy Clients</p>
                                </div>
                                <div class="bg-secondary p-4 wow fadeIn" data-wow-delay="0.5s">
                                    <i class="fa fa-ship fa-2x text-white mb-3"></i>
                                    <h2 class="text-white mb-2" data-toggle="counter-up">
                                        {{ $information->complete_shipment }}</h2>
                                    <p class="text-white mb-0">Complete Shipments</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="bg-success p-4 wow fadeIn" data-wow-delay="0.7s">
                                    <i class="fa fa-star fa-2x text-white mb-3"></i>
                                    <h2 class="text-white mb-2" data-toggle="counter-up">
                                        {{ $information->customer_review }}</h2>
                                    <p class="text-white mb-0">Customer Reviews</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Fact End -->

    <!-- Feature Start -->
    <div class="container-fluid overflow-hidden py-5 px-lg-0">
        <div class="container feature py-5 px-lg-0">
            <div class="row g-5 mx-lg-0">
                <div class="col-lg-6 feature-text wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase mb-3">OUR FEATURES</h6>
                    <h1 class="mb-5">Trust Your Needs to Us</h1>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa fa-globe text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>Worldwide Service</h5>
                            <p class="mb-0">Connect your imports and exports worldwide with reliability and efficiency.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-5 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-shipping-fast text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>On Time Delivery</h5>
                            <p class="mb-0">Guarantee delivery of goods on schedule to meet your business needs.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-0 wow fadeInUp" data-wow-delay="0.7s">
                        <i class="fa fa-headphones text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>24/7 Telephone Support</h5>
                            <p class="mb-0">Fast and responsive support service for all your import and export logistics
                                needs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('frontpage/img/feature.jpg') }}"
                            style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Our Team</h6>
                <h1 class="mb-5">Expert Team Members</h1>
            </div>
            <div class="row g-4">
                @forelse ($teams as $team)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item p-4">
                            <div class="overflow-hidden mb-4">
                                <img class="img-fluid" src="{{ Storage::url($team->image) }}" alt="{{ $team->name }}">
                            </div>
                            <h5 class="mb-0">{{ $team->name }}</h5>
                            <p>{{ $team->position }}</p>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <!-- Team End -->


@endsection
