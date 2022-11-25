<?php
session_start();
?>
<h1>Nâng cấp tài khoản</h1>
<p> Tài khoản vip có thể mua hàng với giá rẻ hơn 30%</p>
<?php
    
    include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
    include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';  
    if (isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $query_user = "select * from `Users` where `username` = '$username';";
        $result_query = mysqli_query($connect, $query_user);
        $row = mysqli_fetch_assoc($result_query);
        $money =$row['money'];
        $type = $row['vip'];
        echo" 
        <p>Username: $username</p>
        <p>Money: $money</p>
        <p>Phí nâng cấp: 500$</p>
        ";
    }
     
?>
<h3>Xác nhận muốn nâng cấp tài khoản</h3>
<form action="upvip.php" method="post" enctype="multipart/form-data">
<input type="Submit" name="Up"  class="btn-btn-infor mb-3 px-3" value="Up"></form>




<?php
   if ($type == 0)
   {
    if(isset($_POST['Up']))
    {
        if (500 <= $money)
        {
            // print_r($money);
            $query = "update `Users` set `money` = `money` - 500 WHERE  `Users`.`username` = '$username';";
            // print_r($query);
            $result = mysqli_query($connect, $query);
            
            if ($result)
            {   $money = $money - 500;
                $query_up = "update `Users` set `vip` = 1 WHERE  `Users`.`username` = '$username';";
                $result_up = mysqli_query($connect, $query_up);

                if ($result_up)
                {
                    echo "Thanh Cong";
                    echo "<br><p>So tien con lai: $money </p>";

                }
                else  
                    echo "Error";
                
            }
            else
            {
                echo "Error";
            }
        }
        else 
        {
            echo "<script>alert('Vui lòng nạp thêm tiền vào tài khoản!');window.location.href='put_money.php';</script>";
        }       
    }
   }
   else
   {
        echo "Tài khoản đã là tài khoản vip";
   }

?>

<br><a class="nav-link" href="../index.php">Home</a><br>
<a class="nav-link" href="./profile.php">My profile</a><br>
