<?php require "part/head.php";
?>
<div class="content-section">
    <div class="lienhe">
        <p class="p-1"><i class="fa-solid fa-phone"></i> Hãy liên hệ với chúng tôi qua :</p>
        <p>Hotline : <i><b>0123456789</b> </i> </p>
        <p>Email : <i><b>caothaihuy@gmail.com</b></i></p>
        <p>Thời gian : <i><b>Thứ 2 - Chủ nhật / 09:30 ~ 22:30</b></i></p>
        <!--                                    -->
        <p class="p-1"><i class="fa-solid fa-envelope-open-text"></i> Hoặc điền thông tin của bạn :</p>
        <p>
            <input type="text" name="name" class="name" value placeholder="Họ và tên của bạn" class="name form-control">
        </p>
        <p>
            <input type="text" name="phone" value placeholder="Số điện thoại của bạn" class="phone form-control">
        </p>
        <p>
            <input type="text" name="email" value placeholder="Email của bạn" class="email form-control">
        </p>
        <p>
            <textarea class="content form-control" name="content" placeholder="Nội dung cần liên hệ"></textarea>
        </p>
        <button>Gửi thông tin <i class="fa-solid fa-user-check"></i></button>
        <br>


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
                <?php foreach ($sth as $row): ?>
                    <a href="../user/Product.php">
                        <form class="card swiper-slide" action="index.php?action=addCart" method="post">
                            <input type="hidden" name="id" value="<?= $row['id_product'] ?>">
                            <input type="hidden" name="name" value="<?php echo $row['name_product']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['gia']; ?>">
                            <input type="hidden" name="img"
                                value="../admin/assets/upload/product/<?php echo $row['hinh_anh'] ?>">
                            <div class="block-4 text-center border">
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
                                            <button name="addCart" class="addCart" type="submit"
                                                style="cursor: pointer; background-color: transparent; border: none !important; "><i
                                                    class="fa-solid fa-cart-plus"></i></button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
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