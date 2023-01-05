<?php
    include "includes/init.php";

    if($_SERVER['REQUEST_METHOD']=='POST') {
        $username=$_POST['username'];
        if(count_field_val($pdo, "users", "username", $username)>0) {

            $row = return_field_data($pdo, "users", "username", $username);
            
            $body = "Please go to https://{$_SERVER['SERVER_NAME']}/reset_2.php?user={$username}&code={$row['validationcode']} to reset your password";
                
            send_mail($row['email'], "Reset Password", $body, $from_email, $reply_email);
            set_msg("Please check your email for the reset url. Don't forget to check your spam folder.");
        } else {
            set_msg("{$username} was not found in the database");
        }
    } else {

    }



?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>
  <body>
    <div class="login_container">    
    <?php include "includes/nav.php" ?>
    <div class="message">
        <?php
     show_msg();
        ?>
    </div>
    <form id="login-form"  method="post" role="form" style="display: block;">
        <div class="reset_form">
                <h2> Reset Password </h2>
                <input type="text" name="username" id="username" tabindex="1" class="field" placeholder="Username" value="" required>
                <div class="reset_group">    
                    <input type="submit" name="reset-submit" id="reset_submit" tabindex="4" class="btn_submit" value="Reset password"> 
                </div>
            </div>
            </form>
    </div>
   </body>