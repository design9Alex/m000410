@extends('MinmaxBase::admin.layouts.errors.illustrated')

@section('title', __('MinmaxBase::admin.errors.503.title'))
@section('code', __('MinmaxBase::admin.errors.503.code'))

@if(is_null($exception->getMessage()) || $exception->getMessage() === '')
  @section('message', __('MinmaxBase::admin.errors.503.message'))
@else
  @section('message', $exception->getMessage())
@endif
