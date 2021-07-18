<form style="width:70%; margin:auto;">
<center><h4>Add a registration office</h4></center>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Name of Registration office</label>
    <div class="col-sm-8">
    <input type="text" class="form-control form-control-sm" id="registration_office_name"  value="<?=(!empty($registration_office_data->registration_office_name)) ? $registration_office_data->registration_office_name : ''?>" onblur="remove_input_error_class('registration_office_name', 'registration_office_name_span_id', 'Enter office name');">
    <span id="registration_office_name_span_id" class="text-danger"></span>
                     
    </div>
</div>
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">County.</label>
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
<div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Sub County.</label>
    <div class="col-sm-8">
    <select class="custom-select mr-sm-2" name="sub_county_id_fk" id="sub_county_id_fk" style="font-size:12.5px;" onchange="load_sub_registration_offices_dependent_dropdown('<?php echo base_url('region/fetch_registration_offices_dropdown') ?>')">
                            <option value="0">Select Subcounty</option>                           
                            </select>
     <span id="sub_county_id_fk_span_id" class="text-danger"></span>
 
    </div>
</div>
<input type="hidden" class="form-control form-control-sm" id="registration_office_id" value="<?=$registration_office_id?>" >
<input type="hidden" class="form-control form-control-sm" id="country_required_msg" value="Select a country" >
<input type="hidden" class="form-control form-control-sm" id="sub_county_required_msg" value="select a sub county" >
<input type="hidden" class="form-control form-control-sm" id="duplicate_name" value="An office with the same name already exists" >
<input type="hidden" class="form-control form-control-sm" id="reuired_name_msg" value="Name is required" >
<input type="hidden" class="form-control form-control-sm" id="redirect_url" value="<?php echo base_url('region/load_add_edit_registration_office_views')?>" >



<div class="container" style="margin:0 auto; width:100%;"> 
            <div class="row" style="display: flex;">
            <input type="button" class="btn btn-primary" onclick ="add_update_registration_office_info('<?php echo base_url('Region/add_edit_registration_office')?>')" value="Save Changes" style="flex: 1;"/>
 
</div>
</div>
</form>
<p>&nbsp;</p>

<div id="registration_offices">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Registration office name</th>
      <th scope="col">Subcounty</th>
      <th scope="col">County</th>
      <th scope="col" colspan="2"><center>Actions</center></th>
     
    </tr>
  </thead>
  <tbody>
      <?php
      if(!empty($all_offices)){
       $index =0;
        foreach($all_offices as $office_data){
            $index ++;
      ?>
    <tr>
      <th scope="row"><?=$index?></th>
      <td><?=$office_data->registration_office_name?></td>
      <td><?=$office_data->subcounty_name?></td>
      <td><?=$office_data->county_name?></td>
      <td><button type="button" class="btn btn-primary btn-sm" onclick="load_add_edit_region_page('<?=$office_data->registration_office_id?>','<?php echo base_url('region/load_add_edit_registration_office_views')?>')"><i class="fa fa-edit" aria-hidden="true"></i>  Edit</button></td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_office_details('<?=$office_data->registration_office_id?>','<?php echo base_url('region/delete_registration_office')?>')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
    </tr>
    <?php
    }
}else{
    ?>
    <tr><td colspan="6"><center>No results found</center></td></tr>
<?php

}
    ?>
   
  </tbody>
</table>
</div>