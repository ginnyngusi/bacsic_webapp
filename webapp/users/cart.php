<?php
session_start();
?>
 <?php 
    
    include $_SERVER['DOCUMENT_ROOT']. '/includes/connect.php';
    include $_SERVER['DOCUMENT_ROOT']. '/includes/function.php';
    if(isset($_POST['submit']))
    { //check int 
       
        
        foreach($_POST['quantity'] as $key => $val) 
        {   
            checkInt($val);
            if($val == 0) 
            { 
                unset($_SESSION['cart'][$key]); 
                echo "<script>window.location.href='cart.php';</script>";
            }
            else
            { 
                $_SESSION['cart'][$key]['quantity']=$val; 
                echo "<script>window.location.href='cart.php';</script>";
                
            } 
        } 
        
    } 

?> 

<h1>View cart</h1> 
<a href="../index.php?">Go back to the products page.</a> 
<form method="post" action="cart.php"> 
    <table>     
      <tr> 
          <th>Name</th> 
          <th>Quantity</th> 
          <th>Price</th> 
          <th>Items Price</th> 
      </tr> 
<?php 

    

    $arrayId = array();
    // print_r($_SESSION);
    $sql='SELECT * FROM Product WHERE ID IN ('; 
        foreach($_SESSION['cart'] as $id => $value) 
        { 
            $arrayId[] = $id;
        }
                    
        $sql .= implode(',', $arrayId);
        $sql.=");"; 
        // print_r($sql);

        $query=mysqli_query($connect, $sql); 
        $totalprice=0; 
        while($row=mysqli_fetch_array($query))
        { 
            $subtotal=$_SESSION['cart'][$row['ID']]['quantity']*$row['price']; 
            $totalprice+=$subtotal; 
?> 
<tr> 
        <td><?php echo $row['productname'] ?></td> 
        <td><input type="text" name="quantity[<?php echo $row['ID'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['ID']]['quantity'] ?>" /></td> 
        <td><?php echo $row['price'] ?>$</td> 
        <td><?php echo $_SESSION['cart'][$row['ID']]['quantity']*$row['price'] ?>$</td> <br>
</tr>   
<?php 
        $_SESSION['total'] = $totalprice;     
        
    } 
?> 
<tr> 
    <td colspan="4">Total Price: <?php echo $totalprice ?></td> 
</tr> 
</table> 
<br> 
    <button type="submit" name="submit">Update Cart</button> 
</form> 
<br /> 

<a class="nav-link" href="./payment.php">Pay the Order</a>

<p>To remove an item, set it's quantity to 0. </p>
