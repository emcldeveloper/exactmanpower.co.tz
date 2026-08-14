@php
    $seo = $seo ?? [];

    $title = $seo['title']
        ?? 'Exact Manpower Consulting Ltd';

    $description = $seo['description']
        ?? 'HR, recruitment and manpower services in Tanzania.';

    $canonical = $seo['canonical']
        ?? url()->current();

    $ogTitle = $seo['og_title']
        ?? $title;

    $ogDescription = $seo['og_description']
        ?? $description;

    $ogImage = $seo['og_image']
        ?? asset('images/seo/default.jpg');
@endphp

<title>{{ $title }}</title>

<meta
    name="description"
    content="{{ $description }}"
>

<meta
    name="robots"
    content="index, follow"
>

<link
    rel="canonical"
    href="{{ $canonical }}"
>

{{-- Open Graph --}}

<meta
    property="og:type"
    content="website"
>

<meta
    property="og:title"
    content="{{ $ogTitle }}"
>

<meta
    property="og:description"
    content="{{ $ogDescription }}"
>

<meta
    property="og:url"
    content="{{ $canonical }}"
>

<meta
    property="og:image"
    content="{{ $ogImage }}"
>

<meta
    property="og:site_name"
    content="Exact Manpower Consulting Ltd"
>

{{-- Twitter/X --}}

<meta
    name="twitter:card"
    content="summary_large_image"
>

<meta
    name="twitter:title"
    content="{{ $ogTitle }}"
>

<meta
    name="twitter:description"
    content="{{ $ogDescription }}"
>

<meta
    name="twitter:image"
    content="{{ $ogImage }}"
>

{{-- Schema.org --}}

@if (!empty($seo['schema']))

<script type="application/ld+json">
{!! json_encode(
    $seo['schema'],
    JSON_UNESCAPED_SLASHES |
    JSON_UNESCAPED_UNICODE |
    JSON_PRETTY_PRINT
) !!}
</script>

@endif