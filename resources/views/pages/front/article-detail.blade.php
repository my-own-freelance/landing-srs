@extends('layouts.app')
@section('title', $title)
@push('metadata')
    @if ($article)
        <meta property="og:image" content="{{ Storage::url($article->image) }}" />
        <meta property="og:title" content="{{ $article->title }}" />
        <meta property="og:keywords" content="{{ $article->title }}" />
        <meta name="keywords" content="{{ $article->title }}" />
        <meta property="og:description"
            content="{{ Illuminate\Support\Str::limit(strip_tags($article->description), 200) }}" />
        <meta name="description" content="{{ Illuminate\Support\Str::limit(strip_tags($article->excerpt), 200) }}" />
        <meta name="excerpt" content="{{ Illuminate\Support\Str::limit(strip_tags($article->excerpt), 200) }}" />
    @endif
@endpush
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Article Detail</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home.article') }}">Article Detail</a>
                    </li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ $article ? $article->title : '' }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="wow fadeInUp" data-wow-delay="0.1s">
                @if ($article)
                    <div class="text-center">
                        <img class="image mx-auto" width="100%" src="{{ Storage::url($article->image) }}"
                            alt="{{ $article->title }}">
                    </div>
                    <h4 class="mt-3">{{ $article->title }}</h4>
                    <div class="mt-3">
                        {!! $article->description !!}
                    </div>
                @endif
            </div>

        </div>
    </div>
    <!-- Service End -->


@endsection
