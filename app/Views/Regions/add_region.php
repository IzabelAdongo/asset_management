<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard</title>

<meta charset="utf-8" />
<!-- Boostrap 4 resources -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Fot awesome -->
<script src="https://use.fontawesome.com/0f14901773.js"></script>
</head>
<body>
    <?php
    if($region_id >0){
        ?>
        <form style="width:90%; margin:auto;">
        <?php
    }else{?>

<form style="width:70%; margin:auto;">
   <center><h4>Add a Region</h4></center>
   <?php
    }
   ?>
  
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
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Subcounty:</label>
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
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Region Telephone Number:</label>
    <div class="col-sm-8">
    <input type="phone" class="form-control form-control-sm" id="region_telephone" placeholder="col-form-label-sm" value="<?=(!empty($region_data->region_telephone)) ? $region_data->region_telephone : ''?>">
    </div>
</div>

<input type="hidden" class="form-control form-control-sm" id="region_id" value="<?=$region_id?>" placeholder="col-form-label-sm">
<input type="hidden" class="form-control form-control-sm" id="redirect_url" value="<?php echo base_url('region/load_regions_list')?>" placeholder="col-form-label-sm">
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-8 col-form-label col-form-label-sm">&nbsp;</label>
    <div class="col-sm-4">
    <button type="input" class="btn btn-primary" onclick ="add_update_region_info('<?php echo base_url('Region/add_edit_region')?>')">Save</button>
    </div>
</div>

</form>
</body>
</html>