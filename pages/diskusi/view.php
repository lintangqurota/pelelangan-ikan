<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Diskusi</h2>
        <ol class="breadcrumb">
            <li><a href="?page=home">Home</a>
            </li>
            <li class="active">Diskusi</li>
        </ol>
    </div>
</div>
<!-- /.row -->

<!-- Form Komentar -->
<div class="row">
    <div class="col-md-6">
        <form action="pages/diskusi/proses.php?act=insert" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="nama" placeholder="Nama" autocomplete="off" required>
            </div>

            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required>
            </div>

            <div class="form-group">
                <textarea class="form-control" name="komentar" rows="5" placeholder="Komentar" required></textarea>
            </div>

            <input style="width:100px" type="submit" class="btn btn-primary" name="submit" value="Submit" />
        </form>
    </div>
</div>
<!-- /.row -->
<hr>
<!-- Komentar -->
<div class="row">
    <div class="col-md-6">
    <?php
    // fungsi query untuk menampilkan data dari tabel diskusi
    $query = mysqli_query($mysqli, "SELECT * FROM diskusi WHERE balas='0' ORDER BY id_diskusi DESC")
                                    or die('Ada kesalahan pada query tampil data diskusi: '.mysqli_error($mysqli));

    while ($data = mysqli_fetch_assoc($query)) { 
        $tgl     = substr($data['tanggal'],0,10);
        $exp     = explode('-',$tgl);
        $tanggal = $exp[2]."-".$exp[1]."-".$exp[0];
    ?>
        <div class="media">
            <div class="media-left">
                <h1 style="border:1px solid #ddd;border-radius:100%;padding:11px 15px;" class="media-heading"><i class="fa fa-user"></i></h1>
                <small><?php echo $tanggal; ?></small>
            </div>

            <div class="media-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="media-heading"><?php echo $data['nama']; ?> <small>(<?php echo $data['email']; ?>)</small></h4>
                        <p><?php echo $data['komentar']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <?php  
        // fungsi query untuk menampilkan data dari tabel diskusi
        $query2 = mysqli_query($mysqli, "SELECT * FROM diskusi WHERE balas='$data[id_diskusi]' ORDER BY id_diskusi ASC")
                                        or die('Ada kesalahan pada query tampil data diskusi: '.mysqli_error($mysqli));
        $row = mysqli_num_rows($query2);
        if ($row>0) {
            $data2 = mysqli_fetch_assoc($query2);

            $tgl2     = substr($data2['tanggal'],0,10);
            $exp      = explode('-',$tgl2);
            $tanggal2 = $exp[2]."-".$exp[1]."-".$exp[0];

            $nama     = $data2['nama'];
            $email    = $data2['email'];
            $komentar = $data2['komentar'];
        ?>
            <div style="margin-left: 50px" class="media">
                <div class="media-left">
                    <h1 style="border:1px solid #ddd;border-radius:100%;padding:11px 15px;" class="media-heading"><i class="fa fa-user"></i></h1>
                    <small><?php echo $tanggal2; ?></small>
                </div>

                <div class="media-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="media-heading"><?php echo $nama; ?> <small>(<?php echo $email; ?>)</small></h4>
                            <p><?php echo $komentar; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } 
    ?>
    </div>
</div>
<!-- /.row -->
