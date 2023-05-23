<?php

@include 'koneksi.php';

if(isset($_POST['submit'])){

  //  $filter_id = filter_var($_POST['id_karyawan'], FILTER_SANITIZE_STRING);
  //  $id_karyawan = mysqli_real_escape_string($conn, ($filter_id)); 
   $filter_name = filter_var($_POST['admin_username'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($konek, $filter_name);
   $filter_email = filter_var($_POST['admin_email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($konek, $filter_email);
   $filter_number = filter_var($_POST['admin_number'], FILTER_SANITIZE_STRING);
   $number = mysqli_real_escape_string($konek, $filter_number);
   $filter_pass = filter_var($_POST['admin_pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($konek, md5($filter_pass));
   $filter_pass2 = filter_var($_POST['admin_pass2'], FILTER_SANITIZE_STRING);
   $pass2 = mysqli_real_escape_string($konek, md5($filter_pass2));

   $select_users = mysqli_query($konek, "SELECT * FROM `admin` WHERE nama = '$name'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $_SESSION['status'] = "Akun telah terdaftar!";
      $_SESSION['status_code'] = "error";
      // $message[] = 'user already exist!';
   }else{
      if($pass != $pass2){
         $_SESSION['status'] = "Konfirmasi password salah!";
         $_SESSION['status_code'] = "error";
        //  $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($konek, "INSERT INTO `admin`(nama, email, notelp, password) VALUES('$name', '$email', '$number', '$pass')") or die('query failed');
         $_SESSION['status'] = "Berhasil Register!";
         $_SESSION['status_code'] = "success";
        //  header('location:admin_login.php');
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account - Admin</title>
    <script src="https://kit.fontawesome.com/9fac50fda5.js" crossorigin="anonymous"></script>  
    <link rel="stylesheet" href="style.css" type="text/css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
</head>
<body class="login">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

    <div class="container" style="min-height: 100vh; justify-content: center; align-items: center; display: flex;">
      <div class="row col-lg-5">
          <div class="justify-content-center border border-secondary border-3 pt-4 align-items-center">
            <h3 class="text-center mb-4">REGISTER ADMIN</h3>
            <form action="" method="post">
              <!-- <div class="col-12 p-2">
                <div class="input-group has-validation">
                  <span class="input-group-text"><i class="fa-regular fa-id-badge"></i></span><div></div>
                  <input type="text" class="form-control" name="id_karyawan" placeholder="ID Karyawan" required>
                  <div class="invalid-feedback">
                      Your username is required.
                  </div>
                </div>
              </div> -->

              <div class="col-12 p-2">
                <div class="input-group has-validation">
                  <span class="input-group-text"><i class="fa-solid fa-user"></i></span><div></div>
                  <input type="text" class="form-control" name="admin_username" placeholder="Username" required>
                  <!-- <div class="invalid-feedback">
                      Your username is required.
                  </div> -->
                </div>
              </div>

              <div class="col-12 p-2">
                <div class="input-group has-validation">
                  <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span><div></div>
                  <input type="email" class="form-control" name="admin_email" placeholder="Email" required>
                  <!-- <div class="invalid-feedback">
                      Your username is required.
                  </div> -->
                </div>
              </div>

              <div class="col-12 p-2">
                <div class="input-group has-validation">
                  <span class="input-group-text"><i class="fa-solid fa-phone"></i></span><div></div>
                  <input type="text" class="form-control" name="admin_number" placeholder="No Telepon" required>
                  <!-- <div class="invalid-feedback">
                      Your username is required.
                  </div> -->
                </div>
              </div>

              <div class="col-12 p-2">
                <div class="input-group has-validation">
                  <span class="input-group-text"><i class="fa-solid fa-key"></i></span><div></div>
                  <input type="password" class="form-control" name="admin_pass" placeholder="Password" required>
                  <!-- <div class="invalid-feedback">
                      Your username is required.
                  </div> -->
                </div>
              </div>

              <div class="col-12 p-2">
                <div class="input-group has-validation">
                  <span class="input-group-text"><i class="fa-solid fa-key"></i></span> <div></div>
                  <input type="password" class="form-control" name="admin_pass2" placeholder="Konfirmasi Password" required>
                  <!-- <div class="invalid-feedback">
                      Your username is required.
                  </div> -->
                </div>
              </div>


              <div class="col-12 p-2">
                <button class="btn btn-primary justify-content-center w-100" type="submit" name="submit">Register</button>
              </div>
            </form>
            <h6 class="text-center mb-4 pt-3">Sudah memiliki akun? <a class="text-decoration-none" href="admin_login.php"><strong>Login<strong></a></h6>

            <h3 class="text-center mt-4" style="color:#4c4941;"><hr></h3>

            <div class="m-4">
              <a href="admin_home.php"><button class="b tn btn-primary w-100 btnload" type="submit" name="submit">Kembali</button></a>
            </div>
        </div>
      </div>
    </div>

    
    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <?php @include 'alert.php'; ?>
  </body>
</html>