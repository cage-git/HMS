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
      jqForm = $('#add-business-form'),
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
        });
      });
    }
  
    // jQuery Validation
    // --------------------------------------------------------------------
    if (jqForm.length) {
      jqForm.validate({
        rules: {
          'business_name': {
            required: true
          },
          'start_date': {
            required: true
          },
          'end_date': {
            required: true
          },
          'mobile': {
            required: true,
            minlength:10,
            maxlength:10
          },
          'country': {
            required: true
          },
          'business_logo': {
            required: true
          },
          'email': {
            required: true
          },
          'Password': {
            required: true
          },
         
        }
      });
    }
  });
  