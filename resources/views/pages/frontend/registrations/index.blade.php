@extends('layouts.app-frontend')
  @section('content')

    @if($registrations->count() <=200)
        @include('pages.frontend.registrations.components.top')

        @include('pages.frontend.registrations.components.form')
    @else
      <div class="registrations__top relative pt-[50px] md:pt-[100px] pb-[50px]">
        <div class="container">
          <div class="row justify-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
              <div class="relative">
                <div class="registrations__racepack-inner bg-primary-white border-2 border-primary-black rounded-xl overflow-hidden">

                  <div class="registrations__racepack-text p-[30px] pb-[100px] sm:pb-[200px] md:pb-[230px]">
                    <h2 class="registrations__racepack-title text-[35px] sm:text-[45px] md:text-[55px] lg:text-[75px] font-museo font-bold text-primary-pink text-center mb-2">Oops, Sold Out!</h2>

                    <p class="font-roboto text-primary-black font-bold text-[18px] md:text-[20px] text-center">Looks like you’re a little late,<br class="block md:hidden"/> tickets are all gone!<br /> Stay tuned for future updates!</p>
                  </div>

                  <div class="registrations__racepack-inner-bottom relative bg-primary-pink border-t-2 border-primary-black h-[50px]">
                    <img src="{{asset('/images/icon-seeyou-2.png')}}" alt="" class="absolute bottom-0 right-[5%] sm:right-[20%] md:right-[130px] w-[175px] sm:w-[300px] md:w-auto translate-x-[-50%] sm:translate-x-0">
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  @endsection
