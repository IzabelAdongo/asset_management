<?php
 $session = session();
 $admin_function=3;
 $store_keeper_function=2;

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard</title>

<meta charset="utf-8" />

<link  rel="stylesheet" type="text/css" href="<?php echo base_url('css/dashboard.css'); ?>" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('js/dashboard.js'); ?>"></script>
<!-- Boostrap 4 resources -->
<!-- Latest compiled and minified CSS -->

<script src="https://use.fontawesome.com/0f14901773.js"></script>
<!-- jQuery library -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->

<!-- Sweet Alerts -->
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Fot awesome -->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- International Telephone -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"
        integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"
        integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg=="
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        integrity="sha512-BNZ1x39RMH+UYylOW419beaGO0wqdSkO7pi1rYDYco9OL3uvXaC/GTqA5O4CVK2j4K9ZkoDNSSHVkEQKkgwdiw=="
        crossorigin="anonymous"></script>


</head>
<body>


<!-- Transfer to header -->

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="<?php echo base_url('Dashboard/admin_dashboard')?>"><strong>Asset Management</strong></a>

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Dashboard/admin_dashboard')?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
    </li>
     <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      <i class="fa fa-mobile" aria-hidden="true"></i> Devices
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="javascript:void(0)" onclick="load_add_edit_returned_devices_page(0, 0,'<?php echo base_url('device/load_add_returned_edit_device_view')?>')"><i class="fa fa-desktop" aria-hidden="true"></i> Return Device</a>
        <hr>
        <a class="dropdown-item" href="javascript:void(0)" onclick="global_load_all_table_to_dashboard_div('<?php echo base_url('device/load_returned_devices_list')?>')"><i class="fa fa-list" aria-hidden="true"></i> Returned Devices</a>
        <?php if($session->get('user_group_id_fk')==3){
      ?>
          <hr>
       <a class="dropdown-item" href="javascript:void(0)" onclick="load_add_edit_devices_page(0, '<?php echo base_url('device/load_add_edit_device_view')?>','<?=$admin_function?>')"><i class="fa fa-plus" aria-hidden="true"></i> Add New Device</a>
       <hr>
       <a class="dropdown-item" href="javascript:void(0)" onclick="load_all_devices_table('<?php echo base_url('device/load_devices_list')?>')"><i class="fa fa-files-o" aria-hidden="true"></i> All Devices</a>
        
      <?php
        }
        ?>
       
      </div>
    </li>
    <?php if($session->get('user_group_id_fk')==3){
      ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      <i class="fa fa-bars" aria-hidden="true"></i> Setup
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="javascript:void(0)" onclick="load_add_edit_users_views(0,'<?php echo base_url('users/load_add_edit_users_views')?>')"> <i class="fa fa-users" aria-hidden="true"></i> Add User</a>
        <hr>
        <a class="dropdown-item" href="javascript:void(0)" onclick="load_all_users_table('<?php echo base_url('users/load_users_list')?>')"> <i class="fa fa-users" aria-hidden="true"></i> All Users</a>
        <hr>
        <a class="dropdown-item" href="javascript:void(0)" onclick="load_add_edit_region_page(0,'<?php echo base_url('region/load_add_edit_registration_office_views')?>')"><i class="fa fa-globe" aria-hidden="true"></i> Add Region</a>
       </div>
    </li>
    <?php
    }?>
  </ul>
 
 
  
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav"> 
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      <i class="fa fa-cog" aria-hidden="true"></i> Settings
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="javascript:void(0)" onclick="load_view_to_update_first_time_user_passwords('<?=$session->get('user_account_id')?>','<?=$session->get('last_login')?>','<?php echo base_url('auth/load_update_password_view')?>','0')"> <i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
        <hr>
        <a class="dropdown-item" href="<?php echo base_url('Auth/log_out')?>"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>   
      </div>
    </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i>  <?php echo $session->get('user_account_first_name');?> <?php echo $session->get('user_account_second_name');?></a>
        </li>
      </ul>
    </div>
</nav>

<!-- Header -->

<div class="container p-3 my-3 border" id="admin_main_container" >
<center><h3>Mini-Summary</h3></center>
<div class="row" style="margin:10px;">
    <div class="col-xl-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
              <i class="fa fa-handshake-o" aria-hidden="true" style="font-size:34px;"></i>
               
              </div>
              <div class="media-body text-right">
                <h3><?=$number_of_returned_device->total?></h3>
                <span>Returned Devices</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
              <i class="fa fa-laptop" aria-hidden="true" style="font-size:34px;"></i>
              </div>
              <div class="media-body text-right">
                <h3><?=$number_of_faulty_device->total?></h3>
                <span>Faulty Devices</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
              <i class="fa fa-hand-o-left" aria-hidden="true" style="font-size:34px;"></i>
              </div>
              <div class="media-body text-right">
                <h3><?=$number_of_device_users->total?></h3>
                <span>Returned Device Users</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
      if($session->get('user_group_id_fk')==3){
        ?>
    <div class="col-xl-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
              <i class="fa fa-trophy" aria-hidden="true" style="font-size:34px;"></i>
              </div>
              <div class="media-body text-right">
                <h3><?=$number_of_reusable_device_users->total?></h3>
                <span>Logged-in Users</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
      }else
      if($session->get('user_group_id_fk')==2){
      ?>
      <div class="col-xl-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="align-self-center">
              <i class="fa fa-trophy" aria-hidden="true" style="font-size:34px;"></i>
              </div>
              <div class="media-body text-right">
                <h3>0</h3>
                <span>Reusable Devices</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
      }
      ?>
  
 
    <!-- table -->
   
<center><h3>All Returned Devices</h3></center>
<form>
<div class="input-group mb-3">
    <input type="text" class="form-control" id="user_input" placeholder="Search here">
    <div class="input-group-append">
      <span class="input-group-text" onclick="search_on_table('<?php echo base_url('device/search_device')?>','#returned_device_dashboard')">Search</span>
    </div>
  </div>
</form>
<div id="returned_device_dashboard">
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
     

      foreach($returned_device_list as $device_data){
      
      ?>
    <tr>
      <th scope="row">1</th>
      <td><?=$device_data->device_name?></td>
      <td><?=$device_data->device_serial_no?></td>
      <td><?=$device_data->asset_tag_number?></td>
      <td><?=$device_data->first_name?>&nbsp;<?=$device_data->second_name?></td>
      <td><?=$device_data->date_of_return?></td>
      <td><span class="badge badge-danger"><?=$device_data->reason_for_returning_device_name?></span></td>
      <!-- <td><button type="button" class="btn btn-warning btn-sm" onclick="load_form_to_assign_assets(<?=$device_data->device_id?>, '<?php echo base_url('device/load_page_assign_device')?>')">Assign</button></td> -->
      <td><button type="button" class="btn btn-success btn-sm" onclick="global_load_view_device_to_dashboard_div('<?=$device_data->device_id?>', '<?php echo base_url('device/load_view_device_view')?>')"><i class="fa fa-eye" aria-hidden="true"></i> View</button></td>
      <?php
      if($session->get('user_group_id_fk')==3){
        ?>
       <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_device_details('<?=$device_data->device_id?>','<?php echo base_url('device/delete_device')?>','<?php echo base_url('device/load_returned_devices_list')?>','<?=$store_keeper_function?>');"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
     
      <?php
      }
      }
      ?>  
    </tr> 
  </tbody>
</table>
</div>
</div>
</body>
</html>
<div class="modal" tabindex="-1" role="dialog" id="main_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="main_modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body" id="main_modal_body">
        
      </div>
     

    </div>
  </div>
</div>


<div class="modal fade" id="password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_passwordModalLabel"></h5>
      </div>
      <div class="modal-body" id="update_password_modal_body">
     
      </div>
      <!-- <div class="modal-footer">
       <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<script>
$( document ).ready(function() {
let user_account_id= '<?=$session->get('user_account_id')?>';
let user_last_login='<?=$session->get('last_login')?>';
let user_update_password_url='<?php echo base_url('auth/load_update_password_view')?>';
let new_user=1;
  load_view_to_update_first_time_user_passwords(user_account_id,user_last_login,user_update_password_url,new_user);
   
});

</script>