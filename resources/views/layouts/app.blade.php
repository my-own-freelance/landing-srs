@php
    $setting = \App\Models\About::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('icon/icon.png') }}">
    <title>@yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="title" content="Professional Export/Import Services | PT. SAMUDERA RIZKI SEJAHTERA" />
    <meta name="description"
        content="We are a leading service provider in the field of export and import of Indonesian agricultural and marine products. Trust your import and export needs to our global, quality and timely services" />
    <meta name="keywords" content="Professional Export/Import Services | PT. SAMUDERA RIZKI SEJAHTERA" />
    <meta name="keywords"
        content="Indonesian Import Export, Trusted Import Export Services, International Logistics Services, Marine Earth Export Importer, Import Export Service Provider" />
    <meta property="og:image" content="{{ asset('icon/icon.png') }}" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name"
        content="Indonesian Import Export, Trusted Import Export Services, International Logistics Services, Marine Earth Export Importer, Import Export Service Provider">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    @stack('metadata')
    @include('partials.front.styles')
    @stack('styles')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-warning" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    {{-- NAVBAR --}}
    @include('partials.front.navbar')

    {{-- CONTENT --}}
    @yield('content')


    {{-- FOOTER --}}
    @include('partials.front.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-warning text-white btn-lg-square rounded-0 back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    {{-- SCRIPTS --}}
    @include('partials.front.scripts')
    @stack('scripts')
    <script>
        var url = 'https://wati-integration-prod-service.clare.ai/v2/watiWidget.js?57881';
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url;
        var options = {
            "enabled": true,
            "chatButtonSetting": {
                "backgroundColor": "#00e785",
                "ctaText": "Send Message",
                "borderRadius": "25",
                "marginLeft": "0",
                "marginRight": "20",
                "marginBottom": "20",
                "ctaIconWATI": false,
                "position": "left"
            },
            "brandSetting": {
                "brandName": "Wati",
                "brandSubTitle": "SRS JATENG",
                "brandImg": "https://www.wati.io/wp-content/uploads/2023/04/Wati-logo.svg",
                "welcomeText": "Halo!\n How can we help you?",
                "messageText": "Hello, please convey your needs",
                "backgroundColor": "#00e785",
                "ctaText": "Send Message",
                "borderRadius": "25",
                "autoShow": false,
                "phoneNumber": "{{ $setting->whatsapp }}"
            }
        };
        s.onload = function() {
            CreateWhatsappChatWidget(options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
</body>

</html>
