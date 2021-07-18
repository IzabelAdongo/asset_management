<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>

<meta charset="utf-8" />
<link  rel="stylesheet" type="text/css" href="<?php echo base_url('css/login.css'); ?>" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('js/auth.js'); ?>"></script>
<!-- Resources -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<!-- end of Resources -->
</head>
<body>
<div style="">
<!-- <p style="height:100px;">&nbsp;</p> -->


<div class="wrapper fadeInDown">
<center><h3>Asset Management</h3></center>
<p>&nbsp;</p>
  <div id="formContent">
    <!-- Tabs Titles -->
    <h5 class="tablinks active underlineHover" onclick="signin_via_email('signi_nvia_email')"> Sign in via Email</h5>
    <h5 class="tablinks inactive underlineHover" onclick="signin_via_email('signiin_via_id')">Sign in via ID </h5>

    <!-- Icon -->
    <div class="fadeIn first">
      
    </div>

    <!-- Login Form -->
    <div class="tab__content" id="signi_nvia_email" >
    <?php if(session()->getFlashdata('msg')):?>
     <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
    <?php endif;?>
    <form action="<?php echo base_url('auth/login'); ?>" method="post">
     
      <input type="password" id="password" class="fadeIn third" name="password"  placeholder="password">
      <input type="hidden" name="login_url" id="login_url" value="<?php echo base_url('Auth/login')?>">
      <input type="hidden" name="national_id" id="national_id" value="">
      <input type="submit" class="fadeIn fourth" value="Log In">
      
      <?php 
      // echo base_url('auth/login'); ?>
    </form>
       </div>
    <div class="tab__content" id="signiin_via_id" style="display:none">
    <?php if(session()->getFlashdata('msg')):?>
    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
    <?php endif;?>
    <form action="<?php echo base_url('auth/login'); ?>" method="post">
      <input type="text" class="fadeIn second" name="national_id" id="national_id" placeholder="National ID">
      <input type="password" class="fadeIn third" name="password" id="password" placeholder="password">
      <input type="hidden" name="email" id="email" value="">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>
     </div>
     <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

    

    

  </div>
</div>
</div>

                   
</div>

   
</body>
</html>




