@extends('layouts.app-dashboard')

@section('content')

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <h2 class="text-white mb-5">Event</h2>

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
          <div id="status-message"></div>

          <div class="row justify-content-end">
            <div class="col-md-3">
              <div class="d-sm-flex justify-content-end">
                <a href="/dashboard/event/create" class="btn btn-icon btn-3 btn-primary mb-0">
                  <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                  <span class="btn-inner--text">Add new event</span>
                </a>
              </div>
            </div>
          </div>

          @include('pages.dashboard.events.filter')
        </div>

        <div class="card-body pt-0 pb-2">
          <div class="row">
            <div class="col-md-12">

            </div>
          </div>

          <div class="table-responsive overflow-x py-3">

            <table class="table align-items-center mb-0" id="event-table">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Title</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Location</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Date</th>
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
      var table = jQuery('#event-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false, // Disable default search box
        ajax: {
          "url": '{{ route('dashboard.event.get-data') }}', // The URL for the data
          "dataSrc": 'data',
          "data": function (d) {
            d.search_value = $('#custom_search').val(); // Pass custom search input value
            d.start_date = $('#start_date').val();
            d.end_date = $('#end_date').val();
          }
        },
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'title', name: 'title' },
          { data: 'location', name: 'location' },
          { data: 'date', name: 'date' },
          { data: "images",
              render: function(data, type, row) {
                  // If image URL is available, return the image HTML
                  return '<a href="{{asset("content_file_upload/events")}}' + '/' + data + '" target="_blank"> <img src="{{asset("content_file_upload/events")}}' + '/' + data + '" width="50" height="50" style="object-fit: cover;" alt="Screenshot" class="text-center"> </a>';
              }
          },
          { data: 'status', name: 'status' },
          { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
      });

      jQuery('body').on('click', '#reset', function() {
        jQuery('#start_date, #end_date, #custom_search').val('');
        table.draw();
      }).on('click', '#filter', function() {
        table.draw();
      }).on('keyup', '#custom_search', function (e) {
        table.draw();
      });

      $(document).on('click', '.deleteBtn', function () {
        var id = $(this).data("id");

        if (confirm("Are you sure you want to delete this post?")) {
            $.ajax({
                url: "/dashboard/event/delete/" + id,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#event-table').DataTable().ajax.reload();

                    // Show temporary success alert (like a flash message)
                    $('#status-message').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                                                '<span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>'+
                                                '<span class="alert-text text-white"><strong>' + response.message + '</strong></span>'+
                                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">'+
                                                    '<span aria-hidden="true">&times;</span>'+
                                                '</button>'+
                                              '</div>');

                    // Optionally fade it out after a few seconds
                    setTimeout(() => {
                      $('#status-message .alert').show();
                    }, 1000);
                },
                error: function () {
                    alert('Failed to delete.');
                }
            });
        }
      });
    });


  </script>
@endsection
