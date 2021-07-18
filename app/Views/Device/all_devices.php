
<?php
$admin_function=3;
if($search_function ==0){
  ?>
<center><h3>All Devices</h3></center>
<form>
<div class="input-group mb-3">
    <input type="text" class="form-control" id="user_input" placeholder="Search here">
    <div class="input-group-append">
      <span class="input-group-text" onclick="search_on_table('<?php echo base_url('device/search_all_device')?>','#all_device_table_destination_id')">Search</span>
    </div>
  </div>
</form>
<?php
}?>
<div id="all_device_table_destination_id">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Device Name</th>
      <th scope="col">Serial No.</th>
      <th scope="col">Asset Tag No:</th>
      <th scope="col">Date Created:</th>
      <th scope="col">State:</th>
      <th scope="col">Received by:</th>
      <th scope="col" colspan="4"><center>Actions</center></th>
     
    </tr>
  </thead>
  <tbody>
      <?php
     

  $index =0;
  if(!empty($device_list)){

      foreach($device_list as $device_data){
        $index++;
      ?>
    <tr>
      <th scope="row"><?=$index?></th>
      <td><?=$device_data->device_name?></td>
      <td><?=$device_data->device_serial_no?></td>
      <td><?=$device_data->asset_tag_number?></td>
      <td><?=$device_data->date_created?></td>
      <?php if($device_data->is_returned==0){?>
        <td><span class="badge badge-info">Not returned</span></td> 
      <?php
      }else if($device_data->is_returned==1){
      ?>
      <td><span class="badge badge-success">Returned</span></td>
      <?php
      }
      ?>
      <td><?=$device_data->user_account_first_name?> <?=$device_data->user_account_second_name?></td>
      <td><button type="button" class="btn btn-primary btn-sm" onclick="load_form_to_edit_assets('<?=$device_data->device_id?>', '<?php echo base_url('device/load_add_edit_device_view')?>','<?=$admin_function?>')"> <i class="fa fa-edit" aria-hidden="true"></i>  Edit</button></td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_device_details('<?=$device_data->device_id?>','<?php echo base_url('device/delete_device')?>','<?php echo base_url('device/load_devices_list')?>','<?=$admin_function?>');"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
    </tr>
    <?php
    }
  }else{
    ?>
    <tr><td> No results found</td></tr>
    <?php
  }
  ?>
   
  </tbody>
</table>
</div>




