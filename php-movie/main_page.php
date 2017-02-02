<div class="container">
    <div class="page-header">
        <h2><a href="movies_page.php">MOVIES</a></h2>
    </div>

<?php 
$total_movieRows = $movie->countAll();

if($total_movieRows>0){
    
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
}else{
    echo "<div class ='alert alert-info'> No Movies Found. </div>";
}
    
echo "</div>";
echo "<hr class='style2'>";

$stmt = $tvshow->readAll($from_record_num,$records_per_page);
$total_tvshowRows = $tvshow->countAll();
    
echo "<div class='container'>";
    echo "<div class='page-header'>";
        echo "<h2><a href='tvshows_page.php'>TV SHOWS</a></h2>";
    echo "</div>";
    

if($total_tvshowRows>0){
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
        echo "<div class='img_poster col-md-4'>";
            echo "<div class='hovereffect'>";
                echo "<img class='img-responsive' src='{$tvshowImgPartial_Loc}{$img_src}' alt='tvshow-image' >";
                echo "<div class='overlay'>";
                    echo "<a class='info' href='play_tvshow.php?id={$id}'>Play</a>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
}else{
    echo "<div class ='alert alert-info'> No TV SHOWS Found. </div>";
}

echo "</div>";
?>
