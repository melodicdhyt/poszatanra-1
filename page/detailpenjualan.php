<?php
$kodedetail = $_GET['kodez'];
?>

<?php
$sql = $koneksi->query("select * from penjualan where kodepenjualan = '$kodedetail'");
while ($data = $sql->fetch_assoc()) {
    $tglpenjualan = $data['tglpenjualan'];
}
?>

<div class="row-clearfix">
    <div class="card">
        <div class="header">
            <h2>
                Detail Penjualan <br />
            </h2>

        </div>
        <div class="body">
            <table class="table table-bordered table-striped table-hover  dataTable">
                <tr>
                    <td>Kode Penjualan</td>
                    <td><?php echo $kodedetail; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Penjualan</td>
                    <td><?php echo $tglpenjualan; ?></td>
                </tr>

            </table>
        </div>

        <div class="row-clearfix">
            <div class="card">
                <div class="body">
                    <table id="detail" class="table   dataTable">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Ukuran</th>
                                <th>Harga Jual</th>
                                <th>Jumlah</th>
                                <th>Total</th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php

                            $sql2 = $koneksi->query("select 
                            p.tglpenjualan as tglpenjualan,
                            p.kodepenjualan as kodepenjualan,
                            p.invoice as invoice,
                            b.namabarang as namabarang,
                            b.ukuran as ukuran,
                            b.hargajual as hargajual,
                            p.jumlah as jumlah,
                            p.total as total,
                            dp.subtotal as subtotal,
                            dp.ongkir as ongkir,
                            dp.total as totalakhir
                            from penjualan p
                            join d_penjualan dp
                            on dp.kodepenjualan = p.kodepenjualan
                            join barang b
                            on b.kodebarcode = p.kodebarcode where p.kodepenjualan = '$kodedetail' ");
                            while ($data2 = $sql2->fetch_assoc()) {
                                $subtotal = $data2['subtotal'];
                                $ongkir = $data2['ongkir'];
                                $totalakhir = $data2['totalakhir'];

                            ?>
                                <tr>
                                    <td><?php echo $data2['namabarang'] ?></td>
                                    <td><?php echo $data2['ukuran']?></td>
                                    <td><?php echo $data2['hargajual'] ?></td>
                                    <td><?php echo $data2['jumlah'] ?></td>
                                    <td>Rp. <?php echo number_format($data2['total']) ?></td>

                                </tr>
                            <?php


                            }
                            ?>
 <tr>
                                <th colspan="3" style="text-align:right;">Subtotal</th>
                                <td>Rp. <?php echo number_format($subtotal); ?></td>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:right;">Ongkir</th>
                                <td>Rp. <?php echo number_format($ongkir); ?></td>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:right;">Total</th>
                                <td>Rp. <?php echo number_format($totalakhir); ?></td>
                            </tr>
                        </tbody>
                        

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-clearfix">
<a href="page/cetakdetail.php" class="btn btn-danger">CETAK</a>
    <button onclick="goBack()" class="btn btn-danger">Kembali</button>
</div>
<script>
    function goBack() {
        window.history.go(-1)
    };

    $(document).ready(function() {
    $('#detail').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true },
            { extend: 'print', footer: true }
        ]
    } );
} );

    
</script>