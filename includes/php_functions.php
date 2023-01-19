<?php

function redirect($loc) {
    header("Location:{$loc}");
}

function generate_token() {
    return md5(microtime().mt_rand());
}

function set_msg($msg) {
    if(empty('msg')) {
        unset($_SESSION['message']);
    } else {
        $_SESSION['message']="<p style='text-align: center' class='message'>{$msg}</p>";
    }
}

function show_msg() {
    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function count_field_val($pdo, $tbl, $fld, $val) {
    try {
        $sql="SELECT {$fld} FROM ${tbl} WHERE {$fld}=:value";
        $stmnt=$pdo->prepare($sql);
        $stmnt->execute([':value'=>$val]);
        return $stmnt->rowCount();
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function send_mail($to, $subject, $body, $from, $reply) {
    $headers = "From: {$from}"."\r\n"."Reply-To:{$reply}"."\r\n"."X-Mailer:PHP/".phpversion();

    if($_SERVER['SERVER_NAME'] !="localhost") {
        mail($to, $subject, $body, $headers);

    } else {
        echo "<hr><p>To:{$to}</p><p>Subject:{$subject}</p><p>{$body}</p><p>" . $headers . "</p><hr>";
    }
}

function logged_in() {
    if(isset($_SESSION['username'])) {
        return true;
    } else {
        if (isset($_COOKIE['username'])) {
            $username = $_COOKIE['username'];
            $_SESSION['username'] = $_COOKIE['username'];
            return true;
        } else {
            return false;
        }
    }
}

function get_validationcode($user, $pdo) {
    try {
        $stmnt = $pdo->prepare("SELECT validationcode FROM users WHERE username=:username");
        $stmnt->execute([':username'=>$user]);
        $row = $stmnt->fetch();
        return $row['validationcode'];
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function return_field_data($pdo, $tbl, $fld, $val) {
    try {
        $sql="SELECT * FROM ${tbl} WHERE {$fld}=:value";
        $stmnt=$pdo->prepare($sql);
        $stmnt->execute([':value'=>$val]);
        return $stmnt->fetch();
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

?>