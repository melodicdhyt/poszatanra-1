<?php
	// https://www.malasngoding.com
	// menghubungkan dengan koneksi database
	include 'koneksi.php';
 
	// mengambil data barang dengan kode paling besar
	$query = mysqli_query($conn, "SELECT max(kodebarang) as kodeTerbesar FROM barang");
	$data = mysqli_fetch_array($query);
	$kodeBarang = $data['kodeTerbesar'];
 
	// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
	// dan diubah ke integer dengan (int)
	$urutan = (int) substr($kodeBarang, 3, 3);
 
	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$urutan++;
 
	// membentuk kode barang baru
	// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
	// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
	// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
	$huruf = "ZTS";
	$kodeBarang = $huruf . sprintf("%03s", $urutan);
	?>
 
	<form method="post" action="prosesbarang.php">
		<label>Kode Barang</label><br/>
		<input type="text" name="kodebarang" required="required" value="<?php echo $kodeBarang ?>" readonly>
 
		<br>
 
		<label>Nama Barang</label><br/>
		<input type="text" name="namabarang" required="required">
		
		<br>
 
		<label>Harga Modal</label><br/>
		<input type="number" name="hargamodal" required="required">
 
        <br>
        <label>Harga Jual</label><br/>
		<input type="number" name="hargajual" required="required">
 
		<br>
 
		<label>stok</label><br/>
		<input type="number" name="stok" required="required">
 
		<br>
 
		<input type="submit" value="Simpan" name="simpan">
	</form>
 
	<br>
	<hr>
	<br>
 
	<table border="1">
		<thead>
			<tr>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Harga Modal</th>
                <th>Harga Jual</th>
                <th>Stok</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$barang = mysqli_query($conn,"SELECT * FROM barang");
			while($b = mysqli_fetch_array($barang)){
				?>
				<tr>
					<td><?php echo $b['kodebarang']; ?></td>
                    <td><?php echo $b['namabarang']; ?></td>
                    <td><?php echo "Rp. ".number_format($b['hargamodal']).""; ?></td>
					<td><?php echo "Rp. ".number_format($b['hargajual']).""; ?></td>
					<td><?php echo $b['stok']; ?></td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
</body>
</html>