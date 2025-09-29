<div class="registration fixed-center max-w-[500px] w-full h-[70%] overflow-hidden z-50 bg-primary-white py-5 px-3 md:px-4 lg:px-5 popup popup__registration hide-popup">
  <div class="absolute top-5 right-5 cursor-pointer JS__popup-close">
    <i class="fa-solid fa-xmark text-black text-[30px]"></i>
  </div>

  <div class="row justify-center">
    <div class="col-md-12 text-center">
      <p class="block w-[150px] bg-primary-yellow font-bold mx-auto py-2 mb-5 font-owners_trial_wide_medium">REGISTRATION</p>
    </div>
  </div>

  <div class="relative h-[70%] overflow-x-hidden overflow-y-scroll">
    <div class="registrations__form relative">
      <div class="container">
        <div class="row justify-center">

          <div class="col-md-12">
            <form method="POST" enctype="multipart/form-data" id="myForm">
              @csrf

              <!-- Name -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="name" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Full name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
              </div>

              <!-- Email Address -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="email" class="block mt-1 w-full font-owners_trial_wide_medium" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>

              <!-- Password -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="password" class="block mt-1 w-full font-owners_trial_wide_medium"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="Password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>

              <!-- Confirm Password -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="password_confirmation" class="block mt-1 w-full font-owners_trial_wide_medium"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirm Password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
              </div>

              <!-- Phone -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="phone" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" placeholder="Phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
              </div>

              <!-- Alamat -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="alamat" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="alamat" :value="old('alamat')" required autofocus autocomplete="alamat" placeholder="Address" />
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
              </div>

              <!-- Community Name -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="community_name" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="community_name" :value="old('community_name')" required autofocus autocomplete="community_name" placeholder="Community Name" />
                <x-input-error :messages="$errors->get('community_name')" class="mt-2" />
              </div>

              <!-- Date -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="datepicker" class="block mt-1 w-full font-owners_trial_wide_medium datepicker" type="text" name="born_date" :value="old('born_date')" required autofocus autocomplete="born_date" placeholder="Born Date"/>
                <x-input-error :messages="$errors->get('born_date')" class="mt-2" />
              </div>

              <!-- Group -->
              <div class="mb-2 lg:mb-4">
                <select name="group" id="" class="text-[14px] border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full font-owners_trial_wide_medium" placeholder="Choose interest">
                    <option value="running">Running</option>
                    <option value="music">Music</option>
                    <option value="gym">Gym</option>
                </select>
                <x-input-error :messages="$errors->get('group')" class="mt-2" />
              </div>

              <!-- Profile Picture -->
              <div class="mb-2 lg:mb-4">
                <div class="relative w-full border-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                  <input type="file" name="profile_pic" class="relative w-100 z-3 opacity-0 py-[20px] px-3" id="imageInput">
                  <div class="absolute flex top-[8px] left-[2px] py-0 px-[10px] lg:p-[10px] bg-primary-white">
                    <img src="{{asset('/images/icon-upload.png')}}" alt="" class="w-[26px] h-auto object-contain mr-3">
                    <p class="text-gray-400 font-owners_trial_wide_medium">Upload profile picture<br /> <span class="text-[12px]">(Max. file 2mb)</span></p>
                  </div>
                  <x-input-error :messages="$errors->get('profile_pic')" class="mt-2" />
                </div>

                <div id="preview-container" class="relative w-[250px] h-[250px] overflow-hidden mt-2" hidden>
                  <img id="preview" src="" alt="Image preview will appear here" class=" w-full h-full object-contain object-center">
                  <button id="deleteBtn" class="absolute top-2 right-2 block mx-auto bg-primary-red border-2 border-primary-red hover:bg-primary-white hover:text-primary-red text-primary-white font-bold p-1 transition duration-300 rounded-lg text-[14px]" type="button">Delete</button>
                </div>
              </div>

              <div class="mb-3">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
              </div>

              {{--
              <!-- Product Baseus -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="product" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="product" :value="old('product')" required autofocus autocomplete="product" placeholder="Product Baseus"/>
                <x-input-error :messages="$errors->get('product')" class="mt-2" />
              </div>
              <!-- No Ktp -->
              <div class="mb-2 lg:mb-4">
                <x-text-input id="no_ktp" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="no_ktp" :value="old('no_ktp')" required autofocus autocomplete="no_ktp" placeholder="No KTP" />
                <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
              </div>

              <!-- Instagram -->
              <div class="mb-2 lg:mb-4">
                <x-input-label for="instagram" :value="__('Instagram')" />
                <x-text-input id="instagram" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="instagram" :value="old('instagram')" autofocus autocomplete="instagram" />
                <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
              </div>

              <!-- Tiktok -->
              <div class="mb-2 lg:mb-4">
                <x-input-label for="tiktok" :value="__('Tiktok')" />
                <x-text-input id="tiktok" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="tiktok" :value="old('tiktok')" autofocus autocomplete="tiktok" />
                <x-input-error :messages="$errors->get('tiktok')" class="mt-2" />
              </div>

              <!-- Facebook -->
              <div class="mb-2 lg:mb-4">
                <x-input-label for="facebook" :value="__('Facebook')" />
                <x-text-input id="facebook" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="facebook" :value="old('facebook')" autofocus autocomplete="facebook" />
                <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
              </div>

              <!-- twitter -->
              <div class="mb-2 lg:mb-4">
                <x-input-label for="twitter" :value="__('Twitter')" />
                <x-text-input id="twitter" class="block mt-1 w-full font-owners_trial_wide_medium" type="text" name="twitter" :value="old('twitter')" autofocus autocomplete="twitter" />
                <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
              </div>--}}

              <div class="flex items-center justify-end mt-4">
                <button class="flex justify-center align-items-center text-primary-black bg-primary-yellow font-bold w-[180px] mx-auto p-2 font-owners_trial_wide_medium" id="submit-btn" type="submit">
                  <span class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span>
                  <span class="btn-text">JOIN</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="absolute bg-primary-white w-full pt-3 pb-4 px-3 left-0 bottom-0">
    <p class="text-primary-black text-[16px] text-center font-owners_trial_wide_medium">Already have account? <a href="javascript:void(0)" class="JS__popup" data-popup="login">Login</a></p>
  </div>
</div>
