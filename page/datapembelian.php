<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Pembelian <br />
                </h2>

            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-exportable dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl Pembelian</th>
                            <th>Kode</th>


                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("select distinct (kodepembelian),tglpembelian
                                    from pembelian group by kodepembelian, tglpembelian");
                        while ($data = $sql->fetch_assoc()) {


                        ?>

                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['tglpembelian'] ?></td>
                                <td><a href="?page=datapembelian&aksi=detail&kodez=<?php echo $data['kodepembelian'] ?>" ><?php echo $data['kodepembelian'] ?></a></td>

                                <td>
                                
                                    <?php if ($_SESSION['admin']) { ?> <a onclick="return confirm('Konfirmasi hapus Data Pembelian')" href="?page=datapembelian&aksi=hapus&id=<?php echo $data['kodepembelian'] ?>" class="btn btn-danger"><i class="material-icons" title="hapus">delete</i></a><?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>