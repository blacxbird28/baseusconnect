<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4">
      {{ __('Add Posts') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
          <form method="post" action="{{ route('posts.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
              @csrf
              <div>
                  <x-input-label for="title" :value="__('Title')" />
                  <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ old('title') }}" />
                  <x-input-error :messages="$errors->get('title')" class="mt-2" />
              </div>

              <div>
                  <x-input-label for="description" :value="__('Description')" />
                  <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                  <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
                  <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" value="{{ old('url') }}" />
                  <x-input-error :messages="$errors->get('url')" class="mt-2" />
              </div>

              <div>
                  <x-input-label for="images" :value="__('Screenshot')" />
                  <x-text-input id="images" name="images" type="file" class="mt-1 block w-full" value="{{ old('images') }}"/>
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
