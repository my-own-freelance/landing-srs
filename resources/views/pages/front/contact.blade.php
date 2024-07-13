@extends('layouts.app')
@section('title', $title)
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid overflow-hidden py-5 px-lg-0">
        <div class="container contact-page py-5 px-lg-0">
            <div class="row g-5 mx-lg-0">
                <div class="col-md-6 contact-form wow fadeIn" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase">Get In Touch</h6>
                    <h1 class="mb-4">Contact For Any Query</h1>
                    <p class="mb-4">Have questions or need further help? Contact us via the form below for fast,
                        personalized service..</p>
                    <div class="bg-light p-4">
                        <form id="contactForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if ($about)
                    <div class="col-md-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s">
                        <div class="position-relative h-100">
                            <iframe class="position-absolute w-100 h-100" style="object-fit: cover;"
                                src="{{ $about->location }}" frameborder="0" allowfullscreen="" aria-hidden="false"
                                tabindex="0"></iframe>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('#contactForm').submit(function(e) {
                e.preventDefault();

                let dataToSend = new FormData()
                dataToSend.append("name", $("#name").val());
                dataToSend.append("email", $("#email").val());
                dataToSend.append("subject", $("#subject").val());
                dataToSend.append("message", $("#message").val());

                saveData(dataToSend)
                return false;
            });

            function saveData(data) {
                $.ajax({
                    url: '/api/contact/send-message',
                    data: data,
                    contentType: false,
                    processData: false,
                    method: "POST",
                    beforeSend: function() {
                        console.log("Loadig...")
                    },
                    success: function(response) {
                        console.log("response :", response)
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent',
                            text: 'Your message has been sent successfully.',
                            confirmButtonText: 'OK'
                        });

                        $('#contactForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to send message. Please try again later.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    </script>
@endpush
