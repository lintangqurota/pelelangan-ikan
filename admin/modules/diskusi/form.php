<?php  
// fungsi untuk pengecekan tampilan form
// jika form reply yang dipilih
if ($_GET['form']=='reply') { ?>
 	<!-- tampilkan form add data -->
	<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="?module=beranda">Beranda</a>
			</li>

			<li>
				<a href="?module=diskusi">Diskusi</a>
			</li>

			<li class="active">Balas</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-reply"></i>
				Balas Diskusi
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
			<?php
		    // fungsi query untuk menampilkan data dari tabel diskusi
		    $query = mysqli_query($mysqli, "SELECT * FROM diskusi WHERE id_diskusi='$_GET[id]'")
		                                    or die('Ada kesalahan pada query tampil data diskusi: '.mysqli_error($mysqli));

		    while ($data = mysqli_fetch_assoc($query)) { 
		        $tgl     = substr($data['tanggal'],0,10);
				$exp     = explode('-',$tgl);
				$tanggal = $exp[2]."-".$exp[1]."-".$exp[0];
				
				$jam     = substr($data['tanggal'],11,8);
		    ?>
		    	<div class="timeline-item clearfix">
					<div style="margin-left:0" class="widget-box transparent">
						<div class="widget-header widget-header-small">
							<h5 class="widget-title smaller">
								<span href="?module=beranda" class="blue"><?php echo $data['nama']; ?></span>
								<span class="grey">(<?php echo $data['email']; ?>)</span>
							</h5>

							<span class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-up"></i>
								</a>
							</span>

							<span class="widget-toolbar">
								<span>
									<?php echo $tanggal; ?> <?php echo $jam; ?>
								</span>
							</span>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<p style="text-align:justify"><?php echo $data['komentar']; ?></p>
							</div>
						</div>
					</div>
				</div>

				<?php  
		        // fungsi query untuk menampilkan data dari tabel diskusi
		        $query2 = mysqli_query($mysqli, "SELECT * FROM diskusi WHERE balas='$data[id_diskusi]' ORDER BY id_diskusi ASC")
		                                        or die('Ada kesalahan pada query tampil data diskusi: '.mysqli_error($mysqli));
		        $row = mysqli_num_rows($query2);
		        if ($row>0) {
		            $data2 = mysqli_fetch_assoc($query2);

					$tgl2     = substr($data2['tanggal'],0,10);
					$exp      = explode('-',$tgl2);
					$tanggal2 = $exp[2]."-".$exp[1]."-".$exp[0];
					
					$jam      = substr($data2['tanggal'],11,8);
					
					$nama     = $data2['nama'];
					$email    = $data2['email'];
					$komentar = $data2['komentar'];
		        ?>
					<div class="timeline-item clearfix">
						<div style="margin-left:0" class="widget-box transparent">
							<div class="widget-header widget-header-small">
								<h5 class="widget-title smaller">
									<span href="?module=beranda" class="blue"><?php echo $nama; ?></span>
									<span class="grey">(<?php echo $email; ?>)</span>
								</h5>

								<span class="widget-toolbar">
									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>
								</span>

								<span class="widget-toolbar">
									<span>
										<?php echo $tanggal; ?> <?php echo $jam; ?>
									</span>
								</span>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<p style="text-align:justify"><?php echo $komentar; ?></p>
								</div>
							</div>
						</div>
					</div>
		        <?php
        		}
			} 
    		?>
    			<hr>
				<!--PAGE CONTENT BEGINS-->
				<form class="form-horizontal" role="form" action="modules/diskusi/proses.php?act=insert" method="POST" />
					
					<input type="hidden" name="id_diskusi" value="<?php echo $_GET['id']; ?>" />

					<div class="form-group">
						<div class="col-sm-12">
							<textarea class="col-xs-12 col-sm-8" name="komentar" rows="5" placeholder="Komentar" required></textarea>
						</div>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-20 col-md-12">
							<input style="width:100px" type="submit" class="btn btn-primary" name="balas" value="Balas" />
							&nbsp; &nbsp; 
							<a style="width:100px" href="modules/diskusi/proses.php?act=update_status&id=<?php echo $_GET['id']; ?>" class="btn">Kembali</a>
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