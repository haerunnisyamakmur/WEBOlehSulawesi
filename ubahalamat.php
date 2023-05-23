<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_alamat = $_POST["id_alamat"];
    $username = $_POST["username"];
    $notelp = $_POST["notelp"];
    $provinsi = $_POST["provinsi"];
    $kota = $_POST["kota"];
    $kecamatan = $_POST["kecamatan"];
    $kodepos = $_POST["kodepos"];
    $alamatdetail = $_POST["alamatdetail"];

    $perintah = "UPDATE alamat SET username = '$username', notelp = '$notelp', provinsi = '$provinsi', kota = '$kota', kecamatan = '$kecamatan', kodepos = '$kodepos', alamatdetail = '$alamatdetail' WHERE id_alamat = '$id_alamat'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Alamat berhasil diubah";
    } else{
        $response["kode"] = 0;
        $response["pesan"] = "Alamat gagal diubah";
    }
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);