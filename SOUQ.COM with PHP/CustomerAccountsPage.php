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
<title>Customer Accounts Page</title>
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
<script type="text/javascript">
function reply_click(clicked_id)
{  
    window.location.href = "/ecomm/updateCustomer.php?uid="+clicked_id; 
}
</script>
</head>

<body>
<?php 
    ob_start();   
      $email = $_SESSION['login_email']; 
      $id = $_SESSION['id'];
      
      $con=mysqli_connect("localhost","root","root","e_commerce"); 
      
      // Check connection
      if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }  
      
      $result = mysqli_query($con,"SELECT * FROM customer");  
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
                <li><a href="/ecomm/adminProfile.php" class="active">MY Profile  </a></li>
                <li><a href="/ecomm/CustomerAccountsPage.php" >Customers Accounts  </a></li>
                <li><a href="/ecomm/StorePage.php" >Store Page</a></li>
                <li><a href="/ecomm/ShippingPage.php" >Shipping Page</a></li>
                <li><a href="logout.php"> logout </a></li>
            
            </ul>
        </div> 
        
    </div>

    <div align="center"> 
      <br><br><br><br>        
      <label class="labelname"> THIS IS THE LIST OF CUSTOMERS WE HAVE </label>
      <br><br>
      <?php  
          echo "<table border=\"4px solid black;\" style=\"width: 60%;border: 4px solid black;\">"; 
          echo "<form method=\"post\" name=\"ff\">";
          echo "<tr style=\"background-color: green; color: white;\"><th><center>" . "Customer Name" . "</center></th><th><center>" . "Customer Email" . "</center></th><th><center>" . "Customer Phone" . "</center></th><th><center>" . "Customer Address" . "</center></th><th><center>" . "Customer Password" . "</center></th>
             <th><center>update</center></th></tr>";
        
          while( $arr = mysqli_fetch_array($result)){  
          echo "<tr><td><center>" .$arr['Customer_Name']. "</center></td><td><center>" .$arr['Customer_Email']. "</center></td><td><center>" .$arr['Customer_Phone']. "</center></td><td><center>" .$arr['Customer_Address']. "</center></td><td><center>" .$arr['Customer_Password']. "</center></td><td><center>
            <input type=\"button\" value=\"update\" id=".$arr['CustomerID']." onClick=\"reply_click(this.id)\"></center></td></tr>";  
            
          } 
          echo "</form>";
          echo "</table>"; 
          
      ?>
    </div>  
 
     

</div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
          <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
 