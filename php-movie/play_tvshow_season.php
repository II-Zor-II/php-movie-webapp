<?php 
include_once "templates/header.php";
//
$seasonNum = isset($_GET['season']) ? $_GET['season'] : die('ERROR: Missing ID.');
$tvshow_id = isset($_GET['tvshow_id']) ? $_GET['tvshow_id'] : die('ERROR: Missing tvshow ID.');
//
include_once 'config/db.php';
include_once 'objects/tvshow.php';
?>

<div class="container">
     <div class="page-header">
        <h3>EPISODE NAME</h3>
     </div>
<?php
    //acquire number of episodes for the season 
    // and then create a loop for that to create bunch of rows 
$database = new Database();
$db = $database->getConnection();
    
$tvshow = new TvShow($db);
    
$numOfEpisodes = $tvshow->countEpisodes($tvshow_id,$seasonNum);
$tvshow->readOne();
$tvshowTitle = strtoupper($tvshow->title);
    
if($numOfEpisodes>0){
    for($ctr=0;$ctr<$numOfEpisodes;$ctr++){
        $seasonEpisode= $ctr+1;
        echo "<div class='row top-buffer'>";
            echo "<a href='play_tvshow_episode.php?tvshow_id={$tvshow_id}&season={$seasonNum}&episode={$seasonEpisode}' class='btn btn-primary' role='button'>{$tvshowTitle}: SEASON {$seasonNum} Episode {$seasonEpisode}</a>";
        echo "</div>";
    }
}else{
    echo "No Uploaded Episodes Yet.";
}
    
?>
</div>

<?php
include_once "templates/footer.php";
?>