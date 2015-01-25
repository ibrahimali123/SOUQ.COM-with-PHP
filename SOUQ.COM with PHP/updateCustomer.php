<?php
 session_start(); 
 if (!isset($_SESSION['login_email'])) {
     echo("<script>location.href = '/ecomm/index.php';</script>"); 
 }  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>update Page</title>
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
      $id = $_SESSION['id'];
      
      $con=mysqli_connect("localhost","root","root","e_commerce"); 
      
      // Check connection
      if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }  
      
      if ($_SESSION['type'] == "admin") {
           $CustomerID = $_GET["uid"]; 
      } 
      if ($_SESSION['type'] == "customer") {
           $CustomerID = $_SESSION["CustomerID"]; 
      }
       
      $msg = "";
      $result = mysqli_query($con,"SELECT * FROM customer WHERE CustomerID='$CustomerID' ");  
      $arr = mysqli_fetch_array($result);

     if (isset($_POST['update'])) {
        $name = $_POST['namee']; 
        $address = $_POST['address'];
        $phone = $_POST['phone'];  
        $password = $_POST['pass'];
        if (isset($_POST['update'])) {
        $result = mysqli_query($con,"UPDATE customer SET Customer_Name='$name' , Customer_Phone='$phone' ,
          Customer_Address='$address' , Customer_Password='$password' WHERE CustomerID='$CustomerID'"); 
        
        if ($result) {
            $msg =  "Record updated successfully";
        } else {
            $msg =  "Error updating record: " . mysqli_error($con);
        }
        }
        $result = mysqli_query($con,"SELECT * FROM customer WHERE CustomerID='$CustomerID' ");  
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
                <li><a href="/ecomm/index.php" class="active">MY Profile  </a></li>  
                <li><a href="logout.php"> logout </a></li>
            
            </ul>
        </div>
        
        <div id="slinks">
        <a href="#"><img src="imges/images/fb.png" width="31" height="31" /></a>
        <a href="#"><img src="imges/images/tw.png" width="31" height="31" /></a>
        <a href="#"><img src="imges/images/yt.png" width="31" height="31" /></a>
        <a href="#"><img src="imges/images/rss.png" width="31" height="31" /></a>
        </div>
        
    </div>
    <div> 
         <span style="color: #FF0000; font-size:25px; float:left;"><?php echo $msg;?></span> 
    </div>
    <div align="center"> 
      <br><br><br><br> 
      <label class="labelname">Here you can update the information</label>        
      <br><br>    
      <?php  
      echo "<table border=\"4px solid black;\" style=\"width: 60%;border: 4px solid black;\">"; 
      echo "<form method=\"post\" name=\"update\">";
      echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Customer Name" . "</center></th>
      <td><center><input type=\"text\" name=\"namee\" value='".$arr['Customer_Name']."'></center></td></tr>";
      
      echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Customer Email" . "</center></th>
      <td><center><input type=\"text\" value=".$arr['Customer_Email']." readonly></center></td></tr>";
      
      echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Customer Address" . "</center></th>
      <td><center><input type=\"text\" name=\"address\" value='".$arr['Customer_Address']."'></center></td></tr>";
      
      echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Customer Phone" . "</center></th>
      <td><center><input type=\"text\" name=\"phone\" value='".$arr['Customer_Phone']."'></center></td></tr>";
      
      echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "Customer Password" . "</center></th>
      <td><center><input type=\"text\" name=\"pass\" value='".$arr['Customer_Password']."'></center></td></tr>";
      
      echo "<tr><th style=\"background-color: green; color: white;\"><center>" . "update" . "</center></th><td>
      <center><input type=\"submit\" style=\"background-color: green; color: white;\" name=\"update\" value=\"update\"></center></td></tr>"; 
      echo "</form>";
      echo "</table>";
     
   
      ?>
    </div>  
 
     

</div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
          <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
 