<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $CekUser = mysqli_query($konek, "SELECT * FROM user where email = '$email' OR username='$username'");
    $CekUser1 = mysqli_query($konek, "SELECT * FROM user where email = '$email'");
    $CekUser2 = mysqli_query($konek, "SELECT * FROM user where username='$username'");

    if(mysqli_num_rows($CekUser)>0){
        if(mysqli_num_rows($CekUser1)>0){
            $response["kode"] = 0;
            $response["pesan"] = "Email telah terdaftar";
        } else if (mysqli_num_rows($CekUser2)>0){
            $response["kode"] = 0;
            $response["pesan"] = "Username telah digunakan";
        } else {
            
        }
        
    } else {
        $perintah = "INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password')";
        $eksekusi = mysqli_query($konek, $perintah);

        $cek = mysqli_affected_rows($konek);

        if($cek > 0){
            $response["kode"] = 1;
            $response["pesan"] = "Register berhasil";
        } else{
            $response["kode"] = 0;
            $response["pesan"] = "Register gagal";
        }
    }

}
else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak ada post data";
}

echo json_encode($response);
mysqli_close($konek);




// <?php
// require("koneksi.php");

// $response = array();

// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     $username = $_POST["username"];
//     $email = $_POST["email"];
//     $password = $_POST["password"];

//     $CekUser = mysqli_query($konek, "SELECT * FROM user where email = '$email'");
//     $CekUser = mysqli_query($konek, "SELECT * FROM user where username='$username'");

//     if(mysqli_num_rows($CekUser)>0){
//         $response["kode"] = 0;
//         $response["pesan"] = "Email telah terdaftar";
//     } else {
//         $perintah = "INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password')";
//         $eksekusi = mysqli_query($konek, $perintah);

//         $cek = mysqli_affected_rows($konek);

//         if($cek > 0){
//             $response["kode"] = 1;
//             $response["pesan"] = "Register berhasil";
//         } else{
//             $response["kode"] = 0;
//             $response["pesan"] = "Register gagal";
//         }
//     }

// }
// else{
//     $response["kode"] = 0;
//     $response["pesan"] = "Tidak ada post data";
// }

// echo json_encode($response);
// mysqli_close($konek);