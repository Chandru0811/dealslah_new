@php
    $icons = [
        ['class' => 'fa-laptop', 'primary_color' => '#ff0064', 'secondary_color' => '#ff0064'],
        ['class' => 'fa-utensils', 'primary_color' => '#ff5600', 'secondary_color' => '#ff5600'],
        ['class' => 'fa-lips', 'primary_color' => '#ff54c7', 'secondary_color' => '#ff54c7'],
        ['class' => 'fa-graduation-cap', 'primary_color' => '#2a85ff', 'secondary_color' => '#2a85ff'],
        ['class' => 'fa-shirt', 'primary_color' => '#ff6400', 'secondary_color' => '#ff6400'],
        ['class' => 'fa-dumbbell', 'primary_color' => '#ff2e78', 'secondary_color' => '#ff2e78'],
        ['class' => 'fa-ring', 'primary_color' => '#ffca4b', 'secondary_color' => '#ffe34b'],
        ['class' => 'fa-plane', 'primary_color' => '#00e888', 'secondary_color' => '#00e888'],
        ['class' => 'fa-truck', 'primary_color' => '#4ba4ff', 'secondary_color' => '#4ba4ff'],
        ['class' => 'fa-wrench', 'primary_color' => '#ff1300', 'secondary_color' => '#ff1300'],
    ];
@endphp

<div class="container pt-3 categorySection">
    <div class="row mx-lg-5 justify-content-center">
        @foreach ($categoryGroups as $index => $categoryGroup)
            @php
                // Get the icon based on the index, cycling back if there are more category groups than icons
                $icon = $icons[$index % count($icons)];
            @endphp
            <div class="col-custom d-flex flex-column align-items-center">
                <div class="nav-item dropdown">
                    <a class="nav-link categoryTitle dropdown-toggle" href="#"
                        id="categoryDropdown{{ $categoryGroup->id }}" role="button" style="cursor: default"
                        aria-expanded="false">
                        <div class="icons">
                            <i class="fa-duotone fa-solid {{ $icon['class'] }}"
                                style="--fa-primary-color: {{ $icon['primary_color'] }}; --fa-secondary-color: {{ $icon['secondary_color'] }};"></i>
                        </div>
                        {{ $categoryGroup->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown{{ $categoryGroup->id }}"
                        style="cursor: pointer;">
                        @foreach ($categoryGroup->categories as $category)
                            <li><a class="dropdown-item" href="{{ url('categories/' . $category->slug) }}">
                                    {{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
