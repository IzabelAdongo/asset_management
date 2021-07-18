// Import Jquery


let global_false_numeric_value=0;
let global_true_numeric_value=1;
let admin_function=3;
let store_keeper_function =2;
let view_page=1;
let list_view=0;
let phoneInputField = document.querySelector("#phone_number");
let phoneInput = window.intlTelInput(phoneInputField, {
  initialCountry: "KE",
  geoIpLookup: getIp,
  utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
 });
 function getIp(callback) {
  fetch('https://ipinfo.io/json?token=78884ebd952828', { headers: { 'Accept': 'application/json' }})
    .then((resp) => resp.json())
    .catch(() => {
      return {
        country: 'us',
      };
    })
    .then((resp) => callback(resp.country));
 }
function load_add_edit_devices_page(device_id, add_edit_device_url,user_function){
 
    $.ajax({
        method: "POST",
        url: add_edit_device_url,
        // data: $('myLoginForm').serialize()
        data:{device_id:device_id,user_function:user_function}
      })
        .done(function( htmldata ) {
            $('#admin_main_container').html(htmldata);
        });


}
function add_update_device_info(add_update_device_info_url){
 

    var device_state_id =$('#device_state_id').val();
    var device_name =$('#device_name').val();
    var device_serial_no =$('#device_serial_no').val();
    var device_imei_no =$('#device_imei_no').val();
    var device_status =$('#device_status').val();
    var asset_tag_number =$('#asset_tag_number').val();
    var device_id =$('#device_id').val();
    var redirect_url =$('#redirect_url').val();
    var reason_for_return_id =$('#reason_for_return_id').val();
    var is_returned =$('#is_returned').val();
    var reason_for_returning_description =$('#reason_for_returning_description').val();
    let user_function=$('#user_function').val();
    let redirect_url_store_keeper=$('#redirect_url_store_keeper').val();
    let admin_function_edit=$('#admin_function_edit').val();

    let required_device_name_message =$('#required_device_name_message').val();
    let required_device_serial_no_message =$('#required_device_serial_no_message').val();
    let required_device_imei_no_message =$('#required_device_imei_no_message').val();
    let required_asset_tag_no_message =$('#required_asset_tag_no_message').val();
    let required_return_id_message =$('#required_return_id_message').val();

    let valid_reason_for_return_id=global_true_numeric_value;
    if(reason_for_return_id<=global_false_numeric_value){
      valid_reason_for_return_id=global_false_numeric_value;
    }
  
    
      if(admin_function_edit==admin_function){ 
       
        $validation_string =(ValidateStringValue(device_name)==global_true_numeric_value && ValidateStringValue(device_serial_no)==global_true_numeric_value&& ValidateStringValue(device_imei_no)==global_true_numeric_value&& ValidateStringValue(asset_tag_number)==global_true_numeric_value);
      }else
      if (admin_function_edit==store_keeper_function)
      {
        $validation_string =(ValidateStringValue(device_name)==global_true_numeric_value && ValidateStringValue(device_serial_no)==global_true_numeric_value&& ValidateStringValue(device_imei_no)==global_true_numeric_value&& ValidateStringValue(asset_tag_number)==global_true_numeric_value&&(valid_reason_for_return_id==global_true_numeric_value));

      }
  if($validation_string){
  
    
    swal({
      title: "Are you sure?",
      text: "This action will save this data!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
    $.ajax({
        method: "POST",
        url: add_update_device_info_url,
        // data: $('myLoginForm').serialize()
        data:{device_state_id:device_state_id, device_name:device_name,device_serial_no:device_serial_no, device_imei_no:device_imei_no, device_id:device_id, asset_tag_number:asset_tag_number,device_status:device_status,reason_for_return_id:reason_for_return_id,reason_for_returning_description:reason_for_returning_description,is_returned:is_returned}
      })
        .done(function( msg ) {
          var json = JSON.parse(msg);
          $.each(json, function (index, value)
          {
              if (index === 'success')
              {
                swal("Success", ""+value+"", "success");
                $('#main_modal').modal('hide');

                if(user_function==admin_function){

                load_all_devices_table(redirect_url);

                }else{
                global_load_all_table_to_dashboard_div(redirect_url_store_keeper);
                }
              
           
              }else{
                  swal("Error", ""+value+"", "error");
           
              }
              });

          
        });
      }else{
        swal("Cancelled", "You have cancelled safely :)", "error");
      
      }
    })
      }else{
        if(ValidateStringValue(device_name)==global_false_numeric_value){
          add_input_error_class('device_name', 'device_name_span_id', required_device_name_message);
        }
        if(ValidateStringValue(device_serial_no)==global_false_numeric_value){
          add_input_error_class('device_serial_no', 'device_serial_no_span_id', required_device_serial_no_message);
        }
        if(ValidateStringValue(device_imei_no)==global_false_numeric_value){
          add_input_error_class('device_imei_no', 'device_imei_no_span_id', required_device_imei_no_message);
         }
        if(ValidateStringValue(asset_tag_number)==global_false_numeric_value){
          add_input_error_class('asset_tag_number', 'asset_tag_number_span_id', required_asset_tag_no_message);
        }
        if(admin_function_edit==store_keeper_function){
        if(valid_reason_for_return_id==global_false_numeric_value){
          add_input_error_class('reason_for_return_id', 'reason_for_return_id_span_id', required_return_id_message);
        }
        }

      }
  
}
function load_add_edit_region_page(registration_office_id, add_edit_region_url){
    $.ajax({
        method: "POST",
        url: add_edit_region_url,
        data:{registration_office_id:registration_office_id}
      })
        .done(function( htmldata ) {
            $('#admin_main_container').html(htmldata);
        });


}
function add_update_region_info(add_update_region_info_url){

    var sub_county_id_fk =$('#sub_county_id_fk').val();
    var registration_offce_id_fk =$('#registration_offce_id_fk').val();
    var region_telephone =$('#region_telephone').val();
    var region_id =$('#region_id').val();
    var redirect_url =$('#redirect_url').val();

    
  
    $.ajax({
        method: "POST",
        url: add_update_region_info_url,
        // data: $('myLoginForm').serialize()
        data:{registration_offce_id_fk:registration_offce_id_fk, sub_county_id_fk:sub_county_id_fk,region_telephone:region_telephone, region_id:region_id}
      })
        .done(function( msg ) {
          alert( msg );
          load_all_regions_table(redirect_url);

        });
}
function load_all_devices_table(all_devices_table_url){
    
    $.ajax({
        method: "POST",
        url: all_devices_table_url,
        // data: $('myLoginForm').serialize()
        data:{}
      })
        .done(function( htmldata ) {
            $('#admin_main_container').html(htmldata);
        });


}
function load_all_regions_table(all_regions_table_url){
    
    $.ajax({
        method: "POST",
        url: all_regions_table_url,
        // data: $('myLoginForm').serialize()
        data:{}
      })
        .done(function( htmldata ) {
            $('#admin_main_container').html(htmldata);
        });


}
function load_unassigned_devices_table(all_unassigned_devices_table_url){
    
    $.ajax({
        method: "POST",
        url: all_unassigned_devices_table_url,
        // data: $('myLoginForm').serialize()
        data:{}
      })
        .done(function( htmldata ) {
            $('#admin_main_container').html(htmldata);
        });


}
function load_all_regions_table(all_regions_table_url){
    
    $.ajax({
        method: "POST",
        url: all_regions_table_url,
        // data: $('myLoginForm').serialize()
        data:{}
      })
        .done(function( htmldata ) {
            $('#admin_main_container').html(htmldata);
        });


}
function load_form_to_assign_assets(device_id, load_form_to_assign_asset_url){
   
   $('#main_modal').modal('show');
   var title ="Assign Asset to Region";
   
    $.ajax({
        method: "POST",
        url: load_form_to_assign_asset_url,
         data:{device_id:device_id}
      })
        .done(function( htmldata ) {
            $('#main_modal_body').html(htmldata);
            $('#main_modal_title').html(title);

        });


}
function load_form_to_return_assets(device_id, load_form_to_return_asset_url){
 
    $('#main_modal').modal('show');
    var title ="Returning Assets";
    
     $.ajax({
         method: "POST",
         url: load_form_to_return_asset_url,
          data:{device_id:device_id}
       })
         .done(function( htmldata ) {
             $('#main_modal_body').html(htmldata);
             $('#main_modal_title').html(title);
 
         });
 
 
 }
 function load_form_to_edit_assets(device_id, add_edit_device_url,user_function){
 
    $('#main_modal').modal('show');
    var title ="Edit Device";
    
     $.ajax({
         method: "POST",
         url: add_edit_device_url,
          data:{device_id:device_id,user_function:user_function}
       })
         .done(function( htmldata ) {
             $('#main_modal_body').html(htmldata);
             $('#main_modal_title').html(title);
 
         });
 
 
 }
 function load_form_to_edit_region(region_id, add_edit_region_url){
 
    $('#main_modal').modal('show');
    var title ="Edit Region information";
    
     $.ajax({
         method: "POST",
         url: add_edit_region_url,
          data:{region_id:region_id}
       })
         .done(function( htmldata ) {
             $('#main_modal_body').html(htmldata);
             $('#main_modal_title').html(title);
 
         });
 
 
 }

 function assign_device_to_region(assign_device_to_region_url){

    var sub_county_id_fk =$('#sub_county_id_fk').val();
    var device_id =$('#device_id').val();
    var device_status =$('#device_status').val();
    var redirect_url =$('#redirect_url').val();
    
    $.ajax({
        method: "POST",
        url: assign_device_to_region_url,
        // data: $('myLoginForm').serialize()
        data:{sub_county_id_fk:sub_county_id_fk, device_id:device_id,device_status:device_status}
      })
        .done(function( msg ) {
          alert( msg );
          $('#main_modal').modal('hide');
          load_all_devices_table(redirect_url);

        });

 }
 function return_devices(return_device_url){

  var formerly_assigned_region =$('#formerly_assigned_region').val();
  var device_condition =$('#device_condition').val();
  var device_status =$('#device_status').val();
  var reason_for_returning=$('#device_status').val();
  var device_id=$('#device_id').val();
  var redirect_url =$('#redirect_url').val();

  
  $.ajax({
      method: "POST",
      url: return_device_url,
      // data: $('myLoginForm').serialize()
      data:{formerly_assigned_region:formerly_assigned_region, device_id:device_id,device_status:device_status, device_condition:device_condition, reason_for_returning:reason_for_returning}
    })
      .done(function( msg ) {
        alert( msg );
        $('#main_modal').modal('hide');
        load_all_devices_table(redirect_url);

      });

}
function search_by_asset_tag(search_by_asset_tag_url){

  var asset_tag_number =$('#asset_tag_number').val();
  var redirect_url =$('#redirect_url').val();

  
  $.ajax({
      method: "POST",
      url: search_by_asset_tag_url,
      // data: $('myLoginForm').serialize()
      data:{asset_tag_number:asset_tag_number}
    })
      .done(function( msg ) {
        $('#table_div').html(msg);

      });

}
function load_add_edit_users_views(user_account_id, add_edit_users_url){

  $.ajax({
    method: "POST",
    url: add_edit_users_url,
    // data: $('myLoginForm').serialize()
    data:{user_account_id:user_account_id}
  })
    .done(function( htmldata ) {
        $('#admin_main_container').html(htmldata);
    });
}
function load_form_to_edit_users(user_account_id, add_edit_users_url){
 
  $('#main_modal').modal('show');
  var title ="Edit User information";
  
   $.ajax({
       method: "POST",
       url: add_edit_users_url,
        data:{user_account_id:user_account_id}
     })
       .done(function( htmldata ) {
           $('#main_modal_body').html(htmldata);
           $('#main_modal_title').html(title);

       });


}
function load_form_to_edit_users_returned_device(user_returning_device_id, add_edit_device_users_url,page_type,device_id){

  $('#main_modal').modal('show');
  var title ="Edit Device User information";
   $.ajax({
       method: "POST",
       url: add_edit_device_users_url,
        data:{user_returning_device_id:user_returning_device_id,page_type:page_type,device_id:device_id}
     })
       .done(function( htmldata ) {
           $('#main_modal_body').html(htmldata);
           $('#main_modal_title').html(title);

       });
}

function load_all_users_table(all_users_table_url){
    
  $.ajax({
      method: "POST",
      url: all_users_table_url,
      // data: $('myLoginForm').serialize()
      data:{}
    })
      .done(function( htmldata ) {
          $('#admin_main_container').html(htmldata);
      });


}
function add_update_user_info(add_update_user_info_url){
  

  var user_account_id =$('#user_account_id').val();
  var user_account_email =$('#user_account_email').val();
  var user_account_national_id =$('#user_account_national_id').val();
  var user_account_county_registration_office_id =$('#registration_office_id').val(); 
  var user_account_first_name =$('#user_account_first_name').val();
  var user_account_second_name =$('#user_account_second_name').val();
  var user_group_id_fk =$('#user_group_id_fk').val();
  var user_account_phone =$('#user_account_phone').val();
     
  var redirect_url =$('#redirect_url').val();
  let required_email_message =$('#required_email_message').val();
  let required_national_id_message =$('#required_national_id_message').val();
  let required_registration_office_id_message =$('#required_registration_office_id_message').val();
  let required_first_name_message =$('#required_first_name_message').val();
  let required_second_name_message =$('#required_second_name_message').val();
  let required_user_group_id_message =$('#required_user_group_id_message').val();
  let required_phone_number_message=$('#required_phone_number_message').val();
  let invalid_phone_number_message=$('#invalid_phone_number_message').val();
  let invalid_email_message=$('#invalid_email_message').val();
 
  let valid_registration_office_id=global_true_numeric_value;
  let valid_user_group_id_fk=global_true_numeric_value;
 
  if(user_account_county_registration_office_id<=global_false_numeric_value){
    valid_registration_office_id=global_false_numeric_value;
  }
  if(user_group_id_fk<=global_false_numeric_value){
    valid_user_group_id_fk=global_false_numeric_value;
  }

  if(ValidateStringValue(user_account_first_name)==global_true_numeric_value&& ValidateStringValue(user_account_second_name)==global_true_numeric_value&& ValidateStringValue(user_account_national_id)==global_true_numeric_value
  && ValidateStringValue(user_account_email)==global_true_numeric_value&& ValidateStringValue(user_account_phone)==global_true_numeric_value&&(valid_registration_office_id==global_true_numeric_value)&&(valid_user_group_id_fk==global_true_numeric_value)
  &&validate_mobile_number(user_account_phone)==global_true_numeric_value&&validate_email_address(user_account_email)==global_true_numeric_value){
    swal({
      title: "Are you sure?",
      text: "This action will save this data!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {

  $.ajax({
      method: "POST",
      url: add_update_user_info_url,
      // data: $('myLoginForm').serialize()
      data:{user_account_id:user_account_id, user_account_email:user_account_email,user_account_national_id:user_account_national_id, user_account_county_registration_office_id:user_account_county_registration_office_id,user_account_first_name:user_account_first_name,user_account_second_name:user_account_second_name,user_group_id_fk:user_group_id_fk,user_account_id:user_account_id,user_account_phone:user_account_phone}
    })
      .done(function( msg ) {
        var json = JSON.parse(msg);
            $.each(json, function (index, value)
            {
                if (index === 'success')
                {
                  swal("Success", ""+value+"", "success");
                  load_all_users_table(redirect_url);
                }else{
                    swal("Error", ""+value+"", "error");
             
                }
                });
       

      });
    }else{
      swal("Cancelled", "You have cancelled safely :)", "error");
    
    }
  })
    }else{
      if(ValidateStringValue(user_account_first_name)==global_false_numeric_value){
        add_input_error_class('user_account_first_name', 'user_account_first_name_span_id', required_first_name_message);
        
   
      }
      if(ValidateStringValue(user_account_second_name)==global_false_numeric_value){
        add_input_error_class('user_account_second_name', 'user_account_second_name_span_id', required_second_name_message);
      }
      if(ValidateStringValue(user_account_national_id)==global_false_numeric_value){
        add_input_error_class('user_account_national_id', 'user_account_national_id_span_id', required_national_id_message);
      }
      if(ValidateStringValue(user_account_email)==global_false_numeric_value){
        add_input_error_class('user_account_email', 'user_account_email_span_id', required_email_message);
      }
      if(ValidateStringValue(user_account_phone)==global_false_numeric_value){
        add_input_error_class('user_account_phone', 'user_account_phone_span_id', required_phone_number_message);
      }
      if(valid_registration_office_id==global_false_numeric_value){
        add_input_error_class('registration_office_id', 'user_account_county_registration_office_id_span_id', required_registration_office_id_message);
      }
      if(valid_user_group_id_fk==global_false_numeric_value){
        add_input_error_class('user_group_id_fk', 'user_group_id_fk_span_id', required_user_group_id_message);
      }
      if(validate_mobile_number(user_account_phone)==global_false_numeric_value){
        add_input_error_class('user_account_phone', 'user_account_phone_span_id', invalid_phone_number_message);
      }
      if(validate_email_address(user_account_email)==global_false_numeric_value){
      add_input_error_class('user_account_email', 'user_account_email_span_id', invalid_email_message);
      }
     }
  

}
function load_add_edit_returned_devices_page(device_id,user_returning_device_id, add_edit_returned_device_url){

  $.ajax({
    method: "POST",
    url: add_edit_returned_device_url,
    // data: $('myLoginForm').serialize()
    data:{device_id:device_id,user_returning_device_id:user_returning_device_id}
  })
    .done(function( htmldata ) {
        $('#admin_main_container').html(htmldata);
    });
}
function load_table(data_table_url){
    
  $.ajax({
      method: "POST",
      url: data_table_url,
      // data: $('myLoginForm').serialize()
      data:{}
    })
      .done(function( htmldata ) {
          $('#admin_main_container').html(htmldata);
      });


}

function checkifuserexits(check_if_user_exists_url, display_user_url){
  var national_id =$('#national_id').val();
  var email =$('#email').val();

 $.ajax({
      method: "POST",
      url: check_if_user_exists_url,
      data:{national_id:national_id,email:email}
    })
      .done(function( msg ) {

        var json = JSON.parse(msg);
        $.each(json, function (index, value)
        {
          var user_returning_device_id= value;
          if(index=='success'){
          var user_returning_device_id= value;
          $('#user_returning_device_id').val(user_returning_device_id);
          load_specific_user_table(user_returning_device_id,display_user_url);
          }else{
            $('#user_returning_device_id').val(user_returning_device_id);

          }
          
            });
          

      });

}
function load_specific_user_table(user_returning_device_id,display_user_url){

  $.ajax({
    method: "POST",
    url: display_user_url,
    // data: $('myLoginForm').serialize()
    data:{user_returning_device_id:user_returning_device_id}
  })
    .done(function( htmldata ) {
        $('#return_user_information_div').html(htmldata);
    });

}
function checkifdeviceisreturned(check_if_device_is_returned_url, display_device_url){
    var asset_tag_number =$('#asset_tag_number').val();
    var device_serial_no =$('#device_serial_no').val();
    var device_imei_no =$('#device_imei_no').val();
  
   $.ajax({
        method: "POST",
        url: check_if_device_is_returned_url,
        data:{asset_tag_number:asset_tag_number,device_serial_no:device_serial_no,device_imei_no:device_imei_no}
      })
        .done(function( msg ) {
  
          var json = JSON.parse(msg);
          $.each(json, function (index, value)
          {
            var device_id= 0;
            if(index=='success'){
            
            $('#device_information_div').html(value);
            }else{
              $('#device_id').val(device_id);
  
            }
            
              });
           
  
        });
}

function global_load_all_table_to_dashboard_div(table_url){
    
  $.ajax({
      method: "POST",
      url: table_url,
      // data: $('myLoginForm').serialize()
      data:{}
    })
      .done(function( htmldata ) {
          $('#admin_main_container').html(htmldata);
      });


}
function global_load_view_device_to_dashboard_div(device_id, load_view_url){
    
  $.ajax({
      method: "POST",
      url: load_view_url,
      data:{device_id:device_id}
    })
      .done(function( htmldata ) {
          $('#admin_main_container').html(htmldata);
      });


}

function add_update_filtered_user_info(add_update_user_info_url,display_user_url){
  

  let user_returning_device_id =$('#user_returning_device_id').val();
  let first_name =$('#first_name').val();
  let second_name =$('#second_name').val();
  let email =$('#email').val(); 
  let phone_number =$('#phone_number').val();
  let national_id =$('#national_id').val();
  let registration_office_id =$('#registration_office_id').val();
  let page_type=$('#page_type').val();
  let device_id=$('#device_id').val();
  let redirect_url=$('#redirect_url').val();

  let valid_registration_office_id=global_true_numeric_value;
  if(registration_office_id<=global_false_numeric_value){
    valid_registration_office_id=global_false_numeric_value;
  }
 


  let required_email_message =$('#required_email_message').val();
  let required_national_id_message =$('#required_national_id_message').val();
  let required_registration_office_id_message =$('#required_registration_office_id_message').val();
  let required_first_name_message =$('#required_first_name_message').val();
  let required_second_name_message =$('#required_second_name_message').val();
  let required_phone_number_message=$('#required_phone_number_message').val();
  let invalid_phone_number_message=$('#invalid_phone_number_message').val();
  let invalid_email_message=$('#invalid_email_message').val();
  
 
  if(ValidateStringValue(email)==global_true_numeric_value &&ValidateStringValue(national_id)==global_true_numeric_value &&ValidateStringValue(first_name)==global_true_numeric_value &&ValidateStringValue(second_name)==global_true_numeric_value&&ValidateStringValue(phone_number)==global_true_numeric_value
  &&(valid_registration_office_id==global_true_numeric_value)&&validate_mobile_number(phone_number)==global_true_numeric_value&&validate_email_address(email)==global_true_numeric_value){
    swal({
      title: "Are you sure?",
      text: "This action will save this data!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
    $.ajax({
      method: "POST",
      url: add_update_user_info_url,
      data:{user_returning_device_id:user_returning_device_id, first_name:first_name,second_name:second_name, email:email,national_id:national_id,registration_office_id:registration_office_id,phone_number:phone_number}
    })
      .done(function( msg ) {
        var json = JSON.parse(msg);
            $.each(json, function (index, value)
            {
                if (index === 'success')
                {
                  swal("Success", ""+value+"", "success");
                  $('#main_modal').modal('hide');
                  if(page_type==list_view){
                  load_specific_user_table(user_returning_device_id,display_user_url);
                  }else
                  if(page_type==view_page)
                  {
                  global_load_view_device_to_dashboard_div(device_id, redirect_url)
                    
                  }
                }else{
                  swal("Error", ""+value+"", "error");
                }
                });
       

      });
    }else{
      swal("Cancelled", "Your have cancelled safely :)", "error");
    
    }
  })
    }else{
      
      if(ValidateStringValue(email)==global_false_numeric_value){
        add_input_error_class('email', 'email_span_id', required_email_message);

      }
      if(ValidateStringValue(national_id)==global_false_numeric_value){
        add_input_error_class('national_id', 'national_id_span_id', required_national_id_message);
      }
      if(ValidateStringValue(first_name)==global_false_numeric_value){
        add_input_error_class('first_name', 'first_name_span_id', required_first_name_message);
      }
      if(ValidateStringValue(second_name)==global_false_numeric_value){
        add_input_error_class('second_name', 'second_name_span_id', required_second_name_message);
      }
      if(valid_registration_office_id==global_false_numeric_value){
        add_input_error_class('registration_office_id', 'registration_office_id_id_fk_span_id', required_registration_office_id_message);
      }
      if(ValidateStringValue(phone_number)==global_false_numeric_value){
        add_input_error_class('phone_number', 'phone_number_span_id', required_phone_number_message);
      } 
      if(validate_mobile_number(phone_number)==global_false_numeric_value){
        add_input_error_class('phone_number', 'phone_number_span_id', invalid_phone_number_message);
      }
      if(validate_email_address(email)==global_false_numeric_value){
      add_input_error_class('email', 'email_span_id', invalid_email_message);
      }
     
      

    }
 
}
function load_sub_counties_dependent_dropdown(sub_county_dropdown_url){
  let county_id =$('#county_id').val();
  if(county_id != '')
  {
        $.ajax({
        method: "POST",
        url: sub_county_dropdown_url,
        data:{county_id:county_id},
        dataType:"JSON",
          success:function(data)
          {
            
              var html = '<option value="0">Select Sub county</option>';

              for(var count = 0; count < data.length; count++)
              {
               
                  html += '<option value="'+data[count].dropdown_value+'">'+data[count].dropdown_text+'</option>';

              }

              $('#sub_county_id_fk').html(html);
          }
      });
  }
  else
  {
      $('#sub_county_id_fk').val('0');
  }

}
function load_sub_registration_offices_dependent_dropdown(reg_office_dropdown_url){
  let sub_county_id_fk =$('#sub_county_id_fk').val();
  if(sub_county_id_fk != '')
  {
        $.ajax({
        method: "POST",
        url: reg_office_dropdown_url,
        data:{sub_county_id_fk:sub_county_id_fk},
        dataType:"JSON",
          success:function(data)
          {
            
              var html = '<option value="0">Select Office</option>';

              for(var count = 0; count < data.length; count++)
              {
               
                  html += '<option value="'+data[count].dropdown_value+'">'+data[count].dropdown_text+'</option>';

              }

              $('#registration_office_id').html(html);

          }
      });
  }
  else
  {
      $('#registration_office_id').val('0');
  }

}

// Form Validation
function ValidateStringValue(value) {
  if (value == null || value.length === 0 || value === '' || typeof value === "undefined") {
      return global_false_numeric_value;
  }
  else {
      return global_true_numeric_value;
  }
}
function add_input_error_class(input_id, input_id_span_id, input_id_span_msg) {
  if (document.getElementById(input_id) && document.getElementById(input_id_span_id)) {
      document.getElementById(input_id).classList.add('invalid');
      if (document.getElementById(input_id_span_id)) { document.getElementById(input_id_span_id).innerHTML = input_id_span_msg; }
  }
}
function load_view_to_update_first_time_user_passwords(user_account_id,last_login,load_update_password_view,new_user){

  if(new_user==global_true_numeric_value){
        if(!last_login){
         
          $('#password_modal').modal('show');
          var title ="Update your password";
          $.ajax({
            method: "POST",
            url: load_update_password_view,
            data:{user_account_id:user_account_id,new_user:new_user}
          })
          .done(function( htmldata ) {
            
          $('#update_password_modal_body').html(htmldata);
          $('#update_passwordModalLabel').html(title);

          });
  
       }
  }else{
        $.ajax({
          method: "POST",
          url: load_update_password_view,
          data:{user_account_id:user_account_id,new_user:new_user}
        })
        .done(function( htmldata ) {
          
        $('#admin_main_container').html(htmldata);

        });
  }

}
function update_user_password(update_user_password_url)
{
  let new_password =$('#new_password').val();
  let user_account_id =$('#user_account_id').val();
  let confirm_password =$('#confirm_password').val();
  let password_field_required_message =$('#password_field_required_message').val();
  let confirm_password_field_required_message =$('#confirm_password_field_required_message').val();
  let password_mismatch_message =$('#password_mismatch_message').val();

  if(ValidateStringValue(new_password)==global_true_numeric_value &&ValidateStringValue(confirm_password)==global_true_numeric_value&&compare_password_confirm_password(new_password,confirm_password)==global_true_numeric_value){
    swal({
      title: "Are you sure?",
      text: "This action will save this data!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
    $.ajax({
      method: "POST",
      url: update_user_password_url,
      data:{user_account_id:user_account_id, new_password:new_password,confirm_password:confirm_password}
    })
      .done(function( msg ) {
        var json = JSON.parse(msg);
            $.each(json, function (index, value)
            {
                if (index === 'success')
                {
                  swal("Success", ""+value+"", "success");
                  $('#password_modal').modal('hide');
                  window.location.reload(true);
                }else{
                  swal("Error", ""+value+"", "error");
                }
                });
       

      });
    }else{
      swal("Cancelled", "Your have cancelled safely :)", "error");
    
    }
    })
  }else{
    if(ValidateStringValue(new_password)==global_false_numeric_value){
      add_input_error_class('new_password', 'new_password_span_id', password_field_required_message);
    }
    if(ValidateStringValue(confirm_password)==global_false_numeric_value){
      add_input_error_class('confirm_password', 'confirm_password_span_id', confirm_password_field_required_message);
    }
    if(compare_password_confirm_password(new_password,confirm_password)==global_false_numeric_value){
      add_input_error_class('confirm_password', 'confirm_password_span_id', password_mismatch_message);
    }

  }


  
}
function compare_password_confirm_password(password, confirm_password){
  var valid_input = 1;
    if (password != confirm_password) {
        valid_input = 0;
    }
    return valid_input;


}
function search_on_table(search_url,destination){
  let user_input =$('#user_input').val();
  $.ajax({
    method: "POST",
    url: search_url,
    data:{user_input:user_input}
  })
    .done(function( htmldata ) { 
      $(destination).html(htmldata);

    });



}
function remove_input_error_class(input_id, input_id_span_id, input_id_span_msg){
let jqinput_id="#"+input_id+"";
  if (document.getElementById(input_id) && document.getElementById(input_id_span_id)) {
  if(($(jqinput_id).val())==""||($(jqinput_id).val())==0){
    document.getElementById(input_id).classList.add('invalid');
    document.getElementById(input_id_span_id).innerHTML = input_id_span_msg; 
   
  }else{
    let empty_span_msg="";
    document.getElementById(input_id).classList.remove('invalid');
    document.getElementById(input_id_span_id).innerHTML = empty_span_msg; 

  }
 }
}
function delete_user_details(user_account_id, delete_user_url, redirect_url){
  swal({
    title: "Are you sure?",
    text: "This may be irreversible!",
    icon: "warning",
    buttons: [
      'No, cancel it!',
      'Yes, I am sure!'
    ],
    dangerMode: true,
  }).then(function(isConfirm) {
    if (isConfirm) {
          let deleted=global_true_numeric_value;
          $.ajax({
            method: "POST",
            url: delete_user_url,
            data:{user_account_id:user_account_id, deleted:deleted}
          })
            .done(function( msg ) {
              var json = JSON.parse(msg);
                  $.each(json, function (index, value)
                  {
                      if (index === 'success')
                      {
                        swal("Success", ""+value+"", "success");
                        load_all_users_table(redirect_url);
                      }else{
                        swal("Error", ""+value+"", "error");
                      }
                      });
            

            });
  }else{
    swal("Cancelled", "Your record is safe :)", "error");
  
  }
  })

}
function delete_device_user_details(user_returning_device_id, delete_user_url, redirect_url){
  swal({
    title: "Are you sure?",
    text: "This may be irreversible!",
    icon: "warning",
    buttons: [
      'No, cancel it!',
      'Yes, I am sure!'
    ],
    dangerMode: true,
  }).then(function(isConfirm) {
    if (isConfirm) {
  let deleted=global_true_numeric_value;
  $.ajax({
    method: "POST",
    url: delete_user_url,
    data:{user_returning_device_id:user_returning_device_id, deleted:deleted}
  })
    .done(function( msg ) {
      var json = JSON.parse(msg);
          $.each(json, function (index, value)
          {
              if (index === 'success')
              {
                swal("Success", ""+value+"", "success");
                load_specific_user_table(user_returning_device_id,redirect_url);
              }else{
                swal("Error", ""+value+"", "error");
              }
              });
     

    });

}else{
  swal("Cancelled", "Your record is safe :)", "error");

}
})

}
function delete_device_details(device_id, delete_user_url, redirect_url,user_function){
 
  swal({
      title: "Are you sure?",
      text: "This may be irreversible!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
       
  let deleted=global_true_numeric_value;
  $.ajax({
    method: "POST",
    url: delete_user_url,
    data:{device_id:device_id, deleted:deleted}
  })
    .done(function( msg ) {
      var json = JSON.parse(msg);
          $.each(json, function (index, value)
          {
              if (index === 'success')
              {
                swal("Success", ""+value+"", "success");
                if(user_function==admin_function){
                  load_all_devices_table(redirect_url);
                }else
                if(user_function==store_keeper_function){
                  global_load_all_table_to_dashboard_div(redirect_url);
                }
                               
              }else{
                swal("Error", ""+value+"", "error");
              }
              });
     

    });
  }else{
    swal("Cancelled", "Your record is safe :)", "error");
  
  }
})


}

function add_update_returned_device_info(add_edit_returned_device, redirect_url){
  
  
  let user_returning_device_id =$('#user_returning_device_id').val();
  let email =$('#email').val();
  let national_id =$('#national_id').val();
  let registration_office_id =$('#registration_office_id').val(); 
  let first_name =$('#first_name').val();
  let second_name =$('#second_name').val();
  let phone_number =$('#phone_number').val();
  let reason_for_return_id =$('#reason_for_return_id').val();
  let device_id =$('#device_id').val();
  let device_name =$('#device_name').val();
  let device_serial_no =$('#device_serial_no').val(); 
  let device_imei_no =$('#device_imei_no').val();
  let asset_tag_number =$('#asset_tag_number').val();
  let reason_for_returning_description =$('#reason_for_returning_description').val();

  let required_email_message =$('#required_email_message').val();
  let required_national_id_message =$('#required_national_id_message').val();
  let required_device_name_message =$('#required_device_name_message').val();
  let required_device_serial_no_message =$('#required_device_serial_no_message').val();
  let required_device_imei_no_message =$('#required_device_imei_no_message').val();
  let required_asset_tag_no_message =$('#required_asset_tag_no_message').val();
  let required_registration_office_id_message =$('#required_registration_office_id_message').val();
  let required_first_name_message =$('#required_first_name_message').val();
  let required_second_name_message =$('#required_second_name_message').val();
  let requreed_reason_for_return_message =$('#requreed_reason_for_return_message').val();
  let required_phone_number_message=$('#required_phone_number_message').val();
  let invalid_phone_number_message=$('#invalid_phone_number_message').val();
  let invalid_email_message=$('#invalid_email_message').val();
  
 

  let valid_registration_office_id=global_true_numeric_value;
  let valid_reason_for_return_id=global_true_numeric_value;
  if(registration_office_id<=global_false_numeric_value){
    valid_registration_office_id=global_false_numeric_value;
  }
  if(reason_for_return_id<=global_false_numeric_value){
    valid_reason_for_return_id=global_false_numeric_value;
  }

  if(user_returning_device_id==global_false_numeric_value){
    
  if(ValidateStringValue(device_name)==global_true_numeric_value && ValidateStringValue(device_serial_no)==global_true_numeric_value&& ValidateStringValue(device_imei_no)==global_true_numeric_value&& ValidateStringValue(asset_tag_number)==global_true_numeric_value
  &&ValidateStringValue(email)==global_true_numeric_value &&ValidateStringValue(national_id)==global_true_numeric_value &&ValidateStringValue(first_name)==global_true_numeric_value &&ValidateStringValue(second_name)==global_true_numeric_value&&ValidateStringValue(phone_number)==global_true_numeric_value
  &&(valid_reason_for_return_id==global_true_numeric_value)&&validate_mobile_number(phone_number)==global_true_numeric_value&&validate_email_address(email)==global_true_numeric_value){
    swal({
      title: "Are you sure?",
      text: "This action will save this data!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {

  $.ajax({
      method: "POST",
      url: add_edit_returned_device,
      data:{user_returning_device_id:user_returning_device_id, email:email,national_id:national_id, registration_office_id:registration_office_id,first_name:first_name,second_name:second_name,reason_for_return_id:reason_for_return_id,device_id:device_id,device_name:device_name,device_serial_no:device_serial_no,device_imei_no:device_imei_no,asset_tag_number:asset_tag_number,reason_for_returning_description:reason_for_returning_description,phone_number:phone_number},
      
    })
      .done(function( msg ) {
          var json = JSON.parse(msg);
          $.each(json, function (index, value)
          {
            if(index=='success'){
              swal("Success", ""+value+"", "success");
              global_load_all_table_to_dashboard_div(redirect_url);
            }else{
              swal("Error!", ""+value+"", "error");
            }
           
          });

      });
    }else{
      swal("Cancelled", "Your have cancelled safely :)", "error");
    
    }
    })
    }else{
      if(ValidateStringValue(email)==global_false_numeric_value){
        add_input_error_class('email', 'email_span_id', required_email_message);
      }
      if(ValidateStringValue(national_id)==global_false_numeric_value){
        add_input_error_class('national_id', 'national_id_span_id', required_national_id_message);
      }
      if(ValidateStringValue(first_name)==global_false_numeric_value){
        add_input_error_class('first_name', 'first_name_span_id', required_first_name_message);
      }
      if(ValidateStringValue(second_name)==global_false_numeric_value){
        add_input_error_class('second_name', 'second_name_span_id', required_second_name_message);
      }
      if(ValidateStringValue(device_name)==global_false_numeric_value){
        add_input_error_class('device_name', 'device_name_fk_span_id', required_device_name_message);
      }
      if(ValidateStringValue(device_serial_no)==global_false_numeric_value){
        add_input_error_class('device_serial_no', 'device_serial_no_span_id', required_device_serial_no_message);
      }
      if(ValidateStringValue(device_imei_no)==global_false_numeric_value){
        add_input_error_class('device_imei_no', 'device_imei_no_span_id', required_device_imei_no_message);
       }
      if(ValidateStringValue(asset_tag_number)==global_false_numeric_value){
        add_input_error_class('asset_tag_number', 'asset_tag_number_fk_span_id', required_asset_tag_no_message);
      }
      if(ValidateStringValue(phone_number)==global_false_numeric_value){
        add_input_error_class('phone_number', 'phone_number_span_id', required_phone_number_message);
      } 
      if(valid_registration_office_id==global_false_numeric_value){
        add_input_error_class('registration_office_id', 'registration_office_id_id_fk_span_id', required_registration_office_id_message);
      }
      if(valid_reason_for_return_id==global_false_numeric_value){
        add_input_error_class('reason_for_return_id', 'reason_for_return_id_span_id', requreed_reason_for_return_message);
      }
      if(validate_mobile_number(phone_number)==global_false_numeric_value){
        add_input_error_class('phone_number', 'phone_number_span_id', invalid_phone_number_message);
      }
      if(validate_email_address(email)==global_false_numeric_value){
      add_input_error_class('email', 'email_span_id', invalid_email_message);
      }

    }
  }else{

    if(ValidateStringValue(device_name)==global_true_numeric_value && ValidateStringValue(device_serial_no)==global_true_numeric_value&& ValidateStringValue(device_imei_no)==global_true_numeric_value&& ValidateStringValue(asset_tag_number)==global_true_numeric_value
    &&(valid_reason_for_return_id==global_true_numeric_value)){
      swal({
        title: "Are you sure?",
        text: "This action will save this data!",
        icon: "warning",
        buttons: [
          'No, cancel it!',
          'Yes, I am sure!'
        ],
        dangerMode: true,
      }).then(function(isConfirm) {
        if (isConfirm) {
  
    $.ajax({
        method: "POST",
        url: add_edit_returned_device,
        data:{user_returning_device_id:user_returning_device_id, email:email,national_id:national_id, registration_office_id:registration_office_id,first_name:first_name,second_name:second_name,reason_for_return_id:reason_for_return_id,device_id:device_id,device_name:device_name,device_serial_no:device_serial_no,device_imei_no:device_imei_no,asset_tag_number:asset_tag_number,reason_for_returning_description:reason_for_returning_description},
        
      })
        .done(function( msg ) {
            var json = JSON.parse(msg);
            $.each(json, function (index, value)
            {
              if(index=='success'){
                swal("Success", ""+value+"", "success");
                global_load_all_table_to_dashboard_div(redirect_url);
              }else{
                swal("Error!", ""+value+"", "error");
              }
             
            });
  
        });
      }else{
        swal("Cancelled", "Your have cancelled safely :)", "error");
      
      }
      })
      }else{
        
       
        if(ValidateStringValue(device_name)==global_false_numeric_value){
          add_input_error_class('device_name', 'device_name_fk_span_id', required_device_name_message);
        }
        if(ValidateStringValue(device_serial_no)==global_false_numeric_value){
          add_input_error_class('device_serial_no', 'device_serial_no_span_id', required_device_serial_no_message);
        }
        if(ValidateStringValue(device_imei_no)==global_false_numeric_value){
          add_input_error_class('device_imei_no', 'device_imei_no_span_id', required_device_imei_no_message);
         }
        if(ValidateStringValue(asset_tag_number)==global_false_numeric_value){
          add_input_error_class('asset_tag_number', 'asset_tag_number_fk_span_id', required_asset_tag_no_message);
        }
        if(valid_reason_for_return_id==global_false_numeric_value){
          add_input_error_class('reason_for_return_id', 'reason_for_return_id_span_id', requreed_reason_for_return_message);
        }
  
      }

  }

  
}

// validate email
function validate_email_address(email) {
  var valid = 1;
  if (email.indexOf('@') == -1) {
      valid = 0;
  } else {

      var parts = email.split('@');
      var domain = parts[1];

      if (domain.indexOf('.') == -1) {

          valid = 0;

      } else {

          var domainParts = domain.split('.');
          var ext = domainParts[1];

          if (ext.length > 4 || ext.length < 2) {

              valid = 0;
          }
      }

  }
  return valid;
}

function validate_itel_mobile_number(input_id) {
  if (document.getElementById(input_id)) {
      var input = document.querySelector('#' + input_id);
      var iti = window.intlTelInputGlobals.getInstance(input);

      if (iti.isValidNumber() == true) {
          return global_true_numeric_value;
      }
      else {
          return global_false_numeric_value;
      }
  }
  else {
      return global_false_numeric_value;
  }
}

function validate_mobile_number(x) {
  var valid_input = 1;
  x = x.trim();
  if (isNaN(x) || x.indexOf(" ") != -1) {
      valid_input = 0;
  }
  if (x.length > 13 || x.length < 8) {
      valid_input = 0;
  }
  return valid_input;
}
function add_update_registration_office_info(add_edit_registration_office_url){
 

  let registration_office_name =$('#registration_office_name').val();
  let county_id =$('#county_id').val();
  let sub_county_id_fk =$('#sub_county_id_fk').val();
  let registration_office_id =$('#registration_office_id').val();
  let country_required_msg =$('#country_required_msg').val();
  let sub_county_required_msg =$('#sub_county_required_msg').val();
  let duplicate_name =$('#duplicate_name').val();
  let reuired_name_msg =$('#reuired_name_msg').val();
  let redirect_url=$('#redirect_url').val();
  


  let valid_county_id=global_true_numeric_value;
  if(county_id<=global_false_numeric_value){
    valid_county_id=global_false_numeric_value;
  }
  let valid_sub_county_id=global_true_numeric_value;
  if(sub_county_id_fk<=global_false_numeric_value){
    valid_sub_county_id=global_false_numeric_value;
  }

  if(ValidateStringValue(registration_office_name)==global_true_numeric_value &&(valid_sub_county_id==global_true_numeric_value)&&(valid_county_id=global_true_numeric_value)){
    swal({
      title: "Are you sure?",
      text: "This action will save this data!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
    $.ajax({
      method: "POST",
      url: add_edit_registration_office_url,
      data:{registration_office_name:registration_office_name, registration_office_id:registration_office_id,sub_county_id_fk:sub_county_id_fk}
    })
      .done(function( msg ) {
        var json = JSON.parse(msg);
            $.each(json, function (index, value)
            {
                if (index === 'success')
                {
                  swal("Success", ""+value+"", "success");
                  load_add_edit_region_page(global_false_numeric_value,redirect_url);
                
                }else{
                  swal("Error", ""+value+"", "error");
                }
                });
       

      });
    }else{
      swal("Cancelled", "Your have cancelled safely :)", "error");
    
    }
    })
  }else{
    if(ValidateStringValue(registration_office_name)==global_false_numeric_value){
      add_input_error_class('registration_office_name', 'registration_office_name_span_id', reuired_name_msg);
    }
    if(valid_county_id==global_false_numeric_value){
      add_input_error_class('county_id', 'county_id_span_id', country_required_msg);
    }
    if(valid_sub_county_id==global_false_numeric_value){
      add_input_error_class('sub_county_id_fk', 'sub_county_id_fk_span_id', sub_county_required_msg);
    }

  }

}

function delete_office_details(registration_office_id, delete_office_url, redirect_url){
   redirect_url=$('#redirect_url').val();
  swal({
    title: "Are you sure?",
    text: "This may be irreversible!",
    icon: "warning",
    buttons: [
      'No, cancel it!',
      'Yes, I am sure!'
    ],
    dangerMode: true,
  }).then(function(isConfirm) {
    if (isConfirm) {
          let deleted=global_true_numeric_value;
          $.ajax({
            method: "POST",
            url: delete_office_url,
            data:{registration_office_id:registration_office_id, deleted:deleted}
          })
            .done(function( msg ) {
              var json = JSON.parse(msg);
                  $.each(json, function (index, value)
                  {
                      if (index === 'success')
                      {
                        swal("Success", ""+value+"", "success");
                        load_add_edit_region_page(global_false_numeric_value,redirect_url);
                      }else{
                        swal("Error", ""+value+"", "error");
                      }
                      });
            

            });
  }else{
    swal("Cancelled", "Your record is safe :)", "error");
  
  }
  })

}


//  -------------Password Policy-------//
function load_password_polcy(){

var myInput = document.getElementById("new_password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
}