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
        <!-- <tbody>
          <tr>
            <td class="flex justify-center">
              <img src="{{asset('/images/icon-medal.png')}}" alt="" class="p-2">
              <p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">1</p>
            </td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">100</p></td>
          </tr>
          <tr>
            <td class="flex justify-center">
              <img src="{{asset('/images/icon-medal.png')}}" alt="" class="p-2">
              <p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">2</p>
            </td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">99</p></td>
          </tr>
          <tr class="border-b-2 border-primary-green">
            <td class="flex justify-center">
              <img src="{{asset('/images/icon-medal.png')}}" alt="" class="p-2">
              <p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">3</p>
            </td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">98</p></td>
          </tr>
          <tr>
            <td class="flex justify-center"><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">4</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">90</p></td>
          </tr>
          <tr>
            <td class="flex justify-center"><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">5</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">89</p></td>
          </tr>
          <tr>
            <td class="flex justify-center"><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">6</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">88</p></td>
          </tr>
          <tr>
            <td class="flex justify-center"><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">7</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">87</p></td>
          </tr>
          <tr>
            <td class="flex justify-center"><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">8</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">86</p></td>
          </tr>
          <tr>
            <td class="flex justify-center"><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">9</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">85</p></td>
          </tr>
          <tr>
            <td class="flex justify-center"><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">10</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">John Doe</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">Sport Enthusiast</p></td>
            <td><p class="text-primary-black text-[14px] lg:text-[16px] text-center p-2 font-owners_trial_wide_medium">84</p></td>
          </tr>
        </tbody> -->
      </table>

    </div>
  </div>
  <img src="{{asset('/images/defider.png')}}" alt="" class="w-full">
</div>
