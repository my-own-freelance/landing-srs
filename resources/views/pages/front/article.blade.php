@extends('layouts.app')
@section('title', $title)
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Articles</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Articles</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Our Articles</h6>
                <h1 class="mb-5">Explore Our Articles</h1>
            </div>
            <div class="row g-4">
                @forelse ($articles as $article)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item p-4">
                            <div class="overflow-hidden mb-4">
                                <img class="img-fluid" src="{{ Storage::url($article->image) }}" alt="">
                            </div>
                            <h6 class="mb-2">{{ Illuminate\Support\Str::limit(strip_tags($article->title), 100) }}</h6>
                            <small>{{ $article->views }} Views</small>
                            <br>
                            <small>{{ Illuminate\Support\Str::limit(strip_tags($article->excerpt), 200) }}</small>
                            <a class="btn-slide mt-2"
                                href="{{ route('home.article.detail', ['id' => $article->id, 'slug' => $article->slug]) }}">
                                <i class="fa fa-arrow-right"></i>
                                <span>Read More</span>
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <div class="row g-4 mt-5">
                <div class="col-md-12 mx-auto text-center wow fadeInUp" data-wow-delay="0.3s">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="text-center">
                <h6 class="text-secondary text-uppercase">Testimonial</h6>
                <h1 class="mb-0">Our Client Say!</h1>
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
