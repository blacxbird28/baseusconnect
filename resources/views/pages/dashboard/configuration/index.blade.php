@extends('layouts.app-dashboard')

@section('content')

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <h2 class="text-white mb-5">Configuration</h2>

        <div class="row">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0">
                @if(session('status'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text text-white"><strong>{{ session('status') }}</strong></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif

              </div>

              <div class="card-body pt-0 pb-2">
                <div class="row">
                  <div class="col-md-12">

                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true">General</button>
                      <button class="nav-link" id="nav-email-tab" data-bs-toggle="tab" data-bs-target="#nav-email" type="button" role="tab" aria-controls="nav-sosmed" aria-selected="false">Email</button>
                      <button class="nav-link" id="nav-sosmed-tab" data-bs-toggle="tab" data-bs-target="#nav-sosmed" type="button" role="tab" aria-controls="nav-sosmed" aria-selected="false">Social Media</button>
                      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact Us</button>
                    </div>
                  </nav>
                  <div class="tab-content py-3 px-2" id="nav-tabContent">

                      <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">

                        <form action="{{ route('configuration.update', ['config' => $config->id]) }}" method="post" enctype="multipart/form-data">
                          {{ method_field('PUT') }}

                          {{ csrf_field() }}
                          <div class="mb-3">
                            <label class="form-label text-sm" for="mail_content">Company Name</label>
                            <input type="text" class="form-control" name="name" value="{{$config->name}}">

                            @error('name')
                              <div class="alert alert-danger error text-white text-sm p-2 mt-2">{{ $message }}</div>
                            @enderror
                          </div>

                          <button type="submit" class="btn btn-primary">
                            <span class="btn-inner--text">Submit</span>
                          </button>
                        </form>

                      </div>

                      <div class="tab-pane fade" id="nav-email" role="tabpanel" aria-labelledby="nav-email-tab">

                        <form action="{{ route('configuration.update', ['config' => $config->id]) }}" method="post" enctype="multipart/form-data">
                          {{ method_field('PUT') }}

                          {{ csrf_field() }}
                          <div class="mb-3">
                            <label class="form-label text-sm" for="mail_content">Email template</label>
                            <textarea class="form-control" id="mail_content" type="text" name="mail_content">{{$config->mail_content}}</textarea>

                            @error('mail_content')
                              <div class="alert alert-danger error text-white text-sm p-2 mt-2">{{ $message }}</div>
                            @enderror
                          </div>

                          <button type="submit" class="btn btn-primary">
                            <span class="btn-inner--text">Submit</span>
                          </button>
                        </form>

                        <form action="{{ route('configuration.send-email') }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="mb-3">
                            <label class="form-label text-sm" for="mail_content">Send Registration Email</label>
                            <input type="text" class="form-control" name="email" placeholder="ex: john@example.com">

                            @error('email')
                              <div class="alert alert-danger error text-white text-sm p-2 mt-2">{{ $message }}</div>
                            @enderror
                          </div>

                          <button type="submit" class="btn btn-primary">
                            <span class="btn-inner--text">Submit</span>
                          </button>
                        </form>
                      </div>

                      <div class="tab-pane fade" id="nav-sosmed" role="tabpanel" aria-labelledby="nav-sosmed-tab">

                        <form action="{{ route('configuration.update', ['config' => $config->id]) }}" method="post" enctype="multipart/form-data">
                          {{ method_field('PUT') }}

                          {{ csrf_field() }}
                          <div class="mb-3">
                            <label class="form-label text-sm" for="mail_content">Facebook</label>
                            <input type="text" class="form-control" name="facebook" value="{{$config->facebook}}">

                            @error('facebook')
                              <div class="alert alert-danger error text-white text-sm p-2 mt-2">{{ $message }}</div>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label class="form-label text-sm" for="mail_content">Instagram</label>
                            <input type="text" class="form-control" name="instagram" value="{{$config->instagram}}">

                            @error('instagram')
                              <div class="alert alert-danger error text-white text-sm p-2 mt-2">{{ $message }}</div>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label class="form-label text-sm" for="mail_content">Tiktok</label>
                            <input type="text" class="form-control" name="tiktok" value="{{$config->tiktok}}">

                            @error('tiktok')
                              <div class="alert alert-danger error text-white text-sm p-2 mt-2">{{ $message }}</div>
                            @enderror
                          </div>
                          <button type="submit" class="btn btn-primary">
                            <span class="btn-inner--text">Submit</span>
                          </button>
                        </form>

                      </div>

                      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">Contact us content</div>
                  </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>
</div>

@endsection
