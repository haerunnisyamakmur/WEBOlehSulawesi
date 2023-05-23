<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_user = $_POST["id_user"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $tanggal = $_POST["tanggal"];
    $message = $_POST["message"];

    $perintah = "INSERT INTO message (id_user, username, email, tanggal, message) VALUES('$id_user', '$username', '$email', '$tanggal', '$message')";
    $eksekusi = mysqli_query($konek, $perintah);

    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["status"] = "Pesan berhasil terkirim";
    } else{
        $response["kode"] = 0;
        $response["status"] = "Pesan gagal terkirim";
    }

}
else{
    $response["kode"] = 0;
    $response["status"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);