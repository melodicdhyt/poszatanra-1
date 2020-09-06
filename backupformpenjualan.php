<!DOCTYPE html>
<html>
<head>
    <title>Data Form muncul Otomatis setalah pilih data combobox PHP dan Ajax</title>
</head>
<body>
<form action="prosespenjualan.php" method="post">
    <table>
    <!--<tr><td>Tanggal Penjualan</td><td><input type="date" id="tanggalpenjualan" name="tanggalpenjualan"></td></tr>-->
    <tr><td>Marketplace</td><td>
    <select name="marketplace" id="marketplace">
        <option value="TOKOPEDIA">TOKOPEDIA</option>
        <option value="SHOPEE">SHOPEE</option>
    </select>
    </td></tr>
        <tr><td>Pilih Barang</td><td> <select onchange="cek_database()" id="id" name="id">
    <option value='' selected>- Pilih -</option>
    <?php
        include "koneksi.php";
        
        $karyawan = mysqli_query($conn,"SELECT * FROM barang");
        while ($row = mysqli_fetch_array($karyawan)) {
            echo "<option value='$row[id]'>$row[namabarang]</option>";
        }
    ?>
    </select></td></tr>
        
        <tr><td>Kode Barang</td><td><input type="text" id="kodebarang" name="kodebarang" disabled></td></tr>
        <tr><td>Harga Modal</td><td><input type="text" id="hargamodal" name="hargamodal" disabled></td></tr>
        <tr><td>Harga Jual</td><td><input type="text" id="hargajual" name="hargajual" disabled onkeyup="sum();"></td></tr>
        <tr><td>Stok Tersisa</td><td><input type="text" id="stok" name="stok" disabled></td></tr>
        <tr><td>Jumlah Penjualan</td><td><input type="text" id="jumlahpenjualan" name="jumlahpenjualan" onkeyup="sum();" ></td></tr>
        <tr><td>Total Bayar</td><td><input type="text" id="totalbayar" name="totalbayar" disabled></td></tr>
        <tr><td>Total Bayar</td><td><input type="submit" name="submit" value="submit"/> <input type="reset" value="Reset"/></td></tr>
        
    </table>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    function cek_database(){
        var id = $("#id").val();
        $.ajax({
            url: 'ajax.php',
            data:"id="+id ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            
            $('#kodebarang').val(obj.kodebarang);
            $('#hargamodal').val(obj.hargamodal);
            $('#hargajual').val(obj.hargajual);
            $('#stok').val(obj.stok);
            
        });
    }
    function sum() {
      var txtFirstNumberValue = document.getElementById('hargajual').value;
      var txtSecondNumberValue = document.getElementById('jumlahpenjualan').value;
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('totalbayar').value = result;
      }
}
</script>
</body>
</html>