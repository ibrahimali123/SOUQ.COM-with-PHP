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
<title>Shipping Pages</title>
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
    location.href = "/ecomm/ShippingPage.php?uid="+clicked_id; 
}
</script>
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
      
      $TransID = $_GET["uid"];

      $msg = "";
      $result = mysqli_query($con,"SELECT * FROM transaciton");  
      if (isset($_POST['Ship_company'])) {
          $Shipping_company = $_POST['Ship_company'];
          $ok = mysqli_query($con,"UPDATE transaciton set Shipping_company = '$Shipping_company' where flag = 1"); 
          $result_comp = mysqli_query($con,"SELECT Shipping_company FROM transaciton where flag = 1");
          $row = mysqli_fetch_array($result_comp);
          $comp = $row['Shipping_company'];
          echo("<script>location.href = '/ecomm/ShippingPage.php';</script>");
      }
      if ($_GET["uid"] ) { 
                $transID = $_GET["uid"];
                $Date_Shipped = date("Y.m.d"); 
                $uProductID = $_GET["uProductID"];
                $ok = mysqli_query($con,"UPDATE transaciton set flag = 0 , Date_Shipped = '$Date_Shipped' where TransactionID = '$transID'");                   
                $result_q = mysqli_query($con,"SELECT Product_Quant_InStock FROM product where ProductID = '$uProductID'");
                $row = mysqli_fetch_array($result_q);
                $q = $row['Product_Quant_InStock'] - 1;
                $ok = mysqli_query($con,"UPDATE product set Product_Quant_InStock = '$q'  where ProductID = '$uProductID'");
                if ($q == 0) {
                      mysqli_query($con,"DELETE from product where Product_Quant_InStock = 0"); 
                      mysqli_query($con,"DELETE from transaciton where ProductID = '$uProductID'"); 
                }
                if ($ok) { 
                      echo("<script>location.href = '/ecomm/ShippingPage.php';</script>");
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
        
    <div align="center"> 
      <br><br><br><br>  
      <form name="Shipping_company" method="post">
        <label class="labelname">Please choose company to ship products</label>
        <input type="text" name="Ship_company">
        <input type="submit" value="ok" name="Shipping_company">
      </form>
      <br><br> 
      <label class="labelname">Here is products need to be shipped</label>           
      <br><br> 
      <?php  
          
        
          while( $arr = mysqli_fetch_array($result)){ 
              if($arr['flag'] == "1"){
              echo "<table style=\"border: 4px solid black;\">"; 
              echo "<form method=\"post\" name=\"update\">";
              $ProID = $arr['ProductID'];

              $conn=mysqli_connect("localhost","root","root","e_commerce"); 
              $pro_result = mysqli_query($conn,"SELECT * FROM product WHERE ProductID ='$ProID'");
              $arr2 = mysqli_fetch_array($pro_result);
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Transaction Date" . "</center></th>
              <td><center>".$arr['Transaction_Date']."</center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Transaction Quantity" . "</center></th>
              <td><center>".$arr['Transaction_Quantity']."</center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Date Shipped" . "</center></th>
              <td><center><input type=\"text\" name=\"Date_Shipped\" value='".$arr['Date_Shipped']."'></center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Shipping company" . "</center></th>
              <td><center><input type=\"text\" name=\"Shipping_company\" value='".$arr['Shipping_company']."'></center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Price" . "</center></th>
              <td><center>".$arr2['Product_Prise']."</center></td></tr>";

              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Category" . "</center></th>
              <td><center>".$arr2['Product_Category']."</center></td></tr>";

              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Product Name" . "</center></th>
              <td><center>".$arr2['Product_Name']."</center></td></tr>";
              
              echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Shipped" . "</center></th><td>
              <center><input type=\"button\" style=\"background-color: green; color: white;\"  
              id=".$arr['TransactionID']."&udate=".date("Y.m.d")."&ucompany=".$comp."&uProductID=".$arr['ProductID']." onClick=\"reply_click(this.id)\" value=\"Ship\"></center></td></tr>"; 
              mysqli_close($conn);
              echo "</form>";
              echo "</table><br><br>";
              }

          }    
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
