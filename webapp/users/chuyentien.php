<?php
session_start();

?>
<h1>Chuyển tiền</h1>
<h4>Thông tin chuyển tiền</h4>
<?php
    
    
    include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
    include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';

    if (isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        echo "<p>Chuyển tiền từ tài khoản $username: </p>";
    }
?>
<p></p>
<form action="chuyentien.php" method="post" enctype="multipart/form-data">
    <label for="account" class="form-label">Nhập username người nhận</label>
    <div class="form-outline mb-4 w-50 m-auto">
        <input type="text" name="account" id="acount" class="form-control" autocomplete="off" required ="required">
    </div>
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="moneysend" class="form-label">Số tiền</label><br>
        <input type="text" name="moneysend" id="moneysend" class="form-control"  autocomplete="off" required ="required"><br>
    <div class="form-outline mb-4 w-50 m-auto">
       
        <label for="pw" class="form-label">Nhập password của bạn</label><br>
        <input type="password" name="pw" id="pws" class="form-control"autocomplete="off" required ="required"> <br>
        


<input type="Submit" name="send"  class="btn-btn-infor mb-3 px-3" value="Send"></form><br>
<a class="nav-link" href="./profile.php">My profile</a>

<?php
    if (isset($_POST['send']))
    {
        
        $account = $_POST['account'];
        $moneysend =  $_POST['moneysend'];
        $pw = $_POST['pw'];
        
        $account = mysqli_real_escape_string($connect, $account);
        $moneysend = mysqli_real_escape_string($connect, $moneysend);
        $pw  = mysqli_real_escape_string($connect, $pw);
        // print_r($account);
        $checkuser = "select * from `Users` where  `username` = '$account';";
        $result_check = mysqli_query($connect, $checkuser);
        $num = mysqli_num_rows($result_check);
        
            if ($num == 0)
            {
                echo "Người nhận không hợp lệ";
                exit();
            }
            else
            {
                if (checkInt($moneysend))
                {
                    
                }
                else
                {
                    $selectuser= "select * from `Users` where  `username` = '$username';";
                    $result = mysqli_query($connect, $selectuser);
                    $num = mysqli_num_rows($result);
                    
                    if ($num > 0)
                    {
                        $row = mysqli_fetch_assoc($result);
                        if (password_verify($pw, $row['password']))
                        {
                            if ($moneysend > $row['money'])
                            {
                                echo "Tài khoản không đủ, vui lòng nạp thêm tiền";
                            }
                            else
                            {
                                $querysend = "update `Users` set `money` = `money`  - $moneysend where `Users`.`username` = '$username';";
                                $querydelivered = "update `Users` set `money` = `money` + $moneysend where `Users`.`username` = '$account';";
                                $send = mysqli_query($connect, $querysend);
                                $delivered = mysqli_query($connect, $querydelivered);
                                if ($querysend && $querydelivered)
                                {
                                    echo "Chuyển tiền thành công";
                                }
                                else 
                                {
                                    echo "Error";
                                }
                            }
                            
                        }
                        else
                        {
                            echo "Password không đúng";
                        }

                    }

                }

            }
        }           

?>