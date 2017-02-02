<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/custom-css.css" />
    </head>
    <body>

   
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="add_file.php"><span class='glyphicon glyphicon-plus'></span> Add</a></li>
        </ul>
        <form class="navbar-form" action="search.php">
          <div class="form-group">
            <div class="input-group">  <!-- search group. Input and button + icon -->
              <input type="text" class="form-control" placeholder="Search for Title..">
              <span class="input-group-btn" >
                <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
              </span>
            </div> <!-- end of search -->
        </form>
      </div>
    </nav>
        
