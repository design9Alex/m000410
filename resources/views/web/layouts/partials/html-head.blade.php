<?php
/**
 * @var array $seo
 */
?>
<!-- Title and Meta
================================================== -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ array_get($seo, 'title') ?? webData('site_title') }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="description" content="{{ str_replace(PHP_EOL, ' ', array_get($seo, 'description') ?? webData('meta_description')) }}" />
<meta name="keywords" content="{{ str_replace(PHP_EOL, ',', array_get($seo, 'keywords') ?? webData('meta_keywords')) }}" />
<meta name="author" content="{{ array_get($seo, 'author') ?? config('app.author') }}" />

<!-- Facebook Open Graph Meta
================================================== -->
<meta property="og:locale" content="{{ str_replace('-', '_', app()->getLocale()) }}" />
<meta property="og:site_name" content="{{ webData('site_title') }}" />
<meta property="og:url" content="{{ request()->fullUrl() }}" />
<meta property="og:type" content="{{ array_get($seo, 'type', 'website') }}" />
<meta property="og:title" content="{{ array_get($seo, 'title') ?? webData('site_title') }}" />
<meta property="og:description" content="{{ str_replace(PHP_EOL, ' ', array_get($seo, 'description') ?? webData('meta_description')) }}" />
@if(filled(array_get($seo, 'image')))
  <meta property="og:image" content="{{ array_get($seo, 'image') }}" />
@endif

@if(filled(array_get($seo, 'video')))
  <meta property="og:video" content="{{ array_get($seo, 'video.url') }}" />
  <meta property="og:video:secure_url" content="{{ array_get($seo, 'video.secure_url', array_get($seo, 'video.url')) }}" />
  <meta property="og:video:type" content="{{ array_get($seo, 'video.type', 'video/mp4') }}" />
  <meta property="og:video:width" content="{{ array_get($seo, 'video.width') }}" />
  <meta property="og:video:height" content="{{ array_get($seo, 'video.height') }}" />
@endif

<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="format-detection" content="telephone=no">

<link rel="icon" type="image/x-icon" href="{{ asset('static/web/styles/images/web-icon.ico') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;700&family=Roboto&family=Noto+Serif+TC:wght@700&display=swap">

<link rel="stylesheet" type="text/css" href="{{ asset('static/web/styles/scss/plugins/aos.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('static/web/styles/style.css') }}">

@if(filled(array_get($seo, 'schema')))
  <script type="application/ld+json">
    @json(array_get($seo, 'schema'), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)
  </script>
@endif


<style>
  .contact__warn {
    width: calc(100% - 0px);
    padding: 10px 20px;
    border-radius: 5px;
    background: #fadcde;
    margin: 0 auto 20px auto;
    color: #782a2f;
  }

  .contact__success {
    width: calc(100% - 0px);
    padding: 10px 20px;
    border-radius: 5px;
    background: #d4edda;
    margin: 0 auto 20px auto;
    color: #155724;
  }

  .ignore{
    visibility: hidden;
  }
</style>
