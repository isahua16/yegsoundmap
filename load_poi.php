<?php
    $db = new PDO("pgsql:host=localhost;port=5432;dbname=yegsoundmap;", "postgres","isahua9261");

    $sql = $db->query("SELECT name, audio, ST_AsGeoJSON(geom,5) as geom FROM yeg_poi ORDER BY name");

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
