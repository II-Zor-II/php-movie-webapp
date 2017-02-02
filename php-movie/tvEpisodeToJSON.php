<?php 
include_once 'config/db.php';
include_once 'objects/tvEpisode.php';
include_once 'config/assets.php';

$database = new Database();
$db = $database->getConnection();
$tv_episode = new TvEpisode($db);


$stmt = $tv_episode->readEpisodes();
$dataRows= $stmt->rowCount();
$tvEpisodesArr = array();

if($dataRows>0){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){   
        extract($row);
        $tvEpisodesArr[]=$row;  
    }
} else {
    echo " ";
}
    $fp = fopen('JSON/tvshow_episodes.json', 'w+');
    fwrite($fp, json_encode($tvEpisodesArr));
    fclose($fp);

?>