<?php

    $id=$_GET['id'];
    $jumlah=$_GET['jumlah'];
    $kodepenjualan = $_GET['kodepenjualan'];
    $kodebarcode = $_GET['kodebarcode'];
    $hargajual = $_GET['hargajual'];
    
    $sql = $koneksi->query("delete from penjualan where id='$id'");
    $sql2 = $koneksi->query("update barang set stok = (stok+$jumlah) where kodebarcode='$kodebarcode'");
   

    if ($sql  || $sql2) {
        ?>
        <script>
            window.location.href="?page=penjualan&kodez=<?php echo $kodepenjualan?>";
        </script>
        <?php
    }

?>
