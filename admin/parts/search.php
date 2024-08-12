<div class="content-section">
        <div class="container swiper">
          <div class="content-section-heading">
            <hr class="line" align="center" />
            <h2>Tìm Kiếm</h2>            
            <hr class="line-2" align="right" />
          </div>
          
          <?php 
           $errors=[];
           if(isset($_REQUEST['add'])){
            $search = $_GET['inp'];
            if (empty($search)) {array_push($errors,"Email không được bỏ trống");}
            else {
              // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
              $sql = "select * from product where name_product like '%$search%'";

              // Kết nối sql                
              include_once "../config.php";
              
              // Thực thi câu truy vấn  
              $data=$conn->query($sql);
            //   $row=$data->fetch_assoc();
            //   var_dump($row);

              // Đếm số đong trả về trong sql.
              $num = mysqli_num_rows($data);

              // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
              if (!$num > 0 && $search == "") 
              {          
                  echo "Không tìm thấy kết quả!";
              } 
              else
              {
                 // Dùng $num để đếm số dòng trả về.
                echo "<p>$num kết quả trả về với từ khóa <b>$search</b></p>";
                  // Vòng lặp while & mysql_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.

              }
              //determine which page number visitor is currently on
              $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
              $limit = 4;
              $total_page = ceil($num / $limit); // 3
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
                $dataa = mysqli_query($conn, "select * from product where name_product like '%$search%' LIMIT $start, $limit ");
                $row=$data->fetch_assoc();
            }

           }
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
                            <th>Create Date</th>
                            <th>Update Date</th>
                            <th colspan="2">Action</th>
                        </tr>  
                        <?php foreach ($data as $row) :?>
                            <tr>
                                <td><?php echo $row['Id'] ?></td>
                                <td><?php echo $row['name_product'] ?></td>
                                <td><?php echo $row['price'] ?></td>
                                <td><?php echo $row['descr'] ?></td>
                                <td> <img src="./assets/upload/product/<?php echo $row['img']?>" alt=""> </td>
                                <td><?php echo $row['Id_categories'] ?></td>
                                <td><?php echo $row['create_date_at'] ?></td>
                                <td><?php echo $row['update_date_at'] ?></td>
                                <td><a href="editproduct.php?id=<?php echo $row['Id'] ?>">Sửa</a><i class="fa-solid fa-pen-to-square"></i> </td>
                                <td> <a href="delproduct.php?id=<?php echo $row['Id'] ?>">Xóa</a><i class="fa-solid fa-trash"></i></td>
                            </tr>                            
                        <?php endforeach; ?>    
                    </table> 
            </div>
         <!-- <?php  include ("./PS26494/admin/showproduct.php") ?>  -->
        <div class="pagination">

           <?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
              
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="Home.php?page='.($current_page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
                else {
                    echo '<a href="Home.php?page='.($current_page +1).'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút next
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="Home.php?page='.($current_page+ 1).'">Next</a> | ';
            }
           ?>
            </div>
           
            </div>
          </div>
      </div>