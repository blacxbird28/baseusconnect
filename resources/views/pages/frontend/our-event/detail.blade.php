@extends('layouts.app-frontend')
  @section('content')

    @include('pages.frontend.our-event.components.detail-hero-banner')

    @include('pages.frontend.our-event.components.detail-content')

    @include('pages.frontend.our-event.components.detail-other-events')
  @endsection
