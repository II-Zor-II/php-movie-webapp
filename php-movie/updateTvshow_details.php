<?php 
include_once "templates/header.php";

// get ID of the tvshow
$tvshow_id = isset($_GET['tvshow_id']) ? $_GET['tvshow_id'] : $_POST['tvshow_id'];
// include database and object files
include_once 'config/db.php';
include_once 'objects/tvshow.php';
include_once 'config/assets.php';


$database = new Database();
$db = $database->getConnection();
 

$tvshow = new TvShow($db);
$tvshow->id = $tvshow_id;
$tvshow->readOne();

$title = $tvshow->title;
$description = $tvshow->desc;
$seasons = $tvshow->num_of_seasons;
$yearOfRelease = $tvshow->pilotReleasedDate;
$imgSrc = $tvshow->img_src;
if($_POST){
    if($title!=$_POST['tvshow_title']){
        $tvshow->title = $_POST['tvshow_title'];
        include_once 'templates/renameImage.php';       
        $imgSrc = $newImageTitle;
    }
    $tvshow->desc = $_POST['tvshow_desc'];
    $tvshow->pilotReleasedDate = $_POST['tvshow_year'];
    $tvshow->num_of_seasons = $_POST['num_of_seasons'];    
    include_once 'templates/upload_img.php';
    $tvshow->img_src = $imgSrc;
    if($tvshow->update()){
        $message = "SUCCESSFULLY UPDATED";
            echo "<script type='text/javascript'>alert('$message');
                    window.location='play_tvshow.php?id=$tvshow->id';
                  </script>";  
    }else{
        $message = "ERROR. TRY AGAIN";

            echo "<script type='text/javascript'>alert('$message');</script>";

    }
}

?>


<div class='container'>
<form action="updateTvshow_details.php" method="post" enctype="multipart/form-data">
 <div class='row top-buffer'>
    <div class = "col-md-4 ">
            <span class="btn btn-default btn-file" id='image_selector'>
            Select Image Poster <input type="file" id='tvshowImage_selector_input' name="imageToUpload" accept="image/*" class="posterSelector">
            </span>
    </div>
 </div>
 <div class='row top-buffer'>
     <div class = "col-md-4">
         <?php echo "<img src='{$tvshowImgPartial_Loc}{$tvshow->img_src}' class='img-rounded poster' alt='tvshow-image' width='230' height='345' id='tvshow_poster'>" ?>
     </div>
    <div class = "col-md-8">
        <table class='table table-hover table-responsive table-bordered movie-table'>
        <tr>
            <td><h4>TITLE</h4></td>
            <td>
                
                <?php echo "<input type='text' name='tvshow_title' class='form-control' value='{$title}' />" ?></td>
        </tr>
        <tr>
            <td><h4>Description</h4></td>
            <td><?php echo "<textarea name='tvshow_desc' class='form-control' >{$description}</textarea>" ?>
        </tr>
        <tr>
            <td><h4>YEAR</h4></td>
            <td><?php echo "<input type='date' name='tvshow_year' class='form-control' value='{$yearOfRelease}'></textarea>" ?></td>
        </tr>
        <tr>
            <td><h4>Number Of Seasons</h4></td>
            <td><?php echo "<input type='number' name='num_of_seasons' class='form-control' value='{$seasons}' />" ?></td>
        </tr>
        </table>
    </div>
 </div>
    <div class='row'>
        <div class = "col-md-4">
         <input type="hidden" name="tvshow_id" value="<?php echo $tvshow_id; ?>">  
        </div>
        <div class = "col-md-8">
        <button type="submit" class="btn btn-primary" value="tvshow" name="submit">Save</button>
        </div>
    </div>
</form>
</div>


<?php 
include_once "templates/footer.php";
?>