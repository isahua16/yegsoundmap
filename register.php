<!-- Register to be user, reroute to user.php when logged in -->

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>
  <body>
    <div class="register_container">    
    <?php include "includes/nav.php" ?>

    <form id="register_form" method="post" role="form" >
        <div class="form-group">
            <input type="text" name="firstname" id="firstname" tabindex="1" class="field" placeholder="First Name" value="" required >
        </div>
        <div class="form-group">
            <input type="text" name="lastname" id="lastname" tabindex="2" class="field" placeholder="Last Name" value="" required >
        </div>
        <div class="form-group">
            <input type="text" name="username" id="username" tabindex="3" class="field" placeholder="Username" value="" required >
        </div>
        <div class="form-group">
            <input type="email" name="email" id="register_email" tabindex="4" class="field" placeholder="Email Address" value="" required >
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" tabindex="5" class="field" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="password" name="confirm_password" id="confirm-password" tabindex="6" class="field" placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="btn_register" value="Register Now">
                          
        </div>
    </form>
</body>