<div class="activity__list-point relative pb-5 lg:!pb-[100px]">
  <div class="container relative z-1">
    <div class="row justify-center">
      <div class="col-md-12 col-lg-10 col-xl-10">
        <div class="flex justify-center mb-3">
          <p class="text-primary-black text-[35px] text-center font-owners_trial_wide_medium mr-3">LIST</p>
          <p class="text-primary-black text-[35px] text-center font-owners_trial_wide_xblack">POINT</p>
        </div>
      </div>
    </div>

    <div class="row justify-center">
      <div class="col-md-10">
        <div class="row justify-center">
          <div class="col-md-10">
            @foreach($activity as $index => $item)
              <div class="row justify-between align-items-center mb-3">
                <div class="col-md-9">
                    <p class="text-primary-black text-[16px] font-owners_trial_wide_medium">{{$item['title']}}</p>
                </div>
                <div class="col-md-3"><p class="text-primary-black text-[16px] text-center font-owners_trial_wide_medium bg-primary-white border-2 border-primary-black p-2 bg-gradient-green">{{$item['point']}}PTS</p></div>
              </div>
              @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
