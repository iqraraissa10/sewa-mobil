<?php
  session_start();
  if(!isset($_SESSION["username"])){
  header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
  body {
      background-image: url('mbl.jpeg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position-y: -100px;
  }
</style>
<body>
    <div class="container shadow my-3 px-5 bg-white">
        <div class="row">
          <div class="col-12">
              <h1 class="pt-3">Penyewaan Mobil</h1>
              <hr>
          </div>
          <div class="col-md-6 mt-2">
            <ul class="nav nav-pills pb-2">
                <li class="nav-item">
                  <a href="tampil_pelanggan.php" class="nav-link">Pelanggan</a>
                </li>
                <li class="nav-item">
                  <a href="tambah_pelanggan.php" class="nav-link">Tambah</a>
                </li>
                <li class="nav-item">
                  <a href="edit_pelanggan.php" class="nav-link">Edit</a>
                </li>
                <li class="nav-item">
                  <a href="hapus_pelanggan.php" class="nav-link active">Hapus</a>
                </li>
                <li class="nav-item">
                  <a href="logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
          </div>
        </div>
    </div>
    <!--Table Data Pelanggan-->
    <div class="container shadow bg-white px-5">
        <div class="row">
          <div class="col-12 py-4">
            <?php
              if(isset($pesan)) {
                echo "<div class='alert alert-success shadow'>$pesan</div>";
              }
            ?>
            <table class="table">
              <tr>
                <th>No</th>
                <th>KTP</th>
                <th>SIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Edit</th>
              </tr>
                <?php
                  require_once 'koneksi.php';
                  $query = "select * from pelanggan";
                  $result = mysqli_query($con,$query);
                  if($result) {
                    $no=1;
                    while($data = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>".$no++."</td>";
                      echo "<td>$data[ktp]</td>";
                      echo "<td>$data[sim]</td>";
                      echo "<td>$data[nama]</td>";
                      echo "<td>$data[alamat]</td>";
                      echo "<td>$data[no_telp]</td>";
                      echo "<td>";
                ?>
                <form action="form_hapus.php?id=<?php echo "$data[ktp]";?>" method="post">
                  <input type="hidden" name="ktp" value="<?php echo "$data[ktp]";?>">
                  <input type="submit" name="Hapus" value="Hapus"/>
                </form>
                <?php
                  echo "</td>";
                  echo "</tr>";
                    }
                  }
                ?>
            </table>
          </div>
        </div>
    </div>
    
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/popper.js"></script>   
    <script src="js/bootstrap.js"></script>
</body>
</html>