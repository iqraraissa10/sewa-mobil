<?php
    require_once 'koneksi.php';
    if(isset($_POST['submit'])) {
        $username = strip_tags(trim($_POST['username']));
        $password = strip_tags(trim($_POST['password']));

        //siapkan variabel untuk pesan error
        $pesan_error = "";
        if(empty($username)) {
            $pesan_error = "Username belum diisi <br>";
        }
        if(empty($password)) {
            $pesan_error .= "Password belum diisi";
        }

        if(empty($pesan_error)) {
          $query = "select * from user where username ='$username' and password='$password'";
          $result = mysqli_query($con,$query);

          if(mysqli_num_rows($result) == 0) {
            $pesan_error = "Username dan/atau Password salah";
          }
          else {
            header("Location: form_sewa.php");
          }
        }
    }
    else {
        $username = "";
        $password = "";
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
          background: #e5e5e5;
      }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
              <div class="card bg-white shadow mt-5 border border-light">
                <h3 class="card-header bg-primary text-center text-white">User Login</h3>
                <div class="card-body">
                    <?php if($pesan_error != "") {
                        echo "<p class='text-danger pb-3'>$pesan_error</p>";
                    }
                    ?>
                    <form action="login.php" method="post">
                      <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" name="username" id="Username" class="form-control" value="<?php $username;?>">
                      </div>
                      <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" name="password" id="Password" class="form-control" value="<?php $password;?>">
                      </div>
                      <input type="submit" name="submit" value="Login" class="btn btn-block btn-primary">
                      <p class="text-center pt-3"><a href="register.php" class="bg-success text-white p-2 rounded">Create a new Account</a></p>
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
