<div class="redeem__form pt-[50px] pb-0 lg:!py-[50px]">
  <div class="container relative z-1">
    <div class="row justify-center">
        @if(count($prizeDropdown) == 0)
        <div class="col-md-8">
          <p class="text-primary-black text-center font-owners_trial_wide_medium text-[25px] md:text-[30px] lg:text-[40px] py-0 md:!py-[30px] lg:!py-[50px]">Oops, Redeem Not Available</p>
        @else
        <div class="col-md-6">
          <form action="{{ route('redeem.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            <div class="">
              <select name="prize_id" id="prize_id" class="block w-full border-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 p-3 text-gray-400 font-owners_trial_wide_medium">
                @foreach ($prizeDropdown as $item)
                  <option value="{{$item->id}}"><b class="font-owners_trial_wide_xblack mr-3">{{$item->point}} PTS</b> - {{$item->name}}</option>
                @endforeach
              </select>

              <x-input-error :messages="$errors->get('prize_id')" class="mt-2" />
            </div>

            <button class="block mx-auto bg-primary-yellow border-2 border-primary-yellow hover:bg-primary-white  text-primary-black font-bold py-2 px-4 transition duration-300" type="submit">SUBMIT</button>

          </form>
        @endif
      </div>
    </div>
  </div>

  <img src="{{asset('/images/text-baseus-connect-grey.png')}}" alt="" class="w-full my-[50px]">
</div>
