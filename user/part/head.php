<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>T-shirt</title>
  <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <link rel="stylesheet" href="./assets/css/product.css" />
  <link rel="stylesheet" href="./assets/css/cart.css" />
  <link rel="stylesheet" href="./assets/css/checkout.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans&family=Quicksand:wght@600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
  <div class="main">
    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <i class="fa-sharp fa-solid fa-arrow-up"></i>
    </button>
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
              <li><a href="#!"> <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> <?php echo $_SESSION['dangki'] ?></a></li>
              <li><a href="../admin/logout.php"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>