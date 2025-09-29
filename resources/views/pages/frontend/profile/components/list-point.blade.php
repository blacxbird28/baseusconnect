<div class="profile__list-point relative">
  <div class="container relative z-1">
    <div class="row justify-center">
      <div class="col-md-10">
        <div class="row justify-center">
          <div class="col-md-10">
            <div class="relative">
              <img src="{{asset('/images/bg-gradient-title.png')}}" alt="" class="absolute w-[200px] -left-[30px] z-0">
              <p class="relative z-1 text-primary-black text-[18px] lg:text-[24px] font-owners_trial_wide_medium mb-[30px]"><b class="font-owners_trial_wide_xblack">List</b> Point</p>
            </div>

            @foreach($activity_list as $index => $item)
              <div class="row justify-between align-items-center mb-3">
                <div class="col-md-6"><p class="text-primary-black text-[14px] md:text-[16px] font-owners_trial_wide_medium">{{$item['title']}}</p></div>
                <div class="col-md-3"><p class="text-primary-black text-[14px] md:text-[16px] text-center font-owners_trial_wide_medium bg-primary-white border-2 border-primary-black p-2 bg-gradient-green">{{$item['point']}} PTS</p></div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <img src="{{asset('/images/text-baseus-connect-grey.png')}}" alt="" class="w-full my-[50px]">
</div>
