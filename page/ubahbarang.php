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

<?php
    $kode2 = $_GET['id'];
    $sql = $koneksi->query(" select * from barang where kodebarcode='$kode2'");
    $tampil = $sql->fetch_assoc();
    $jenisbarang = $tampil['jenisbarang'];
?>
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
                                <input type="text" name="kodebarcode" class="form-control" value="<?php echo $tampil['kodebarcode'];?>"/>
                                <label class="form-label">Kode Barcode</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="namabarang" class="form-control"  value="<?php echo $tampil['namabarang'];?>">
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
                                       
                                    <option value="Celana" <?php if ($jenisbarang=="Celana"){echo "SELECTED";}?>>Celana</option>
                                    <option value="Baju" <?php if ($jenisbarang=="Baju"){echo "SELECTED";}?>>Baju</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <div class="form-line">
                                <select name="ukuran" class="form-control show-tick">
                                    <option value="2" <?php if ($jenisbarang=="2"){echo "SELECTED";}?>>2</option>
                                    <option value="4" <?php if ($jenisbarang=="4"){echo "SELECTED";}?>>4</option>
                                    <option value="6" <?php if ($jenisbarang=="6"){echo "SELECTED";}?>>6</option>
                                    <option value="8" <?php if ($jenisbarang=="8"){echo "SELECTED";}?>>8</option>
                                    <option value="10" <?php if ($jenisbarang=="10"){echo "SELECTED";}?>>10</option>
                                    <option value="12" <?php if ($jenisbarang=="12"){echo "SELECTED";}?>>12</option>
                                    <option value="14" <?php if ($jenisbarang=="14"){echo "SELECTED";}?>>14</option>
                                    <option value="16" <?php if ($jenisbarang=="16"){echo "SELECTED";}?>>16</option>
                                    <option value="18" <?php if ($jenisbarang=="18"){echo "SELECTED";}?>>18</option>
                                    <option value="20" <?php if ($jenisbarang=="20"){echo "SELECTED";}?>>20</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" id="hargamodal" onkeyup="sum()" name="hargamodal" value="<?php echo $tampil['hargamodal'];?>"
                                    class="form-control" />
                                    <label class="form-label">Harga Modal</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" id="hargajual" onkeyup="sum()" name="hargajual" value="<?php echo $tampil['hargajual'];?>"
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
                                <input type="number" name="stok" class="form-control" value="<?php echo $tampil['stok'];?>"/>
                                <label class="form-label">Stok</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" id="profit" readonly="" name="profit" class="form-control" value="<?php echo $tampil['profit'];?>" />
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
        $ukuran = $_POST['ukuran'];
        $hargamodal=$_POST['hargamodal'];
        $hargajual=$_POST['hargajual'];
        $stok=$_POST['stok'];
        $profit=$_POST['profit'];

        $sql = $koneksi->query("update barang set kodebarcode='$kodebarcode',namabarang='$namabarang',jenisbarang='$jenisbarang',ukuran='$ukuran',
        hargamodal='$hargamodal',hargajual='$hargajual',stok='$stok',profit='$profit' where kodebarcode='$kode2'");
        if ($sql) {
            ?>
                <script type="text/javascript">
                alert("data berhasil diubah");
                window.location.href="?page=barang";
                </script>
            <?php
        }
    }
?>