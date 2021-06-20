<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="?module=beranda">Beranda</a>
		</li>

		<li class="active">Pembeli</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-users"></i> Pembeli
			<a href="?module=form_pembeli&form=add">
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
// tampilkan pesan "data pembeli baru berhasil disimpan"
elseif ($_GET['alert'] == 1) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data pembeli baru berhasil disimpan.
		<br>
	</div>
<?php
} 
// jika alert = 2
// tampilkan pesan Sukses "data pembeli berhasil diubah"
elseif ($_GET['alert'] == 2) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data pembeli berhasil diubah.
		<br>
	</div>
<?php
}
// jika alert = 3
// tampilkan pesan Sukses "data pembeli berhasil dihapus"
elseif ($_GET['alert'] == 3) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data pembeli berhasil dihapus.
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
						Data Pembeli
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Telepon</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
							<?php
							$no = 1;
							// fungsi query untuk menampilkan data dari tabel pembeli
							$query = mysqli_query($mysqli, "SELECT * FROM pembeli ORDER BY id_pembeli DESC")
															or die('Ada kesalahan pada query tampil data pembeli: '.mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) { ?>
                            	<tr>
									<td width="70" class="center"><?php echo $no; ?></td>
									<td width="150"><?php echo $data['nama_pembeli']; ?></td>
									<td width="250"><?php echo $data['alamat']; ?></td>
									<td width="100" class="center"><?php echo $data['telepon']; ?></td>

									<td width="80" class="center">
										<div class="action-buttons">
											<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" href="?module=form_pembeli&form=edit&id=<?php echo $data['id_pembeli']; ?>">
												<i class="ace-icon fa fa-edit bigger-130"></i>
											</a>

											<a data-rel="tooltip" data-placement="top" title="Hapus" class="red tooltip-error" href="modules/pembeli/proses.php?act=delete&id=<?php echo $data['id_pembeli'];?>" onclick="return confirm('Anda yakin ingin menghapus pembeli <?php echo $data['nama_pembeli']; ?> ?');">
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