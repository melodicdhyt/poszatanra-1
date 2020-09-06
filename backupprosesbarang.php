<?php 
// https://www.malasngoding.com
// menghubungkan koneksi database
include "koneksi.php";
 
// menangkap data dari form
$kodebarang = $_POST['kodebarang'];
$namabarang = $_POST['namabarang'];
$hargamodal = $_POST['hargamodal'];
$hargajual = $_POST['hargajual'];
$stok = $_POST['stok'];
 
// menginput data ke table barang
if (isset($_POST['simpan'])) {
$insert=mysqli_query($conn,"INSERT INTO barang ('kodebarang','namabarang','hargamodal','hargajual','stok')
VALUES ('$kodebarang', '$namabarang', '$hargamodal', '$hargajual','$stok')");
if ($insert){
    echo "data berhasil disimpan";
  
}
else {
    echo "data gagal disimpan";
    
}
}
// mengalihkan halaman kembali ke index.php

?>