<div class="activity__form py-[50px]">
  <div class="container relative z-1">
    <div class="row justify-center">
      <div class="col-md-6">
        <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <select name="activity_id" id="activity_id" class="block w-full border-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 p-3 text-gray-400 font-owners_trial_wide_medium">
              @foreach ($activity as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
              @endforeach
            </select>

            <x-input-error :messages="$errors->get('activity_id')" class="mt-2" />
          </div>

          <div class="mb-3">
            <div class="relative border-2 border-gray-300">
              <input id="imageInput" type="file" name="images" class="relative w-100 z-3 opacity-0 py-[20px] px-3">
              <div class="absolute flex top-[8px] left-[2px] py-0 px-[10px] lg:p-[10px] bg-primary-white">
                <img src="{{asset('/images/icon-upload.png')}}" alt="" class="w-[26px] h-auto object-contain mr-3">
                <p class="text-gray-400 font-owners_trial_wide_medium">Upload profile picture<br /> <span class="text-[12px]">(Max. file 2mb)</span></p>
              </div>
            </div>

            <x-input-error :messages="$errors->get('images')" class="mt-2" />
          </div>

          <div id="preview-container" class="relative w-[250px] h-[250px] overflow-hidden" hidden>
            <img id="preview" src="" alt="Image preview will appear here" class=" w-full h-full object-contain object-center">
            <button id="deleteBtn" class="absolute top-2 right-2 block mx-auto bg-primary-red border-2 border-primary-red hover:bg-primary-white hover:text-primary-red text-primary-white font-bold p-2 transition duration-300 rounded-lg" type="button">Delete</button>
          </div>

          <div class="my-5">
            <button class="block mx-auto bg-primary-yellow border-2 border-primary-yellow hover:bg-primary-white text-primary-black font-bold py-2 px-4 transition duration-300" type="submit">SUBMIT</button>
          </div>
        </form>
      </div>
    </div>

    <div class="w-[80%] h-1 border-b-2 border-gray-400 mx-auto"></div>
  </div>
</div>

@section('customscript')
  <script>
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('preview-container');
    const preview = document.getElementById('preview');
    const deleteBtn = document.getElementById('deleteBtn');

    imageInput.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
          preview.src = e.target.result;
          previewContainer.hidden = false;
        }

        reader.readAsDataURL(file);
      } else {
        preview.src = '';
        previewContainer.hidden = true;
      }
    });

    deleteBtn.addEventListener('click', function () {
      // Clear the input value
      imageInput.value = '';
      // Hide preview
      preview.src = '';
      previewContainer.hidden = true;
    });
  </script>
@endsection
