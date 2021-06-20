<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="?module=beranda">Beranda</a>
		</li>

		<li class="active">Ikan Masuk</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-edit"></i> Ikan Masuk
			<a href="?module=form_ikan_masuk&form=add">
                <button class="btn btn-primary pull-right">
					<i class="ace-icon fa fa-plus"></i> Tambah
				</button>
            </a>
		</h1>
	</div><!-- /.page-header -->

<?php
// fungsi untuk menampilkan pesan
// jika alert = "" (kosong)
// tampilkan pesan "" (kosong)
if (empty($_GET['alert'])) {
}
// jika alert = 1
// tampilkan pesan "data ikan masuk baru berhasil disimpan"
elseif ($_GET['alert'] == 1) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data ikan masuk berhasil disimpan.
		<br>
	</div>
<?php
} 
// jika alert = 2
// tampilkan pesan Sukses "data ikan masuk berhasil diubah"
elseif ($_GET['alert'] == 2) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data ikan masuk berhasil diubah.
		<br>
	</div>
<?php
}
// jika alert = 3
// tampilkan pesan Sukses "data ikan masuk berhasil dihapus"
elseif ($_GET['alert'] == 3) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data ikan masuk berhasil dihapus.
		<br>
	</div>
<?php
} 
?>

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="table-header">
						Data Ikan Masuk
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Tanggal Masuk</th>
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
									<td width="50" class="center"><?php echo $no; ?></td>
									<td width="120" class="center"><?php echo $tanggal_masuk; ?></td>
									<td width="180"><?php echo $data['nama_ikan']; ?></td>
									<td width="180"><?php echo $data['nama_nelayan']; ?></td>
									<td width="100" align="right"><?php echo $data['jumlah']; ?> Kg</td>

									<td width="80" class="center">
										<div class="action-buttons">
											<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" href="?module=form_ikan_masuk&form=edit&id=<?php echo $data['id_masuk']; ?>">
												<i class="ace-icon fa fa-edit bigger-130"></i>
											</a>

											<a data-rel="tooltip" data-placement="top" title="Hapus" class="red tooltip-error" href="modules/ikan-masuk/proses.php?act=delete&id=<?php echo $data['id_masuk'];?>" onclick="return confirm('Anda yakin ingin menghapus ikan <?php echo $data['nama_ikan']; ?> masuk tanggal <?php echo $tanggal_masuk; ?> ?');">
												<i class="ace-icon fa fa-trash-o bigger-130"></i>
											</a>
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
			</div><!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->