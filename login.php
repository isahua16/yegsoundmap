<!-- Login to access user.php, reroute to user.php when user is logged in -->

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>
  <body>
    <div class="login_container">    
    <?php include "includes/nav.php" ?>

    <form id="login-form"  method="post" role="form" style="display: block;">
        <div class="form-group">
            <input type="text" name="email" id="email" tabindex="1" class="field" placeholder="Email" required>
        </div>
        <div class="form_group">
            <input type="password" name="password" id="login-
        password" tabindex="2" class="field" placeholder="Password" required>
        </div>
        
        <div class="form_group">
            <input type="checkbox" tabindex="3" class="radio" name="remember" id="remember">
            <label for="remember">Stay logged in</label>
        </div>
        <div class="form_group">    
            <input type="submit" name="login-submit" id="login_submit" tabindex="4" class="btn_submit" value="Log In">
             
        </div>
        <div class="form_group">
                <a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
            </div>
        </div>
    </form>
   </body>