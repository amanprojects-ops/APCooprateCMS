@extends('errors.layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', $exception->getMessage() ?: __('Our servers are temporarily down for scheduled maintenance or upgrades. We will be back online shortly.'))
