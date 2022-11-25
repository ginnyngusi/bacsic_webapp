<?php
    session_start();
?>

<h1>Payment</h1>

<?php
    
    include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
    include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';
    if (!empty($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $query_user = "select * from `Users` where `username` = '$username';";
        $result_query = mysqli_query($connect, $query_user);
        $row = mysqli_fetch_assoc($result_query);
        $money =$row['money'];
        $type = $row['vip'];
        $total = $_SESSION['total'];
        $discount = 0;
        if ($type != 0)
        {
            $discount = $total /100 * 30;
        }
        $totalprice = $total - $discount;
        echo" 
        <p>Username: $username</p>
        <p>Money: $money</p>
        <p>Total: $total</p>
        <p>Discount: $discount</p>
        <p>Total Price: $totalprice</p>
        ";
    }
    

?>
<form action="payment.php" method="post" enctype="multipart/form-data">
<div class="form-outline mb-4 w-50 m-auto">
    <input type="Submit" name="buy"  class="btn-btn-infor mb-3 px-3" value="Buy">
</div>
</form>
<a class="nav-link" href="../index.php">Home</a><br>
<a class="nav-link" href="./profile.php">My profile</a><br>

<?php

    if(isset($_POST['buy']))
    {   
        if ($totalprice < $money)
        {
            // print_r($money);
            $query_money = "update `Users` set `money` = `money` - $totalprice WHERE  `Users`.`username` = '$username';";
            // print_r($query);
            $result = mysqli_query($connect, $query_money);
            
            if ($result)
            {   
                $money = $money - $totalprice;
                echo "Thanh toan thanh cong don hang";
                echo "<br><p>So tien con lai: $money </p>";
                unset($_SESSION['cart']);
                unset($_SESSION['total']);
                exit();
                
            }
            else
            {
                echo "Error";
                exit();
            }
        }
        else 
        {
            echo "<script>alert('Vui lòng nạp thêm tiền vào tài khoản!');window.location.href='put_money.php';</script>";
        }       
    }         
?>

