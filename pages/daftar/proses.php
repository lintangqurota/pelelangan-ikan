<?php
// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

if (isset($_POST['daftar'])) {
	// ambil data hasil submit dari form
	$nama       = mysqli_real_escape_string($mysqli, trim($_POST['nama']));
	$alamat     = mysqli_real_escape_string($mysqli, trim($_POST['alamat']));
	$no_telepon = mysqli_real_escape_string($mysqli, trim($_POST['no_telepon']));

	// maka jalankan perintah query untuk menyimpan data ke tabel pesan
	$query = mysqli_query($mysqli, "INSERT INTO pembeli(nama_pembeli,
														alamat,
														telepon)
												 VALUES('$nama',
														'$alamat',
														'$no_telepon')")	
								or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    
	// cek query
	if ($query) {
		// jika berhasil tampilkan pesan berhasil simpan data
		header("location: ../../main.php?page=daftar&alert=1");
	}	
}	
?>