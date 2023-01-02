<?php
ob_start();
session_start();

$dsn = "pgsql:host=localhost;port=5432;dbname=yegsoundmap;";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

$pdo = new PDO($dsn, 'postgres', 'isahua9261', $opt);

$root_directory = "yegsoundmap";
$from_email = "isaelhuard@gmail.com";
$reply_email = "isaelhuard@gmail.com";

include "includes/php_functions.php";

?>



