
<?php
 $session = session();
 $store_keeper_function=2;
 $view_page=1;
 ?>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col" colspan="4"><center>Device Details</center></th>    
    </tr>
  </thead>
  <tbody>
  <tr>
  <td scope="col" style="background-color:#504C4C; color:white;">
  Device Name:
  </td>
 
  <td>
  <?=(!empty($device_data->device_name)) ? $device_data->device_name : ''?>
  </td>
  <td scope="col" style="background-color:#504C4C; color:white;">
  Returned By:
  </td>
  <td>
  <?=$device_data->first_name?> <?=$device_data->second_name?>
  </td>
  </tr>
  <tr>
  <td scope="col" style="background-color:#504C4C; color:white;">
  IMEI No.:
  </td>
  <td>
  <?=$device_data->device_imei_no?>
  </td>
  <td scope="col" style="background-color:#504C4C; color:white;">
  Returned Date:
  </td>
  <td>
  <?=$device_data->date_of_return?>
  </td>
  </tr>
  <tr>
  <td scope="col" style="background-color:#504C4C; color:white;">
  Asset tag Number:
  </td>
  <td>
  <?=$device_data->asset_tag_number?>
  </td>
  <td scope="col" style="background-color:#504C4C; color:white;">
  Received By:
  </td>
  <td>
  <?=$device_data->user_account_first_name?> <?=$device_data->user_account_second_name?>
  </td>
  </tr>
  <tr>
  <td scope="col" style="background-color:#504C4C; color:white;">
  Reason for Return:
  </td>
  <td>
  <?=$device_data->reason_for_returning_device_name?>
  </td>
  <td scope="col">
    </td>
  <td scope="col" style="background-color:#504C4C; color:white; float:right;">
  <button type="button" class="btn btn-warning btn-sm" onclick="load_form_to_edit_assets('<?=$device_data->device_id?>', '<?php echo base_url('device/load_add_edit_device_view')?>','<?=$store_keeper_function?>')" ><i class="fa fa-edit" aria-hidden="true"></i> Edit Device Information</button>
  <button type="button" class="btn btn-primary btn-sm" onclick="load_form_to_edit_users_returned_device('<?=$device_data->user_returning_device_id?>', '<?php echo base_url('users/load_add_edit_user_returned_device_views')?>','<?=$view_page?>','<?=$device_data->device_id?>')"><i class="fa fa-user"></i> Edit User Information</button>
  </td>
  </tr>
  <tr>
  <th colspan="4">
  <center>Further details on return:<center>
  </th>
  <tr>
  <tr>
  <td colspan="4" rowspan="4">
 <center> <?=$device_data->reason_for_returning_description?></center>
  </td>
  </tr>
    
    
  
  </tbody>
</table>