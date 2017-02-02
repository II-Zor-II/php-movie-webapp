<?php 
include_once "templates/header.php";
//
$season = isset($_GET['season']) ? $_GET['season'] : die('ERROR: Missing season.');
$tvshow_id = isset($_GET['tvshow_id']) ? $_GET['tvshow_id'] : die('ERROR: Missing tvshow ID.');
$episode = isset($_GET['episode']) ? $_GET['episode'] : die('ERROR: Missing Episode.');

// include database and object files
include_once 'config/db.php';
include_once 'objects/tvEpisode.php';
include_once 'config/assets.php';
include_once 'objects/tvshow.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$tvepisode = new TvEpisode($db);
$tvshow = new TvShow($db);

$tvepisode->setEpisodeSrc($tvshow_id,$season,$episode);
$tvepisode_vidSrc = $tvepisode->vid_src;

$numOfEpisodes = $tvshow->countEpisodes($tvshow_id,$season);

$tvshow->readOne();
$numOfSeasons = $tvshow->num_of_seasons;
?>




<div class='container video'> 
    
  <div class="row text-center">
     <div class="col-md-12">
          <h3><?php echo " "; ?></h3> <!-- PUT TITLE HERE LEYTER-->
      </div>
  </div>
    
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-7">
            <div class="dropdown col-md-4">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> SEASON 
                  <?php

                  echo $season;
                  
                  
                  ?>
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                  <?php 
                  for($ctr=0;$ctr<$numOfSeasons;$ctr++){
                      $season_request = $ctr+1;
                      echo "<li>";
                      echo "<a href='play_tvshow_season.php?tvshow_id={$tvshow_id}&season={$season_request}'>{$season_request}";
                      echo "</a>";
                      echo "</li>";
                  }
                  
                  
                  
                  ?>
              </ul>
            </div>
            <div class="dropdown col-md-4">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> EPISODE
                  <?php

                  echo $episode;
                  
                  
                  ?>
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                  <?php 
                  for($ctr=0;$ctr<$numOfEpisodes;$ctr++){
                      $episode_request = $ctr+1;
                      echo "<li>";
                      echo "<a href='play_tvshow_episode.php?tvshow_id={$tvshow_id}&season={$season}&episode={$episode_request}'>{$episode_request}";
                      echo "</a>";
                      echo "</li>";
                  }
                  
                  
                  
                  ?>
              </ul>
            </div>            

        </div>
    </div>
    
    
<div class='row'>
    <div class="col-md-2"></div>
    <div class="col-md-4 ">
<?php
echo "<video width='720' height='360' controls>";
echo "<source src='{$vidPartial_Loc}{$tvepisode_vidSrc}.mp4' type='video/mp4'>";
echo "</video>";
?>
    </div>
</div>
</div>

<?php // footer 
include_once "templates/footer.php";
?>