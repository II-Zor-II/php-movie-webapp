<?php 

//
include_once 'config/core.php';
//
include_once 'config/db.php';
include_once 'objects/movie.php';
include_once 'config/assets.php';

$database = new Database();
$db = $database->getConnection();

$movie = new Movie($db);

include_once "templates/header.php"; //call the header   

$stmt = $movie->readAll($from_record_num, $records_per_page);

$page_url = "movies_page.php?";

$total_rows = $movie->countAll();

echo "<div class='container'>";
    if($total_rows>0){

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            echo "<div class='img_poster col-md-4'>";
                echo "<div class='hovereffect'>";
                    echo "<img class='img-responsive' src='{$movieImgPartial_Loc}{$img_src}' alt='movie-image' >";
                    echo "<div class='overlay'>";
                        echo "<a class='info' href='play_movie.php?id={$id}'>Play</a>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }
        include_once 'paging.php';
    }else{
        echo "<div class ='alert alert-info'> No Movies Found. </div>";
    }
echo "</div>"; // end container
?>