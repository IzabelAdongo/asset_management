<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="<?php echo base_url('Dashboard/admin_dashboard')?>">Asset Management</a>

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Dashboard/admin_dashboard')?>">Home</a>
    </li>
     <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      Devices
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="javascript:void(0)" onclick="load_add_edit_returned_devices_page(0, 0,'<?php echo base_url('device/load_add_returned_edit_device_view')?>')">Return A Device</a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="load_all_devices_table('<?php echo base_url('device/load_devices_list')?>')">All Returned Devices</a>
      </div>
    </li>
    <?php 
    if($session->get('user_group_id_fk')==3){
      ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">  
      Users
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="javascript:void(0)" onclick="load_add_edit_users_views(0,'<?php echo base_url('users/load_add_edit_users_views')?>')">Add User</a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="load_all_users_table('<?php echo base_url('users/load_users_list')?>')">All Users</a>
      </div>
    </li>
    <?php
    }?>
  </ul>
  
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo base_url('Auth/log_out')?>">Logout</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo $session->get('user_account_first_name');?> <?php echo $session->get('user_account_second_name');?></a>
        </li>
      </ul>
    </div>
</nav>