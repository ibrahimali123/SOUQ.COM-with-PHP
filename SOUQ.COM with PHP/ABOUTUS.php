<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BUY PAGE</title>

<link href="css/fonts-min.css" rel="stylesheet" type="text/css" />
<link href="css/reset-min.css" rel="stylesheet" type="text/css" />
<link href="css/style3.css" rel="stylesheet" type="text/css" />

<!--[if lte IE 8]>
 			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<link href='http://fonts.googleapis.com/css?family=Antic+Slab' rel='stylesheet' type='text/css'>
		
		<!-- Use jQuery for best compatibility with other CSS3 enabled browsers -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		
		<script src="js/flux.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript" charset="utf-8">
			$(function(){
				if(!flux.browser.supportsTransitions)
					alert("Flux Slider requires a browser that supports CSS3 transitions");
					
				window.f = new flux.slider('#slider', {
					pagination: false,
					controls: false,
					transitions: ['explode', 'tiles3d', 'bars3d', 'cube', 'turn'],
					autoplay: true
				});
				
				$('.transitions').click(function(event){
					event.preventDefault();
					window.f.next($(event.target).data('transition'), $(event.target).data('params'));
				});
			});
		</script>


</head>

<body>
<?php  
  ob_start(); 
  if (isset($_POST['login'])) 
  {
      $error = 0; 
      $errorLogin = "";
      $login_email = $_POST['login_email'];
      $login_pass = $_POST['login_pass']; 
      
      $con=mysqli_connect("localhost","root","root","e_commerce"); 
      
      // Check connection
      if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
      } 
      
      if(isset($_POST['login']) && $error == 0 && !mysqli_connect_errno())
      {
          $type = "";

          $result1 = mysqli_query($con,"SELECT Customer_Password FROM customer
                      WHERE Customer_Email='$login_email'"); 
          $row1 = mysqli_fetch_array($result1);

          $result2 = mysqli_query($con,"SELECT Admin_Password FROM admin
                      WHERE Admin_Email='$login_email'"); 
          
          $row2 = mysqli_fetch_array($result2);

          if ($row1['Customer_Password'] == "") {
              $type = "admin";
          }
          else if ($row2['Admin_Password'] == "") {
              $type = "customer";
          }

          if ( $type == "customer") {
              if($row1['Customer_Password'] == $login_pass){       
                  $_SESSION['login_email']=$login_email;

                  $result = mysqli_query($con,"SELECT CustomerID FROM customer
                              WHERE Customer_Email='$login_email'"); 
                  $row = mysqli_fetch_array($result);
                  $_SESSION['type'] = $type;
                  $_SESSION['CustomerID'] = $row['CustomerID'];               
                  echo("<script>location.href = '/ecomm/customerProfile.php';</script>");             
              }
              else {
                  $errorLogin = '*error Login';
              }
          }
          else if ( $type == "admin") {
              if($row2['Admin_Password'] == $login_pass){       
                  $_SESSION['login_email']=$login_email;

                  $result = mysqli_query($con,"SELECT AdminID FROM admin
                              WHERE Admin_Email='$login_email'"); 
                  $row = mysqli_fetch_array($result);
                  $_SESSION['type'] = $type;
                  $_SESSION['AdminID'] = $row['CustomerID'];               
                  echo("<script>location.href = '/ecomm/adminProfile.php';</script>");             
              }
              else {
                  $errorLogin = '*error Login';
              }
          }
      }
          
     mysqli_close($con);
  }

  ob_end_flush();
/* @var $PHP_SELF type <?php ech $PHP_SELF ?> */
?>
<div id="wrapper">

	<div id="header">
    
		<div id="logo"> 
        	<img src="imges/images/logo_03.png" width="225" height="96" />
        </div>
        
		<div id="login">
        	<form  id="ss" method="post" name="login">
                    <input type="email" name="login_email" required>
                    <input type="password" name="login_pass" required>
                    <input type="submit" value="login" name="login">                
            </form> 
            <form id="w">
           		<a href="/ecomm/Sign_up.php" ><input type="button" value="signup" /> </a>
            </form>
         </div>
         
 	</div>
 <!-------------------------------------------------------------------------------------->
 <div class="clear"></div>
 <!-------------------------------------menue-------------------------------------------->
 	<div id="headerr">
 		<div id="menu">
    		<ul>
         	 	<li> <a href="/ecomm/index.php"> Home </a> </li>
            	<li><a href="/ecomm/ABOUTUS.php" class="active">About us</a></li> 
            
        	</ul>
    	</div>
        
        <div id="slinks">
        <a href="#"><img src="imges/images/fb.png" width="31" height="31" /></a>
        <a href="#"><img src="imges/images/tw.png" width="31" height="31" /></a>
        <a href="#"><img src="imges/images/yt.png" width="31" height="31" /></a>
        <a href="#"><img src="imges/images/rss.png" width="31" height="31" /></a>
        </div>
        
    </div>
<!---------------------------------------------------------------------------------------->
<div class="clear"></div>
<!------------------------------------------slider---------------------------------------->
	<div id="slider"> 
    	<img src="imges/images/banner_1.jpg" width="1100" height="511" />
        <img src="imges/images/banner_2.jpg" width="1200" height="511" />
        <img src="imges/images/banner_3.jpg" width="1200" height="511" />
    </div>
	
    <div class="clear"></div>
    
    <div id="welcome"><h1>Welcome in BUY.COM for easy SHoping </h1></div>
    
    
    <div class="clear"></div>
    
    <div id="BUY">
    	
    	<p> 
         this is a project in fci 2014
        </p>
        
        
        
    </div>
    
    <div class="clear"></div>
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
</div>


<body>
</body>
</html>
