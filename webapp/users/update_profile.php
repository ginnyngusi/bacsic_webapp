<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
    include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';
    if(isset($_POST['update_account']))
    {
        updateProfile();
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sofina Cigarette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body class = "bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Update Profile</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- email -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder = "Enter email" autocomplete="off" required ="required">
            </div>
            <!-- phone -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="phone" class="form-label">Phone</label>
                <input  type="text" id="phone" name="phone" class="form-control" placeholder = "Enter phone" autocomplete="off" required ="required">
            </div>  
            <!-- address -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" placeholder = "Enter address" autocomplete="off" required ="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="address" class="form-label">Fullname</label>
                <input type="text" name="fullname" id="fullname" class="form-control" placeholder = "Enter fullname" autocomplete="off" required ="required">
            </div>

            <div class="form-outline mb-4 w-50 m-auto" method="post" enctype="multipart/form-data">
                <label for="image" class="form-label">Avatar</label>
                <input type="file" name="image" id="image" class="form-control"  required ="required">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <input type="Submit" name="update_account"  class="btn-btn-infor mb-3 px-3" value="Update">
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>