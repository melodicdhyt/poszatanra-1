<?php
$kode2 = $_GET['kodez'];
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
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b>Kode Pembelian</b>
                                    </p>
                                    <input type="text" name="kodepembelian" class="form-control" value="<?php echo $kode2; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b><a data-toggle="tooltip" data-placement="top" title="" data-original-title="Input di menu barang, jika data barang belum ada">Nama Barang</a></b>
                                    </p>
                                    <select class="form-control show-tick" name="kodebarcode">
                                        <?php
                                        include "koneksi.php";
                                        $cekbarang = mysqli_query($koneksi, "SELECT * FROM barang");
                                        while ($row = mysqli_fetch_array($cekbarang)) {
                                            echo "<option value='$row[kodebarcode]'>$row[namabarang]  </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b>Jumlah</b>
                                    </p>
                                    <input type="text" name="jumlah" class="form-control">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b>Kode Invoice</b>
                                    </p>
                                    <input type="text" name="invoice" class="form-control">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
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

    $date = date('y-m-d');
    $kodepembelian = $_POST['kodepembelian'];
    $invoice = $_POST['invoice'];
    $kodebarcode = $_POST['kodebarcode'];
    $barang = $koneksi->query("select * from barang where kodebarcode='$kodebarcode'");
    $databarang = $barang->fetch_assoc();
    $hargamodal = $databarang['hargamodal'];
    $jumlah = $_POST['jumlah'];
    $total = $jumlah * $hargamodal;
    $sql1 = $koneksi->query("insert into pembelian (kodepembelian,invoice,kodebarcode,jumlah,total,tglpembelian) 
                values ('$kodepembelian','$invoice','$kodebarcode','$jumlah','$total','$date')");
    
    
}

?>

<form method="post">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DETAIL PEMBELIAN <br />

                    </h2>
                </div>
                <div class="body">
                    <table class="table  table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                               
                                <th>Invoice</th>
                                <th>Nama Barang</th>
                                <th>Harga Modal</th>
                                <th>Jumlah</th>
                                <th>Total</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("select * from pembelian,barang where
                                                            pembelian.kodebarcode = barang.kodebarcode and kodepembelian='$kode2'");
                            while ($data = $sql->fetch_assoc()) {


                            ?>

                                <tr>
                                    <td><?php echo $no++ ?></td>
                                   
                                    <td><?php echo $data['invoice'] ?></td>

                                    <td><?php echo $data['namabarang'] ?></td>
                                    <td><?php echo $data['hargamodal'] ?></td>
                                    <td><?php echo $data['jumlah'] ?></td>
                                    <td><?php echo $data['total'] ?></td>



                                    <td>
                                        <a href="?page=pembelian&aksi=tambah&id=<?php echo $data['id'] ?>&kodepembelian=<?php echo $data['kodepembelian']
                                                                                                                        ?>&hargamodal=<?php echo $data['hargamodal'] ?>&kodebarcode=<?php echo $data['kodebarcode'] ?>" class="btn btn-success">
                                            <i class="material-icons" title="tambah">add</i></a>
                                        <a href="?page=pembelian&aksi=kurang&id=<?php echo $data['id'] ?>&kodepembelian=<?php echo $data['kodepembelian']
                                                                                                                        ?>&hargamodal=<?php echo $data['hargamodal'] ?>&kodebarcode=<?php echo $data['kodebarcode'] ?>" class="btn btn-danger">
                                            <i class="material-icons" title="kurang">remove</i></a>
                                        <a onclick="return confirm('Konfirmasi hapus Pembelian')" href="?page=pembelian&aksi=hapus&id=<?php echo $data['id'] ?>&kodepembelian=<?php echo $data['kodepembelian']
                                                                                                                                                                                ?>&hargajual=<?php echo $data['hargamodal'] ?>&kodebarcode=<?php echo $data['kodebarcode'] ?>&jumlah=<?php echo $data['jumlah'] ?>" class="btn btn-danger">
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
                        <strong>CATATAN !</strong> HAPUS DAFTAR DETAIL PEMBELIAN , JIKA BATAL MELAKUKAN SIMPAN PEMBELIAN
                    </div>
                </th>
                <td><input type="submit" name="simpan_pb" value="SIMPAN" class="btn btn-primary btn-lg m-l-15 waves-effect" onclick="return confirm('Apakah data sudah benar?')"></td>
            </tr>
            </table>

        </div>
</form>

<?php
if (isset($_POST['simpan_pb'])) {
    $subtotal = $_POST['subtotal'];
    $ongkir = $_POST['ongkir'];
    $total = $_POST['total'];

    $simpanpembelian = $koneksi->query("insert into d_pembelian (kodepembelian,subtotal,ongkir,total) 
                                        values('$kode2','$subtotal','$ongkir','$total')");
    if ($simpanpembelian) {
?>
        <script type="text/javascript">
            alert("Pembelian Berhasil Di Input");
            window.location.href = "?page=datapembelian";
        </script>
<?php
    }
}
?>


<script type="text/javascript">
    function hitung() {
        var subtotal = document.getElementById('subtotal').value;
        var ongkir = document.getElementById('ongkir').value;
        var total = parseInt(subtotal) + parseInt(ongkir);
        if (!isNaN(total)) {
            document.getElementById('total').value = total;
        }
    }
</script>