<div class="alert alert-warning" role="alert">

<center>This user already exists. You can edit their details or proceed to fill in the device information below</center>
    <table class="table">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">National ID</th>
      <th scope="col" colspan="2">Actions</th>
     
    </tr>
  </thead>
  <tbody>
    <?php
    $list_page=0;
    if(!empty($users_list)){
      foreach($users_list as $user_data){
        ?>
      
    <tr>
      
      <td><?=$user_data->first_name.' '.$user_data->second_name?></td>
      <td><?=$user_data->email?></td>
      <td><?=$user_data->email?></td>
      <td><?=$user_data->national_id?></td>
      <td><button type="button" class="btn btn-primary btn-sm" onclick="load_form_to_edit_users_returned_device('<?=$user_data->user_returning_device_id?>', '<?php echo base_url('users/load_add_edit_user_returned_device_views')?>','<?=$list_page?>','0')"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></td>
      <!-- <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_user_details('<?=$user_data->user_returning_device_id?>','<?php echo base_url('users/delete_device_user')?>','<?php echo base_url('users/display_specific_returned_device_user')?>')">Delete</button></td> -->
      </tr>
    <?php
      }
    }
      ?>
   
   
  </tbody>
</table>
</div>