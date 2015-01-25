<?php
 session_start(); 
 if (!isset($_SESSION['login_email'])) {
     echo("<script>location.href = '/ecomm/index.php';</script>"); 
 } 
 if (isset($_SESSION['login_email']) && $_SESSION['type'] == "admin") {
     echo("<script>location.href = '/ecomm/index.php';</script>"); 
 } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart Pages</title>
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
      width: 60%;
  }

  th {
      height: 50px;
  }      
</style> 
<script type="text/javascript">
function reply_click(clicked_id)
{   
    location.href="ShoppingCartPage.php?uid=" + clicked_id;
}
</script>
</head>

<body>
<?php 
    ob_start();   
      $email = $_SESSION['login_email']; 
      $id = $_SESSION['CustomerID']; 
      $con=mysqli_connect("localhost","root","root","e_commerce"); 
      
      // Check connection
      if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }   
       

      $msg = ""; 
      
      $res = mysqli_query($con,"DELETE FROM transaciton WHERE Transaction_Date < ( now() - INTERVAL 72 HOUR) and Shipping_company = '$msg'"); 

      $result = mysqli_query($con,"SELECT * FROM transaciton WHERE CustomerID ='$id' ORDER BY TransactionID asc");   
      
      if ($_GET["uid"]) { 
          $transID = $_GET["uid"];
          $ok = mysqli_query($con,"UPDATE transaciton set flag = 1 where TransactionID = '$transID'");                   
          if ($ok) {
                echo("<script>alert('Please Wait');</script>");
                echo("<script>location.href = '/ecomm/index.php';</script>");
          }  

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
                
                <li><a href="mobiles.php">Mopiles </a>
                        
                <ul>
                <li><a href="nokia.php">nokia</a></li>
                <li><a href="samsong.php">samsong</a></li>
                <li><a href="HTC.php">HTC</a></li>
                </ul>
                </li>
                        
                <li><a href="computers.php">Computers</a>
                <ul>
                <li><a href="DELL.php">DELL</a></li>
                <li><a href="HP.php">HP</a></li>
                <li><a href="LENOVO.php">LENOVO</a></li>
                </ul>
                </li> 
                <li><a href="/ecomm/ShoppingCartPage.php">Shopping Cart</a></li>
                <li><a href="/ecomm/updateCustomer.php?uid=update">Settings</a></li>
                
                <li><a href="logout.php"> logout </a></li>
            
            </ul>
        </div> 
        
    </div>
<!---------------------------------------------------------------------------------------->
<div class="clear"></div> 
<!--------------------------------------------first block---------------------------------->
        
    <div align="center"> 
      <br><br><br><br>           
      <br><br>    
      <?php  
          
         echo "<table border=\"4px solid black;\" style=\"width: 90%;border: 4px solid black;\">"; 
         echo "<form method=\"post\" name=\"ff\">";
         echo "<tr style=\"background-color: green; color: white;\"><th><center>" . "Transaction Number" . "</center></th><th><center>" . "Transaction Date" . "</center></th><th><center>" . "Transaction Quantity" . "</center></th><th><center>" . "Product Price" . "</center></th><th><center>" . "Product Name" . "</center></th><th><center>" . "Product Category" . "</center></th>
            <th><center>Product Sub Category</center></th><th><center>Product Descripption</center></th><th><center>Shipped Company</center></th><th><center>Date Shipped</center></th><th><center>checkout</center></th></tr>";
          

          while( $arr = mysqli_fetch_array($result)){
              $ProID = $arr['ProductID'];

              $conn=mysqli_connect("localhost","root","root","e_commerce"); 
              $pro_result = mysqli_query($conn,"SELECT * FROM product WHERE ProductID ='$ProID'");
              $arr2 = mysqli_fetch_array($pro_result);
              
              if($arr['Date_Shipped'] == ""){
                 echo "<tr><td><center>" .$arr['TransactionID']. "</center></td><td><center>" .$arr['Transaction_Date']. "</center></td><td><center>" .$arr['Transaction_Quantity']. "</center></td><td><center>" .$arr2['Product_Prise']. "</center></td><td><center>" .$arr2['Product_Name']. "</center></td><td><center>" .$arr2['Product_Category']. "</center></td><td><center>" .$arr2['Product_Sub_Category']. "</center></td><td><center>" .$arr2['Product_Description']. "</center></td><td style=\"background-color: yellow; color: black;\"><center>" .$arr['Shipping_company']. "</center><td style=\"background-color: yellow; color: black;\"><center>" .$arr['Date_Shipped']. "</center></td><td><center>
                 <input type=\"button\" value=\"Check out\" id=".$arr['TransactionID']." onClick=\"reply_click(this.id)\"></center></td></tr>";  
                 
              }
              else{
                echo "<tr><td><center>" .$arr['TransactionID']. "</center></td><td><center>" .$arr['Transaction_Date']. "</center></td><td><center>" .$arr['Transaction_Quantity']. "</center></td><td><center>" .$arr2['Product_Prise']. "</center></td><td><center>" .$arr2['Product_Name']. "</center></td><td><center>" .$arr2['Product_Category']. "</center></td><td><center>" .$arr2['Product_Sub_Category']. "</center></td><td><center>" .$arr2['Product_Description']. "</center></td><td style=\"background-color: red; color: black;\"><center>" .$arr['Shipping_company']. "</center><td style=\"background-color: red; color: black;\"><center>" .$arr['Date_Shipped']. "</center></td><td><center>
                <input type=\"button\" value=\"Done\" id=".$arr['TransactionID']." onClick=\"reply_click(this.id)\" disabled></center></td></tr>";  
                
              }
              
               mysqli_close($conn);
          }  
          echo "</form>";
          echo "</table>"; 
          
      ?> 
    </div>  


<!-------------------------------------------------------------------------------------------------->
       
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
