<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
    include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';
   
    if (isset($_POST['user_confirm']))
    {
        $username = $_POST['user_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $new_pw = $_POST['password'];
        if(empty($username) || empty($email) || empty($phone) || empty($new_pw))
        {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin!!!')</script>";
            exit();
        }
        else
        {
            $username = mysqli_real_escape_string($connect, $username);
            $email = mysqli_real_escape_string($connect, $email);
            $phone = mysqli_real_escape_string($connect, $phone);
            $new_pw = mysqli_real_escape_string($connect, $new_pw);
            if(checkPhone($phone) || checkEmail($email))
            {
                exit();
            }
            else
            {
                $check_username = "SELECT * FROM `Users` WHERE `username` = '$username';";
                $result_check = mysqli_query($connect, $check_username);
                $num = mysqli_num_rows($result_check);
                if ($num > 0)
                {
                    $row = mysqli_fetch_assoc($result_check);
                    if(($email === $row['email']) && $phone === $row['phone'])
                    {
                        if (checkLengthPass($new_pw) < 8)
                        {
                            echo "<script>alert('Vui lòng nhập password mới có 8 ký tự trở lên!')</script>";
                        }
                        else
                        {
                            $new_pw = password_hash($new_pw, PASSWORD_DEFAULT);
                            $update_pw = "UPDATE `Users` SET `password` = '$new_pw' 
                                        WHERE `username` = '$username';";
                            $sql = mysqli_query($connect, $update_pw);
                            if ($sql)
                            {
                                echo "<script>alert('Update password thành công!')</script>";
                                header("location:./login.php");
                            }
                            else
                            {
                                echo "<script>alert('Something went wrong!')</script>";
                            }
    
                        }
                    }
                }
                else
                {
                    echo "<script>alert('Username không tồn tại!!!')</script>";
                    exit();
                }
                
            }
        }
        }
    
    



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sofina Cigarette</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body class = "bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Forget Password</h1>
        <!-- login form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- username -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="user_name" class="form-label">Username</label>
                <input type="text" name="user_name" id="user_name"  class="form-control" placeholder = "Enter username" autocomplete="off" required ="required">
            </div>
            <!-- email -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder = "Enter email" autocomplete="off" required ="required">
            </div>
            <!-- email -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="phone" class="form-label">Phone</label>
                <input type="phone" name="phone" id="phone" class="form-control" placeholder = "Enter phone" autocomplete="off" required ="required">
            </div>
           <!-- password -->
           <div class="form-outline mb-4 w-50 m-auto">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder = "Enter password" autocomplete="off" required ="required">
            </div>
            

            <div class="form-outline mb-4 w-50 m-auto">
                <input type="Submit" name="user_confirm"  class="btn-btn-infor mb-3 px-3" value="Confirm">
                <a class="nav-link" href="./register.php">Register</a>
                <a class="nav-link" href="./login.php">Login</a>
            </div>
            
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>