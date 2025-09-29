<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4">
      {{ __('Add Activity') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
              @csrf

              <div>
                <input type="hidden" name="user_id" value="{{$user->id}}">
                  <x-input-label for="activity_id" :value="__('Activity Type')" />
                  <select name="activity_id" id="activity_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach ($activity as $item)
                      <option value="{{$item->id}}">{{$item->title}}</option>
                    @endforeach
                  </select>

                  <x-input-error :messages="$errors->get('activity_id')" class="mt-2" />
              </div>

              <div>
                  <x-input-label for="images" :value="__('Screenshot')" />
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
