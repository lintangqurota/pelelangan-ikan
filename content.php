<?php
/* panggil file database.php untuk koneksi ke database */
require_once "config/database.php";
/* panggil file untuk format nama hari */
require_once "config/fungsi_nama_hari.php";
// panggil fungsi untuk format rupiah
require_once "config/fungsi_rupiah.php";

// fungsi untuk pemanggilan file halaman konten
// jika halaman konten yang dipilih home, panggil file view home
if ($_GET['page'] == 'home') {
	include "pages/home/view.php";
}

// jika halaman konten yang dipilih jadwal, panggil file view jadwal
if ($_GET['page'] == 'jadwal') {
	include "pages/jadwal/view.php";
}

// jika halaman konten yang dipilih ikan, panggil file view ikan
if ($_GET['page'] == 'ikan') {
	include "pages/ikan/view.php";
}

// jika halaman konten yang dipilih laporan, panggil file view laporan
if ($_GET['page'] == 'laporan') {
	include "pages/laporan/view.php";
}

// jika halaman konten yang dipilih daftar, panggil file view daftar
elseif ($_GET['page'] == 'daftar') {
	include "pages/daftar/view.php";
}

// jika halaman konten yang dipilih diskusi, panggil file view diskusi
elseif ($_GET['page'] == 'diskusi') {
	include "pages/diskusi/view.php";
}
?>