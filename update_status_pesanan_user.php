<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_pesanan = $_POST["id_pesanan"];

    $sql = "UPDATE pesanan SET status_pemesanan = 'Selesai', tanggal_selesai = NOW()  WHERE id_pesanan = '$id_pesanan'";

    $eksekusi = mysqli_query($konek, $sql);
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