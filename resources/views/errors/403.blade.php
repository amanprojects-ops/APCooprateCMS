@extends('errors.layout')

@section('title', __('Access Forbidden'))
@section('code', '403')
@section('message', $exception->getMessage() ?: __('Sorry, you do not have permission to access this page. Please contact your system administrator if you believe this is an error.'))
