<?php
    
    if(isset($_POST['submit'])) {
        $username = strip_tags(trim($_POST['username']));
        $password = strip_tags(trim($_POST['password']));
        $rePassword = strip_tags(trim($_POST['repassword']));

        //siapkan variabel untuk pesan error
        $pesan_error = "";
        if(empty($username)) {
            $pesan_error = "Username belum diisi <br>";
        }
        if(empty($password)) {
            $pesan_error .= "Password belum diisi <br>";
        }
        if($password != $rePassword) {
            $pesan_error .= "Konfirmasi password tidak sama";
        }

        if(empty($pesan_error)) {
          require_once 'koneksi.php';
          $query = "insert into user values('$username','$password')";
          $result = mysqli_query($con,$query);

            $pesan = "Akun dengan username '<b>$username</b>' berhasil di buat";
            $pesan = urlencode($pesan);
            header("Location: login.php?s={$pesan}");
        }
    }
    else {
        $username = "";
        $password = "";
        $rePassword = "";
        $pesan_error = "";
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" width="device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
      body {
          background-image: url('mbl.jpeg');
          background-repeat: no-repeat;
          background-size: cover;
      }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
              <div class="card bg-white shadow mt-5 border border-light">
                <h3 class="card-header bg-danger text-center text-white">Register</h3>
                <div class="card-body">
                    <?php if($pesan_error != "") {
                        echo "<p class='text-danger pb-3'>$pesan_error</p>";
                    }
                    ?>
                    <form action="register.php" method="post">
                      <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" name="username" id="Username" class="form-control" value="<?php echo $username;?>">
                      </div>
                      <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" name="password" id="Password" class="form-control" value="<?php echo $password;?>">
                      </div>
                      <div class="form-group">
                        <label for="rePassword">Konfirm Password</label>
                        <input type="password" name="repassword" id="rePassword" class="form-control" value="<?php echo $rePassword;?>">
                      </div>
                      <input type="submit" name="submit" value="Regist" class="btn btn-block btn-danger">
                      <p class="text-center pt-3">Have an Account ? <a href="login.php" class="text-info">Login</a></p>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/popper.js"></script>   
    <script src="js/bootstrap.js"></script>
</body>
</html>
