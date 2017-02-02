<?php
include_once "templates/header.php";
include_once 'config/db.php';
include_once 'objects/tvshow.php';

$database = new Database();
$db = $database->getConnection();

$tvshow = new TvShow($db);


include_once "templates/upload_img.php";

if($_POST){    
    // set properties
    $tvshow->title = $_POST['tvshow_title'];
    $tvshow->desc = $_POST['tvshow_description'];
    $tvshow->num_of_seasons = $_POST['tvshow_seasons'];
    $tvshow->pilotReleasedDate = $_POST['tvshow_released_date'];
    $tvshow->img_src = $imgSrc; 
    // create tvshow
    if($tvshow->create()){
        echo "<div class='alert alert-success'>";
            echo "Tv-Show Added.";
        echo "</div>";
    }else{
        echo "<div class='alert alert-danger'>";
            echo "Unable to add Tv Show.";
        echo "</div>";
    }
    
}



?>