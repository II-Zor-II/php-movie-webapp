<?php
include_once "templates/header.php";
include_once 'config/db.php';
include_once 'objects/movie.php';
include_once 'config/assets.php';
$database = new Database();
$db = $database->getConnection();

$movie = new Movie($db);

include_once "templates/upload_img.php";

if($_POST){    
    // set properties
    $movie->title = $_POST['movie_title'];
    $movie->desc = $_POST['movie_description'];
    $movie->date_released = $_POST['movie_release_date'];
    $movie->imgSrc = $imgSrc; 
    $movie->vidSrc = $formattedTitle; 
    // create movie
    if($movie->create()){
        echo "<div class='alert alert-success'>";
            echo "Movie Added.";
        echo "</div>";
    }
 
    // if unable to create movie
    else{
        echo "<div class='alert alert-danger'>";
            echo "Unable to add movie.";
        echo "</div>";
    }
    
include_once "templates/upload_video.php";
}



?>