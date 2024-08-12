<?php include "./part/head.php" ?>

<?php
require "../config.php"; // khởi tạo kết nối db
if (!$_SESSION['login']) {
  header("location: ../admin/login.php");
  echo '<meta http-equiv="refresh" content="0; url= ../admin/login.php">';
}

if (isset($_GET["action"]) == true) {
  $action = $_GET["action"];
  switch ($action) {
    case 'addCart':
      // Xử lý dữ liệu gửi lên
      if (isset($_POST['name'])) {
        $id = $_POST['id'];
        $namepro = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['img'];
        $qty = 1;
        echo $id;
        // Kiểm tra và cập nhật số lượng sản phẩm trong giỏ hàng
        $fg = 0;
        $i = 0;
        $_SESSION['cart'];
        if (isset($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $item) {
            if ($item[1] == $namepro) {
              $qtyNew = $qty + $item[4];
              $_SESSION['cart'][$i][4] = $qtyNew;
              $fg = 1;
              break;
            }
            $i++;
          }
        }
        // Thêm sản phẩm mới vào giỏ hàng
        if ($fg == 0) {
          $item = array($id, $namepro, $price, $image, $qty);
          $_SESSION['cart'][] = $item;
          var_dump($_SESSION['cart']);
        }
      }
      // unset($_SESSION['cart']);
      var_dump($_SESSION['cart']);
      echo '<script>location.href = ".../Cart.php";</script>';
      break;
    case 'delCart':
      if (isset($_GET['i']) && isset($_SESSION['cart'])) {
        array_splice($_SESSION['cart'], $_GET['i'], 1);
      } else {
        if (isset($_SESSION['cart']))
          unset($_SESSION['cart']);
      }
      echo '<script>location.href = ".../Cart.php";</script>';
      break;
    default:
      echo '<script>location.href = ".../Shop.php";</script>';
      break;
  }
}
?>

<div class="banner">
  <div class="row fade">
    <div>
      <img src="https://scontent.fsgn2-6.fna.fbcdn.net/v/t39.30808-6/306153007_2899105087060190_4062705450278836625_n.jpg?_nc_cat=111&cb=99be929b-3346023f&ccb=1-7&_nc_sid=e3f864&_nc_ohc=oFDBlpJgd3gAX-CWvB4&_nc_oc=AQkgOUYF6RbOG8QsFN7bWSa9uM92-fZZhtZ-1mx4SDdWBTPp_LfWVBdIUL87jA03BeyI21k2Lk7H668OplOXR5W3&_nc_ht=scontent.fsgn2-6.fna&oh=00_AfADMvo32We1hJOOWcNBuE750_c-FvqaNdwD9aeUPUpqGw&oe=64D42727" alt="" />
    </div>
    <div>
      <img class="imge" src="https://down-ws-vn.img.susercontent.com/vn-11134210-7qukw-lfql7t7tgghhce.webp" alt="" />
    </div>
  </div>
</div>

<!-- List section -->
<div class="list-section">
  <div class="container">
    <div class="list-heading">
      <hr class="line" align="center" />
      <h2>Prouct Categories</h2>
      <hr class="line-2" align="right" />
    </div>
    <div class="list-container">
      <div class="list-card" id="product">
        <img src="assets/img-figma/list1.jpg" alt="" class="list-card-img" />
        <a>TOPS<i class="fa-sharp fa-solid fa-arrow-right"></i></a>
      </div>
      <div class="list-card" id="product">
        <img src="assets/img-figma/list2.jpg" alt="" class="list-card-img" />
        <a>BOTTOMS<i class="fa-sharp fa-solid fa-arrow-right"></i></a>
      </div>
      <div class="list-card" id="product">
        <img src="assets/img-figma/list3.jpg" alt="" class="list-card-img" />
        <a>ACCESSORIES<i class="fa-sharp fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</div>
<!-- New Arrial section -->
<div class="content-section">
  <div class="container swiper">
    <div class="content-section-heading">
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

<!-- New Casual Collection 2023 section -->
<div class="content-section">
  <div class="container swiper">
    <div class="content-section-heading">
    </div>
    <div class="slide-container-1">
      <div class="card-wrapper swiper-wrapper" id="card-wrapperr">


        <!-- Show dữ liệu -->
        <?php
        $sql = "select * from sanpham ORDER by gia "; // câu truy vấn
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
      <div class="next-navBtn">
        <i class="fa-solid fa-chevron-right"></i>
      </div>
      <div class="pre-navBtn">
        <i class="fa-solid fa-chevron-left"></i>
      </div>
      <!-- <div class="swiper-pagination"></div> -->
    </div>
  </div>
</div>

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


<?php require "part/foot.php" ?>