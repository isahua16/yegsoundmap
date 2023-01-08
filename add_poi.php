<?php include "includes/init.php" ?>

<?php

if (isset($_FILES['poi']) && $_FILES['poi']['error'] < 1) {

    $fileTmpPath = $_FILES['poi']['tmp_name'];
    $fileSize = $_FILES['poi']['size'];
    $fileName = $_FILES['poi']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = round(microtime(true)) . '.' . $fileExtension;

    $allowedExtensions = array('wav', 'mp3', 'ogg', 'm4a');

    if (in_array($fileExtension, $allowedExtensions) && $fileSize < 64000000) {
        
        $uploadFileDir = 'media/';
        $dest_path = $uploadFileDir . $newFileName;
        
            if(move_uploaded_file($fileTmpPath, $dest_path)) 
            {
                set_msg("File was successfully uploaded to the server.");

            } else {
                set_msg("There was an error moving the file to the server directory");
            }
    }  else { 
            set_msg("Upload failed. Please make sure that your file is in either .wav, .mp3, .m4a, or .ogg format, and less than 100MB.");
        }
} else {
    $message = "There is a problem with the upload";    
    set_msg($message);
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

if (isset($_POST["user"])) {
    $user=$_POST["user"];
} else {
    $user="NA";
}

if (isset($_POST["terms"])) {
    $terms=$_POST["terms"];
} else {
    $terms=0;
}

$sql = $pdo->prepare("INSERT INTO yeg_poi (geom, name, audio, date, description, userd, terms) VALUES ((st_setsrid(st_makepoint(:lng, :lat), 4326)), :nm, :ad, :dt, :des, :ur, :tm)");

$params = ["nm"=>$name,"lat"=>$latitude,"lng"=>$longitude,"ad"=>$audio,"dt"=>$date,"des"=>$description,"ur"=>$user,"tm"=>$terms];

if ($sql->execute($params)) {
    set_msg("Your submission was succesfully added to the map.");
} else {
    set_msg(var_dump($sql->errorInfo()));
};

?>