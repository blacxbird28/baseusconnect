<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('pages.frontend.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('pages.frontend.profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xxl">
                    @include('pages.frontend.profile.posts.list')
                </div>
            </div>

            {{--<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('pages.frontend.profile.partials.delete-user-form')
                </div>
            </div>--}}
        </div>
    </div>

    @section('customscript')
      <script>
        jQuery(document).ready(function() {
            jQuery('#posts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{{ route('profile.posts-data') }}', // The URL for the data
                    "dataSrc": 'data'
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'description', name: 'description' },
                    { data: 'platform', name: 'platform' },
                    { data: 'url', name: 'url' },
                    { data: "images",
                        render: function(data, type, row) {
                            // If image URL is available, return the image HTML
                            return '<a href="{{asset("content_file_upload/screenshots")}}' + '/' + data + '" target="_blank"> <img src="{{asset("content_file_upload/screenshots")}}' + '/' + data + '" width="50" height="50" alt="Screenshot"> </a>';
                        }
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
      </script>
    @endsection
</x-app-layout>
