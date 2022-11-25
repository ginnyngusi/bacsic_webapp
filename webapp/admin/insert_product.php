<?php
// Su dung dong nay de debug neu co loi
//ini_set('display_errors',1); 
// Sau khi dung xong phai dong lai. Neu khong khi len production se show loi, ngta lam dung loi.
//include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';
if(isset($_POST['insert_product']))
{
    $product_name = $_POST['product_name']; 
       //accessing image
    $image = $_FILES['image']['name']; //ten ban dau cua file 
    $temp_name = $_FILES['image']['tmp_name']; //ten duoc upload len server
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    


    $product_name = mysqli_real_escape_string($connect, $product_name);
    $image = mysqli_real_escape_string($connect, $image);
    $stock = mysqli_real_escape_string($connect, $stock);
    $price = mysqli_real_escape_string($connect, $price);

    // check empty condition
    if (empty($product_name) || empty($image) || empty($stock) || empty($price))
    {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin!!!')</script>";
        exit();
    }
    else
    {   //check duoi filename, gia san pham, so luong sna pham co hop le khong
        if (checkFileName($image) || checkInt($stock) || checkInt($price))
        {
            
        }
        
        else
        {   //update neu san pham da ton tai trong db
            $check_productname = "select * from `Product` where `productname` = '$product_name';";
            $result_check = mysqli_query($connect, $check_productname);           
            $num = mysqli_num_rows($result_check);
            if ($num > 0)
            {
                // print_r($product_name);
                $update = "update `Product` set `stock` = `stock` + $stock WHERE `Product`.`productname` = '$product_name'; ";
                $result_update = mysqli_query($connect, $update);
                echo "<script>alert('Sản phẩm đã tồn tại!, Đã update số lượng sản phẩm!')</script>";
                exit();

            }
            else
            {
                //them san pham vao database
                move_uploaded_file($temp_name,"../images/$image");
                // query
                
                
                $insert_product = "insert into `Product` (`productname`, `img`, `stock`, `price`) values ('$product_name', '$image', '$stock', '$price')";
                $result_query = mysqli_query($connect, $insert_product);
                
                if($result_query)
                {
                    echo "<script>alert('Thêm thành công!')</script>";
                }
                else
                {
                    echo "<script>alert('Something went wrong!')</script>";
                }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body class = "bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Product</h1>
        <form action="insert_product.php" method="post" enctype="multipart/form-data">
            <!-- productname -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control" placeholder = "Enter product name" autocomplete="off" required ="required">
            </div>
            <!-- image -->
            <div class="form-outline mb-4 w-50 m-auto" method="post" enctype="multipart/form-data">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" name="image" id="image" class="form-control"  required ="required">
            </div>
            <!-- stock -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" name="stock" id="stock" class="form-control" placeholder = "Enter stock" autocomplete="off" required ="required">
            </div>
            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="Price" class="form-label">Price</label>
                <input type="text" name="price" id="price" class="form-control" placeholder = "Enter price" autocomplete="off" required ="required">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <input type="Submit" name="insert_product"  class="btn-btn-infor mb-3 px-3" value="Insert Products">
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>