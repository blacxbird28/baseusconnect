<div class="registrations__form relative py-[50px]">
  <div class="container">
    <div class="row justify-center">

      <div class="col-md-12 col-lg-10 col-xl-8">
        <h2 class="font-museo font-bold text-primary-pink text-[40px] md:text-[50px] text-center wow fadeInUp" data-wow-duration="1s">Yuk, isi data dirimu</h2>

        <form action="{{ route('registrations.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="py-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
            <!-- Name -->
            <div class="mb-3">
              <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" placeholder="Nama" value="{{ old('nama') }}" autofocus />

              @error('nama')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- No KTP -->
            <div class="mb-3">
              <x-text-input id="no_ktp" name="no_ktp" type="text" class="mt-1 block w-full" placeholder="No KTP" value="{{ old('no_ktp') }}" autofocus />

              @error('no_ktp')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Domisili -->
            <div class="mb-3">
              <select name="domisili" id="domisili" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option selected disabled>Domisili</option>
                @foreach($location as $item)
                  <option value="{{ $item }}" {{ old('domisili') == $item ? 'selected' : '' }}>{{ $item }} </option>
                @endforeach
              </select>

              @error('domisili')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Alamat -->
            <div class="mb-3">
              <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" placeholder="Alamat" value="{{ old('alamat') }}" autofocus />

              @error('alamat')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
              <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" placeholder="Email" value="{{ old('email') }}" autofocus />

              @error('email')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- No HP -->
            <div class="mb-3">
              <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" placeholder="No HP" value="{{ old('no_hp') }}" autofocus />

              @error('no_hp')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-3">
              <x-text-input id="tgl_lahir" name="tgl_lahir" type="text" class="mt-1 block w-full" placeholder="Tanggal Lahir" value="{{ old('tgl_lahir') }}" autofocus />

              @error('tgl_lahir')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
              <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Jenis Kelamin">
                <option disabled selected>Jenis Kelamin</option>
                <option value="Laki Laki" {{ old('gender') == 'Laki Laki' ? 'selected' : '' }}>Laki Laki</option>
                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
              </select>

              @error('gender')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Golongan Darah -->
            <div class="mb-3">
              <select name="gol_darah" id="gol_darah" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Golongan Darah">
                <option disabled selected>Golongan Darah</option>
                <option value="A" {{ old('gol_darah') == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('gol_darah') == 'B' ? 'selected' : '' }}>B</option>
                <option value="AB" {{ old('gol_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                <option value="O" {{ old('gol_darah') == 'O' ? 'selected' : '' }}>O</option>
              </select>

              @error('gol_darah')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Pekerjaan -->
            <div class="mb-3">
              <x-text-input id="job" name="job" type="text" class="mt-1 block w-full" placeholder="Pekerjaan" value="{{ old('job') }}" autofocus />

              @error('job')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Emergency Contact -->
            <div class="mb-3">
              <x-text-input id="emergency_contact_name" name="emergency_contact_name" type="text" class="mt-1 block w-full" placeholder="Nama Kontak Darurat" value="{{ old('emergency_contact_name') }}" autofocus />

              @error('emergency_contact_name')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Emergency Contact Number -->
            <div class="mb-3">
              <x-text-input id="emergency_contact_number" name="emergency_contact_number" type="text" class="mt-1 block w-full" placeholder="Nomor Kontak Darurat" value="{{ old('emergency_contact_number') }}" autofocus />

              @error('emergency_contact_number')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Nomor BIB -->
            {{--<div class="mb-3">
              <x-text-input id="bib_number" name="bib_number" type="text" class="mt-1 block w-full" placeholder="Nomor BIB" value="{{ old('bib_number') }}" autofocus />

              @error('bib_number')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>--}}

            <!-- Size -->
            <div class="mb-3">
              <select name="size" id="size" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Size Jersey">
                <option disabled selected>Size Jersey</option>
                <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                <option value="XXL" {{ old('size') == 'XXL' ? 'selected' : '' }}>XXL</option>
              </select>

              @error('size')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Community Name -->
            <div class="mb-3">
              <x-text-input id="community_name" name="community_name" type="text" class="mt-1 block w-full" placeholder="Nama Grup Lari" value="{{ old('community_name') }}" autofocus />

              @error('community_name')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Kondisi Medis Khusus -->
            <div class="mb-3">
              <x-text-input id="medical_record" name="medical_record" type="text" class="mt-1 block w-full" placeholder="Kondisi Medis Khusus" value="{{ old('medical_record') }}" autofocus />

              @error('medical_record')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            {{--<div class="mb-3">
              <div class="row">
                <div class="col-md-4">
                  <x-text-input id="hh" name="hh" type="text" class="mt-1 block w-full" placeholder="HH" value="{{ old('hh') }}" autofocus />
                </div>

                <div class="col-md-4">
                  <x-text-input id="mm" name="mm" type="text" class="mt-1 block w-full" placeholder="MM" value="{{ old('mm') }}" autofocus />
                </div>

                <div class="col-md-4">
                  <x-text-input id="ss" name="ss" type="text" class="mt-1 block w-full" placeholder="SS" value="{{ old('ss') }}" autofocus />
                </div>
              </div>
            </div>--}}

            <!-- Partner Description -->
            <div class="mb-3">
              <x-text-input id="partner_desc" name="partner_desc" type="text" class="mt-1 block w-full" placeholder="Ceritain kriteria partner in love" value="{{ old('partner_desc') }}" autofocus />

              @error('partner_desc')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Instagram -->
            <div class="mb-3">
              <x-text-input id="instagram" name="instagram" type="text" class="mt-1 block w-full" placeholder="Username Instagram" value="{{ old('instagram') }}" autofocus />

              @error('instagram')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- TikTok -->
            <div class="mb-3">
              <x-text-input id="tiktok" name="tiktok" type="text" class="mt-1 block w-full" placeholder="Username Tiktok" value="{{ old('tiktok') }}" autofocus />

              @error('tiktok')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <!-- Uoload Transfer -->
            <div class="mb-3">
              <div class="upload-btn-wrapper relative overflow-hidden inline-block">
                <button class="btn border-2 border-primary-black rounded-xl py-[8px] px-[20px] text-primary-white bg-primary-black hover:border-primary-black">Upload bukti pembayaran</button>
                <input type="file" name="upload_transfer" class="absolute left-0 opacity-0" />
              </div>

              @error('upload_transfer')
                <div class="text-xs text-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <div class="flex">
                <input type="checkbox" name="agreement_1" id="agreement_1" class="relative top-[4px] mr-[10px]">
                <label for="agreement_1">Saya sudah membaca dan menyetujui bahwa informasi pribadi yang diberikan akan digunakan dan dilindungi oleh Baseus. </label>
              </div>
            </div>

            <div class="mb-3">
              <div class="flex">
                <input type="checkbox" name="agreement_2" id="agreement_2" class="relative top-[4px] mr-[10px]">
                <label for="agreement_2">Saya sudah membaca dan menyetujui ketentuan Baseus Meet N Run 2025.</label>
              </div>
            </div>

            <div class="mb-3">

                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                @error('g-recaptcha-response')
                <br /><div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
              <button type="submit" class="relative block max-w-[280px] bg-primary-yellow border-2 border-primary-black rounded-full text-[16px] md:text-[20px] font-roboto font-bold text-primary-black py-[10px] px-[40px] text-center mx-auto transition duration-300
              hover:bg-primary-black hover:text-primary-yellow" id="submit-btn" disabled>Submit</button>

            </div>
          </div>
        </form>

        <p class="font-bold text-[14px]">Syarat dan Ketentuan</p>
        <ul class="text-[12px]">
          <li>- Tiket tidak dapat dikembalikan atau dialihkan.</li>
          <li>- Email konfirmasi pembelian harus ditunjukkan saat pengambilan race pack bersama dengan identitas yang valid.</li>
          <li>- Peserta harus mematuhi jadwal acara dan waktu check-in.</li>
          <li>- Peserta yang datang terlambat tidak dapat diakomodasi.</li>
          <li>- Diharuskan mengenakan pakaian dan sepatu lari yang sesuai.</li>
          <li>- Peserta wajib mengikuti semua instruksi demi keamanan.</li>
          <li>- Pembayaran hanya melalui rekening BCA 2040714050 a.n SELALU SENANG KARYA PT.</li>
        </ul>

      </div>
    </div>
  </div>
</div>

@section('customscript')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const agreement_1 = document.getElementById('agreement_1');
    const agreement_2 = document.getElementById('agreement_2');
    const submitBtn   = document.getElementById('submit-btn');

    // Disable the submit button initially
    submitBtn.disabled = !agreement_1.checked;

    // Enable/Disable submit button when agreement_1 is toggled
    agreement_1.addEventListener('change', function() {
        submitBtn.disabled = !agreement_1.checked;
    });
  });

  jQuery(document).ready(function() {
    jQuery( function() {
      jQuery( "#tgl_lahir" ).datepicker({
        dateFormat: 'yy-mm-dd', // This is the default format MM/DD/YYYY
        changeYear: true, // Allow changing the year
        changeMonth: true, // Allow changing the month
        defaultViewDate: new Date(1990, 0, 1) // Optional: Start view from January 1990
    });
    } );
  });
</script>
@endsection
