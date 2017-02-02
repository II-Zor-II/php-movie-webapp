
<?php 
$movie_id = isset($_GET['movie_id'])? $_GET['movie_id'] : $_POST['movie_id'];

include_once "templates/header.php";
include_once 'config/db.php';
include_once 'config/assets.php';
include_once 'objects/movie.php';

$database = new Database();
$db = $database->getConnection();

$movie = new Movie($db);

$movie->id = $movie_id;
$movie->readOne();

$title = $movie->title;
$description = $movie->desc;
$released_date = $movie->date_released;
$imgSrc = $movie->imgSrc;
$vidSrc = $movie->vidSrc;
if($_POST){
    if($title!=$_POST['movie_title']){
        $movie->title = $_POST['movie_title'];
        include_once 'templates/renameImage.php';       
        $imgSrc = $newImageTitle;
        include_once 'templates/renameVideo.php'; 
        $movie->vidSrc = $formattedVidSrc;
    }
    $movie->desc = $_POST['movie_description'];
    $movie->date_released = $_POST['movie_release_date'];
    include_once 'templates/upload_img.php';
    $movie->imgSrc = $imgSrc;
    include_once 'templates/upload_video.php';
    if($movie->update()){
        $message = "SUCCESSFULLY UPDATED";
            echo "<script type='text/javascript'>alert('$message');
                    window.location='play_movie.php?id=$movie->id';
                  </script>";
    }else{
        $message = "ERROR. TRY AGAIN";

            echo "<script type='text/javascript'>alert('$message');</script>";

    }

}
?>


<div class='container'>
<form action="updateMovie_details.php" method="post" enctype="multipart/form-data">
<div class='row top-buffer'>
    <div class = "col-md-4 ">
            <span class="btn btn-default btn-file" id='image_selector'>
            Select Image Poster <input type="file" id='movieImage_selector_input' name="imageToUpload" accept="image/*" class="posterSelector">
            </span>
    </div>
        <div class = "col-md-4">
        <span class="btn btn-default btn-file"  id='video_selector'>
        Select Video File <input type="file"  id='video_selector_input' name="vidToMove" accept="video/mp4">
        </span>
    </div>
</div>
 <div class='row top-buffer'>
     <div class = "col-md-4">
         <?php echo "<img src='{$movieImgPartial_Loc}{$movie->imgSrc}' class='img-rounded poster' alt='movie-image' width='230' height='345' id='movie_poster'>" ?>
     </div>
    <div class = "col-md-8">
        <table class='table table-hover table-responsive table-bordered movie-table'>
            <tr>
                <td>Title</td>
                <td><?php  echo "<input type='text' name='movie_title' class='form-control' value='{$title}' />" ?></td>
            </tr>
        <tr>
            <td><h4>Description</h4></td>
            <td><?php echo "<textarea name='movie_description' class='form-control' >{$description}</textarea>" ?>
        </tr>
        <tr>
            <td><h4>Release Date</h4></td>
            <td><?php echo "<input type='date' name='movie_release_date' value='{$released_date}'>" ?></td>
        </tr>
        </table>
    </div>
</div>
    <div class='row'>
        <div class = "col-md-4">
         <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">  
        </div>
        <div class = "col-md-8">
        <button type="submit" class="btn btn-primary" value="movie" name="submit">Save</button>
        </div>
    </div>
</form>
</div>

<?php 
include_once "templates/footer.php";
?>