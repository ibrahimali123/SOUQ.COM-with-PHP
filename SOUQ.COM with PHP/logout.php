<?php
session_start();
if(session_destroy())
{
  echo("<script>location.href = '/ecomm/index.php';</script>");
}
?>