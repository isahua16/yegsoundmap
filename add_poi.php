<?php

if (isset($_FILES["poi"]) && $_FILES['poi']['error'] === UPLOAD_ERR_OK) {

    $fileTmpPath = $_FILES['poi']['tmp_name'];
    $fileName = $_FILES['poi']['name'];
    $fileSize = $_FILES['poi']['size'];
    $fileType = $_FILES['poi']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = round(microtime(true)) . '.' . $fileExtension;

    $allowedExtensions = array('wav', 'mp3', 'ogg');

    if (in_array($fileExtension, $allowedExtensions) && $fileSize < 50000000) {
        
        $uploadFileDir = 'media/';
        $dest_path = $uploadFileDir . $newFileName;
        
            if(move_uploaded_file($fileTmpPath, $dest_path)) 
            {
                echo 'File was successfully uploaded to the server.';
            } else {
                echo 'There was an error moving the file to the server directory';
            }
         }  else { 
            echo 'Upload failed. Please make sure that your file is in either .wav, .mp3 or .ogg format, and less than 20MB.';
        }
    } else {
        $message = 'There is some error in the file upload.';
        $message .= 'Error:' . $_FILES['poi']['error'];
        echo $message;
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

if (isset($_POST["date"])) {
    $date=$_POST["date"];
} else {
    $date="NA";
}

if (isset($_POST["description"])) {
    $description=$_POST["description"];
} else {
    $description="NA";
}

if (isset($_POST["audio"])) {
    $audio = $dest_path;
} else {
    $audio="NA";
}

$db = new PDO("pgsql:host=localhost;port=5432;dbname=yegsoundmap;", "postgres","isahua9261");

$sql = $db->prepare("INSERT INTO yeg_poi (geom, name, audio, date, description) VALUES ((st_setsrid(st_makepoint(:lng, :lat), 4326)), :nm, :ad, :dt, :des)");

$params = ["nm"=>$name,"lat"=>$latitude,"lng"=>$longitude,"ad"=>$audio, "dt"=>$date, "des"=>$description];

if ($sql->execute($params)) {
    echo "Your submission was succesfully added to the map.";
} else {
    echo var_dump($sql->errorInfo());
};

?>