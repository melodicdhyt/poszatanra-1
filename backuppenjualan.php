<html>
<head>
    <title>Tutorial Membuat Script PHP Mengurangi Stok Barang</title>
</head>
<body>
    <h4>Script PHP untuk Mengurangi Stok Barang</h4>
    <p>Data Barang</p> <a href='formpenjualan.php'>Tambah Barang</a>
    <table width="530" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama</th>
                <th>hargamodal</th>
                <th>hargajual</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "koneksi.php";
            $no=0;
            $query    =mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
            while($data    =mysqli_fetch_array($query)){
            $no++;
            ?>
            <tr>
                <td><?php echo $no?></td>
                <td><?php echo $data['kode']?></td>
                <td><?php echo $data['nama']?></td>
                <td><?php echo $data['hargamodal']?></td>
                <td><?php echo $data['hargajual']?></td>
                <td><?php echo $data['stok']?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    
</body>
</html>