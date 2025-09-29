@extends('layouts.app-dashboard')

@section('content')

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <h2 class="text-white mb-5">Leaderboard</h2>

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

          @include('pages.dashboard.leaderboard.filter')
        </div>

        <div class="card-body pt-0 pb-2">
          <div class="row">
            <div class="col-md-12">

            </div>
          </div>

          <div class="table-responsive overflow-x py-3">

            <table class="table align-items-center mb-0" id="leaderboard-table">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Email</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Group</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Point</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
              </tbody>

            </table>
            <br />

            <div class="container">
              <div class="row">
                <div class="col-12">

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

@section('customscript')
  <script>
    jQuery(document).ready(function() {
        var table = jQuery('#leaderboard-table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false, // 👈 disables the pagination dropdown
            paging: false,
            dom: 'Bfrtip', // Adds button container
            buttons: [
            {
                extend: 'excelHtml5',
                title: 'Leaderboard_Export - '+'{{date("Y-m-d H:i:s")}}',
                text: 'Download Excel',
                className: 'btn btn-success btn-sm mb-3',
            }
            ],
            ajax: {
                "url": '{{ route('leaderboard.data') }}', // The URL for the data
                "dataSrc": 'data',
                "data": function (d) {
                    d.search_value = $('#custom_search').val();
                    d.search_group = $('#search_group').val(); // Pass custom search input value
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'profile_with_name', name: 'name' }, // We use 'name' for searching/sorting
                { data: 'email', name: 'email' },
                { data: 'group', name: 'group' },
                { data: 'point', name: 'point' },
            ]
        });

        jQuery('body').on('click', '#reset', function() {
            jQuery('#search_group').val('all');
            jQuery('#custom_search').val('');
            table.draw();
        }).on('keyup', '#custom_search', function (e) {
            table.draw();
        }).on('change', '#search_group', function (e) {
            table.draw();
        });
    });
  </script>
@endsection
