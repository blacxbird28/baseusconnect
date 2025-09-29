@extends('layouts.app-dashboard')

@section('content')

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <h2 class="text-white mb-5">Activity Submit</h2>

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

          @include('pages.dashboard.activity-submit.filter')
        </div>

        <div class="card-body pt-0 pb-2">
          <div class="row">
            <div class="col-md-12">

            </div>
          </div>

          <div class="table-responsive overflow-x py-3">

            <table class="table align-items-center mb-0" id="activity-submit-table">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Title</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Email</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">Screenshot</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">Submit At</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">Status</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center" width="20%">Action</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
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
      var table = jQuery('#activity-submit-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false, // Disable default search box
        dom: 'Bfrtip', // Adds button container
        buttons: [
          {
            extend: 'excelHtml5',
            title: 'Activity_Submit_Export - '+'{{date("Y-m-d H:i:s")}}',
            text: 'Download Excel',
            className: 'btn btn-success btn-sm mb-3',
            exportOptions: {
              columns: [0, 1, 2, 4, 5] // column indexes to export
            }
          }
        ],
        ajax: {
          "url": '{{ route('dashboard.activity-submit.get-data') }}', // The URL for the data
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
          { data: 'email', name: 'email' },
          { data: "images",
              render: function(data, type, row) {
                  // If image URL is available, return the image HTML
                  return '<a href="{{asset("content_file_upload/activity")}}' + '/' + data + '" target="_blank"> <img src="{{asset("content_file_upload/activity")}}' + '/' + data + '" width="50" height="50" style="object-fit: cover;" alt="Screenshot" class="text-center"> </a>';
              }
          },
          { data: 'created_at', name: 'created_at' },
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

      // Toggle button click event
      jQuery('body').on('click', '.btn-validate', function() {
        var status = $(this).data('status'); // Toggle status
        var activitySubmitId = $(this).data('id');

        console.log(status, activitySubmitId);


        jQuery.ajax({
          url: '/dashboard/activity-submit/' + activitySubmitId + '/update-status',
          method: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            status: status,
          },
          success: function (response) {
            if (response.success) {
              alert(response.status);
              // Update button state
              var flashMessage = $('.alert-success').text().trim();
              if(flashMessage) {
                // Show flash message using Toastr
                toastr.success(flashMessage); // You can change this to toastr.error() or others based on your use case
              }

              setTimeout(() => {
                window.location.href = response.redirect; // Redirect to the provided URL
              }, 1000);
            } else {
              alert('Failed to update status');
            }
          },
          error: function(xhr) {
            alert('Failed to update status');
          }
        });
      });
    });

  </script>
@endsection
