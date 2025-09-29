<div class="redeem__list-point relative pb-[50px]">
  <div class="container relative z-1">
    <div class="row justify-center">
      <div class="col-md-10">
        <div class="row justify-center">
          <div class="col-md-10">
            <div class="relative">
              <img src="{{asset('/images/bg-gradient-title.png')}}" alt="" class="absolute w-[200px] -left-[30px] z-0">
              <p class="relative z-1 text-primary-black text-[24px] font-owners_trial_wide_medium mb-[30px]"><b class="font-owners_trial_wide_xblack">List</b> Point</p>
            </div>

            @foreach($activity_list as $index => $item)
              <div class="row justify-between align-items-center mb-3">
                <div class="col-md-6"><p class="text-primary-black text-[16px] font-owners_trial_wide_medium">{{$item['title']}}</p></div>
                <div class="col-md-3"><p class="text-primary-black text-[16px] text-center font-owners_trial_wide_medium bg-primary-white border-2 border-primary-black p-2 bg-gradient-green">{{$item['point']}} PTS</p></div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
