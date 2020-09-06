<?php

    $id=$_GET['id'];
    $jumlah=$_GET['jumlah'];
    $kodepembelian = $_GET['kodepembelian'];
    $kodebarcode = $_GET['kodebarcode'];
    $hargamodal = $_GET['hargamodal'];
    
    $sql = $koneksi->query("delete from pembelian where id='$id'");
   
    

    if ($sql ) {
        ?>
        <script>
            window.location.href="?page=pembelian&kodez=<?php echo $kodepembelian?>";
        </script>
        <?php
    }

?>
