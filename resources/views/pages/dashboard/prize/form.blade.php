<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="name">Name</label>
      <input class="form-control" id="name" type="text" name="name" value="{{$prize->name}}">

      @error('name')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="point">Point</label>
      <input class="form-control" id="point" type="text" name="point" value="{{$prize->point}}">

      @error('point')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
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
      <img src="{{asset('content_file_upload/prizes/'.$prize->images)}}" alt="" width="100px" class="mb-2">
      <input class="form-control" id="images" type="file" name="images" value="{{$prize->images}}">

      @error('images')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
