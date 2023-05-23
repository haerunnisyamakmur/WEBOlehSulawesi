<?php
require("koneksi.php");
$perintah = "SELECT * FROM produk";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_affected_rows($konek);

if($cek > 0){
    $response["kode"] = 1;
    $response["pesan"] = "Data Tersedia";
    $response["data"] = array();

    while($ambil = mysqli_fetch_object($eksekusi)){
        $F["id"] = $ambil->id_produk;
        $F["nama"] = $ambil->nama_produk;
        $F["khas"] = $ambil->khas_produk;
        $F["harga"] = $ambil->harga_produk;
        $F["diskon"] = $ambil->diskon_produk;
        $F["gambar"] = $ambil->gambar_produk;
        $F["berat"] = $ambil->berat_produk;
        $F["deskripsi"] = $ambil->deskripsi_produk;
        $F["stok"] = $ambil->stok_produk;
        $F["penjualan"] = $ambil->total_penjualan;
        $F["wilayah"] = $ambil->asal_wilayah;
        $F["penyimpanan"] = $ambil->masa_penyimpanan;
        $F["izin_edar"] = $ambil->no_izin_edar;
        
        array_push($response["data"], $F);
    }
    
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Data Tidak Tersedia";
}

echo json_encode($response);
mysqli_close($konek);