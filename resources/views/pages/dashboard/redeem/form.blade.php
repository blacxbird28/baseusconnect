<div class="row">
  <div class="col-md-12">
    <div class="mb-3">
      <label class="form-label text-sm" for="title">Title</label>
      <input class="form-control" id="title" type="text" name="title" value="{{$post->title}}">

      @error('title')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="col-md-12">
    <div class="mb-3">
      <label class="form-label text-sm" for="short_description">Short Description</label>
      <input class="form-control" id="short_description" type="text" name="short_description" value="{{$post->short_description}}">

      @error('short_description')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="col-md-12">
    <div class="mb-3">
      <label class="form-label text-sm" for="content">Content</label>
      <textarea class="form-control" id="content" name="content">{{$post->content}}</textarea>

      @error('content')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>


  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="platform">Platform</label>
      <select name="platform" id="platform" class="form-select">
        <option value="Tiktok">Tiktok</option>
        <option value="Instagram">Instagram</option>
        <option value="Twitter">Twitter</option>
        <option value="Facebook">Facebook</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="url">URL</label>
      <input class="form-control" id="url" type="text" name="url" value="{{$post->url}}">

      @error('url')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="images">Screenshot</label><br />
      <img src="{{asset('content_file_upload/screenshots/'.$post->images)}}" alt="" width="100px" class="mb-2">
      <input class="form-control" id="images" type="file" name="images" value="{{$post->images}}">

      @error('images')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
