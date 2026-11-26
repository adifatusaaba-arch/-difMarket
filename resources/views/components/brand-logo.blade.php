@props([
    'dark' => false,
    'size' => 'md',
])

@php
    $iconClass = $size === 'lg' ? 'w-11 h-11' : 'w-9 h-9';
    $textClass = $size === 'lg' ? 'text-2xl' : 'text-xl';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 select-none']) }}>
    <svg class="{{ $iconClass }} shrink-0" viewBox="0 0 64 64" fill="none" aria-hidden="true">
        <rect width="64" height="64" rx="18" fill="#6C4AB6"/>
        <path d="M21 24C21 17.9249 25.9249 13 32 13C38.0751 13 43 17.9249 43 24" stroke="#FFFFFF" stroke-width="4" stroke-linecap="round"/>
        <rect x="15" y="22" width="34" height="29" rx="9" fill="#FFFFFF"/>
        <circle cx="32" cy="36.5" r="7.5" stroke="#6C4AB6" stroke-width="3.5"/>
        <circle cx="48" cy="18" r="6" fill="#FF9F43"/>
    </svg>
    <span class="font-extrabold tracking-tight {{ $textClass }} {{ $dark ? 'text-white' : 'text-[#20243A]' }}">
        <span class="text-[#FF9F43]">@</span>dif<span class="{{ $dark ? 'text-purple-200' : 'text-[#6C4AB6]' }}">Market</span>
    </span>
</span>
