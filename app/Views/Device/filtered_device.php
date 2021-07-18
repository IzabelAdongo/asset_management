
<div class="alert alert-danger" role="alert">
<center><h6> Kindly note that this device has already been returned</h6><center>
<div id="table_div">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Device Name</th>
      <th scope="col">Serial No.</th>
      <th scope="col">Asset Tag No:</th>
      <th scope="col">Returned date.</th>
      <th scope="col">Returned by:</th>    
      <th scope="col">Received by</th>
     
    </tr>
  </thead>
  <tbody>
   
    <tr>
      
      <td><?=$check_if_device_exists->device_name?></td>
      <td><?=$check_if_device_exists->device_serial_no?></td>
      <td><?=$check_if_device_exists->asset_tag_number?></td>
      <td><?=$check_if_device_exists->date_of_return?></td>
      <td><?=$check_if_device_exists->first_name?>&nbsp;<?=$check_if_device_exists->second_name?></td> 
      <td><?=$check_if_device_exists->user_account_first_name?>&nbsp;<?=$check_if_device_exists->user_account_second_name?></td>  
      </tr>
   
   
  </tbody>
</table>
</div>
</div>




