<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
	<ul class="breadcrumb">
		<li class="active">
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="?module=beranda">Beranda</a>
		</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="page-header">
		<h1>
			Sistem Informasi Pelelangan Hasil Perikanan Laut
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="alert alert-block alert-info">
				<button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>
				<i class="ace-icon fa fa-user blue"></i>
				Selamat datang
				<strong class="blue"><?php echo $_SESSION['nama_user']; ?></strong>.
			</div>
			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
	
	<?php
	// fungsi query untuk menampilkan data dari tabel tantang tpi
	$query = mysqli_query($mysqli, "SELECT * FROM tentang_tpi WHERE id='1'")
									or die('Ada kesalahan pada query tampil data tentang : '.mysqli_error($mysqli));

    $data = mysqli_fetch_assoc($query);
    ?>

	<div class="timeline-item clearfix">
		<div style="margin-left:0" class="widget-box transparent">
			<div class="widget-header widget-header-small">
				<h5 class="widget-title smaller">
					<a href="?module=beranda" class="blue">TPI Dermaga Bom Kalianda</a>
				</h5>

				<span class="widget-toolbar">
					<a href="#" data-action="collapse">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</span>
				
			<?php  
			if ($_SESSION['hak_akses']=='Admin') { ?>
				<span class="widget-toolbar">
					<a href="?module=beranda&id=<?php echo $data['id']; ?>">
						<i class="ace-icon fa fa-edit"></i>
					</a>
				</span>
			<?php
			}
			?>
			</div>

			<div class="widget-body">
				<div class="widget-main">
				<?php  
				if (isset($_GET['id'])) { ?>

					<form class="form-horizontal" role="form" action="modules/beranda/proses.php?act=update" method="POST" />

						<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

						<div class="form-group">
							<div class="col-sm-12">
								<textarea class="col-xs-12 col-sm-12" name="isi" rows="10" required><?php echo $data['isi']; ?></textarea>
							</div>
						</div>

						<div class="clearfix form-actions">
							<div class="col-md-offset-0 col-md-12">
								<input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
								&nbsp; &nbsp; 
								<a style="width:100px" href="?module=beranda" class="btn">Batal</a>
							</div>
						</div>
					</form>

				<?php
				}
				else {?>

					<p style="text-align:justify"><?php echo $data['isi']; ?></p>
				
				<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.page-content -->