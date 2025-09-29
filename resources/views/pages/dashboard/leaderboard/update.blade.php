@extends('layouts.app-dashboard')

@section('content')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row justify-content-between">
              <div class="col-md-6">
                <h5 class="font-weight-bolder text-info text-gradient">Update Post</h5>
              </div>
            </div>
          </div>

          <div class="card-body px-0 pt-0 pb-2">
            <div class="container">
              <form action="{{ route('dashboard.posts.update', ['id' => $post['id']]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                @include('pages.dashboard.posts.form')

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
