<?php
include "koneksi.php"; 
    $id_brg             =$_POST['id'];
    $marketplace        =$_POST['marketplace'];
    $hargamodal         =$_POST['hargamodal'];
    $hargajual          =$_POST['hargajual'];
    $jumlahpenjualan    =$_POST['jumlahpenjualan'];
    $totalbayar         =$_POST['totalbayar'];
    $tanggal = date("F j, Y, g:i a");

    $selSto =mysqli_query($conn, "SELECT * FROM barang WHERE id='$id_brg'");
    $sto    =mysqli_fetch_array($selSto);
    $stok    =$sto['stok'];
    //menghitung sisa stok
    $sisa    =$stok-$jumlahpenjualan;
    
    if ($stok < $jumlahpenjualan) {
        ?>
        <script language="JavaScript">
            alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
            document.location='./';
        </script>
        <?php
    }
    //proses    
    else{
        $insert =mysqli_query($conn, "INSERT INTO penjualan (id_brg, hargamodal,hargajual,jumlahpenjualan,
        totalbayar,marketplace,tanggal,keuntungan)
        VALUES ( '$id_brg', '$hargamodal','$hargajual','$jumlahpenjualan','$totalbayar','$marketplace','$tanggal','$totalbayar')");
            if($insert){
                //update stok
                $upstok= mysqli_query($conn, "UPDATE barang SET stok='$sisa' WHERE id='$id_brg'");
                ?>
                <script language="JavaScript">
                    alert('Good! Input transaksi pengeluaran barang berhasil ...');
                    document.location='./';
                </script>
                <?php
            }
            else {
                echo "<div><b>Oops!</b> 404 Error Server.</div>";
            }
    }

?>