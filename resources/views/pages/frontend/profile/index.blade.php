@extends('layouts.app-frontend')
  @section('content')

    @include('pages.frontend.profile.components.top')

    @include('pages.frontend.profile.components.history')

    @include('pages.frontend.profile.components.list-point')

    @include('pages.frontend.profile.components.reward')
  @endsection
