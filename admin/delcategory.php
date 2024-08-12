<?php 
    include"../config.php";
    $id=$_GET['id'];
    $sql="delete from danhmuc where id_cate = $id";
    $dat = $conn->query($sql);;
    $conn = null;
    header("location:category.php");
?>