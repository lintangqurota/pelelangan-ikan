<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="?module=beranda">Beranda</a>
		</li>

		<li class="active">Jadwal Lelang</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i style="margin-right:7px" class="ace-icon fa fa-calendar"></i> Jadwal Lelang
			<a href="?module=form_jadwal&form=add">
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
// tampilkan pesan "jadwal lelang baru berhasil disimpan"
elseif ($_GET['alert'] == 1) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		jadwal lelang berhasil disimpan.
		<br>
	</div>
<?php
} 
// jika alert = 2
// tampilkan pesan Sukses "jadwal lelang berhasil diubah"
elseif ($_GET['alert'] == 2) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		jadwal lelang berhasil diubah.
		<br>
	</div>
<?php
}
// jika alert = 3
// tampilkan pesan Sukses "jadwal lelang berhasil dihapus"
elseif ($_GET['alert'] == 3) { ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<i class="ace-icon fa fa-times"></i>
		</button>
		<strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
		jadwal lelang berhasil dihapus.
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
						Data Jadwal Lelang
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Tanggal</th>
									<th>Waktu Lelang</th>
									<th>Nama Ikan</th>
									<th>Gambar</th>
									<th>Kisaran Harga</th>
									<th>Jumlah</th>
									<th>Sisa</th>
									<th class="hidden-480">Keterangan</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
							<?php
							$no = 1;
							// fungsi query untuk menampilkan data dari tabel Jadwal Lelang, ikan dan nelayan
							$query = mysqli_query($mysqli, "SELECT a.id_jadwal,a.tanggal_lelang,a.waktu_lelang,a.id_masuk,a.kisaran_harga,a.gambar,a.keterangan,
															b.id_masuk,b.jumlah,b.id_ikan,
															c.id_ikan,c.nama_ikan
															FROM jadwal as a INNER JOIN ikan_masuk as b INNER JOIN ikan as c 
															ON a.id_masuk=b.id_masuk AND b.id_ikan=c.id_ikan
															ORDER BY a.id_jadwal DESC")
															or die('Ada kesalahan pada query tampil data Jadwal Lelang: '.mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) { 
								$tanggal        = $data['tanggal_lelang'];
								$tgl            = explode('-',$tanggal);
								$tanggal_lelang = $tgl[2]."-".$tgl[1]."-".$tgl[0];
								
								$a              = $data['kisaran_harga'];
								$b              = explode('-',$a);
								$kisaran_awal   = $b[0];
								@$kisaran_akhir  = $b[1];

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
									<td width="50" class="center"><?php echo $tanggal_lelang; ?></td>
									<td width="70"><?php echo $data['waktu_lelang']; ?></td>
									<td width="120"><?php echo $data['nama_ikan']; ?></td>
									<td width="70" class="center"><img src="../images/ikan/<?php echo $data['gambar']; ?>" width="80"></td>
									<td width="120" class="center">Rp. <?php echo format_rupiah_nol($kisaran_awal); ?> - Rp. <?php echo format_rupiah_nol($kisaran_akhir); ?></td>
									<td width="70" align="right"><?php echo $data['jumlah']; ?> Kg</td>
									<td width="70" align="right"><?php echo $stok; ?> Kg</td>
									<td class="hidden-480" width="120"><?php echo $data['keterangan']; ?></td>

									<td width="50" class="center">
										<div class="action-buttons">
											<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" href="?module=form_jadwal&form=edit&id=<?php echo $data['id_jadwal']; ?>">
												<i class="ace-icon fa fa-edit bigger-130"></i>
											</a>

											<a data-rel="tooltip" data-placement="top" title="Hapus" class="red tooltip-error" href="modules/jadwal/proses.php?act=delete&id=<?php echo $data['id_jadwal'];?>" onclick="return confirm('Anda yakin ingin menghapus jadwal tanggal <?php echo $tanggal_lelang; ?> ?');">
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