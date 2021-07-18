
<script>
 
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
 // For the international phone numbers
phoneInputField = document.querySelector("#user_account_phone");
phoneInput = window.intlTelInput(phoneInputField, {
 initialCountry: "KE",
 geoIpLookup: getIp,
 utilsScript:
   "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
 </script>
<?php
 $session = session();

    if($user_account_id >0){
        ?>
        <form style="width:100%; margin:auto;">
        <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">First Name</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="user_account_first_name" value="<?=(!empty($user_data->user_account_first_name)) ? $user_data->user_account_first_name : ''?>" onblur="remove_input_error_class('user_account_first_name', 'user_account_first_name_span_id', 'Enter the first name');">
    <span id="user_account_first_name_span_id" class="text-danger"></span>
                     
        </div>
      </div>
      <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Second Name</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="user_account_second_name" value="<?=(!empty($user_data->user_account_second_name)) ? $user_data->user_account_second_name : ''?>" onblur="remove_input_error_class('user_account_second_name', 'user_account_second_name_span_id', 'Enter the second name');">
    <span id="user_account_second_name_span_id" class="text-danger"></span>
                     
        </div>
      </div>
      <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="user_account_email" value="<?=(!empty($user_data->user_account_email)) ? $user_data->user_account_email : ''?>" onblur="remove_input_error_class('user_account_email', 'user_account_email_span_id', 'Enter user email');">
     <span id="user_account_email_span_id" class="text-danger"></span>
                                       
        </div>
      </div>
    <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone Number</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="user_account_phone" value="<?=(!empty($user_data->phone_number)) ? $user_data->phone_number : ''?>"> 
    <span id="user_account_phone_span_id" class="text-danger"></span>                
        </div>
      </div>
      <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">National ID</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="user_account_national_id" value="<?=(!empty($user_data->user_account_national_id)) ? $user_data->user_account_national_id : ''?>" onblur="remove_input_error_class('user_account_national_id', 'user_account_national_id_span_id', 'Enter National ID');">
    <span id="user_account_national_id_span_id" class="text-danger"></span>                
        </div>
      </div>
      <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">User Group</label>
    <div class="col-sm-8">
    <select class="custom-select mr-sm-2" id="user_group_id_fk" style="font-size:12.5px;" onchange="remove_input_error_class('user_group_id_fk', 'user_group_id_fk_span_id', 'Select user group');">
                            <option value="<?=(!empty($user_data->user_group_id_fk)) ? $user_data->user_group_id_fk : '0'?>"><?=(!empty($user_data->user_group_name)) ? $user_data->user_group_name : 'Select Group'?></option>
                            <?php
                            foreach($user_group_data as $ugrp){
                            ?>
                            <option value="<?=$ugrp->user_group_id?>"><?=$ugrp->user_group_name?></option>
                            <?php
                            }
                            ?>
                         
                            </select>
    <span id="user_group_id_fk_span_id" class="text-danger"></span>
        </div>
      </div>
      <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">County</label>
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
                     
        </div>
      </div>
      <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Sub county</label>
    <div class="col-sm-8">
    <select class="custom-select mr-sm-2" id="sub_county_id_fk" style="font-size:12.5px;" onchange="load_sub_registration_offices_dependent_dropdown('<?php echo base_url('region/fetch_registration_offices_dropdown') ?>')">
    <option value="<?=(!empty($user_data->subcounty_id)) ? $user_data->subcounty_id : '0'?>"><?=(!empty($user_data->subcounty_name)) ? $user_data->subcounty_name : 'Select subcounty'?></option>
    </select>
                             
        </div>
      </div>
      <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Registration Office</label>
    <div class="col-sm-8">
    <select class="custom-select mr-sm-2" style="font-size:12.5px;" id="registration_office_id" onchange="remove_input_error_class('user_account_county_registration_office_id', 'user_account_county_registration_office_id_span_id', 'Select an office');">
    <option value="<?=(!empty($user_data->registration_office_id)) ? $user_data->registration_office_id : '0'?>"><?=(!empty($user_data->registration_office_name)) ? $user_data->registration_office_name : 'Select Group'?></option>
    </select>
                     
        </div>
      </div>
     
        <?php
    }else{?>

<form style="width:70%; margin:auto;">
   <center><h4>Add a user</h4><center>

  
   <p>&nbsp;</p>
  
 <div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">First Name:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="user_account_first_name" value="<?=(!empty($user_data->user_account_first_name)) ? $user_data->user_account_first_name : ''?>" onblur="remove_input_error_class('user_account_first_name', 'user_account_first_name_span_id', 'Enter the first name');">
                        <span id="user_account_first_name_span_id" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Second Name:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="user_account_second_name" value="<?=(!empty($user_data->user_account_second_name)) ? $user_data->user_account_second_name : ''?>" onblur="remove_input_error_class('user_account_second_name', 'user_account_second_name_span_id', 'Enter the second name');">
                        <span id="user_account_second_name_span_id" class="text-danger"></span>
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
                        <input type="text" class="form-control form-control-sm" id="user_account_email" value="<?=(!empty($user_data->user_account_email)) ? $user_data->user_account_email : ''?>" onblur="remove_input_error_class('user_account_email', 'user_account_email_span_id', 'Enter user email');">
                        <span id="user_account_email_span_id" class="text-danger"></span>
                        </div>
                        </div>
                </div>
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone No:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="user_account_phone" value="<?=(!empty($user_data->phone_number)) ? $user_data->phone_number : ''?>"> 
                        <span id="user_account_phone_span_id" class="text-danger"></span>
                    </div>
                        </div>
                </div>
            </div>
 </div>
 <div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">ID Number:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="user_account_national_id" value="<?=(!empty($user_data->user_account_national_id)) ? $user_data->user_account_national_id : ''?>" onblur="remove_input_error_class('user_account_national_id', 'user_account_national_id_span_id', 'Enter National ID');">
                        <span id="user_account_national_id_span_id" class="text-danger"></span>
                        </div>
                        </div>
                </div>
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">User Group:</label>
                            <div class="col-sm-8">
                            <select class="custom-select mr-sm-2" id="user_group_id_fk" style="font-size:12.5px;" onchange="remove_input_error_class('user_group_id_fk', 'user_group_id_fk_span_id', 'Select user group');">
                            <option value="0">Select Group</option>
                            <?php
                            foreach($user_group_data as $ugrp){
                            ?>
                            <option value="<?=$ugrp->user_group_id?>"><?=$ugrp->user_group_name?></option>
                            <?php
                            }
                            ?>
                         
                            </select>
                            <span id="user_group_id_fk_span_id" class="text-danger"></span>
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
                            <option selected>Choose...</option>
                            <?php
                            foreach($counties as $county_data){
                            ?>
                            <option value="<?=$county_data->county_id?>"><?=$county_data->county_name?></option>
                            <?php
                            }
                            ?>
                            </select>
                            </div>
                            </div>
                </div>
                <div class="col-sm">
                            <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Subcounty:</label>
                            <div class="col-sm-8">
                            <select class="custom-select mr-sm-2" id="sub_county_id_fk" style="font-size:12.5px;" onchange="load_sub_registration_offices_dependent_dropdown('<?php echo base_url('region/fetch_registration_offices_dropdown') ?>')">
                            <option selected>Choose...</option>
                            </select>
                            </div>
                            </div>
                </div>
            </div>
 </div>
 
 
                                                           
                          
 <div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">
                            <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Registration Office:</label>
                            <div class="col-sm-8">
                            <select class="custom-select mr-sm-2" style="font-size:12.5px;" id="registration_office_id" onchange="remove_input_error_class('user_account_county_registration_office_id', 'user_account_county_registration_office_id_span_id', 'Select an office');">
                            <option value="0">Select Group</option>
                            </select>
                            <span id="user_account_county_registration_office_id_span_id" class="text-danger"></span>
                            </div>
                            </div>
                </div>
                <div class="col-sm">
                        <p>&nbsp;</p>
                </div>
            </div>
 </div>
 <?php
    }
   ?>

 <input type="hidden" class="form-control form-control-sm" id="user_account_id" value="<?=$user_account_id?>" placeholder="col-form-label-sm">
<input type="hidden" class="form-control form-control-sm" id="redirect_url" value="<?php echo base_url('users/load_users_list')?>" placeholder="col-form-label-sm">

 
 <input type="hidden" class="form-control form-control-sm" id="required_email_message" value="A valid email is required" >
 <input type="hidden" class="form-control form-control-sm" id="required_national_id_message" value="Enter National ID" >
 <input type="hidden" class="form-control form-control-sm" id="required_user_group_id_message" value="Select user group number" >
 <input type="hidden" class="form-control form-control-sm" id="required_registration_office_id_message" value="Select a registration office" >
 <input type="hidden" class="form-control form-control-sm" id="required_first_name_message" value="Enter the first name" >
 <input type="hidden" class="form-control form-control-sm" id="required_second_name_message" value="Enter the second name" >
 <input type="hidden" class="form-control form-control-sm" id="required_phone_number_message" value="Enter phone number name" >
 <input type="hidden" class="form-control form-control-sm" id="invalid_phone_number_message" value="The phone number is invalid" >
 <input type="hidden" class="form-control form-control-sm" id="invalid_email_message" value="Invalid email address" >


 
 
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row" style="display: flex;">
            <input type="button" class="btn btn-primary" onclick ="add_update_user_info('<?php echo base_url('users/add_edit_users_data')?>')" value="Save Changes" style="flex: 1;"/>
 
 </div>
</div>
      









</form>
