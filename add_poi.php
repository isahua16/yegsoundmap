<?php
if (isset($_POST["latitude"]) && is_numeric($_POST["latitude"])) {
    $latitude=$_POST["latitude"];
} else {
    $latitude="53.36685";
}

if (isset($_POST["longitude"]) && is_numeric($POST["longitude"])) {
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

$sql = $db->prepare("INSERT INTO yeg_poi (geom, name, audio) VALUES (ST_SetSRID(ST_MakePoint(:lng, :lat), 4326)), :nm, :ad");

$params = ["lat"=>$latitude, "lng"=>$longitude, "nm"=>$name, "ad"=>$audio];

if ($sql->execute($params)) {
    echo "{$name} succesfully added";
} else {
    echo var_dump($sql->errorInfo());
}

?>