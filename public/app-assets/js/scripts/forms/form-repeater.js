/*=========================================================================================
    File Name: form-repeater.js
    Description: form repeater page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy HTML Admin Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';
  console.log("testing");
  // form repeater jquery
  $('.invoice-repeater').repeater({
    
    show: function () {
      console.log("test");
      $(this).slideDown();
      // Feather Icons
      if (feather) {
        feather.replace({ width: 14, height: 14 });
      }
    },
    hide: function (deleteElement) {
      if (confirm('Are you sure you want to delete this element?')) {
        $(this).slideUp(deleteElement);
      }
    }
  });

    // form repeater jquery
    $('.banner-repeater').repeater({
      show: function () {

        $(this).slideDown();
        // Feather Icons
        if (feather) {
          feather.replace({ width: 14, height: 14 });
        }
      },
      hide: function (deleteElement) {
        if (confirm('Are you sure you want to delete this element?')) {
          $(this).slideUp(deleteElement);
        }
      }
    });


        // form repeater jquery
        $('.amenties-repeater, .repeater-default').repeater({
    
          show: function () {
            console.log("test");
            $(this).slideDown();
            // Feather Icons
            if (feather) {
              feather.replace({ width: 14, height: 14 });
            }
          },
          hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
              $(this).slideUp(deleteElement);
            }
          }
        });


            // form repeater jquery
    $('.counter-repeater').repeater({
    
      show: function () {
        console.log("test");
        $(this).slideDown();
        // Feather Icons
        if (feather) {
          feather.replace({ width: 14, height: 14 });
        }
      },
      hide: function (deleteElement) {
        if (confirm('Are you sure you want to delete this element?')) {
          $(this).slideUp(deleteElement);
        }
      }
    });


        // form repeater jquery
        $('.feature-repeater, .repeater-default').repeater({
    
          show: function () {
            console.log("test");
            $(this).slideDown();
            // Feather Icons
            if (feather) {
              feather.replace({ width: 14, height: 14 });
            }
          },
          hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
              $(this).slideUp(deleteElement);
            }
          }
        });



         // form repeater jquery
         $('.feature-repeater, .repeater-default').repeater({
    
          show: function () {
            console.log("test");
            $(this).slideDown();
            // Feather Icons
            if (feather) {
              feather.replace({ width: 14, height: 14 });
            }
          },
          hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
              $(this).slideUp(deleteElement);
            }
          }
        });

         // form repeater jquery
         $('.features-repeater, .repeater-default').repeater({
    
          show: function () {
            console.log("test");
            $(this).slideDown();
            // Feather Icons
            if (feather) {
              feather.replace({ width: 14, height: 14 });
            }
          },
          hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
              $(this).slideUp(deleteElement);
            }
          }
        });

         // form repeater jquery
         $('.features-repeater, .repeater-default').repeater({
    
          show: function () {
            console.log("test");
            $(this).slideDown();
            // Feather Icons
            if (feather) {
              feather.replace({ width: 14, height: 14 });
            }
          },
          hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
              $(this).slideUp(deleteElement);
            }
          }
        });

         // form repeater jquery
         $('.features-repeater, .repeater-default').repeater({
    
          show: function () {
            console.log("test");
            $(this).slideDown();
            // Feather Icons
            if (feather) {
              feather.replace({ width: 14, height: 14 });
            }
          },
          hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
              $(this).slideUp(deleteElement);
            }
          }
        });

         // form repeater jquery
         $('.feature-repeater, .repeater-default').repeater({
    
          show: function () {
            console.log("test");
            $(this).slideDown();
            // Feather Icons
            if (feather) {
              feather.replace({ width: 14, height: 14 });
            }
          },
          hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
              $(this).slideUp(deleteElement);
            }
          }
        });
         // form repeater jquery
         $('.features-repeater, .repeater-default').repeater({
    
          show: function () {
            console.log("test");
            $(this).slideDown();
            // Feather Icons
            if (feather) {
              feather.replace({ width: 14, height: 14 });
            }
          },
          hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
              $(this).slideUp(deleteElement);
            }
          }
        });


});
