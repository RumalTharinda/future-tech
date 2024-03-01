<?php

session_start();
include '../System/function.php';
extract($_POST);
echo $qty;
echo $stock_id;

$db = dbconn();
$sql = "SELECT tbl_product.product_id,tbl_product.product_name,tbl_product.product_img,tbl_stock.stock_sale_price,tbl_stock.stock_discount FROM tbl_stock LEFT JOIN tbl_product ON tbl_product.product_id=tbl_stock.product_id WHERE tbl_stock.stock_id='$stock_id'";
$result = $db->query($sql);

$row = $result->fetch_assoc();
if ($result->num_rows > 0) {

    if (isset($_SESSION['cart'][$stock_id])) {
        $cqty = $_SESSION['cart'][$stock_id]['product_qty'] += $qty;
    } else {
        $cqty = $qty;
    }
    $_SESSION['cart'][$stock_id] = array('product_id' => $row['product_id'], 'product_name' => $row['product_name'], 'product_price' => $row['stock_sale_price'], 'product_discount' => $row['stock_discount'], 'product_img' => $row['product_img'], 'product_qty' => $cqty);
    print_r($_SESSION['cart']);
}

 header('Location:cart.php');

//session_destroy();
