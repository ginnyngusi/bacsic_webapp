<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
    include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';
    if (isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        if (isset($_POST['putmoney']))
        {
           $seri = $_POST['seri'];
           $mathe = $_POST['mathe'];
           $menhgia= $_POST['menhgia'];
          
           $image = mysqli_real_escape_string($connect, $seri);
           $stock = mysqli_real_escape_string($connect, $mathe);
           if (checkInt($seri) || checkInt($mathe))
           {

           }
           else 
           {    
                $query = "update `Users` set `Money`= `Money` + $menhgia
                            where `username` = '$username';";
                $result_query = mysqli_query($connect, $query);
               
                if ($result_query)
                {
                    header("Location: ./profile.php");
                    exit(); 
                }
                else 
                {
                    echo "<script>alert('Error!');window.location.href='put_money.php';</script>";
                }
           }
        }
    }


?>



<body>
<h1 class="text-center">Put Money</h1>
<form action="put_money.php" method="post" enctype="multipart/form-data">

<label for="menhgia">Menh gia($)</label>

<select name="menhgia">
  <option >50</option>
  <option >100</option>
  <option >200</option>
  <option >500</option>
</select>
<div class="form-outline mb-4 w-50 m-auto">
                <label for="seri" class="form-label">Seri</label>
                <input type="text" name="seri" id="seri" class="form-control" autocomplete="off" required ="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_name" class="form-label">Ma the cao </label>
                <input type="text" name="mathe" id="the" class="form-control"  autocomplete="off" required ="required">
            </div>
         
                <input type="Submit" name="putmoney"  class="btn-btn-infor mb-3 px-3" value="Submit">
            </div>
</form>
<a class="nav-link" href="./profile.php">My profile</a>
</body>