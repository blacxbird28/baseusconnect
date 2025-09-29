<div class="home__leaderboard relative pt-[50px]">
  <div class="absolute top-0 left-0 w-full" id="leaderboard"></div>

  <div class="row justify-center">
    <div class="col-md-12 col-lg-10 col-xl-10">
      <div class="flex justify-center">
        <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_xblack mr-3 wow fadeInDown">LEADERBOARD</p>
      </div>
      <p class="text-primary-black text-[14px] lg:text-[16px] text-center mb-3 lg:mb-5 wow fadeInDown" data-wow-delay=".3s">Kumpulkan poinmu dan jadi top activities<br class="block md:hidden"> bareng Baseus Connect!</p>
    </div>
  </div>

  <div class="row justify-center">
    <div class="col-10 col-xl-10">
      <table class="w-full mb-[50px] lg:mb-[100px] border-b-2 border-black wow fadeInUp" data-wow-delay=".5s">
        <thead>
          <tr>
            <th class="bg-primary-yellow text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Rank</th>
            <th class="bg-primary-yellow text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Name</th>
            <th class="bg-primary-yellow text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Community</th>
            <th class="bg-primary-yellow text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Total Points</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($leaderboard as $index => $value)
            <tr>
              <td class="flex justify-center">
                @if ($index == 0 || $index == 1 || $index == 2)
                  <img src="{{asset('/images/icon-medal.png')}}" alt="" class="p-2">
                @endif
              <p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium"></p>
              </td>
              <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">{{$value->name}}</p></td>
              <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">{{ucfirst($value->group)}} Enthusiast</p></td>
              <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">{{$value->point}}</p></td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
  <img src="{{asset('/images/defider.png')}}" alt="" class="w-full">
</div>
