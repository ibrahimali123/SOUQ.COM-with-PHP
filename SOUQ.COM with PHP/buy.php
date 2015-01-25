<?php
 session_start(); 
 if (!isset($_SESSION['login_email'])) {
 	echo("<script>alert('Please if you do not have an account signup or login');</script>");
     echo("<script>location.href = '/ecomm/index.php';</script>"); 
 } 
?>