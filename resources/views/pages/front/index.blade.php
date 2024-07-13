@extends('layouts.app')
@section('title', $title)
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div class="owl-carousel header-carousel position-relative mb-5">
            @forelse ($sliders as $slider)
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(6, 3, 21, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    {{-- <h5 class="text-white text-uppercase mb-3 animated slideInDown">Transport & Logistics
                                        Solution</h5> --}}
                                    <h1 class="display-3 text-white animated slideInDown mb-4">{{ $slider->title }}</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">{{ $slider->title }}</p>
                                    <a href="{{ route('home.about') }}"
                                        class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Lebih Lanjut</a>
                                    <a href="{{ route('home.contact') }}"
                                        class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('frontpage/img/carousel-1.jpg') }}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(6, 3, 21, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Transport & Logistics
                                        Solution</h5>
                                    <h1 class="display-3 text-white animated slideInDown mb-4">#1 Place For Your <span
                                            class="text-primary">Logistics</span> Solution</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor
                                        at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea
                                        elitr.</p>
                                    {{-- <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                        More</a>
                                    <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Free
                                        Quote</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('frontpage/img/carousel-2.jpg') }}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(6, 3, 21, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Transport & Logistics
                                        Solution</h5>
                                    <h1 class="display-3 text-white animated slideInDown mb-4">#1 Place For Your <span
                                            class="text-primary">Transport</span> Solution</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum
                                        dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum
                                        sea elitr.</p>
                                    {{-- <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                        More</a>
                                    <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Free
                                        Quote</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <!-- Carousel End -->


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
                        <h6 class="text-secondary text-uppercase mb-3">Tentang Kami</h6>
                        <h1 class="mb-5">Pelayanan Export/Import Hasil Bumi dan Laut Indonesia</h1>
                        <div class="mb-5">{!! $about->description !!}</div>
                        <div class="row g-4 mb-5">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <i class="fa fa-globe fa-3x text-primary mb-3"></i>
                                <h5>Cakupan Global</h5>
                                <p class="m-0">Menghubungkan hasil bumi dan laut Indonesia ke seluruh dunia dengan
                                    layanan ekspor/impor terpercaya.</p>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <i class="fa fa-shipping-fast fa-3x text-primary mb-3"></i>
                                <h5>Pelayanan Terbaik</h5>
                                <p class="m-0">Memberikan layanan ekspor/impor terbaik dengan kecepatan, keamanan, dan
                                    kepuasan pelanggan sebagai prioritas.</p>
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
                        <h6 class="text-secondary text-uppercase mb-3">Fakta Menarik</h6>
                        <h1 class="mb-5">{{ $information->title }}</h1>
                        <p class="mb-5">{!! $information->description !!}</p>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-headphones fa-2x flex-shrink-0 bg-primary p-3 text-white"></i>
                            <div class="ps-4">
                                <h6>Hubungi kami!</h6>
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
                                    <p class="text-white mb-0">Pelangan Gembira</p>
                                </div>
                                <div class="bg-secondary p-4 wow fadeIn" data-wow-delay="0.5s">
                                    <i class="fa fa-ship fa-2x text-white mb-3"></i>
                                    <h2 class="text-white mb-2" data-toggle="counter-up">
                                        {{ $information->complete_shipment }}</h2>
                                    <p class="text-white mb-0">Pengiriman Lengkap</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="bg-success p-4 wow fadeIn" data-wow-delay="0.7s">
                                    <i class="fa fa-star fa-2x text-white mb-3"></i>
                                    <h2 class="text-white mb-2" data-toggle="counter-up">
                                        {{ $information->customer_review }}</h2>
                                    <p class="text-white mb-0">Ulasan Pelanggan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Fact End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Produk Kami</h6>
                <h1 class="mb-5">Jelajahi Produk Kami</h1>
            </div>
            <div class="row g-4">
                @forelse ($products as $product)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item p-4">
                            <div class="overflow-hidden mb-4">
                                <img class="img-fluid" src="{{ Storage::url($product->image) }}" alt="">
                            </div>
                            <h4 class="mb-3">{{ Illuminate\Support\Str::limit(strip_tags($product->title), 100) }}</h4>
                            <p>{{ Illuminate\Support\Str::limit(strip_tags($product->excerpt), 200) }}</p>
                            <a class="btn-slide mt-2"
                                href="{{ route('home.product.detail', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                <i class="fa fa-arrow-right"></i>
                                <span>Lihat Detail</span>
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Feature Start -->
    <div class="container-fluid overflow-hidden py-5 px-lg-0">
        <div class="container feature py-5 px-lg-0">
            <div class="row g-5 mx-lg-0">
                <div class="col-lg-6 feature-text wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase mb-3">Fitur Kami</h6>
                    <h1 class="mb-5">Percayakan Kebutuhan Logistik Anda Pada Kami</h1>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa fa-globe text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>Layanan Global</h5>
                            <p class="mb-0">Menghubungkan impor dan ekspor Anda ke seluruh dunia dengan kehandalan dan
                                efisiensi.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-5 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-shipping-fast text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>Pengiriman Tepat Waktu</h5>
                            <p class="mb-0">Menjamin pengiriman barang sesuai jadwal untuk memenuhi kebutuhan bisnis
                                Anda.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-0 wow fadeInUp" data-wow-delay="0.7s">
                        <i class="fa fa-headphones text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>24/7 Dukungan Telepon</h5>
                            <p class="mb-0">DLayanan bantuan cepat dan responsif untuk setiap kebutuhan logistik impor
                                dan ekspor Anda</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100"
                            src="{{ asset('frontpage/img/feature.jpg') }}" style="object-fit: cover;" alt="">
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
                <h6 class="text-secondary text-uppercase">Team Kami</h6>
                <h1 class="mb-5">Anggota Team Ahli</h1>
            </div>
            <div class="row g-4">
                @forelse ($teams as $team)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item p-4">
                            <div class="overflow-hidden mb-4">
                                <img class="img-fluid" src="{{ Storage::url($team->image) }}"
                                    alt="{{ $team->name }}">
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
