<!-- Show -->
<?php     
                include "../config.php";  // khởi tạo kết nối db
                $sql = "select * from danhmuc"; // câu truy vấn
                $stmt = $conn->prepare($sql); // chuẩn bị câu truy vấn
                $stmt->execute(); // truy vấn sql lấy dữ liệu về                            
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC); //tạo 1 mảng để lưu dữ liệu
            ?>
            <div class="form-detail">
                    <table>
                        <tr>
                            <th>ID Categories</th>
                            <th>Name Categories</th>
                            <th>Mô tả Categories</th>
                            <th colspan="2">Action</th>
                        </tr>  
                        <?php foreach ($data as $row) :?>
                            <tr>
                                <td><?php echo $row['id_cate'] ?></td>
                                <td><?php echo $row['name_cate'] ?></td>
                                <td><?php echo $row['mo_ta'] ?></td>
                                <td><a href="editcategory.php?id=<?php echo $row['id_cate'] ?>">Sửa</a><i class="fa-solid fa-pen-to-square"></i></i></td>
                                <td> <a href="delcategory.php?id=<?php echo $row['id_cate'] ?>">Xóa </a><i class="fa-solid fa-trash"></i></td>
                            </tr>                            
                        <?php endforeach; ?>    
                    </table> 
            </div>

        <!-- /.container-fluid -->  
        <?php $conn = null;; ?>    