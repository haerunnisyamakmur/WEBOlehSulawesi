<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_user = $_POST["id_user"];
    $id_pesanan = $_POST["id_pesanan"];
    $username = $_POST["username"];
    $tanggal = $_POST["tanggal"];
    $penilaian = $_POST["penilaian"];
    $rating = $_POST["rating"];

    $perintah = "INSERT INTO penilaian (id_user, id_pesanan, username, tanggal, penilaian, rating) VALUES('$id_user', '$id_pesanan', '$username', '$tanggal', '$penilaian', '$rating')";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["status"] = "Penilaian berhasil ditambahkan";
    } else{
        $response["kode"] = 0;
        $response["status"] = "Penilaian gagal ditambahkan";
    }
}
else{
    $response["kode"] = 0;
    $response["status"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);