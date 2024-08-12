<?php include("./parts/header.php") ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->

  <div class="form-detail">
    <?php

    include "../config.php"; // khởi tạo kết nối db
    if (!$_SESSION['login']) {
      header("location: ../admin/login.php");
      echo '<meta http-equiv="refresh" content="0; url= ../admin/login.php">';
    }

    $sql = "select * from hoadon inner join hoadonchitiet on hoadon.id_hoadon =  hoadonchitiet.id_hoadon"; // câu truy vấn
    $stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
    $stmt->execute(); // truy vấn sql lấy dữ liệu về                            
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
    ?>
    <h2>Đơn hàng</h2>
    <div class="form-detail">
      <table>
        <tr>
          <th>ID đơn hàng</th>
          <th>Id khách hàng</th>
          <th>Ngày mua</th>
          <th>ID sản phẩm</th>
          <th>Số lượng</th>
          <th>Giá</th>
        </tr>
        <?php foreach ($data as $row) : ?>
          <tr>
            <td><?php echo $row['id_hoadon'] ?></td>
            <td><?php echo $row['id_user'] ?></td>
            <td><?php echo $row['ngay_mua'] ?></td>
            <td><?php echo $row['id_product'] ?></td>
            <td><?php echo $row['so_luong_ban'] ?></td>
            <td><?php echo $row['total'] ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

  <!-- </div>   -->

  <?php include("./parts/footer.php") ?>