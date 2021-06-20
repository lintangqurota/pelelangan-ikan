<?php
session_start();
ob_start();

// panggil file database.php untuk koneksi ke database
require_once "../../../config/database.php";
// panggil fungsi untuk format tanggal
require_once "../../../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
require_once "../../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");
// ambil data dari submit form
$tgl_awal      = $_GET['tgl_awal'];
$tgl1          = explode('-',$tgl_awal);
$tanggal_awal  = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];

$tgl_akhir     = $_GET['tgl_akhir'];
$tgl2          = explode('-',$tgl_akhir);
$tanggal_akhir = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];

// fungsi query untuk menampilkan data dari tabel siswa dan kelas
$query = mysqli_query($mysqli, "SELECT a.id_transaksi,a.tanggal_transaksi,a.id_masuk,a.id_pembeli,a.jumlah as jumlah_transaksi,a.harga,
                                b.id_masuk,b.jumlah as jumlah_ikan,b.id_ikan,b.id_nelayan,
                                c.id_ikan,c.nama_ikan,
                                d.id_nelayan,d.nama_nelayan,
                                e.id_pembeli,e.nama_pembeli
                                FROM transaksi_lelang as a INNER JOIN ikan_masuk as b INNER JOIN ikan as c INNER JOIN nelayan as d INNER JOIN pembeli as e
                                ON a.id_masuk=b.id_masuk AND b.id_ikan=c.id_ikan AND b.id_nelayan=d.id_nelayan AND a.id_pembeli=e.id_pembeli
                                WHERE a.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                                ORDER BY a.id_transaksi ASC")
                                or die('Ada kesalahan pada query tampil data transaksi: '.mysqli_error($mysqli));

$rows = mysqli_num_rows($query);
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN TRANSAKSI LELANG</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
        <div id="title">
            TEMPAT PELELANGAN IKAN (TPI)
        </div>

        <div id="title-perusahaan">
            DERMAGA BOM KALIANDA
        </div>

        <div id="title-alamat">
            Alamat: Jalan Pratu M. Amin, Kalianda, Lampung Selatan
        </div>
        
        <div style="margin:-68px 0 0 30px">
            <img src="../../assets/img/logo-dinas.png" height="60">
        </div>

        <div style="margin:-60px 0 0 650px">
            <img src="../../assets/img/logo-koperasi.png" height="55">
        </div>

        <hr><br>
        
        <div id="title">
            LAPORAN TRANSAKSI LELANG
        </div>
        <br>
        <div id="isi">
            <table width="100%" border="0.5" cellpadding="0" cellspacing="0">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">No.</th>
                    <th height="20" align="center" valign="middle">ID Transaksi</th>
                    <th height="20" align="center" valign="middle">Tanggal</th>
                    <th height="20" align="center" valign="middle">Nama Ikan</th>
                    <th height="20" align="center" valign="middle">Nama Nelayan</th>
                    <th height="20" align="center" valign="middle">Nama Pembeli</th>
                    <th height="20" align="center" valign="middle">Jumlah</th>
                    <th height="20" align="center" valign="middle">Harga</th>
                </tr>

                <?php
                for($i=1; $i<=$rows; $i++) {
                    $data = mysqli_fetch_assoc($query);

                    $id_transaksi      = $data['id_transaksi'];
                    
                    $tanggal           = $data['tanggal_transaksi'];
                    $tgl               = explode('-',$tanggal);
                    $tanggal_transaksi = $tgl[2]."-".$tgl[1]."-".$tgl[0];
                    
                    $nama_ikan         = $data['nama_ikan'];
                    $nama_nelayan      = $data['nama_nelayan'];
                    $nama_pembeli      = $data['nama_pembeli'];
                    $jumlah            = $data['jumlah_transaksi'];
                    $harga             = format_rupiah_nol($data['harga']);
                ?>  
                <tr>
                    <td width="30" height="13" align="center" valign="middle"><?=$i?></td>
                    <td width="70" height="13" align="center" valign="middle"><?=$id_transaksi?></td>
                    <td width="60" height="13" align="center" valign="middle"><?=$tanggal_transaksi?></td>
                    <td style="padding-left:5px;" width="115" height="13" valign="middle"><?=$nama_ikan?></td>
                    <td style="padding-left:5px;" width="115" height="13" valign="middle"><?=$nama_nelayan?></td>
                    <td style="padding-left:5px;" width="115" height="13" valign="middle"><?=$nama_pembeli?></td>
                    <td style="padding-right:5px;" width="60" height="13" align="right" valign="middle"><?=$jumlah?> Kg</td>
                    <td style="padding-right:5px;" width="78" height="13" align="right" valign="middle">Rp. <?=$harga?></td>
                </tr>
                <?php 
                } 

                $query2 = mysqli_query($mysqli, "SELECT id_transaksi,tanggal_transaksi, SUM(jumlah) as total_jumlah, SUM(harga) as total_harga
                                                 FROM transaksi_lelang
                                                 WHERE tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'")
                                                 or die('Ada kesalahan pada query tampil data jumlah transaksi: '.mysqli_error($mysqli));

                $data2 = mysqli_fetch_assoc($query2);

                $total_jumlah = $data2['total_jumlah'];
                $total_harga  = format_rupiah_nol($data2['total_harga']);
                ?>
                <tr>
                    <td height="14" align="center" valign="middle" colspan="6"><strong>Jumlah Total</strong></td>
                    <td style="padding-right:5px;" height="14" align="right" valign="middle"><strong><?=$total_jumlah?> Kg</strong></td>
                    <td style="padding-right:5px;" height="14" align="right" valign="middle"><strong>Rp. <?=$total_harga?></strong></td>
                </tr>
            </table>

            <div id="footer-tanggal">
                Kalianda, <?php echo tgl_eng_to_ind("$hari_ini"); ?> <br>
                Ketua Koperasi,
            </div>
            <div id="footer-pimpinan">
                Shobri
            </div>
        </div>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="LAPORAN TRANSAKSI LELANG.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
require_once('../../assets/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(8, 10, 8, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>