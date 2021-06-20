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
				<a href="?module=jadwal">Jadwal Lelang</a>
			</li>

			<li class="active">Tambah</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-edit"></i>
				Input Jadwal Lelang
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!--PAGE CONTENT BEGINS-->
				<form class="form-horizontal" role="form" action="modules/jadwal/proses.php?act=insert" method="POST" enctype="multipart/form-data" />

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Tanggal</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="tanggal_lelang" value="<?php echo date("d-m-Y"); ?>" required />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Waktu Lelang</label>

						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input type="radio" class="ace" name="waktu_lelang" value="Lelang Pagi 06:00 WIB" />
									<span class="lbl"> Lelang Pagi 06:00 WIB</span>
								</label>
 
								<label>
									<input type="radio" class="ace" name="waktu_lelang" value="Lelang Sore 15:00 WIB" />
									<span class="lbl"> Lelang Sore 15:00 WIB</span>
								</label>
							</div>
						</div>
					</div>

					<div class="hr hr-16 dotted"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Ikan</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="hidden" class="form-control" id="id_masuk" name="id_masuk" required />
								<input type="text" class="form-control" id="nama_ikan" name="nama_ikan" readonly required />
								<a class="input-group-addon" data-toggle="modal" href="#modal-form">
									<i class="ace-icon fa fa-search"></i>
								</a>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Jumlah</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah" name="jumlah" readonly required />
								<span class="input-group-addon">Kg</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Kisaran Harga</label>

						<div style="padding-right:20px" class="col-sm-4">
							<input type="text" class="form-control" name="kisaran_harga" onKeyPress="return goodchars(event,'0123456789-',this)" autocomplete="off" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Gambar</label>

						<div style="padding-right:20px" class="col-sm-4">
							<input type="file" id="id-input-file-2" name="gambar" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Keterangan</label>

						<div class="col-sm-9">
							<textarea class="col-xs-12 col-sm-5" name="keterangan" rows="2" required></textarea>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-2 col-md-10">
							<input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
							&nbsp; &nbsp;
							<a style="width:100px" href="?module=jadwal" class="btn">Batal</a>
						</div>
					</div>
				</form>
				<!--PAGE CONTENT ENDS-->
			</div><!--/.span-->
		</div><!--/.row-fluid-->
	</div><!--/.page-content-->
	
	<div id="modal-form" class="modal" tabindex="-1">
		<div style="width:800px" class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Data Ikan Masuk</h4>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Tanggal</th>
										<th>Nama Ikan</th>
										<th>Nama Nelayan</th>
										<th>Jumlah</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
								<?php
								$no = 1;
								// fungsi query untuk menampilkan data dari tabel ikan masuk, ikan dan nelayan
								$query = mysqli_query($mysqli, "SELECT a.id_masuk,a.tanggal_masuk,a.id_ikan,a.id_nelayan,a.jumlah,
																b.id_ikan,b.nama_ikan,
																c.id_nelayan,c.nama_nelayan
																FROM ikan_masuk as a INNER JOIN ikan as b INNER JOIN nelayan as c
																ON a.id_ikan=b.id_ikan AND a.id_nelayan=c.id_nelayan
																ORDER BY a.id_masuk DESC")
																or die('Ada kesalahan pada query tampil data ikan masuk: '.mysqli_error($mysqli));

	                            while ($data = mysqli_fetch_assoc($query)) {
	                            	$tanggal        = $data['tanggal_masuk'];
									$tgl            = explode('-',$tanggal);
									$tanggal_masuk  = $tgl[2]."-".$tgl[1]."-".$tgl[0];
	                            ?>
	                            	<tr>
										<td width="30" class="center"><?php echo $no; ?></td>
										<td width="80" class="center"><?php echo $tanggal_masuk; ?></td>
										<td width="150"><?php echo $data['nama_ikan']; ?></td>
										<td width="150"><?php echo $data['nama_nelayan']; ?></td>
										<td width="100" align="right"><?php echo $data['jumlah']; ?> Kg</td>

										<td width="50" class="center">
											<div class="action-buttons">
												<button data-rel="tooltip" data-placement="top" title="Pilih" class="pilih_data tooltip-info btn btn-primary btn-xs" data-id="<?php echo $data['id_masuk']; ?>" data-nama="<?php echo $data['nama_ikan']; ?>" data-jml="<?php echo $data['jumlah']; ?>">
													<i class="ace-icon fa fa-check bigger-130 icon-only"></i>
												</button>
											</div>
										</td>
									</tr>
								<?php
	                            	$no++;
	                            } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="assets/js/jquery.min.js"></script>

	<!-- Javascript untuk popup modal Edit--> 
	<script type="text/javascript">
	   	$(document).on('click','.pilih_data',function(){
	   		// console.log($(this).attr('data-id'));
	   		// console.log($(this).attr('data-jml'));
	   		// console.log($(this).attr('data-nama'));
	   		
			var id_masuk  = $(this).attr('data-id');
			var jumlah    = $(this).attr('data-jml');
			var nama_ikan = $(this).attr('data-nama');

			$('#id_masuk').val(id_masuk);
			$('#nama_ikan').val(nama_ikan);
			$('#jumlah').val(jumlah);

  		   	$("#modal-form").modal('hide');
	    });
	</script>
<?php
}
// jika form edit data yang dipilih
elseif ($_GET['form']=='edit') {
	if (isset($_GET['id'])) {
	    // fungsi query untuk menampilkan data dari tabel jadwal
	    $query = mysqli_query($mysqli, "SELECT a.id_jadwal,a.tanggal_lelang,a.waktu_lelang,a.id_masuk,a.kisaran_harga,a.gambar,a.keterangan,
										b.id_masuk,b.jumlah,b.id_ikan,
										c.id_ikan,c.nama_ikan
										FROM jadwal as a INNER JOIN ikan_masuk as b INNER JOIN ikan as c 
										ON a.id_masuk=b.id_masuk AND b.id_ikan=c.id_ikan
										WHERE a.id_jadwal='$_GET[id]'")
	    								or die('Ada kesalahan pada query tampil data ubah : '.mysqli_error($mysqli));
	    $data  = mysqli_fetch_assoc($query);

		$id_jadwal      = $data['id_jadwal'];
		
		$tanggal        = $data['tanggal_lelang'];
		$tgl            = explode('-',$tanggal);
		$tanggal_lelang = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		
		$waktu_lelang   = $data['waktu_lelang'];
		$id_masuk       = $data['id_masuk'];
		$jumlah         = $data['jumlah'];
		$nama_ikan      = $data['nama_ikan'];
		$kisaran_harga  = $data['kisaran_harga'];
		$gambar         = $data['gambar'];
		$keterangan     = $data['keterangan'];
  	}
?>
	<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="?module=beranda">Beranda</a>
			</li>

			<li>
				<a href="?module=jadwal">Jadwal Lelang</a>
			</li>

			<li class="active">Ubah</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-edit"></i>
				Ubah Jadwal Lelang
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!--PAGE CONTENT BEGINS-->
				<form class="form-horizontal" role="form" action="modules/jadwal/proses.php?act=update" method="POST" enctype="multipart/form-data" />

					<input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" />
					
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Tanggal</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="tanggal_lelang" value="<?php echo $tanggal_lelang; ?>" required />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Waktu Lelang</label>

						<div class="col-sm-9">
							<div class="radio">
							<?php  
							if ($waktu_lelang=='Lelang Pagi 06:00 WIB') { ?>
								<label>
									<input type="radio" class="ace" name="waktu_lelang" value="Lelang Pagi 06:00 WIB" checked="" />
									<span class="lbl"> Lelang Pagi 06:00 WIB</span>
								</label>

								<label>
									<input type="radio" class="ace" name="waktu_lelang" value="Lelang Sore 15:00 WIB" />
									<span class="lbl"> Lelang Sore 15:00 WIB</span>
								</label>
							<?php
							} elseif ($waktu_lelang=='Lelang Sore 15:00 WIB') { ?>
								<label>
									<input type="radio" class="ace" name="waktu_lelang" value="Lelang Pagi 06:00 WIB" />
									<span class="lbl"> Lelang Pagi 06:00 WIB</span>
								</label>

								<label>
									<input type="radio" class="ace" name="waktu_lelang" value="Lelang Sore 15:00 WIB" checked="" />
									<span class="lbl"> Lelang Sore 15:00 WIB</span>
								</label>
							<?php
							}
							?>
							</div>
						</div>
					</div>

					<div class="hr hr-16 dotted"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Ikan</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="hidden" class="form-control" id="id_masuk" name="id_masuk" value="<?php echo $id_masuk; ?>" required />
								<input type="text" class="form-control" id="nama_ikan" name="nama_ikan" readonly value="<?php echo $nama_ikan; ?>" required />
								<a class="input-group-addon" data-toggle="modal" href="#modal-form">
									<i class="ace-icon fa fa-search"></i>
								</a>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Jumlah</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah" name="jumlah" readonly value="<?php echo $jumlah; ?>" required />
								<span class="input-group-addon">Kg</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Kisaran Harga</label>

						<div style="padding-right:20px" class="col-sm-4">
							<input type="text" class="form-control" name="kisaran_harga" autocomplete="off" value="<?php echo $kisaran_harga; ?>" required />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Gambar</label>

						<div style="padding-right:20px" class="col-sm-4">
							<input type="file" id="id-input-file-2" name="gambar" />
							<br>
							<img src="../images/ikan/<?php echo $gambar; ?>" width="150">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Keterangan</label>

						<div class="col-sm-9">
							<textarea class="col-xs-12 col-sm-5" name="keterangan" rows="2" required><?php echo $keterangan; ?></textarea>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-2 col-md-10">
							<input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
							&nbsp; &nbsp;
							<a style="width:100px" href="?module=jadwal" class="btn">Batal</a>
						</div>
					</div>
				</form>
				<!--PAGE CONTENT ENDS-->
			</div><!--/.span-->
		</div><!--/.row-fluid-->
	</div><!--/.page-content-->

	<div id="modal-form" class="modal" tabindex="-1">
		<div style="width:800px" class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Data Ikan Masuk</h4>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Tanggal</th>
										<th>Nama Ikan</th>
										<th>Nama Nelayan</th>
										<th>Jumlah</th>
										<th></th>
									</tr>
								</thead>

								<tbody>
								<?php
								$no = 1;
								// fungsi query untuk menampilkan data dari tabel ikan masuk, ikan dan nelayan
								$query = mysqli_query($mysqli, "SELECT a.id_masuk,a.tanggal_masuk,a.id_ikan,a.id_nelayan,a.jumlah,
																b.id_ikan,b.nama_ikan,
																c.id_nelayan,c.nama_nelayan
																FROM ikan_masuk as a INNER JOIN ikan as b INNER JOIN nelayan as c
																ON a.id_ikan=b.id_ikan AND a.id_nelayan=c.id_nelayan
																ORDER BY a.id_masuk DESC")
																or die('Ada kesalahan pada query tampil data ikan masuk: '.mysqli_error($mysqli));

	                            while ($data = mysqli_fetch_assoc($query)) {
	                            	$tanggal        = $data['tanggal_masuk'];
									$tgl            = explode('-',$tanggal);
									$tanggal_masuk  = $tgl[2]."-".$tgl[1]."-".$tgl[0];
	                            ?>
	                            	<tr>
										<td width="30" class="center"><?php echo $no; ?></td>
										<td width="80" class="center"><?php echo $tanggal_masuk; ?></td>
										<td width="150"><?php echo $data['nama_ikan']; ?></td>
										<td width="150"><?php echo $data['nama_nelayan']; ?></td>
										<td width="100" align="right"><?php echo $data['jumlah']; ?> Kg</td>

										<td width="50" class="center">
											<div class="action-buttons">
												<button data-rel="tooltip" data-placement="top" title="Pilih" class="pilih_data tooltip-info btn btn-primary btn-xs" data-id="<?php echo $data['id_masuk']; ?>" data-nama="<?php echo $data['nama_ikan']; ?>" data-jml="<?php echo $data['jumlah']; ?>">
													<i class="ace-icon fa fa-check bigger-130 icon-only"></i>
												</button>
											</div>
										</td>
									</tr>
								<?php
	                            	$no++;
	                            } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="assets/js/jquery.min.js"></script>

	<!-- Javascript untuk popup modal Edit--> 
	<script type="text/javascript">
	   	$(document).on('click','.pilih_data',function(){
			var id_masuk  = $(this).attr('data-id');
			var jumlah    = $(this).attr('data-jml');
			var nama_ikan = $(this).attr('data-nama');

			$('#id_masuk').val(id_masuk);
			$('#nama_ikan').val(nama_ikan);
			$('#jumlah').val(jumlah);

  		   	$("#modal-form").modal('hide');
	    });
	</script>
<?php
}
?>