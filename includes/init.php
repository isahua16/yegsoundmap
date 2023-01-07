<?php
ob_start();
session_start();

$dsn = "pgsql:host=localhost;port=5432;dbname=edmonto9_yegsoundmap;";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

$pdo = new PDO($dsn, 'edmonto9_postgres', 'zEqs%KQ7%E5#1^b9&g0sx', $opt);

$root_directory = "home/edmonto9/";
$from_email = "isaelhuard@gmail.com";
$reply_email = "isaelhuard@gmail.com";

$public_page = "https://edmontonsoundmap.com/index.php";
$user_page = "https://edmontonsoundmap.com/user.php";
$logout_page = "https://edmontonsoundmap.com/logout.php";
$register_page = "https://edmontonsoundmap.com/register.php";
$login_page = "https://edmontonsoundmap.com/login.php";

include "includes/php_functions.php";

?>




