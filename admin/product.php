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

        $sql = "select * from danhmuc"; // câu truy vấn
        $stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
        $stmt->execute(); // truy vấn sql lấy dữ liệu về                            
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
        ?>
        <form class="form-product" enctype="multipart/form-data"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Sản phẩm</h2>
            <div class="field">
                <label for="">Name Product </label>
                <input type="text" name="namepr" id="">
            </div>
            <div class="field">
                <label for="">Price Product </label>
                <input type="text" name="price" id="">
            </div>
            <div class="field">
                <label for="">Desciption Product </label>
                <input type="text" name="des" id="">
            </div>
            <div class="field">
                <label for="">Id Categories </label>
                <select name="idcate" id="select">
                    <?php foreach ($data as $row): ?>
                        <option value="<?php echo $row['id_cate'] ?>"><?php echo $row['name_cate'] ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <input type="text" name="idcate" id=""> -->
            </div>
            <div class="field">
                <div class="label" style="width: 30%;">
                    <label for="">Image Product </label>
                </div>
                <div class="up-img" style="width: 70%;">
                    <img style="width: 100px;" src="./assets/img/default.jpg" alt="">
                    <input type="file" name="img" id="">
                </div>
            </div>
            <div class="field">
                <input name="add" type="submit" id="field" value="Add">
            </div>
            <?php
            include "../config.php";

            if (isset($_POST['add'])) {
                $name = $_POST['namepr'];
                $price = $_POST['price'];
                $des = $_POST['des'];
                $img = $_FILES['img']['name'];
                $id_cate = $_POST['idcate'];
                $imageFileType = pathinfo($img, PATHINFO_EXTENSION);
                $allowtypes = array('jpg', 'png', 'jpeg', 'gif');

               

                if if (!in_array($imageFileType, $allowtypes)) {
                    echo "<p class='errol'>Chỉ được upload các định dạng JPG, PNG, JPEG, GIF</p>";
                } (!is_numeric($price)) {
                    echo "<p class='errol'>Vui lòng nhập Price là số</p>";
                }

                if (!empty($des) && strlen($des) > 500) {
                    echo "<p class='errol'>Vui lòng nhập Description</p>";
                }

                if (empty($name) || strlen($name) > 50) {
                    echo "<p class='errol'>Vui lòng nhập Name Product</p>";
                }

                if (isset($_FILES['img'])) {
                    $upload_dir = __DIR__ . "./assets/upload/";
                    $subdir = 'product/';
                    $img = $_FILES['img']['name'];
                    $nameimg = date('YmdHis') . '_' . $img;

                    if ($_FILES['img']['error'] > 0) {
                        $er = $_FILES['img']['error'];
                        echo 'File Upload Bị Lỗi';
                        die;
                    } else {
                        move_uploaded_file($_FILES['img']['tmp_name'], $upload_dir . $subdir . $nameimg);

                        $sql = "INSERT INTO sanpham (name_product, gia, hinh_anh, des_product, id_cate ) 
                                                VALUES (:name, :price, :img, :des, :id_cate)";

                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':name', $name);
                        $stmt->bindParam(':price', $price);
                        $stmt->bindParam(':img', $nameimg);
                        $stmt->bindParam(':des', $des);
                        $stmt->bindParam(':id_cate', $id_cate);
                        $stmt->execute();

                        echo '<script>location.href = "product.php";</script>';
                    }
                }
            }

            $sqll = "SELECT * FROM sanpham";
            $data = $conn->query($sqll);

            ?>
        </form>
    </div>

    <!-- </div>   -->


    <?php include("./showproduct.php") ?>
    <?php include("./parts/footer.php") ?>