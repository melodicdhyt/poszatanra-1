<script>
    function sum() {
        var hargamodal = document.getElementById('hargamodal').value;
        var hargajual = document.getElementById('hargajual').value;
        var result = parseInt(hargajual) - parseInt(hargamodal);
        if (!isNaN(result)) {
            document.getElementById('profit').value = result;
        }

    }
</script>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">

                <h2>
                    Data Barang <button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"><i class="material-icons" title="tambah">add</i></button>
                </h2>
                
               

            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-exportable dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barcode</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Ukuran</th>
                            <th>Harga Modal</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Profit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("select * from barang");
                        while ($data = $sql->fetch_assoc()) {


                        ?>

                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['kodebarcode'] ?></td>
                                <td><?php echo $data['namabarang'] ?></td>
                                <td><?php echo $data['jenisbarang'] ?></td>
                                <td><?php echo $data['ukuran'] ?></td>
                                <td><?php echo number_format($data['hargamodal']) ?></td>
                                <td><?php echo number_format($data['hargajual']) ?></td>
                                <td><?php echo $data['stok'] ?></td>
                                <td><?php echo number_format($data['profit']) ?></td>
                                <td>
                                    <a href="?page=barang&aksi=ubahbarang&id=<?php echo $data['kodebarcode'] ?>" class="btn btn-success"><i class="material-icons" title="edit">edit</i></a>
                                    <?php if ($_SESSION['admin']) { ?> <a onclick="return confirm('Konfirmasi hapus barang')" href="?page=barang&aksi=hapusbarang&id=<?php echo $data['kodebarcode'] ?>" class="btn btn-danger"><i class="material-icons" title="hapus">delete</i></a>
                                        <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">FORM BARANG</h4>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="kodebarcode" class="form-control" />
                                    <label class="form-label">Kode Barcode</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="namabarang" class="form-control">
                                    <label class="form-label">Nama Barang</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <div class="form-line">
                                    <select name="jenisbarang" class="form-control show-tick">
                                        <option value="">-- Jenis --</option>
                                        <option value="Celana">CELANA</option>
                                        <option value="Baju">BAJU</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <div class="form-line">
                                    <select name="ukuran" class="form-control show-tick">
                                        <option value="">-- Ukuran --</option>
                                        <option value="2">2</option>
                                        <option value="4">4</option>
                                    <option value="6">6</option>
                                    <option value="8">8</option>
                                    <option value="10">10</option>
                                    <option value="12">12</option>
                                    <option value="14">14</option>
                                    <option value="16">16</option>
                                    <option value="18">18</option>
                                    <option value="20">20</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="hargamodal" onkeyup="sum()" name="hargamodal" class="form-control" />
                                    <label class="form-label">Harga Modal</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="hargajual" onkeyup="sum()" name="hargajual" class="form-control" />
                                    <label class="form-label">Harga Jual</label>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" name="stok" class="form-control" />
                                    <label class="form-label">Stok</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" id="profit" readonly="" name="profit" class="form-control" />
                                    <label class="form-label">Profit</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="modal-footer">
                            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">BATAL</button>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>
</div>
<?php 
    if (isset($_POST['simpan'])) {

        $kodebarcode=$_POST['kodebarcode'];
        $namabarang=$_POST['namabarang'];
        $jenisbarang=$_POST['jenisbarang'];
        $ukuran=$_POST['ukuran'];
        $hargamodal=$_POST['hargamodal'];
        $hargajual=$_POST['hargajual'];
        $stok=$_POST['stok'];
        $profit=$_POST['profit'];

        $sql = $koneksi->query("insert into barang values 
        ('$kodebarcode','$namabarang','$jenisbarang','$ukuran','$hargamodal','$hargajual','$stok','$profit')");
        if ($sql) {
            ?>
                <script type="text/javascript">
                alert("data berhasil disimpan");
                window.location.href="?page=barang";
                </script>
            <?php
        }
    }
?>

