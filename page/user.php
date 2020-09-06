<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data User  <br/>
                                
                            </h2>
                            <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#smallModal" data-color="red"><i class="material-icons" title="tambah">add</i></button>
                       
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                    $no = 1;
                                    $sql = $koneksi->query("select * from user");
                                    while ($data = $sql->fetch_assoc()){

                                   
                                ?>

                                    <tr>
                                        <td><?php echo $no++?></td>
                                        <td><?php echo $data['nama']?></td>
                                        <td><?php echo $data['username']?></td>
                                        <td><?php echo $data['level']?></td>
                                        <td><img width="50" height="50" src="images/<?php echo $data['foto']?>" alt="">   </td>
                                       
                                        <td>
                                            <a href="?page=user&aksi=ubahuser&id=<?php echo $data['id']?>" class="btn btn-success"><i class="material-icons" title="tambah">edit</i></a>
                                            <a onclick="return confirm('Konfirmasi hapus user')" 
                                            href="?page=user&aksi=hapususer&id=<?php echo $data['id']?>" class="btn btn-danger"><i class="material-icons" title="tambah">delete</i></a>
                                        </td>
                                    </tr>
                               <?php }?>
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>
</div>

<div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">FORM USER</h4>
                        </div>
                        <div class="modal-body">
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
                                    <div class="form-group">
                                    <div class="modal-footer">
                                    <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary waves-effect" >
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">BATAL</button>
                                    </div>
                        </div>
                                </form>
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
                      
                    </div>
                </div>
            </div>