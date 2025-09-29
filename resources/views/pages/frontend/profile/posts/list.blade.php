<section>
  <header>
    <div class="row justify-content-between">
      <div class="col-md-6">
        <h2 class="text-lg font-medium text-gray-900 mb-2">{{ __('Your Posts') }}</h2>
      </div>
      <div class="col-md-3">
        <div class="flex justify-end">
          <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Add') }} {{$user['id']}}</a>
        </div>
      </div>
    </div>
  </header>

  <div class="table-responsive overflow-x py-4">
    <table class="table align-items-center mb-0" id="posts-table">
      <thead>
        <tr>
          <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No</th>
          <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Title</th>
          <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Description</th>
          <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Platform</th>
          <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Url</th>
          <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Screenshot</th>
          <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center" width="20%">Action</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </tbody>

    </table>
  </div>

</section>
