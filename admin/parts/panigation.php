<?php 
   include ("../config.php");
   if(isset($_GET['page'])){ 
     
     $pages=array("products", "cart"); 
     
     if(in_array($_GET['page'], $pages)) { 
       
       $_page=$_GET['page']; 
       
     }else{ 
       
       $_page="products"; 
       
     } 
     
   }else{ 
     
     $_page="products"; 
     
   } 
?>

<?php 
 
	if(isset($_GET['action']) && $_GET['action']=="add"){ 
		 
		$id=($_GET['id']); 
		 
		if(isset($_SESSION['cart'][$id])){ 
			 
			$_SESSION['cart'][$id]['quantity']++; 
			 
		}else{ 
			 
			$sql_s = "SELECT * FROM product WHERE Id = $id"; 
			$query_s = mysqli_query($conn, $sql_s); 
			if(mysqli_num_rows($query_s)!=0){ 
				$row_s=mysqli_fetch_array($query_s); 
				 
				$_SESSION['cart'][$row_s['Id']]=array( 
						"quantity" => 1, 
						"price" => $row_s['price'] ,
					); 
				 
				 
			}else{ 
				 
				$message="This product id it's invalid!"; 
				 
			} 
			 
		} 
		 
	} 
 
?>

<div class="content-section">
        <div class="container swiper">
          <div class="content-section-heading">
            <hr class="line" align="center" />
            <h2>Phân trang</h2>
            <hr class="line-2" align="right" />
          </div>
          <div class="slide-container">  
              <div class='card-wrapper swiper-wrapper' id='card-wrapper'>

           
           <?php 
        // PHẦN XỬ LÝ PHP
        // BƯỚC 1: KẾT NỐI CSDL
        include ("../config.php");
       
        // BƯỚC 2: TÌM TỔNG SỐ RECORDS
        $sql = "select count(Id) as total from product";
        $data = $conn->query($sql);
        $row=$data->fetch_assoc();
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
        $data = mysqli_query($conn, "SELECT * FROM product LIMIT $start, $limit");
        $row=$data->fetch_assoc();
        
            // PHẦN HIỂN THỊ TIN TỨC
            // BƯỚC 6: HIỂN THỊ DANH SÁCH TIN TỨC
        ?>
            <?php foreach ($data as $row) :?>
                      <form action="" method="post">
                        <a href='Product.html'                        
                          ><div class='card swiper-slide'>
                            <div class='image-box'>
                            <img src="../admin/assets/upload/product/<?php echo $row['img']?>" alt="">
                            </div>
                            <div class='product-content'>
                              <div class='product-info'>
                                <a href=''><?php echo $row['name_product'] ?></a>
                                <p><?php echo $row['price'] ?><span>₫</span>
                                  <a href="Home.php?page=product&action=add&id=<?php echo $row['Id'] ?>" name="addcart"><i class='fa-sharp fa-solid fa-cart-shopping'></i></a>
                                </p>
                              </div>
                            </div>
                            <!-- cart -->
                            
                            </div
                        ></a>  
                      </form>                    
                
        <?php endforeach; ?>  
            </div>
            <!-- phân trang -->
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
                else{
                    echo '<a href="Home.php?page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="Home.php?page='.($current_page+1).'">Next</a> | ';
            }
           ?>
            </div>
            <div class="cart">
            <form method="post" action="Home.php?page=cart">
            <table>
                      <tr>
                        <th>Tên</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                        <th>Action</th>
                      </tr>
              <?php 
                 include ("../config.php");
                  if(isset($_SESSION['cart'])){ 
                     
                    $sql_s="SELECT * FROM product WHERE Id IN ("; 
			 
                    foreach($_SESSION['cart'] as $id => $value) { 
                      $sql_s.=$id.","; 
                    } 
                    
                    $sql=substr($sql_s , 0, -1).") ORDER BY name_product ASC"; 
                    $data = $conn->query($sql);
                    while($row=$data->fetch_assoc()){ 
                      $subtotal = $_SESSION['cart'][$row['Id']]['quantity']*$row['price']; 
                      $totalprice = $totalprice + $subtotal; 
                    ?> 
                      <tr>
                        <td><?php echo $row['name_product'] ?> x </td>
						            <td>
                          <input type="text" name="quantity[<?php echo $row['Id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['Id']]['quantity'] ?>" />
                        </td> 
                        <td><?php echo $_SESSION['cart'][$row['Id']]['quantity'] ?></td>
                        <td><?php echo  $_SESSION['cart'][$row['Id']]['price']?></td>
                        <td><?php unset($_SESSION['cart'][$key]);  ?></td>
                      </tr>
                    
                     
                    <?php     
                    } 
                  ?> 
                  <tr> 
                      <td colspan="4">Total Price: <?php echo $totalprice ?></td> 
                  </tr> 
                  </table>
                    <hr /> 
                    <button type="submit" name="submit">Update Cart</button> 
            </form>
            <?php 
 
                              if(isset($_POST['submit'])){ 
                                 
                                foreach($_POST['quantity'] as $key => $val) { 
                                  if($val==0) { 
                                    unset($_SESSION['cart'][$key]); 
                                  }else{ 
                                    $_SESSION['cart'][$key]['quantity']=$val; 
                                  } 
                                } 
                                 
                              }
                            ?>
                  <?php 
                     
                  }else{ 
                     
                    echo "<p>Giỏ hàng trống! Vui lòng thêm sản phẩm!.</p>"; 
                     
                  } 
                 
                ?> 
            </div>

           
            </div>
          </div>
      </div>

     
      





      
