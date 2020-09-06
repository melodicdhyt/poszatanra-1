<?php

$kode2 = $_GET['id'];
    $sql = $koneksi->query(" delete from user where id='$kode2'");
if ($sql){
   ?>

    
     <script type="text/javascript">
     alert("User Berhasil Dihapus");
     window.location.href="?page=user";
     </script>
     <?php
}
    ?>