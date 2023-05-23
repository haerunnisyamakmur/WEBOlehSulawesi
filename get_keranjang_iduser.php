<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_user = $_POST["id_user"];


    
    $perintah = "SELECT * FROM keranjang where id_user = '$id_user' ";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek      = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";
        $response["data"] = array();

        while($ambil = mysqli_fetch_object($eksekusi)){
            $F["id_keranjang"] = $ambil->id_keranjang;
            $F["id_user"] = $ambil->id_user;
            $F["id_produk"] = $ambil->id_produk;
            $F["nama"] = $ambil->nama;
            $F["harga"] = $ambil->harga;
            $F["harga_asli"] = $ambil->harga_asli;
            $F["jumlah"] = $ambil->jumlah;
            $F["gambar"] = $ambil->gambar;
            $F["pilih"] = $ambil->pilih;
            
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