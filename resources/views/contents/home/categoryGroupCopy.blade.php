<!-- resources/views/components/categoryDropdown.blade.php -->
<div class="container pt-3 categorySection" style="margin-top: 100px">
    <div class="row mx-lg-5 justify-content-center">
        @foreach ($categoryGroups as $categoryGroup)
            <div class="col-custom d-flex flex-column align-items-center">
                <div class="nav-item dropdown">
                    <a class="nav-link categoryTitle dropdown-toggle" href="#"
                        id="categoryDropdown{{ $categoryGroup->id }}" role="button"
                        aria-expanded="false" style="cursor: pointer;">
                        <div class="icons">
                            <i class="fa-duotone fa-solid fa-laptop"
                                style="--fa-primary-color: #ef4444; --fa-secondary-color: #ef4444;"></i>
                        </div>
                        {{ $categoryGroup->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown{{ $categoryGroup->id }}"
                        style="cursor: pointer;">
                        @foreach ($categoryGroup->categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ url('/products_listing', $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
