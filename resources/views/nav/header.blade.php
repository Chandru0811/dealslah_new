    <!-- Header Start -->
    @php
    $selectedAddressId = session('selectedId');
    $default_address = $addresses->firstWhere('default', true) ?? null; // Add fallback to null
    @endphp

    <section class="header">
        <nav id="NavBar" class="navbar mainNav fixed-top navbar-expand-xl navbar-light"
            style="background-color: #fff !important">
            <div class="container d-flex align-items-center justify-content-between">
                <a href="/" class="text-decoration-none">
                    <img src="{{ asset('assets/images/home/header-logo.webp') }}" alt="header-logo"
                        class="mx-2 img-fluid header-logo" width="200" />
                </a>
                <div class="d-flex align-items-center mb-1">
                    {{-- <span class="navbar-text d-xl-none align-items-center justify-content-end">
                        <a href="https://dealslah.com/dealslahVendor/" style="text-decoration: none">
                            <button
                                class="btn btn-button userlogin-button py-1 px-2 d-flex justify-content-center align-items-center text-nowrap"
                                type="submit">
                                Post your Deal
                            </button>
                        </a>
                    </span> --}}
                    &nbsp;&nbsp;&nbsp;
                    {{-- <button class="btn btn-button " style="border: none; position: relative;" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Bookmarks">
                        <a href="{{ url('/bookmarks') }}" class="text-decoration-none d-xl-none"
                            style="text-decoration: none;">
                            <i class="fa-regular fa-bookmark fa-xl icon_size" style="color: #ef4444;"></i>
                            <span class="totalItemsCount total-count translate-middle d-xl-none"
                                style="position: absolute;top: 16px;right:5px">
                            </span>
                        </a>

                    </button> --}}
                    <button class="btn btn-button ps-0" style="border: none; position: relative;">
                        <a href="{{ route('cart.index') }}" class="text-decoration-none d-xl-none"
                            style="text-decoration: none;">
                            <i class="fa-regular fa-cart-shopping fa-xl icon_size " style="color: #ef4444;"></i>
                        </a>
                        <div class="dropdown-menu dropdown_cart custom-dropdown shadow-lg border-0"
                            style="left: 0%; top:35px; transform: translate(-60%, 0);">
                            <div class="dropdown_child p-2">
                                <div class="d-flex justify-content-start align-items-start mb-2">
                                    <a class="dropdown-item user_list" href="#" data-bs-toggle="modal"
                                        data-bs-target="#profileModal">
                                        <i class="user_list_icon fa-light fa-user"></i>
                                        &nbsp;&nbsp;&nbsp;Profile
                                    </a>
                                </div>
                                <div class="d-flex justify-content-start align-items-start mb-2">
                                    <a class="dropdown-item user_list" href="{{ url('orders') }}"><i
                                            class="user_list_icon fa-light fa-bags-shopping"></i>
                                        &nbsp;&nbsp;Orders</a>
                                </div>
                                <div class="d-flex justify-content-start align-items-start mb-2">
                                    <a class="dropdown-item user_list" href="{{ route('savelater.index') }}"><i
                                            class="user_list_icon fa-light fa-basket-shopping"></i>
                                        &nbsp;&nbsp;Buy later</a>
                                </div>
                                <div class="d-flex justify-content-start align-items-start mb-2">
                                    <a class="dropdown-item user_list" href="{{ url('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="user_list_icon fa-light fa-power-off"></i>
                                        &nbsp;&nbsp;&nbsp;Log Out</a>
                                </div>
                            </div>
                        </div>
                    </button>

                    &nbsp;&nbsp;&nbsp;
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarText">
                    <!-- Collapsed View (Small Screens) -->
                    <form action="{{ url('/search') }}" method="GET" class="mx-auto d-xl-none">
                        <ul class="navbar-nav pt-2" id="default-search">
                            <li class="nav-item mb-2">
                                <div class="input-wrapper w-100">
                                    <input type="text" name="q" placeholder="Search..."
                                        class="form-control address_input mx-1 search-input" style="padding-left: 40px !important"
                                        value="{{ request()->input('q') }}" />
                                    <i class="fa-solid fa-magnifying-glass icon-input" style="font-size: 20px"></i>
                                </div>
                            </li>
                        </ul>
                    </form>
                    <!-- Expanded View (Large Screens) -->
                    <div class="d-flex justify-content-between align-items-center">
                        <form action="{{ url('/search') }}" method="GET"
                            class="d-none d-xl-flex justify-content-center align-items-center pt-2">
                            <ul class="navbar-nav" id="default-search">
                                <li class="nav-item mb-2">
                                    <div class="input-wrapper">
                                        <input type="text" name="q" placeholder="Search..."
                                            class="form-control address_input me-2 search-input-large" style="padding-left: 40px !
                                            important"
                                            value="{{ request()->input('q') }}" />
                                        <i class="fa-solid fa-magnifying-glass icon-input"
                                            style="font-size: 20px"></i>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <button class="btn btn-button" style="border: none; position: relative;" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Bookmark" id="favbutton">
                        <i class="fa-regular fa-bookmark fa-xl icon_size" style="color: #ef4444;"></i>
                        <span class="totalItemsCount total-count translate-middle d-none d-xl-block"
                            style="position: absolute;top: 16px;">
                        </span>
                    </button>
                    <div class="dropdown d-none d-xl-inline">
                        <button class="btn btn-button ps-0" style="border: none; position: relative;" id="cartButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-cart-shopping fa-xl icon_size cart-screen" style="color: #ef4444;"></i>
                            <span id="cart-count" class="total-counts translate-middle d-xl-block"
                                style="position: absolute; top: 16px; right: 5px;">
                            </span>
                        </button>
                        <div class="dropdown_cart dropdown-menu shadow-lg" aria-labelledby="cartButton"
                            style="left: 0; transform: translate(-85%, 0);">
                            @include('nav.cartdropdown')
                        </div>
                    </div>
                    @auth
                    <div class="dropdown">
                        <a href="#" class="text-decoration-none" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="">
                                <i class="fa-regular fa-circle-user fa-xl icon_size" style="color: #ef4444;"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu user-dropdown_cart custom-dropdown shadow-lg border-0"
                            style="left: 45%; top:35px; transform: translate(-85%, 0);">
                            <div class="dropdown_child p-2">
                                <div class="d-flex justify-content-start align-items-start mb-2">
                                    <a class="dropdown-item user_list" href="#" data-bs-toggle="modal"
                                        data-bs-target="#profileModal">
                                        <i class="user_list_icon fa-light fa-user"></i>
                                        &nbsp;&nbsp;&nbsp;Profile
                                    </a>
                                </div>
                                <div class="d-flex justify-content-start align-items-start mb-2">
                                    <a class="dropdown-item user_list" href="{{ url('orders') }}"><i
                                            class="user_list_icon fa-light fa-bags-shopping"></i>
                                        &nbsp;&nbsp;Orders</a>
                                </div>
                                <div class="d-flex justify-content-start align-items-start mb-2">
                                    <a class="dropdown-item user_list" href="{{ route('savelater.index') }}"><i
                                            class="user_list_icon fa-light fa-basket-shopping"></i>
                                        &nbsp;&nbsp;Buy later</a>
                                </div>
                                <div class="d-flex justify-content-start align-items-start mb-2">
                                    <a class="dropdown-item user_list" href="{{ url('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="user_list_icon fa-light fa-power-off"></i>
                                        &nbsp;&nbsp;&nbsp;Log Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden logout form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{ url('login') }}" class="text-decoration-none">
                        <span class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Login">
                            <i class="fa-regular fa-circle-user fa-xl icon_size text-muted"></i>
                        </span>
                    </a>
                    @endauth
                    <span class="navbar-text align-items-center justify-content-end"
                        style="margin-left: 10px">
                        <a href=""https://dealslah.com/dealslahVendor/" style="text-decoration: none">
                            <button
                                class="btn btn-button mt-2 login-button userlogin-button-large py-2 px-4 d-flex justify-content-center align-items-center text-nowrap"
                                type="submit">
                                Post your Deal
                            </button>
                        </a>
                    </span>
                    &nbsp;&nbsp;
                </div>
            </div>
        </nav>

        <!-- Modal inside the Dropdown -->
        <div class="dropdown">
            <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card" style="border: none">
                                <div class="d-flex align-items-center">
                                    <div class="col-2">
                                        <img src="{{ asset('assets/images/home/user.jpg') }}" alt="Profile Picture"
                                            width="50" height="50" class="rounded-circle" />
                                    </div>
                                    <div class="col-4 text-start">
                                        <h6 class="mt-2">{{ $user->name ?? '' }}</h6>
                                    </div>
                                    {{-- <div class="col-4 text-end">
                                        <button type="button" class="badge_edit text-end" data-bs-toggle="modal"
                                            data-bs-target="#editProfileModal">
                                            Edit
                                        </button>
                                    </div> --}}
                                </div>
                                <hr />
                                <p><strong>Email :</strong> {{ $user->email ?? '' }}</p>
                                <p><strong>Phone :</strong>
                                    {{ $default_address && $default_address->phone ? '(+65) ' . $default_address->phone : '--' }}
                                </p>
                                <hr />
                                <div class="d-flex justify-content-between align-items-center defaultAddress">
                                    <h6 class="fw-bold">Delivery Addresses</h6>
                                    @if ($default_address)
                                    <span class="badge badge_infos py-1" data-bs-toggle="modal"
                                        data-bs-target="#myAddressModal">Change</span>
                                    @else
                                    <button type="button" class="btn primary_new_btn" style="font-size: 12px"
                                        data-bs-toggle="modal" data-bs-target="#newAddressModal"
                                        onclick="checkAddressAndOpenModal()">
                                        <i class="fa-light fa-plus"></i> Add New Address
                                    </button>
                                    @endif
                                </div>
                                <div class="mt-2">
                                    <div class="selected-address">
                                        @if ($default_address)
                                        <p>
                                            <strong>{{ $default_address->first_name ?? '' }}
                                                {{ $default_address->last_name ?? '' }} (+65)
                                                {{ $default_address->phone ?? '' }}</strong>&nbsp;&nbsp;<br>
                                            {{ $default_address->address ?? '' }},
                                            {{ $default_address->city ?? '' }},
                                            {{ $default_address->state ?? '' }} -
                                            {{ $default_address->postalcode ?? '' }}
                                            <span>
                                                @if ($default_address->default)
                                                <span
                                                    class="badge badge_danger py-1">Default</span>&nbsp;&nbsp;
                                                @endif
                                            </span>
                                        </p>
                                        @else
                                        <p>Your address details are missing. Add one now to make checkout faster
                                            and easier!</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Address Modal -->
        <div class="modal fade" id="myAddressModal" tabindex="-1" aria-labelledby="myAddressModalLabel"
            aria-hidden="true">
            <form id="addressForm" action="{{ route('address.change') }}" method="POST">
                @csrf
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myAddressModalLabel">My Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="min-height: 24rem">
                            <div class="allAddress">
                                @foreach ($addresses as $addr)
                                <div class="row p-2">
                                    <div class="col-10">
                                        <div class="d-flex text-start">
                                            <div class="px-1">
                                                <input type="radio" name="selected_id"
                                                    id="selected_id_{{ $addr->id }}"
                                                    value="{{ $addr->id }}"
                                                    {{ $selectedAddressId == $addr->id ? 'checked' : ($default_address && $addr->id == $default_address->id && !$selectedAddressId ? 'checked' : '') }} />
                                            </div>
                                            <p class="text-turncate fs_common">
                                                <span class="px-2">
                                                    {{ $addr->first_name }} {{ $addr->last_name ?? '' }} |
                                                    <span style="color: #c7c7c7;">&nbsp;+65
                                                        {{ $addr->phone }}</span>
                                                </span><br>
                                                <span class="px-2" style="color: #c7c7c7">{{ $addr->address }},
                                                    {{ $addr->city }},
                                                    {{ $addr->state }}-{{ $addr->postalcode }}.</span>
                                                <br>
                                                @if ($addr->default)
                                                <span class="badge badge_primary">Default</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <div class="d-flex gap-2 delBadge">
                                                <button type="button" class="badge_edit" data-bs-toggle="modal"
                                                    data-address-id="{{ $addr->id }}"
                                                    data-bs-target="#editAddressModal">
                                                    Edit
                                                </button>
                                                @if (!$addr->default)
                                                <button type="button" class="badge_del"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteAddressModal"
                                                    data-address-id="{{ $addr->id }}">
                                                    Delete
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn primary_new_btn" style="font-size: 12px"
                                data-bs-toggle="modal" data-bs-target="#newAddressModal"
                                onclick="checkAddressAndOpenModal()">
                                <i class="fa-light fa-plus"></i> Add New Address
                            </button>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn outline_secondary_btn"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn outline_primary_btn"
                                    id="confirmAddressBtn">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Delete Address Modal -->
        <div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAddressModalLabel">Delete Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this address?</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn outline_secondary_btn"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn outline_primary_btn" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Address Modal -->
        <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAddressModalLabel">Change Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Address Form -->
                        <form id="addressEditForm" action="{{ route('address.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="address_id" name="address_id">
                            <div class="row">
                                <!-- First Name -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="first_name" class="form-label address_lable">First Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="first_name"
                                        id="first_name" placeholder="Enter your first name" required />
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="last_name" class="form-label address_lable">Last Name
                                        (Optional)</label>
                                    <input type="text" class="form-control address_input" name="last_name"
                                        id="last_name" placeholder="Enter your last name" />
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="phone" class="form-label address_lable">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="phone"
                                        id="phone" placeholder="Enter your phone number" required />
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="email" class="form-label address_lable">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control address_input" name="email"
                                        id="email" placeholder="Enter your email" required />
                                </div>

                                <!-- Address -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="address" class="form-label address_lable">Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="address"
                                        id="address" placeholder="Enter your Address" required />
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="state" class="form-label address_lable">State <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="state"
                                        id="state" placeholder="Enter your state" required />
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="city" class="form-label address_lable">City <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="city"
                                        id="city" placeholder="Enter your city" required />
                                </div>

                                <!-- Postal Code -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="postalcode" class="form-label address_lable">Postal Code <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="postalcode"
                                        id="postalcode" placeholder="Enter your Postal Code" required />
                                </div>

                                <!-- Unit (Optional) -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="unit" class="form-label address_lable">Unit Info
                                        (Optional)</label>
                                    <input type="text" class="form-control address_input" name="unit"
                                        id="unit" placeholder="Landmark" />
                                </div>

                                <!-- Address Type -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label address_lable">Address Type <span
                                            class="text-danger">*</span></label>
                                    <div class="d-flex gap-3">
                                        <div>
                                            <input type="radio" name="type" id="home_mode" value="home_mode"
                                                class="form-check-input" required>
                                            <label for="home_mode">Home</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="type" id="work_mode" value="work_mode"
                                                class="form-check-input" required>
                                            <label for="work_mode">Work</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 address">
                                    <input type="checkbox" name="default" class="default_address"
                                        id="default_address">
                                    <label class="form-check-label" for="default_address">Set as Default
                                        Address</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    data-bs-toggle="modal" data-bs-target="#myAddressModal">Back</button>
                                <button type="submit" class="btn btn-sm outline_primary_btn">Save Address</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        {{-- <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="profileFormModal" action="{{ route('user.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 col-12 mb-3">
                <label for="name" class="form-label address_lable">Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control address_input" name="name"
                    id="name" placeholder="Enter your name" value="{{ $user->name ?? '' }}"
                    required />
            </div>

            <div class="col-md-6 col-12 mb-3">
                <label for="email" class="form-label address_lable">Email <span
                        class="text-danger">*</span></label>
                <input type="email" class="form-control address_input" name="email"
                    id="email" placeholder="Enter your email"
                    value="{{ $user->email ?? '' }}" />
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn outline_primary_btn">Save
                Changes</button>
        </div>
        </form>
        </div>

        </div>
        </div>
        </div> --}}

        <!-- New Address Modal -->
        <div class="modal fade" id="newAddressModal" tabindex="-1" aria-labelledby="newAddressModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newAddressModalLabel">Add New Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Address Form -->
                        <form id="addressNewForm" action="{{ route('address.create') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- First Name -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="first_name" class="form-label address_lable">First Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="first_name"
                                        id="first_name" placeholder="Enter your first name" required />
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="last_name" class="form-label  address_lable">Last Name
                                        (Optional)</label>
                                    <input type="text" class="form-control address_input" name="last_name"
                                        id="last_name" placeholder="Enter your last name" />
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="phone" class="form-label address_lable">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="phone"
                                        id="phone" placeholder="Enter your phone number" required />
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="email" class="form-label address_lable">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control address_input" name="email"
                                        id="email" placeholder="Enter your email" required />
                                </div>

                                <!-- Address -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="address" class="form-label address_lable">Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="address"
                                        id="address" placeholder="Enter your Address" required />
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="state" class="form-label address_lable">State <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="state"
                                        id="state" placeholder="Enter your state" required />
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="city" class="form-label address_lable">City <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="city"
                                        id="city" placeholder="Enter your city" required />
                                </div>

                                <!-- Postal Code -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="postalcode" class="form-label address_lable">Postal Code <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control address_input" name="postalcode"
                                        id="postalcode" placeholder="Enter your Postal Code" required />
                                </div>

                                <!-- Unit (Optional) -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="unit" class="form-label address_lable">Additional Info
                                        (Optional)</label>
                                    <input type="text" class="form-control address_input" name="unit"
                                        id="unit" placeholder="Landmark" />
                                </div>

                                <!-- Address Type -->
                                <div class="col-md-6 col-12 mb-3">
                                    <label class="form-label address_lable">Address Type <span
                                            class="text-danger">*</span></label>
                                    <div class="d-flex gap-3">
                                        <div>
                                            <input type="radio" name="type" id="home_mode" value="home_mode"
                                                class="form-check-input" required>
                                            <label for="home_mode">Home</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="type" id="work_mode" value="work_mode"
                                                class="form-check-input" required>
                                            <label for="work_mode">Work</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 address">
                                    <input type="checkbox" name="default" class="default_address"
                                        id="defaultAddressCheckbox">
                                    <label class="form-check-label" for="defaultAddressCheckbox">Set as Default
                                        Address</label>
                                </div>

                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    data-bs-toggle="modal" data-bs-target="#myAddressModal">Back</button>
                                <button type="submit" class="btn btn-sm outline_primary_btn">Save Address</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Header End  -->
