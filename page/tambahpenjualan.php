<?php

    $id=$_GET['id'];
    $kodepenjualan = $_GET['kodepenjualan'];
    $kodebarcode = $_GET['kodebarcode'];
    $hargajual = $_GET['hargajual'];
    $jumlah = $_GET['jumlah'];
    
    $barang2 = $koneksi->query("select * from barang where kodebarcode='$kodebarcode'");

    while ($databarang2 = $barang2->fetch_assoc()) {
        $sisa = $databarang2['stok']- $jumlah;

        if ($sisa < 0) {
?>

            <script type="text/javascript">
                alert("stok Barang Tidak Cukup");
                window.location.href = "?page=penjualan&kodez=<?php echo $kodepenjualan; ?>"
            </script>

<?php
        } else {
   $tambah = $koneksi->query("update penjualan set jumlah=(jumlah+1) where kodepenjualan='$kodepenjualan'");
   $tambah2 = $koneksi->query("update penjualan set total=(total+$hargajual) where kodepenjualan='$kodepenjualan'");
   $tambah3 = $koneksi->query("update barang set stok = (stok-1) where kodebarcode='$kodebarcode'");
            if ($tambah || $tambah2 ||$tambah3){
                ?>
                <script>
            window.location.href="?page=penjualan&kodez=<?php echo $kodepenjualan?>";
        </script>
        <?php
            }

        }
    }

?>
