<div class="profile__top relative pt-[100px]">
  <div class="container">
    <div class="row justify-center">
      <div class="col-md-10">
        @if(session()->has('status'))
          <div class="alert alert-success text-center text-primary-green">
            {{ session()->get('status') }}
          </div>
        @endif

        <div class="row justify-center">
          <div class="col-md-10">
            <div class="row mb-3 md:!mb-[50px]">
              <div class="col-6 col-md-5">
                <img src="{{asset('/content_file_upload/profile_picture/'.$user['profile_pic'])}}" alt="" class="w-[200px]">

                <a href="/profile/edit" class="text-primary-black text-[14px] md:text-[16px] text-center font-owners_trial_wide_medium block transition duration-300 p-2 my-3 rounded-md bg-primary-yellow border-2 border-primary-yellow hover:bg-primary-white w-[150px]">Edit Profile</a>
              </div>

              <div class="col-6 col-md-7">
                <p class="text-primary-black text-[16px] md:text-[20px] font-owners_trial_wide_medium">Total Point</p>
                <p class="text-primary-green text-[20px] md:text-[55px] font-owners_trial_wide_xblack">{{$point}}</p>

                <div class="w-full h-1 border-b-2 border-primary-black mb-[10px] md:mb-[20px]"></div>

                <div class="row">
                  <div class="col-md-8">
                    <p class="text-primary-black text-[16px] md:text-[18px] font-owners_trial_wide_medium mb-[10px]">{{$user['name']}}</p>
                    <p class="text-primary-black text-[16px] md:text-[18px] font-owners_trial_wide_medium mb-[10px]">{{$user['email']}}</p>
                    <p class="text-primary-black text-[16px] md:text-[18px] font-owners_trial_wide_medium mb-[10px]">{{$user['phone']}}</p>
                    <p class="text-primary-black text-[16px] md:text-[18px] font-owners_trial_wide_medium">{{$user['alamat']}}</p>
                  </div>

                  <div class="col-md-4">
                    <p class="text-primary-black text-[16px] md:text-[18px] text-center font-owners_trial_wide_medium border-2 border-primary-black p-1">{{ucfirst($user['group'])}}</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row justify-center">
              <div class="col-6 col-md-6"><a href="/activity" class="bg-primary-yellow border-2 border-primary-yellow text-primary-black text-center font-bold w-full mx-auto my-3 md:!my-[50px] p-2 font-owners_trial_wide_medium block transition duration-300 hover:bg-primary-white hover:border-black">Submit Activity</a></div>
              <div class="col-6 col-md-6"><a href="/redeem" class="bg-primary-white border-2 border-primary-black text-primary-black text-center font-bold w-full mx-auto my-3 md:!my-[50px] p-2 font-owners_trial_wide_medium block transition duration-300 hover:bg-primary-black hover:text-white ">Redeem Point</a></div>
            </div>
          </div>
        </div>

        <div class="w-full h-1 border-b-2 border-primary-black mb-3 md:mb-[50px]"></div>
      </div>
    </div>
  </div>
</div>
