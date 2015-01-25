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
<title>Add Product</title>
<link href="css/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="css/reset-min.css" rel="stylesheet" type="text/css" />
<link href="css/myProfile.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  .contain { width:500px; margin:0 auto; border:2px green dashed; margin-top:15px; min-height:200px; padding:10px; }
  input { font-size:15px; color:#06C; padding:10px; width:200px; margin-top:25px;   }
  select { font-size:15px; color:#06C; padding:10px; width:200px; margin-top:25px;   }
  .labelname { font-size:20px; font-weight:bold; font-family:Tahoma, Geneva, sans-serif; color:#33C; padding:10px; } 
  #submit { width:100px; height:30px; padding:2px; background-color:#999;}        
  </style>
</head>

<body>
<?php 
    ob_start(); 
      $con = mysqli_connect("localhost","root","root","e_commerce");
      
      // get file and save it's info
      
      $file = $_FILES['Image']['tmp_name'];
      $msg = "";
      if(isset($_POST['product']))
      {
          $Img = addslashes(file_get_contents($_FILES['Image']['tmp_name']));
          $Img_name = addslashes($_FILES['Image']['name']);
          $Img_size = getimagesize($_FILES['Image']['tmp_name']);
          $name = $_POST['Product_Name'];
          $Product_Description = $_POST['Product_Description'];
          $Product_Quant_InStock = $_POST['Product_Quant_InStock'];
          $Product_Prise = $_POST['Product_Prise'];
          $Product_Category = $_POST['Product_Category'];
          $Product_Sub_Category = $_POST['Product_Sub_Category']; 

          $insert = mysqli_query($con ,"INSERT INTO product (ProductID , Product_Name , Product_Description,Product_Quant_InStock,Product_Prise,Product_Category,Product_Sub_Category,Product_Picture)
              VALUES(0, '$name','$Product_Description','$Product_Quant_InStock','$Product_Prise','$Product_Category','$Product_Sub_Category', '$Img')" ); 
          if(!$insert)
              $msg = "Error uploading image";
            
          else
          {
              $msg = "Product upload successfully ";
              
          } 
          
        } 
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
    <div> 
         <span style="color: #FF0000; font-size:25px; float:left;"><?php echo $msg;?></span> 
    </div>
<!---------------------------------------------------------------------------------------->
<div class="clear"></div>
<!------------------------------------------slider--------------------------------------->
    
<!----------------------------------------------------------------------------------------->

<!---------------------------------------------------------------------------------------->
           
          <div align="center" id="product" class="contain">
            <table cellpadding="5">
                    <form name="product" method="post" enctype="multipart/form-data"> 
                     <tr> <td><label for="name" class="labelname"> Product Name:</label></td>  <td> <input type="text" name="Product_Name" required></td>  </tr>
                     <!-- <tr> <td>Image:</td>  <td></td>  </tr> -->
                     <tr> <td><label for="name" class="labelname"> Product image:</label></td> <td><input type="file" name="Image"></td>
                     </tr> 
                      <tr> 
                      <td><label for="name" class="labelname"> Category:</label></td> 
                          <td>
                          <select name="Product_Category" required = "TRUE" >
                            <option selected  >Select Category</option> 
                            <option value="Mobiles">Mobiles</option>
                            <option value="Labtops">Labtops</option> 
                          </select>
                        
                          </td> 
                      </tr> 
                      
                     <tr>
                      <td> <label for="name" class="labelname"> Product Description</label></td>  <td><textarea rows="4" cols="23" name="Product_Description"></textarea></td> 
                       </tr> 
                     <tr>
                          <td><label for="name" class="labelname"> Product Quant </label></td><td><input name="Product_Quant_InStock" type="text"  required="required"></td>
                     </tr>
                     <tr>
                          <td><label for="name" class="labelname"> Product Price </label></td><td><input name="Product_Prise" type="text"  required="required"></td>
                     </tr> 
                     <tr> 
                     <td><label for="name" class="labelname"> Product SubCategory</label></td> 
                         <td>
                         <select name="Product_Sub_Category" required = "TRUE" >
                           <option selected  >Select Sub Category</option> 
                           <option value="hp">hp</option>
                           <option value="samsong">samsong</option> 
                           <option value="nokia">nokia</option> 
                           <option value="lenovo">lenovo</option> 
                           <option value="dell">dell</option> 
                           <option value="htc">htc</option> 
                         </select>
                       
                         </td> 
                     </tr>
                     <tr> <td colspan="2"><center><input type="submit" id="product" value="submit" name="product"></center></td></tr>
                    </form>
            </table>
          </div> 
        <br>
          
    
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
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
          <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
 