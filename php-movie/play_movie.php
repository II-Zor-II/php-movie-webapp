<?php 
include_once "templates/header.php";

// get ID of the movie
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/db.php';
include_once 'objects/movie.php';
include_once 'config/assets.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$movie = new Movie($db);
 
// set ID property of product to be edited
$movie->id = $id;
 
// read the details of product to be edited
$movie->readOne();
?>

<div class='container'>
 <div class='row'>
     <div class = "col-md-4">
         <?php echo "<img src='{$movieImgPartial_Loc}{$movie->imgSrc}' class='img-rounded' alt='movie-image' width='230' height='345'>" ?>
     </div>
    <div class = "col-md-8">
        <table class='table table-hover table-responsive table-bordered movie-table'>
        <tr>
            <td><h4>TITLE</h4></td>
            <td><?php echo $movie->title; ?></td>
        </tr>
        <tr>
            <td><h4>Description</h4></td>
            <td><?php echo $movie->desc; ?>
        </tr>
        <tr>
            <td><h4>Release Date</h4></td>
            <td><?php 
                $thisDate = date_create($movie->date_released);
                echo date_format($thisDate,"F j Y");
                
                ?></td>
        </tr>
        </table>
    </div>
</div>
 <div class='row'>
    <div class='col-md-offset-11'>
    <?php
    echo "<a href='updateMovie_details.php?movie_id={$id}' class='btn btn-info left-margin'>";
    echo "<span class='glyphicon glyphicon-edit'></span> Edit";
    echo "</a>"; 
    ?>
    </div>
 </div>
</div>


<div class='container video'>    
<div class='row'>
    <div class="col-md-2"></div>
    <div class="col-md-4">
<?php
echo "<video width='720' height='360' controls>";
echo "<source src='{$vidPartial_Loc}{$movie->vidSrc}.mp4' type='video/mp4'>";
echo "</video>";
?>
    </div>
</div>
</div>

<?php // footer 
include_once "templates/footer.php";
?>