<?php
/**
 * Page wrap: web-default
 *
 * @var array $wrapParameters
 * @var array $seo
 */

/** @var \Minmax\Base\Models\SystemMenu[]|\Illuminate\Database\Eloquent\Collection $headerMenus */
$headerMenus = optional(optional(optional(array_get($wrapParameters, 'systemMenus'))
    ->firstWhere('code', 'web-header'))->systemMenus)->sortBy('sort') ?? collect();

$newsCategories = array_get($wrapParameters, 'newsCategories')->sortBy('sort') ?? collect();
$productsCategories = array_get($wrapParameters, 'productsCategories')->sortBy('sort') ?? collect();


/** @var \Minmax\Base\Models\SystemMenu[]|\Illuminate\Database\Eloquent\Collection $footerMenus */
$footerMenus = optional(optional(optional(array_get($wrapParameters, 'systemMenus'))
    ->firstWhere('code', 'web-footer'))->systemMenus)->sortBy('sort') ?? collect();


switch(request()->route()->getName()){
  default: $wpClass = ''; break;
  case 'web.page.web-about': $wpClass = 'infoBox'; break;
  case 'web.page.web-about-president': $wpClass = 'presdtBox'; break;
  case 'web.page.web-about-history': $wpClass = 'historyBox jsHistoryBox'; break;
  case 'web.page.web-about-organization': $wpClass = 'ognztBox'; break;
  case 'web.page.web-about-management': $wpClass = 'mngmtBox'; break;
  case 'web.page.web-about-vision': $wpClass = 'visionBox'; break;
  case 'web.page.web-about-awards': $wpClass = 'awardsBox'; break;
  case 'web.page.web-about-relationship': $wpClass = 'reltBox'; break;
  case 'web.page.web-about-location': $wpClass = 'locationBox'; break;
  case 'web.page.web-news': $wpClass = 'newsBox'; break;
  case 'web.page.web-news-post': $wpClass = 'newsdtlBox nd1'; break;
}
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  @include('web.layouts.partials.html-head')

  {!! webData('custom_head') !!}
</head>

<body class="{{ $wpClass ?? '' }}">
{!! webData('custom_body') !!}

@include('web.layouts.partials.header')

@yield('site-content')

@include('web.layouts.partials.footer')

@include('web.layouts.partials.plugins')
</body>

</html>
