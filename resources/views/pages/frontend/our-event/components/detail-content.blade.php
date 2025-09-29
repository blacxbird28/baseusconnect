<div class="our-event__content py-[30px] lg:py-[50px]">
  <div class="container">
    <div class="row justify-center mb-5">
      <div class="col-11 col-md-12 col-lg-11 col-xl-11">
        <div class="block lg:flex align-items-center mb-3">
          <p class="text-primary-black text-[20px] md:text-[25px] lg:text-[35px] font-owners_trial_wide_medium mr-3 mb-2 lg:mb-0">{{$content_detail['title']}}</p>

          <div class="relative flex align-items-center bg-primary-yellow p-2">
            <img src="{{asset('/images/icon-location.png')}}" alt="" class="w-[15px] mr-[5px]">
            <p class="text-[16px] lg:text-[18px] text-primary-black font-bold">{{$content_detail['location']}}</p>
          </div>
        </div>

        <div class="text-[14px] lg:text-[18px] mb-5 text-justify">
          {!! $content_detail['content'] !!}
        </div>

        @if(isset($content_detail['drive_url']) && $content_detail['drive_url'] != null)
        <div class="row justify-center">
            <div class="col-md-4 text-center wow fadeInUp">
                @if(Auth::check())
                    <a href="{{$content_detail['drive_url']}}" target="_blank" class="block bg-primary-yellow border-2 border-primary-yellow font-bold text-[14px] md:text-[16px] text-center w-auto p-1 px-2 transition duration-300 mb-[50px] hover:bg-white hover:border-black">VIEW MORE THE GALLERY</a>
                @else
                    <a href="javascript:void(0);" class="JS__popup block bg-primary-yellow border-2 border-primary-yellow font-bold text-[14px] md:text-[16px] text-center w-auto p-1 px-2 transition duration-300 mb-[50px] hover:bg-white hover:border-black" data-popup="registration">VIEW MORE THE GALLERY</a>
                @endif
                </div>
            </div>
        </div>
        @endif

        <div class="text-center">
          {!!$content_detail['maps']!!}
        </div>
      </div>
    </div>
  </div>

  <img src="{{asset('/images/text-baseus-connect-grey.png')}}" alt="" class="w-full">
</div>
