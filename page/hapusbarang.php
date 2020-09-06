<?php

$kode2 = $_GET['id'];
    $sql = $koneksi->query(" delete from barang where kodebarcode='$kode2'");
if ($sql){
   ?>
     <script type="text/javascript">
     alert("Barang Berhasil DIhapus");
     window.location.href="?page=barang";
     </script>
     <?php
}
    ?>