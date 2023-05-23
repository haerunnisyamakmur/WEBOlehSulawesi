<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_user = $_POST["id_user"];
    $id_produk = $_POST["id_produk"];
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $harga_asli = $_POST["harga_asli"];
    $jumlah = $_POST["jumlah"];
    $gambar = $_POST["gambar"];

    $perintah = "INSERT INTO keranjang (id_user, id_produk, nama, harga, harga_asli, jumlah, gambar) VALUES('$id_user','$id_produk','$nama', '$harga','$harga_asli', '$jumlah', '$gambar')";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek      = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Simpan Data Berhasil";
    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Gagal Menyimpan Data";
    }
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($konek);