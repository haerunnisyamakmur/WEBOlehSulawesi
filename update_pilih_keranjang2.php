<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_user = $_POST["id_user"];
    $pilih = $_POST["pilih"];

    
    
    $perintah = "UPDATE keranjang SET pilih = '$pilih' WHERE id_user = '$id_user'";
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