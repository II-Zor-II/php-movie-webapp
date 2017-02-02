<?php 

if(!empty($_FILES["imageToUpload"]["tmp_name"])){
$type= isset($_POST['submit'])? $_POST['submit'] : "undefined";
$target_dir = ""; //directory variable to be changed
$title = "";


//condition to check what image-directory to upload it to
if($type=="movie"){
    $target_dir = $movieImgPartial_Loc;
    $title = $_POST['movie_title'];
}else if($type=="tvshow"){
    $target_dir = $tvshowImgPartial_Loc;
    $title = $_POST['tvshow_title'];
}else{
    echo "UNDEFINED file type.";
}
//


$target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]); // specifies the path of the file
$uploadOk=1; // somesort of variable token to be used later for conditional statements if the file is uploaded correctly or an error occured
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION); //pathinfo() function returns an array that contains information about a path. PATHINFO_EXTENSION - returns only extension


// change spaces to dashes also change multiple spaces into a single one and convert it to dashes
// also capitalize the first letter of each word
$formattedTitle = preg_replace('/\s+/', '-', ucwords(strtolower($title)));
$imgFileName = $target_dir.$formattedTitle.".".$imageFileType;
//


// Check if file is actually an image file
if(isset($_POST['submit'])){
    $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
    if($check !== false){
        $uploadOk = 1;
    }else{
        $uploadOk = 0;
    }
}


// Check file size
if ($_FILES["imageToUpload"]["size"] > 8388608) { // this is compared via BYTES
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}


if(file_exists($imgFileName)){
    unlink($imgFileName);
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $imgFileName)) {
// do something
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$imgSrc = $formattedTitle.".".$imageFileType;
    
}
?>