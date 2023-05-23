<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id_user = $_GET["id_user"];

    $perintah = "SELECT * FROM alamat WHERE id_user = '$id_user'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";
        $response["data"] = array();

        while($ambil = mysqli_fetch_object($eksekusi)){
            $F["id_alamat"] = $ambil->id_alamat;
            $F["id_user"] = $ambil->id_user;
            $F["username"] = $ambil->username;
            $F["notelp"] = $ambil->notelp;
            $F["provinsi"] = $ambil->provinsi;
            $F["kota"] = $ambil->kota;
            $F["kecamatan"] = $ambil->kecamatan;
            $F["kodepos"] = $ambil->kodepos;
            $F["alamatdetail"] = $ambil->alamatdetail;

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