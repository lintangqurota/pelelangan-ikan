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
            $nama    = mysqli_real_escape_string($mysqli, trim($_POST['nama']));
            $alamat  = mysqli_real_escape_string($mysqli, trim($_POST['alamat']));
            $telepon = mysqli_real_escape_string($mysqli, trim($_POST['telepon']));

            // perintah query untuk menyimpan data ke tabel nelayan
            $query = mysqli_query($mysqli, "INSERT INTO nelayan(nama_nelayan,alamat,telepon)
                                            VALUES('$nama','$alamat','$telepon')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=nelayan&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_nelayan'])) {
                // ambil data hasil submit dari form
                $id_nelayan = mysqli_real_escape_string($mysqli, trim($_POST['id_nelayan']));
                $nama       = mysqli_real_escape_string($mysqli, trim($_POST['nama']));
                $alamat     = mysqli_real_escape_string($mysqli, trim($_POST['alamat']));
                $telepon    = mysqli_real_escape_string($mysqli, trim($_POST['telepon']));

                // perintah query untuk mengubah data pada tabel nelayan
                $query = mysqli_query($mysqli, "UPDATE nelayan SET  nama_nelayan = '$nama',
                                                                    alamat       = '$alamat',
                                                                    telepon      = '$telepon'
                                                              WHERE id_nelayan   = '$id_nelayan'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=nelayan&alert=2");
                }       
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $id_nelayan = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel nelayan
            $query = mysqli_query($mysqli, "DELETE FROM nelayan WHERE id_nelayan='$id_nelayan'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=nelayan&alert=3");
            }
        }
    }       
}       
?>