@extends('layouts.app-frontend')
  @section('content')

    @include('pages.frontend.news.components.detail-hero-banner')

    @include('pages.frontend.news.components.detail-content')

    @include('pages.frontend.news.components.detail-other-news')
  @endsection
