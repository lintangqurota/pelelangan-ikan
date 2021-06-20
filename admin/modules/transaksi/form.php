<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?>

	<script type="text/javascript">
	function cek_stok(input) {
	  	jml_ikan = document.frmTransaksi.jumlah_ikan.value;
	  	jml_transaksi = document.frmTransaksi.jumlah_transaksi.value;
	  	var num = input.value;
	  	var jumlah_ikan = eval(jml_ikan);
	  	var jumlah_transaksi = eval(jml_transaksi);
	    if(jumlah_ikan < jumlah_transaksi){
	      	alert('Jumlah Ikan Tidak Memenuhi, Kurangi Jumlah Transaksi Lelang');
	    	input.value = input.value.substring(0,input.value.length-1);
	    }
	}

	function cek_nilai1(input) {
	  	bil1 = document.frmTransaksi.jumlah_transaksi.value;
	  	
	    if(bil1==0){
	      	alert('Jumlah transaksi tidak boleh 0 (kosong)');
	    }
	}

	function cek_nilai2(input) {
	  	bil1 = document.frmTransaksi.harga.value;
	  	
	    if(bil1==0){
	      	alert('harga tidak boleh 0 (kosong)');
	    }
	}
	</script>

 	<!-- tampilkan form add data -->
	<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="?module=beranda">Beranda</a>
			</li>

			<li>
				<a href="?module=transaksi">Transaksi Lelang</a>
			</li>

			<li class="active">Tambah</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-edit"></i>
				Input Transaksi Lelang
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!--PAGE CONTENT BEGINS-->
				<form class="form-horizontal" role="form" action="modules/transaksi/proses.php?act=insert" method="POST" name="frmTransaksi" />

					<input type="hidden" class="form-control" id="id_masuk" name="id_masuk" required />

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Tanggal</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="tanggal_transaksi" value="<?php echo date("d-m-Y"); ?>" required />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>

					<div class="hr hr-16 dotted"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Ikan</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" id="nama_ikan" name="nama_ikan" readonly required />
								<a class="input-group-addon" data-toggle="modal" href="#modal-form">
									<i class="ace-icon fa fa-search"></i>
								</a>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Nelayan</label>

						<div style="padding-right:20px" class="col-sm-4">
							<input type="text" class="form-control" id="nama_nelayan" name="nama_nelayan" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Jumlah Ikan</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah_ikan" name="jumlah_ikan" readonly required />
								<span class="input-group-addon">Kg</span>
							</div>
						</div>
					</div>

					<div style="padding-right:20px" class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Pembeli</label>

						<div class="col-sm-4">
							<select class="chosen-select" name="pembeli" data-placeholder="Pilih Pembeli..." required>
								<option value=""></option>
								<?php
								$query_pembeli = mysqli_query($mysqli, "SELECT id_pembeli, nama_pembeli FROM pembeli 
																		ORDER BY nama_pembeli ASC")
																		or die('Ada kesalahan pada query tampil data pembeli : '.mysqli_error($mysqli));
																
								while($data_pembeli = mysqli_fetch_assoc($query_pembeli)) {
								    echo"<option value=\"$data_pembeli[id_pembeli]\"> $data_pembeli[nama_pembeli] </option>";

								}
								?>
							</select>
						</div>
					</div>

					<div class="hr hr-16 dotted"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Jumlah</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah_transaksi" name="jumlah_transaksi" maxlength="5"  autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="cek_stok(this)&cek_nilai1(this)" required />
								<span class="input-group-addon">Kg</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Harga</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">Rp</span>
								<input type="text" class="form-control" id="harga" name="harga" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="cek_nilai2(this)" required />
							</div>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-2 col-md-10">
							<input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
							&nbsp; &nbsp;
							<a style="width:100px" href="?module=transaksi" class="btn">Batal</a>
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
										<th>Sisa</th>
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

									$query2 = mysqli_query($mysqli, "SELECT a.id_transaksi,sum(a.jumlah) as jml_transaksi,a.id_masuk,
																b.id_masuk,b.jumlah as jml_ikan 
																FROM transaksi_lelang as a INNER JOIN ikan_masuk as b
																ON a.id_masuk=b.id_masuk
																WHERE a.id_masuk='$data[id_masuk]'")
																or die('Ada kesalahan pada query tampil data jumlah: '.mysqli_error($mysqli));

	                            	$data2 = mysqli_fetch_assoc($query2);
	                            	$stok = $data2['jml_ikan'] - $data2['jml_transaksi'];
	                            ?>
	                            	<tr>
										<td width="30" class="center"><?php echo $no; ?></td>
										<td width="80" class="center"><?php echo $tanggal_masuk; ?></td>
										<td width="150"><?php echo $data['nama_ikan']; ?></td>
										<td width="150"><?php echo $data['nama_nelayan']; ?></td>
										<td width="90" align="right"><?php echo $data['jumlah']; ?> Kg</td>
										<td width="90" align="right"><?php echo $stok; ?> Kg</td>

										<td width="50" class="center">
											<div class="action-buttons">
												<button data-rel="tooltip" data-placement="top" title="Pilih" class="pilih_data tooltip-info btn btn-primary btn-xs" data-id="<?php echo $data['id_masuk']; ?>" data-ikan="<?php echo $data['nama_ikan']; ?>" data-nelayan="<?php echo $data['nama_nelayan']; ?>" data-jml="<?php echo $stok; ?>">
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
			var id_masuk     = $(this).attr('data-id');
			var nama_ikan    = $(this).attr('data-ikan');
			var nama_nelayan = $(this).attr('data-nelayan');
			var jumlah_ikan  = $(this).attr('data-jml');

			$('#id_masuk').val(id_masuk);
			$('#nama_ikan').val(nama_ikan);
			$('#nama_nelayan').val(nama_nelayan);
			$('#jumlah_ikan').val(jumlah_ikan);

  		   	$("#modal-form").modal('hide');
	    });
	</script>
<?php
}
// jika form edit data yang dipilih
elseif ($_GET['form']=='edit') {
	if (isset($_GET['id'])) {
	    // fungsi query untuk menampilkan data dari tabel transaksi
	    $query = mysqli_query($mysqli, "SELECT a.id_transaksi,a.tanggal_transaksi,a.id_masuk,a.id_pembeli,a.jumlah as jumlah_transaksi,a.harga,
										b.id_masuk,b.jumlah as jumlah_transaksi,b.id_ikan,b.id_nelayan,
										c.id_ikan,c.nama_ikan,
										d.id_nelayan,d.nama_nelayan,
										e.id_pembeli,e.nama_pembeli
										FROM transaksi_lelang as a INNER JOIN ikan_masuk as b INNER JOIN ikan as c INNER JOIN nelayan as d INNER JOIN pembeli as e
										ON a.id_masuk=b.id_masuk AND b.id_ikan=c.id_ikan AND b.id_nelayan=d.id_nelayan AND a.id_pembeli=e.id_pembeli
										WHERE a.id_transaksi='$_GET[id]'")
	    								or die('Ada kesalahan pada query tampil data ubah : '.mysqli_error($mysqli));
	    $data  = mysqli_fetch_assoc($query);

		$id_transaksi      = $data['id_transaksi'];
		$id_masuk          = $data['id_masuk'];
		
		$tanggal           = $data['tanggal_transaksi'];
		$tgl               = explode('-',$tanggal);
		$tanggal_transaksi = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		
		$nama_ikan         = $data['nama_ikan'];
		$nama_nelayan      = $data['nama_nelayan'];
		$id_pembeli        = $data['id_pembeli'];
		$nama_pembeli      = $data['nama_pembeli'];
		$jumlah_transaksi  = $data['jumlah_transaksi'];
		$harga             = $data['harga'];

		$query2 = mysqli_query($mysqli, "SELECT a.id_transaksi,sum(a.jumlah) as jml_transaksi,a.id_masuk,
												b.id_masuk,b.jumlah as jml_ikan 
												FROM transaksi_lelang as a INNER JOIN ikan_masuk as b
												ON a.id_masuk=b.id_masuk
												WHERE a.id_masuk='$id_masuk'")
												or die('Ada kesalahan pada query tampil data jumlah: '.mysqli_error($mysqli));

    	$data2 = mysqli_fetch_assoc($query2);
    	$jumlah_ikan = $data2['jml_ikan'] - $data2['jml_transaksi'];
  	}
?>
	
	<script type="text/javascript">
	function cek_stok(input) {
	  	jml_ikan = document.frmTransaksi.jumlah_ikan.value;
	  	jml_transaksi = document.frmTransaksi.jumlah_transaksi.value;
	  	var num = input.value;
	  	var jumlah_ikan = eval(jml_ikan);
	  	var jumlah_transaksi = eval(jml_transaksi);
	    if(jumlah_ikan < jumlah_transaksi){
	      	alert('Jumlah Ikan Tidak Memenuhi, Kurangi Jumlah Transaksi Lelang');
	    	input.value = input.value.substring(0,input.value.length-1);
	    }
	}
	</script>

	<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="?module=beranda">Beranda</a>
			</li>

			<li>
				<a href="?module=transaksi">Transaksi Lelang</a>
			</li>

			<li class="active">Ubah</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-edit"></i>
				Ubah Transaksi Lelang
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!--PAGE CONTENT BEGINS-->
				<form class="form-horizontal" role="form" action="modules/transaksi/proses.php?act=update" method="POST" name="frmTransaksi" />
					
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Telepon</label>

						<div class="col-sm-9">
							<input type="text" class="col-xs-12 col-sm-5" name="id_transaksi" value="<?php echo $id_transaksi; ?>" readonly required />
						</div>
					</div>

					<input type="hidden" id="id_masuk" name="id_masuk" value="<?php echo $id_masuk; ?>" />

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Tanggal</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="tanggal_transaksi" value="<?php echo $tanggal_transaksi; ?>" required />
								<span class="input-group-addon">
									<i class="fa fa-calendar bigger-110"></i>
								</span>
							</div>
						</div>
					</div>

					<div class="hr hr-16 dotted"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Ikan</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" id="nama_ikan" name="nama_ikan" value="<?php echo $nama_ikan; ?>" readonly required />
								<a class="input-group-addon" data-toggle="modal" href="#modal-form">
									<i class="ace-icon fa fa-search"></i>
								</a>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Nelayan</label>

						<div style="padding-right:20px" class="col-sm-4">
							<input type="text" class="form-control" id="nama_nelayan" name="nama_nelayan" value="<?php echo $nama_nelayan; ?>" readonly required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Jumlah Ikan</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah_ikan" name="jumlah_ikan" value="<?php echo $jumlah_ikan; ?>" readonly required />
								<span class="input-group-addon">Kg</span>
							</div>
						</div>
					</div>

					<div style="padding-right:20px" class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Nama Pembeli</label>

						<div class="col-sm-4">
							<select class="chosen-select" name="pembeli" data-placeholder="Pilih Pembeli..." required>
								<option value="<?php echo $id_pembeli; ?>"><?php echo $nama_pembeli; ?></option>
								<?php
								$query_pembeli = mysqli_query($mysqli, "SELECT id_pembeli, nama_pembeli FROM pembeli 
																		ORDER BY nama_pembeli ASC")
																		or die('Ada kesalahan pada query tampil data pembeli : '.mysqli_error($mysqli));
																
								while($data_pembeli = mysqli_fetch_assoc($query_pembeli)) {
								    echo"<option value=\"$data_pembeli[id_pembeli]\"> $data_pembeli[nama_pembeli] </option>";

								}
								?>
							</select>
						</div>
					</div>

					<div class="hr hr-16 dotted"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Jumlah</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<input type="text" class="form-control" id="jumlah_transaksi" name="jumlah_transaksi" maxlength="5"  autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="cek_stok(this)" value="<?php echo $jumlah_transaksi; ?>" required />
								<span class="input-group-addon">Kg</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">Harga</label>

						<div style="padding-right:20px" class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">Rp</span>
								<input type="text" class="form-control" id="harga" name="harga" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo format_rupiah_nol($harga); ?>" required />
							</div>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-2 col-md-10">
							<input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
							&nbsp; &nbsp;
							<a style="width:100px" href="?module=transaksi" class="btn">Batal</a>
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
										<th>Sisa</th>
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

									$query2 = mysqli_query($mysqli, "SELECT a.id_transaksi,sum(a.jumlah) as jml_transaksi,a.id_masuk,
																b.id_masuk,b.jumlah as jml_ikan 
																FROM transaksi_lelang as a INNER JOIN ikan_masuk as b
																ON a.id_masuk=b.id_masuk
																WHERE a.id_masuk='$data[id_masuk]'")
																or die('Ada kesalahan pada query tampil data jumlah: '.mysqli_error($mysqli));

	                            	$data2 = mysqli_fetch_assoc($query2);
	                            	$stok = $data2['jml_ikan'] - $data2['jml_transaksi'];
	                            ?>
	                            	<tr>
										<td width="30" class="center"><?php echo $no; ?></td>
										<td width="80" class="center"><?php echo $tanggal_masuk; ?></td>
										<td width="150"><?php echo $data['nama_ikan']; ?></td>
										<td width="150"><?php echo $data['nama_nelayan']; ?></td>
										<td width="90" align="right"><?php echo $data['jumlah']; ?> Kg</td>
										<td width="90" align="right"><?php echo $stok; ?> Kg</td>

										<td width="50" class="center">
											<div class="action-buttons">
												<button data-rel="tooltip" data-placement="top" title="Pilih" class="pilih_data tooltip-info btn btn-primary btn-xs" data-id="<?php echo $data['id_masuk']; ?>" data-ikan="<?php echo $data['nama_ikan']; ?>" data-nelayan="<?php echo $data['nama_nelayan']; ?>" data-jml="<?php echo $stok; ?>">
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
			var id_masuk     = $(this).attr('data-id');
			var nama_ikan    = $(this).attr('data-ikan');
			var nama_nelayan = $(this).attr('data-nelayan');
			var jumlah_ikan  = $(this).attr('data-jml');

			$('#id_masuk').val(id_masuk);
			$('#nama_ikan').val(nama_ikan);
			$('#nama_nelayan').val(nama_nelayan);
			$('#jumlah_ikan').val(jumlah_ikan);

  		   	$("#modal-form").modal('hide');
	    });
	</script>
<?php
}
?>