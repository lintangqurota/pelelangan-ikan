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
				<a href="?module=ikan_masuk">Ikan Masuk</a>
			</li>

			<li class="active">Tambah</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-edit"></i>
				Input Ikan Masuk
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!--PAGE CONTENT BEGINS-->
				<form class="form-horizontal" role="form" action="modules/ikan-masuk/proses.php?act=insert" method="POST" />

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Tanggal Masuk</label>
						
						<div class="col-sm-4">
							<div class="input-group">
								<input class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="tanggal_masuk" value="<?php echo date("d-m-Y"); ?>" required />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Ikan</label>

						<div class="col-sm-4">
							<select class="chosen-select" name="ikan" data-placeholder="Pilih Ikan..." required>
								<option value=""></option>
								<?php
								$query = mysqli_query($mysqli, "SELECT id_ikan, nama_ikan FROM ikan 
																ORDER BY nama_ikan ASC")
																or die('Ada kesalahan pada query tampil data ikan : '.mysqli_error($mysqli));

								while($data = mysqli_fetch_assoc($query)) {
								    echo"<option value=\"$data[id_ikan]\"> $data[nama_ikan] </option>";

								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Nelayan</label>

						<div class="col-sm-4">
							<select class="chosen-select" name="nelayan" data-placeholder="Pilih Nelayan..." required>
								<option value=""></option>
								<?php
								$query = mysqli_query($mysqli, "SELECT id_nelayan, nama_nelayan FROM nelayan 
																ORDER BY nama_nelayan ASC")
																or die('Ada kesalahan pada query tampil data nelayan : '.mysqli_error($mysqli));
																
								while($data = mysqli_fetch_assoc($query)) {
								    echo"<option value=\"$data[id_nelayan]\"> $data[nama_nelayan] </option>";

								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Jumlah</label>

						<div class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" name="jumlah" maxlength="5" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required />
								<span class="input-group-addon">Kg</span>
							</div>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-2 col-md-10">
							<input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
							&nbsp; &nbsp; 
							<a style="width:100px" href="?module=ikan_masuk" class="btn">Batal</a>
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
	    // fungsi query untuk menampilkan data dari tabel ikan_masuk
	    $query = mysqli_query($mysqli, "SELECT a.id_masuk,a.tanggal_masuk,a.id_ikan,a.id_nelayan,a.jumlah,
										b.id_ikan,b.nama_ikan,
										c.id_nelayan,c.nama_nelayan
										FROM ikan_masuk as a INNER JOIN ikan as b INNER JOIN nelayan as c 
										ON a.id_ikan=b.id_ikan AND a.id_nelayan=c.id_nelayan 
										WHERE id_masuk='$_GET[id]'") 
	    								or die('Ada kesalahan pada query tampil data ubah : '.mysqli_error($mysqli));
	    $data  = mysqli_fetch_assoc($query);

		$id_masuk      = $data['id_masuk'];
		
		$tanggal       = $data['tanggal_masuk'];
		$tgl           = explode('-',$tanggal);
		$tanggal_masuk = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		
		$id_ikan       = $data['id_ikan'];
		$nama_ikan     = $data['nama_ikan'];
		$id_nelayan    = $data['id_nelayan'];
		$nama_nelayan  = $data['nama_nelayan'];
		$jumlah        = $data['jumlah'];
  	}
?>
	<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="?module=beranda">Beranda</a>
			</li>

			<li>
				<a href="?module=ikan_masuk">Ikan Masuk</a>
			</li>

			<li class="active">Ubah</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-edit"></i>
				Ubah Ikan Masuk
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!--PAGE CONTENT BEGINS-->
				<form class="form-horizontal" role="form" action="modules/ikan-masuk/proses.php?act=update" method="POST" />

					<input type="hidden" name="id_masuk" value="<?php echo $id_masuk; ?>" />

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Tanggal Masuk</label>
						
						<div class="col-sm-4">
							<div class="input-group">
								<input class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="tanggal_masuk" value="<?php echo $tanggal_masuk; ?>" required />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Ikan</label>

						<div class="col-sm-4">
							<select class="chosen-select" name="ikan" data-placeholder="Pilih Ikan..." required>
								<option value="<?php echo $id_ikan; ?>"><?php echo $nama_ikan; ?></option>
								<?php
								$query = mysqli_query($mysqli, "SELECT id_ikan, nama_ikan FROM ikan 
																ORDER BY nama_ikan ASC")
																or die('Ada kesalahan pada query tampil data ikan : '.mysqli_error($mysqli));

								while($data = mysqli_fetch_assoc($query)) {
								    echo"<option value=\"$data[id_ikan]\"> $data[nama_ikan] </option>";

								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Nelayan</label>

						<div class="col-sm-4">
							<select class="chosen-select" name="nelayan" data-placeholder="Pilih Nelayan..." required>
								<option value="<?php echo $id_nelayan; ?>"><?php echo $nama_nelayan; ?></option>
								<?php
								$query = mysqli_query($mysqli, "SELECT id_nelayan, nama_nelayan FROM nelayan 
																ORDER BY nama_nelayan ASC")
																or die('Ada kesalahan pada query tampil data nelayan : '.mysqli_error($mysqli));
																
								while($data = mysqli_fetch_assoc($query)) {
								    echo"<option value=\"$data[id_nelayan]\"> $data[nama_nelayan] </option>";

								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Jumlah</label>

						<div class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" name="jumlah" maxlength="5" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $jumlah; ?>" required />
								<span class="input-group-addon">Kg</span>
							</div>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-2 col-md-10">
							<input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
							&nbsp; &nbsp; 
							<a style="width:100px" href="?module=ikan_masuk" class="btn">Batal</a>
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