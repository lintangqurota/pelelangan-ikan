<?php  
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?>
 	<!-- tampilkan form add data -->
	<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="?module=beranda">Beranda</a>
			</li>

			<li>
				<a href="?module=ikan">Ikan</a>
			</li>

			<li class="active">Tambah</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-edit"></i>
				Input Ikan
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!--PAGE CONTENT BEGINS-->
				<form class="form-horizontal" role="form" action="modules/ikan/proses.php?act=insert" method="POST" enctype="multipart/form-data" />

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Ikan</label>

						<div class="col-sm-9">
							<input type="text" class="col-xs-12 col-sm-7" name="nama" autocomplete="off"  required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Keterangan</label>

						<div class="col-sm-9">
							<textarea class="col-xs-12 col-sm-7" name="keterangan" rows="5" required></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Gambar</label>

						<div class="col-sm-5">
							<input type="file" id="id-input-file-2" name="gambar" required />
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-2 col-md-10">
							<input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
							&nbsp; &nbsp; 
							<a style="width:100px" href="?module=ikan" class="btn">Batal</a>
						</div>
					</div>
				</form>
				<!--PAGE CONTENT ENDS-->
			</div><!--/.span-->
		</div><!--/.row-fluid-->
	</div><!--/.page-content-->
<?php
}
// jika form edit data yang dipilih
elseif ($_GET['form']=='edit') { 
	if (isset($_GET['id'])) {
	    // fungsi query untuk menampilkan data dari tabel ikan
	    $query = mysqli_query($mysqli, "SELECT * FROM ikan WHERE id_ikan='$_GET[id]'") 
	    								or die('Ada kesalahan pada query tampil data ubah : '.mysqli_error($mysqli));
	    $data  = mysqli_fetch_assoc($query);
  	}
?>
	<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="?module=beranda">Beranda</a>
			</li>

			<li>
				<a href="?module=ikan">Ikan</a>
			</li>

			<li class="active">Ubah</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-edit"></i>
				Ubah Ikan
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!--PAGE CONTENT BEGINS-->
				<form class="form-horizontal" role="form" action="modules/ikan/proses.php?act=update" method="POST" enctype="multipart/form-data" />

					<input type="hidden" name="id_ikan" value="<?php echo $data['id_ikan']; ?>" />

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Ikan</label>

						<div class="col-sm-9">
							<input type="text" class="col-xs-12 col-sm-7" name="nama" autocomplete="off" value="<?php echo $data['nama_ikan']; ?>" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Keterangan</label>

						<div class="col-sm-9">
							<textarea class="col-xs-12 col-sm-7" name="keterangan" rows="5" required><?php echo $data['keterangan']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Gambar</label>

						<div class="col-sm-5">
							<input type="file" id="id-input-file-2" name="gambar" />
							<br/>
						<?php  
						if ($data['gambar']=='') { ?>
							<img style="border:2px solid #ccc;box-shadow:1px 1px 1px rgba(0, 0, 0, 0.15);box-sizing:border-box;padding:4px;" src="../images/ikan/no_image.gif" width="250px" />
						<?php
						} else { ?>
							<img style="border:2px solid #ccc;box-shadow:1px 1px 1px rgba(0, 0, 0, 0.15);box-sizing:border-box;padding:4px;" src="../images/ikan/<?php echo $data['gambar']; ?>" width="250px" />
						<?php
						}
						?>	
						</div>
					</div>
								
					<div class="clearfix form-actions">
						<div class="col-md-offset-2 col-md-10">
							<input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
							&nbsp; &nbsp; 
							<a style="width:100px" href="?module=ikan" class="btn">Batal</a>
						</div>
					</div>
				</form>
				<!--PAGE CONTENT ENDS-->
			</div><!--/.span-->
		</div><!--/.row-fluid-->
	</div><!--/.page-content-->
<?php
}
?>