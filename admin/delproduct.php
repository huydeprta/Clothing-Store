<?php 
    include"../config.php";
    $id=$_GET['id'];
    // $idcate=$_GET['Id_categories'];
    $sql="delete from sanpham where id_product = $id";
    $dat = $conn->query($sql);;
    $conn = null;
    header("location:product.php");
?>