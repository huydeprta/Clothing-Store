<?php include("./parts/header.php") ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <div class="form-detail">
        <form class="form-categories" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Danh mục</h2>
            <div class="field">
                <label for="">Name Categories </label>
                <input type="text" name="name" id="">
            </div>
            <div class="field">
                <label for="">Mô tả </label>
                <input type="text" name="mota" id="">
            </div>
            <div class="field">
                <input name="login" id="field" type="submit" value="Add">
            </div>
            <?php
            include "../config.php"; // file kết nối databasekết nối database khởi tạo kết nối $conn    
            if (!$_SESSION['login']) {
                header("location: ../admin/login.php");
                echo '<meta http-equiv="refresh" content="0; url= ../admin/login.php">';
            }

            if (isset($_POST['login'])) {
                $name = $_POST['name'];
                $mota = $_POST['mota'];
                if (($name == "") && (strlen($name) > 50)) {
                    echo "<p class = 'errol'>Vui lòng nhập Name Categories</p>";
                }
                if (($mota == "") && (strlen($mota) > 200)) {
                    echo "<p class = 'errol'>Vui lòng nhập Name Categories</p>";
                }

                $sql = "select id_cate from danhmuc";
                $data = $conn->query($sql);

                $sql = "INSERT INTO danhmuc (name_cate, mo_ta) VALUES ('$name', '$mota')";
                $conn->query($sql); // câu insert                                     
            }
            $sql = "select * from danhmuc";
            $data = $conn->query($sql); // Thực thi câu truy vấn SQL để lấy dữ liệu
            ?>
        </form>
    </div>

    <?php include("./showcate.php") ?>
    <?php include("./parts/footer.php") ?>