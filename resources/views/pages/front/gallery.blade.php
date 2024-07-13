@extends('layouts.app')
@section('title', $title)
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endpush
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Gallery</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Gallery</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Gallery Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Galery Kami</h6>
                <h1 class="mb-5">Jelajahi Galery Kami</h1>
            </div>
            <div class="row g-4">
                @forelse ($galleries as $gallery)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item p-4" style="border-radius: 10px !important">
                            <div class="overflow-hidden mb-2" style="border-radius: 10px !important">
                                <a href="{{ Storage::url($gallery->image) }}" data-fancybox="gallery"
                                    data-caption="{{ $gallery->title }}">
                                    <img class="img-fluid" style="border-radius: 10px !important"
                                        src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}">
                                </a>
                            </div>
                            <h5 class="mb-0">{{ $gallery->title }}</h5>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <div class="row g-4 mt-5">
                <div class="col-md-12 mx-auto text-center wow fadeInUp" data-wow-delay="0.3s">
                    {{ $galleries->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="text-center">
                <h6 class="text-secondary text-uppercase">Testimonial</h6>
                <h1 class="mb-0">Apa pendapat mereka tentang kami!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                @forelse ($reviews as $review)
                    <div class="testimonial-item p-4 my-5">
                        <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                        <div class="d-flex align-items-end mb-4">
                            <img class="img-fluid flex-shrink-0" src="{{ Storage::url($review->image) }}"
                                style="width: 80px; height: 80px;">
                            <div class="ms-4">
                                <h5 class="mb-1">{{ $review->name }}</h5>
                            </div>
                        </div>
                        <p class="mb-0">{{ $review->review }}</p>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
