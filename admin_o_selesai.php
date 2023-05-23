<?php
    @include 'koneksi.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
    header('location:admin_login.php');
    };

    if(isset($_POST['update'])){
        $order_id = $_POST['id_pesanan'];
        $update_pembayaran = $_POST['update_pembayaran'];
        $update_status = $_POST['update_status'];
        mysqli_query($konek, "UPDATE `pesanan` SET status_pembayaran = '$update_pembayaran', status_pemesanan = '$update_status' WHERE id_pesanan = '$order_id'") or die('query failed');
        $_SESSION['status'] = "status pesanan berhasil diupdate!";
        $_SESSION['status_code'] = "success";
        // $message[] = 'payment status has been updated!';
    }
     
    if(isset($_POST['HapusOrder'])){
        $delete_id = $_POST['delete_id'];
        mysqli_query($konek, "DELETE FROM `pesanan` WHERE id_pesanan = '$delete_id'") or die('query failed');
        $_SESSION['status'] = "Pesanan terhapus!";
        $_SESSION['status_code'] = "success";
        // header('location:admin_o_proses.php');
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
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <img width="100%" src="img/selesai.png">
        </div>
    </section>

    <section id="addproduct">
        <div class="container">
            <div class="row justify-content-center">
                <a href="admin_o_proses.php" class="active1 btn btn-primary col-md-2 mb-3 m-2">Sedang Diproses</a>
                <a href="admin_o_pengiriman.php" class="active1 btn btn-primary col-md-2 mb-3 m-2">Dalam Pengiriman</a>
                <a href="admin_o_selesai.php" class="btn btn-primary btnload col-md-2 mb-3 m-2">Selesai</a>
            </div>
        </div>
    </section>

    <section class="" id="produk">
        <div class="container px-4 px-lg-5 mt-1 py-3 border-top">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-2 justify-content-center mt-4">

                <?php
                    $select_orders = mysqli_query($konek, "SELECT * FROM `pesanan` WHERE status_pemesanan = 'Selesai' ORDER BY tanggal_pemesanan desc") or die('query failed');
                    if(mysqli_num_rows($select_orders) > 0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                ?>
                
                <div class="col mb-5">
                        <div class="card h-100">
                            <form method="POST" action="">
                            <div class="card-body p-4">
                                <p>
                                <strong>ID Pesanan</strong> : <span><?php echo $fetch_orders['id_pesanan']; ?></span> <br> 
                                <strong>Nama</strong> : <span><?php echo $fetch_orders['username']; ?></span> <br> 
                                <strong>Nomor Telepon</strong> : <span><?php echo $fetch_orders['notelp']; ?></span> <br>
                                <strong>Alamat</strong> : <span><?php echo $fetch_orders['alamat']; ?></span> <br> 
                                <strong>Total Belanja</strong> : <span>Rp<?php echo $fetch_orders['total_belanja']; ?></span> <br>
                                <strong>Detail Pesanan</strong> : <a class = "link" href="#"  data-bs-toggle="modal" data-bs-target="#lihatDetail<?= $fetch_orders['id_pesanan'] ?>"> Lihat </a> <br> 
                                <strong>Tanggal Pemesanan</strong> : <span><?php echo $fetch_orders['tanggal_pemesanan']; ?></span> <br>
                                <strong>Tanggal Pembayaran</strong> : <span><?php echo $fetch_orders['tanggal_pembayaran']; ?></span> <br>
                                <strong>Tanggal Pengiriman</strong> : <span><?php echo $fetch_orders['tanggal_pengiriman']; ?></span> <br>
                                <strong>Tanggal Selesai</strong> : <span><?php echo $fetch_orders['tanggal_selesai']; ?></span> <br>
                                <strong>Status Pembayaran</strong> : <span><?php echo $fetch_orders['status_pembayaran']; ?></span><br>
                                <strong>Metode Pembayaran</strong> : <span><?php echo $fetch_orders['metode_pembayaran']; ?></span><br>
                                <strong>Bukti Pembayaran</strong> : <a class = "link" href="#"  name = "lihat_bukti" data-bs-toggle="modal" data-bs-target="#lihatBukti<?= $fetch_orders['id_pesanan'] ?>"> Lihat </a> <br>
                                <strong>Catatan</strong> : <span><?php echo $fetch_orders['catatan']; ?></span><br>
                                <strong>Status Pesanan</strong> : <span><?php echo $fetch_orders['status_pemesanan']; ?></span><br>
                                

                                <input type="hidden" name="id_pesanan" value="<?php echo $fetch_orders['id_pesanan']; ?>">
                                <div class="mt-4">
                                    <a href="#" class="btn btn-hapus btn-primary" style="color:white;" data-bs-toggle="modal" data-bs-target="#hapusOrder<?= $fetch_orders['id_pesanan'] ?>">Hapus</a>

                                    <div class="modal fade" id="lihatBukti<?= $fetch_orders['id_pesanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Pembayaran Pesanan <?php echo $fetch_orders['id_pesanan']; ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div> 
                                                <?php
                                                    $id_pesanan = $fetch_orders['id_pesanan'];
                                                    $select_gambar = mysqli_query($konek, "SELECT bukti_pembayaran FROM `pesanan` WHERE id_pesanan = '$id_pesanan'") or die('query failed');
                                                    if(mysqli_num_rows($select_gambar) > 0){
                                                    while($fetch_detail = mysqli_fetch_assoc($select_gambar)){
                                                ?>   
                                                                
                                                <div class="modal-body">
                                                   <div class="mb-2 h-50">
                                                        <img class="card-img-top" src="img/<?php echo $fetch_orders['bukti_pembayaran']; ?>" alt="..." sizes="50%"/>
                                                    </div>
                                                </div>
                                                <?php
                                                        }
                                                    } else{
                                                    }
                                                ?>
                                    
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn2 btn-primary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal fade" id="hapusOrder<?= $fetch_orders['id_pesanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pesanan (ID = <?php echo $fetch_orders['id_pesanan'] ?> )</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="delete_id" value="<?php echo $fetch_orders['id_pesanan']; ?>">
                                                        <div class="mb-2">
                                                            <h5>Apakah anda yakin ingin menghapus pesanan ini?</h5>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn2 btn-primary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-hapus btn-primary" name="HapusOrder">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="lihatDetail<?= $fetch_orders['id_pesanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pesanan <?php echo $fetch_orders['id_pesanan']; ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>   
                                                <?php
                                                    $id_pesanan = $fetch_orders['id_pesanan'];
                                                    $select_detail = mysqli_query($konek, "SELECT * FROM `detail_pesanan` WHERE id_pesanan = '$id_pesanan'") or die('query failed');
                                                    if(mysqli_num_rows($select_detail) > 0){
                                                    while($fetch_detail = mysqli_fetch_assoc($select_detail)){
                                                ?>                           
                                                <div class="modal-body">
                                                    <div>
                                                        <strong>Nama produk : <span><?php echo $fetch_detail['nama']; ?></span></strong> <br>
                                                        <span>Jumlah : <?php echo $fetch_detail['jumlah']; ?></span>  
                                                    </div>
                                                </div>

                                                    <?php
                                                        }
                                                    } else{
                                                    }
                                                ?>
                                    
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn2 btn-primary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
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
                    <div class="card p-5 text-center mb-5 mt-4">Tidak ada pesanan<div>
                <?php
                    }
                ?>

            </div>
        </div>
    </section>

    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="form-validation.js"></script>
    <script src="script.js"></script>
    <?php @include 'alert.php'; ?>
</body>
</html>
