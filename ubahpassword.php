<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_user = $_POST["id_user"];
    $passlama = $_POST["password"];
    $passbaru = $_POST["passbaru"];
    $passkonfirmasi = $_POST["passkonfirmasi"];

    $CekUser = mysqli_query($konek, "SELECT * FROM user where id_user = '$id_user'");

    if(mysqli_num_rows($CekUser)>0){
        $fetch_user = mysqli_fetch_assoc($CekUser);
        if ($passlama != $fetch_user['password']){
            $response["kode"] = 0;
            $response["pesan"] = "Password lama tidak sesuai";
        } else if ($passbaru != $passkonfirmasi){
            $response["kode"] = 0;
            $response["pesan"] = "Konfirmasi password tidak sesuai";
        } else {
            $eksekusi = mysqli_query($konek, "UPDATE user SET password = '$passbaru' WHERE id_user = '$id_user'");
            $cek = mysqli_affected_rows($konek);

            if($cek > 0){
                $response["kode"] = 1;
                $response["pesan"] = "Password berhasil diubah";
            } else{
                $response["kode"] = 0;
                $response["pesan"] = "Password gagal diubah";
            }
        }
    }
} else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);
