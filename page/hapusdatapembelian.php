<?php
$id = $_GET['id'];
    $sql = $koneksi->query(" delete from pembelian where kodepembelian='$id'");
    $sql1= $koneksi->query("delete from d_pembelian where kodepembelian = '$id'");
if ($sql){
   ?>
     <script type="text/javascript">
     alert("Data Pembelian Berhasil Dihapus");
     window.location.href="?page=datapembelian";
     </script>
     <?php
}
    ?>