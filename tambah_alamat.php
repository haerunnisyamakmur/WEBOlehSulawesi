<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_user = $_POST["id_user"];
    $username = $_POST["username"];
    $notelp = $_POST["notelp"];
    $provinsi = $_POST["provinsi"];
    $kota = $_POST["kota"];
    $kecamatan = $_POST["kecamatan"];
    $kodepos = $_POST["kodepos"];
    $alamatdetail = $_POST["alamatdetail"];

    $perintah = "INSERT INTO alamat (id_user, username, notelp, provinsi, kota, kecamatan, kodepos, alamatdetail) VALUES('$id_user', '$username', '$notelp', '$provinsi', '$kota', '$kecamatan', '$kodepos', '$alamatdetail')";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["status"] = "Alamat berhasil ditambahkan";
    } else{
        $response["kode"] = 0;
        $response["status"] = "Alamat gagal ditambahkan";
    }

}
else{
    $response["kode"] = 0;
    $response["status"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);