<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_keranjang = $_POST["id_keranjang"];
    $jumlah = $_POST["jumlah"];

    
    
    $perintah = "UPDATE keranjang SET jumlah = '$jumlah' WHERE id_keranjang = '$id_keranjang'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Berhasil Diubah";
    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Data Gagal Diubah";
    }
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($konek);