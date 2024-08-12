<?php 

session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/login.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alegreya+Sans&family=Quicksand:wght@600&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
  </head>
  <body>
    <div class="main">      

      <div class="content-section">
        <div class="container">
          <div class="form">
            <div class="form-detail">
              <h1 id="welcomeMessage">Login</h1>
              <form id="contactForm"  method="post">
                <div id="field">
                  <label for="name">Email</label>
                  <input type="email" name="name" id="name"  />
                  <div id="checkemail"></div>
                </div>
                <div id="field">
                  <label for="email">Mật khẩu</label>
                  <input
                    type="password"
                    name="pass"
                    id="pw-1"
                  />
                  <div id="checkpass1"></div>
                </div>
                <div class="field">
                  <input type="submit" value="Login" />     <p>Bạn chưa có tài khoản? <a href="./signup.php">Đăng kí ngay</a></p>              
                </div>
               
              </form>
              <?php 
               include_once "../config.php";
               $errors = [];
               
               if(isset($_POST['name'])){
                   $userName = $_POST['name'];
                   $password = $_POST['pass'];
                   
                   if(trim($userName) == "") {
                       array_push($errors, "Email không được bỏ trống");
                   }
                   
                   if(trim($password) == "") {
                       array_push($errors, "Password không được bỏ trống");
                   }
                   
                   $sql = "SELECT * FROM khachhang WHERE email = :userName AND pass = :password";
                   $stmt = $conn->prepare($sql);
                   $stmt->bindParam(':userName', $userName);
                   $stmt->bindParam(':password', $password);
                   $stmt->execute();
                   
                   $numrow = $stmt->rowCount();
                   
                   if($numrow != 1) {
                       array_push($errors, "Email hoặc mật khẩu chưa đúng");
                   }
                   
                   if(count($errors) > 0){
                       echo "<ul style='color:red'>";
                       foreach($errors as $error){
                           echo "<li>$error</li>";
                       }
                       echo "</ul>";
                   } else {
                       $row = $stmt->fetch(PDO::FETCH_ASSOC);
                       if($row){
                           $_SESSION['login'] = $row['roleid'];
                           if($_SESSION['login'] == 2) {
                            header('location: ../user/index.php');
                         }else if( $_SESSION['login']== 1) {
                           header('location: blank.php');
                         }
                           echo  $_SESSION['login']; 
                           $_SESSION['dangki'] = $row['name_user'];
                           $_SESSION['idkh'] = $row['id_user'];  
                       } else {
                           array_push($errors, "Email hoặc mật khẩu chưa đúng");
                       }                                                        
                   }
               }
           ?>
            </div>
            <div class="form-img">
              <!-- <img src="assets/img/n70.jpg" alt="" /> -->
              <div class="box">
              
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="assets/js/check.js"></script>
  </body>
</html>
