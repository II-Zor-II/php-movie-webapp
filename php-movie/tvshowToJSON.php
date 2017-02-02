<?php 
include_once 'config/db.php';
include_once 'objects/tvshow.php';
include_once 'config/assets.php';

$database = new Database();
$db = $database->getConnection();
$tvshow = new TvShow($db);

$stmt = $tvshow->readAllTvShows();

$total_rows = $tvshow->countAll();

$tvshowArr = array();
if($total_rows>0){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){   
        extract($row);
        $tvshowArr[]=$row;        
    }
} else {
    echo " ";
}
    $fp = fopen('JSON/tvshow.json', 'w+');
    fwrite($fp, json_encode($tvshowArr));
    fclose($fp);


?>