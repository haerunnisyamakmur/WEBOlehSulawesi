<?php

@include 'koneksi.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olehSulawesi Admin Panel</title>
    <script src="https://kit.fontawesome.com/9fac50fda5.js" crossorigin="anonymous"></script>  
    <link rel="stylesheet" href="style.css" type="text/css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container px-4 px-lg-5">
        <a class="navbar-brand " href="#">
            <img src="img/logo.png" alt="" width="50" height="50" class="d-inline-block align-text-top">
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 mr-lg-5">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="admin_index.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_produk.php">Produk</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pesanan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="admin_o_proses.php">Sedang Diproses</a></li>
                            <li><a class="dropdown-item" href="admin_o_pengiriman.php">Dalam Pengiriman</a></li>
                            <li><a class="dropdown-item" href="admin_o_selesai.php">Selesai</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="admin_cabang.php">Cabang Toko</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_message.php">Message</a></li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Akun
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="admin_infouser.php">Akun User</a></li>
                            <li><a class="dropdown-item" href="admin_infoadmin.php">Akun Admin</a></li>
                        </ul>
                    </li> -->
                    <li class="nav-item"><a class="nav-link" href="admin_penilaian.php">Penilaian</a></li>
                </ul>
                <div class="d-flex">
                    <button type="button" id="user-btn" class="btn btn-outline-dark">
                    <i class="fa-solid fa-user"></i>
                    </button>
                </div>

                <div class="account-box">
                <p>username : <span><?php echo $_SESSION['admin_name']; ?></span><br>
                   email : <span><?php echo $_SESSION['admin_email']; ?></span>
                </p>
                <a href="admin_logout.php" class="btn btn-hapus btn-primary btn-sm">logout</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="py-5">
        <div class="col-md-12">
            <img width="100%" src="img/dashboaard2.png">
        </div>
    </section>

    <section class="mb-5">
        <div class="container overflow-hidden text-center p-3">
            <div class="row gy-4">
                <div class="col-md-4 text-center">
                    <?php
                        $select_products = mysqli_query($konek, "SELECT * FROM `produk`") or die('query failed');
                        $number_of_products = mysqli_num_rows($select_products);
                    ?>
                    <div class="p-3 border">
                        <a class="link" href="admin_produk.php"><h3>TOTAL PRODUK</h3></a>
                        <h1 class="mt-4"><?php echo $number_of_products; ?></h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                        $total_completes = 0;
                        $select_completes = mysqli_query($konek, "SELECT * FROM `pesanan` WHERE status_pemesanan = 'selesai'") or die('query failed');
                        while($fetch_completes = mysqli_fetch_assoc($select_completes)){
                            $total_completes += $fetch_completes['total_belanja'];
                        };
                    ?>
                    <div class="p-3 border">
                        <h3>TOTAL PENJUALAN</h3>
                        <h1 class="mt-4"><?php echo $total_completes; ?></h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                        $select_cabang = mysqli_query($konek, "SELECT * FROM `cabang`") or die('query failed');
                        $number_of_cabang = mysqli_num_rows($select_cabang);
                    ?>
                    <div class="p-3 border">
                        <a class="link" href="admin_cabang.php"><h3>CABANG TOKO</h3></a>
                        <h1 class="mt-4"><?php echo $number_of_cabang; ?></h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                        $select_orders1 = mysqli_query($konek, "SELECT * FROM `pesanan` where status_pemesanan='diproses'") or die('query failed');
                        $number_of_orders1 = mysqli_num_rows($select_orders1);
                    ?>
                    <div class="p-3 border">
                        <a class="link" href="admin_o_proses.php"><h3>PESANAN DIPROSES</h3></a>
                        <h1 class="mt-4"><?php echo $number_of_orders1; ?></h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                        $select_orders2 = mysqli_query($konek, "SELECT * FROM `pesanan` where status_pemesanan='dikirim'") or die('query failed');
                        $number_of_orders2 = mysqli_num_rows($select_orders2);
                    ?>
                    <div class="p-3 border">
                        <a class="link" href="admin_o_pengiriman.php"><h3>PESANAN DIKIRIM</h3></a>
                        <h1 class="mt-4"><?php echo $number_of_orders2; ?></h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                        $select_orders3 = mysqli_query($konek, "SELECT * FROM `pesanan` where status_pemesanan='selesai'") or die('query failed');
                        $number_of_orders3 = mysqli_num_rows($select_orders3);
                    ?>
                    <div class="p-3 border">
                        <a class="link" href="admin_o_selesai.php"><h3>PESANAN SELESAI</h3></a>
                        <h1 class="mt-4"><?php echo $number_of_orders3; ?></h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                        $select_messages = mysqli_query($konek, "SELECT * FROM `message`") or die('query failed');
                        $number_of_messages = mysqli_num_rows($select_messages);
                    ?>
                    <div class="p-3 border">
                        <a class="link" href="admin_message.php"><h3>MESSAGE</h3></a>
                        <h1 class="mt-4"><?php echo $number_of_messages; ?></h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                        $select_penilaian = mysqli_query($konek, "SELECT * FROM `penilaian`") or die('query failed');
                        $number_of_penilaian = mysqli_num_rows($select_penilaian);
                    ?>
                    <div class="p-3 border">
                        <a class="link" href="admin_penilaian.php"><h3>PENILAIAN</h3></a>
                        <h1 class="mt-4"><?php echo $number_of_penilaian; ?></h1>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                    <?php
                        $select_user = mysqli_query($konek, "SELECT * FROM `user`") or die('query failed');
                        $number_of_user = mysqli_num_rows($select_user);
                    ?>
                    <div class="p-3 border">
                        <a class="link" href="admin_infouser.php"><h3>AKUN USER</h3></a>
                        <h1 class="mt-4"><?php echo $number_of_user; ?></h1>
                    </div>
                </div>

                <div class="col-md-4">
                    <?php
                        $select_admin = mysqli_query($konek, "SELECT * FROM `admin`") or die('query failed');
                        $number_of_admin = mysqli_num_rows($select_admin);
                    ?>
                    <div class="p-3 border">
                        <a class="link" href="admin_infoadmin.php"><h3>AKUN ADMIN</h3></a>
                        <h1 class="mt-4"><?php echo $number_of_admin; ?></h1>
                    </div>
                </div> -->
                
            </div>
        </div>
    </section>

    
    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
