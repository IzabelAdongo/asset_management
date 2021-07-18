

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
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Assigned Region:</label>
    <div class="col-sm-8">
    <input type="input" class="form-control form-control-sm" id="formerly_assigned_region" value="1" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Reason For Returning:</label>
    <div class="col-sm-8">
    <select class="custom-select mr-sm-2" id="device_condition">
        <option selected>Choose...</option>
        <option value="2">Faulty</option>
        <option value="2">Other Reasons</option>
      </select>
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Elaborate of Reason for Returning:</label>
    <div class="col-sm-8">
    <textarea class="form-control form-control-sm" id="reason_for_returning"></textarea>
    </div>
</div>

<input type="text" class="form-control form-control-sm" id="device_id" value="<?=$device_id?>" placeholder="col-form-label-sm">
<input type="hidden" class="form-control form-control-sm" id="device_status" value="2" placeholder="col-form-label-sm">
<input type="hidden" class="form-control form-control-sm" id="assigned_by" value="1" placeholder="col-form-label-sm">
<input type="hidden" class="form-control form-control-sm" id="redirect_url" value="<?php echo base_url('device/load_devices_list')?>" placeholder="col-form-label-sm">


<div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick ="return_devices('<?php echo base_url('Device/return_a_device')?>')">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

</form>
