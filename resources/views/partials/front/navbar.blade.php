@php
    $routename = request()->route()->getName();
@endphp
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow border-top border-5 border-warning sticky-top p-0">
    <a href="index.html" class="navbar-brand bg-warning d-flex align-items-center px-4 px-lg-5">
        <h3 class="mb-2 text-white">PT. SRS JATENG</h3>
        {{-- <img src="{{ asset('icon/icon.png') }}" width="70" alt=""> --}}
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ $routename == 'home' ? 'active' : '' }}">Home</a>
            <a href="about.html" class="nav-item nav-link {{ $routename == 'home.about' ? 'active' : '' }}">About</a>
            <a href="{{ route('home.product') }}"
                class="nav-item nav-link {{ $routename == 'home.product' || $routename == 'home.product.detail' ? 'active' : '' }}">Produk</a>
            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ $routename == 'home.article' ||
                    $routename == 'home.article.detail' ||
                    $routename == 'home.gallery' ||
                    $routename == 'home.team' ||
                    $routename == 'home.testimonial'
                        ? 'active'
                        : '' }}"
                    data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu fade-up m-0">
                    <a href="{{ route('home.article') }}" class="dropdown-item">Artikel</a>
                    <a href="{{ route('home.gallery') }}" class="dropdown-item">Gallery</a>
                    <a href="{{ route('home.team') }}" class="dropdown-item">Team</a>
                    <a href="{{ route('home.testimonial') }}" class="dropdown-item">Testimonial</a>
                </div>
            </div>
            <a href="{{ route('home.contact') }}"
                class="nav-item nav-link {{ $routename == 'home.contact' ? 'active' : '' }}">Contact</a>
        </div>
        @if ($setting)
            <h4 class="m-0 pe-lg-5 d-none d-lg-block"><i
                    class="fa fa-headphones text-warning me-3"></i>{{ $setting->whatsapp }}
            </h4>
        @endif
    </div>
</nav>
<!-- Navbar End -->
