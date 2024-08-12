<?php
require "../config.php";
require "part/head.php";
if (isset($_GET['id'])) {
  $product_id = (int)$_GET['id'];
  $sql = "SELECT * FROM sanpham WHERE id_product = :product_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  $qty =  1;

  if (isset($_SESSION['cart']['buy']) && array_key_exists($product_id, $_SESSION['cart']['buy'])) {
    $qty = $_SESSION['cart']['buy'][$product_id]['qty'] + 1;
  }
  $_SESSION['cart']['buy'][$product_id] = array(
    'id' => $product_id,
    'name' => $data['name_product'],
    'product_category' => $data['id_cate'],
    'description' =>  $data['des_product'],
    'price' =>  $data['gia'],
    'image' =>  $data['hinh_anh'],
    'qty' => $qty,
    'sub_total' => $qty * $data['gia'],
  );
  foreach ($_SESSION['cart']['buy'] as &$item) {
    $item['deleteCart'] = "Cart.php?del&id_del={$item['id']}";
  }
  unset($item);
  updateInfoCart();
}

function updateInfoCart()
{
  if (empty($_SESSION['cart'])) return false;
  $num_order = 0;
  $total = 0;
  foreach ($_SESSION['cart']['buy'] as $item) {
    $num_order += $item['qty'];
    $total += $item['sub_total'];
  };
  $_SESSION['cart']['info'] = array(
    'num_order' => $num_order,
    'total' => $total
  );
}
if (isset($_GET['id_del'])) {
  $id = $_GET['id_del'];
  unset($_SESSION['cart']['buy'][$id]);
  updateInfoCart();
  header("Location: Cart.php");
}
function getTotalCart()
{
  if (empty($_SESSION['cart'])) return false;
  return $_SESSION['cart']['info']['total'];
}
?>

<!-- Cart -->
<div class="content-section">
  <div class="product-detail">
    <div class="product-container">
      <div class="cart-product">
        <p class="title">Giỏ hàng</p>
        <div class="cart-detail">
          <table>
            <thead>
              <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart']['buy'] as $item) {
              ?>
                  <tr>
                    <td><?php echo $item['name'] ?></td>
                    <td><?php echo $item['qty'] ?></td>
                    <td><?php echo $item['price'] ?></td>
                    <td><a href="<?php echo $item['deleteCart'] ?>">Xoá</a></td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="my-cart">
        <a href="./index.php" class="title">Tiếp tục mua hàng</a>
        <div class="my-cart-detail">
          <p>Thông tin giỏ hàng</p>
        </div>
        <div class="my-cart-container">
          <div class="cart-content">
            <div class="cart-prince">
              <p>Tổng tiền sản phẩm</p>
              <?php if (!empty($_SESSION['cart'])) : ?>
                <p><?= getTotalCart() ?></p>₫
              <?php endif; ?>
            </div>
            <div class="cart-discount">
              <p>Giảm giá</p>
              <p>0 ₫</p>
            </div>
            <hr />
            <div class="cart-code-discount">
              <input type="text" placeholder="Nhập mã giảm giá" />
              <button>ÁP DỤNG</button>
            </div>
            <hr />
            <div class="cart-total">
              <p>Tổng thanh toán</p>
              <?php if (!empty($_SESSION['cart'])) : ?>
                <p><?= getTotalCart() ?></p>₫
              <?php endif; ?>
            </div>
          </div>
          <?php
          if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
            <div class="btn-oder">
              <a href="./Checkout.php">ĐẶT HÀNG NGAY</a>
            </div>
          <?php } else { ?>
            <div class="btn-oder">
              <a onclick="hi()">ĐẶT HÀNG NGAY</a>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

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
          <a href="./Product.php?id=<?= $row['id_product'] ?>">
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
                    <a name="addCart" class="addCart" href="./Cart.php?id=<?= $row['id_product'] ?>"><i class="fa-solid fa-cart-plus"></i></a>
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