<?php 
$type= isset($_POST['submit'])? $_POST['submit'] : "undefined";

if($type=="movie"){
    $target_dir = $movieImgPartial_Loc;
    $title = $_POST['movie_title'];
}else if($type=="tvshow"){
    $target_dir = $tvshowImgPartial_Loc;
    $title = $_POST['tvshow_title'];
}else{
    echo "UNDEFINED file type.";
}

$file = $target_dir.$imgSrc;
$formattedTitle = preg_replace('/\s+/', '-', ucwords(strtolower($title)));
$imgFileType = pathinfo($file,PATHINFO_EXTENSION);
$newImageTitle = $formattedTitle.".".$imgFileType;
rename($file,$target_dir.$newImageTitle);
?>