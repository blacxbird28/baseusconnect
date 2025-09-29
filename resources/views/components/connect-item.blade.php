@props(['title', 'desc', 'url', 'image', 'class'])

<div class="col-11 col-md-4 {{$class}}">
  <a href="{{$url}}" class="relative block bg-primary-yellow transition duration-300 hover:translate-y-[-5px]">
    <img src="{{asset($image)}}" alt="" class="w-full h-[200px] lg:h-[250px] object-cover">

    <div class="flex align-items-center p-3 h-auto md:!h-[115px]">
      <p class="text-primary-black text-[16px] lg:text-[18px] font-owners_trial_wide_medium font-bold">{!!$title!!}</p>
      <p class="text-primary-black text-[14px] lg:text-[16px]">{{$desc}}</p>
    </div>
  </a>
</div>
