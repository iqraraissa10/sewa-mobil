<?php
  session_start();
  if(!isset($_SESSION["username"])){
  header("Location: login.php");
  }
  
    ob_start();
    date_default_timezone_set("Asia/Jakarta");
    require_once 'koneksi.php';
    $array_bulan = [1=>"Januari",
                    2=>"Februari",
                    3=>"Maret",
                    4=>"April",
                    5=>"Mei",
                    6=>"Juni",
                    7=>"Juli",
                    8=>"Agustus",
                    9=>"September",
                    10=>"Oktober",
                    11=>"November",
                    12=>"Desember"];

    $array_mobil = [1=>"Avanza",
                    2=>"Kijang",
                    3=>"Honda Bria"];

    $query = "select nama_mobil from mobil";
    $result = mysqli_query($con,$query);

    if(isset($_POST['kirim'])) {
      $ktp = strip_tags(trim($_POST['ktp']));
      $sim = strip_tags(trim($_POST['sim']));
      $nama = strip_tags(trim($_POST['nama']));
      $alamat = strip_tags(trim($_POST['alamat']));
      $no_telp = strip_tags(trim($_POST['no_hp']));
      $tanggal = $_POST['tanggal'];
      $bulan = $_POST['bulan'];
      $tahun = $_POST['tahun'];
      $lama_sewa = $_POST['lama_sewa'];
      $mobil = $_POST['mobil'];

      $pesan_error="";
      //validasi untuk inputan ktp
      if(empty($ktp)) {
        $pesan_error = "Nomer KTP belum diisi <br>";
      }
      else if(strlen($ktp) != 16) {
        $pesan_error .= "Nomer KTP harus 16 digit <br>";
      }
      else if(preg_match("/\D/",$ktp)) {
        $pesan_error .= "Nomer KTP harus berupa angka <br>";
      }
      
      //validasi untuk inputan sim
      if(empty($sim)) {
        $pesan_error .= "Nomer SIM belum diisi <br>";
      }
      else if(strlen($sim) != 16) {
        $pesan_error .= "Nomer SIM harus 16 digit <br>";
      }
      else if(preg_match("/\D/",$sim)) {
        $pesan_error .= "Nomer SIM harus berupa angka <br>";
      }
      
      //validasi untuk inputan nama
      if(empty($nama)) {
        $pesan_error .= "Nama belum diisi <br>";
      }
      else if(preg_match("/\W/",$nama)) {
        $pesan_error .= "Nama harus diisi dengan huruf <br>";
      }
      //validasi untuk inputan alamat
      if(empty($alamat)) {
        $pesan_error .= "Alamat masih kosong <br>";
      }

      //validasi untuk inputan nomer hp
      if(empty($no_telp)) {
        $pesan_error .= "No HP masih kosong <br>";
      }
      else if(strlen($no_telp) != 12) {
        $pesan_error .= "No HP harus 12 angka <br>";
      }
      else if(preg_match("/\D/",$no_telp)) {
        $pesan_error .= "No HP harus diisi dengan angka <br>";
      }

      $selected="";
      $harga = "";
      switch($mobil) {
        case "Avanza" : 
        $selected = "selected";
        $harga = 250000; 
        break;
        case "Kijang" :
        $selected = "selected"; 
        $harga = 270000;
        break;
        case "Honda Bria" : 
        $selected = "selected"; 
        $harga = 300000;
        break;
      }

      $sehari=""; $duahari=""; $tigahari="";
      switch($lama_sewa) {
        case 1 : 
        $sehari = date('Y-n-j',time()+(1 * 24 * 60 * 60)); 
        break;
        case 2 : 
        $duahari = date('Y-n-j',time()+(2 * 24 * 60 * 60));  
        break;
        case 3 : 
        $tigahari = date('Y-n-j',time()+(3 * 24 * 60 * 60)); 
        break;
      }
      $total_harga = $harga * $lama_sewa;

      if(empty($pesan_error)) {
        $query = "insert into pelanggan ";
        $query .= "values('$ktp','$sim','$nama','$alamat','$no_telp')";
        $result = mysqli_query($con,$query);
        if(!$result) {
          die("Query Error: ".mysqli_errno($con)." - ".mysqli_error($con));
        }

        $sewa_tgl = time("{$tahun}-{$bulan}-{$tanggal}");
        $tgl_sewa = date("Y-n-j",$sewa_tgl);
        $jam_sewa = date("H:i:s",time());
        $query = "insert into sewa(harga, jangka_sewa,tgl_sewa,jam_sewa,ktp) values($harga,$lama_sewa,'$tgl_sewa','$jam_sewa','$ktp')";
        $result = mysqli_query($con,$query);
        if(!$result) {
          die("Query Error: ".mysqli_errno($con)." - ".mysqli_error($con));
        }

        $query_select = "select pelanggan.ktp, pelanggan.sim, pelanggan.nama, pelanggan.alamat, pelanggan.no_telp, ";
        $query_select .= "sewa.kd_mobil, sewa.tgl_sewa, sewa.jam_sewa, sewa.harga from pelanggan,sewa where pelanggan.ktp = sewa.ktp and pelanggan.ktp = '$ktp'";
        $result_select = mysqli_query($con,$query_select);
        if(!$result_select) {
          die("Query error: ".mysqli_errno($con)." - ".mysqli_error($con));
        }

        $pesan = "Pelanggan baru dengan id '<b>$ktp</b>' berhasil ditambahkan";
        $pesan = urlencode($pesan);
        header("Location: tampil_pelanggan.php");
        ob_end_flush();
      }

    }
    else {
      $pesan_error = "";
      $ktp = "";
      $sim = "";
      $nama = "";
      $alamat = "";
      $no_telp = "";
      $mobil = "Avanza";
      $lama_sewa = 1;
      $harga = "";
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" width="device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sewa Mobil</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
      body {
          background-image: url('img/mobil.jpg');
          background-repeat: no-repeat;
          background-size: cover;
      }
    </style>
</head>
<body>
    <div class="container bg-white shadow px-5 mt-3">
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
                  <a href="tambah_pelanggan.php" class="nav-link active">Tambah</a>
                </li>
                <?php if($_SESSION["username"] == "admin"){ ?>
                <li class="nav-item">
                  <a href="edit_pelanggan.php" class="nav-link">Edit</a>
                </li>
                <li class="nav-item">
                  <a href="hapus_pelanggan.php" class="nav-link">Hapus</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                  <a href="logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
          </div>
      </div>

        <div class="row">
          <div class="col-6">
          <div class="card shadow mt-3">
            <h3 class="card-header">Tambah Pelanggan</h3>
            <div class="card-body">
            <?php
              if(!empty($pesan_error)) {
                echo "<div class='alert alert-danger alert-dismissible fade show'>$pesan_error";
                echo "<button class='close' data-dismiss='alert'>";
                echo "<span>&times;</span>";
                echo "</button>";
                echo "</div>";
              }
            ?>
              <form action="tambah_pelanggan.php" method="post">
                <div class="form-group">
                  <label for="Mobil">Pilih Mobil</label>
                    <select name="mobil" id="Mobil" class="form-control">
                        <?php
                          foreach($array_mobil as $key => $val) {
                            if($val == $mobil) {
                              echo "<option value='$val' selected>$val</option>";
                            }
                            else {
                              echo "<option value='$val'>$val</option>";
                            }
                          }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="lamaSewa">Lama Sewa <span class="text-muted">(Hitungan hari)</span></label>
                    <select name="lama_sewa" id="lamaSewa" class="form-control">
                        <?php
                          for($i=1; $i<=3; $i++) {
                            if($i == $lama_sewa) {
                              echo "<option value={$i} selected>$i hari</option>";
                            }
                            else {
                              echo "<option value={$i}>$i hari</option>";
                            }
                              
                          }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="Harga">Harga Sewa</label>
                    <input type="text" name="harga" id="Harga" class="form-control" value="<?php echo $harga; ?>" disabled>
                </div>
                
                <label for="tanggal">Tanggal Sewa</label>
                <div class="row">
                  <div class="col-md-4">
                        <select name="tanggal" class="form-control">
                          <?php
                            for($i=1; $i<=31; $i++) {
                              if($i == $tanggal) {
                                echo "<option value={$i} selected>$i</option>";
                              }
                              else {
                                echo "<option value={$i}>$i</option>";
                              }
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-4">
                        <select name="bulan" class="form-control">
                          <?php
                            foreach($array_bulan as $key => $value) {
                              if($key == $bulan) {
                                echo "<option value={$key} selected>$value</option>";
                              }
                              else {
                                echo "<option value={$key}>$value</option>";
                              }
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-4">
                        <select name="tahun" class="form-control">
                          <?php
                            for($i=2019; $i<=2030; $i++) {
                              if($i == $tahun) {
                                echo "<option value={$i} selected>$i</option>";
                              }
                              else {
                                echo "<option value={$i}>$i</option>";
                              }
                            }
                          ?>
                        </select>
                  </div>
                </div>

                <div class="form-group">
                  <hr class="border border-info">
                  <label for="KTP">No KTP</label>
                    <input type="text" name="ktp" id="KTP" class="form-control" value="<?php echo $ktp; ?>">
                </div>
                <div class="form-group">
                  <label for="SIM">No SIM</label>
                    <input type="text" name="sim" id="SIM" class="form-control" value="<?php echo $sim; ?>">
                </div>
                <div class="form-group">
                  <label for="Nama">Nama</label>
                    <input type="text" name="nama" id="Nama" class="form-control" value="<?php echo $nama; ?>">
                </div>
                <div class="form-group">
                  <label for="Alamat">Alamat</label>
                  <textarea name="alamat" id="Alamat" class="form-control"><?php echo $alamat; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="noHP">No HP</label>
                    <input type="text" name="no_hp" id="noHP" class="form-control" value="<?php echo $no_telp; ?>">
                </div>
                <input type="submit" name="kirim" value="Kirim" class="btn btn-primary float-right">
                <input type="reset" name="batal" value="Batal" class="btn btn-danger mr-3 float-right">
              </form>
            </div>
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
