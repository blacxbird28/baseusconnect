<div class="registration fixed-center max-w-[500px] w-full overflow-hidden z-50 bg-primary-white p-5 popup popup__login hide-popup">
  <div class="absolute top-5 right-5 cursor-pointer JS__popup-close">
    <i class="fa-solid fa-xmark text-black text-[30px]"></i>
  </div>
  <div class="row justify-center">
    <div class="col-md-12 text-center">
      <p class="text-primary-black text-[16px] lg:text-[25px] font-owners_trial_wide_medium">WELCOME</p>
      <p class="text-primary-black text-[20px] lg:text-[40px] font-owners_trial_wide_xblack mb-2">LEO BUDDIES</p>
    </div>

    <div class="registrations__form relative">
      <div class="container">
        <div class="row justify-center">

          <div class="col-md-12">
            <form method="POST" id="ajaxLoginForm">
              @csrf

              <!-- Email Address -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="email" class="block mt-1 w-full font-owners_trial_wide_medium" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                {{--<x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
              </div>

              <!-- Password -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="password" class="block mt-1 w-full font-owners_trial_wide_medium"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="Password" />

                {{-- <x-input-error :messages="$errors->get('password')" class="mt-2 error-password" /> --}}
              </div>


              <div class="flex items-center justify-end mt-[30px] lg:mt-[50px] my-[30px]">
                <button class="flex justify-center align-items-center text-primary-black bg-primary-yellow text-[14px] w-[180px] mx-auto p-2 font-owners_trial_wide_medium" id="submit-btn" type="submit">
                  <span class="spinner-login spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span>
                  <span class="btn-text-login">LOGIN</span>
                </button>
              </div>

              <div class="flex items-center text-center">
                @if (Route::has('password.request'))
                  <a class="block mx-auto underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                      {{ __('Forgot your password?') }}
                  </a>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
  <img src="{{asset('images/bg-gradient-title.png')}}" alt="" class="absolute bottom-0 left-0 w-full h-[30px]">
</div>
