<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Fullname')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- No Ktp -->
        <div class="mb-4">
            <x-input-label for="no_ktp" :value="__('No KTP')" />
            <x-text-input id="no_ktp" class="block mt-1 w-full" type="text" name="no_ktp" :value="old('no_ktp')" required autofocus autocomplete="no_ktp" />
            <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Domisili -->
        <div class="mb-4">
            <x-input-label for="domisili" :value="__('Domisili')" />
            <x-text-input id="domisili" class="block mt-1 w-full" type="text" name="domisili" :value="old('domisili')" required autofocus autocomplete="domisili" />
            <x-input-error :messages="$errors->get('domisili')" class="mt-2" />
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required autofocus autocomplete="alamat" />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Group -->
        <div class="mb-4">
            <x-input-label for="group" :value="__('Group')" />
            <select name="group" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                <option value="sports">Sports</option>
                <option value="food">Food</option>
                <option value="travel">Travel</option>
                <option value="music">Music</option>
            </select>
            <x-input-error :messages="$errors->get('group')" class="mt-2" />
        </div>

        <!-- Instagram -->
        <div class="mb-4">
            <x-input-label for="instagram" :value="__('Instagram')" />
            <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram" :value="old('instagram')" autofocus autocomplete="instagram" />
            <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
        </div>

        <!-- Tiktok -->
        <div class="mb-4">
            <x-input-label for="tiktok" :value="__('Tiktok')" />
            <x-text-input id="tiktok" class="block mt-1 w-full" type="text" name="tiktok" :value="old('tiktok')" autofocus autocomplete="tiktok" />
            <x-input-error :messages="$errors->get('tiktok')" class="mt-2" />
        </div>

        <!-- Facebook -->
        <div class="mb-4">
            <x-input-label for="facebook" :value="__('Facebook')" />
            <x-text-input id="facebook" class="block mt-1 w-full" type="text" name="facebook" :value="old('facebook')" autofocus autocomplete="facebook" />
            <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
        </div>

        <!-- twitter -->
        <div class="mb-4">
            <x-input-label for="twitter" :value="__('Twitter')" />
            <x-text-input id="twitter" class="block mt-1 w-full" type="text" name="twitter" :value="old('twitter')" autofocus autocomplete="twitter" />
            <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
        </div>

        <!-- Profile Picture -->
        <div class="mb-4">
            <x-input-label for="profile_pic" :value="__('Profil Picture')" />
            <x-text-input id="profile_pic" class="block mt-1 w-full" type="file" name="profile_pic" :value="old('profile_pic')" autofocus autocomplete="profile_pic" />
            <x-input-error :messages="$errors->get('profile_pic')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
