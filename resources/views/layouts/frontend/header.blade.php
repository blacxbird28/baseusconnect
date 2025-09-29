<div class="header fixed w-full py-[15px] lg:py-[25px] z-10 transition duration-300 bg-linear-to-bl from-primary-black to-transparent" id="header">
  <div class="container">
    <div class="row justify-center">
      <div class="col-md-10">
        <div class="row justify-between">
          <div class="col-2 col-md-1">
            <a href="/" class="logo">
              <img src="{{asset('/images/logo-baseus.png')}}" alt="">
            </a>
          </div>

          <div class="col-6 col-md-5">
            <div class="row justify-between align-items-center">
              <div class="col-8 col-md-9">
                <div class="flex justify-end">
                @if(Auth::check())
                  <a href="/profile" class="bg-primary-yellow border-2 border-primary-yellow font-bold text-[14px] md:text-[16px] text-center w-[100px] p-1 transition duration-300 hover:bg-white hover:border-black">Profile</a>
                @else
                  <a href="javascript:void(0);" class="JS__popup bg-primary-yellow border-2 border-primary-yellow font-bold text-[14px] md:text-[16px] text-center w-[100px] p-1 transition duration-300 hover:bg-white hover:border-black" data-popup="registration">Join Now</a>
                @endif
                </div>
              </div>

              <div class="col-4 col-md-3">
                <div class="nav-menu__right menu-toggle h-[33px] relative top-0">
                  <input type="checkbox" class="menu-toggle__input absolute block cursor-pointer w-[40px] h-[30px] z-2 lg:hidden">
                  <span></span>
                  <span></span>
                  <span></span>
                  <ul class="block fixed space-x-0 px-3 lg:!px-[50px] pt-[100px] w-[50%] md:w-[45%] lg:w-[40%] h-[80%] top-0 justify-end">
                    <li class="block w-full p-2"><a href="/" class="font-owners_trial_wide_medium text-[14px] md:text-[16px] lg:text-[18px] text-primary-black no-underline {{ Route::is('home') ? 'font-bold' : '' }} hover:text-primary-black">Home</a></li>
                    <li class="block w-full p-2"><a href="/about" class="font-owners_trial_wide_medium text-[14px] md:text-[16px] lg:text-[18px] text-primary-black no-underline {{ Route::is('about') ? 'font-bold' : '' }} hover:text-primary-black">About</a></li>
                    <li class="block w-full p-2"><a href="/our-event" class="font-owners_trial_wide_medium text-[14px] md:text-[16px] lg:text-[18px] text-primary-black no-underline {{ Route::is('our-event') ? 'font-bold' : '' }} hover:text-primary-black">Our Event</a></li>
                    <li class="block w-full p-2"><a href="/our-event" class="font-owners_trial_wide_medium text-[14px] md:text-[16px] lg:text-[18px] text-primary-black no-underline {{ Route::is('our-event') ? 'font-bold' : '' }} hover:text-primary-black">Articles</a></li>
                    @if(Auth::check())
                    <li class="block w-full p-2">
                      <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block JS__popup bg-primary-black border-2 border-primary-black text-primary-white font-owners_trial_wide_medium text-[14px] md:text-[16px] lg:text-[18px] text-center w-[100px] p-1 transition duration-300 hover:bg-white hover:text-primary-black">
                        LOGOUT

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </a>
                    </li>
                    @else
                    <li class="block w-full p-2">
                      <a href="javascript:void(0);" class="block JS__popup bg-primary-yellow border-2 border-primary-yellow font-owners_trial_wide_medium text-[14px] md:text-[16px] lg:text-[18px] text-center w-[100px] p-1 transition duration-300 hover:bg-white hover:border-black" data-popup="login">LOGIN</a>
                    </li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="menu-toggle__overlay bg-primary-black opacity-50 fixed top-0 left-0 w-full h-full z-2 hide-overlay"></div>
