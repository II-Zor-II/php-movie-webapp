<?php
include_once 'config/db.php';
include_once 'objects/movie.php';
include_once 'objects/tvshow.php';
include_once 'config/assets.php';

$database = new Database();
$db = $database->getConnection();

$movie = new Movie($db);
$tvshow = new TvShow($db);

include_once "templates/header.php"; //call the header   

$from_record_num = 0;
$records_per_page = 8;

$stmt = $movie->readAll($from_record_num,$records_per_page);

//$page_url = "index.php?";

include_once "main_page.php";

include_once "templates/footer.php"; //call the footer
?>
