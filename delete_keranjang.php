<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_keranjang = $_POST["id_keranjang"];
    
    $perintah = "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek      = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Berhasil Dihapus";
    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Gagal Menghapus Data";
    }
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($konek);