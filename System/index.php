<?php 
include 'header.php';
$user_role=$_SESSION['USERROLE'];
$menu="menu_$user_role".".php";
$dashboard="dashboard_$user_role".".php";
include $menu;
include $dashboard;
include 'footer.php';
?>


