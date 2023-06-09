<?php
require("koneksi.php");
$perintah = "SELECT * FROM keranjang ORDER BY id_keranjang DESC";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_affected_rows($konek);

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
        $F["jumlah"] = $ambil->jumlah;
        $F["gambar"] = $ambil->gambar;
        
        array_push($response["data"], $F);
        
    }
    
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Data Tidak Tersedia";
}

echo json_encode($response);
mysqli_close($konek);