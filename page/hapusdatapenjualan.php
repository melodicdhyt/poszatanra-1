<?php
$kodez = $_GET['kodez'];
    $sql = $koneksi->query(" delete from penjualan where kodepenjualan='$kodez'");
    $sql1= $koneksi->query("delete from d_penjualan where kodepenjualan = '$kodez'");
   

if ($sql){
   ?>
     <script type="text/javascript">
     alert("Data Penjualan Berhasil Dihapus");
     window.location.href="?page=datapenjualan";
     </script>
     <?php
}
    ?>