<?php 

include_once "templates/header.php";


?>

<div class='container'>
    <div class='row top-buffer'>
        <div class = "col-md-4 ">
            <span class="btn btn-default btn-file" id='image_selector'>
            Select Image Poster <input type="file" id='image_selector_input' disabled="true">
            </span>
        </div>
            <div class = "col-md-4">
            <span class="btn btn-default btn-file"  id='video_selector'>
            Select Video File <input type="file"  id='video_selector_input' disabled="true">
            </span>
        </div>
    </div>
    <div class='row top-buffer'>
        <div class = 'col-md-5'>
            <div class="form-group">
              <select class="form-control" id="select" onchange="myFunction()">
                <option value="" disabled="true" selected hidden>Select option</option>
                <option value="Movie">Movie</option>
                <option value="TvShow">TV-show</option>
                <option value="TvShowEpisode">TV-show Episode</option>
              </select>
            </div>
        </div>
    </div>
    
    
    <form action='create_movie.php' method='post' id='Movie_Form' style="display:none">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Title</td>
                <td><input type='text' name='title' class='form-control' /></td>
            </tr> 
            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>RELEASE DATE</td>
                <td><input type="date" name="release_date"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Add Movie</button>
                </td>
            </tr>

        </table>
    </form>
    
    <form action='create_movie.php' method='post' id='TvShow_Form' style="display:none">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Title</td>
                <td><input type='text' name='title' class='form-control' /></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>Number Of Seasons</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>Year</td>
                <td><input type="date" name="release_date"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Add TV SHOW</button>
                </td>
            </tr>

        </table>
    </form>
    
    <form action='create_movie.php' method='post' id='TvShowEpisode_Form' style="display:none">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Title</td>
                <td><input type='text' name='title' class='form-control' /></td>
            </tr>
            <tr>
                <td>Synopsis</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>Season</td>
                <td><input type='text' name='title' class='form-control' /></td>
            </tr>
            <tr>
                <td>Episode</td>
                <td><input type='text' name='title' class='form-control' /></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><input type="date" name="release_date"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Add TV SHOW episode</button>
                </td>
            </tr>

        </table>
    </form>


    
</div>













<?php
include_once "templates/footer.php"; 
?>
    