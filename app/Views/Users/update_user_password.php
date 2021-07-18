<link  rel="stylesheet" type="text/css" href="<?php echo base_url('css/password.css'); ?>" />
<?php
if($new_user==0){
        ?>
<center><h5>Update User Password</h5></center>
<?php
}
?>
<div id="return_user_information_div">
<div class="container" style="margin:0 auto; width:80%;"> 
            <div class="row">
                <div class="col-sm">

                
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">New Password:</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control form-control-sm" id="new_password">
                        <span id="new_password_span_id" class="text-danger"></span>
  
                        </div>
                        </div>
                </div>
</div>
<div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
</div>
<div class="container" style="margin:0 auto; width:80%;"> 
            <div class="row">
                <div class="col-sm">
                        <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Confirm Password:</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control form-control-sm" id="confirm_password"> 
                        <span id="confirm_password_span_id" class="text-danger"></span>
                        </div>
                        </div>
                </div>
                
            </div>
 </div>

 
 
 <input type="hidden" class="form-control form-control-sm" id="user_account_id" value="<?=$user_account_id?>">
 <input type="hidden" class="form-control form-control-sm" id="password_field_required_message" value="This is a required field" >
 <input type="hidden" class="form-control form-control-sm" id="confirm_password_field_required_message" value="This is a required field" >
 <input type="hidden" class="form-control form-control-sm" id="password_mismatch_message" value="The passwords do not match" >

<div class="container" style="margin:0 auto; width:60%;"> 
            <div class="row" style="display: flex;">
 <input type="button" class="btn btn-primary" onclick ="update_user_password('<?php echo base_url('auth/update_user_password')?>')" value="Update Password" style="flex: 1;"/>
        </div>
        </div>
</div>
 </div>



</form>
</body>
</html>

<script>
$( document ).ready(function() {

load_password_polcy();
   
});

</script>