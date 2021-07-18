<center><h3>All Regions</h3></center>
<form>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Enter county name">
    <div class="input-group-append">
      <span class="input-group-text">Search</span>
    </div>
  </div>
</form>
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">County</th>
      <th scope="col">Subcounty</th>
      <th scope="col">Telephone</th>
      <th scope="col">Registration Office</th>
      <th scope="col" colspan="3"><center>Actions</center></th>
     
    </tr>
  </thead>
  <tbody>
      <?php
        foreach($regions_list as $device_data){
      
      ?>
    <tr>
      <th scope="row">1</th>
      <td><?=$device_data->county_name?></td>
      <td><?=$device_data->subcounty_name?></td>
      <td><?=$device_data->region_telephone?></td>
      <td><?=$device_data->registration_office_name?></td>
      <td><button type="button" class="btn btn-primary btn-sm" onclick="load_form_to_edit_region(<?=$device_data->region_id?>, '<?php echo base_url('region/load_add_edit_region_views')?>')">Edit</button></td>
      <td><button type="button" class="btn btn-danger btn-sm">Delete</button></td>
    </tr>
    <?php
    }
    ?>
   
  </tbody>
</table>