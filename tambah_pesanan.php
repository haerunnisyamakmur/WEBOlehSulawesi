<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_user = $_POST["id_user"];
    $username = $_POST["username"];
    $notelp = $_POST["notelp"];
    $alamat = $_POST["alamat"];
    $total_belanja = $_POST["total_belanja"];
    $total_diskon = $_POST["total_diskon"];
    $metode_pembayaran = $_POST["metode_pembayaran"];
    $kode_pembayaran = $_POST["kode_pembayaran"];
    $catatan = $_POST["catatan"];


    $sql1 = "INSERT INTO pesanan (id_user, username, notelp, alamat, total_belanja, total_diskon, metode_pembayaran, kode_pembayaran, catatan) VALUES ('$id_user', '$username', '$notelp', '$alamat', '$total_belanja', '$total_diskon', '$metode_pembayaran', '$kode_pembayaran', '$catatan')";
    mysqli_query($konek, $sql1);
    
    $sql2 = "SET @id_pesanan = LAST_INSERT_ID()";
    mysqli_query($konek, $sql2);
    
    $sql3 = "INSERT INTO detail_pesanan (id_pesanan, id_produk, id_user, nama, harga_asli, jumlah) 
         SELECT @id_pesanan AS id_pesanan, id_produk, id_user, nama, harga_asli, jumlah 
         FROM keranjang WHERE pilih ='1' AND id_user ='$id_user'";
    mysqli_query($konek, $sql3);

    $sql4 = "DELETE FROM keranjang WHERE id_user = '$id_user' AND pilih ='1'";
    mysqli_query($konek, $sql4);
    
    
    
    
    $select_jumlahpesanan = mysqli_query($konek, "SELECT * FROM `detail_pesanan` WHERE id_pesanan = @id_pesanan") or die('query failed');
        if(mysqli_num_rows($select_jumlahpesanan) > 0){
            while($fetch_jumlah_pesanan = mysqli_fetch_assoc($select_jumlahpesanan)){
                $id_produkpesan = $fetch_jumlah_pesanan['id_produk'];
                $jumlah_produkpesan = $fetch_jumlah_pesanan['jumlah'];

                $select_produk = mysqli_query($konek, "SELECT * FROM `produk` WHERE id_produk = '$id_produkpesan'") or die('query failed');
                if(mysqli_num_rows($select_produk) > 0){
                    while($fetch_produk = mysqli_fetch_assoc($select_produk)){
                        $stok_sekarang = $fetch_produk['stok_produk'];
                        $stok_ubah = $stok_sekarang - $jumlah_produkpesan;

                        $total_terjual = $fetch_produk['total_penjualan'] + $jumlah_produkpesan;

                        mysqli_query($konek, "UPDATE `produk` SET stok_produk = '$stok_ubah', total_penjualan = '$total_terjual' WHERE id_produk = '$id_produkpesan'") or die('query failed');
                    }
                }
            }
        }


}
mysqli_close($konek);

