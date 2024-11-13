<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'angkatan3_laundry';

$koneksi = mysqli_connect($host, $username, $password, $db_name);

if (!$koneksi) {
    echo "Error connecting, Something is wrong";
}
