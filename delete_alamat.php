<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_alamat = $_POST["id_alamat"];
    
    $perintah = "DELETE FROM alamat WHERE id_alamat = '$id_alamat'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek      = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Alamat berhasil dihapus";
    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Gagal menghapus alamat";
    }
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($konek);