<div class="event__connect relative pb-[50px]">
  <div class="container">
    <div class="row justify-center mb-3 lg:mb-5">
      <div class="col-md-12 col-lg-10 col-xl-10">
        <div class="block lg:flex justify-center">
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_xblack mr-3">CONNECT</p>
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_medium mr-3">WITH LEO BUDDIES</p>
        </div>
      </div>
    </div>

    <div class="row justify-center">
      <div class="col-md-11">
        <div class="row justify-center">
          @foreach ($events as $item)
            <x-connect-item title="{{$item['title']}}" desc="{{$item['description']}}" url="/our-event/{{$item['slug']}}" image="/content_file_upload/events/{{$item['images']}}" class="mb-4" />
          @endforeach
        </div>
      </div>
    </div>

    <!-- <div class="flex justify-center">
      <a href="#" class="block text-primary-black text-[16px] lg:text-[18px] text-center font-owners_trial_wide_medium mx-auto my-3 lg:my-5 transition duration-300 border-b-2 border-transparent
       hover:border-primary-black">READ MORE</a>
    </div> -->

  </div>

  <div>
    <img src="{{asset('/images/text-baseus-connect-grey.png')}}" alt="" class="w-full">
  </div>
</div>
