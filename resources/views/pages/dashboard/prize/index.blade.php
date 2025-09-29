@extends('layouts.app-dashboard')

@section('content')

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <h2 class="text-white mb-5">Prize</h2>

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

          @include('pages.dashboard.prize.filter')
        </div>

        <div class="card-body pt-0 pb-2">
          <div class="row">
            <div class="col-md-12">

            </div>
          </div>

          <div class="table-responsive overflow-x py-3">

            <table class="table align-items-center mb-0" id="prize-table">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Point</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Images</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">Status</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center" width="20%">Action</th>
                </tr>
              </thead>

              <tbody></tbody>

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
      var table = jQuery('#prize-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false, // Disable default search box
        ajax: {
          "url": '{{ route('dashboard.prize.get-data') }}', // The URL for the data
          "dataSrc": 'data',
          "data": function (d) {
            d.search_value = $('#custom_search').val(); // Pass custom search input value
            d.start_date = $('#start_date').val();
            d.end_date = $('#end_date').val();
          }
        },
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'name', name: 'name' },
          { data: 'point', name: 'point' },
          { data: "images",
              render: function(data, type, row) {
                  // If image URL is available, return the image HTML
                  return '<a href="{{asset("content_file_upload/prizes")}}' + '/' + data + '" target="_blank"> <img src="{{asset("content_file_upload/prizes")}}' + '/' + data + '" width="50" height="50" style="object-fit: cover;" alt="Prize" class="text-center"> </a>';
              }
          },
          { data: 'status', name: 'status', class: 'text-center' },
          { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center' },
        ]
      });

      jQuery('body').on('keyup', '#custom_search', function (e) {
        table.draw();
      });
    });

  </script>
@endsection
