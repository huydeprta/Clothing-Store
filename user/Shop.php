<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>T-shirt</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans&family=Quicksand:wght@600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
    <div class="main">
        <div class="header">
            <div class="header-left">
                <ul class="menu">
                    <div class="logo">
                        <img src="assets/img-figma/Logo.png" alt="" />
                        <i class="fa-solid fa-xmark" onclick="document.querySelector('.menu').classList.toggle('active')"></i>
                    </div>
                    <li><a href="./index.php">HOME</a></li>
                    <li><a href="./Shop.php">SHOP</a></li>
                    <li><a href="./About.php">ABOUT US</a></li>
                    <li><a href="./Contact.php">CONTACT</a></li>
                </ul>
                <div class="toggleMenu" onclick="document.querySelector('.menu').classList.toggle('active')">
                    <i class="fa-sharp fa-solid fa-list-ul"></i>
                </div>
            </div>
            <div class="header-center">
                <a href="./index.php"><img src="assets/img-figma/Logo.png" alt="logo" /></a>
            </div>
            <div class="header-right">
                <i class="fa-solid fa-magnifying-glass"></i>
                <a href="./Cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <ul class="menu">
                    <li>
                        <a href="#"><i class="fa-solid fa-user"></i></a>
                        <ul class="sub-menu">
                            <li><a href="#!"> <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    <?php echo $_SESSION['dangki'] ?>
                                </a></li>
                            <li><a href="/assm/admin/logout.php"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>


        <div class="content-section pt-3" style="border-top: 1px solid #ccc;">
            <div class="container">

                <div class="row mb-5">
                    <div class="col-md-9 order-2">

                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <div class="float-md-left mb-4">
                                    <h2 class="text-black h5">Shop All</h2>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Lọc</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                            <a class="dropdown-item" href="#">Tên, A to Z</a>
                                            <a class="dropdown-item" href="#">Tên, Z to A</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Giá, Thấp tới Cao</a>
                                            <a class="dropdown-item" href="#">Giá, Cao tới Thấp</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <!-- Show dữ liệu -->
                            <?php
                            include "../config.php";
                            $sql = "select * from sanpham"; // câu truy vấn
                            $stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
                            $stmt->execute(); // truy vấn sql lấy dữ liệu về                            
                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
                            ?>
                            <?php foreach ($data as $row) : ?>
                                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                    <div name="add-to-cart-form" class="add-to-cart-form">
                                        <div class="block-4 text-center border">
                                            <figure class="block-4-image">
                                                <a href="./Product.php?details&id=<?= $row['id_product'] ?>"><img src=" ../admin/assets/upload/product/<?php echo $row['hinh_anh'] ?>" alt="Image placeholder" class="img-fluid"></a>
                                            </figure>
                                            <div class="block-4-text p-4">
                                                <h3><a href="">
                                                        <?php echo $row['name_product']; ?>
                                                    </a></h3>
                                            </div>
                                            <div class="block-4-text d-flex justify-content-center align-items-center mb-3">
                                                <span class="text-primary font-weight-bold mr-3 ">
                                                    <?php echo $row['gia']; ?>
                                                </span>
                                                <a name="addCart" class="addCart" href="./Cart.php?id=<?= $row['id_product'] ?>"><i class="fa-solid fa-cart-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="col-md-3 order-1 mb-5 mb-md-0 mt-5">
                            <div class="border p-4 rounded mb-4 mt-5">
                                <h3 class="mb-3 h6 text-uppercase text-black d-block">Loại</h3>
                                <ul class="list-unstyled mb-0">
                                    <?php
                                    $sql = "select *, COUNT(sanpham.id_product) as total, danhmuc.name_cate as namecate from danhmuc 
                                                INNER JOIN sanpham ON danhmuc.id_cate = sanpham.id_cate GROUP by danhmuc.id_cate"; // câu truy vấn
                                    $stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
                                    $stmt->execute(); // truy vấn sql lấy dữ liệu về                            
                                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
                                    ?>
                                    <?php foreach ($data as $row) : ?>
                                        <li class="mb-1"><a href="" class="d-flex"><span>
                                                    <?php echo $row['name_cate']; ?>
                                                </span> <span class="text-black ml-auto">(
                                                    <?php echo $row['total']; ?>)
                                                </span></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <div class="footer">
            <div class="container" style="padding: 0 !important">
                <div class="footer-top">
                    <div class="row-col4">
                        <div class="row-logo">
                            <img src="assets/img-figma/Logo.png" alt="logo" />
                            <h2>ThaiHuy Shop</h2>
                        </div>
                        <p>Đăng ký nhận tin khuyến mãi</p>
                        <div class="row-email">
                            <input type="email" placeholder="Email" />
                            <input type="text" value="SEND" />
                        </div>
                    </div>

                    <div class="row-col4">
                        <div class="row-title">
                            <p>Chính sách</p>
                            <ul>
                                <li>Chính sách đổi hàng</li>
                                <li>Chính sách bảo hành</li>
                                <li>Chính sách bảo mật</li>
                                <li>Chính sách hoàn tiền</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row-col4">
                        <div class="row-title">
                            <p>Faq</p>
                            <ul>
                                <li>Thanh toán và vận chuyển</li>
                                <li>Kiểm tra thông tin đơn hàng</li>
                                <li>Hướng dẫn chọn size</li>
                                <li>Câu hỏi thường gặp</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row-col4">
                        <div class="row-title">
                            <p>Contact</p>
                            <ul>
                                <li>Điện thoại: 0123456789</li>
                                <li>Email: caothaihuy@gmail.com</li>
                                <li>
                                    Địa chỉ: 113 Lê Duẩn
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <hr align="center" />

                <div class="footer-bot">
                    <div class="bot-copyright">
                        <p>© THS 2000 - 2023. All right reserved</p>
                    </div>
                    <div class="bot-social">
                        <i class="fa-brands fa-facebook fa-lg"></i>
                        <i class="fa-brands fa-instagram fa-lg"></i>
                        <i class="fa-brands fa-snapchat fa-lg"></i>
                        <i class="fa-brands fa-twitter fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.1.0/swiper-bundle.min.js" integrity="sha512-4Ooh3fl4STrmn95ZbS/J6l8csp/FvSKPaeDAH/IaPQGJIx9lmpuxXZTCYKR2W5+Bt7i74exPvAT2PsWnac+sow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>