<?php

    @include 'koneksi.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:admin_login.php');
    };

    if(isset($_POST['TambahProduk'])){

        $name = mysqli_real_escape_string($konek, $_POST['NamaProduk']);
        $price = mysqli_real_escape_string($konek, $_POST['HargaProduk']);
        $berat = mysqli_real_escape_string($konek, $_POST['berat']);
        // $komposisi = mysqli_real_escape_string($konek, $_POST['komposisi']);
        $desc = mysqli_real_escape_string($konek, $_POST['deskripsi']);
        $diskon = mysqli_real_escape_string($konek, $_POST['diskon']);
        $khas = mysqli_real_escape_string($konek, $_POST['khas']);
        $stok = mysqli_real_escape_string($konek, $_POST['stok']);
        $total = mysqli_real_escape_string($konek, $_POST['total']);
        $asal = mysqli_real_escape_string($konek, $_POST['asal']);
        $masa = mysqli_real_escape_string($konek, $_POST['masa']);
        $izin_edar = mysqli_real_escape_string($konek, $_POST['izin_edar']);
     
        $select_product_name = mysqli_query($konek, "SELECT nama_produk FROM `produk` WHERE nama_produk = '$name'") or die('query failed');

        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folter = 'img/'.$image;
     
        if(mysqli_num_rows($select_product_name) > 0){
            $_SESSION['status'] = "Produk telah ada!";
            $_SESSION['status_code'] = "error";
        //    $message[] = 'product name already exist!';
        }else{
           $insert_product = mysqli_query($konek, "INSERT INTO `produk`(nama_produk, harga_produk, gambar_produk, berat_produk, deskripsi_produk, diskon_produk, 
           khas_produk, stok_produk, total_penjualan, asal_wilayah, masa_penyimpanan, no_izin_edar) VALUES('$name', '$price', '$image', '$berat', '$desc', '$diskon', 
           '$khas', '$stok', '$total', '$asal', '$masa', '$izin_edar')") or die('query failed');
     
           if($insert_product){
              if($image_size > 2000000){
                 $message[] = 'image size is too large!';
              }else{
                 move_uploaded_file($image_tmp_name, $image_folter);
                 $_SESSION['status'] = "Produk berhasil ditambahkan!";
                 $_SESSION['status_code'] = "success";
                //  $message[] = 'product added successfully!';
              }
           }
        }
    }


    if(isset($_POST['EditProduk'])){

        $update_p_id = $_POST['edit_id'];
        $name = mysqli_real_escape_string($konek, $_POST['NamaProduk']);
        $price = mysqli_real_escape_string($konek, $_POST['HargaProduk']);
        $berat = mysqli_real_escape_string($konek, $_POST['berat']);
        $desc = mysqli_real_escape_string($konek, $_POST['deskripsi']);
        $diskon = mysqli_real_escape_string($konek, $_POST['diskon']);
        $khas = mysqli_real_escape_string($konek, $_POST['khas']);
        $stok = mysqli_real_escape_string($konek, $_POST['stok']);
        $total = mysqli_real_escape_string($konek, $_POST['total']);
        $asal = mysqli_real_escape_string($konek, $_POST['asal']);
        $masa = mysqli_real_escape_string($konek, $_POST['masa']);
        $izin_edar = mysqli_real_escape_string($konek, $_POST['izin_edar']);
     
     
        mysqli_query($konek, "UPDATE `produk` SET nama_produk = '$name', harga_produk = '$price', berat_produk = '$berat', 
        deskripsi_produk = '$desc', diskon_produk = '$diskon', khas_produk = '$khas', stok_produk = '$stok', total_penjualan = '$total', 
        asal_wilayah = '$asal', masa_penyimpanan = '$masa', no_izin_edar = '$izin_edar' WHERE id_produk = '$update_p_id'") or die('query failed');
     
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folter = 'img/'.$image;
        $old_image = $_POST['update_p_image'];
        
        if(!empty($image)){
           if($image_size > 2000000){
              $message[] = 'image file size is too large!';
           }else{
              mysqli_query($konek, "UPDATE `produk` SET gambar_produk = '$image' WHERE id_produk = '$update_p_id'") or die('query failed');
              move_uploaded_file($image_tmp_name, $image_folter);
              unlink('img/'.$old_image);
              $message[] = 'image updated successfully!';
           }
        }
        $_SESSION['status'] = "Produk berhasil diupdate!";
        $_SESSION['status_code'] = "success";
        // $message[] = 'product updated successfully!';
    }

     
    if(isset($_POST['HapusProduk'])){
        $delete_id = $_POST['delete_id'];
        mysqli_query($konek, "DELETE FROM `produk` WHERE id_produk = '$delete_id'") or die('query failed');
        mysqli_query($konek, "DELETE FROM `keranjang` WHERE id_produk = '$delete_id'") or die('query failed');
        $select_delete_image = mysqli_query($konek, "SELECT gambar_produk FROM `produk` WHERE id_produk = '$delete_id'") or die('query failed');
        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        // unlink('img/'.$fetch_delete_image['image']);
        $_SESSION['status'] = "Produk berhasil dihapus!";
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
                    <li class="nav-item"><a class="nav-link active" href="admin_produk.php">Produk</a></li>
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
            <img width="100%" src="img/produk .png">
        </div>
    </section>

    <section id="addproduct">
        <div class="container">
            <button type="button" class="btn btn-primary btnload col-md-4 offset-md-4 mb-3" data-bs-toggle="modal" data-bs-target="#tambahProduk">Tambah Produk</button>
        </div>
    </section>

    <div class="modal fade" id="tambahProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                    <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="NamaProduk">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Harga Produk</label>
                            <input type="number" class="form-control" name="HargaProduk">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Berat Produk (gram)</label>
                            <input type="number" class="form-control" name="berat">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                            <textarea type="text" class="form-control" name="deskripsi"></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Diskon (%)</label>
                            <input type="number" class="form-control" name="diskon">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Khas</label>
                            <input type="text" class="form-control" name="khas">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stok">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Total Penjualan</label>
                            <input type="number" class="form-control" name="total">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Asal Wilayah</label>
                            <input type="text" class="form-control" name="asal">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Masa Penyimpanan</label>
                            <input type="text" class="form-control" name="masa">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">No. Izin Edar</label>
                            <input type="text" class="form-control" name="izin_edar">
                        </div>
                        <div class="mb-2">
                            <label for="formFile" class="form-label">Gambar Produk</label>
                            <input class="form-control" type="file" accept="image/jpg, image/jpeg, image/png" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn2 btn-primary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="TambahProduk">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <section class="" id="produk">
        <div class="container px-4 px-lg-5 mt-1 py-3 border-top">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center mt-4">

                <?php
                $select_products = mysqli_query($konek, "SELECT * FROM `produk` order by id_produk DESC") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
                ?>
                
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#lihatProduk<?= $fetch_products['id_produk'] ?>">
                               <img class="card-img-top" src="img/<?php echo $fetch_products['gambar_produk']; ?>" alt="..." sizes="100%"  name="image"/>
                               
                            </a>

                            <div class="modal fade" id="lihatProduk<?= $fetch_products['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $fetch_products['nama_produk']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                              
                                        <div class="modal-body">
                                            <div class="mb-2 h-50">
                                                <img class="card-img-top1" src="img/<?php echo $fetch_products['gambar_produk']; ?>" alt="..." sizes="50%"/>
                                            </div>
                                            <div class="mb-2">
                                                <p>
                                                <strong>Harga : </strong><span><?php echo $fetch_products['harga_produk']; ?> </span><br>
                                                <strong>Berat : </strong><span><?php echo $fetch_products['berat_produk']; ?> gram </span><br>
                                                <strong>Deskripsi : </strong><span><?php echo $fetch_products['deskripsi_produk']; ?> </span><br>
                                                <strong>Diskon : </strong><span><?php echo $fetch_products['diskon_produk']; ?> % </span><br>
                                                <strong>Khas : </strong><span><?php echo $fetch_products['khas_produk']; ?> </span><br>
                                                <strong>Stok : </strong><span><?php echo $fetch_products['stok_produk']; ?> </span><br>
                                                <strong>Total penjualan : </strong><span><?php echo $fetch_products['total_penjualan']; ?></span><br>
                                                <strong>Asal Wilayah : </strong><span><?php echo $fetch_products['asal_wilayah']; ?></span> <br>
                                                <strong>Masa  penyimpanan: </strong><span><?php echo $fetch_products['masa_penyimpanan']; ?> </span><br>
                                                <strong>Nomor izin edar : </strong><span><?php echo $fetch_products['no_izin_edar']; ?> </span><br></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn2 btn-primary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $fetch_products['nama_produk']; ?></h5>
                            
                                    <!-- Product price-->
                                    Stok <?php echo $fetch_products['stok_produk']; ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <input type="hidden" name="id_produk" value="<?php echo $fetch_products['id_produk']; ?>">
                                <input type="hidden" name="nama_produk" value="<?php echo $fetch_products['nama_produk']; ?>">
                                <input type="hidden" name="harga_produk" value="<?php echo $fetch_products['harga_produk']; ?>">

                                
                                
                                <a href="editproduk.php?update=<?php echo $fetch_products['id_produk']; ?>" class="btn btn22 btn-outline-secondary mt-2 col-12">Edit</a>
                                <a href="#" class="btn btn23 btn-outline-secondary mt-2 col-12" data-bs-toggle="modal" data-bs-target="#hapusProduk<?= $fetch_products['id_produk'] ?>">Hapus</a>
                                <!-- <button type="submit" class="btn btn22 btn-outline-secondary mt-2 col-12" name="edit" data-bs-toggle="modal" data-bs-target="#tambahProduk">Edit</button> -->
                                <!-- <button class="btn btn22 btn-outline-secondary mt-2 col-12" name="add_to_cart">Delete</button> -->



                                <div class="modal fade" id="hapusProduk<?= $fetch_products['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="delete_id" value="<?php echo $fetch_products['id_produk']; ?>">
                                                    <div class="mb-2">
                                                        <h5>Apakah anda yakin ingin menghapus produk ini?</h5>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn2 btn-primary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-hapus btn-primary" name="HapusProduk">Hapus</button>
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
                    echo '<p class="empty">Belum ada produk yang ditambahkan!</p>';
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
