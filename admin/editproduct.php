<?php include("./parts/header.php")?>
        <!-- Begin Page Content -->
        <div class="container-fluid">            
            <div class="form-detail">
            <?php 
            //  include "../config.php";
            //  $idpr=$_GET['id'];
            //  $sql="select * from product where Id=$idpr";
            //  $data=$conn->query($sql);
            //  $row=$data->fetch_assoc();
            ?>
            <?php 
                    // 3. Truy vấn dữ liệu Sản phẩm theo khóa chính
                 
                    // Chuẩn bị câu truy vấn $sqlSelect, lấy dữ liệu ban đầu của record cần update
                    // Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    include "../config.php";  // khởi tạo kết nối db
                    $id = $_GET['id'];
                    $sql = "select * from sanpham where id_product = $id"; // câu truy vấn
                    $stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
                    $stmt->execute(); // truy vấn sql lấy dữ liệu về                            
                    $row = $stmt->fetch(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
                    
                    /* --- End Truy vấn dữ liệu Sản phẩm theo khóa chính --- */
                    ?>
            
                    <form class="form-product" enctype="multipart/form-data" method="post">
                        <h2>Update Sản phẩm</h2>
                        <div class="field">
                            <label for="">Name Product </label>
                            <input type="text" name="namepr" id="" value="<?php echo $row['name_product'] ?>">
                        </div>
                        <div class="field">
                            <label for="">Price Product </label>
                            <input type="text" name="price" id="" value="<?php echo $row['gia'] ?>">
                        </div>
                        <div class="field">
                            <label for="">Desciption Product </label>
                            <input type="text" name="des" id="" value="<?php echo $row['des_product'] ?>">
                        </div>
                        <div class="field">
                            <label for="">Image Product </label>
                            <div class="up-img" style="width: 70%;">                                                         
                                <img src="./assets/upload/product/<?php echo $row['hinh_anh'] ?>" alt="" style="width: 200px;">
                                <input type="file" name="img" id="" value="<?php echo $row['hinh_anh']?>">                  
                            </div>
                        </div>                        
                        <div class="field">
                            <input name="edit" type="submit" id="field" value="Edit" >
                        </div>                        
                    </form>  
                    <?php 
                        include "../config.php";            
                        if(isset($_POST['edit'])){
                            $idpr=$_GET['id']; 
                            $name = $_POST['namepr'];
                            $price = $_POST['price'];
                            $img = $row['hinh_anh'];
                            $des = $_POST['des'];                           
                            if($name!=""){
                                $sql="update sanpham set id_product = '$idpr',
                                                    name_product ='$name',
                                                    gia = '$price',
                                                    hinh_anh = '$img',
                                                    des_product = '$des'
                                    where id_product = $idpr";
                                $conn->query($sql);
                                echo '<meta http-equiv="refresh" content="0; url=product.php">';
                            }else{echo "Vui lòng nhập danh mục";}
                            // Nếu người dùng có chọn file để upload
                            if (isset($_FILES['img'])) {
                                // Đường dẫn để chứa thư mục upload trên ứng dụng web của chúng ta. Các bạn có thể tùy chỉnh theo ý các bạn.
                                // Ví dụ: các file upload sẽ được lưu vào thư mục ../../../assets/uploads
                                $upload_dir = __DIR__ . "./assets/upload/";
                                // Các hình ảnh sẽ được lưu trong thư mục con `products` để tiện quản lý
                                $subdir = 'product/';
                                // Chuyển file từ thư mục tạm vào thư mục Uploads
                                // Nếu file upload bị lỗi, tức là thuộc tính error > 0
                                if ($_FILES['img']['error'] > 0) {
                                    $er = $_FILES['img']['error'];
                                    echo 'File Upload Bị Lỗi'; die;
                                } else {                                
                                // Để tránh trường hợp có 2 người dùng cùng lúc upload tập tin trùng tên nhau
                                // Ví dụ:   
                                // - Người 1: upload tập tin hình ảnh tên `hoahong.jpg`
                                // - Người 2: cũng upload tập tin hình ảnh tên `hoahong.jpg`
                                // => dẫn đến tên tin trong thư mục chỉ còn lại tập tin người dùng upload cuối cùng
                                // Cách giải quyết đơn giản là chúng ta sẽ ghép thêm ngày giờ vào tên file
                                $img = $_FILES['img']['name'];
                                $nameimg = date('YmdHis') . '_' . $img; //20200530154922_hoahong.jpg
                                // Tiến hành di chuyển file từ thư mục tạm trên server vào thư mục chúng ta muốn chứa các file uploads
                                // Ví dụ: move file từ C:\xampp\tmp\php6091.tmp -> C:/xampp/htdocs/learning.nentang.vn/php/twig/assets/uploads/hoahong.jpg
                                // var_dump($_FILES['hsp_tentaptin']['tmp_name']);
                                // var_dump($upload_dir . $subdir . $tentaptin);

                                move_uploaded_file($_FILES['img']['tmp_name'], $upload_dir . $subdir . $nameimg);

                                // 3.2. Lưu thông tin file upload vào database
                                // Câu lệnh UPDATE
                                $sql = "update sanpham set hinh_anh = '$nameimg'  where id_product = $idpr";
                                // print_r($sql); die;

                                // Thực thi
                                $data = $conn->query($sql);

                                // Đóng kết nối
                                $conn = null;

                                // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
                                // echo '<script>location.href = "product.php";</script>';
                            }
                        }}
                        

                    ?>  

                    <?php
                            // 3. Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh UPDATE
                            if (isset($_POST['btnSave'])) {
                            // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                            $sp_ma = $_POST['sp_ma'];

                            // Nếu người dùng có chọn file để upload
                            if (isset($_FILES['hsp_tentaptin'])) {
                                // Đường dẫn để chứa thư mục upload trên ứng dụng web của chúng ta. Các bạn có thể tùy chỉnh theo ý các bạn.
                                // Ví dụ: các file upload sẽ được lưu vào thư mục ../../../assets/uploads
                                $upload_dir = __DIR__ . "/../../../assets/uploads/";
                                // Các hình ảnh sẽ được lưu trong thư mục con `products` để tiện quản lý
                                $subdir = 'products/';

                                // Đối với mỗi file, sẽ có các thuộc tính như sau:
                                // $_FILES['hsp_tentaptin']['name']     : Tên của file chúng ta upload
                                // $_FILES['hsp_tentaptin']['type']     : Kiểu file mà chúng ta upload (hình ảnh, word, excel, pdf, txt, ...)
                                // $_FILES['hsp_tentaptin']['tmp_name'] : Đường dẫn đến file tạm trên web server
                                // $_FILES['hsp_tentaptin']['error']    : Trạng thái của file chúng ta upload, 0 => không có lỗi
                                // $_FILES['hsp_tentaptin']['size']     : Kích thước của file chúng ta upload

                                // 3.1. Chuyển file từ thư mục tạm vào thư mục Uploads
                                // Nếu file upload bị lỗi, tức là thuộc tính error > 0
                                if ($_FILES['hsp_tentaptin']['error'] > 0) {
                                echo 'File Upload Bị Lỗi'; die;
                                } else {
                                // Để tránh trường hợp có 2 người dùng cùng lúc upload tập tin trùng tên nhau
                                // Ví dụ:
                                // - Người 1: upload tập tin hình ảnh tên `hoahong.jpg`
                                // - Người 2: cũng upload tập tin hình ảnh tên `hoahong.jpg`
                                // => dẫn đến tên tin trong thư mục chỉ còn lại tập tin người dùng upload cuối cùng
                                // Cách giải quyết đơn giản là chúng ta sẽ ghép thêm ngày giờ vào tên file
                                $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                                $tentaptin = date('YmdHis') . '_' . $hsp_tentaptin; //20200530154922_hoahong.jpg

                                // Tiến hành di chuyển file từ thư mục tạm trên server vào thư mục chúng ta muốn chứa các file uploads
                                // Ví dụ: move file từ C:\xampp\tmp\php6091.tmp -> C:/xampp/htdocs/learning.nentang.vn/php/twig/assets/uploads/hoahong.jpg
                                // var_dump($_FILES['hsp_tentaptin']['tmp_name']);
                                // var_dump($upload_dir . $subdir . $tentaptin);

                                move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                                }

                                // 3.2. Lưu thông tin file upload vào database
                                // Câu lệnh INSERT
                                $sql = "INSERT INTO `hinhsanpham` (hsp_tentaptin, sp_ma) VALUES ('$tentaptin', $sp_ma);";
                                // print_r($sql); die;

                                // Thực thi INSERT
                                $data = $conn->query($sql);

                                // Đóng kết nối
                               $conn =null;

                                // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
                                echo '<script>location.href = "product.php";</script>';
                            }
                            }
                            ?>
            </div>  
        </div>
        <!-- /.container-fluid -->            
<?php include("parts/footer.php")?>