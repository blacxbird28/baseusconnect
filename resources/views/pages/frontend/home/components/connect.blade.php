<div class="home__connect relative py-[50px]">
  <div class="absolute top-0 left-0 w-full" id="our-event"></div>
  <div class="container">
    <div class="row justify-center mb-3 lg:mb-5 wow fadeInDown">
      <div class="col-md-12 col-lg-10 col-xl-10">
        <div class="block lg:flex justify-center">
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_xblack mr-3">CONNECT</p>
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_medium mr-3">WITH LEO BUDDIES</p>
        </div>
      </div>
    </div>

    <div class="row justify-center wow fadeInUp" data-wow-delay=".3s">
      <div class="col-md-11">
        <div class="row justify-center">
          @foreach ($events as $item)
            <x-connect-item title="{{$item['title']}}" desc="{{$item['description']}}" url="/our-event/{{$item['slug']}}" image="/content_file_upload/events/{{$item['images']}}" class="mb-4" />
          @endforeach
        </div>
      </div>
    </div>

    <div class="flex justify-center wow fadeInUp" data-wow-delay=".5s">
      <a href="/our-event" class="block text-primary-black text-[16px] text-center font-owners_trial_wide_medium font-bold mx-auto mt-3 mb-5 lg:!mt-5 lg:!mb-[100px] transition duration-300 border-b-2 border-transparent
       hover:border-primary-black">READ MORE</a>
    </div>

    <img src="{{asset('/images/defider.png')}}" alt="" class="w-full block md:hidden mb-3 lg:mb-5">

    <div class="row justify-center mb-3 lg:mb-5 wow fadeInDown" data-wow-delay=".3s">
      <div class="col-md-12 col-lg-10 col-xl-10">
        <div class="flex justify-center">
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_xblack mr-3">NEWS</p>
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_medium mr-3">ROOM</p>
        </div>
      </div>
    </div>

    <div class="row justify-center wow fadeInUp" data-wow-delay=".5s">
      <div class="col-md-11">
        <div class="row justify-center">
          @foreach ($news as $item)
            <x-news-item title="{{$item['title']}}" date="{{$item['created_at']}}" url="/news/{{$item['slug']}}" image="content_file_upload/posts/{{$item['images']}}" class="mb-4" />
          @endforeach
        </div>
      </div>
    </div>

    <div class="flex justify-center wow fadeInUp" data-wow-delay=".3s">
      <a href="/our-event" class="block text-primary-black text-[16px] text-center font-owners_trial_wide_medium font-bold mx-auto my-3 md:my-4 lg:mt-5 lg:mb-[100px] transition duration-300 border-b-2 border-transparent
       hover:border-primary-black">READ MORE</a>
    </div>

  </div>
</div>
