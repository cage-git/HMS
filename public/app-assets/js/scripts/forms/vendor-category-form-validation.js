/*=========================================================================================
  File Name: form-validation.js
  Description: jquery bootstrap validation js
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  var bootstrapForm = $('.needs-validation'),
    jqForm = $('#vendor-category-form'),
    picker = $('.picker'),
    select = $('.select2');

  // select2
  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this
      .select2({
        placeholder: 'Select value',
        dropdownParent: $this.parent()
      })
      .change(function () {
        $(this).valid();
      });
  });

  // Picker
  if (picker.length) {
    picker.flatpickr({
      allowInput: true,
      onReady: function (selectedDates, dateStr, instance) {
        if (instance.isMobile) {
          $(instance.mobileInput).attr('step', null);
        }
      }
    });
  }

  // Bootstrap Validation
  // --------------------------------------------------------------------
  if (bootstrapForm.length) {
    Array.prototype.filter.call(bootstrapForm, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          form.classList.add('invalid');
        }
        form.classList.add('was-validated');
        event.preventDefault();
        // if (inputGroupValidation) {
        //   inputGroupValidation(form);
        // }
      });
      // bootstrapForm.find('input, textarea').on('focusout', function () {
      //   $(this)
      //     .removeClass('is-valid is-invalid')
      //     .addClass(this.checkValidity() ? 'is-valid' : 'is-invalid');
      //   if (inputGroupValidation) {
      //     inputGroupValidation(this);
      //   }
      // });
    });
  }

  // jQuery Validation
  // --------------------------------------------------------------------
  if (jqForm.length) {
    jqForm.validate({
      rules: {
        'name': {
          required: true
        },
        // 'vendor_name': {
        //   required: true
        // },
        // 'vendor_email': {
        //   required: true
        // },
        // 'vendor_mobile': {
        //   required: true
        // },
        // 'vendor_phone': {
        //   required: true
        // },
        // 'vendor_address': {
        //   required: true
        // },
        // 'vendor_country': {
        //   required: true
        // },
        // 'vendor_state': {
        //   required: true
        // },
        // 'vendor_city': {
        //   required: true
        // },
        // 'vendor_gst_num': {
        //   required: true
        // },
        // 'contact_person_name': {
        //   required: true
        // },
        // 'contact_person_mobile': {
        //   required: true
        // },
        // 'contact_person_email': {
        //   required: true
        // },
        // 'basic-default-email': {
        //   required: true,
        //   email: true
        // },
        // 'basic-default-password': {
        //   required: true
        // },
        // 'confirm-password': {
        //   required: true,
        //   equalTo: '#basic-default-password'
        // },
        // 'select-country': {
        //   required: true
        // },
        // dob: {
        //   required: true
        // },
        // customFile: {
        //   required: true
        // },
        // validationRadiojq: {
        //   required: true
        // },
        // validationBiojq: {
        //   required: true
        // },
        // validationCheck: {
        //   required: true
        // }
      }
    });
  }
});