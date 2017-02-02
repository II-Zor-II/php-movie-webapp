<?php 
$type= isset($_POST['submit'])? $_POST['submit'] : "undefined";
$vidType= "mp4";
$target_dir = "assets/videos/"; 
$id = "";
if($type=="movie"){
    $vidName = $movie->vidSrc.".".$vidType;
    $id = $movie_id;
}else if($type=="tvshow_episode"){
    $vidName = $tvepisode->vid_src.".".$vidType;
}else{
    echo "ERROR";
}


$pattern = '/[-]+/';
$formattedVidSrc = preg_replace($pattern, '_', $formattedTitle)."_".$movie_id;
$file = $target_dir.$vidName;
$newVidTitle = $formattedVidSrc.".".$vidType;
rename($file,$target_dir.$newVidTitle);
?>