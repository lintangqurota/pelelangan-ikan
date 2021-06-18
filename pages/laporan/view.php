<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Laporan Transaksi Harian</h2>
        <ol class="breadcrumb">
            <li><a href="?page=home">Home</a>
            </li>
            <li class="active">Laporan</li>
        </ol>
    </div>
</div>
<!-- /.row -->

<!-- Intro Content -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Hari/Tanggal</th>
                            <th>Waktu Lelang</th>
                            <th>Nama Ikan</th>
                            <th>Gambar</th>
                            <th>Nama Nelayan</th>
                            <th>Nama Pembeli</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $hari_ini = date("d")-1;
					$kemarin = date("Y-m-$hari_ini");
                    $no = 1;
                    // fungsi query untuk menampilkan data dari tabel Jadwal Lelang, ikan dan nelayan
                    $query = mysqli_query($mysqli, "SELECT 
                                                    a.id_transaksi,a.tanggal_transaksi,a.id_masuk,a.id_pembeli,a.jumlah,a.harga,
                                                    b.id_masuk,b.jumlah as jumlah_ikan,b.id_ikan,b.id_nelayan,
                                                    c.id_ikan,c.nama_ikan,
                                                    d.id_nelayan,d.nama_nelayan,
                                                    e.id_pembeli,e.nama_pembeli
                                                    FROM transaksi_lelang as a INNER JOIN ikan_masuk as b INNER JOIN ikan as c INNER JOIN nelayan as d INNER JOIN pembeli as e
                                                    ON a.id_masuk=b.id_masuk AND b.id_ikan=c.id_ikan AND b.id_nelayan=d.id_nelayan AND a.id_pembeli=e.id_pembeli
                                                    WHERE a.tanggal_transaksi='$kemarin'
                                                    ORDER BY a.id_transaksi DESC")
                                                    or die('Ada kesalahan pada query tampil data Transaksi Lelang: '.mysqli_error($mysqli));

                    while ($data = mysqli_fetch_assoc($query)) { 
                        $tanggal           = $data['tanggal_transaksi'];
                        $tgl               = explode('-',$tanggal);
                        $tanggal_transaksi = $tgl[2]."-".$tgl[1]."-".$tgl[0];

                        $hari = nama_hari($tanggal);

                        $query2 = mysqli_query($mysqli, "SELECT id_jadwal,waktu_lelang,id_masuk,gambar FROM jadwal
                                                        WHERE id_masuk='$data[id_masuk]'")
                                                        or die('Ada kesalahan pada query tampil data jadwal: '.mysqli_error($mysqli));

                        $data2 = mysqli_fetch_assoc($query2); 
                    ?>
                        <tr>
                            <td width="50"><?php echo $no; ?></td>
                            <td width="120"><?php echo $hari; ?>, <?php echo $tanggal_transaksi; ?></td>
                            <td width="200"><?php echo $data2['waktu_lelang']; ?></td>
                            <td width="150"><?php echo $data['nama_ikan']; ?></td>
                            <td width="50"><img src="images/ikan/<?php echo $data2['gambar']; ?>" width="80"></td>
                            <td width="150"><?php echo $data['nama_nelayan']; ?></td>
                            <td width="150"><?php echo $data['nama_pembeli']; ?></td>
                            <td width="100"><?php echo $data['jumlah_transaksi']; ?> Kg</td>
                        </tr>
                    <?php
                        $no++;
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->