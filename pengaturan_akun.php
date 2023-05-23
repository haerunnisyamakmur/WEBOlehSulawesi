<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $notelp = $_POST['notelp'];

    $perintah = "UPDATE user SET username = '$username', email = '$email', notelp = '$notelp' WHERE id_user = '$id_user'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Ubah akun berhasil";
    } else{
        $response["kode"] = 0;
        $response["pesan"] = "Ubah akun gagal";
    }
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);

