<?php

$tgl = date("Y-m-d");
$sql = $koneksi->query("select p.tglpenjualan ,
    sum(p.total) as totalpenjualan ,
    sum(p.jumlah) as jumlahbarang,
    sum(b.profit * p.jumlah) as totalprofit
    from penjualan p
    join barang b
    on p.kodebarcode = b.kodebarcode
    join d_penjualan dp
    on dp.kodepenjualan = p.kodepenjualan where tglpenjualan='$tgl'");
while ($tampil = $sql->fetch_assoc()) {

    $total_pj = $tampil['totalpenjualan'];
    $total_profit = $tampil['totalprofit'];
}

$sql2 = $koneksi->query("select * from barang ");
while ($tampil2 = $sql2->fetch_assoc()) {
    $jumlahbarang = $sql2->num_rows;
}

$sql3 = $koneksi->query("select p.tglpembelian as tglpembelian,
sum(p.total) as totalpembelian
from pembelian p
join d_pembelian dp
on dp.kodepembelian = p.kodepembelian
where tglpembelian = '$tgl'");
while ($data = $sql3->fetch_assoc()) {
    $totalpembelian = $data['totalpembelian'];
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h1>DASHBOARD</h1> <?php echo $tgl; ?>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">JUMLAH BARANG BARU</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
                        <?php echo $jumlahbarang; ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">remove_shopping_cart</i>
                </div>
                <div class="content">
                    <div class="text">PENJUALAN HARI INI</div>
                    <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
                        Rp. <?php echo number_format($total_pj);  ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">add_shopping_cart</i>
                </div>
                <div class="content">
                    <div class="text">PEMBELIAN HARI INI</div>
                    <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
                        Rp. <?php echo number_format($totalpembelian);  ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text">PROFIT HARI INI</div>
                    <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">Rp.
                        <?php echo number_format($total_profit); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end widget-->
    <!-- start data penjualan-->
    <div class="row clearfix">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>PENJUALAN by TANGGAL</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Qty</th>
                                    <th>Total Penjualan</th>
                                    <th>Total Profit</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = $koneksi->query("select p.tglpenjualan ,
                                    sum(p.total) as totalpenjualan ,
                                    sum(p.jumlah) as jumlahbarang,
                                    sum(b.profit * p.jumlah) as totalprofit
                                    from penjualan p
                                    join barang b
                                    on p.kodebarcode = b.kodebarcode
                                    group by p.tglpenjualan
                                    order by p.tglpenjualan DESC limit 3");
                                while ($data = $sql->fetch_assoc()) {





                                ?>
                                    <tr>
                                        <td><?php echo $data['tglpenjualan'] ?></td>
                                        <td><?php echo $data['jumlahbarang'] ?></td>
                                        <td>Rp. <?php echo number_format($data['totalpenjualan']) ?></td>
                                        <td>Rp. <?php echo number_format($data['totalprofit']) ?></td>

                                    </tr>
                                <?php  } ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>PENJUALAN by Bulan </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Qty</th>
                                    <th>Total Penjualan</th>
                                    <th>Total Profit</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = $koneksi->query("select month(p.tglpenjualan) as bulan ,
                                    sum(p.total) as totalpenjualan ,
                                    sum(p.jumlah) as jumlahbarang,
                                    sum(b.profit * p.jumlah) as totalprofit
                                    from penjualan p
                                    join barang b
                                    on p.kodebarcode = b.kodebarcode
                                    group by bulan
                                    order by bulan DESC limit 3");
                                while ($data = $sql->fetch_assoc()) {
                                    $tglpenjualan = $data['bulan'];




                                ?>
                                    <tr>
                                        <td><?php switch ($tglpenjualan) {
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
                                            ?></td>
                                        <td><?php echo $data['jumlahbarang'] ?></td>
                                        <td>Rp. <?php echo number_format($data['totalpenjualan']) ?></td>
                                        <td>Rp. <?php echo number_format($data['totalprofit']) ?></td>

                                    </tr>
                                <?php  } ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end data penjualan-->
    <!-- start data pembelian-->
    <div class="row clearfix">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>PEMBELLIAN by TANGGAL</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
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
                                    order by tglpembelian DESC limit 3");
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
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>PEMBELIAN by Bulan </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
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
                                    order by bulan DESC limit 3");
                                while ($data = $sql->fetch_assoc()) {
                                    $tglpembelian = $data['bulan'];
                                ?>
                                    <tr>
                                        <td><?php switch ($tglpembelian) {
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
                                            ?></td>
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
    <!-- end data pembelian-->
    <!-- start data santunan-->
    <div class="row clearfix">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>ZATANRA </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                <th>Bulan</th>
                                    <th>Profit</th>
                                    <th>Santunan</th>
                                    <th>Kas</th>
                                    <th>Modal</th>
                                    <th>Zatanra</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = $koneksi->query("select month(p.tglpenjualan) as bulan,
                                sum(b.profit * p.jumlah) as totalprofit
                                from penjualan p
                                join barang b
                                on b.kodebarcode = p.kodebarcode
                                group by bulan
                                order by bulan DESC");
                                while ($data = $sql->fetch_assoc()) {
                                    $bulan = $data['bulan'];
                                    $profit = $data['totalprofit'];
                                    $santunan = ($profit * 7.5/100);
                                    $kas = ($profit * 7.5/100);
                                    $modal = ($profit * 10/100);
                                    $zatanra = $profit - $santunan - $kas - $modal;
                                ?>
                                    <tr>
                                        
                                        <td><?php switch ($bulan) {
                                                case 1:
                                                    echo "Jan";
                                                    break;
                                                case 2:
                                                    echo "Feb";
                                                    break;
                                                case 3:
                                                    echo "Mar";
                                                    break;
                                                case 4:
                                                    echo "Apr";
                                                    break;
                                                case 5:
                                                    echo "Mei";
                                                    break;
                                                case 6:
                                                    echo "Jun";
                                                    break;
                                                case 7:
                                                    echo "Jul";
                                                    break;
                                                case 8:
                                                    echo "Agu";
                                                    break;
                                                case 9:
                                                    echo "Sep";
                                                    break;
                                                case 10:
                                                    echo "Okt";
                                                    break;
                                                case 11:
                                                    echo "Nov";
                                                    break;
                                                case 12:
                                                    echo "Des";
                                                    break;
                                            }
                                            ?></td>
                                        <td>Rp. <?php echo number_format($profit) ?></td>
                                        <td>Rp. <?php echo number_format( $santunan) ?></td>
                                        <td>Rp. <?php echo number_format( $kas )?></td>
                                        <td>Rp. <?php echo number_format( $modal)?></td>
                                        <td>Rp. <?php echo number_format( $zatanra)?></td>

                                    </tr>
                                <?php  } ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end data santunan-->
    

    <!-- Answered Tickets -->


</div>