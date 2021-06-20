<?php
// panggil file database.php untuk koneksi ke database
require_once "../config/database.php";
// panggil fungsi untuk format tanggal
require_once "../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
require_once "../config/fungsi_rupiah.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
	// jika halaman konten yang dipilih beranda, panggil file view beranda
	if ($_GET['module']=='beranda') {
		include "modules/beranda/view.php";
	}

	// jika halaman konten yang dipilih ikan, panggil file view ikan
	elseif ($_GET['module']=='ikan' && $_SESSION['hak_akses']=='Admin') {
		include "modules/ikan/view.php";
	}

	// jika halaman konten yang dipilih form ikan, panggil file form ikan
	elseif ($_GET['module']=='form_ikan' && $_SESSION['hak_akses']=='Admin') {
		include "modules/ikan/form.php";
	}
	// ---------------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih nelayan, panggil file view nelayan
	elseif ($_GET['module']=='nelayan' && $_SESSION['hak_akses']=='Admin') {
		include "modules/nelayan/view.php";
	}

	// jika halaman konten yang dipilih form nelayan, panggil file form nelayan
	elseif ($_GET['module']=='form_nelayan' && $_SESSION['hak_akses']=='Admin') {
		include "modules/nelayan/form.php";
	}
	// ---------------------------------------------------------------------------------

	// jika halaman konten yang dipilih pembeli, panggil file view pembeli
	elseif ($_GET['module']=='pembeli' && $_SESSION['hak_akses']=='Admin') {
		include "modules/pembeli/view.php";
	}

	// jika halaman konten yang dipilih form pembeli, panggil file form pembeli
	elseif ($_GET['module']=='form_pembeli' && $_SESSION['hak_akses']=='Admin') {
		include "modules/pembeli/form.php";
	}
	// ---------------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih jadwal, panggil file view jadwal
	elseif ($_GET['module']=='jadwal' && $_SESSION['hak_akses']=='Admin') {
		include "modules/jadwal/view.php";
	}

	// jika halaman konten yang dipilih form jadwal, panggil file form jadwal
	elseif ($_GET['module']=='form_jadwal' && $_SESSION['hak_akses']=='Admin') {
		include "modules/jadwal/form.php";
	}
	// ---------------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih ikan masuk, panggil file view ikan masuk
	elseif ($_GET['module']=='ikan_masuk' && $_SESSION['hak_akses']=='Admin') {
		include "modules/ikan-masuk/view.php";
	}

	// jika halaman konten yang dipilih form ikan masuk, panggil file form ikan masuk
	elseif ($_GET['module']=='form_ikan_masuk' && $_SESSION['hak_akses']=='Admin') {
		include "modules/ikan-masuk/form.php";
	}
	// ---------------------------------------------------------------------------------

	// jika halaman konten yang dipilih transaksi, panggil file view transaksi
	elseif ($_GET['module']=='transaksi' && $_SESSION['hak_akses']=='Admin') {
		include "modules/transaksi/view.php";
	}

	// jika halaman konten yang dipilih form transaksi, panggil file form transaksi
	elseif ($_GET['module']=='form_transaksi' && $_SESSION['hak_akses']=='Admin') {
		include "modules/transaksi/form.php";
	}
	// ---------------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan, panggil file view laporan
	elseif ($_GET['module']=='lap_transaksi' && $_SESSION['hak_akses']=='Admin') {
		include "modules/lap-transaksi/view.php";
	}
	// ---------------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih laporan, panggil file view laporan
	elseif ($_GET['module']=='lap_ikan_masuk' && $_SESSION['hak_akses']=='Dinas') {
		include "modules/lap-ikan-masuk/view.php";
	}
	// ---------------------------------------------------------------------------------

	// jika halaman konten yang dipilih diskusi, panggil file view diskusi
	elseif ($_GET['module']=='diskusi' && $_SESSION['hak_akses']=='Admin') {
		include "modules/diskusi/view.php";
	}

	// jika halaman konten yang dipilih form diskusi, panggil file form diskusi
	elseif ($_GET['module']=='form_diskusi' && $_SESSION['hak_akses']=='Admin') {
		include "modules/diskusi/form.php";
	}
	// ---------------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih password, panggil file view password
	elseif ($_GET['module']=='password') {
		include "modules/password/view.php";
	}
}
?>