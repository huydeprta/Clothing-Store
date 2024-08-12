<!-- Show -->
<?php     
                // PHẦN XỬ LÝ PHP
                // BƯỚC 1: KẾT NỐI CSDL
                include ("../config.php");
               
                // BƯỚC 2: TÌM TỔNG SỐ RECORDS
                $sql = "select count(id_product) as total from sanpham";
                $data = $conn->query($sql);
                $row=$data->fetch(PDO::FETCH_ASSOC);
                $total_records = $row['total'];
                
                // echo $total_records; // 10 sp
         
                // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 4;
                // echo $current_page; // 2
         
                // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
                // tổng số trang
                $total_page = ceil($total_records / $limit); // 3
                // echo $total_page;
                // Giới hạn current_page trong khoảng 1 đến total_page
                if ($current_page > $total_page){
                    $current_page = $total_page;
                }
                else if ($current_page < 1){
                    $current_page = 1;
                }
         
                // Tìm Start
                $start = ($current_page - 1) * $limit;
         
                // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
                // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
                $sql = "SELECT * FROM sanpham LIMIT $start, $limit";
                $stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
                $stmt->execute(); // truy vấn sql lấy dữ liệu về                            
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
                
                    // PHẦN HIỂN THỊ TIN TỨC
                    // BƯỚC 6: HIỂN THỊ DANH SÁCH TIN TỨC
                
            ?>
            <div class="form-detail">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>ID Categories</th>
                            <th colspan="2">Action</th>
                        </tr>  
                        <?php foreach ($data as $row) :?>
                            <tr>
                                <td><?php echo $row['id_product'] ?></td>
                                <td><?php echo $row['name_product'] ?></td>
                                <td><?php echo $row['gia'] ?></td>
                                <td><?php echo $row['des_product'] ?></td>
                                <td> <img src="./assets/upload/product/<?php echo $row['hinh_anh']?>" alt=""> </td>
                                <td><?php echo $row['id_cate'] ?></td>
                                <td><a href="editproduct.php?id=<?php echo $row['id_product'] ?>">Sửa</a><i class="fa-solid fa-pen-to-square"></i> </td>
                                <td> <a href="delproduct.php?id=<?php echo $row['id_product'] ?>">Xóa</a><i class="fa-solid fa-trash"></i></td>
                            </tr>                            
                        <?php endforeach; ?>    
                    </table> 
            </div>
            <div class="pagination">

           <?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="product.php?page='.($current_page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="product.php?page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="product.php?page='.($current_page+1).'">Next</a> | ';
            }
           ?>
            </div>
        <!-- /.container-fluid -->  
        <?php $conn = null; ?>  