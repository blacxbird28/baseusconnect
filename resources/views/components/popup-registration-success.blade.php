<div class="registration__success fixed-center max-w-[500px] w-full overflow-hidden z-50 pt-[125px] popup show-popup hide-popup">


  <img src="{{asset('images/icon-leo-big.png')}}" alt="" class="absolute top-0 left-[60%] -translate-x-1/2 w-[140px]">

  <div class="relative bg-primary-white py-5 px-3">
    <div class="absolute top-5 right-5 cursor-pointer JS__popup-close z-2">
      <i class="fa-solid fa-xmark text-black text-[30px]"></i>
    </div>

    <img src="{{asset('images/bg-gradient-title.png')}}" alt="" class="absolute top-0 left-0 w-full h-[30px] mb-3">

    <div class="row justify-center">
      <div class="col-md-12 text-center">
        <p class="text-primary-black text-[25px] font-owners_trial_wide_medium">WELCOME</p>
        <p class="text-primary-black text-[20px] lg:text-[30px] font-owners_trial_wide_xblack mb-2">"{{strtoupper(Auth::user()->name)}}"</p>
      </div>

      <div class="registrations__form relative">
        <div class="container">
          <div class="row justify-center">
            <div class="col-md-12">
              <p class="text-primary-black text-[14px] lg:text-[16px] text-center mb-3 lg:mb-5">Selamat kamu telah terdaftar sebagai LEO BUDDIES</p>
              <p class="text-primary-black text-[14px] lg:text-[16px] text-center mb-5">Yuk, mulai perjalanan kamu dengan upload aktivitas seru bareng produk Baseus dan kumpulin poin pertamamu!</p>
            </div>
          </div>

          <div class="row justify-center">
            <div class="col-md-10">
              <div class="row justify-center">
                <div class="col-md-5">
                  @php
                    $user = Auth::user();
                    $grouplink = '';
                    if($user->group == 'running'){
                      $grouplink = 'https://chat.whatsapp.com/FlQ6OtCiP65LuQ0QPuDlBJ';
                    } else if($user->group == 'music'){
                      $grouplink = 'https://chat.whatsapp.com/JDzK7kLDi7CEb6N9IZmTKW';
                    } else {
                      $grouplink = 'https://chat.whatsapp.com/BWJboFgM9vKBnwutUPDeJ3';
                    }
                  @endphp
                  <a href="{{$grouplink}}" target="_blank" class="block bg-primary-yellow border-2 border-primary-yellow text-[14px] font-owners_trial_wide_medium text-center w-[150px] mx-auto p-1 transition duration-300 hover:bg-white">Join Group</a>
                </div>
                <div class="col-md-5">
                  <a href="/generate-image" class="block bg-primary-white border-2 border-primary-black text-[14px] font-owners_trial_wide_medium text-center w-[150px] mx-auto p-1 transition duration-300 hover:bg-primary-black hover:text-white">Share & Get Point</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="popup__overlay JS__popup-close fixed left-0 top-0 w-full h-full z-[49] bg-primary-black opacity-50 hide-overlay show"></div>
