<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $tanggal            = $_POST['tanggal_lelang'];
            $tgl                = explode('-',$tanggal);
            $tanggal_lelang     = $tgl[2]."-".$tgl[1]."-".$tgl[0];
            
            $waktu_lelang       = mysqli_real_escape_string($mysqli, trim($_POST['waktu_lelang']));
            $id_masuk           = mysqli_real_escape_string($mysqli, trim($_POST['id_masuk']));
            $kisaran_harga      = mysqli_real_escape_string($mysqli, trim($_POST['kisaran_harga']));
            $keterangan         = mysqli_real_escape_string($mysqli, trim($_POST['keterangan']));
            
            $nama_file          = $_FILES['gambar']['name'];
            $ukuran_file        = $_FILES['gambar']['size'];
            $tipe_file          = $_FILES['gambar']['type'];
            $tmp_file           = $_FILES['gambar']['tmp_name'];
            
            // tentuka extension yang diperbolehkan
            $allowed_extensions = array('jpg','jpeg','png');
            
            // Set path folder tempat menyimpan gambarnya
            $path               = "../../../images/ikan/".$nama_file;
            
            // check extension
            $file               = explode(".", $nama_file);
            $extension          = array_pop($file);

            // Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
            if(in_array($extension, $allowed_extensions)) {
                // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
                if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
                    // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
                    // Proses upload
                    if(move_uploaded_file($tmp_file, $path)) { // Cek apakah gambar berhasil diupload atau tidak
                        // Jika gambar berhasil diupload, Lakukan : 
                        // perintah query untuk menyimpan data ke tabel jadwal
                        $query = mysqli_query($mysqli, "INSERT INTO jadwal(tanggal_lelang,waktu_lelang,id_masuk,kisaran_harga,gambar,keterangan)
                                                        VALUES('$tanggal_lelang','$waktu_lelang','$id_masuk','$kisaran_harga','$nama_file','$keterangan')")
                                                        or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

                        // cek query
                        if ($query) {
                            // jika berhasil tampilkan pesan berhasil simpan data
                            header("location: ../../main.php?module=jadwal&alert=1");
                        }  
                    } else {
                        // Jika gambar gagal diupload, tampilkan pesan gagal upload
                        header("location: ../../main.php?module=jadwal&alert=4");
                    }
                } else {
                    // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
                    header("location: ../../main.php?module=jadwal&alert=5");
                }
            } else {
                // Jika tipe file yang diupload bukan JPG / JPEG / PNG, tampilkan pesan gagal upload
                header("location: ../../main.php?module=jadwal&alert=6");
            }
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_masuk'])) {
                // ambil data hasil submit dari form
                $id_jadwal          = mysqli_real_escape_string($mysqli, trim($_POST['id_jadwal']));
                
                $tanggal            = $_POST['tanggal_lelang'];
                $tgl                = explode('-',$tanggal);
                $tanggal_lelang     = $tgl[2]."-".$tgl[1]."-".$tgl[0];
                
                $waktu_lelang       = mysqli_real_escape_string($mysqli, trim($_POST['waktu_lelang']));
                $id_masuk           = mysqli_real_escape_string($mysqli, trim($_POST['id_masuk']));
                $kisaran_harga      = mysqli_real_escape_string($mysqli, trim($_POST['kisaran_harga']));
                $keterangan         = mysqli_real_escape_string($mysqli, trim($_POST['keterangan']));
                
                $nama_file          = $_FILES['gambar']['name'];
                $ukuran_file        = $_FILES['gambar']['size'];
                $tipe_file          = $_FILES['gambar']['type'];
                $tmp_file           = $_FILES['gambar']['tmp_name'];
                
                // tentuka extension yang diperbolehkan
                $allowed_extensions = array('jpg','jpeg','png');
                
                // Set path folder tempat menyimpan gambarnya
                $path               = "../../../images/ikan/".$nama_file;
                
                // check extension
                $file               = explode(".", $nama_file);
                $extension          = array_pop($file);

                if (empty($nama_file)) {
                    // perintah query untuk mengubah data pada tabel jadwal
                    $query = mysqli_query($mysqli, "UPDATE jadwal SET tanggal_lelang    = '$tanggal_lelang',
                                                                      waktu_lelang      = '$waktu_lelang',
                                                                      id_masuk          = '$id_masuk',
                                                                      kisaran_harga     = '$kisaran_harga',
                                                                      keterangan        = '$keterangan'
                                                                WHERE id_jadwal         = '$id_jadwal'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                    
                    // cek query
                    if ($query) {
                        // jika berhasil tampilkan pesan berhasil update data
                        header("location: ../../main.php?module=jadwal&alert=2");
                    }   
                } else {
                    // Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
                    if(in_array($extension, $allowed_extensions)) {
                        // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
                        if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
                            // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
                            // Proses upload
                            if(move_uploaded_file($tmp_file, $path)) { // Cek apakah gambar berhasil diupload atau tidak
                                // Jika gambar berhasil diupload, Lakukan : 
                                // perintah query untuk mengubah data pada tabel jadwal
                                $query = mysqli_query($mysqli, "UPDATE jadwal SET tanggal_lelang    = '$tanggal_lelang',
                                                                                  waktu_lelang      = '$waktu_lelang',
                                                                                  id_masuk          = '$id_masuk',
                                                                                  kisaran_harga     = '$kisaran_harga',
                                                                                  gambar            = '$nama_file',
                                                                                  keterangan        = '$keterangan'
                                                                            WHERE id_jadwal         = '$id_jadwal'")
                                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                                
                                // cek query
                                if ($query) {
                                    // jika berhasil tampilkan pesan berhasil update data
                                    header("location: ../../main.php?module=jadwal&alert=2");
                                } 
                            } else {
                                // Jika gambar gagal diupload, tampilkan pesan gagal upload
                                header("location: ../../main.php?module=jadwal&alert=4");
                            }
                        } else {
                            // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
                            header("location: ../../main.php?module=jadwal&alert=5");
                        }
                    } else {
                        // Jika tipe file yang diupload bukan JPG / JPEG / PNG, tampilkan pesan gagal upload
                        header("location: ../../main.php?module=jadwal&alert=6");
                    }
                }

                 
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $id_jadwal = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel jadwal
            $query = mysqli_query($mysqli, "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=jadwal&alert=3");
            }
        }
    }       
}       
?>