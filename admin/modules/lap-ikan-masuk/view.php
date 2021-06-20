<div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="?module=beranda">Beranda</a>
		</li>

		<li class="active">Laporan</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-file-text-o"></i>
			Laporan Ikan Masuk
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!--PAGE CONTENT BEGINS-->
			<form class="form-horizontal" role="form" action="modules/lap-ikan-masuk/cetak.php" method="GET" target="_blank" />
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right">Dari Tanggal</label>

					<div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="tgl_awal" required />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right">Sampai Tanggal</label>

					<div class="col-sm-3">
						<div class="input-group">
							<input class="form-control date-picker" type="text" data-date-format="dd-mm-yyyy" name="tgl_akhir" required />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
							
				<div class="clearfix form-actions">
					<div class="col-md-offset-2 col-md-10">
						<button style="width:100px" type="submit" class="btn btn-primary">
							<i class="ace-icon fa fa-print bigger-125"></i>
							Cetak
						</button>
					</div>
				</div>
			</form>
			<!--PAGE CONTENT ENDS-->
		</div><!--/.span-->
	</div><!--/.row-fluid-->
</div><!--/.page-content-->