<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="?module=beranda">Beranda</a>
		</li>

		<li class="active">Ikan</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-folder-o"></i> Ikan
			<a href="?module=form_ikan&form=add">
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
// tampilkan pesan "data ikan baru berhasil disimpan"
elseif ($_GET['alert'] == 1) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data ikan baru berhasil disimpan.
		<br>
	</div>
<?php
} 
// jika alert = 2
// tampilkan pesan Sukses "data ikan berhasil diubah"
elseif ($_GET['alert'] == 2) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data ikan berhasil diubah.
		<br>
	</div>
<?php
}
// jika alert = 3
// tampilkan pesan Sukses "data ikan berhasil dihapus"
elseif ($_GET['alert'] == 3) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data ikan berhasil dihapus.
		<br>
	</div>
<?php
} 
// jika alert = 4
// tampilkan pesan Upload Gagal "pastikan file yang diupload sudah benar"
elseif ($_GET['alert'] == 4) { ?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-times-circle"></i> Upload Gagal! </strong><br>
		pastikan file yang diupload sudah benar.
		<br>
	</div>
<?php
}
// jika alert = 5
// tampilkan pesan Upload Gagal "pastikan ukuran foto tidak lebih dari 1MB"
elseif ($_GET['alert'] == 5) { ?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-times-circle"></i> Upload Gagal! </strong><br>
		pastikan ukuran foto tidak lebih dari 1MB.
		<br>
	</div>
<?php
} 
// jika alert = 6
// tampilkan pesan Upload Gagal "pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG"
elseif ($_GET['alert'] == 6) { ?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-times-circle"></i> Upload Gagal! </strong><br>
		pastikan file yang diupload bertipe *.JPG, *.JPEG, *.PNG.
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
						Data Jenis Ikan
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Gambar</th>
									<th>Nama Ikan</th>
									<th class="hidden-480">Keterangan</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
							<?php
							$no = 1;
							// fungsi query untuk menampilkan data dari tabel ikan
							$query = mysqli_query($mysqli, "SELECT * FROM ikan ORDER BY id_ikan DESC")
															or die('Ada kesalahan pada query tampil data ikan: '.mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) { 
                            	if ($data['gambar']=="") {
		                        	$gambar = "no_image.gif";
		                        } else {
		                        	$gambar = $data['gambar'];
		                        }
                            ?>
                            	<tr>
									<td width="60" class="center"><?php echo $no; ?></td>
									<td width="130" class="center">
										<img src="../images/ikan/<?php echo $data['gambar']; ?>" width="110px" />
									</td>
									<td width="130"><?php echo $data['nama_ikan']; ?></td>
									<td class="hidden-480" width="250"><?php echo $data['keterangan']; ?></td>

									<td width="70" class="center">
										<div class="action-buttons">
											<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" href="?module=form_ikan&form=edit&id=<?php echo $data['id_ikan']; ?>">
												<i class="ace-icon fa fa-edit bigger-130"></i>
											</a>

											<a data-rel="tooltip" data-placement="top" title="Hapus" class="red tooltip-error" href="modules/ikan/proses.php?act=delete&id=<?php echo $data['id_ikan'];?>" onclick="return confirm('Anda yakin ingin menghapus ikan <?php echo $data['nama_ikan']; ?> ?');">
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