
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah User
                            </h2>
                        </div>
                            <div class="body">
                                <form method="POST" enctype="multipart/form-data">
                                    <label for="">Username</label>
                            <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="username"class="form-control"  />
                                        </div>
                                    </div>
                                    <label for="">Nama</label>
                            <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="nama"class="form-control"  />
                                        </div>
                                    </div>
                                    <label for="">password</label>
                            <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" name="password"class="form-control"  />
                                        </div>
                                    </div>
                                    <label for="">Level</label>
                            <div class="form-group">
                                        <div class="form-line">
                                    <select name="level" class="form-control show-tick">
                                        <option value="">-- Please select --</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                        
                                    </select>
                                        </div>
                                    </div>
                                    <label for="">Foto</label>
                            <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" name="foto" class="form-control"  />
                                        </div>
                                    </div>
                                    
                                    
                                    <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                                </form>
                            </div>
                    </div>
                </div>
</div>  

<?php 
    if (isset($_POST['simpan'])) {

        $username=$_POST['username'];
        $nama=$_POST['nama'];
        $password=$_POST['password'];
        $level=$_POST['level'];

        $foto = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];
        $upload = move_uploaded_file($lokasi,"images/".$foto);

        if ($upload){
        $sql = $koneksi->query("insert into user (username,nama,password,level,foto) values 
        ('$username','$nama','$password','$level','$foto')");
        if ($sql) {
            ?>
                <script type="text/javascript">
                alert("data berhasil disimpan");
                window.location.href="?page=user";
                </script>
            <?php
        }
    }
}
?>