
<script>
 
 // For the international phone numbers
phoneInputField = document.querySelector("#phone_number");
phoneInput = window.intlTelInput(phoneInputField, {
 initialCountry: "KE",
 geoIpLookup: getIp,
 utilsScript:
   "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
 </script>

<?php
if($device_id ==0){
    ?>
    <form style="width:70%; margin:auto;">
    <center><h4>Returned Device</h4></center>
    <?php
}else{
?>
<form style="width:100%; margin:auto;">
<?php
}
?>

<hr>
<h6>Returning User Information</h6>
<hr>

<div id="return_user_information_div">
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">First Name:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" value="<?=(!empty($user_data->first_name)) ? $user_data->first_name : ''?>" onblur="remove_input_error_class('first_name', 'first_name_span_id', 'Enter first name');">
                        <span id="first_name_span_id" class="text-danger"></span>
  
                        </div>
                        </div>
                </div>
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Second Name:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="second_name" id="second_name" value="<?=(!empty($user_data->second_name)) ? $user_data->second_name : ''?>" onblur="remove_input_error_class('second_name', 'second_name_span_id', 'Enter second name');"> 
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
                        <input type="text" class="form-control form-control-sm" name="email" id="email" value="<?=(!empty($user_data->email)) ? $user_data->email : ''?>" onblur="remove_input_error_class('email', 'email_span_id', 'Enter a valid email');">
                        <span id="email_span_id" class="text-danger"></span>
                        </div>
                        </div>
                </div>
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone No:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="phone_number" id="phone_number" value="<?=(!empty($user_data->phone_number)) ? $user_data->phone_number : ''?>"> 
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
                        <input type="text" class="form-control form-control-sm" name="national_id" id="national_id" value="<?=(!empty($user_data->national_id)) ? $user_data->national_id : ''?>" onblur="checkifuserexits('<?php echo base_url('users/check_if_user_exists')?>','<?php echo base_url('users/display_specific_returned_device_user')?>');remove_input_error_class('national_id', 'national_id_span_id', 'Enter national ID');">
                        <span id="national_id_span_id" class="text-danger"></span>
                      
                        </div>
                        </div>
                </div>
                <div class="col-sm">
                      <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">County:</label>
                            <div class="col-sm-8">
                            <select class="custom-select mr-sm-2" name="county_id" id="county_id" style="font-size:12.5px;" onchange="load_sub_counties_dependent_dropdown('<?php echo base_url('region/fetch_subcounties_dropdown') ?>')">
                            <option selected>Select County</option>
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
                            <select class="custom-select mr-sm-2" name="sub_county_id_fk" id="sub_county_id_fk" style="font-size:12.5px;" onchange="load_sub_registration_offices_dependent_dropdown('<?php echo base_url('region/fetch_registration_offices_dropdown') ?>')">
                            <option value="0">Select Subcounty</option>                           
                            </select>
                            <span id="sub_county_id_fk_span_id" class="text-danger"></span>
                      
                            </div>
                            </div>      
                </div>
                <div class="col-sm">
                <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Registration Office:</label>
                            <div class="col-sm-8">
                            <select class="custom-select mr-sm-2" name="registration_office_id" id="registration_office_id" style="font-size:12.5px;" onchange="remove_input_error_class('registration_office_id', 'registration_office_id_id_fk_span_id', 'Select the registration office');">
                            <option value="0">Select Office</option>
                            </select>
                            <span id="registration_office_id_id_fk_span_id" class="text-danger"></span>
                      

                            </div>
                            </div>
                </div>
            </div>
 </div>
 </div>

 </div>
 <hr>
 <h6>Device Information</h6>
 <hr>
 <div id="device_information_div">
 <div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Name of Device</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="device_name" id="device_name"  value="<?=(!empty($device_data->device_name)) ? $device_data->device_name : ''?>" onblur="remove_input_error_class('device_name', 'device_name_fk_span_id', 'Enter device name');">
                        <span id="device_name_fk_span_id" class="text-danger"></span>
                      
                        </div>
                        </div>
                </div>
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Asset Tag Number.</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="asset_tag_number" id="asset_tag_number"  value="<?=(!empty($device_data->asset_tag_number)) ? $device_data->asset_tag_number : ''?>" onblur="checkifdeviceisreturned('<?php echo base_url('device/check_if_device_has_been_returned')?>','<?php echo base_url('users/display_specific_user')?>');remove_input_error_class('asset_tag_number', 'asset_tag_number_fk_span_id', 'Enter asset tag number');">
                        <span id="asset_tag_number_fk_span_id" class="text-danger"></span>
                      
                        </div>
                        </div>
                </div>
            </div>
 </div>
 <div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Serial No.</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="device_serial_no" id="device_serial_no"  value="<?=(!empty($device_data->device_name)) ? $device_data->device_name : ''?>" onblur="remove_input_error_class('device_serial_no', 'device_serial_no_span_id', 'Enter serial number');">
                        <span id="device_serial_no_span_id" class="text-danger"></span>
                      
                        </div>
                        </div>
                </div>
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">IMEI.</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="device_imei_no" id="device_imei_no"  value="<?=(!empty($device_data->device_name)) ? $device_data->device_name : ''?>" onblur="remove_input_error_class('device_imei_no', 'device_imei_no_span_id', 'Enter IMEI number');">
                        <span id="device_imei_no_span_id" class="text-danger"></span>
                      
                        </div>
                        </div>
                </div>
            </div>
 </div>
 <div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row">
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Reason:</label>
                        <div class="col-sm-8 ">
                        <select class="custom-select mr-sm-2" name="reason_for_return_id" id="reason_for_return_id" style="font-size:12.5px;" onchange="remove_input_error_class('reason_for_return_id', 'reason_for_return_id_span_id', 'Enter reason for return');">
                        <option value="0">Select Reason</option>
                        <?php
                            foreach($reasons_for_return_of_device as $return_reasons){
                            ?>
                            <option value="<?=$return_reasons->reason_for_returning_device_id?>"><?=$return_reasons->reason_for_returning_device_name?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <span id="reason_for_return_id_span_id" class="text-danger"></span>
                      
                        </div>
                        </div>
                </div>
                <div class="col-sm">
                <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Describe Reason for return:</label>
                        <div class="col-sm-8">
                       <textarea class="form-control" id="reason_for_returning_description" cols="30"></textarea>
                        </div>
                        </div>
                </div>
            </div>
 </div>
 <input type="hidden" class="form-control form-control-sm" id="device_id" value="<?=$device_id?>" >
 <input type="hidden" class="form-control form-control-sm" id="user_returning_device_id" value="<?=$user_returning_device_id?>" >
 <input type="hidden" class="form-control form-control-sm" id="required_email_message" value="A valid email is required" >
 <input type="hidden" class="form-control form-control-sm" id="required_national_id_message" value="Enter National ID" >
 <input type="hidden" class="form-control form-control-sm" id="required_device_name_message" value="Enter the device name" >
 <input type="hidden" class="form-control form-control-sm" id="required_device_serial_no_message" value="Enter the serial number" >
 <input type="hidden" class="form-control form-control-sm" id="required_device_imei_no_message" value="Enter the IMEI number" >
 <input type="hidden" class="form-control form-control-sm" id="required_asset_tag_no_message" value="Enter the asset tag number" >
 <input type="hidden" class="form-control form-control-sm" id="required_registration_office_id_message" value="Select a registration office" >
 <input type="hidden" class="form-control form-control-sm" id="required_first_name_message" value="Enter the first name" >
 <input type="hidden" class="form-control form-control-sm" id="required_second_name_message" value="Enter the second name" >
 <input type="hidden" class="form-control form-control-sm" id="required_phone_number_message" value="Enter phone number name" >
 <input type="hidden" class="form-control form-control-sm" id="requreed_reason_for_return_message" value="Select a reason" >
 <input type="hidden" class="form-control form-control-sm" id="invalid_phone_number_message" value="The phone number is invalid" >
 <input type="hidden" class="form-control form-control-sm" id="invalid_email_message" value="Invalid email address" >


<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row" style="display: flex;">
 <input type="button" class="btn btn-primary" onclick ="add_update_returned_device_info('<?php echo base_url('Device/add_edit_returned_device')?>','<?php echo base_url('device/load_returned_devices_list')?>')" value="Save Changes" style="flex: 1;"/>
        </div>
        </div>
</div>
 </div>



</form>
