<?php
    include "includes/init.php";

    if($_GET['user']) {
        if ($_GET['code']) {
            $username=$_GET['user'];
            $vcode = $_GET['code'];
            if(count_field_val($pdo, "users", "username", $username)>0) {
                $row=return_field_data($pdo, "users", "username", $username);
                if ($vcode!=$row['validationcode']) {
                    set_msg("Validation code does not match database");
                }   else {

                } 

                } else {
                    set_msg("User {$username} not found in database");
                    redirect("index.php");
        }
        } else {
            set_msg("No validation code included with reset password request");
            redirect("index.php");
        }
        
    } else {
        set_msg("No user included with the reset password request");
        redirect("index.php");
    }

    if($_SERVER['REQUEST_METHOD']=="POST") {
        try {
            $password=$_POST['password'];
            $pword_confirm = $_POST['password_confirm'];
            if ($password==$pword_confirm) {
                $stmnt = $pdo->prepare("UPDATE users SET password=:password WHERE username=:username");
                $user_data=[':password'=>password_hash($password, PASSWORD_BCRYPT), ":username"=>$username];
                $stmnt->execute($user_data);
                set_msg("Password succesfully updated. Please log in");
                unset($_SESSION['username']);
                redirect("index.php");
            } else { 
                set_msg("Passwords entered don't match");
            }
           
        } catch(PDOException $e) {
            echo "Error: ".$e->getMessage();
        }

    }
    ?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>
<title>Create A New Password - Edmonton Sound Map</title>
<meta name="description" content="Create a new password for your Edmonton Sound Map account to continue submitting your field recordings of Edmonton, Canada to the map.">
<meta name=”robots” content="noindex, follow">
</head>
    <body>
        <div class="register_container">    
        <?php include "includes/nav.php" ?>
        <form id="register_form" method="post" role="form">
            <div class="reset_form">
            <h2> Create a new password </h2>
                <input type="password" name="password" id="password" tabindex="5" class="field" placeholder="New Password" required>
                
                <input type="password" name="password_confirm" id="confirm-password" tabindex="6" class="field" placeholder="Confirm New Password" required>
                
                <div class="reset-group">
                    <input type="submit" class="button" name="register-submit" id="reset-submit" tabindex="4" class="btn_reset" value="Reset Password">
                </div>
            </div>
        </form>
    </body>
</htlm>