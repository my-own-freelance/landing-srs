<!-- Sidebar -->
@php
    $routename = request()->route()->getName();
    $role = json_decode(Cookie::get('user'))->role;
@endphp
<div class="sidebar sidebar-style-2" data-background-color="{{ $sidebarColor }}">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item ml-3 {{ $routename == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master</h4>
                </li>
                <li class="nav-item ml-3 {{ $routename == 'article' ? 'active' : '' }}">
                    <a href="{{ route('article') }}">
                        <i class="fas fa-newspaper"></i>
                        <p>Artikel</p>
                    </a>
                </li>
                <li class="nav-item ml-3 {{ $routename == 'product' ? 'active' : '' }}">
                    <a href="{{ route('product') }}">
                        <i class="fas fa-cubes"></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item ml-3 {{ $routename == 'slide' ? 'active' : '' }}">
                    <a href="{{ route('slide') }}">
                        <i class="fas fa-images"></i>
                        <p>Slide</p>
                    </a>
                </li>
                <li class="nav-item ml-3 {{ $routename == 'gallery' ? 'active' : '' }}">
                    <a href="{{ route('gallery') }}">
                        <i class="fas fa-camera"></i>
                        <p>Galeri</p>
                    </a>
                </li>
                <li class="nav-item ml-3 {{ $routename == 'team' ? 'active' : '' }}">
                    <a href="{{ route('team') }}">
                        <i class="fas fa-users"></i>
                        <p>Team</p>
                    </a>
                </li>
                <li class="nav-item ml-3 {{ $routename == 'review' ? 'active' : '' }}">
                    <a href="{{ route('review') }}">
                        <i class="fas fa-comment-dots"></i>
                        <p>Review</p>
                    </a>
                </li>
                <li class="nav-item ml-3 {{ $routename == 'contact' ? 'active' : '' }}">
                    <a href="{{ route('contact') }}">
                        <i class="fas fa-envelope"></i>
                        <p>Hubungi Kami</p>
                    </a>
                </li>a
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Logout</h4>
                </li>
                <li class="nav-item ml-3">
                    <a href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
