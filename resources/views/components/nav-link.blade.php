@props(['active' => false])

<li class="nav-item {{ ($active) ? 'active' :  '' }}">
    <a {{ $attributes->merge(['class' => 'nav-link']) }}>
        {{ $slot }}
    </a>
</li>