<?php
    $con = mysqli_connect("localhost","root","","sewa_mobil");
    if(!$con) {
        die("Koneksi Gagal: ".mysqli_connect_errno()." - ".mysqli_connect_error());
    }

