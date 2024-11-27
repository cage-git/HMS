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
      jqForm = $('#package-form'),
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
          'package_name': {
            required: true
          },
          'number_of_users': {
            required: true
          },
          'number_of_hotels': {
            required: true
          },
          'number_of_invoices': {
            required: true
          },
    
         
        }
      });
    }
  });
  