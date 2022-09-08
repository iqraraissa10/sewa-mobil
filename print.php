<center><h1>SEWA MOBIL</h1></center>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<div class="container shadow bg-white px-5">
<div class="row">
<div class="col-12 py-4">    
<table class="table">
              <tr>
                <th>No</th>
                <th>KTP</th>
                <th>SIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
              </tr>
<?php
    session_start();
    if(!isset($_SESSION["username"])){
    header("Location: login.php");
    }
    
    ob_start();
    $dat = date_default_timezone_set("Asia/Jakarta");
    require_once 'koneksi.php';
    $ktp = $_GET["id"];
    $query = "select * from pelanggan where ktp =" . $ktp . ";";
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
                      echo "</tr>";
                    }
                    echo $dat;
                  }
                ?>
                </table>
                </div>
                </div>
                </div>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/popper.js"></script>   
    <script src="js/bootstrap.js"></script>
    <script> window.print(); </script>   
