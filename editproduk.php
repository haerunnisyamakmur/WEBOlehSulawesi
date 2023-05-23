<?php
    @include 'koneksi.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
    header('location:admin_login.php');
    };

    if(isset($_POST['edit'])){

        $update_p_id = $_POST['update_p_id'];
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
        header('location:admin_produk.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <script src="https://kit.fontawesome.com/9fac50fda5.js" crossorigin="anonymous"></script>  
    <link rel="stylesheet" href="style.css" type="text/css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	  <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/checkout/"> -->
    <script src="dist/sweetalert2.all.min.js"></script>
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

    <div class="container mt-5 mb-5 text-center">
        <h1 class="row col-md-12 mt-5" style="color:white;">EDIT PRODUK</h1>
    </div>
    <div class="container">
        <?php
            $update_id = $_GET['update'];
            $select_products = mysqli_query($konek, "SELECT * FROM `produk` WHERE id_produk = '$update_id'") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
        ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mt-5 mb-5">
                <div class="col-md-4 mt-4">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" value="<?php echo $fetch_products['nama_produk']; ?>" name="NamaProduk">
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Harga Produk</label>
                        <input type="number" class="form-control" value="<?php echo $fetch_products['harga_produk']; ?>" name="HargaProduk">
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Berat Produk (gram)</label>
                        <input type="number" class="form-control" value="<?php echo $fetch_products['berat_produk']; ?>" name="berat">
                    </div>
                    <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                            <textarea row="4" type="text" class="form-control" value="<?php echo $fetch_products['deskripsi_produk']; ?>" name="deskripsi"><?php echo $fetch_products['deskripsi_produk']; ?></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Diskon (%)</label>
                            <input type="number" class="form-control" value="<?php echo $fetch_products['diskon_produk']; ?>" name="diskon">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Khas</label>
                            <input type="text" class="form-control" value="<?php echo $fetch_products['khas_produk']; ?>" name="khas">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Stok</label>
                            <input type="number" class="form-control" value="<?php echo $fetch_products['stok_produk']; ?>" name="stok">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Total Penjualan</label>
                            <input type="number" class="form-control" value="<?php echo $fetch_products['total_penjualan']; ?>" name="total">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Asal Wilayah</label>
                            <input type="text" class="form-control" value="<?php echo $fetch_products['asal_wilayah']; ?>" name="asal">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Masa Penyimpanan</label>
                            <input type="text" class="form-control" value="<?php echo $fetch_products['masa_penyimpanan']; ?>" name="masa">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">No. Izin Edar</label>
                            <input type="text" class="form-control" value="<?php echo $fetch_products['no_izin_edar']; ?>" name="izin_edar">
                        </div>
                    <div class="mb-2">
                        <label for="formFile" class="form-label">Gambar Produk</label>
                        <input class="form-control" type="file" accept="image/jpg, image/jpeg, image/png" name="image">
                    </div>
                    <input type="hidden" value="<?php echo $fetch_products['id_produk']; ?>" name="update_p_id">
                    <input type="hidden" value="<?php echo $fetch_products['gambar_produk']; ?>" name="update_p_image">
                    <hr class="my-4">
                    <a href="admin_produk.php" class="btn btn-hapus btn-primary col-4 btn-md">KEMBALI</a>
                    <button type="submit" class="btn btn-primary btnload col-4" name="edit">EDIT</button>
                </div>
                <div class="col-md-7 mt-4">
                    <img src="img/<?php echo $fetch_products['gambar_produk']; ?>" alt="" sizes="100%" class="col-md-12">
                </div>
            
                <?php
                    }
                } else{
                ?>
                    <div class="card p-5 text-center mb-5 mt-4">Tidak ada produk yang dipilih<div>
                <?php
                    }
                ?>
            </div>
        </form>
    </div>

    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="form-validation.js"></script>
</body>
</html>