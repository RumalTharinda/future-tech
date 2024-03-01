<?php

$user_role=$_SESSION['USERROLE'];
$menu="menu_$user_role".".php";

include $menu;