<?php
//ini_set('display_errors',1); 
// Sau khi dung xong phai dong lai.
include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';
if(isset($_POST['register_account']))
{
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    //escape
    $username = mysqli_real_escape_string($connect, $username);
    $password = mysqli_real_escape_string($connect, $password);
    $email = mysqli_real_escape_string($connect, $email);
    $address = mysqli_real_escape_string($connect, $address);
    $phone = mysqli_real_escape_string($connect, $phone);
    //check empty condition
    if (empty($username) || empty($password) || empty($address) || empty($phone) || empty($email))
    {       
        echo "<script>alert('Vui lòng điền đầy đủ thông tin!!!')</script>";
        exit();
    }
    else
    {
        if (checkEmail($email) || checkPhone($phone))
        {
            exit();
        }
        else
        {        
             //check username exits
            $check_username = "SELECT * FROM `Users` WHERE `username` = '$username' ;";
            $result_check = mysqli_query($connect, $check_username);
            $num = mysqli_num_rows($result_check);
            if ($num > 0)
            {
                echo "<script>alert('Username already exist!!!')</script>";
            }
            else
            {   
                
                if (checkLengthPass($password) < 8 )
                {
                   
                    echo "<script>alert('Vui lòng nhập password có độ dài từ 8 ký tự !!')</script>";
                }
                else
                {
                  
                    $password = password_hash($password, PASSWORD_DEFAULT); //hash password cua user de luu vao db
                    //insert
                    $register_account = "insert into `Users` (`username`, `password`, `email`, `address`, `phone`) 
                    values ('$username', '$password', '$email', '$address', '$phone')";
                    $result_query = mysqli_query($connect, $register_account);
                    if($result_query)
                    {
                        echo "<script>alert('Tạo tài khoản thành công!!');window.location.href='login.php';</script>";
                        
                    }
                    else
                    {
                        echo "Something went wrong!";
                    }
                    exit();
                    }
                
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body class = "bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Register</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- username -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="user_name" class="form-label">Username</label>
                <input type="text" name="user_name" id="product_name" class="form-control" placeholder = "Enter username" autocomplete="off" required ="required">
            </div>
            <!-- password -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder = "Enter password" autocomplete="off" required ="required">
            </div>
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
                <input type="Submit" name="register_account"  class="btn-btn-infor mb-3 px-3" value="Register">
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>