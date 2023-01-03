<?php include "includes/init.php" ?>

<?php

    $sql = $pdo->query("SELECT id, name, audio, description, date, userd, ST_AsGeoJSON(geom,5) as geom FROM yeg_poi ORDER BY id");

    $features = [];

    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

        $feature=["type"=>"Feature"];
        
        $feature["geometry"]=json_decode($row["geom"]);

        unset($row["geom"]);

        $feature["properties"]=$row;

        array_push($features, $feature);
    }

    $featureCollection=["type"=>"FeatureCollection", "features"=>$features];
    echo json_encode($featureCollection);
?>
