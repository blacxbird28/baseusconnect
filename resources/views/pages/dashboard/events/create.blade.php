@extends('layouts.app-dashboard')

@section('content')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center mb-3">
              <a href="{{ route('dashboard.event.index') }}" class="btn btn-icon btn-3 btn-primary me-3 mb-0">Back</a>
              <h5 class="font-weight-bolder text-info text-gradient mb-0">Add New Event</h5>
            </div>
          </div>

          <div class="card-body px-0 pt-0 pb-2">
            <div class="container">
              <form action="{{ route('dashboard.event.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                @include('pages.dashboard.events.form')

                <button type="submit" class="btn btn-primary">
                  <span class="btn-inner--text">Submit</span>
                </button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
