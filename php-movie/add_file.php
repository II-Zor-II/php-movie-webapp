<?php 

include_once "templates/header.php";

include_once "tvshowToJSON.php";
include_once "tvEpisodeToJSON.php";
?>

<div class='container'>
    <form action="" method="post" enctype="multipart/form-data" id="addFile_form">
    <div class='row top-buffer'>
        <div class = "col-md-4 ">
                <span class="btn btn-default btn-file" id='image_selector'>
                Select Image Poster <input type="file" id='image_selector_input' disabled="true" name="imageToUpload" accept="image/*">
                </span>
        </div>
            <div class = "col-md-4">
            <span class="btn btn-default btn-file"  id='video_selector'>
            Select Video File <input type="file"  id='video_selector_input' disabled="true" name="vidToMove" accept="video/mp4">
            </span>
        </div>
    </div>
    <div class='row top-buffer'>
        <div class = 'col-md-5'>
            <div class="form-group">
              <select class="form-control" id="select" onchange="addFileSelected()">
                <option value="" disabled="true" selected hidden>Select option</option>
                <option value="Movie">Movie</option>
                <option value="TvShow">TV-show</option>
                <option value="TvShowEpisode">TV-show Episode</option>
              </select>
            </div>
        </div>
    </div>
    
    

        <table class='table table-hover table-responsive table-bordered' 
               id="movie_form" style="display:none">
            <tr>
                <td>Title</td>
                <td><input type='text' name='movie_title' class='form-control' /></td>
            </tr> 
            <tr>
                <td>Description</td>
                <td><textarea name='movie_description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>RELEASE DATE</td>
                <td><input type="date" name="movie_release_date"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary" value="movie" name="submit">Add Movie</button>
                </td>
            </tr>

        </table>

    

        <table class='table table-hover table-responsive table-bordered' 
               id="tvshow_form" style="display:none">
            <tr>
                <td>Title</td>
                <td><input type='text' name='tvshow_title' class='form-control' /></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name='tvshow_description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>Number Of Seasons</td>
                <td><input type='text' name='tvshow_seasons' class='form-control'></td>
            </tr>
            <tr>
                <td>Year</td>
                <td><input type="date" name="tvshow_released_date"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary" value="tvshow" name="submit">Add TV SHOW</button>
                </td>
            </tr>

        </table>

    

        <table class='table table-hover table-responsive table-bordered' id="tvshowEpisode_form"
               style="display:none">
            <tr>
                <td>TV Show Title </td>
                <td><select class="form-control" id="select_tvshow" name="tvshow_title_option">
					<option value="" disabled="true" selected hidden>Select Tv Show</option></select></td>
            </tr>
            <tr>
                <td>Synopsis</td>
                <td><textarea name='episode_description' class='form-control'></textarea></td>
            </tr>
            <tr>
                <td>Season</td>
                <td><input type='number' name='episode_season' class='form-control' id="season_input"/></td>
            </tr>
            <tr>
                <td>Episode</td>
                <td><input type='number' name='episode_num' class='form-control' id="tvEp_input" onkeyup="validateInput(this.value)"/></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><input type="date" name="episode_aired"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary" value="tvshow_episode" name="submit">Add TV SHOW episode</button>
                </td>
            </tr>

        </table>    
</form>
</div>



<?php
include_once "templates/footer.php"; 
?>
    