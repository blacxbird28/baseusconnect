@props(['title', 'point', 'class'=>'', 'pointColor'=>''])
@if($pointColor == 'green')
    @php $classColor = 'bg-gradient-green'; @endphp
@elseif($pointColor == 'orange')
    @php $classColor = 'bg-gradient-orange'; @endphp
@endif
<div class="relative mb-4 pb-4 border-b-2 border-primary-green {{$class}}">
  <!-- <div class="absolute top-[50%] -left-[100px]">
    <img src="{{asset('/images/icon-arrow.png')}}" alt="" class="w-[80px] hidden lg:block">
  </div> -->
  <div class="row justify-between align-items-center">
    <div class="col-12 col-lg-8">
      <p class="text-primary-black text-[14px] lg:text-[16px] text-align-center lg:text-left font-owners_trial_wide_medium font-bold mb-3 lg:mb-0">{!!$title!!}</p>
    </div>

    <div class="col-12 col-lg-4">
      <p class="{{$classColor}} border-2 border-primary-black text-center text-[14px] lg:text-[16px] font-owners_trial_wide_medium p-2">{{$point}} PTS</p>
    </div>
  </div>
</div>
