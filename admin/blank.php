<?php include("./parts/header.php");
// session_start();
include("../config.php");
if (!$_SESSION['login']) {
    header("location: ./login.php");
    echo '<meta http-equiv="refresh" content="0; url= ./login.php">';

    // if ($_SESSION['login'] == '0') {
    //     header   ('location: ../user/index.php');
    // } else if ($_SESSION['login'] == '1') {
    //     echo $_SESSION['login'];
    //     require_once 'blank.php';
    // }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Xin chào </h1>

</div>
<!-- /.container-fluid -->
<?php include("./parts/footer.php") ?>