<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
    include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';
    
    $sitekey = '6LdmAvoiAAAAAHMEx3qYoUfkOZDWP0Ikw1QHYxbj';
    $secretkey= '6LdmAvoiAAAAAIjiDkT1SiKqqwma6juQyiCdM8Mw';
    if(isset($_POST['user_login']))
    {
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
        {
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretkey.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse, true);
            if($responseData["success"] === true)
            {
                   
            }
            else{
                echo "You are a robot";   
                exit();  
            }
        }
        else
        {
            echo "Vui long xac nhan capcha";   
            exit();   
        }
        


    //check empty condition
        if (empty($username) || empty($password))
        {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin!!!')</script>";
            exit();
        }
        else
        {
            $username = mysqli_real_escape_string($connect, $username);
            $password = mysqli_real_escape_string($connect, $password);
            // check username exits
            $check_username = "select * from `Users` where `username` = '$username' ";//limit
            $result_check = mysqli_query($connect, $check_username);
            $num = mysqli_num_rows($result_check);
            
            if ($num > 0) //==1
            {
                $row = mysqli_fetch_assoc($result_check);
                if(password_verify($password, $row['password']))
                {
                    $_SESSION['username'] = $username;
                   
                    if ($remember == '1' || $remember == 'on')
                    {
                        $hour = time() + 3600 * 24 * 30;
                        setcookie('username', $username, $hour);
                    }

                    
                    if ($row['type'] == 'admin')
                    {
                        echo "<script>alert('Login Successful!');window.location.href='../admin/index.php';</script>";
                    }
                   else 
                   {
                         echo "<script>alert('Login Successful!');window.location.href='profile.php';</script>";
                   }
                }
                else
                {
                    echo "<script>alert('Sai username or password!!')</script>";
                }
            }
            else
            {
                echo "<script>alert('Username không tồn tại!!!')</script>";

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
        <h1 class="text-center">Login</h1>
        <!-- login form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- username -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="user_name" class="form-label">Username</label>
                <input type="text" name="user_name" id="user_name" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"  class="form-control" placeholder = "Enter username" autocomplete="off" required ="required">
            </div>
            <!-- password -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder = "Enter password" autocomplete="off" required ="required">
            </div>
            <!-- remember me -->
            <tr>
              <td colspan="2">
                <div class="form-outline mb-4 w-50 m-auto">
                  <input type="checkbox" name="remember" value="1" />
 
                  <label>Remember login</label>
                </div>
              </td>
            </tr>
            <!-- capcha -->
            <div class="g-recaptcha form-outline mb-4 w-50 m-auto" name="g-recaptcha" data-sitekey="<?php echo $sitekey; ?>"></div>
            

            <div class="form-outline mb-4 w-50 m-auto">
                <input type="Submit" name="user_login"  class="btn-btn-infor mb-3 px-3" value="Login">
                <a class="nav-link" href="./register.php">Register</a>
                <a class="nav-link" href="./fogetpasswd.php">Forget Password</a>
            </div>
            
        </form>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>