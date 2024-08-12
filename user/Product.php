<?php require "part/head.php" ?>
<?php
require_once "../config.php"; // khởi tạo kết nối db
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : "";
$sql = "select * from sanpham where id_product = $product_id"; // câu truy vấn
$stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
$stmt->execute(); // truy vấn sql lấy dữ liệu về                            
$data = $stmt->fetchAll(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
?>

<div class="content-section">
  <?php foreach ($data as $row) : ?>
    <div class="product-detail">
      <div class="product-container">
        <div class="product-item">
          <img class="imge" id="imge" src="../admin/assets/upload/product/<?= $row['hinh_anh'] ?>" alt="<?= $row['name_product'] ?>" />
          <div class="item">
            <img class="slider-img active" src="../admin/assets/upload/product/<?= $row['hinh_anh'] ?>" alt="<?= $row['name_product'] ?>" />
            <img class="slider-img" src="../admin/assets/upload/product/<?= $row['hinh_anh'] ?>" alt="<?= $row['name_product'] ?>" />
            <img class="slider-img" src="../admin/assets/upload/product/<?= $row['hinh_anh'] ?>" alt="<?= $row['name_product'] ?>" />
            <img class="slider-img" src="../admin/assets/upload/product/<?= $row['hinh_anh'] ?>" alt="<?= $row['name_product'] ?>" />
          </div>
        </div>
        <div class="product-item">
          <div class="name">
            <h1><?= $row['name_product'] ?></h1>
          </div>
          <div class="status">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            |
            <p>Còn hàng</p>
          </div>
          <div class="prince">
            <p><?= $row['gia'] ?>₫</p>
          </div>
          <div class="color">
            <p>Màu</p>
            <button>
              <img src="assets/img-figma/color1.png" alt="" />
            </button>
            <button>
              <img src="assets/img-figma/color2.png" alt="" />
            </button>
          </div>
          <div class="buy">
            <div class="quantity">
              <div class="minus">-</div>
              <div class="a-quantity">
                <p>01</p>
              </div>
              <div class="add">+</div>
            </div>
            <a href="./Cart.php?id=<?= $row['id_product'] ?>">
              <div class="add-cart">
                <div id="overlay" onclick="off_overlay()">
                  <div id="text">
                    <i class="fa-sharp fa-solid fa-circle-check check"></i>
                    <p>Thêm sản phẩm thành công</p>
                  </div>
                </div>
                <p onclick="on_overlay()">THÊM VÀO GIỎ HÀNG</p>
              </div>
            </a>
            <div class="buy-now">
              <a href="./Checkout.php">MUA NGAY</a>
            </div>
          </div>
          <hr />
          <div class="ship">
            <p>
              <i class="fa-solid fa-angles-right"></i>BẢO HÀNH SẢN PHẨM 90
              NGÀY
            </p>
            <p>
              <i class="fa-solid fa-angles-right"></i>ĐỔI HÀNG TRONG VÒNG 30
              NGÀY
            </p>
            <p>
              <i class="fa-solid fa-angles-right"></i>HOTLINE BÁN HÀNG 1900
              633 501
            </p>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<!-- Chi tiết sản phẩm -->
<?php foreach ($data as $row) : ?>
  <div class="content-section">
    <div class="container">
      <div class="content-section-heading">
        <hr class="line" align="center" />
        <h2>Chi tiết sản phẩm</h2>
        <hr class="line-2" align="right" />
      </div>
      <div class="content-detail">
        <strong>Chi tiết sản phẩm</strong>
        <p><?= $row['name_product'] ?></p>
        <?= $row['des_product'] ?>
        <!-- <p>
          Hàng chuẩn <strong>NEWSEVEN</strong> sản xuất, tem mác chuẩn chính
          hãng.
        </p>
        <strong>Chất liệu: Vải Dệt Lông</strong>
        <ul>
          <li>
            Vải mềm mại và ấm áp nhờ mặt trong vải được phủ một lớp lông tơ
            ngắn, nên bề mặt vải vô cùng mềm mại, mịn màng.
          </li>
          <li>Vải ít nhăn, ít bám bẩn.</li>
          <li>Bề mặt vải dai co giãn, khó bị xước.</li>
        </ul>
        <strong>Kiểu dáng áo Jacket Fur Coats</strong>
        <ul>
          <li>Đường may chuẩn chỉnh, tỉ mỉ, chắc chắn.</li>
          <li>
            Mặc ở nhà, mặc đi chơi hoặc khi vận động thể thao. Phù hợp khi
            mix đồ với nhiều loại.
          </li>
          <li>Thiết kế hiện đại, trẻ trung, năng động. Dễ phối đồ.</li>
        </ul>
        <p>
          <strong>NEWSEVEN</strong> mang đến sản phẩm
          <strong>Jacket Fur Coats</strong> với 1 bản phối màu: Đen
        </p> -->
        <div class="image-detail">
          <img src="assets/img-figma/sp14.jpg" alt="" />
          <img src="assets/img-figma/sp15.jpg" alt="" />
          <img src="assets/img-figma/sp16.jpg" alt="" />
        </div>
        <strong>Hướng dẫn sử dụng sản phẩm <?= $row['name_product'] ?>:</strong>
        <ul>
          <li>Không giặt máy trong 10 ngày đầu</li>
          <li>
            Không nên sấy và sử dụng chất tẩy, lộn ngược khi giặt để áo bền
            hơn
          </li>
          <li>
            Nên giặt với nước lạnh dưới 40 độ và tuyệt đối không nên giặt
            với nước nóng sẽ làm co giãn sợi vải.
          </li>
          <li>
            Khi phơi lộn trái và không phơi trực tiếp dưới ánh nắng mặt trời
          </li>
        </ul>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Thông số sp -->
<div class="content-section">
  <div class="container">
    <div class="content-section-heading">
      <hr class="line" align="center" />
      <h2>Thông số sản phẩm</h2>
      <hr class="line-2" align="right" />
    </div>
    <div class="parameter">
      <img src="assets/img-figma/thông số ct.jpg" alt="" />
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
      <div class="card-wrapper swiper-wrapper" id="card-wrapperr">

        <!-- Show dữ liệu -->
        <?php
        $sql = "select * from sanpham"; // câu truy vấn
        $stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
        $stmt->execute(); // truy vấn sql lấy dữ liệu về                            
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
        ?>
        <?php foreach ($data as $row) : ?>
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
    <!-- <div class="swiper-pagination"></div> -->
  </div>
</div>
<?php require "part/foot.php" ?>