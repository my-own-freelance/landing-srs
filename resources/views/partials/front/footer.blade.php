<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 6rem;">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-2 col-md-0"></div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-light mb-4">Address</h4>
                @if ($setting)
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ $setting->address }}</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ $setting->whatsapp }}</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ $setting->email }}</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" target="_blank" href="{{ $setting->twitter }}"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" target="_blank" href="{{ $setting->telegram }}"><i
                                class="fab fa-telegram"></i></a>
                        <a class="btn btn-outline-light btn-social" target="_blank" href="{{ $setting->youtube }}"><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" target="_blank" href="{{ $setting->linkedin }}"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                @endif
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-light mb-4">Quick Links</h4>
                <a class="btn btn-link" href="{{ route('home.about') }}">About Us</a>
                <a class="btn btn-link" href="{{ route('home.contact') }}">Contact Us</a>
                <a class="btn btn-link" href="{{ route('home.product') }}">Products</a>
                <a class="btn btn-link" href="{{ route('home.article') }}">Articles</a>
                <a class="btn btn-link" href="{{ route('home.team') }}">Teams</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-12 text-center mb-3 mb-md-0">
                    &copy; <a class="border-bottom text-center" href="{{ route('home') }}">PT. SAMUDERA RIZKI
                        SEJAHTERA</a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
