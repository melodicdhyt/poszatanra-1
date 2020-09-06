<?php

    $id=$_GET['id'];
    $kodepenjualan = $_GET['kodepenjualan'];
    $kodebarcode = $_GET['kodebarcode'];
    $hargajual = $_GET['hargajual'];
    
    $sql = $koneksi->query("update penjualan set jumlah=(jumlah-1) where id='$id'");
    $sql1= $koneksi->query("update penjualan set total=(total-$hargajual) where id='$id'");
    $sql2 = $koneksi->query("update barang set stok=(stok+1) where kodebarcode='$kodebarcode'");

    if ($sql || $sql1 || $sql2) {
        ?>
        <script>
            window.location.href="?page=penjualan&kodez=<?php echo $kodepenjualan?>";
        </script>
        <?php
    }

?>
