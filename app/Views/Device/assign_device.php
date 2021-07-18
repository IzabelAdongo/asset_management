<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard</title>

<meta charset="utf-8" />
<!-- Boostrap 4 resources -->
<!-- Latest compiled and minified CSS -->
</head>
<body>

<form style="width:90%; margin:auto;"> 
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Device name:</label>
    <div class="col-sm-8">
    <input type="input" class="form-control form-control-sm" id="region_number" value="<?=$device_data->device_name?>" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Device Status:</label>
    <div class="col-sm-8">
    <input type="input" class="form-control form-control-sm" id="region_number" value="AVAILABLE" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Device Number:</label>
    <div class="col-sm-8">
    <input type="input" class="form-control form-control-sm" id="region_number" value="<?=$device_data->device_serial_no?>" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">County:</label>
    <div class="col-sm-8">
    <select class="custom-select mr-sm-2" id="county_id">
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
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">SubCounty:</label>
    <div class="col-sm-8">
    <select class="custom-select mr-sm-2" id="sub_county_id_fk">
        <option selected>Choose...</option>
        <?php
        foreach($subcounties as $sub_county){
            ?>
        <option value="<?=$sub_county->subcounty_id?>"><?=$sub_county->subcounty_name?></option>
        <?php
        }
        ?>
      </select>
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Registration Office:</label>
    <div class="col-sm-8">
    <select class="custom-select mr-sm-2" id="registration_offce_id_fk">
        <option selected>Choose...</option>
        <?php
        foreach($registration_offices as $reg_office){
            ?>
        <option value="<?=$reg_office->registration_office_id?>"><?=$reg_office->registration_office_name?></option>
        <?php
        }
        ?>
      </select>
   
    </div>
</div>

<input type="text" class="form-control form-control-sm" id="device_id" value="<?=$device_data->device_id?>" placeholder="col-form-label-sm">
<input type="hidden" class="form-control form-control-sm" id="device_status" value="1" placeholder="col-form-label-sm">
<input type="hidden" class="form-control form-control-sm" id="assigned_by" value="1" placeholder="col-form-label-sm">
<input type="hidden" class="form-control form-control-sm" id="redirect_url" value="<?php echo base_url('device/load_devices_list')?>" placeholder="col-form-label-sm">

<div class="modal-footer">

        <button type="button" class="btn btn-primary" onclick ="assign_device_to_region('<?php echo base_url('Device/assign_device_to_region')?>')">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

</form>
</body>
</html>