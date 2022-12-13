<?php

if (isset($_FILES["poi"])) {

    $fileTmpPath = $_FILES['poi']['tmp_name'];
    $fileName = $_FILES['poi']['name'];
    $fileSize = $_FILES['poi']['size'];
    $fileType = $_FILES['poi']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $uploadFileDir = 'Applications/XAMPP/xamppfiles/htdocs/yegsoundmap/media/';
    $dest_path = $uploadFileDir . $fileName;

    if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        echo 'File is successfully uploaded.';
      }
}

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
    $postAudio=$_POST["audio"];
    $fakePath="C:\\fakepath\\";
    $realPath = "media/";
    $audio=str_replace($fakePath, $realPath, $postAudio);
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