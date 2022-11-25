<?php
   
    session_start();
    if (!isset($_SESSION['username']))
    {
        header("Location: ./login.php");
    }
    else
    {
        unset($_SESSION["username"]);
        setcookie("username", "", time() - 3600);
        header("Location:../index.php");
    }
    session_destroy();
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sofina Cigarette</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./users/register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <?php
          if (isset($_SESSION['username']))
          {
            echo "<li class='nav-item'>
            <a class='nav-link' href='./users/cart.php'>Cart</i></a>
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

    
</body>
</html>