@extends('errors.layout')

@section('title', __('Unauthorized Access'))
@section('code', '401')
@section('message', $exception->getMessage() ?: __('You are not authorized to view this resource. Please sign in with valid credentials to gain access.'))
