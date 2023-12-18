<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "si_asrama";

$koneksi = mysqli_connect($server, $user, $pass, $database);

// cek koneksi
if (!$koneksi) {
    die("Koneksi ke Database Gagal: " . mysqli_connect_error());
}
