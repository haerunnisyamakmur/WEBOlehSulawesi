<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id_user = $_GET["id_user"];

    $perintah = "SELECT * FROM user WHERE id_user = '$id_user'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";
        $response["data"] = array();

        while($ambil = mysqli_fetch_object($eksekusi)){
            $F["id_user"] = $ambil->id_user;
            $F["username"] = $ambil->username;
            $F["email"] = $ambil->email;
            $F["notelp"] = $ambil->notelp;
            $F["password"] = $ambil->password;
            $F["foto_user"] = $ambil->foto_user;
            
            array_push($response["data"], $F);
        }
        
    }
    else{
        $response["kode"] = 0;
        $response["pesan"] = "Data Tidak Tersedia";
    }
} else {
    $response["kode"] = 0;
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);