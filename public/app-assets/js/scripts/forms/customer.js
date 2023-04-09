
(function (window, document, $) {
    'use strict';
    var selectAjax = $('#search_customer');
    var selectAjaxForID = $('#search_from_phone_idcard');
    var selectAjaxForPhone = $('#search_customer_from_phone');
    var selectAjaxForCompanyName = $('#search_from_company_name');
    var selectAjaxForCompanyPhone = $('#search_from_company_phone');

    // Loading remote data
    selectAjax.wrap('<div class="position-relative"></div>').select2({
        dropdownAutoWidth: true,
        dropdownParent: selectAjax.parent(),
        width: '100%',
        tags: true,
        ajax: {
        url: route_search_customer,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
            search_from_phone_idcard: params.term, 
            category: "company",
            type: "name",
            };
        },
        processResults: function (data, params) {
            return {
            results: data.customers,
            };
        },
        cache: true
        },
        placeholder: 'Search a customer',
        escapeMarkup: function (markup) {
        return markup;
        }, 
        // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo(repo) {
        // if (repo.loading) return repo.text;
        if(repo.name){
        var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.name +
        '</div>';

        if (repo.mobile) {
            markup += "<div class='select2-result-repository__description'>" + repo.mobile + '</div>';
        }
        }else{
        var markup =
        "<div class='select2-result-repository clearfix'>" +

        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.text +
        '</div>';
        }
        // $('#search_from_phone_idcard').select2().val(['repo.name']).trigger("change");
        return markup;
    }

    function formatRepoSelection(repo) {

        if (repo) {
            $('#search_from_phone_idcard').val(repo.id_card_no).trigger('change');
          }        return repo.name || repo.text;
    }


    selectAjaxForID.wrap('<div class="position-relative"></div>').select2({
        dropdownAutoWidth: true,
        dropdownParent: selectAjax.parent(),
        width: '100%',
        tags: true,
        ajax: {
        url: route_search_customer,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
            // q: params.term, // search term
            // page: params.page
            search_from_phone_idcard: params.term, 
            category: "company",
            type: "name",
            };
        },
        processResults: function (data, params) {
            
            return {
                results: data.customers,
            };
        },
        cache: true
        },
        placeholder: 'Search a customer',
        escapeMarkup: function (markup) {
        return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepoForID,
        templateSelection: formatRepoSelectionForID
    });

    function formatRepoForID(repo) {
        if(repo.name){
        var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.name +
        '</div>';

        if (repo.mobile) {
            markup += "<div class='select2-result-repository__description'>" + repo.mobile + '</div>';
        }
        }else{
        var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.text +
        '</div>';
        }

        return markup;
    }

    function formatRepoSelectionForID(repo) {
        return repo.name || repo.text;
    }


    selectAjaxForPhone.wrap('<div class="position-relative"></div>').select2({
        dropdownAutoWidth: true,
        dropdownParent: selectAjax.parent(),
        width: '100%',
        tags: true,
        ajax: {
        url: route_search_customer,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
            // q: params.term, // search term
            // page: params.page
            search_from_phone_idcard: params.term, 
            category: "user",
            type: "name",
            };
        },
        processResults: function (data, params) {
            
            return {
                results: data.customers,
            };
        },
        cache: true
        },
        placeholder: 'Search a guest',
        escapeMarkup: function (markup) {
        return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepoForID,
        templateSelection: formatRepoSelectionForID
    });

    function formatRepoForID(repo) {
        if(repo.name){
        var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.name +
        '</div>';

        if (repo.mobile) {
            markup += "<div class='select2-result-repository__description'>" + repo.mobile + '</div>';
        }
        }else{
        var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.text +
        '</div>';
        }

        return markup;
    }

    function formatRepoSelectionForID(repo) {
        return repo.name || repo.text;
    }


    selectAjaxForCompanyPhone.wrap('<div class="position-relative"></div>').select2({
        dropdownAutoWidth: true,
        dropdownParent: selectAjax.parent(),
        width: '100%',
        tags: true,
        ajax: {
        url: route_search_customer,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
            // q: params.term, // search term
            // page: params.page
            search_from_phone_idcard: params.term, 
            category: "user",
            type: "name",
            };
        },
        processResults: function (data, params) {
            
            return {
                results: data.customers,
            };
        },
        cache: true
        },
        placeholder: 'Search a company',
        escapeMarkup: function (markup) {
        return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepoForID,
        templateSelection: formatRepoSelectionForID
    });

    function formatRepoForID(repo) {
        if(repo.name){
        var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.name +
        '</div>';

        if (repo.mobile) {
            markup += "<div class='select2-result-repository__description'>" + repo.mobile + '</div>';
        }
        }else{
        var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.text +
        '</div>';
        }

        return markup;
    }

    function formatRepoSelectionForID(repo) {
        return repo.name || repo.text;
    }

    
    selectAjaxForCompanyName.wrap('<div class="position-relative"></div>').select2({
        dropdownAutoWidth: true,
        dropdownParent: selectAjax.parent(),
        width: '100%',
        tags: true,
        ajax: {
        url: route_search_customer,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
            // q: params.term, // search term
            // page: params.page
            search_from_phone_idcard: params.term, 
            category: "company",
            type: "name",
            };
        },
        processResults: function (data, params) {
            return {
                results: data.customers,
            };
        },
        cache: true
        },
        placeholder: 'Search a company',
        escapeMarkup: function (markup) {
        return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepoForID,
        templateSelection: formatRepoSelectionForID
    });

    function formatRepoForID(repo) {
        if(repo.name){
        var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.name +
        '</div>';

        if (repo.mobile) {
            markup += "<div class='select2-result-repository__description'>" + repo.mobile + '</div>';
        }
        }else{
        var markup =
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        repo.text +
        '</div>';
        }

        return markup;
    }

    function formatRepoSelectionForID(repo) {
        return repo.name || repo.text;
    }


})(window, document, jQuery);


$(document).on('change', '#search_customer', function(){
    var val = $('#search_customer').val();      
    var guest_type = $('input:radio[name="guest_type"]:checked').val();
    getAjaxResponse('idcard_select_div', val, 'user', guest_type, 'search_idcard');
});

$(document).on('change', '#search_from_phone_idcard', function(){
    console.log("test");
    var val = $('#search_from_phone_idcard').val();
    console.log("user id card or mobile phone", val)      
    var guest_type = $('input:radio[name="guest_type"]:checked').val();
    getAjaxResponse('idcard_select_div', val, 'user', guest_type, 'search_idcard');
});

$(document).on('change', '#search_customer_from_phone', function(){
    var val = $('#search_customer_from_phone').val();      
    console.log("user mobile phone", val)     
    var guest_type = $('input:radio[name="guest_type"]:checked').val();
    // getAjaxResponse('idcard_select_div', val, 'user', guest_type, 'search_idcard');
    getAjaxResponse('mobile_select_div', val, 'user', guest_type, 'search_phone');
});

$(document).on('change', '#search_from_company', function(){
    var val = $('#search_from_company').val();      
    getAjaxResponse('companyname_select_div', val, 'company', 'new_company', 'search_companyname');
});

$(document).on('change', '#search_from_company_phone', function(){
    var val = $('#search_from_company_phone').val();      
    var guest_type = $('input:radio[name="guest_type"]:checked').val();
    // getAjaxResponse('idcard_select_div', val, 'company', guest_type, 'search_idcard');
    getAjaxResponse('companyphone_select_div', val, 'company', guest_type, 'search_companyphone');
});



$(document).on('change', '#search_from_company_name', function(){
    var val = $('#search_from_company_name').val();      
    var guest_type = $('input:radio[name="guest_type"]:checked').val();
    getAjaxResponse('idcard_select_div', val, 'company', guest_type, 'search_idcard');
});

function getAjaxResponse(div_id, val, category, guest_type, field_id){
         // var formData = new FormData(this);
        // var search_from_phone_idcard = $("#search_from_phone_idcard").val();
        $.ajax({
            type:'GET',
            url: route_search_customer,
            data: {
                search_from_phone_idcard  : val,
                category: category,
            },
            dataType: "json",
            success:function(data){
                // alert( "success");
                // if(typeof(data) !== 'undefined' ){
                // console.log(data.customers[0], "success");
                    var data = data.customers[0]; 
                    if(data){
                        if(data.cat && data.cat == "user"){
                            setCustomerData(data, div_id);
                        }else if(data.cat && data.cat == "company"){
                            setCompanydata(data, div_id);
                        }
                    }else{
                        // console.log("data not found", div_id, val, category, guest_type, field_id);
                        if(field_id == "search_idcard"){
                            $("#idcard_no").val(val);
                        }else if(field_id == "search_phone"){
                            $("#mobile").val(val);
                        }else if(field_id == "search_companyname"){
                            $("#company_name").val(val);
                            $("#guest_type_category").val("new_company");
                        }else if(field_id == "search_companyphone"){
                            $("#company_mobile").val(val); 
                            $("#guest_type_category").val("new_company");
                        }
                    }
            },
            error: function(error){
                console.log("error", error);
            }
        });
    }


    function setCompanydata(data_customer, id){

    //   console.log("company data");
      if(id == "companyname_select_div"){
          $('#idcard_input_div').show();
          $('#idcard_select_div').hide();
          $('#companyphone_input_div').show();
          $('#companyphone_select_div').hide();
      }else if(id == "idcard_select_div"){
          $('#companyname_select_div').hide();
          $('#companyname_input_div').show();
          $('#companyphone_input_div').show();
          $('#companyphone_select_div').hide();
      }else if(id == "companyphone_select_div"){
          $('#companyname_select_div').hide();
          $('#companyname_input_div').show();
          $('#idcard_input_div').show();
          $('#idcard_select_div').hide();
      }

      $("#company_name").val(data_customer.name);
      $('#guest_type_category').val('existing_company');
      $("#company_gst_num").val(data_customer.company_gst_num);
      $("#type_of_ids_selector").val(data_customer.idcard_type);
      $("#company_email").val(data_customer.email);
      $("#company_mobile").val(data_customer.mobile);                
      $("#company_address").val(data_customer.address);
      $("#company_country").val(data_customer.country);
      $("#company_state").val(data_customer.state);
      $("#company_city").val(data_customer.city);
      $("#selected_customer_id").val(data_customer.id);
      if(data_customer.dob !=""){
          $("#dob").val(data_customer.dob);
      }else{
          $("#dob").val("");
      }

      }

  function setCustomerData(data_customer, id){
      // console.log(id);
      // setCustomerNull();
      if(id == "mobile_select_div"){
          $('#idcard_input_div').show();
          $('#idcard_select_div').hide();
      }else if(id == "idcard_select_div"){
          $('#mobile_input_div').show();
          $('#mobile_select_div').hide();
      }

      $('#guest_type_category').val('existing');
      $("#idcard_no").val(data_customer.id_card_no);
      $("#type_of_ids_selector").val(data_customer.idcard_type);
      $("#mobile").val(data_customer.mobile);
      $("#surname").val(data_customer.surname);
      $("#name").val(data_customer.name);
      $("#middle_name").val(data_customer.namiddle_nameme);
      $("#email").val(data_customer.email);
      $("#address").val(data_customer.address);
      $("#country").val(data_customer.country);
      $("#state").val(data_customer.state);
      $("#city").val(data_customer.city);
      $("#gender").val(data_customer.gender);
      $("#dob").val(data_customer.dob);
      $("#selected_customer_id").val(data_customer.id);
      if(data_customer.dob !=""){
          $("#dob").val(data_customer.dob);
      }else{
          $("#dob").val("");
      }
  }

  function setCompanyNull(){
      $('#guest_type_category').val('new');
      $("#company_name").val('');
      $("#company_gst_num").val('');
      $("#type_of_ids_selector").val('');
      $("#company_email").val('');
      $("#company_mobile").val('');                
      $("#company_address").val('');
      $("#company_country").val('');
      $("#company_state").val('');
      $("#company_city").val('');
      $("#selected_customer_id").val('');
      }

      function setCustomerNull(){
      $('#guest_type_category').val('new');
      $("#type_of_ids_selector").val('');
      $("#surname").val('');
      $("#name").val('');
      $("#middle_name").val('');
      $("#email").val('');
      $("#mobile").val('');
      $("#address").val('');
      $("#country").val('');
      $("#state").val('');
      $("#city").val('');
      $("#gender").val('');
      $("#dob").val('');
      $("#selected_customer_id").val('');
  }

