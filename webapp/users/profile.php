<?php
    include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
    include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sofina Cigarette</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- first -->
    <div class="container-fluid p-0"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Sofina</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <?php
          if (isset($_SESSION['username']))
          {
            echo "<li class='nav-item'>
            <a class='nav-link' href='./cart.php'>Cart</i></a>
          </li>";
          }
          else 
          {
            echo "<li class='nav-item'>
            <a class='nav-link' href='./users/login.php'>Cart</i></a>
          </li>";
          }
          ?>
        </ul>       
      </div>
    </div>
    </nav>
     <!-- second -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
      <?php
        echo "<li class='nav-item'>
        <a class='nav-link' href=#> Welcome ".$_SESSION['username']." </a>
        </li>"; 
      ?>
      <li class="nav-item">
        <a class="nav-link" href=./logout.php>Logout</a>
      </li>
      </ul>
     </nav>
    <h2 class="text-center">My Profile</h2>

    <?php
      showProfile();
    ?>  
    <li class="nav-item text-center">
            <a class="nav-link" href="./put_money.php">Put Money</a>
            <a class="nav-link" href="./update_profile.php">Update Profile</a>
            <a class="nav-link" href="./chuyentien.php">Chuyen tien</a>
            <a class="nav-link" href="./upvip.php">Up vip</a>
    </li>


    <!-- <div class="col-md-2 form-outline mb-4 w-5 m-auto">
        <input type="file" value="Update avatar">
    </div> -->
    
    <!-- <div class="col-md-2 form-outline mb-4 w-5 m-auto"s>
    <img src='../images/avatar/default.jpg' class='card-img-top' alt=''>
      <h4>Username: Ginny</h4>
      <h4>Fullname: Ginny</h4>
      <h4>Email: kk</h4>
      <h4>Phone: adfs</h4>
      <h4>Adress:f </h4>
      <div class="col-md-2 form-outline mb-4 w-5 m-auto">
          <input type="Submit" name="insert_product"  value="Update profile">
    </div>
    </div> -->



  

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>