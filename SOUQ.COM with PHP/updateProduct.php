<?php
 session_start(); 
 if (!isset($_SESSION['login_email'])) {
     echo("<script>location.href = '/ecomm/index.php';</script>"); 
 } 
 if (isset($_SESSION['login_email']) && $_SESSION['type'] == "customer") {
     echo("<script>location.href = '/ecomm/index.php';</script>"); 
 } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Product</title>
<link href="css/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="css/reset-min.css" rel="stylesheet" type="text/css" />
<link href="css/myProfile.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  .contain { width:500px; margin:0 auto; border:2px green dashed; margin-top:15px; min-height:200px; padding:10px; }
  input { font-size:15px; color:#06C; padding:2px; width:200px;     }
  select { font-size:15px; color:#06C; padding:10px; width:200px; margin-top:25px;   }
  .labelname { font-size:20px; font-weight:bold; font-family:Tahoma, Geneva, sans-serif; color:#33C; padding:10px; } 
  #submit { width:100px; height:30px; padding:2px; background-color:#999;}  
  table, td, th {
      border: 1px solid black;
  }

  table {
      width: 100%;
  }

  th {
      height: 50px;
  }      
</style>  
</head>

<body>
<?php 
    ob_start();   
      $email = $_SESSION['login_email']; 
      $id = $_SESSION['AdminID']; 
      $con=mysqli_connect("localhost","root","root","e_commerce"); 
      
      // Check connection
      if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }   
      
      $ProductID = $_GET["uid"];

      $msg = "";
      $result = mysqli_query($con,"SELECT * FROM product WHERE ProductID='$ProductID' ");  
      $arr = mysqli_fetch_array($result);

      if (isset($_POST['update'])) {
         $name = $_POST['name']; 
         $desc = $_POST['desc'];
         $price = $_POST['price'];
         $category = $_POST['cate']; 
         $Product_Quant_InStock =  $_POST['quant'];
         $sub_category = $_POST['subcate'];

         if (isset($_POST['update'])) {
         $result = mysqli_query($con,"UPDATE product SET Product_Name='$name' , Product_Description='$desc' ,
           Product_Prise='$price' , Product_Quant_InStock = '$Product_Quant_InStock' , Product_Category='$category' , Product_Sub_Category='$sub_category' WHERE ProductID='$ProductID'"); 
         
         if ($result) {
             $msg =  "Record updated successfully";
         } else {
             $msg =  "Error updating record: " . mysqli_error($con);
         }
         }
         $result = mysqli_query($con,"SELECT * FROM product WHERE ProductID='$ProductID' ");  
         $arr = mysqli_fetch_array($result);
      }
      if (isset($_POST['delete'])) {
         
         if (isset($_POST['delete'])) {
         $result = mysqli_query($con,"DELETE from product  WHERE ProductID='$ProductID'"); 
         
         if ($result) {
             $msg =  "Record Deleted successfully";
         } else {
             $msg =  "Error updating record: " . mysqli_error($con);
         }
         }
         $result = mysqli_query($con,"SELECT * FROM product WHERE ProductID='$ProductID' ");  
         $arr = mysqli_fetch_array($result);
      }
      mysqli_close($con);
    ob_end_flush();
    /* @var $PHP_SELF type <?php ech $PHP_SELF ?> */
?>
<div id="wrapper">

<!-----------------------------------header---------------------------------------->
    <div id="header">
    
        <div id="logo"> 
            <img src="imges/images/logo_03.png" width="225" height="96" />
        </div> 
        
    </div>
 <!-------------------------------------------------------------------------------------->
 <div class="clear"></div>
 <!-------------------------------------menue-------------------------------------------->
    <div id="headerr">
        <div id="menu">
            <ul>
                <li><a href="index.php" class="active">MY Profile  </a></li>
                <li><a href="/ecomm/CustomerAccountsPage.php" >Customers Accounts  </a></li>
                <li><a href="/ecomm/StorePage.php" >Store Page</a></li>
                <li><a href="/ecomm/ShippingPage.php" >Shipping Page</a></li>
                <li><a href="logout.php"> logout </a></li>
            
            </ul>
        </div> 
        
    </div>
<!---------------------------------------------------------------------------------------->
<div class="clear"></div> 
<!--------------------------------------------first block---------------------------------->
    <div> 
         <span style="color: #FF0000; font-size:25px; float:left;"><?php echo $msg;?></span> 
    </div>    
    <div align="center"> 
      <br><br><br><br> 
      <label class="labelname">Here is your products</label>           
      <br><br>    
      <?php  
           
              echo "<table border=\"4px solid black;\" style=\"width: 60%;border: 4px solid black;\">"; 
              echo "<form method=\"post\" name=\"update\">";

              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Picture" . "</center></th>
              <td><center><img src=\"imges/images/item_M_6312816_3596658.jpg\" /></center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Name" . "</center></th>
              <td><center><input type=\"text\" name=\"name\" value='".$arr['Product_Name']."'></center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Descripition" . "</center></th>
              <td><center><input type=\"text\" name=\"desc\" value='".$arr['Product_Description']."'></center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Quant InStock" . "</center></th>
              <td><center><input type=\"text\" name=\"quant\" value='".$arr['Product_Quant_InStock']."'></center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Price" . "</center></th>
              <td><center><input type=\"text\" name=\"price\" value='".$arr['Product_Prise']."'></center></td></tr>";

              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Category" . "</center></th>
              <td><center><input type=\"text\" name=\"cate\" value='".$arr['Product_Category']."'></center></td></tr>";

              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Sub Category" . "</center></th>
              <td><center><input type=\"text\" name=\"subcate\" value='".$arr['Product_Sub_Category']."'></center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Update" . "</center></th><td>
              <center><input type=\"submit\" style=\"background-color: green; color: white;\"  
              name=\"update\" value=\"update\"></center></td></tr>"; 

              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Delete" . "</center></th><td>
              <center><input type=\"submit\" style=\"background-color: green; color: white;\" 
              name=\"delete\" value=\"Delete\"></center></td></tr>";
              echo "</form>";
              echo "</table>";  
          
      ?> 
    </div>    
<!-------------------------------------------------------------------------------------------------->
<div class="clear"></div>
<!-------------------------------------------------------------------------------------------------->
<div id="back">
    <div id="map">
        
        <div class="mapmenu">
        <ul>
            <h1>MY ACCOUNT</h1>
            <li><a href="">Sign in </a></li>
            <li><a href="">CREATE ACCOUNT</a></li>
            
            
        </ul>
        </div>
        <div class="mapmenu">
        <ul>
            <h1>Customer Service </h1>  
            <li><a href="">About your order</a></li>
            <li><a href="">Wishlist</a></li>
            <li><a href="">Compare list</a></li>
            
        </ul>
        </div>
        <div class="mapmenu">
        <ul>
            <h1>BUY.COM</h1>
            <li><a href="">HOME</a></li>
            <li><a href="">MOPILES</a></li>
            <li><a href="">COMPUTERS</a></li>
            
        </ul>
        </div>
        
        <div class="mapmenu">
        <ul>
          <h1>CONTACT US<h1>
            <li><a href="">OUR TEAM</a></li>
            <li><a href="">PRIVACY POLICY</a></li>
          
            
        </ul>
        </div>
        
    </div>
</div>
<!--------------------------------------------------------------------------------------------------> 
<div class="clear"></div>
<!--------------------------------------------------------------------------------------------------> 
    <div id="fotter">
        <div id="ff">
        <h1>All right reversed for <a href=""> FCI_CU . 2014</a></h1>
        </div>
        <div id="slink">
        <a href="#"><img src="imges/images/fb.png" width="31" height="31" /></a>
        <a href="#"><img src="imges/images/tw.png" width="31" height="31" /></a>
        <a href="#"><img src="imges/images/yt.png" width="31" height="31" /></a>
        <a href="#"><img src="imges/images/rss.png" width="31" height="31" /></a>
        </div>
     </div>
     

</div>

</body>
</html>
