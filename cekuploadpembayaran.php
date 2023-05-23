<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_pesanan = $_POST["id_pesanan"];

    $cekpenilaian = mysqli_query($konek, "SELECT * FROM pesanan WHERE bukti_pembayaran IS NULL AND id_pesanan = '$id_pesanan'");
    
    if (mysqli_num_rows($cekpenilaian)>0){
        $response["kode"] = 0;
        $response["status"] = "Anda belum mengupload bukti pembayaran";
    } else {
        $response["kode"] = 1;
        $response["status"] = "Anda sudah mengupload bukti pembayaran untuk pesanan ini";
    }
}
else{
    $response["kode"] = 3;
    $response["status"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);