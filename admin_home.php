<?php

  @include 'koneksi.php';

  session_start();

  if(isset($_POST['login'])){

    $filter_email = filter_var($_POST['admin_email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($konek, $filter_email);
    $filter_pass = filter_var($_POST['admin_pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($konek, md5($filter_pass));

    $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select_users) == 1){
      $row = mysqli_fetch_assoc($select_users);
        $_SESSION['admin_name'] = $row['nama'];
        $_SESSION['admin_email'] = $row['email'];
        $_SESSION['admin_id'] = $row['id_admin'];
        $_SESSION['status'] = "Berhasil login!";
        $_SESSION['status_code'] = "success";
        header('location:admin_index.php');
    } else{
        $_SESSION['status'] = "Email atau password salah!";
         $_SESSION['status_code'] = "error";
        // $message[] = 'incorrect email or password!';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olehSulawesi Admin Panel</title>
    <script src="https://kit.fontawesome.com/9fac50fda5.js" crossorigin="anonymous"></script>  
    <link rel="stylesheet" href="style.css" type="text/css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body class="homeadmin">
    <div class="container h-100">
        <h1 class="mt-5 mb-5">SELAMAT DATANG ADMIN</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mt-5 mb-5 justify-content-center">
                <div class="col-md-6">
                    <img src="img/toko.png" alt="" sizes="30%" class="col-md-12">
                </div>
                <div class="col-md-4 p-5">
                    <a href="admin_login.php" class="btn btn-primary btnload btn-lg col-10 m-5">LOGIN</a>
                    
                    <div class="m-3 col-md-12 text-center"><h1>OR</h1></div>
                    <a href="admin_register.php" class="btn btn-primary btnload btn-lg col-10 m-5">REGISTER</a>
                </div>
            </div>
        </form>
        
    </div>


    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
