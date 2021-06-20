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
            // fungsi untuk membuat id transaksi
            $query = mysqli_query($mysqli, "SELECT RIGHT(id_transaksi,3) as kode FROM transaksi_lelang
                                            ORDER BY id_transaksi DESC LIMIT 1")
                                            or die('Ada kesalahan pada query tampil id transaksi : '.mysqli_error($mysqli));

            $count = mysqli_num_rows($query);

            if ($count <> 0) {
                // mengambil data id transaksi
                $data = mysqli_fetch_assoc($query);

                $kode = $data['kode']+1;
            } else {
                $kode = 1;
            }

            // buat id transaksi
            $buat_id      = str_pad($kode, 3, "0", STR_PAD_LEFT);
            $id_transaksi = "$buat_id";
            
            // --------------------------------------------------------------------------------------------------------------
            
            // ambil data hasil submit dari form
            $tanggal           = $_POST['tanggal_transaksi'];
            $tgl               = explode('-',$tanggal);
            $tanggal_transaksi = $tgl[2]."-".$tgl[1]."-".$tgl[0];
            
            $id_masuk          = mysqli_real_escape_string($mysqli, trim($_POST['id_masuk']));
            $id_pembeli        = mysqli_real_escape_string($mysqli, trim($_POST['pembeli']));
            $jumlah            = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_transaksi']));
            $harga             = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['harga'])));

            // perintah query untuk menyimpan data ke tabel transaksi
            $query = mysqli_query($mysqli, "INSERT INTO transaksi_lelang(id_transaksi,tanggal_transaksi,id_masuk,id_pembeli,jumlah,harga)
                                            VALUES('$id_transaksi','$tanggal_transaksi','$id_masuk','$id_pembeli','$jumlah','$harga')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=transaksi&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_masuk'])) {
                // ambil data hasil submit dari form
                $id_transaksi      = mysqli_real_escape_string($mysqli, trim($_POST['id_transaksi']));

                $tanggal           = $_POST['tanggal_transaksi'];
                $tgl               = explode('-',$tanggal);
                $tanggal_transaksi = $tgl[2]."-".$tgl[1]."-".$tgl[0];
                
                $id_masuk          = mysqli_real_escape_string($mysqli, trim($_POST['id_masuk']));
                $id_pembeli        = mysqli_real_escape_string($mysqli, trim($_POST['pembeli']));
                $jumlah            = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_transaksi']));
                $harga             = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['harga'])));
                
                // perintah query untuk mengubah data pada tabel transaksi
                $query = mysqli_query($mysqli, "UPDATE transaksi_lelang SET tanggal_transaksi   = '$tanggal_transaksi',
                                                                            id_masuk            = '$id_masuk',
                                                                            id_pembeli          = '$id_pembeli',
                                                                            jumlah              = '$jumlah',
                                                                            harga               = '$harga'
                                                                      WHERE id_transaksi        = '$id_transaksi'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=transaksi&alert=2");
                }       
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $id_transaksi = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel transaksi
            $query = mysqli_query($mysqli, "DELETE FROM transaksi_lelang WHERE id_transaksi='$id_transaksi'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=transaksi&alert=3");
            }
        }
    }       
}       
?>