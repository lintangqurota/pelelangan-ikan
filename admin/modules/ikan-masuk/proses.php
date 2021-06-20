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
            $tanggal       = $_POST['tanggal_masuk'];
            $tgl           = explode('-',$tanggal);
            $tanggal_masuk = $tgl[2]."-".$tgl[1]."-".$tgl[0];
            
            $ikan          = mysqli_real_escape_string($mysqli, trim($_POST['ikan']));
            $nelayan       = mysqli_real_escape_string($mysqli, trim($_POST['nelayan']));
            $jumlah        = mysqli_real_escape_string($mysqli, trim($_POST['jumlah']));

            // perintah query untuk menyimpan data ke tabel ikan masuk
            $query = mysqli_query($mysqli, "INSERT INTO ikan_masuk(tanggal_masuk,id_ikan,id_nelayan,jumlah)
                                            VALUES('$tanggal_masuk','$ikan','$nelayan','$jumlah')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=ikan_masuk&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_masuk'])) {
                // ambil data hasil submit dari form
                $id_masuk      = mysqli_real_escape_string($mysqli, trim($_POST['id_masuk']));

                $tanggal       = $_POST['tanggal_masuk'];
                $tgl           = explode('-',$tanggal);
                $tanggal_masuk = $tgl[2]."-".$tgl[1]."-".$tgl[0];
                
                $ikan          = mysqli_real_escape_string($mysqli, trim($_POST['ikan']));
                $nelayan       = mysqli_real_escape_string($mysqli, trim($_POST['nelayan']));
                $jumlah        = mysqli_real_escape_string($mysqli, trim($_POST['jumlah']));

                // perintah query untuk mengubah data pada tabel ikan masuk
                $query = mysqli_query($mysqli, "UPDATE ikan_masuk SET   tanggal_masuk = '$tanggal_masuk',
                                                                        id_ikan       = '$ikan',
                                                                        id_nelayan    = '$nelayan',
                                                                        jumlah        = '$jumlah'
                                                                  WHERE id_masuk      = '$id_masuk'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=ikan_masuk&alert=2");
                }       
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $id_masuk = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel ikan masuk
            $query = mysqli_query($mysqli, "DELETE FROM ikan_masuk WHERE id_masuk='$id_masuk'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=ikan_masuk&alert=3");
            }
        }
    }       
}       
?>