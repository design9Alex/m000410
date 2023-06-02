<?php
/**
 * @var array $seo
 */
?>

@extends('MinmaxBase::web.layouts.site')

@section('site-content')
<div id="home" class="flex-center position-ref full-height">
  <div class="content">
    <h1 class="title">Hi!</h1>
    <div>Here is a demo home page via {{ config('app.author_en') }} system.</div>
  </div>
</div>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<style>
html, body {
  background-color: #fff;
  color: #636b6f;
  font-family: 'Raleway', sans-serif;
  font-weight: 100;
  height: 100vh;
  margin: 0;
}
#home { height: 100vh; display: flex; align-items: center; justify-content: center; position: relative; }
#home .content { text-align: center; font-size: 36px; }
#home .title { font-size: 56px; padding: 20px; }
</style>
@endpush
