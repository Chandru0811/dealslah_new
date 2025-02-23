<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('head_links')
        <title>Dealslah | Support and Contact</title>
        <link rel="canonical" href="https://dealslah.com/support" />
        <link rel="icon" href="{{ asset('assets/images/home/favicon.ico') }}" />

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        {{-- Bootstrap css  --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        {{-- Custom Css  --}}
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @show
    <style>
        .pinkColor {
            color: #ef4444;
        }
    </style>
</head>

<body>
    <section class="py-5">
        <div class="container">
            <div class="row ">
                <!-- Text Section -->
                <div class="col-md-6 col-12 d-flex flex-column justify-content-center" style="min-height: 80vh">
                    <h2 class="display-6 pinkColor font-weight-bold mb-4">Account Deletion Request</h2>
                    <p class=" mb-4">We understand that sometimes you may wish to delete your account.<br> To request
                        permanent account deletion, please contact our support team, who will assist you with the
                        process.</p>
                    <div class="contact-info">
                        <p class="h5 mb-2">Support Contact Information:</p>
                        <div class="mb-3">
                            <p class="mt-3 mb-0">Phone:</p>
                            <p class="phone-number h3 text-success"><a href="tel:+6588941306"
                                    class="text-decoration-none pinkColor"><b>+65 88941306</b></a></p>
                        </div>
                        <div>
                            <p class="mt-3 mb-0">Email:</p>
                            <p class="h5"><a href="mailto:info@dealslah.com"
                                    class="text-decoration-none pinkColor">info@dealslah.com</a></p>
                        </div>
                    </div>
                </div>

                <!-- Image Section -->
                <div class="col-md-6 col-12 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/images/home/support.svg') }}" alt="Support Our team" class="img-fluid"
                        style="max-width: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- Page Scripts -->
    @stack('scripts')
</body>

</html>
