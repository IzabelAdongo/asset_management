<?php
if($search_function ==0){
  ?>
<center><h3>All Users</h3></center>

<form>
<div class="input-group mb-3">
    <input type="text" class="form-control" id="user_input" placeholder="Search here">
    <div class="input-group-append">
      <span class="input-group-text" onclick="search_on_table('<?php echo base_url('users/search_user')?>','#userz_table_destination_id')">Search</span>
    </div>
  </div>
</form>
<?php
}?>
<div id="userz_table_destination_id">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">National ID</th>
      <th scope="col">User Group</th>
      <th scope="col">Registration Office</th>
      <th scope="col" colspan="3"><center>Actions</center></th>
     
    </tr>
  </thead>
  <tbody>
      <?php
       $index =0;    
    if(!empty($users_list)){
        foreach($users_list as $users_data){
          $index++; 
      
      ?>
    <tr>
      <th scope="row"><?=$index?></th>
      <td><?=$users_data->user_account_first_name.' '.$users_data->user_account_second_name?></td>
      <td><?=$users_data->user_account_email?></td>
      <td><?=$users_data->phone_number?></td>
      <td><?=$users_data->user_account_national_id?></td>
      <td><?=$users_data->user_group_name?></td>
      <td><?=$users_data->registration_office_name?></td>
      <td><button type="button" class="btn btn-primary btn-sm" onclick="load_form_to_edit_users(<?=$users_data->user_account_id?>, '<?php echo base_url('users/load_add_edit_users_views')?>')">  <i class="fa fa-edit" aria-hidden="true"></i> Edit</button></td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_user_details('<?=$users_data->user_account_id?>','<?php echo base_url('users/delete_user')?>','<?php echo base_url('users/load_users_list')?>')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
    </tr>
    <?php
    }
  }else{
    ?>
     <tr><td colspan="8">No Results Found</td></tr>
   
    <?php
  }?>
   
  </tbody>
</table>
  </div>