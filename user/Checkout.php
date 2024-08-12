<?php require "part/head.php" ?>
<?php
require_once "../config.php"; // khởi tạo kết nối db
?>
<?php
$id = $_SESSION['idkh'];
$sql = "select * from khachhang where id_user = $id"; // câu truy vấn
$stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
$stmt->execute(); // truy vấn sql lấy dữ liệu về
$data = $stmt->fetch(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu


function getTotalCart()
{
  if (empty($_SESSION['cart'])) return false;
  return $_SESSION['cart']['info']['total'];
}
?>
<!-- Cart -->

<form action="" method="post" name="pttt">
  <div class="content-section">
    <div class="product-detail">
      <div class="product-container">
        <div class="cart-product">
          <p class="title">Thanh toán</p>
          <div class="cart-detail">
            <p>Địa chỉ giao hàng</p>
            <label for="">Họ và tên: </label>
            <div class="name-phone">
              <input type="read" placeholder="Họ và tên" readonly value="<?php echo $data['name_user'] ?>" />
            </div>
            <label for="">Số điện thoại: </label>
            <div class="name-phone">
              <input type="text" placeholder="Số điện thoại" readonly value="<?php echo $data['phone'] ?>" />
            </div>
            <label for="">Email: </label>
            <input type="text" placeholder="Email" readonly value="<?php echo $data['email'] ?>" />
            <label for="">Địa chỉ: </label>
            <input type="text" placeholder="Địa chỉ" readonly value="<?php echo $data['adress'] ?>" />

            <p>Phương thức thanh toán</p>
            <div class="name-phoney">
              <select class="name-phoney" name="select" id="">
                <option value="">Chọn phương thức thanh toán</option>
                <option name="ck" value="Thanh toán Chuyển khoản">Thanh toán Chuyển khoản</option>
                <option name="tm" value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
              </select>
            </div>
            <div class="a-textarea">
              <textarea placeholder="Ghi chú cho đơn hàng ..." cols="30" rows="2"></textarea>
            </div>
          </div>
        </div>
        <div class="my-cart">
          <a href="./index.php" class="title">Tiếp tục mua hàng</a>
          <div class="my-cart-detail">
            <p>Thông tin giỏ hàng</p>
          </div>
          <div class="my-cart-container">
            <div class="cart-content">
              <?php if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart']['buy'] as $item) {
              ?>
                  <p>Tên sản phẩm: <?php echo $item['name'] ?></p>
                  <p>Số lượng: <?php echo $item['qty'] ?></p>
              <?php }
              } ?>
              <hr />
              <div class="cart-discount">
                <p>Tạm tính</p>
                <p>
                  <?php if (!empty($_SESSION['cart'])) : ?>
                <p><?= getTotalCart() ?></p>₫
              <?php endif; ?>
              </div>
              <div class="cart-prince">
                <p>Phí vận chuyển</p>
                <p>0 ₫</p>
              </div>
              <div class="cart-total">
                <p>Tổng thanh toán</p>
                <p>
                  <?php if (!empty($_SESSION['cart'])) : ?>
                <p><?= getTotalCart() ?></p>₫
              <?php endif; ?>
              </p>
              </div>
            </div>
            <div class="btn-oder">
              <button type="submit" name="submit">TIẾN HÀNH THANH TOÁN</button>
            </div>
</form>
<?php if (isset($_POST['submit'])) {
  $id = $data['id_user'];
  $date = date('Y-m-d');
  $selectedOption = $_POST['select'];
  $listCart = $_SESSION['cart']['buy'];
  $sql = "INSERT INTO `hoadon`(`id_user`, `ngay_mua`, `trang_thai`) VALUES ('$id','$date','$selectedOption')";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $last_id = $conn->lastInsertId();
  $sql = "select * from hoadon"; // câu truy vấn
  $stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
  $stmt->execute(); // truy vấn sql lấy dữ liệu về                            
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
  $data = end($data);
  $id_order = $data['id_hoadon'];
  foreach ($_SESSION['cart']['buy'] as $item) {
    $id_product = $item['id'];
    $quantity = $item['qty'];
    $total = $item['qty'] * $item['price'];
    $sql = "INSERT INTO `hoadonchitiet`(`id_hoadon`, `id_product`, `so_luong_ban`, `total`, `ghi_chu`) 
    VALUES ('$id_order','$id_product','$quantity','$total','')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $last_id = $conn->lastInsertId();
  }
  unset($_SESSION['cart']);
  echo '<script>location.href = "./index.php";</script>';
?>
<?php
}?>
</div>
</div>
</div>
</div>
</div>
</form>

<!-- Gợi ý sản phẩm -->
<div class="content-section">
  <div class="container swiper">
    <div class="content-section-heading">
      <hr class="line" align="center" />
      <h2>Gợi ý sản phẩm</h2>
      <hr class="line-2" align="right" />
    </div>
    <div class="slide-container">
      <div class="card-wrapper swiper-wrapper">

        <!-- Show dữ liệu -->
        <?php
        $sql = "select * from sanpham"; // câu truy vấn
        $sth = $conn->query($sql); // truy vấn sql lấy dữ liệu về
        $row = $sth->fetch(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
        ?>
        <?php foreach ($sth as $row) : ?>
          <a href="./Product.php?details&id=<?= $row['id_product'] ?>">
            <div class="card swiper-slide">
              <div class="image-box">
                <img src="../admin/assets/upload/product/<?php echo $row['hinh_anh'] ?>" alt="" />
              </div>
              <div class="product-content">
                <div class="product-info">
                  <a href="">
                    <?php echo $row['name_product'] ?>
                  </a>
                  <p>
                    <?php echo $row['gia'] ?> <span>₫</span>
                    <a href="./Cart.php?id=<?= $row['id_product'] ?>"><i class="fa-sharp fa-solid fa-cart-shopping"></i></a>
                  </p>
                </div>
              </div>
            </div>
          </a>
        <?php endforeach; ?>

      </div>
    </div>
    <div class="next-navBtnn">
      <i class="fa-solid fa-chevron-right"></i>
    </div>
    <div class="pre-navBtnn">
      <i class="fa-solid fa-chevron-left"></i>
    </div>
  </div>
</div>
<?php require "part/foot.php" ?>




















