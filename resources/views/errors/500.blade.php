@extends('errors.layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', $exception->getMessage() ?: __('Whoops! Something went wrong on our servers. We have been notified and are looking into it. Please try again later.'))
