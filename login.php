<!-- Login to access user.php, reroute to user.php when user is logged in -->

<?php include "includes/init.php" ?>

<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
    $username=$_POST['username'];
    $password=$_POST['password'];
    if (isset($_POST['remember'])) {
        $remember = "on";
    } else {
        $remember = "off";
    }


    if (count_field_val($pdo, "users", "username", $username)>0) {
        
        $user_data = return_field_data($pdo, "users", "username", $username);
        if ($user_data['active']==1) {
            if (password_verify($password, $user_data['password'])) {
                set_msg("Logged in succesfully");
                $_SESSION['username']=$username;
                if ($remember="on") {
                    setcookie("username", $username, time()+86400*7);
                } else {

                }
                redirect("user.php");
                
            } else {
                set_msg("Password is invalid");
            }

        } else {
            set_msg("{$username} account has not been activated. Please check your registered email inbox and spam folder for activation instructions");
        }
    } else {
        set_msg("User {$username} does not exist. Please register");
    }


    } else {
        $username = "";
        $password= "";
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
        <div class="form-group">
            <input type="text" name="username" id="username" tabindex="1" class="field" placeholder="Username" value="<?php echo $username; ?>" required>
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
                <a class="link" href="reset_1.php" tabindex="5" class="forgot-password">Forgot Password?</a>
            </div>
        </div>
    </form>
   </body>