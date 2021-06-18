<?php
// fungsi query untuk menampilkan data dari tabel tantang tpi
$query = mysqli_query($mysqli, "SELECT * FROM tentang_tpi WHERE id='1'")
                                or die('Ada kesalahan pada query tampil data tentang : '.mysqli_error($mysqli));

$data = mysqli_fetch_assoc($query);
?>

<!-- Tentang TPI -->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            PELELANGAN IKAN
        </h3>
    </div>
    <div class="col-md-12">
        <p style="text-align:justify"><?php echo $data['isi']; ?></p>
    </div>
</div>
<!-- row --> 
<br><hr><br>
<!-- Service Panels -->
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="panel panel-default text-center">
            <div class="panel-heading">
            	<a href="?page=jadwal">
	                <span class="fa-stack fa-5x">
	                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
	                    <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
	                </span>
                </a>
            </div>
            <div class="panel-body">
                <h4><a href="?page=jadwal">Jadwal Lelang</a></h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="panel panel-default text-center">
            <div class="panel-heading">
            	<a href="?page=laporan">
	                <span class="fa-stack fa-5x">
	                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
	                    <i class="fa fa-file-text-o fa-stack-1x fa-inverse"></i>
	                </span>
                </a>
            </div>
            <div class="panel-body">
                <h4><a href="?page=laporan">Laporan Harian</a></h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="panel panel-default text-center">
            <div class="panel-heading">
            	<a href="?page=diskusi">
	                <span class="fa-stack fa-5x">
	                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
	                    <i class="fa fa-comments fa-stack-1x fa-inverse"></i>
	                </span>
                </a>
            </div>
            <div class="panel-body">
                <h4><a href="?page=diskusi">Diskusi</a></h4>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<br>
<!-- Jenis Ikan -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header center">
            Jenis Ikan
        </h2>
    </div>
    <div class="col-md-12">
    <?php  
    // fungsi query untuk menampilkan data dari tabel ikan
	$query = mysqli_query($mysqli, "SELECT * FROM ikan ORDER BY id_ikan DESC LIMIT 2")
									or die('Ada kesalahan pada query tampil data ikan: '.mysqli_error($mysqli));

    while ($data = mysqli_fetch_assoc($query)) { 
    	if ($data['gambar']=="") {
        	$gambar = "no_image.gif";
        } else {
        	$gambar = $data['gambar'];
        }
    ?>
        <div style="text-align:justify" class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="color:#3c8dbc;"><?php echo $data['nama_ikan']; ?></h3>
                </div>
                <div class="col-md-6">
                    <img style="border:1px solid #eaeaea;border-radius:2px;height:150px;" class="img-responsive img-hover" src="images/ikan/<?php echo $data['gambar']; ?>">
                </div>
                <div class="col-md-6">
                    <p><?php echo $data['keterangan']; ?></p>
                </div>
            </div>
        </div>
    <?php
    } 
    ?>
    </div>
</div>
<!-- row --> 
<br><br>
<div class="row center">
    <div class="col-md-12">
        <a style="width:150px" class="btn btn-primary" href="?page=ikan">Lainnya</a>
    </div>
</div>
<br>