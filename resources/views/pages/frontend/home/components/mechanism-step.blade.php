<div class="home__mechanism-step pt-[50px]">
  <div class="container">
    <div class="row justify-center">
      <div class="col-md-9 wow fadeInUp" data-wow-delay=".3s">
        <div class="row justify-center mb-[50px] lg:mb-[100px]">
          <div class="col-6 col-lg-4">
            <div class="relative flex align-items-end lg:h-full mb-3 lg:!mb-0 wow fadeInUp" data-wow-delay=".4s">
              <img src="{{asset('/images/content-digital-upload-1.png')}}" alt="" class="relative z-1 h-[250px] lg:h-auto mx-auto lg:!mx-0">
              <img src="{{asset('/images/icon-arrow.png')}}" alt="" class="absolute top-[50%] -right-[50px] hidden lg:block">
              <img src="{{asset('/images/icon-arrow-bottom.png')}}" alt="" class="absolute -bottom-[15%] left-[50%] hidden lg:block">
            </div>
          </div>

          <div class="col-6 col-lg-4 block lg:hidden">
            <div class="relative mb-3 lg:!mb-0 wow fadeInUp" data-wow-delay=".4s">
              <img src="{{asset('/images/content-digital-upload-2.png')}}" alt="" class="relative z-1 h-[250px] lg:h-auto lg:w-[80%] mx-auto lg:mx-0">
              <!-- <img src="{{asset('/images/icon-arrow.png')}}" alt="" class="absolute top-[50%] -rotate-180 -right-[50px] hidden lg:block"> -->
            </div>
          </div>

          <div class="col-lg-4 wow fadeInUp" data-wow-delay=".5s">
            <div class="relative h-full">
                <div class="relative flex flex-column justify-center w-full lg:w-[80%] h-full mx-auto z-1 bg-primary-yellow py-3 lg:py-5 px-3 text-center">
                  <p class="text-primary-black text-center font-owners_trial_wide_xblack text-[20px] md:text-[25px] lg:text-[30px] mb-3 lg:mb-5">UPLOAD
                  MATERI</p>
                  <img src="{{asset('/images/icon-upload.png')}}" alt="" class="mx-auto mb-3 lg:mb-5">

                  <p class="text-primary-black text-center font-owners_trial_wide_medium text-[14px] md:text-[16px] lg:text-[18px]">Weekly curated by<br class="hidden md:block" /> internal agency for<br /> calculation and<br class="hidden md:block" /> updated it on<br class="hidden md:block" /> leaderboard</p>
                </div>
                <img src="{{asset('/images/icon-arrow-bottom.png')}}" alt="" class="absolute -bottom-[15%] left-[50%] block lg:hidden">
            </div>
          </div>

          <div class="col-md-4 hidden lg:block">
            <div class="relative flex align-items-end h-full lg:!mb-0 wow fadeInUp" data-wow-delay=".6s">
              <img src="{{asset('/images/content-digital-upload-2.png')}}" alt="" class="relative z-1 h-[250px] lg:h-auto">
              <img src="{{asset('/images/icon-arrow-left.png')}}" alt="" class="absolute top-[50%] -left-[50px] hidden lg:block">
              <img src="{{asset('/images/icon-arrow-bottom.png')}}" alt="" class="absolute -bottom-[15%] left-[50%] hidden lg:block">

            </div>
          </div>
        </div>


        <div class="row justify-center wow fadeInUp" data-wow-delay=".5s">
          <div class="col-11 col-md-4 p-0">
            <div class="flex flex-column justify-center p-3 border-2 border-primary-black h-full">
              <x-mechanism-item :title="'Comment<br class=\'hidden lg:block\' /> 1 Content'" :point="'1'" :pointColor="'green'"/>
              <x-mechanism-item :title="'Create<br class=\'hidden lg:block\' />1 IG Feeds'" :point="'2'" :pointColor="'green'"/>
              <x-mechanism-item :title="'Create<br class=\'hidden lg:block\' />1 IG Reels or<br />1 video Tiktok'" :point="'5'" :pointColor="'green'" class="!mb-0"/>
            </div>
          </div>

          <div class="col-11 col-md-4 p-0">
            <div class="relative flex flex-column justify-center h-full bg-primary-black text-center py-5">
              <img src="{{asset('/images/icon-star.png')}}" alt="" class="mx-auto mb-3">

              <p class="text-white text-[14px] lg:text-[18px] font-owners_trial_wide_medium">Kumpulkan<br class="hidden md:block" />
                poinmu<br class="hidden md:block" />
                sekarang</p>
            </div>
          </div>

          <div class="col-11 col-md-4 p-0">
            <div class="flex flex-column justify-center p-3 border-2 border-primary-black h-full">
              <x-mechanism-item :title="'Join The Event'" :point="'10'" :pointColor="'orange'"/>
              <x-mechanism-item :title="'Join The Event<br class=\'hidden lg:block\' /> And Create<br /> Digital Contens'" :point="'20'" :pointColor="'orange'"/>
              <x-mechanism-item :title="'Buy Product On<br class=\'hidden lg:block\' /> Online Shop<br /> (Depend On The Price)'" :point="'10-50'" :pointColor="'orange'" class="!mb-0"/>
            </div>
          </div>
        </div>
      </div>



      <div class="col-md-12 wow fadeInUp" data-wow-delay=".6s">
        <a href="javascript:void(0);" class="JS__popup text-primary-black border-2 border-primary-yellow bg-primary-yellow text-center text-[14px] w-[150px] mx-auto mt-0 md:!mt-[30px] lg:my-[50px] p-2 font-owners_trial_wide_medium block transition duration-300 hover:bg-primary-white hover:border-black" data-popup="registration">GET POINT</a>
      </div>
    </div>
  </div>
</div>
