{{ csrf_field() }}
<div class="row">
  <div class="col-md-12">

    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="name">Name</label>
          <input class="form-control" id="name" type="text" name="name" value="{{ old('name', isset($members) ? $members->name : '') }}">

          @error('name')
            <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="email">Email</label>
          <input class="form-control" id="email" type="text" name="email" value="{{ old('email', isset($members) ? $members->email : '') }}">

          @error('email')
            <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="password">Password</label>
          <input class="form-control" id="password" type="password" name="password">

          @error('password')
            <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="no_ktp">No KTP</label>
          <input class="form-control" id="no_ktp" type="text" name="no_ktp" value="{{ old('no_ktp', isset($members) ? $members->no_ktp : '') }}">

          @error('no_ktp')
            <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="domisili">Domisili</label>
          <input class="form-control" id="domisili" type="text" name="domisili" value="{{ old('domisili', isset($members) ? $members->domisili : '') }}">

          @error('domisili')
            <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="alamat">Alamat</label>
          <input class="form-control" id="alamat" type="text" name="alamat" value="{{ old('alamat', isset($members) ? $members->alamat : '') }}">

          @error('alamat')
            <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="phone">No HP</label>
          <input class="form-control" id="phone" type="text" name="phone" value="{{ old('phone', isset($members) ? $members->phone : '') }}">

          @error('phone')
            <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="phone">Role</label><br />
          <select id="role" name="role" class="form-select">
            @foreach($roles as $item)
              <option value="{{ $item }}" @if($selectedRoles ==  $item) selected  @endif>{{ ucfirst($item) }} </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="group">Group</label>
          <select id="group" name="group" class="form-select">
            @foreach($group as $item)
              <option value="{{ $item }}" @if($selectedGroup ==  $item) selected  @endif>{{ ucfirst($item) }} </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="instagram">Instagram</label>
          <input class="form-control" id="instagram" type="text" name="instagram" value="{{ old('instagram', isset($members) ? $members->instagram : '') }}">
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="tiktok">Tiktok</label>
          <input class="form-control" id="tiktok" type="text" name="tiktok" value="{{ old('tiktok', isset($members) ? $members->tiktok : '') }}">
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="facebook">Facebook</label>
          <input class="form-control" id="facebook" type="text" name="facebook" value="{{ old('facebook', isset($members) ? $members->facebook : '') }}">
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="twitter">Twitter</label>
          <input class="form-control" id="twitter" type="text" name="twitter" value="{{ old('twitter', isset($members) ? $members->twitter : '') }}">
        </div>
      </div>

      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label text-sm" for="profile_pic">Profile Picture</label><br />
          <img src="{{ asset('profile_picture/'.$members->profile_pic) }}" alt="" width="100px" class="mb-2">
          <input class="form-control" id="profile_pic" type="file" name="profile_pic" value="{{ old('profile_pic', isset($members) ? $members->profile_pic : '') }}">

          @error('profile_pic')
            <div class="alert alert-danger error text-white text-xs p-2 mt-2">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
  </div>
</div>
