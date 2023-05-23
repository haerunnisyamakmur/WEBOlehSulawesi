<?php

    @include 'koneksi.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
    header('location:admin_login.php');
    };

    if(isset($_POST['HapusPesan'])){
        $delete_id = $_POST['delete_id'];
        mysqli_query($konek, "DELETE FROM `message` WHERE id_pesan = '$delete_id'") or die('query failed');
        $_SESSION['status'] = "Message terhapus!";
        $_SESSION['status_code'] = "success";
        // header('location:admin_message.php');
    }
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
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="admin_index.php">Dashboard</a></li>
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
                    <li class="nav-item"><a class="nav-link active" href="admin_message.php">Message</a></li>
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
                email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <a href="admin_logout.php" class="btn btn-hapus btn-primary btn-sm">logout</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="py-5">
        <div class="col-md-12">
            <img width="100%" src="img/message.png">
        </div>
    </section>

    <section class="">
        <div class="container px-4 px-lg-5 mt-1 py-3 border-top">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center mt-4">

            <?php
            $select_pesan = mysqli_query($konek, "SELECT * FROM `message` ORDER BY id_pesan DESC") or die('query failed');
            if(mysqli_num_rows($select_pesan) > 0){
                while($fetch_pesan = mysqli_fetch_assoc($select_pesan)){
            ?>
            
                <div class="col mb-5" action="" method="post">
                    <div class="card h-100">
                        <div class="card-body p-4 pb-4">
                            <p>
                                <strong>Tanggal</strong>: <?php echo $fetch_pesan['tanggal'] ?> <br>
                                <strong>Nama </strong>: <?php echo $fetch_pesan['username'] ?> <br>
                                <strong>Email </strong>: <?php echo $fetch_pesan['email'] ?> <br>
                                <strong>Message</strong>: <?php echo $fetch_pesan['message'] ?> <br>
                            </p>
                        </div>
                        <!-- Product actions-->
                        <form class="card-footer p-4 pt-0 border-top-0 bg-transparent" action="" method="POST">
                            <input type="hidden" name="id_pesan" value="<?php echo $fetch_pesan['id_pesan']; ?>">
                        
                            <!-- <button class="btn btn22 btn-outline-secondary mt-2 col-12" name="delete">Delete</button> -->

                            <!-- <a href="admin_message.php?delete=<?php echo $fetch_pesan['id_pesan']; ?>" onclick="return confirm('delete this message?');" class="btn btn22 btn-outline-secondary mt-2 col-12">delete</a> -->
                            <a href="#" class="btn btn23 btn-outline-secondary mt-2 col-12" data-bs-toggle="modal" data-bs-target="#hapusPesan<?= $fetch_pesan['id_pesan'] ?>">Hapus</a>

                            <div class="modal fade" id="hapusPesan<?= $fetch_pesan['id_pesan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pesan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="">
                                            <div class="modal-body">
                                                <input type="hidden" name="delete_id" value="<?php echo $fetch_pesan['id_pesan']; ?>">
                                                <div class="mb-2">
                                                    <h5>Apakah anda yakin ingin menghapus pesan ini?</h5>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn2 btn-primary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-hapus btn-primary" name="HapusPesan">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                        }
                    } else{
                ?>
                    <div class="card p-5 text-center mb-5 mt-4">Tidak ada pesan / message<div>
                <?php
                    }
                ?>

            </div>
        </div>
    </section>

    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <?php @include 'alert.php'; ?>
</body>
</html>
