<div class="our-event__others">
  <div class="container">
    <div class="row justify-center">
      <div class="col-md-11">
         <p class="text-primary-black font-owners_trial_wide_medium text-[16px] lg:text-[18px] mb-3">Read more <b class="font-owners_trial_wide_xblack">newsroom</b></p>
         <div class="row justify-center">
            @foreach ($other_events as $item)
            <x-connect-item title="{{$item['title']}}" desc="{{$item['description']}}" url="/our-event/{{$item['slug']}}" image="/content_file_upload/events/{{$item['images']}}" class="mb-4" />
            @endforeach
         </div>
      </div>
    </div>
  </div>
</div>
