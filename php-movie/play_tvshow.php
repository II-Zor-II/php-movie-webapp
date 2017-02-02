<?php 
include_once "templates/header.php";

// get ID of the tvshow
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/db.php';
include_once 'objects/tvshow.php';
include_once 'config/assets.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$tvshow = new TvShow($db);
 
// set ID property of product to be edited
$tvshow->id = $id;
 
// read the details of product to be edited
$tvshow->readOne();
?>

<div class='container'>
 <div class='row'>
     <div class = "col-md-4">
         <?php echo "<img src='{$tvshowImgPartial_Loc}{$tvshow->img_src}' class='img-rounded' alt='tvshow-image' width='230' height='345'>" ?>
     </div>
    <div class = "col-md-8">
        <table class='table table-hover table-responsive table-bordered movie-table'>
        <tr>
            <td><h4>TITLE</h4></td>
            <td><?php echo $tvshow->title; ?></td>
        </tr>
        <tr>
            <td><h4>Description</h4></td>
            <td><?php echo $tvshow->desc; ?>
        </tr>
        <tr>
            <td><h4>YEAR</h4></td>
            <td><?php echo $tvshow->pilotReleasedDate; ?></td>
        </tr>
        <tr>
            <td><h4>Number Of Seasons</h4></td>
            <td><?php echo $tvshow->num_of_seasons; ?></td>
        </tr>
        </table>
    </div>
</div>
 <div class='row'>
    <div class='col-md-offset-11'>
    <?php
    echo "<a href='updateTvshow_details.php?tvshow_id={$id}' class='btn btn-info left-margin'>";
    echo "<span class='glyphicon glyphicon-edit'></span> Edit";
    echo "</a>"; 
    ?>
    </div>
         <div class='col-md-offset-4'><h3><span class="glyphicon glyphicon-play-circle"> WATCH </span></h3></div>
 </div>
</div>


<div class='container'>    
<div class='row'>
    <div class="col-md-offset-4">
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">SEASONS
          <span class="caret"></span></button>
            
            <?php 
                echo "<ul class='dropdown-menu'>";
                    for($ctr=0;$ctr<$tvshow->num_of_seasons;$ctr++){
                        $season = $ctr+1;
                        echo "<li>";
                        echo "<a href='play_tvshow_season.php?tvshow_id={$id}&season={$season}'>{$season}";
                        echo "</a>";
                        echo "</li>";
                    }
                echo "</ul>";
            ?>
            
        </div>
    </div>
</div>
</div>

<?php // footer 
include_once "templates/footer.php";
?>