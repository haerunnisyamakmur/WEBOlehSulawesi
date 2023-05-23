<?php
require("koneksi.php");
$perintah = "SELECT * FROM cabang ORDER BY id_cabang DESC";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_affected_rows($konek);

if($cek > 0){
    $response["kode"] = 1;
    $response["pesan"] = "Data Tersedia";
    $response["data"] = array();

    while($ambil = mysqli_fetch_object($eksekusi)){
        $F["id"] = $ambil->id_cabang;
        $F["nama"] = $ambil->nama_cabang;
        $F["alamat"] = $ambil->alamat_cabang;
        $F["buka"] = $ambil->jam_buka;
        $F["gambar"] = $ambil->gambar_cabang;
        $F["link"] = $ambil->link_cabang;
        
        array_push($response["data"], $F);
    }
    
}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Data Tidak Tersedia";
}

echo json_encode($response);
mysqli_close($konek);