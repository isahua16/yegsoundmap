<!-- Register to be user, reroute to user.php when logged in -->
<?php include "includes/init.php" ?>

<?php
     
     if ($_SERVER['REQUEST_METHOD']=="POST") {

        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $uname = $_POST['username'];
        $eml = $_POST['email'];
        $pwd = $_POST['password'];
        $pwd_conf = $_POST['password_confirm'];
        $spcl_char = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        
        if(strlen($fname)<=1) {
            $error[] = "Last name must be at least 2 characters long";
        }
        if(strlen($lname)<=1) {
            $error[] = "Last name must be at least 2 characters long";
        }
        if(strlen($uname)<=3) {
            $error[] = "Username must be at least 4 characters long";
        }
        if(strlen($pwd)<6) {
            $error[] = "Password must be at least 6 characters long";
        }
        if (!preg_match($spcl_char, $pwd))
            {
                $error[] = "Password must contain at least one special character";
            }
        if ($pwd != $pwd_conf) {
            $error[] = "Passwords do not match";
        }

        if (count_field_val($pdo, "users", "username", $uname)!=0) {
            $error[]= "Username {$uname} already exists";
        }

        if (count_field_val($pdo, "users", "email", $eml)!=0) {
            $error[]= "Email {$eml} is already registered";
        }

        if(!isset($error)) {
            try {
                $vcode=generate_token();
                $sql = "INSERT INTO users (firstname, lastname, username, email, password, validationcode,  active, joined, last_login) VALUES (:firstname, :lastname, :username, :email, :password, :vcode,  0, current_date, current_date)";
                $stmnt = $pdo->prepare($sql);
                $user_data = [':firstname'=>$fname, ':lastname'=>$lname, ':username'=>$uname, ':email'=>$eml, ':password'=>password_hash($pwd, PASSWORD_BCRYPT), ':vcode'=>$vcode];
                $stmnt->execute($user_data);
                
                $body = "Please go to http://{$_SERVER['SERVER_NAME']}/{$root_directory}/activate.php?user={$uname}&code={$vcode} to activate your account";
                
                send_mail($eml, "Activate User", $body, $from_email, $reply_email);

                set_msg("User succesfully registered. Please activate your account by following the instructions sent to {$eml}. Make sure to check your spam folder for the instructions email");
                
                redirect("index.php");
                
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }       
        }     
        
     } else {
        $fname = "";
        $lname = "";
        $uname = "";
        $eml = ""; 
     }

?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>
  <body>
    <div class="register_container">    
    <?php include "includes/nav.php" ?>

    <div class="message">
        <?php
        show_msg();
        if (isset($error)) {
            foreach ($error as $msg) {
                echo "<h4 class='message'>{$msg}.</h4><br>";
            }
        }
        ?>
    </div>
    <form id="register_form" method="post" role="form" >
        <div class="form-group">
            <input type="text" name="firstname" id="firstname" tabindex="1" class="field" placeholder="First Name" value="<?php echo $fname ?>" required >
        </div>
        <div class="form-group">
            <input type="text" name="lastname" id="lastname" tabindex="2" class="field" placeholder="Last Name" value="<?php echo $lname ?>" required >
        </div>
        <div class="form-group">
            <input type="text" name="username" id="username" tabindex="3" class="field" placeholder="Username" value="<?php echo $uname ?>" required >
        </div>
        <div class="form-group">
            <input type="email" name="email" id="register_email" tabindex="4" class="field" placeholder="Email Address" value="<?php echo $eml ?>" required >
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" tabindex="5" class="field" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirm" id="confirm-password" tabindex="6" class="field" placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="btn_register" value="Register Now">
                          
        </div>
    </form>
</body>