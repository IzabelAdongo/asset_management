

<?php
 $session = session();
 $store_keeper_function=2;


if($search_function ==0){
  ?>
<center><h3>All Returned Devices</h3></center>
<form>
<div class="input-group mb-3">
    <input type="text" class="form-control" id="user_input" placeholder="Search here">
    <div class="input-group-append">
      <span class="input-group-text" onclick="search_on_table('<?php echo base_url('device/search_device')?>','#returned_device_table_destination_id')">Search</span>
    </div>
  </div>
</form>
<?php
}?>
<div id="returned_device_table_destination_id">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Device Name</th>
      <th scope="col">Serial No.</th>`
      <th scope="col">Asset tag</th>
      <th scope="col">Returned by.</th>
      <th scope="col">Returned Date</th>
      <th scope="col">Return Reason</th>
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
      <td><?=$device_data->first_name?>&nbsp;<?=$device_data->second_name?></td>
      <td><?=$device_data->date_of_return?></td>
      <td><span class="badge badge-danger"><?=$device_data->reason_for_returning_device_name?></span></td>
      <td><button type="button" class="btn btn-success btn-sm" onclick="global_load_view_device_to_dashboard_div('<?=$device_data->device_id?>', '<?php echo base_url('device/load_view_device_view')?>')"> <i class="fa fa-eye" aria-hidden="true"></i> View</button></td>
         <?php
      if($session->get('user_group_id_fk')==3){
        ?>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_device_details('<?=$device_data->device_id?>','<?php echo base_url('device/delete_device')?>','<?php echo base_url('device/load_returned_devices_list')?>','<?=$store_keeper_function?>');"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
      </tr> 
      
      <?php
      }
      }
    }else{
      ?>
      <tr><td colspan="8">No Results Found</td></tr>
      <?php
    }
    ?>  
    
  </tbody>
</table>
    </div>