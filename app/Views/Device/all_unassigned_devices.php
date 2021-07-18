
<center><h3>All Unassigned Devices</h3></center>
<form>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Enter IMMEI or SERIAL NUMBER">
    <div class="input-group-append">
      <span class="input-group-text">Search</span>
    </div>
  </div>
</form>
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Device Name</th>
      <th scope="col">Serial No.</th>
      <th scope="col">Registered State.</th>
      <th scope="col">Registered Date:</th>
      <th scope="col">Registered By:</th>
      <th scope="col">Current State:</th>
      <th scope="col" colspan="4"><center>Actions</center></th>
     
    </tr>
  </thead>
  <tbody>
      <?php
     

      foreach($device_list as $device_data){
      
      ?>
    <tr>
      <th scope="row">1</th>
      <td><?=$device_data->device_name?></td>
      <td><?=$device_data->device_name?></td>
      <?php if($device_data->devic_state_id==1){
          ?>
      <td>New</td>
      <?php
      }else{

      ?>
      <td>Existing</td>
      <?php
      }
      ?>
      <td><?=$device_data->date_created?></td>
      <td><?=$device_data->user_account_name?></td>
      <?php
      if($device_data->device_status==0){
      ?>

      <td><span class="badge badge-info">Unassigned</span></td>
      <?php
      }else if($device_data->device_status==1){
      ?>
      <td><span class="badge badge-success">Assigned</span></td>
      <?php
      }else if($device_data->device_status==2){
          ?>
      <td><span class="badge badge-danger">Faulty</span></td>
          <?php

      }
      if($device_data->device_status==1){
      ?>
      <td><button type="button" class="btn btn-warning btn-sm" disabled>Assign</button></td>
      <td><button type="button" class="btn btn-primary btn-sm" disabled>Edit</button></td>
      <td><button type="button" class="btn btn-success btn-sm" onclick="load_form_to_return_assets(<?=$device_data->device_id?>, '<?php echo base_url('device/load_page_return_device')?>')">Returned</button></td>
      <?php
      }else{
      ?>
      <td><button type="button" class="btn btn-warning btn-sm" onclick="load_form_to_assign_assets(<?=$device_data->device_id?>, '<?php echo base_url('device/load_page_assign_device')?>')">Assign</button></td>
      <td><button type="button" class="btn btn-primary btn-sm" onclick="load_form_to_edit_assets('<?=$device_data->device_id?>', '<?php echo base_url('device/load_add_edit_device_view')?>')">Edit</button></td>
      <td><button type="button" class="btn btn-success btn-sm" disabled>Returned</button></td>
      <?php
      }
      ?>
      
      <!-- <td><button type="button" class="btn btn-danger btn-sm">Delete</button></td> -->
    </tr>
    <?php
    }
    ?>
   
  </tbody>
</table>




