<?php

    @include 'koneksi.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:admin_login.php');
    };

    if(isset($_POST['TambahCabang'])){

        $name = mysqli_real_escape_string($konek, $_POST['NamaCabang']);
        $jam = mysqli_real_escape_string($konek, $_POST['JamBuka']);
        $alamat = mysqli_real_escape_string($konek, $_POST['AlamatCabang']);
        $link = mysqli_real_escape_string($konek, $_POST['LinkCabang']);
     
        $select_product_name = mysqli_query($konek, "SELECT nama_cabang FROM `cabang` WHERE nama_cabang = '$name'") or die('query failed');

        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folter = 'img/'.$image;
     
        if(mysqli_num_rows($select_product_name) > 0){
            $_SESSION['status'] = "Cabang telah ada!";
            $_SESSION['status_code'] = "error";
        //    $message[] = 'product name already exist!';
        }else{
           $insert_product = mysqli_query($konek, "INSERT INTO `cabang`(nama_cabang, jam_buka, alamat_cabang, gambar_cabang, link_cabang) VALUES('$name', '$jam', '$alamat', '$image', '$link')") or die('query failed');
     
           if($insert_product){
              if($image_size > 2000000){
                 $message[] = 'image size is too large!';
              }else{
                 move_uploaded_file($image_tmp_name, $image_folter);
                 $_SESSION['status'] = "Cabang berhasil ditambahkan!";
                 $_SESSION['status_code'] = "success";
                //  $message[] = 'product added successfully!';
              }
           }
        }
    }


    if(isset($_POST['EditCabang'])){

        $update_p_id = $_POST['edit_id'];
        $name = mysqli_real_escape_string($konek, $_POST['NamaCabang']);
        $jam = mysqli_real_escape_string($konek, $_POST['JamBuka']);
        $alamat = mysqli_real_escape_string($konek, $_POST['AlamatCabang']);
        $link = mysqli_real_escape_string($konek, $_POST['LinkCabang']);
     
     
        mysqli_query($konek, "UPDATE `cabang` SET nama_cabang = '$name', jam_buka = '$jam', alamat_cabang = '$alamat', 
        link_cabang = '$link' WHERE id_cabang = '$update_p_id'") or die('query failed');
     
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folter = 'img/'.$image;
        $old_image = $_POST['update_p_image'];
        
        if(!empty($image)){
           if($image_size > 2000000){
              $message[] = 'image file size is too large!';
           }else{
              mysqli_query($konek, "UPDATE `cabang` SET gambar_cabang = '$image' WHERE id_cabang = '$update_p_id'") or die('query failed');
              move_uploaded_file($image_tmp_name, $image_folter);
              unlink('img/'.$old_image);
              $message[] = 'image updated successfully!';
           }
        }
        $_SESSION['status'] = "Cabang berhasil diupdate!";
        $_SESSION['status_code'] = "success";
        // $message[] = 'product updated successfully!';
    }

     
    if(isset($_POST['HapusCabang'])){
        $delete_id = $_POST['delete_id'];
        mysqli_query($konek, "DELETE FROM `cabang` WHERE id_cabang = '$delete_id'") or die('query failed');
        $select_delete_image = mysqli_query($konek, "SELECT gambar_cabang FROM `cabang` WHERE id_cabang = '$delete_id'") or die('query failed');
        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        // unlink('img/'.$fetch_delete_image['image']);
        $_SESSION['status'] = "Cabang berhasil dihapus!";
        $_SESSION['status_code'] = "success";
        // header('location:admin_produk.php');
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
                    <li class="nav-item"><a class="nav-link active" href="admin_cabang.php">Cabang Toko</a></li>
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
            <img width="100%" src="img/cabang.png">
        </div>
    </section>

    <section id="addproduct">
        <div class="container">
            <button type="button" class="btn btn-primary btnload col-md-4 offset-md-4 mb-3" data-bs-toggle="modal" data-bs-target="#tambahCabang">Tambah Cabang</button>
        </div>
    </section>

    <div class="modal fade" id="tambahCabang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Cabang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                    <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Nama Cabang</label>
                            <input type="text" class="form-control" name="NamaCabang">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Jam Buka</label>
                            <input type="text" class="form-control" name="JamBuka">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Alamat Cabang</label>
                            <input type="text" class="form-control" name="AlamatCabang">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Link Cabang</label>
                            <input type="text" class="form-control" name="LinkCabang">
                        </div>
                        <div class="mb-2">
                            <label for="formFile" class="form-label">Gambar Cabang</label>
                            <input class="form-control" type="file" accept="image/jpg, image/jpeg, image/png" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn2 btn-primary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="TambahCabang">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <section class="" id="cabang">
        <div class="container px-4 px-lg-5 mt-1 py-3 border-top">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center mt-4">

                <?php
                $select_products = mysqli_query($konek, "SELECT * FROM `cabang` order by id_cabang DESC") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
                ?>
                
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                
                            <img class="card-img-top1" src="img/<?php echo $fetch_products['gambar_cabang']; ?>" alt="..." sizes="100%" name="image"/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="">
                                <p>
                                    <strong>Nama Cabang : </strong><span><?php echo $fetch_products['nama_cabang']; ?> </span><br>
                                    <strong>Jam Buka : </strong><span><?php echo $fetch_products['jam_buka']; ?></span><br>
                                    <strong>Alamat Cabang : </strong><span><?php echo $fetch_products['alamat_cabang']; ?> </span><br>
                                    <strong>Lokasi : </strong><a class = "link" href=<?php echo $fetch_products['link_cabang']; ?>><?php echo $fetch_products['link_cabang']; ?></a><br>
                                </p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <!-- <input type="hidden" name="id_produk" value="<?php echo $fetch_products['id_cabang']; ?>">
                                <input type="hidden" name="nama_produk" value="<?php echo $fetch_products['nama_cabang']; ?>">
                                <input type="hidden" name="harga_produk" value="<?php echo $fetch_products['jam_buka']; ?>"> -->

                                
                                <a href="editcabang.php?update=<?php echo $fetch_products['id_cabang']; ?>" class="btn btn22 btn-outline-secondary mt-2 col-12">Edit</a>
                                <a href="#" class="btn btn23 btn-outline-secondary mt-2 col-12" data-bs-toggle="modal" data-bs-target="#hapusCabang<?= $fetch_products['id_cabang'] ?>">Hapus</a>
                                <!-- <button type="submit" class="btn btn22 btn-outline-secondary mt-2 col-12" name="edit" data-bs-toggle="modal" data-bs-target="#tambahProduk">Edit</button> -->
                                <!-- <button class="btn btn22 btn-outline-secondary mt-2 col-12" name="add_to_cart">Delete</button> -->



                                <div class="modal fade" id="hapusCabang<?= $fetch_products['id_cabang'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Cabang</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="delete_id" value="<?php echo $fetch_products['id_cabang']; ?>">
                                                    <div class="mb-2">
                                                        <h5>Apakah anda yakin ingin menghapus cabang ini?</h5>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn2 btn-primary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-hapus btn-primary" name="HapusCabang">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php
                }
                }else{
                    echo '<p class="empty">Belum ada cabang toko yang ditambahkan!</p>';
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
