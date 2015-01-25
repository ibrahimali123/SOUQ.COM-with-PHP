<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Signup Page</title>
<link href="css/style2.css" rel="stylesheet" type="text/css" />
<link href="css/reset-min.css" rel="stylesheet" type="text/css" />
<link href="css/fonts-min.css" rel="stylesheet" type="text/css" />
</head>

<body>  
<?php       
    ob_start(); 
    if(isset($_POST['signup']))
    { 
        $name = $_POST['name']; 
        $address = $_POST['address'];
        $phone = $_POST['phone']; 
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $confirmPassword = $_POST['repass'];  
        
        $error = 0;
        $errorPassword = "";
        $errorspaces = "";
        if (empty($name) || empty($password) || empty($confirmPassword) || empty($email) || empty($phone) || empty($address)) {
            $errorspaces = "* Please fill the empty cills ";
            $error = 1;
        } 

        if ($password != $confirmPassword) {
            $errorPassword = '* error different passwords';
            $error = 1;
        } 

        $con=mysqli_connect("localhost","root","root","e_commerce"); 
        // Check connection
        if (mysqli_connect_errno()) {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        if(isset($_POST['signup']) && $error == 0 && !mysqli_connect_errno())
        {   
            $result = mysqli_query($con,"SELECT * FROM customer WHERE Customer_Email = '".$email ."'");
            $row = mysqli_fetch_array($result);
            if($row['Customer_Email'] != ""){
                $errorLogin = '*This email is already registered before';
            }
            else {        
            mysqli_query($con,"INSERT INTO customer (CustomerID,Customer_Name, Customer_Address, Customer_Phone,Customer_Email,Customer_Password)
                    VALUES (0,'$name', '$address','$phone','$email','$password')");                   
                  echo("<script>location.href = '/ecomm/index.php';</script>");  
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
	</div>
    
    <div class="clear"></div>
    <div>
         <span style="color: #FF0000; font-size:25px;"><?php echo $errorPassword;?></span>
         <span style="color: #FF0000; font-size:25px;"><?php echo $errorLogin;?></span>
         <span style="color: #FF0000; font-size:25px;"><?php echo $errorspaces;?></span>
    </div>
    <div id="sign">
    	<h1> it's free and any one can join </h1>
        <form id="ff" method="post" name="signup">
        	<h1>Name : </h1><input type="text" name="name"><br />
            <h1>Password : </h1> <input type="password" name="pass"><br />
            <h1>Confirm Password : </h1> <input type="password" name="repass"><br />
            <h1>Email : </h1> <input type="email" name="email"><br /> 
            <h1>Phone : </h1> <input type="text" name="phone"><br />
            <h1>Address : </h1> <input type="text" name="address"><br /> 
            <input type="submit" value="signup" name="signup">
        </form> 
    </div>
    
    <div class="clear"></div>
<!--------------------------------------------------------------------------------------------------> 
	<div id="fotter">
        <div id="vv">
    	<h1>All right reversed for <a href=""> FCI_CU.2014</a></h1>
        </div>
       
     </div>
</div>
</body>
</html>
