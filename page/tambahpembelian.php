<?php

    $id=$_GET['id'];
    $kodepembelian = $_GET['kodepembelian'];
    $kodebarcode = $_GET['kodebarcode'];
    $hargamodal = $_GET['hargamodal'];
    
    $sql = $koneksi->query("update pembelian set jumlah=(jumlah+1) where id='$id'");
    $sql1= $koneksi->query("update pembelian set total=(total+$hargamodal) where id='$id'");
    $sql2 = $koneksi->query("update barang set stok=(stok+1) where kodebarcode='$kodebarcode'");

    if ($sql || $sql1 || $sql2) {
        ?>
        <script>
            window.location.href="?page=pembelian&kodez=<?php echo $kodepembelian?>";
        </script>
        <?php
    }

?>
