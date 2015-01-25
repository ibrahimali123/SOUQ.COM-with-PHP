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
<title>My Profile</title>
<link href="css/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="css/reset-min.css" rel="stylesheet" type="text/css" />
<link href="css/myProfile.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
  .labelname { font-size:20px; font-weight:bold; font-family:Tahoma, Geneva, sans-serif; color:#33C; padding:10px; }          
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
      
      $result = mysqli_query($con,"SELECT * FROM admin where AdminID = '$id'"); 
      $arr = mysqli_fetch_array($result);
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
<!------------------------------------------slider--------------------------------------->
    
<!----------------------------------------------------------------------------------------->

<!---------------------------------------------------------------------------------------->
    <div id="contents">
<!--------------------------------------------first block---------------------------------->
        
    <div align="center"> 
      <br><br><br><br> 
      <label class="labelname">This is Your information</label>        
      <br><br>    
      <?php  
      echo "<table border=\"4px solid black;\" style=\"width: 60%;border: 4px solid black;\">"; 
      echo "<form method=\"post\" name=\"update\">";
      echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Your Name" . "</center></th>
      <td><center>".$arr['Admin_Name']."</center></td></tr>";
      
      echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Your Email" . "</center></th>
      <td><center>".$arr['Admin_Email']."</center></td></tr>"; 
       
      echo "</form>";
      echo "</table>";
     

      ?>
    </div>  


<!-------------------------------------------------------------------------------------------------->
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
