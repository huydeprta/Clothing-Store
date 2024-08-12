<?php require "part/head.php" ?>

<!-- Brand section -->
<div class="content-section">
  <div class="container">
    <div class="section-brand">
      <div class="col-left">
        <div class="content-section-heading">
          <hr class="line" align="left" style="width: 30%" />
          <h2>About our Brand</h2>
          <hr class="line-2" align="right" style="width: 30%" />
        </div>
        <p>
          ThaiHuy Shop hướng đến sứ mệnh trở thành một local brand với các sản phẩm
          chất lượng tốt và giá thành "dễ chịu" với mọi người.
        </p>
        <img src="assets/img-figma/brand1.jpg" alt="brand" class="brand-1" />
      </div>
      <div class="col-right">
        <img src="assets/img-figma/brand2.jpg" alt="brand" class="brand-2" />
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
        require_once "../config.php"; // khởi tạo kết nối db
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