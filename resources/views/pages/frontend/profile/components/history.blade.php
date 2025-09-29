<div class="profile__history relative">
  <div class="container relative z-1">
    <div class="row justify-center">
      <div class="col-md-10">
        <div class="row justify-center">
          <div class="col-md-10">
            <div class="relative">
              <img src="{{asset('/images/bg-gradient-title.png')}}" alt="" class="absolute w-[200px] -left-[30px] z-0">
              <p class="relative z-1 text-primary-black text-[18px] lg:text-[24px] font-owners_trial_wide_medium mb-[30px]"><b class="font-owners_trial_wide_xblack">History</b> Point</p>
            </div>

            <table class="w-full">
              <tr>
                <th class="py-2 border-b-2 border-primary-green"><p class="text-primary-black text-[14px] md:text-[16px] font-owners_trial_wide_xblack">Item</p></th>
                <th class="py-2 border-b-2 border-primary-green"><p class="text-primary-black text-[14px] md:text-[16px] font-owners_trial_wide_xblack">Point</p></th>
                <th class="py-2 border-b-2 border-primary-green"><p class="text-primary-black text-[14px] md:text-[16px] text-center font-owners_trial_wide_xblack">Date</p></th>
                <th class="py-2 border-b-2 border-primary-green"><p class="text-primary-black text-[14px] md:text-[16px] text-center font-owners_trial_wide_xblack">Status</p></th>
              </tr>

              @if(count($activity) > 0)
                @foreach($activity as $item)
                <tr>
                  <td class="py-3 border-b-2 border-primary-black"><p class="text-primary-black text-[14px] md:text-[16px] font-owners_trial_wide_medium">{{$item->title}}</p></td>
                  <td class="py-3 border-b-2 border-primary-black"><p class="text-primary-black text-[14px] md:text-[16px] text-center font-owners_trial_wide_medium">+{{$item->point}}</p></td>
                  <td class="py-3 border-b-2 border-primary-black"><p class="text-primary-black text-[14px] md:text-[16px] text-center font-owners_trial_wide_medium">{{$item->created_at}}</p></td>
                  <td class="py-3 border-b-2 border-primary-black">
                    @if($item->status == 0)
                    <p class="text-primary-black text-[14px] md:text-[16px] text-center font-owners_trial_wide_medium bg-primary-yellow p-2 ">On Review</p>
                    @elseif($item->status == 1)
                    <p class="text-primary-white text-[14px] md:text-[16px] text-center font-owners_trial_wide_medium bg-primary-green p-2 ">Approved</p>
                    @elseif($item->status == 2)
                    <p class="text-primary-white text-[14px] md:text-[16px] text-center font-owners_trial_wide_medium bg-primary-red p-2 ">Rejected</p>
                    @endif
                  </td>
                </tr>
                @endforeach
              @else
                <tr>
                  <td class="py-3 border-b-2 border-primary-black" colspan="4"><p class="text-primary-black text-[14px] md:text-[16px] text-center font-owners_trial_wide_medium">No Activity was submitted yet.</p></td>
                </tr>
              @endif
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <img src="{{asset('/images/text-baseus-connect-grey.png')}}" alt="" class="w-full my-[50px]">
</div>
