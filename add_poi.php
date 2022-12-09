<?php
// echo "{$name} succesfully added";

if (isset($_POST["latitude"]) && is_numeric($_POST["latitude"])) {
    $latitude=$_POST["latitude"];
} else {
    $latitude="53.36685";
}

if (isset($_POST["longitude"]) && is_numeric($_POST["longitude"])) {
    $longitude=$_POST["longitude"];
} else {
    $longitude="-113.57502";
}

if (isset($_POST["name"])) {
    $name=$_POST["name"];
} else {
    $name="NA";
}

if (isset($_POST["audio"])) {
    $audio=$_POST["audio"];
} else {
    $audio="NA";
}

$db = new PDO("pgsql:host=localhost;port=5432;dbname=yegsoundmap;", "postgres","isahua9261");

$sql = $db->prepare("INSERT INTO yeg_poi (geom, name, audio) VALUES ((st_setsrid(st_makepoint(:lng, :lat), 4326)), :nm, :ad)");

$params = ["nm"=>$name,"lat"=>$latitude,"lng"=>$longitude,"ad"=>$audio];

if ($sql->execute($params)) {
    echo "{$name} succesfully added";
} else {
    echo var_dump($sql->errorInfo());
};

?>