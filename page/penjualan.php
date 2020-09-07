<?php
$kode = $_GET['kodez'];
?>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    INLINE LAYOUT
                </h2>
            </div>
            <div class="body">
                <form method="POST">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b>Kode Penjualan</b>
                                    </p>
                                    <input type="text" name="kode" class="form-control" value="<?php echo $kode; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b>Barang</b>
                                    </p>
                                    <select class="form-control show-tick" name="kodebarcode">
                                        <?php
                                        include "koneksi.php";
                                        $cekbarang = mysqli_query($koneksi, "SELECT * FROM barang");
                                        while ($row = mysqli_fetch_array($cekbarang)) {
                                            echo "<option value='$row[kodebarcode]'>$row[kodebarcode]-$row[namabarang] /Size : $row[ukuran] / Stok :  $row[stok] </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b>Jumlah</b>
                                    </p>
                                    <input type="text" name="jumlah" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b>Marketplace</b>
                                    </p>
                                    <select class="form-control show-tick" name="marketplace">
                                        <option value="1">TOKOPEDIA</option>
                                        <option value="2">SHOPEE</option>
                                        <option value="3">OFFLINE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b>Kode Invoice</b>
                                    </p>
                                    <input type="text" name="invoice" class="form-control">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">

                                <p>
                                    <b>Action</b>
                                </p>
                                <input type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="simpan" value="Tambah">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
if (isset($_POST['simpan'])) {

    $date = date("y-m-d");
    $kodepenjualan = $_POST['kode'];
    $invoice = $_POST['invoice'];
    $kodebarcode = $_POST['kodebarcode'];
    $marketplace = $_POST['marketplace'];

    $barang = $koneksi->query("select * from barang where kodebarcode='$kodebarcode'");

    $databarang = $barang->fetch_assoc();

    $hargajual = $databarang['hargajual'];

    $jumlah = $_POST['jumlah'];

    $total = $jumlah * $hargajual;

    $barang2 = $koneksi->query("select * from barang where kodebarcode='$kodebarcode'");

    while ($databarang2 = $barang2->fetch_assoc()) {
        $sisa = $databarang2['stok']- $jumlah;

        if ($sisa < 0) {
?>

            <script type="text/javascript">
                alert("stok Barang Tidak Cukup");
                window.location.href = "?page=penjualan&kodez=<?php echo $kode; ?>"
            </script>

<?php
        } else {
            $koneksi->query("insert into penjualan (kodepenjualan,invoice,kodebarcode,jumlah,total,tglpenjualan,idmarketplace) 
                values ('$kode','$invoice','$kodebarcode','$jumlah','$total','$date','$marketplace')");
                $koneksi->query("update barang set stok = stok-'$jumlah' where kodebarcode='$kodebarcode'");
         
        }
    }
}
?>

<form method="post">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DETAIL PENJUALAN <br />

                    </h2>
                </div>
                <div class="body">
                    <table class="table  table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                
                                <th>Invoice</th>
                                <th>Nama Barang</th>
                                <th>Ukuran</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Marketplace</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("select * from penjualan,barang,marketplace where penjualan.idmarketplace=marketplace.idmarketplace and
                                                            penjualan.kodebarcode = barang.kodebarcode and kodepenjualan='$kode'");
                            while ($data = $sql->fetch_assoc()) {


                            ?>

                                <tr>
                                    <td><?php echo $no++ ?></td>
                                   
                                    <td><?php echo $data['invoice'] ?></td>

                                    <td><?php echo $data['namabarang'] ?></td>
                                    <td><?php echo $data['ukuran'] ?></td>
                                    <td><?php echo $data['hargajual'] ?></td>
                                    <td><?php echo $data['jumlah'] ?></td>
                                    <td><?php echo $data['total'] ?></td>
                                    <td><?php echo $data['marketplace'] ?></td>


                                    <td>
                                        <a href="?page=penjualan&aksi=tambah&id=<?php echo $data['id'] ?>&kodepenjualan=<?php echo $data['kodepenjualan']
                                                                                                                        ?>&hargajual=<?php echo $data['hargajual'] ?>&kodebarcode=<?php echo $data['kodebarcode'] ?>&jumlah=<?php echo $data['jumlah']?>" class="btn btn-success">
                                            <i class="material-icons" title="tambah">add</i></a>
                                        <a href="?page=penjualan&aksi=kurang&id=<?php echo $data['id'] ?>&kodepenjualan=<?php echo $data['kodepenjualan']
                                                                                                                        ?>&hargajual=<?php echo $data['hargajual'] ?>&kodebarcode=<?php echo $data['kodebarcode'] ?>" class="btn btn-danger">
                                            <i class="material-icons" title="kurang">remove</i></a>
                                        <a onclick="return confirm('Konfirmasi hapus penjualan')" href="?page=penjualan&aksi=hapus&id=<?php echo $data['id'] ?>&kodepenjualan=<?php echo $data['kodepenjualan']
                                                                                                                                                                                ?>&hargajual=<?php echo $data['hargajual'] ?>&kodebarcode=<?php echo $data['kodebarcode'] ?>&jumlah=<?php echo $data['jumlah'] ?>" class="btn btn-danger">
                                            <i class="material-icons" title="hapus">clear</i></a>
                                    </td>
                                </tr>
                            <?php
                                $subtotal = $subtotal + $data['total'];
                            }

                            ?>
                        </tbody>
                        <tr>
                            <th colspan="6" style="text-align: right;">Sub Total</th>
                            <td>
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" name="subtotal" id="subtotal" onkeyup="hitung();" value="<?php echo $subtotal; ?>" readonly class="form-control">
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align: right;">Diskon</th>
                            <td>
                            <div class="form-group">
                                <div class="form-line">
                                <input type="number" name="diskon" id="diskon" onkeyup="hitung();" class="form-control">
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align: right;">Ongkir</th>
                            <td>
                            <div class="form-group">
                                <div class="form-line"><input type="number" name="ongkir" id="ongkir" onkeyup="hitung();" class="form-control">
                                </div>
                            </div>
                        </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align: right;">Total</th>
                            <td>
                            <div class="form-group">
                                <div class="form-line"><input type="number" name="total" id="total" readonly class="form-control">
                            </td>
                            </div>
                            </div>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align: right;">
                            <div class="alert alert-danger">
                                <strong>CATATAN !</strong> HAPUS DAFTAR DETAIL PENJUALAN , JIKA BATAL MELAKUKAN SIMPAN PENJUALAN
                            </div>
                            </th>
                            <td><input type="submit" name="simpan_pj" value="SIMPAN" class="btn btn-primary btn-lg m-l-15 waves-effect" onclick="return confirm('Apakah data sudah benar?')"></td>
                        </tr>
                    </table>

                </div>
</form>

<?php
if (isset($_POST['simpan_pj'])) {
    $subtotal = $_POST['subtotal'];
    $ongkir = $_POST['ongkir'];
    $total = $_POST['total'];
    $diskon = $_POST['diskon'];

    $simpanpenjualan=$koneksi->query("insert into d_penjualan (kodepenjualan,subtotal,diskon,ongkir,total) 
                                        values('$kode','$subtotal','$diskon','$ongkir','$total')");
                                        if ($simpanpenjualan) {
                                            ?>
                                                <script type="text/javascript">
                                                alert("Penjualan Berhasil Di Input");
                                                window.location.href="?page=datapenjualan";
                                                </script>
                                            <?php
                                        }
}
?>


<script type="text/javascript">
    function hitung() {
        var subtotal = document.getElementById('subtotal').value;
        var ongkir = document.getElementById('ongkir').value;
        var diskon = document.getElementById('diskon').value;
        var total = parseInt(subtotal) - parseInt(diskon) + parseInt(ongkir);
        if (!isNaN(total)) {
            document.getElementById('total').value = total;
        }
    }
</script>