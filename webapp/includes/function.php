<?php
    

    
    function checkFileName($filename)
    {
        $extension = end(explode(".", $filename)); //explode: split chuoi boi dau ".", end: lay phan tu cuoi cung 
        if (in_array($extension, ["png", "jpg", "jpeg", "gif"])) //white
        {
        }
        else
        {
            echo "<script>alert('Vui lòng up ảnh hợp lệ!!')</script>"; 
            exit();
        } 
            
    }


    function checkInt($stock)
    {
        if(!is_numeric($stock) || $stock < 0) //is_numeric: return true neu $stock la mot so nguyen 
        {
            echo "<script>alert('Error')</script>";
            exit();
        }
        
            
    }

    
    function checkEmail($email)
    {
        $check = !preg_match('/[^A-Za-z0-9@.]/i', $email);
        if (!$check)
        echo "<script>alert('Vui lòng nhập email hợp lệ!!')</script>";
    }

    function checkPhone($phone)
    {
        if(!preg_match('/^[0-9]{10}+$/', $phone)) 
        {
            echo "<script>alert('Vui lòng nhập phone hợp lệ!!')</script>";
        } 
        
    }
    function checkLengthPass($password)
    {
        $lenghth = strlen($password);
        return $lenghth;
    }


    function showProfile()
    {
        global $connect;
        $username = $_SESSION['username'];
        // $query = "select * from `Users` where `username` = '$username';";
        $query_user = "select * from `Users` where `username` = '$username';";
        $result_query = mysqli_query($connect, $query_user);
        $row = mysqli_fetch_assoc($result_query);
       
        $avatar = $row['avatar'];
        $name = $row['fullname'];
        $address = $row['address'];
        $phone = $row['phone'];
        $mail = $row['email']; 
        $money =$row['money'];
        $vip = $row['vip'];
       
        
        echo "<div class='col-md-3 form-outline mb-2 w-5 m-auto's>
        <img src='../images/avatar/$avatar' class='card-img-top' alt=''>
          <h4>Username: $username</h4>
          <h4>Fullname: $name</h4>
          <h4>Email: $mail</h4>
          <h4>Phone: $phone</h4>
          <h4>Adress: $address </h4>
          <h4>Money: $money </h4>
          <h4>Loại tài khoản: ";
          if($vip== 0)
            {
                echo "Thường";
            }
          else
           {
                echo "Vip";
           }
        echo " </h4>
        </div>";

    }

        function updateProfile()
        {

            global $connect;
            
            $username = $_SESSION['username'];
            

            $mail = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $name = $_POST['fullname'];
            $image = $_FILES['image']['name']; //ten ban dau cua file 
            $temp_name = $_FILES['image']['tmp_name']; //ten duoc upload len server

            $mail = mysqli_real_escape_string($connect, $mail);
            $phone = mysqli_real_escape_string($connect, $phone);
            $address =mysqli_real_escape_string($connect, $address);
            $name = mysqli_real_escape_string($connect, $name);
            $image = mysqli_real_escape_string($connect, $image);
           

            if (checkFileName($image) || checkPhone($phone) || checkEmail($mail))
            {
                

            }
            else 
            {
                move_uploaded_file($temp_name, $_SERVER['DOCUMENT_ROOT']."/images/avatar/$image");

                $query = "update `Users` 
                        set `fullname` = '$name', `email` = '$mail', `phone` = '$phone', `address` = '$address', `avatar` = '$image'
                        where `username` = '$username';";
                $result = mysqli_query($connect, $query);
                if($result)
                {
                    echo "<script>alert('Update thành công!');window.location.href='profile.php';</script>";
                    
                    
                }
                else
                {
                    echo "Something went wrong!";
                }
                exit();

            }
            

        }

        function debugX($string){
            echo "<script> console.log(\"$string\")</script>";

        }

        function add_to_cart()
        {
            include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
        // debugX("Starting add to cart ");

            if(isset($_GET['action']) && $_GET['action']=="add")
            { 
                // debugX("In condition action");
                $id=(int) ($_GET['id']);      
                if(isset($_SESSION['cart'][$id]))
                {  
                    // print_r($_SESSION);
                    // debugX("Found a sesssion");
                    $_SESSION['cart'][$id]['quantity']++; 

                }
                else
                {   
                    // debugX("Into database");
                    $query="select * from `Product` 
                        WHERE `ID` = '$id'"; 
                    $result=mysqli_query($connect, $query); 

                    if(mysqli_num_rows($result)!=0)
                    { 
                        $row_s=mysqli_fetch_array($result); 
                        $_SESSION['cart'][$id]=array( 
                                "quantity" => 1, 
                                "price" => $row_s['price'] 
                            );                      
                    }
                    else
                    { 
                          
                        
                        echo "Error";
                          
                    } 
                      
                } 
                  
            } 
        }
    
             
        
            
    

?>