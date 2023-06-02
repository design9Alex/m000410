@extends('MinmaxBase::admin.layouts.errors.illustrated')

@section('title', __('MinmaxBase::admin.errors.404.title'))
@section('code', __('MinmaxBase::admin.errors.404.code'))

@if(is_null($exception->getMessage()) || $exception->getMessage() === '')
  @section('message', __('MinmaxBase::admin.errors.404.message'))
@else
  @section('message', $exception->getMessage())
@endif
