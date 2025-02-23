<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealslah | Forgot Password </title>
    <link rel="canonical" href="https://dealslah.com/forgot-password" />
    <meta name="description" content="Dealslah Shop Smart, Save Big!" />
    <link rel="icon" href="{{ asset('assets/images/home/favicon.ico') }}" />

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    <section class="container-fluid p-0">
        @if (session('status'))
            <div class="alert alert-dismissible fade show toast-success" role="alert"
                style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
                <div class="toast-content">
                    <div class="toast-icon">
                        <i class="fa-solid fa-check-circle" style="color: #16A34A"></i>
                    </div>
                    <span class="toast-text"> {!! nl2br(e(session('status'))) !!}</span>&nbsp;&nbsp;
                    <button class="toast-close-btn"data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa-thin fa-xmark" style="color: #16A34A"></i>
                    </button>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert  alert-dismissible fade show toast-danger" role="alert"
                style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
                <div class="toast-content">
                    <div class="toast-icon">
                        <i class="fa-solid fa-triangle-exclamation" style="color: #EF4444"></i>
                    </div>
                    <span class="toast-text">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </span>&nbsp;&nbsp;
                    <button class="toast-close-btn"data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa-solid fa-xmark" style="color: #EF4444"></i>
                    </button>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="alert  alert-dismissible fade show toast-danger" role="alert"
                style="position: fixed; top: 70px; right: 40px; z-index: 1050;">
                <div class="toast-content">
                    <div class="toast-icon">
                        <i class="fa-solid fa-triangle-exclamation" style="color: #EF4444"></i>
                    </div>
                    <span class="toast-text">
                        {{ session('error') }}
                    </span>&nbsp;&nbsp;
                    <button class="toast-close-btn"data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa-solid fa-xmark" style="color: #EF4444"></i>
                    </button>
                </div>
            </div>
        @endif
        <div class="row m-0">
            <div class="col-md-6 col-12 d-flex flex-column justify-content-center align-items-center pt-5 bg_login login-text-container text-center"
                style="background: #ffcbde">
                <div class="px-5 pt-5">
                    <h5 class="py-4" style="color: #CC004D">Forgot Password to your account</h5>
                    <p class="login-text">You're just one step away from securing your awesome purchase!
                        Sign up or log in now to complete your order effortlessly</p>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/images/bg_img.svg') }}" alt="header_logo" class="img-fluid" />
                </div>
            </div>
            <div class="col-md-6 col-12 d-flex justify-content-center align-items-center login-container">
                <div class="d-flex flex-column justify-content-center align-items-center w-100">
                    <h3 class="login-title text-center mb-4">Forgot Password</h3>
                    <form id="forgotpasswordForm" class="w-75" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3 email-container">
                            <input type="email" class="form-control" id="email" name="email" value=""
                                placeholder="Email" />
                            <span class="error text-danger" id="emailError"
                                style="display: none; font-size: 12px;"></span>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn login-btn w-100"
                                style="color: #fff; background:#ef4444;">Reset Password</button>
                        </div>
                        <div class="text-end">
                            <p style="font-size: 12px">Go Back to <a href="{{ url('login') }}"
                                    style="color: #ef4444;font-size:12px">Login</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script> <!-- jQuery -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/5b8838406b.js" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#forgotpasswordForm").on("submit", function(e) {
                e.preventDefault();

                $("#emailError").hide();

                // Get the email value and validate it
                const email = $("#email").val().trim();
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                let isValid = true;

                // Validate the email field
                if (email === "") {
                    $("#emailError").text("Email field is required.").show();
                    isValid = false;
                } else if (!emailPattern.test(email)) {
                    $("#emailError").text("Please enter a valid email address.").show();
                    isValid = false;
                }

                if (isValid) {
                    const submitButton = $("button[type='submit']");
                    submitButton.prop('disabled', true);

                    // const loader = $('<span class="custom-loader"></span>');
                    // submitButton.append(loader);

                    setTimeout(() => {
                        this.submit();
                    });
                }
            });
        });
    </script>
</body>

</html>
