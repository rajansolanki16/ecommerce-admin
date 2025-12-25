<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $meta['title'] ?? "Knoght Oasis" }}</title>
    <meta property="og:title" content="{{ $meta['title'] ?? "Knoght Oasis" }}">
    <meta name="twitter:title" content="{{ $meta['title'] ?? "Knoght Oasis" }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $meta['description'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    
    <link rel="shortcut icon" href="{{ publicPath(getSetting("site_icon")) }}">
    <meta property="og:image" content="{{ publicPath(getSetting("site_icon")) }}">
    <meta name="twitter:image" content="{{ publicPath(getSetting("site_icon")) }}">
    <meta name="twitter:card" content="{{ publicPath(getSetting("site_icon")) }}">
    
    @if(isset($meta['sco-allow']) && $meta['sco-allow'] == false)
        <meta name="robots" content="noindex, nofollow">
    @else
        <link rel="canonical" href="{{ url()->current() }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    @endif

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="renderer" content="webkit">
    {{-- {!!getSetting('page_custom_script_header') !!} --}}
    <link rel="stylesheet" href="{{ publicPath('assets/css/custom-style.css') }}?version={{ rand(10,99) }}.{{ rand(10,99) }}.{{ rand(100,999) }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Marcellus&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">



</head>

<body>
