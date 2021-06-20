<?php
session_start();
ob_start();

// panggil file database.php untuk koneksi ke database
require_once "../../../config/database.php";
// panggil fungsi untuk format tanggal
require_once "../../../config/fungsi_tanggal.php";

$hari_ini = date("d-m-Y");
// ambil data dari submit form
$tgl_awal      = $_GET['tgl_awal'];
$tgl1          = explode('-',$tgl_awal);
$tanggal_awal  = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];

$tgl_akhir     = $_GET['tgl_akhir'];
$tgl2          = explode('-',$tgl_akhir);
$tanggal_akhir = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];

// fungsi query untuk menampilkan data dari tabel siswa dan kelas
$query = mysqli_query($mysqli, "SELECT a.id_masuk,a.tanggal_masuk,a.id_ikan,a.id_nelayan,a.jumlah,
                                b.id_ikan,b.nama_ikan,
                                c.id_nelayan,c.nama_nelayan
                                FROM ikan_masuk as a INNER JOIN ikan as b INNER JOIN nelayan as c
                                ON a.id_ikan=b.id_ikan AND a.id_nelayan=c.id_nelayan
                                WHERE a.tanggal_masuk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                                ORDER BY a.id_masuk ASC")
                                or die('Ada kesalahan pada query tampil data ikan masuk: '.mysqli_error($mysqli));

$rows = mysqli_num_rows($query);
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN IKAN MASUK</title>
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
            LAPORAN IKAN MASUK
        </div>
        <br>
        <div id="isi">
            <table width="100%" border="0.5" cellpadding="0" cellspacing="0">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">No.</th>
                    <th height="20" align="center" valign="middle">Tanggal Masuk</th>
                    <th height="20" align="center" valign="middle">Nama Ikan</th>
                    <th height="20" align="center" valign="middle">Nama Nelayan</th>
                    <th height="20" align="center" valign="middle">Jumlah</th>
                </tr>

                <?php
                for($i=1; $i<=$rows; $i++) {
                    $data = mysqli_fetch_assoc($query);
        
                    $tanggal       = $data['tanggal_masuk'];
                    $tgl           = explode('-',$tanggal);
                    $tanggal_masuk = $tgl[2]."-".$tgl[1]."-".$tgl[0];
                    
                    $nama_ikan     = $data['nama_ikan'];
                    $nama_nelayan  = $data['nama_nelayan'];
                    $jumlah        = $data['jumlah'];
                ?>  
                <tr>
                    <td width="50" height="13" align="center" valign="middle"><?=$i?></td>
                    <td width="138" height="13" align="center" valign="middle"><?=$tanggal_masuk?></td>
                    <td style="padding-left:5px;" width="180" height="13" valign="middle"><?=$nama_ikan?></td>
                    <td style="padding-left:5px;" width="180" height="13" valign="middle"><?=$nama_nelayan?></td>
                    <td style="padding-right:5px;" width="130" height="13" align="right" valign="middle"><?=$jumlah?> Kg</td>
                </tr>
                <?php 
                } 

                $query2 = mysqli_query($mysqli, "SELECT id_masuk, tanggal_masuk, SUM(jumlah) as jumlah_total
                                                 FROM ikan_masuk
                                                 WHERE tanggal_masuk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'")
                                                 or die('Ada kesalahan pada query tampil data jumlah : '.mysqli_error($mysqli));

                $data2 = mysqli_fetch_assoc($query2);

                $jumlah_total = $data2['jumlah_total'];
                ?>
                <tr>
                    <td height="14" align="center" valign="middle" colspan="4"><strong>Jumlah Total</strong></td>
                    <td style="padding-right:5px;" height="14" align="right" valign="middle"><strong><?=$jumlah_total?> Kg</strong></td>
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
$filename="LAPORAN IKAN MASUK.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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