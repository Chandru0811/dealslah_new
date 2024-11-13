$(document).ready(function () {
    $(".social-button .fab.fa-twitter")
        .removeClass("fa-twitter")
        .addClass("fa-x-twitter");

    $("#togglePassword").on("click", function () {
        const passwordField = $("#password");
        const eyeIcon = $("#eyeIconPassword");

        if (passwordField.attr("type") === "password") {
            passwordField.attr("type", "text");
            eyeIcon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            passwordField.attr("type", "password");
            eyeIcon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $("#toggleConfirmPassword").on("click", function () {
        const confirmPasswordField = $("#password_confirmation");
        const eyeIconConfirm = $("#eyeIconConfirm");

        if (confirmPasswordField.attr("type") === "password") {
            confirmPasswordField.attr("type", "text");
            eyeIconConfirm.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            confirmPasswordField.attr("type", "password");
            eyeIconConfirm.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $("#enquiryFormMain").validate({
        rules: {
            name: {
                required: true,
            },
            phone: {
                required: true,
                digits: true,
                minlength: 8,
                maxlength: 10,
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
            },
            phone: {
                required: "Please enter your phone number",
                digits: "Phone number must be numeric",
                minlength: "Phone number must be at least 8 digits",
                maxlength: "Phone number can't exceed 10 digits",
            },
        },
        errorPlacement: function (error, element) {
            error.addClass("text-light mt-1");
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function (form) {
            submitEnquiryForm(form);
        },
    });

    // Validation for Modal Form
    $("#enquiryFormModal").validate({
        rules: {
            name: {
                required: true,
            },
            phone: {
                required: true,
                digits: true,
                minlength: 8,
                maxlength: 10,
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
            },
            phone: {
                required: "Please enter your phone number",
                digits: "Phone number must be numeric",
                minlength: "Phone number must be at least 8 digits",
                maxlength: "Phone number can't exceed 10 digits",
            },
        },
        errorPlacement: function (error, element) {
            error.addClass("text-light mt-1");
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function (form) {
            submitEnquiryForm(form);
        },
    });

    function submitEnquiryForm(form) {
        var $currentForm = $(form);
        var dealId = $currentForm.data("deal-id");

        var payload = {
            name: $currentForm.find("[name='name']").val(),
            email: $currentForm.find("[name='email']").val(),
            phone: $currentForm.find("[name='phone']").val(),
            company_id: 42,
            company: "Dealsmachi",
            lead_status: "PENDING",
            lead_source: "Product Page",
            country_code: "91",
        };

        var laravelRequest = $.ajax({
            url: "/deals/count/enquire",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            contentType: "application/json",
            data: JSON.stringify({ id: dealId }),
        });

        var crmlahRequest = $.ajax({
            url: "https://crmlah.com/ecscrm/api/newClient",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(payload),
        });

        $.when(laravelRequest, crmlahRequest)
            .done(function (laravelResponse, crmlahResponse) {
                console.log(
                    "Both APIs succeeded:",
                    laravelResponse,
                    crmlahResponse
                );
                $("#successModal").modal("show");
                $currentForm[0].reset();
                $("#enquiryModal").modal("hide");
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.error(
                    "One or both API calls failed:",
                    textStatus,
                    errorThrown
                );
                $("#errorModal").modal("show");
                $currentForm[0].reset();
                $("#enquiryModal").modal("hide");
            });
    }
});

function closePopup() {
    $("#successModal").modal("hide");
    $("#errorModal").modal("hide");
}

$(document).ready(function () {
    $(".carousel_slider").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
        navText: ["&#10094;", "&#10095;"],
    });
});

$("#contactForm").validate({
    rules: {
        first_name: {
            required: true,
            minlength: 2,
        },
        email: {
            required: true,
            email: true,
        },
        mobile: {
            required: true,
            number: true,
            minlength: 8,
            maxlength: 10,
        },
        description_info: {
            required: true,
        },
    },
    messages: {
        first_name: {
            required: "Please enter your first name*",
            minlength: "Your name must be at least 2 characters long",
        },
        email: {
            required: "Please enter your email*",
            email: "Please enter a valid email address",
        },
        mobile: {
            required: "Please enter your phone number*",
            number: "Please enter a valid phone number",
            minlength: "Your phone number must be at least 8 digits long",
            maxlength: "Your phone number must be at most 10 digits long",
        },
        description_info: {
            required: "Please enter your message*",
        },
    },
    errorPlacement: function (error, element) {
        error.appendTo(element.next(".error"));
    },
    submitHandler: function (form) {
        var payload = {
            first_name: $("#first_name").val(),
            last_name: $("#last_name").val(),
            email: $("#email").val(),
            phone: $("#mobile").val(),
            company_id: 42,
            company: "DealsMachi",
            lead_status: "PENDING",
            description_info: $("#description_info").val(),
            lead_source: "Contact Us",
            country_code: "65",
            createdBy: $("#first_name").val(),
        };

        // console.log("Form data:", $("#description_info").val());

        // AJAX call to the newClient API
        $.ajax({
            url: "https://crmlah.com/ecscrm/api/newClient",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(payload),
            success: function (response) {
                console.log("API response:", response);
                $("#successModal").modal("show");
                $(form).trigger("reset"); // Reset form after successful submission
            },
            error: function (xhr, status, error) {
                console.error("API call failed:", error);
                $("#errorModal").modal("show");
            },
        });
    },
});

function copySpanText(element, event) {
    event.preventDefault();
    event.stopPropagation();

    var couponCode = element.innerText.trim();

    var tempInput = document.createElement("textarea");
    tempInput.value = couponCode;
    document.body.appendChild(tempInput);

    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    var dealId = element.closest("a").getAttribute("href").split("/").pop();

    $.ajax({
        url: "/deals/coupon/copied",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            coupon_code: couponCode,
            id: dealId,
        },
        success: function (response) {
            console.log(response.message);
        },
        error: function (xhr) {
            console.log("Error occurred: " + xhr.statusText);
        },
    });

    showTooltip(element);
}

function copyLinkToClipboard(element, event, dealId) {
    event.preventDefault();
    event.stopPropagation();
    const currentUrl = window.location.href;

    var tempInput = document.createElement("textarea");
    tempInput.value = currentUrl;
    document.body.appendChild(tempInput);

    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    $.ajax({
        url: "/deals/count/share",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            id: dealId,
        },
        success: function (response) {
            console.log(response.message);
        },
        error: function (xhr) {
            console.log("Error occurred: " + xhr.statusText);
        },
    });

    showTooltip(element);
}

function showTooltip(element) {
    const tooltipText = element.querySelector(".tooltip-text");
    tooltipText.style.visibility = "visible";

    setTimeout(() => {
        tooltipText.style.visibility = "hidden";
    }, 2000);
}

function hideTooltip(element) {
    var tooltip = element.querySelector(".tooltip-text");
    tooltip.style.visibility = "hidden";
}

function toggleNumber(event) {
    event.preventDefault();
    const link = event.currentTarget;

    const fullNumber = link.getAttribute("data-full-number");
    const maskedNumber = link.getAttribute("data-masked-number");

    if (link.textContent === maskedNumber) {
        link.textContent = fullNumber;
        link.href = `tel:${fullNumber}`;
    } else {
        link.textContent = maskedNumber;
        link.href = `tel:${fullNumber}`;
    }
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Function to update the bookmark count
    function updateBookmarkCount(count) {
        $(".totalItemsCount").each(function () {
            if (count > 0) {
                $(this).text(count).css("visibility", "visible");
            } else {
                $(this).text("").css("visibility", "hidden");
            }
        });
    }

    // Add Bookmark
    function handleAddBookmark() {
        $(".add-bookmark")
            .off("click")
            .on("click", function (e) {
                e.preventDefault();
                let dealId = $(this).data("deal-id");

                $.ajax({
                    url: `/bookmark/${dealId}/add`,
                    method: "POST",
                    success: function (response) {
                        updateBookmarkCount(response.total_items);

                        let button = $(
                            `.add-bookmark[data-deal-id="${dealId}"]`
                        );
                        button
                            .removeClass("add-bookmark")
                            .addClass("remove-bookmark");
                        button.html(`
                        <p style="height:fit-content;cursor:pointer" class="p-1 px-2">
                            <i class="fa-solid fa-bookmark bookmark-icon" style="color: #ff0060;"></i>
                        </p>
                    `);

                        handleRemoveBookmark();
                    },
                    error: function (xhr) {},
                });
            });
    }

    // Remove Bookmark
    function handleRemoveBookmark() {
        $(".remove-bookmark")
            .off("click")
            .on("click", function (e) {
                e.preventDefault();
                let dealId = $(this).data("deal-id");

                $.ajax({
                    url: `/bookmark/${dealId}/remove`,
                    method: "DELETE",
                    success: function (response) {
                        updateBookmarkCount(response.total_items);

                        let button = $(
                            `.remove-bookmark[data-deal-id="${dealId}"]`
                        );
                        button
                            .removeClass("remove-bookmark")
                            .addClass("add-bookmark");
                        button.html(`
                        <p style="height:fit-content;cursor:pointer" class="p-1 px-2">
                            <i class="fa-regular fa-bookmark bookmark-icon" style="color: #ff0060;"></i>
                        </p>
                    `);

                        handleAddBookmark(); // Re-bind the add bookmark handler
                    },
                    error: function (xhr) {
                        // Handle error (optional)
                    },
                });
            });
    }

    // Initialize the event handlers
    handleAddBookmark();
    handleRemoveBookmark();

    // Initial Load of Bookmark Count
    function loadBookmarkCount() {
        $.ajax({
            url: "/totalbookmark",
            method: "GET",
            success: function (response) {
                updateBookmarkCount(response.total_items);
            },
            error: function (xhr) {
                console.error("Failed to load bookmark count.");
            },
        });
    }

    loadBookmarkCount();

    // Disable or remove tooltip from bookmark buttons
    // Option 1: Disable the tooltip functionality
    $(".bookmark-button").tooltip("disable");

    // Option 2: Remove the tooltip attribute entirely
    $('.bookmark-button [data-bs-toggle="tooltip"]').removeAttr(
        "data-bs-toggle"
    );
});

const currentUrl = encodeURIComponent(window.location.href);

function shareOnInstagram() {
    alert(
        "Instagram does not support direct message and link sharing. Copy the message below and share it manually:"
    );
    navigator.clipboard.writeText(
        `Check out this amazing deal : ${decodeURIComponent(currentUrl)}`
    );
    window.open("https://www.instagram.com", "_blank");
}

document
    .querySelectorAll(".social-link-container a")
    .forEach(function (button) {
        button.addEventListener("click", function (event) {
            var productId = event.target
                .closest(".social-link-container")
                .getAttribute("data-product-id");
            var shareUrl = event.target.closest("a").href;

            $.ajax({
                url: "/deals/count/share",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    id: productId,
                },
                success: function (response) {
                    console.log(response.message);
                    window.open(shareUrl, "_blank");
                },
                error: function (xhr) {
                    console.log("Error occurred: " + xhr.statusText);
                    window.open(shareUrl, "_blank");
                },
            });

            event.preventDefault();
        });
    });

$('input[type="checkbox"]').change(function () {
    var selectedPriceRanges = [];

    $('input[name="price_range[]"]:checked').each(function () {
        selectedPriceRanges.push($(this).val());
    });

    $.ajax({
        url: "/your-api-endpoint",
        method: "GET", // or POST depending on your API
        data: {
            price_range: selectedPriceRanges,
            // include other data if needed
        },
        success: function (response) {
            // Update the page content dynamically
            $("#your-products-list").html(response);
        },
        error: function (error) {
            console.error(error);
        },
    });
});

function clickCount(dealId) {
    $.ajax({
        url: `${window.location.origin}/deals/count/click`,
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            id: dealId,
        },
        success: function (response) {
            console.log(response.message);
        },
        error: function (xhr) {
            console.log("Error occurred: " + xhr.statusText);
        },
    });
}

function showAddress(country) {
    var contents = document.getElementsByClassName("address-content");
    for (var i = 0; i < contents.length; i++) {
        contents[i].classList.remove("active-address");
    }

    // Show the selected address
    document.getElementById(country).classList.add("active-address");

    // Update active tab styling
    var tabs = document.getElementsByClassName("nav-link");
    for (var j = 0; j < tabs.length; j++) {
        tabs[j].classList.remove("active");
    }
    document.getElementById(country + "-tab").classList.add("active");

    // Change phone number and href based on the selected country
    var phoneLink = document.getElementById("phone-link");
    var phoneNumber = document.getElementById("phone-number");

    if (country === "india") {
        phoneLink.href = "tel:+919361365818";
        phoneNumber.innerHTML = "+91 93613 65818";
    } else if (country === "india") {
        phoneLink.href = "tel:+919361365818";
        phoneNumber.innerHTML = "+91 93613 65818";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    function formatIndianNumber(number) {
        let [integerPart, decimalPart] = number.toString().split(".");

        let lastThree = integerPart.slice(-3);
        let rest = integerPart.slice(0, -3);

        if (rest.length > 0) {
            rest = rest.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + ",";
        }

        let formattedNumber = "₹" + rest + lastThree;

        if (decimalPart !== undefined) {
            formattedNumber += "." + decimalPart;
        }
        return formattedNumber;
    }

    document.querySelectorAll(".discounted-price").forEach((element) => {
        let price = parseFloat(element.innerText);
        element.innerText = formatIndianNumber(price);
    });

    document.querySelectorAll(".original-price").forEach((element) => {
        let price = parseFloat(element.innerText);
        element.innerText = formatIndianNumber(price);
    });
});

function selectPaymentOption(optionId) {
    document.querySelectorAll(".card.payment-option").forEach((card) => {
        card.classList.remove("selected");
    });

    const selectedCard = document.getElementById(optionId).closest(".card");
    selectedCard.classList.add("selected");

    document.getElementById(optionId).checked = true;
}

$(document).ready(function () {
    const dealType = parseInt($('#checkoutForm').data('deal-type'), 10);

    const validator = $("#checkoutForm").validate({
        rules: {
            first_name: { required: true },
            last_name: { required: true },
            email: { required: true, email: true },
            mobile: { required: true, digits: true, minlength: 10, maxlength: 10 },
            billing_street: { required: true },
            billing_city: { required: true },
            billing_state: { required: true },
            billing_country: { required: true },
            billing_zipCode: { required: true, digits: true },
            payment_type: { required: true },
            shipping_street: {
                required: function () {
                    return !$('#sameAsShipping').is(':checked');
                },
            },
            shipping_city: {
                required: function () {
                    return !$('#sameAsShipping').is(':checked');
                },
            },
            shipping_state: {
                required: function () {
                    return !$('#sameAsShipping').is(':checked');
                },
            },
            shipping_country: {
                required: function () {
                    return !$('#sameAsShipping').is(':checked');
                },
            },
            shipping_zipCode: {
                required: function () {
                    return !$('#sameAsShipping').is(':checked');
                },
                digits: true,
            },
            service_date: {
                required: function () {
                    return dealType === 2;
                },
                date: true,
            },
            service_time: {
                required: function () {
                    return dealType === 2;
                },
                time: true,
            },
        },
        messages: {
            first_name: "First name is required",
            last_name: "Last name is required",
            email: {
                required: "Email is required",
                email: "Please enter a valid email address",
            },
            mobile: {
                required: "Mobile number is required",
                digits: "Please enter a valid mobile number",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Mobile number must be 10 digits",
            },
            billing_street: "Street is required",
            billing_city: "City is required",
            billing_state: "State is required",
            billing_country: "Country is required",
            billing_zipCode: {
                required: "Zip Code is required",
                digits: "Zip Code should contain only numbers",
            },
            payment_type: "Please select a payment method",
            shipping_street: "Street is required",
            shipping_city: "City is required",
            shipping_state: "State is required",
            shipping_country: "Country is required",
            shipping_zipCode: {
                required: "Zip Code is required",
                digits: "Zip Code should contain only numbers",
            },
            service_date: {
                required: "Service date is required",
                date: "Please enter a valid date",
            },
            service_time: {
                required: "Service time is required",
                time: "Please enter a valid time",
            },
        },
        errorPlacement: function (error, element) {
            error.addClass("text-danger mt-1");
            if (element.attr("name") === "payment_type") {
                error.insertAfter(".payment-option:first");
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        }
    });

    $('#sameAsShipping').change(function () {
        if ($(this).is(':checked')) {
            $('#shippingAddress').hide();
            $('#shipping_street, #shipping_city, #shipping_state, #shipping_country, #shipping_zipCode').removeClass("is-invalid");
            $('.text-danger').filter(function () {
                return $(this).prev().is('#shipping_street, #shipping_city, #shipping_state, #shipping_country, #shipping_zipCode');
            }).remove();
        } else {
            $('#shippingAddress').show();
        }
    });

    if ($('#sameAsShipping').is(':checked')) {
        $('#shippingAddress').hide();
    }
});