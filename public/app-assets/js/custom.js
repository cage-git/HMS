"use strict";


/* ***** start swal alert ***** */
    $(document).on('click','.delete_btn',function(){
    	var deleteUrl = $(this).data('url');
    	swal({
    	  title: 'Are you sure?',
    	  text: "You won't be able to revert this!",
    	  type: 'warning',
    	  showCancelButton: true,
    	  confirmButtonColor: '#3085d6',
    	  cancelButtonColor: '#d33',
    	  confirmButtonText: 'Yes, delete it!'
    	}).then(function (result) {
    	  if (result.value) {
    	    window.location.href=deleteUrl;
    	  }
    	});
    });
    $(document).on('click','.confirm_btn',function(){
        var url = $(this).data('url');
        swal({
          title: 'Are you sure?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Confirm!'
        }).then(function (result) {
          if (result.value) {
            window.location.href=url;
          }
        });
    });
/* ***** start swal alert ***** */

