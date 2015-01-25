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
<title>Buy.Com</title>
<link href="css/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="css/reset-min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--[if lte IE 8]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <link href='http://fonts.googleapis.com/css?family=Antic+Slab' rel='stylesheet' type='text/css'>
        
        <!-- Use jQuery for best compatibility with other CSS3 enabled browsers -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
        
        <script src="js/flux.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
        function reply_click(clicked_id)
        {   
            location.href="HP.php?uid=" + clicked_id;
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
      
      $result = mysqli_query($con,"SELECT * FROM product where Product_Category = 'Labtops'");  
        
      if ($_GET["uid"]) { 
          $ProductID = $_GET["uid"];
          $ok = mysqli_query($con,"INSERT INTO transaciton (TransactionID,CustomerID, ProductID, Transaction_Quantity,flag)
                  VALUES (0,'$id', '$ProductID',1,0)");                   
          if ($ok) {
                echo("<script>alert('Please Wait');</script>");
                echo("<script>location.href = '/ecomm/ShoppingCartPage.php';</script>");
          }  

      }
    ob_end_flush();
    /* @var $PHP_SELF type <?php ech $PHP_SELF ?> */
?>
<div id="wrapper">

<!--------------------------------------header---------------------------------------->
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
<!------------------------------------------slider---------------------------------------->
     
<!---------------------------------------------------------------------------------------->
<div class="clear"></div> 
<br><br><br><br><br>
 <div align="block">  
   <?php  
            
       while( $arr = mysqli_fetch_array($result)){ 
                    echo "<table style=\"border: 4px solid black;\">"; 
                    echo "<form method=\"post\" name=\"update\">";

                    echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Picture" . "</center></th>
                    <td><center><img src=\"imges/images/hp.jpg\" /></center></td></tr>";
                    
                    echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Name" . "</center></th>
                    <td><center>".$arr['Product_Name']."</center></td></tr>";
                    
                    echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Descripition" . "</center></th>
                    <td><center>".$arr['Product_Description']."</center></td></tr>";
                    
                    echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Quant InStock" . "</center></th>
                    <td><center>".$arr['Product_Quant_InStock']."</center></td></tr>";
                    
                    echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Price" . "</center></th>
                    <td><center>".$arr['Product_Prise']."</center></td></tr>";

                    echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Category" . "</center></th>
                    <td><center>".$arr['Product_Category']."</center></td></tr>";

                    echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Sub Category" . "</center></th>
                    <td><center>".$arr['Product_Sub_Category']."</center></td></tr>";
                    
                    echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "shopping cart" . "</center></th><td>
                    <center><input type=\"button\" style=\"background-color: green; color: white;\"  
                    id=".$arr['ProductID']." name=".$arr['ProductID']." onClick=\"reply_click(this.id)\" value=\"add to shopping cart\"></center></td></tr>"; 
                    echo "</form>";
                    echo "</table><br><br>";
                  
                }   
       
   ?> 
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
