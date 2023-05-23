<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_user = $_POST["id_user"];

    
    
    $perintah = "SELECT COUNT(*) AS total_rows FROM keranjang WHERE id_user = '$id_user'";
    $eksekusi = mysqli_query($konek, $perintah);
    
    $perintah1 = "SELECT COUNT(*) AS total_rows2 FROM keranjang WHERE id_user = '$id_user' AND pilih = '1'";
    $eksekusi1 = mysqli_query($konek, $perintah1);

    $perintah2 = "SELECT COUNT(*) AS total_rows3 FROM keranjang WHERE id_user = '$id_user' AND pilih = '0'";
    $eksekusi2 = mysqli_query($konek, $perintah2);


    $data = mysqli_fetch_assoc($eksekusi);
    $total_rows = $data['total_rows'];
    
    $data1 = mysqli_fetch_assoc($eksekusi1);
    $total_rows2 = $data1['total_rows2'];

    $data2 = mysqli_fetch_assoc($eksekusi2);
    $total_rows3 = $data2['total_rows3'];
    
    if ($total_rows == $total_rows2) {
        $response["kode"] = 1;
        $response["pesan"] = "true";
    } else if ($total_rows == $total_rows3){
        $response["kode"] = 2;
        $response["pesan"] = "false";
    } else {
        $response["kode"] = 3;
        $response["pesan"] = "null";
    }
    
        
}

echo json_encode($response);
mysqli_close($konek);