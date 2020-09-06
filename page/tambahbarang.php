<script>
    function sum() {
        var hargamodal = document.getElementById('hargamodal').value;
        var hargajual = document.getElementById('hargajual').value;
        var result=parseInt(hargajual)-parseInt(hargamodal);
        if (!isNaN(result)){
            document.getElementById('profit').value = result;
        }

    }
</script>

<div class="row-clearfix">
    <div class="card">
        <div class="header">
        <h2>
                                TAMBAH BARANG
                            </h2>
        </div>
            <div class="body">
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
                                <input type="text" name="namabarang" class="form-control" style="text-transform:uppercase">
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
                                <input type="number" id="hargamodal" onkeyup="sum()" name="hargamodal"
                                    class="form-control" />
                                    <label class="form-label">Harga Modal</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" id="hargajual" onkeyup="sum()" name="hargajual"
                                    class="form-control" />
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
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" id="profit" readonly="" name="profit" class="form-control" />
                                <label class="form-label">Profit</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="form-group">
                            
                                <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                            
                        </div>
                    </div>
                </div>
            </div>
</form>
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