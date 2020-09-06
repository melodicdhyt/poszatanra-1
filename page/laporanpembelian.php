<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    LAPORAN PEMBELIAN
                    <small>Berikut Laporan Pembelian <b>Zatanra</b> jika ada data yang tidak valid, mohon konfirmasi</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <ul class="nav nav-tabs tab-col-pink" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#all_md_col_1" data-toggle="tab">PEMBELIAN</a>
                            </li>
                            <li role="presentation">
                                <a href="#tanggal_md_col_1" data-toggle="tab">PEMBELIAN PER TANGGAL</a>
                            </li>
                            <li role="presentation">
                                <a href="#bulan_md_col_1" data-toggle="tab">PEMBELIAN PER BULAN</a>
                            </li>

                        </ul>
                    </div>

                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="all_md_col_1">

                        <div class="card">
                            <div class="header">
                                <h2>Laporan Semua Pembelian</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover js-exportable dashboard-task-infos">
                                        <thead style="background-color: red; color:white;">
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Kode Pembelian</th>
                                                <th>Invoice</th>
                                                <th>Barang</th>
                                                <th>Harga Modal</th>
                                                <th>Qty</th>
                                                <th>Sub Total</th>
                                                <th>Ongkir</th>
                                                <th>Total</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $sql = $koneksi->query("select
                                            p.tglpembelian as tglpembelian,
                                            p.kodepembelian as kodepembelian,
                                            p.invoice as invoice,
                                            b.namabarang as namabarang,
                                            b.hargamodal as hargamodal,
                                            p.jumlah as jumlah,
                                            dp.subtotal as subtotal,
                                            dp.ongkir as ongkir,
                                            p.total as total
                                            from pembelian p
                                            join d_pembelian dp
                                            on dp.kodepembelian = p.kodepembelian
                                            join barang b
                                            on b.kodebarcode = p.kodebarcode 
                                            order by STR_TO_DATE(tglpembelian,'%d-%m-%Y') ASC ");
                                            while ($data = $sql->fetch_assoc()) {





                                            ?>
                                                <tr>
                                                    <td><?php echo $data['tglpembelian'] ?></td>
                                                    <td><?php echo $data['kodepembelian'] ?></td>
                                                    <td><?php echo $data['invoice'] ?></td>
                                                    <td><?php echo $data['namabarang'] ?></td>
                                                    <td>Rp. <?php echo number_format($data['hargamodal']) ?></td>
                                                    <td><?php echo $data['jumlah'] ?></td>
                                                    <td>Rp. <?php echo number_format($data['subtotal']) ?></td>
                                                    <td>Rp. <?php echo number_format($data['ongkir']) ?></td>
                                                    <td>Rp. <?php echo number_format($data['total']) ?></td>

                                                </tr>
                                            <?php  } ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane " id="tanggal_md_col_1">
                        <div class="header">
                            <h2>Laporan Penjualan Per Hari</h2>
                        </div>
                        <div class="card">

                            <div class="body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover js-exportable dashboard-task-infos">
                                        <thead style="background-color: red; color:white;">
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Qty</th>
                                                <th>Total Pembelian</th>
                                                <th>Total Ongkir</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $sql = $koneksi->query("select p.tglpembelian as tglpembelian ,
                                            sum(p.total) as totalpembelian ,
                                            sum(p.jumlah) as jumlahbarang,
                                            dp.ongkir as ongkir
                                            from pembelian p
                                            join barang b
                                            on p.kodebarcode = b.kodebarcode
                                            join d_pembelian dp
                                            on dp.kodepembelian = p.kodepembelian
                                            group by tglpembelian,ongkir
                                            order by tglpembelian ASC");
                                            while ($data = $sql->fetch_assoc()) {





                                            ?>
                                                <tr>
                                                    <td><?php echo $data['tglpembelian'] ?></td>
                                                    <td><?php echo $data['jumlahbarang'] ?></td>
                                                    <td>Rp. <?php echo number_format($data['totalpembelian']) ?></td>
                                                    <td>Rp. <?php echo number_format($data['ongkir']) ?></td>

                                                </tr>
                                            <?php  } ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane " id="bulan_md_col_1">

                        <div class="card">
                            <div class="header">
                                <h2>Laporan Penjualan Per Bulan</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover js-exportable dashboard-task-infos">
                                        <thead style="background-color: red; color:white;">
                                            <tr>
                                                <th>Bulan</th>
                                                <th>Qty</th>
                                                <th>Total Pembelian</th>
                                                <th>Total Ongkir</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php



                                            $no = 1;
                                            $sql = $koneksi->query("select month(p.tglpembelian) as bulan ,
                                            sum(p.total) as totalpembelian ,
                                            sum(p.jumlah) as jumlahbarang,
                                            dp.ongkir as ongkir
                                            from pembelian p
                                            join barang b
                                            on p.kodebarcode = b.kodebarcode
                                            join d_pembelian dp
                                            on dp.kodepembelian = p.kodepembelian
                                            group by bulan,ongkir
                                            order by bulan ASC  ");
                                            while ($data = $sql->fetch_assoc()) {
                                                $tglpenjualan = $data['bulan'];
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php switch ($tglpenjualan) {
                                                            case 1:
                                                                echo "Januari";
                                                                break;
                                                            case 2:
                                                                echo "Februari";
                                                                break;
                                                            case 3:
                                                                echo "Maret";
                                                                break;
                                                            case 4:
                                                                echo "April";
                                                                break;
                                                            case 5:
                                                                echo "Mei";
                                                                break;
                                                            case 6:
                                                                echo "Juni";
                                                                break;
                                                            case 7:
                                                                echo "Juli";
                                                                break;
                                                            case 8:
                                                                echo "Agustus";
                                                                break;
                                                            case 9:
                                                                echo "September";
                                                                break;
                                                            case 10:
                                                                echo "Oktober";
                                                                break;
                                                            case 11:
                                                                echo "November";
                                                                break;
                                                            case 12:
                                                                echo "Desember";
                                                                break;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $data['jumlahbarang'] ?></td>
                                                    <td>Rp. <?php echo number_format($data['totalpembelian']) ?></td>
                                                    <td>Rp. <?php echo number_format($data['ongkir']) ?></td>

                                                </tr>
                                            <?php  } ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>