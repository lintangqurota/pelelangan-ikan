<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <i style="margin-right:6px" class="fa fa-user"></i>
                    Pendaftaran Pembeli
                </h3>
                <ol class="breadcrumb">
                    <li><a href="?page=home">Beranda</a>
                    </li>
                    <li class="active">Daftar</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php  
                // fungsi untuk menampilkan pesan
                // jika alert = "" (kosong)
                // tampilkan pesan "" (kosong) 
                if (empty($_GET['alert'])) {
                  echo "";
                } 
                // jika alert = 1
                // tampilkan pesan Sukses "pendaftaran Anda berhasil, silahkan login melalui menu Login"
                elseif ($_GET['alert'] == 1) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><i class="glyphicon glyphicon-ok-circle"></i> Sukses!</strong> pendaftaran Anda berhasil.
                    </div>
                <?php
                } 
                ?>

                <div class="panel panel-default">
                    <div class="panel-body">
                          <!-- tampilan form hubungi kami -->
                        <form class="form-horizontal" method="POST" action="pages/daftar/proses.php">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="alamat" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">No. Telepon</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="no_telepon" autocomplete="off" maxlength="12" onKeyPress="return goodchars(event,'0123456789',this)" required>
                                </div>
                            </div>

                            <hr/>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input style="width:150px" type="submit" class="btn btn-primary btn-lg btn-submit" name="daftar" value="Daftar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
