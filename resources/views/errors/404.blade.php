@extends('errors.layout')

@section('title', __('Page Not Found'))
@section('code', '404')
@section('message', $exception->getMessage() ?: __('The page you are looking for does not exist, has been removed, or is temporarily unavailable.'))
