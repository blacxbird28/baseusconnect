<div class="news__others">
  <div class="container">
    <div class="row justify-center">
      <div class="col-md-11">
        <p class="text-primary-black font-owners_trial_wide_medium text-[18px] mb-3">Read more <b class="font-owners_trial_wide_xblack">newsroom</b></p>
        <div class="row justify-center">
          @foreach ($other_news as $item)
            <x-news-item title="{{$item['title']}}" date="{{$item['created_at']}}" url="{{$item['slug']}}" image="/content_file_upload/posts/{{$item['images']}}" class="mb-4" />
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
