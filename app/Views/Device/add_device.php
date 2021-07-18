<?php
 $session = session();
 $admin_function=3;
 $store_keeper_function=2;
if($device_id ==0){
    ?>
    <form style="width:70%; margin:auto;">
    <center><h4>Add a device</h4></center>
    <?php
}else{
?>
<form style="width:90%; margin:auto;">
<?php
}

?>
   
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Name of Device</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="device_name"  value="<?=(!empty($device_data->device_name)) ? $device_data->device_name : ''?>" onblur="remove_input_error_class('device_name', 'device_name_span_id', 'Enter device name');">
    <span id="device_name_span_id" class="text-danger"></span>
                     
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Asset Tag Number.</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="asset_tag_number"  value="<?=(!empty($device_data->asset_tag_number)) ? $device_data->asset_tag_number : ''?>" onblur="remove_input_error_class('asset_tag_number', 'asset_tag_number_span_id', 'Enter asset tag number');" >
    <span id="asset_tag_number_span_id" class="text-danger"></span>
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Serial No.</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="device_serial_no"  value="<?=(!empty($device_data->device_serial_no)) ? $device_data->device_serial_no : ''?>" onblur="remove_input_error_class('device_serial_no', 'device_serial_no_span_id', 'Enter serial number');" >
    <span id="device_serial_no_span_id" class="text-danger"></span>
 
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">IMEI.</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="device_imei_no"  value="<?=(!empty($device_data->device_imei_no)) ? $device_data->device_imei_no : ''?>" onblur="remove_input_error_class('device_imei_no', 'device_imei_no_span_id', 'Enter IMEI number');" >
    <span id="device_imei_no_span_id" class="text-danger"></span>
    </div>
</div>
<?php
if($user_function==$admin_function){
    ?>
<input type="hidden"  id="reason_for_return_id"  value="<?=(!empty($device_data->reason_for_return_id)) ? $device_data->reason_for_return_id : 0?>">
<input type="hidden" id="reason_for_returning_description"  value="<?=(!empty($device_data->reason_for_returning_description)) ? $device_data->reason_for_returning_description : ''?>">
<input type="hidden" id="admin_function_edit"  value="<?=$admin_function?>">

<?php
}else if ($user_function==$store_keeper_function)
{
?>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Reason for return.</label>
    <div class="col-sm-8">
    <select class="custom-select mr-sm-2" id="reason_for_return_id" style="font-size:12.5px;" onchange="remove_input_error_class('reason_for_return_id', 'reason_for_return_id_span_id', 'Enter reason for return');">
    <option value="<?=(!empty($device_data->reason_for_returning_device_id)) ? $device_data->reason_for_returning_device_id : 0?>"><?=(!empty($device_data->reason_for_returning_device_name)) ? $device_data->reason_for_returning_device_name : "Select Resason"?></option>
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
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Description.</label>
    <div class="col-sm-8">
    <textarea class="form-control" id="reason_for_returning_description" cols="30" value=""><?=(!empty($device_data->reason_for_returning_description)) ? $device_data->reason_for_returning_description : ""?></textarea>
     <span id="reason_for_returning_description_span_id" class="text-danger"></span>
    </div>
</div>
<input type="hidden" id="admin_function_edit"  value="<?=$store_keeper_function?>">

<?php
}
?>

    </div>
</div>
</div>
</div>


<input type="hidden" class="form-control form-control-sm" id="device_id" value="<?=$device_id?>" >
<input type="hidden" class="form-control form-control-sm" id="redirect_url" value="<?php echo base_url('device/load_devices_list')?>" >
<input type="hidden" class="form-control form-control-sm" id="redirect_url_store_keeper" value="<?php echo base_url('device/load_returned_devices_list')?>" >
<input type="hidden" class="form-control form-control-sm" id="is_returned" value="<?=(!empty($device_data->is_returned)) ? $device_data->is_returned : 0?>" >
<input type="hidden" class="form-control form-control-sm" id="required_device_name_message" value="Enter the device name" >
 <input type="hidden" class="form-control form-control-sm" id="required_device_serial_no_message" value="Enter the serial number" >
 <input type="hidden" class="form-control form-control-sm" id="required_device_imei_no_message" value="Enter the IMEI number" >
 <input type="hidden" class="form-control form-control-sm" id="required_asset_tag_no_message" value="Enter the asset tag number" >
 <input type="hidden" class="form-control form-control-sm" id="user_function" value="<?=$user_function?>" >
 <input type="hidden" class="form-control form-control-sm" id="required_return_id_message" value="Select Resason for Return" >

 
<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row" style="display: flex;">
            <input type="button" class="btn btn-primary" onclick ="add_update_device_info('<?php echo base_url('Device/add_edit_device')?>')" value="Save Changes" style="flex: 1;"/>
 
        </div>
        </div>



</form>
