<div class="event__news relative pb-[50px] lg:py-[50px]">
  <div class="container">
    <div class="row justify-center mb-3 lg:mb-5">
      <div class="col-md-12 col-lg-10 col-xl-10">
        <div class="flex justify-center">
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_xblack mr-3">NEWS</p>
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_medium mr-3">ROOM</p>
        </div>
      </div>
    </div>

    <div class="row justify-center">
      <div class="col-md-11">
        <div class="row justify-center">
          @foreach ($news as $item)
            <x-news-item title="{{$item['title']}}" date="{{$item['created_at']}}" url="/news/{{$item['slug']}}" image="content_file_upload/posts/{{$item['images']}}" class="mb-4" />
          @endforeach
        </div>
      </div>
    </div>

    <!-- <div class="flex justify-center">
      <a href="#" class="block text-primary-black text-[16px] lg:text-[18px] text-center font-owners_trial_wide_medium mx-auto my-3 lg:my-5 transition duration-300 border-b-2 border-transparent
       hover:border-primary-black">READ MORE</a>
    </div> -->

  </div>
</div>
