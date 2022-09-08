<?php
    session_start();
    if(!isset($_SESSION["username"])){
    header("Location: login.php");
    }
    
    ob_start();
    date_default_timezone_set("Asia/Jakarta");
    require_once 'koneksi.php';

        if(isset($_POST['Hapus'])) {
            $ktp = $_GET["id"];
            $query = "delete from pelanggan where ktp = '$ktp';";
            $result = mysqli_query($con,$query);
            $query1 = "delete from sewa where ktp = '$ktp';";
            $result1 = mysqli_query($con,$query);
            if($result && $result1) {
              header('location: hapus_pelanggan.php'); }
        }

            
?>
