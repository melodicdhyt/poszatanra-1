<!--<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Pencarian By Tanggal
                </h2>
            </div>
            <div class="body">
                <form method="POST">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <div class="form-group">
                                <div class="form-line focused">
                                    <p>
                                        <b>Dari</b>
                                    </p>
                                    <input type="text" name="start_date" id="start_date" class="datepicker form-control" >
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <p>
                                        <b>Sampai</b>
                                    </p>
                                    <input type="text" name="to_date" id="to_date" class="datepicker form-control">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                            <div class="form-group">

                                <p>
                                    <b></b>
                                </p>
                                <input type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" id="cari" name="simpan" value="Cari">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>-->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Penjualan <br />
                </h2>

            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-exportable dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl Penjualan</th>
                            <th>Kode</th>


                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("select distinct (kodepenjualan),tglpenjualan
                                    from penjualan group by kodepenjualan, tglpenjualan");
                        while ($data = $sql->fetch_assoc()) {


                        ?>

                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['tglpenjualan'] ?></td>
                                <td><a href="?page=datapenjualan&aksi=detail&kodez=<?php echo $data['kodepenjualan'] ?>&kodebarcode=<?php echo $data['kodebarcode']?>" ><?php echo $data['kodepenjualan'] ?></a></td>

                                <td>
                                
                                    <?php if ($_SESSION['admin']) { ?> <a onclick="return confirm('Konfirmasi hapus Data Penjualan')" href="?page=datapenjualan&aksi=hapus&kodez=<?php echo $data['kodepenjualan'] ?>" class="btn btn-danger"><i class="material-icons" title="hapus">delete</i></a><?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

    


