import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// ======================================== Header ======================================== //
const viewportWidth = window.innerWidth;
const header        = document.getElementById('header'),
      menuInput     = document.querySelector('.menu-toggle__input'),
      menuOverlay   = document.querySelector('.menu-toggle__overlay');

if(menuInput) {
  menuInput.addEventListener('change', function() {
    if (this.checked) {
      menuOverlay.classList.add('menu-open');
    } else {
      menuOverlay.classList.remove('menu-open');
    }
  });
}

// window.addEventListener('resize', function() {
if(viewportWidth >= 768) {
  window.addEventListener('scroll', function() {
    if (window.scrollY > 100) {
      header.classList.add('bg-primary-black'); // Add background color when scroll > 100px
      header.classList.remove('bg-transparent'); // Remove transparent background
    } else {
      header.classList.remove('bg-primary-black'); // Remove background when scroll < 100px
      header.classList.add('bg-transparent'); // Keep transparent background
    }
  });
} else {
  header.classList.add('bg-primary-black'); // Add background color when scroll > 100px
  header.classList.remove('bg-transparent'); // Remove transparent background
}
// });


// ======================================== Popup ======================================== //
const trigger           = document.getElementsByClassName('JS__popup'),
      triggerClose      = document.getElementsByClassName('JS__popup-close'),
      container         = document.querySelectorAll('.popup'),
      containerOverlay  = document.querySelectorAll('.popup__overlay');


if(trigger) {

  for (let i = 0; i < trigger.length; i++) {
    const element = trigger[i];
    // console.log(elementClose);
    element.addEventListener('click', function(e) {
      Array.from(container).forEach(
        (el) => el.classList.remove('show-popup')
      );

      const type  = this.getAttribute('data-popup');

      const elementPopup    = document.querySelector('.popup__'+type);
      elementPopup.classList.add('show-popup');
      containerOverlay[0].classList.add('show');
    });
  }
}

if(triggerClose) {
  for (let i = 0; i < triggerClose.length; i++) {
    const element = triggerClose[i];
    element.addEventListener('click', function(e) {
      Array.from(container).forEach(
        (el) => el.classList.remove('show-popup')
      );
      Array.from(containerOverlay).forEach(
        (el) => el.classList.remove('show')
      );

    });
  }
}

// ======================================== Image Input ======================================== //
const imageInput = document.getElementById('imageInput');
const previewContainer = document.getElementById('preview-container');
const preview = document.getElementById('preview');
const deleteBtn = document.getElementById('deleteBtn');

if(imageInput) {
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
}

// ======================================== Image Input Get Name ======================================== //
const fileInput = document.getElementById('fileInput');
const fileNameDisplay = document.getElementById('fileName');
const previewTextContainer = document.getElementById('preview-text-container');
const removeBtn = document.getElementById('removeBtn');

if(fileInput) {
  fileInput.addEventListener('change', function() {
    const fileInputs = this;
    if (fileInputs.files.length > 0) {
      const fileName = fileInputs.files[0].name;
      previewTextContainer.hidden = false;
      fileNameDisplay.textContent = fileName;
    }
  });

  removeBtn.addEventListener('click', function () {
    // Clear the input value
    fileInput.value = '';
    // Hide preview
    previewTextContainer.hidden = true;
    fileNameDisplay.textContent = '';
  });
}

// ======================================== Login ======================================== //
jQuery('#ajaxLoginForm').on('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  const $form = jQuery(this);
  const $spinner = $form.find('.spinner-login');
  const $btnText = $form.find('.btn-text-login');

  // Show spinner, disable form
  $spinner.removeClass('d-none');
  $btnText.text('SUBMITTING ...');
  $form.find(':input').prop('disabled', true);

  jQuery.ajax({
    url: "/login",
    method: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (res) {
      Swal.fire({
        title: 'Success',
        text: 'Login successfully!',
        icon: 'success',
        confirmButtonText: 'OK',
        customClass: {
          icon: 'swal-icon-custom'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = res.redirect;
        }
      });
    },
    error: function (xhr) {
      // Re-enable inputs and button
      $form.find(':input').prop('disabled', false);
      $spinner.addClass('d-none');
      $btnText.text('JOIN');

      if (xhr.status === 422) {
        Swal.fire({
          title: 'Validation Error',
          html: 'These credentials do not match our records,<br /> please check your email and password.',
          icon: 'error',
          confirmButtonText: 'OK',
          customClass: {
            icon: 'swal-icon-custom'
          }
        });
      } else {
        Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
      }
    }
  });
});


// ======================================== Register ======================================== //
jQuery('#myForm').on('submit', function(e) {
  e.preventDefault();

  const $form = jQuery(this);
  const formData = new FormData(this);
  const $spinner = jQuery('.spinner-border');
  const $btnText = jQuery('.btn-text');

  // Show spinner, disable form
  $spinner.removeClass('d-none');
  $btnText.text('SUBMITTING ...');
  $form.find(':input').prop('disabled', true);

  jQuery.ajax({
    url: "/register",
    method: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
      Swal.fire({
        title: 'Success',
        text: 'Form submitted successfully!',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '/profile'; // or use route if named, e.g., "{{ route('profile.index') }}"
        }
      });
    },
    error: function(xhr) {
    // Re-enable inputs and button
    $form.find(':input').prop('disabled', false);
    $spinner.addClass('d-none');
    $btnText.text('JOIN');

    // 🔁 Reset reCAPTCHA
    if (typeof grecaptcha !== "undefined") {
      grecaptcha.reset(); // for reCAPTCHA v2
    }

    if (xhr.status === 422) {
      const errors = xhr.responseJSON.errors;
      console.log(xhr.responseJSON);

      let errorMessages = '';
      for (let field in errors) {
        errorMessages += `${errors[field].join(', ')}<br>`;
      }

      Swal.fire({
        title: 'Validation Error',
        html: errorMessages,
        icon: 'error'
      });
    } else if (xhr.responseJSON && xhr.responseJSON.message) {
        // General Laravel exception message
        Swal.fire({
          title: 'Error',
          text: 'Something went wrong. Please try again later.',
          icon: 'error'
        });

      } else {
        // Catch-all fallback
        Swal.fire('Error', 'Something went wrong. Please try again later.', 'error');
      }
    }
  });
});
