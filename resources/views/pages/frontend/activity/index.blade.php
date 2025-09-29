@extends('layouts.app-frontend')
  @section('content')

    @include('pages.frontend.activity.components.top')

    @include('pages.frontend.activity.components.form')

    @include('pages.frontend.activity.components.reward')

    @include('pages.frontend.activity.components.list-point')

  @endsection
