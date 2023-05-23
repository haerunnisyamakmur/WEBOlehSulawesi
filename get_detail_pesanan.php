<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_pesanan = $_POST["id_pesanan"];

    $perintah = "SELECT * FROM detail_pesanan where id_pesanan = '$id_pesanan'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek      = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";
        $response["data"] = array();

        while($ambil = mysqli_fetch_object($eksekusi)){
            $F["id_pesanan"] = $ambil->id_pesanan;
            $F["id_user"] = $ambil->id_user;
            $F["id_produk"] = $ambil->id_produk;
            $F["nama"] = $ambil->nama;
            $F["harga_asli"] = $ambil->harga_asli;
            $F["jumlah"] = $ambil->jumlah;
            
            array_push($response["data"], $F);
            
        }
    }


    else{
        $response["kode"] = 0;
        $response["pesan"] = "Data Tidak Tersedia";
    }
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($konek);