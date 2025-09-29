<div class="home__mechanism relative py-[50px] min-h-screen">
  <div class="absolute top-0 left-0 w-full" id="mechanism"></div>

  <div class="absolute top-0 left-0 w-full">
    <img src="{{asset('/images/defider.png')}}" alt="" class="w-full">
  </div>

  <div class="home__mechanism-info">
    <div class="row justify-center wow fadeInDown">
      <div class="col-md-9">
        <div class="flex justify-center align-items-center my-3 lg:!mt-[100px] lg:!mb-[50px]">
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_medium mr-3">MECHANISM</p>
          <p class="text-primary-black text-[25px] md:text-[30px] lg:text-[35px] text-center font-owners_trial_wide_xblack">PROGRAM</p>
        </div>
      </div>
    </div>

    <div class="row justify-center wow fadeInUp" data-wow-delay=".3s">
      <div class="col-10 col-md-8 border-2 border-primary-black">
        <div class="row">
          <div class="col-md-2 p-0">
            <div class="relative flex flex-column justify-center h-full bg-primary-black text-center py-5">
              <img src="{{asset('/images/icon-star.png')}}" alt="" class="mx-auto mb-3">

              <p class="text-white text-[14px] lg:text-[18px] font-owners_trial_wide_medium">Kumpulkan<br class="hidden md:block" />
                poinmu<br class="hidden md:block" />
                sekarang</p>
            </div>
          </div>
        <div class="col-md-5">
          <div class="flex align-items-center h-full">
            <ol class="list-decimal pt-4 md:py-4 lg:pt-4 ps-3">
              <li class="mb-3">
                <p class="text-primary-black text-[13px]">Yuk, daftar dulu buat jadi bagian dari Baseus Connect!</p>
              </li>
              <li class="mb-3">
                <p class="text-primary-black text-[13px]">Setelah daftar, kamu bakal dapet notifikasi “Welcoming Member”. Nah, buat dapetin poin pertamamu, tinggal upload aktivitas biar makin nyambung sama Leo Buddies lainnya!</p>
              </li>
              <li>
                <p class="text-primary-black text-[13px]">Leo Buddies juga bakal ajak kamu gabung ke grup WhatsApp Baseus Connect buat seru-seruan bareng.</p>
              </li>
            </ol>
          </div>
        </div>

        <div class="col-md-5">
          <div class="flex align-items-center h-full">
            <ol class="list-decimal py-4 lg:pt-4 ps-3" start=4>
              <li class="mb-3">
                <p class="text-primary-black text-[13px]">Langsung aja ke website <a href="https://baseus.id/baseusconnect" target="_blank">baseus.id/baseusconnect</a> dan klik tombol Get Point, terus upload aktivitasmu bareng produk Baseus sesuai kategori yang tersedia.</p>
              </li>
              <li class="mb-3">
                <p class="text-primary-black text-[13px]">Kalau udah sesuai, poin bakal langsung masuk otomatis!</p>
              </li>
              <li>
                <p class="text-primary-black text-[13px]">Jangan lupa upload dan cek poinmu secara rutin ya  soalnya poinnya bisa kamu tukerin sama hadiah-hadiah keren!</p>
              </li>
            </ol>
          </div>
        </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="row justify-center wow fadeInUp" data-wow-delay=".3s">
        <div class="col-5 col-md-3"><a href="javascript:void(0);" class="JS__popup text-primary-black bg-primary-yellow border-2 border-primary-yellow text-center text-[14px] w-[150px] mx-auto my-[50px] p-2 font-owners_trial_wide_medium block transition duration-300 hover:bg-primary-white hover:border-black" data-popup="registration">JOIN NOW</a></div>
        <div class="col-5 col-md-3"><a href="#" class="text-primary-black bg-primary-white border-2 border-primary-black text-center text-[14px] w-[150px] mx-auto my-[50px] p-2 font-owners_trial_wide_medium block transition duration-300 hover:bg-primary-black hover:text-white">MECHANISM</a></div>
      </div>
    </div>
  </div>

  <img src="{{asset('/images/text-baseus-connect-grey.png')}}" alt="" class="w-full block md:hidden mb-5">

  @include('pages.frontend.home.components.mechanism-step')

</div>
