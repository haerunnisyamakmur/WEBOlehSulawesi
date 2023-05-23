<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_user = $_POST["id_user"];
    $id_pesanan = $_POST["id_pesanan"];

    $cekpenilaian = mysqli_query($konek, "SELECT * FROM penilaian WHERE id_pesanan = '$id_pesanan'");
    
    if (mysqli_num_rows($cekpenilaian)>0){
        $response["kode"] = 0;
        $response["status"] = "Anda telah memberikan penilaian untuk pesanan ini";
    } else {
        $response["kode"] = 1;
        $response["status"] = "Anda dapat menambahkan penilaian";
    }
}
else{
    $response["kode"] = 0;
    $response["status"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);