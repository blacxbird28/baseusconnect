<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="title">Title</label>
      <input class="form-control" id="title" type="text" name="title" value="{{ old('title', isset($event) ? $event->title : '') }}">

      @error('title')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="short_description">Sort Description</label>
      <input class="form-control" id="short_description" type="text" name="short_description" value="{{ old('short_description', isset($event) ? $event->short_description : '') }}">

      @error('short_description')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-10">
    <div class="mb-3">
      <label class="form-label text-sm" for="content">Content</label>
      <textarea class="form-control textarea" id="textarea" name="content" rows="10">{{ old('content', isset($event) ? $event->content : '') }}</textarea>
      @error('content')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="ad">Date</label>

      <input class="form-control datepicker" id="datepicker" type="text" name="date" value="{{ old('date', isset($event) ? $event->date : '') }}">
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="location">Location</label>
      <input class="form-control" id="location" type="text" name="location" value="{{ old('location', isset($event) ? $event->location : '') }}">

      @error('location')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="maps">Maps</label>
      <input class="form-control" id="maps" type="text" name="maps" value="{{ old('maps', isset($event) ? $event->maps : '') }}">

      @error('maps')
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
      <img src="{{asset('content_file_upload/events/'.$event->images)}}" alt="" width="100px" class="mb-2">
      <input class="form-control" id="images" type="file" name="images" value="{{$event->images}}">

      @error('images')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label class="form-label text-sm" for="drive_url">Drive URL</label>
      <input class="form-control" id="drive_url" type="text" name="drive_url" value="{{ old('drive_url', isset($event) ? $event->drive_url : '') }}">

      @error('drive_url')
        <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>
