<?php
require_once 'koneksi.php';
// header("Content-Type: application/json; charset=UTF-8");

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM user where email = '$email'";

$eksekusi = mysqli_query($konek, $query);
$response = [];

if (mysqli_num_rows($eksekusi)>0) {
    $resultant = mysqli_query($konek, "SELECT id_user, username, email, notelp, foto_user FROM user WHERE email = '$email' AND password = '$password'");
    
    
    if (mysqli_num_rows($resultant)>0){
        while($row=$resultant->fetch_assoc()){
            $response['user'] = $row;
        }
        $response['kode'] = '1';
        $response['pesan'] = 'Login Berhasil';
    } else {
        $response['user'] = (object)[];
        $response['kode'] = '0';
        $response['pesan'] = 'Login Gagal';
    }
} else{
    $response['user'] = (object)[];
    $response['kode'] = '0';
    $response['pesan'] = 'User tidak ditemukan';
}

echo json_encode($response);
mysqli_close($konek);















// <?php
// require_once 'koneksi.php';
// // header("Content-Type: application/json; charset=UTF-8");

// $email = $_POST['email'];
// $password = $_POST['password'];

// $query = "SELECT * FROM user where email = '$email' AND password = '$password'";

// $eksekusi = mysqli_query($konek, $query);
// $response = [];
// // $row = mysqli_num_rows($eksekusi);
// $data_row = mysqli_fetch_assoc($eksekusi);

// if (mysqli_num_rows($eksekusi)>0) {
//     $response['kode'] = '1';
//     $response['pesan'] = 'Login Berhasil';
//     $response['data'] = $data_row;
// } else {
//     $response['kode'] = '0';
//     $response['pesan'] = 'User tidak ditemukan';
//     $response['data'] = $data_row;
// }
// // $json = json_encode($response, JSON_PRETTY_PRINT);
// // echo $json;

// echo json_encode($response);
// mysqli_close($konek);
