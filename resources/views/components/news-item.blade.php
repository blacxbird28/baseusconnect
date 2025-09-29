@props(['title', 'date', 'url', 'image', 'class'])

<div class="col-11 col-md-4 {{$class}}">
  <a href="{{$url}}" class="relative block bg-primary-black transition duration-300 hover:translate-y-[-5px]">
    <img src="{{asset($image)}}" alt="" class="w-full h-[200px] object-cover">

    <div class="p-3">
      <p class="text-primary-white text-[16px] lg:text-[18px] font-owners_trial_wide_medium font-bold h-auto lg:!h-[54px]">{{$title}}</p>
      <p class="text-primary-white text-[14px] lg:text-[16px]">{{$date}}</p>
    </div>
  </a>
</div>
