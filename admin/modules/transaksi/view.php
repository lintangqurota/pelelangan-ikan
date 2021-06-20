<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="?module=beranda">Beranda</a>
		</li>

		<li class="active">Transaksi Lelang</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i style="margin-right:7px" class="ace-icon fa fa-clone"></i> Transaksi Lelang
			<a href="?module=form_transaksi&form=add">
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
// tampilkan pesan "data transaksi lelang berhasil disimpan"
elseif ($_GET['alert'] == 1) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data transaksi lelang berhasil disimpan.
		<br>
	</div>
<?php
} 
// jika alert = 2
// tampilkan pesan Sukses "Transaksi Lelang berhasil diubah"
elseif ($_GET['alert'] == 2) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data transaksi lelang berhasil diubah.
		<br>
	</div>
<?php
}
// jika alert = 3
// tampilkan pesan Sukses "Transaksi Lelang berhasil dihapus"
elseif ($_GET['alert'] == 3) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		data transaksi lelang berhasil dihapus.
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
						Data Transaksi Lelang
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>ID Transaksi</th>
									<th>Tanggal</th>
									<th>Nama Ikan</th>
									<th class="hidden-480">Nama Nelayan</th>
									<th>Nama Pembeli</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
							<?php
							$no = 1;
							// fungsi query untuk menampilkan data dari tabel Transaksi Lelang, ikan masuk, ikan, nelayan dan pembeli
							$query = mysqli_query($mysqli, "SELECT a.id_transaksi,a.tanggal_transaksi,a.id_masuk,a.id_pembeli,a.jumlah as jumlah_transaksi,a.harga,
															b.id_masuk,b.jumlah as jumlah_ikan,b.id_ikan,b.id_nelayan,
															c.id_ikan,c.nama_ikan,
															d.id_nelayan,d.nama_nelayan,
															e.id_pembeli,e.nama_pembeli
															FROM transaksi_lelang as a INNER JOIN ikan_masuk as b INNER JOIN ikan as c INNER JOIN nelayan as d INNER JOIN pembeli as e
															ON a.id_masuk=b.id_masuk AND b.id_ikan=c.id_ikan AND b.id_nelayan=d.id_nelayan AND a.id_pembeli=e.id_pembeli
															ORDER BY a.id_transaksi DESC")
															or die('Ada kesalahan pada query tampil data Transaksi Lelang: '.mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) { 
								$tanggal           = $data['tanggal_transaksi'];
								$tgl               = explode('-',$tanggal);
								$tanggal_transaksi = $tgl[2]."-".$tgl[1]."-".$tgl[0];
                            ?>
                            	<tr>
									<td width="30" class="center"><?php echo $no; ?></td>
									<td width="90" class="center"><?php echo $data['id_transaksi']; ?></td>
									<td width="40" class="center"><?php echo $tanggal_transaksi; ?></td>
									<td width="120"><?php echo $data['nama_ikan']; ?></td>
									<td class="hidden-480" width="120"><?php echo $data['nama_nelayan']; ?></td>
									<td width="120"><?php echo $data['nama_pembeli']; ?></td>
									<td width="70" align="right"><?php echo $data['jumlah_transaksi']; ?> Kg</td>
									<td width="100" align="right">Rp. <?php echo format_rupiah_nol($data['harga']); ?></td>

									<td width="50" class="center">
										<div class="action-buttons">
											<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" href="?module=form_transaksi&form=edit&id=<?php echo $data['id_transaksi']; ?>">
												<i class="ace-icon fa fa-edit bigger-130"></i>
											</a>

											<a data-rel="tooltip" data-placement="top" title="Hapus" class="red tooltip-error" href="modules/transaksi/proses.php?act=delete&id=<?php echo $data['id_transaksi'];?>" onclick="return confirm('Anda yakin ingin menghapus transaksi no. <?php echo $data['id_transaksi']; ?> ?');">
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