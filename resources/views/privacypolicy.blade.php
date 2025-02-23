<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('head_links')
        <title>Dealslah | Privacy Policy</title>
        <meta name="description" content="Privacy Policy for Dealslah." />
        <link rel="canonical" href="https://dealslah.com/privacyPolicy" />
        <link rel="icon" href="{{ asset('assets/images/home/favicon.ico') }}" />

           <!-- Google Fonts -->
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        {{-- Boostrap css  --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        {{-- Custom Css  --}}
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @show
</head>

<body>
    <section class="home-section">
        @include('nav.header')
        <div class="home-content container" style="margin-top: 100px">
            <div class="mt-5 mb-5">
                <h1>Dealslah Privacy Policy</h1>
                <h3>Effective Date: 24/09/2024</h3>
            </div>
            <div>
                <h2>1. Introduction</h2>
                <p>Dealslah is committed to protecting your privacy. This Privacy Policy outlines
                    how we collect, use, disclose, and protect your personal information when you
                    visit our website, dealslah.com.</p>
            </div>
            <div>
                <h2>2. Information We Collect</h2>
                <p>We may collect the following types of information: </p>
                <ul>
                    <li>
                        <span class="fw-normal">Personal Information: </span> Name, email address, phone number, and
                        other
                        information you voluntarily provide.
                    </li>
                    <li>
                        <span class="fw-normal">Usage Data: </span> Information about how you interact with our
                        website,
                        including your IP address, browser type, and pages visited.
                    </li>
                    <li>
                        <span class="fw-normal">Cookies and Similar Technologies: </span> We may use cookies and
                        similar
                        technologies to collect information about your browsing activities.
                    </li>
                </ul>
            </div>
            <div>
                <h2>3. How We Use Your Information</h2>
                <p>We may use your information for the following purposes: </p>
                <ul>
                    <li>
                        To provide and improve our services.
                    </li>
                    <li>
                        To communicate with you about our services and offers.
                    </li>
                    <li>
                        To analyze website usage and trends.
                    </li>
                    <li>
                        To comply with legal requirements.
                    </li>
                </ul>
            </div>
            <div>
                <h2>4. Disclosure of Your Information</h2>
                <p>We may disclose your information to: </p>
                <ul>
                    <li>
                        Service providers who assist us in operating our website and services.
                    </li>
                    <li>
                        Law enforcement authorities or other government agencies as required
                        by law.
                    </li>
                    <li>
                        Third parties with your consent.
                    </li>
                </ul>
            </div>
            <div>
                <h2>5. Your Rights</h2>
                <p>You may have the right to:</p>
                <ul>
                    <li>
                        Access your personal information.
                    </li>
                    <li>
                        Rectify inaccurate information.
                    </li>
                    <li>
                        Request the deletion of your personal information.
                    </li>
                    <li>
                        Object to the processing of your personal information.
                    </li>
                    <li>
                        Restrict the processing of your personal information.
                    </li>
                    <li>
                        Data portability.
                    </li>
                </ul>
            </div>
            <div>
                <h2>6. Security</h2>
                <p>We implement reasonable security measures to protect your personal
                    information from unauthorized access, disclosure, alteration, or destruction.</p>
            </div>
            <div>
                <h2>7. Children's Privacy</h2>
                <p>Our website is not intended for children under the age of 18. We do not
                    knowingly collect personal information from children.</p>
            </div>
            <div>
                <h2>8. Changes to This Privacy Policy</h2>
                <p>We may update this Privacy Policy from time to time. We will notify you of any
                    significant changes by posting the revised policy on our website.</p>
            </div>
            <div>
                <h2>9. Contact Us</h2>
                <p>If you have any questions about this Privacy Policy or our practices, please
                    contact us at:</p>
                <br /><div>
                <p class="fw-medium">Dealslah Pte Ltd</p>
                <p class="fw-medium">The Alexcier,</p>
                <p class="fw-medium">237 Alexandra Road,</p>
                <p class="fw-medium">#04-10,</p>
                <p class="fw-medium">Singapore-159929</p>
                <p class="fw-medium">info@dealslah.com</p>
                <p class="fw-medium">+65 8894 1306</p>
            </div>
        </div>
        </div>
        @include('nav.footer')
    </section>
    <!-- ======= Script  ======= -->

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/5b8838406b.js" crossorigin="anonymous"></script>

    <!-- Page Scripts -->
    @stack('scripts')
</body>

</html>
