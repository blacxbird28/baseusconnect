<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="name">Name</label>
      <input class="form-control" id="name" type="text" name="name" value="{{$community->name}}">

      @error('name')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="description">Description</label>
      <input class="form-control" id="description" type="text" name="description" value="{{$community->description}}">

      @error('description')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="location">Location</label>

      <input class="form-control" type="text" name="location" value="{{$community->location}}">
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="status">Status</label>
      <select name="status" id="status" class="form-select">
        <option value="1">Active</option>
        <option value="0">Not Active</option>
      </select>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="images">Images</label>
      @if ($id != null)
      <br />
      @endif
      <img src="{{asset('content_file_upload/community/'.$community->images)}}" alt="" width="100px" class="mb-2">
      <input class="form-control" id="images" type="file" name="images" value="{{$community->images}}">

      @error('images')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
