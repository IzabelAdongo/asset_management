
 <script>
 
//  function getIp(callback) {
//  fetch('https://ipinfo.io/json?token=78884ebd952828', { headers: { 'Accept': 'application/json' }})
//    .then((resp) => resp.json())
//    .catch(() => {
//      return {
//        country: 'us',
//      };
//    })
//    .then((resp) => callback(resp.country));
// }
//  // For the international phone numbers
// phoneInputField = document.querySelector("#phone_number");
// phoneInput = window.intlTelInput(phoneInputField, {
//  initialCountry: "KE",
//  geoIpLookup: getIp,
//  utilsScript:
//    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
// });
//  </script>

<div id="return_user_information_div">
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">First Name:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="first_name" value="<?=(!empty($user_data->first_name)) ? $user_data->first_name : ''?>" onblur="remove_input_error_class('first_name', 'first_name_span_id', 'Enter first name');" >
                        <span id="first_name_span_id" class="text-danger"></span>
  
                        </div>
                        </div>
                </div>
</div>
</div>
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Second Name:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="second_name" value="<?=(!empty($user_data->second_name)) ? $user_data->second_name : ''?>" onblur="remove_input_error_class('second_name', 'second_name_span_id', 'Enter second name');"> 
                        <span id="second_name_span_id" class="text-danger"></span>
                 
                        </div>
                        </div>
                </div>
</div>
</div>
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="email" value="<?=(!empty($user_data->email)) ? $user_data->email : ''?>" onblur="remove_input_error_class('email', 'email_span_id', 'Enter valid email');">
                        <span id="email_span_id" class="text-danger"></span>
         
                        </div>
                        </div>
                </div>
</div>
</div>
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone No:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="phone_number" value="<?=(!empty($user_data->phone_number)) ? $user_data->phone_number : ''?>" onblur="remove_input_error_class('phone_number', 'phone_number_span_id', 'Enter phone number');"> 
                        <span id="phone_number_span_id" class="text-danger"></span>
                        </div>
                        </div>
                </div>
</div>
</div>
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">National ID:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="national_id" value="<?=(!empty($user_data->national_id)) ? $user_data->national_id : ''?>" onblur="remove_input_error_class('national_id', 'national_id_span_id', 'Enter national ID');">
                        <span id="national_id_span_id" class="text-danger"></span>
                            </div>
                        </div>
                </div>
</div>
</div>
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">County:</label>
                            <div class="col-sm-8">
                            <select class="custom-select mr-sm-2" id="county_id" style="font-size:12.5px;" onchange="load_sub_counties_dependent_dropdown('<?php echo base_url('region/fetch_subcounties_dropdown') ?>')">
                            <option value="<?=(!empty($user_data->county_id)) ? $user_data->county_id : '0'?>"><?=(!empty($user_data->county_name)) ? $user_data->county_name : 'Select Country'?></option>
                            <?php
                            foreach($counties as $county_data){
                            ?>
                            <option value="<?=$county_data->county_id?>"><?=$county_data->county_name?></option>
                            <?php
                            }
                            ?>
                            </select>
                            <span id="county_id_span_id" class="text-danger"></span>
                                 </div>
                        </div>
                </div>
</div>
</div>

  
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Subcounty:</label>
                            <div class="col-sm-8">
                            <select class="custom-select mr-sm-2" id="sub_county_id_fk" style="font-size:12.5px;" onchange="load_sub_registration_offices_dependent_dropdown('<?php echo base_url('region/fetch_registration_offices_dropdown') ?>')">
                            <option value="<?=(!empty($user_data->subcounty_id)) ? $user_data->subcounty_id : '0'?>"><?=(!empty($user_data->subcounty_name)) ? $user_data->subcounty_name : 'Select subcounty'?></option>                           
                            </select>
                            <span id="sub_county_id_fk_span_id" class="text-danger"></span>
                      
                         </div>
                        </div>
                </div>
</div>
</div>

<div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Registration Office:</label>
                            <div class="col-sm-8">
                            <select class="custom-select mr-sm-2" id="registration_office_id" style="font-size:12.5px;" onchange="remove_input_error_class('registration_office_id', 'registration_office_id_id_fk_span_id', 'Select office');">
                            <option value="<?=(!empty($user_data->registration_office_id)) ? $user_data->registration_office_id : '0'?>"><?=(!empty($user_data->registration_office_name)) ? $user_data->registration_office_name : 'Select Office'?></option>
                            </select>
                            <span id="registration_office_id_id_fk_span_id" class="text-danger"></span>
                       
                         </div>
                        </div>
                </div>
</div>
</div>
 <hr>
 
 <input type="hidden" class="form-control form-control-sm" id="user_returning_device_id" value="<?=$user_returning_device_id?>" >
 <input type="hidden" class="form-control form-control-sm" id="required_email_message" value="A valid email is required" >
 <input type="hidden" class="form-control form-control-sm" id="required_national_id_message" value="Enter National ID" >
 <input type="hidden" class="form-control form-control-sm" id="required_registration_office_id_message" value="Select a registration office" >
 <input type="hidden" class="form-control form-control-sm" id="required_first_name_message" value="Enter the first name" >
 <input type="hidden" class="form-control form-control-sm" id="required_second_name_message" value="Enter the second name" >
 <input type="hidden" class="form-control form-control-sm" id="required_phone_number_message" value="Enter phone number name" >
 <input type="hidden" class="form-control form-control-sm" id="page_type" value="<?=$page_type?>" >
 <input type="hidden" class="form-control form-control-sm" id="device_id" value="<?=$device_id?>" >
 <input type="hidden" class="form-control form-control-sm" id="redirect_url" value="<?php echo base_url('device/load_view_device_view')?>" >
 <input type="hidden" class="form-control form-control-sm" id="invalid_phone_number_message" value="The phone number is invalid" >
 <input type="hidden" class="form-control form-control-sm" id="invalid_email_message" value="Invalid email address" >

 
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row" style="display: flex;">
 <input type="button" class="btn btn-primary" onclick ="add_update_filtered_user_info('<?php echo base_url('users/add_edit_user_that_returned_device')?>','<?php echo base_url('users/display_specific_returned_device_user')?>')" value="Save Changes" style="flex: 1;"/>
        </div>
        </div>
</div>
 </div>
 





