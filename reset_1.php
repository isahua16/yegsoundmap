<?php
    include "includes/init.php";

    if($_SERVER['REQUEST_METHOD']=='POST') {
        $username=$_POST['username'];
        if(count_field_val($pdo, "users", "username", $username)>0) {

            $row = return_field_data($pdo, "users", "username", $username);
            
            $body = "Please go to http://{$_SERVER['SERVER_NAME']}/{$root_directory}/reset_2.php?user={$username}&code={$row['validationcode']} to reset your password";
                
            send_mail($row['email'], "Reset Password", $body, $from_email, $reply_email);

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
    <h3> Reset Password </h3>
        <form id="login-form"  method="post" role="form" style="display: block;">
            <div class="form-group">
                <input type="text" name="username" id="username" tabindex="1" class="field" placeholder="Username" value="" required>
            </div>
            <div class="form_group">    
                <input type="submit" name="reset-submit" id="reset_submit" tabindex="4" class="btn_submit" value="Reset password">
                
            </div>
        </form>
    </div>
   </body>