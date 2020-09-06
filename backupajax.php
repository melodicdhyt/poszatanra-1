<?php
include "koneksi.php";
$barang = mysqli_fetch_array(mysqli_query($conn, "select * from barang where id='$_GET[id]'"));
$data_barang = array(
                    'kodebarang'     =>  $barang['kodebarang'],
                    'hargamodal'           =>  $barang['hargamodal'],
                    'hargajual'     =>  $barang['hargajual'],
                    'stok'     =>  $barang['stok'],);
 echo json_encode($data_barang);