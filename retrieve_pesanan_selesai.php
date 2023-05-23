<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id_user = $_GET["id_user"];

    $perintah = "SELECT * FROM pesanan WHERE id_user = '$id_user' AND status_pemesanan = 'Selesai' ORDER BY id_pesanan DESC";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";
        $response["data"] = array();

        while($ambil = mysqli_fetch_object($eksekusi)){
            $F["id_pesanan"] = $ambil->id_pesanan;
            $F["id_user"] = $ambil->id_user;
            $F["username"] = $ambil->username;
            $F["notelp"] = $ambil->notelp;
            $F["alamat"] = $ambil->alamat;
            $F["total_belanja"] = $ambil->total_belanja;
            $F["total_diskon"] = $ambil->total_diskon;
            $F["tanggal_pemesanan"] = $ambil->tanggal_pemesanan;
            $F["tanggal_pembayaran"] = $ambil->tanggal_pembayaran;
            $F["tanggal_pengiriman"] = $ambil->tanggal_pengiriman;
            $F["tanggal_selesai"] = $ambil->tanggal_selesai;
            $F["status_pembayaran"] = $ambil->status_pembayaran;
            $F["metode_pembayaran"] = $ambil->metode_pembayaran;
            $F["kode_pembayaran"] = $ambil->kode_pembayaran;
            $F["catatan"] = $ambil->catatan;
            $F["status_pemesanan"] = $ambil->status_pemesanan;
            $F["bukti_pembayaran"] = $ambil->bukti_pembayaran;

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