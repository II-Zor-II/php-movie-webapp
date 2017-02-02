<?php
include_once "templates/header.php";
include_once 'config/db.php';
include_once "objects/tvEpisode.php";
include_once "objects/tvshow.php";

$database = new Database();
$db = $database->getConnection();

$tvepisode = new TvEpisode($db);
$tvshow = new TvShow($db);

if($_POST){
$tvshow->id = $_POST["tvshow_title_option"];
$tvshow->readOne();
    
$tvepisode->title =  $tvshow->title;    
$tvepisode->tvshow_id = $_POST["tvshow_title_option"];
$tvepisode->synopsis = $_POST["episode_description"];
$tvepisode->season = $_POST["episode_season"];
$tvepisode->episode = $_POST["episode_num"]; 
$tvepisode->ep_date = $_POST["episode_aired"]; 
    
if($tvepisode->create()){
    include_once "templates/upload_video.php";
        if($uploadOk=1){
            echo "<div class='alert alert-success'>";
                echo "Tv-Show Episode Added.";
            echo "</div>";
        }
    }else{
        echo "<div class='alert alert-danger'>";
            echo "Unable to add Tv Show Episode.";
        echo "</div>";
    }
    
    

}




?>