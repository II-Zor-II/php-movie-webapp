<?php 

if(!empty($_FILES["vidToMove"]["tmp_name"])){
$type= isset($_POST['submit'])? $_POST['submit'] : "undefined";
$vidType= "mp4";
$target_dir = "assets/videos/"; //directory variable to be changed
$vidName = "";

if($type=="movie"){
    $vidName = $movie->vidSrc.".".$vidType;
}else if($type=="tvshow_episode"){
    $vidName = $tvepisode->vid_src.".".$vidType;
}else{
    echo "ERROR";
}
//



$target_file = $target_dir . basename($_FILES["vidToMove"]["name"]); // specifies the path of the file
$uploadOk=1; // somesort of variable token to be used later for conditional statements if the file is uploaded correctly or an error occured


$vidFileName = $target_dir.$vidName;
//

if(file_exists($vidFileName)){
    unlink($vidFileName);
}


    if (move_uploaded_file($_FILES["vidToMove"]["tmp_name"], $vidFileName)) {
        //if correct do nothing
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    
}


?>