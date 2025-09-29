<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4">
      {{ $post['id'] ? __('Edit Posts') : __('Add Posts') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            <form action="{{ $post['id'] ? route('posts.update', ['id' => $post['id']]) : route('posts.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
              @csrf
              <div>
                  <x-input-label for="title" :value="__('Title')" />
                  <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ old('title', isset($post) ? $post->title : '') }}" />
                  <x-input-error :messages="$errors->get('title')" class="mt-2" />
              </div>

              <div>
                  <x-input-label for="short_description" :value="__('Short Description')" />
                  <x-text-input id="short_description" name="short_description" type="text" class="mt-1 block w-full" value="{{ old('short_description', isset($post) ? $post->short_description : '') }}" />
                  <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
              </div>

              <div>
                  <x-input-label for="platform" :value="__('Platform')" />
                  <select name="platform" id="platform" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="Tiktok">Tiktok</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Instagram">Instagram</option>
                  </select>

                  <x-input-error :messages="$errors->get('platform')" class="mt-2" />
              </div>

              <div>
                  <x-input-label for="url" :value="__('URL')" />
                  <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" value="{{ old('url', isset($post) ? $post->url : '') }}" />
                  <x-input-error :messages="$errors->get('url')" class="mt-2" />
              </div>

              <div>
                  <x-input-label for="images" :value="__('Screenshot')" />
                  <img src="{{asset('/content_file_upload/screenshots/'.$post->images)}}" alt="" style="width: 100px;">
                  <x-text-input id="images" name="images" type="file" class="mt-1 block w-full"/>
                  <x-input-error :messages="$errors->get('images')" class="mt-2" />
              </div>

              <div class="flex items-center gap-4">
                  <x-primary-button>{{ __('Save') }}</x-primary-button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
