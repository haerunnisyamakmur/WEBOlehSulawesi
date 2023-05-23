<?php

  @include 'koneksi.php';

  session_start();

  if(isset($_POST['submit'])){

    $filter_email = filter_var($_POST['admin_email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($konek, $filter_email);
    $filter_pass = filter_var($_POST['admin_pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($konek, md5($filter_pass));

    $select_users = mysqli_query($konek, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');

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
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css" type="text/css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
</head>
<body class="login">
    <div class="container" style="min-height: 100vh; justify-content: center; align-items: center; display: flex;">
      <div class="row col-lg-5">
          <div class="justify-content-center border border-secondary border-3 pt-4 align-items-center">
            <h3 class="text-center mb-4 mt-3">LOGIN ADMIN</h3>
            <form action="" method="post">

              <div class="m-4">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" name="admin_email" required>
              </div>

              <div class="m-4">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input type="password" class="form-control" name="admin_pass" required>
              </div>

              <div class="m-4">
                <button class="btn btn-primary w-100" type="submit" name="submit">Login</button>
              </div>

            </form>
            <h6 class="text-center mb-4 pt-3">Belum memiliki akun? <a class="text-decoration-none" href="admin_register.php"><strong>Register</strong></a></h6>

            <!-- <h3 class="text-center mt-5" style="color:#4c4941;">OR</h3> -->
            <h3 class="text-center mt-4" style="color:#4c4941;"><hr></h3>

            <div class="m-4">
              <a href="admin_home.php"><button class="btn btn-primary w-100 btnload" type="submit" name="submit">Kembali</button></a>
            </div>
        </div>
      </div>
    </div>

    
    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <?php @include 'alert.php'; ?>
  </body>
</html>