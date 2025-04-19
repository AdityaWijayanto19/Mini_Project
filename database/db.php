<?php
//KONEKSI KE DATABASE 'mini_project'
$host = 'localhost';       
$username = 'root';        
$password = '';           
$dbname = 'mini_project';  

// MEMBUAT KONEKSI
$conn = new mysqli($host, $username, $password, $dbname);

// CEK APAKAH KONEKSI BERHASIL
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
