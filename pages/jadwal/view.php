<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Jadwal Lelang</h2>
        <ol class="breadcrumb">
            <li><a href="?page=home">Home</a>
            </li>
            <li class="active">Jadwal</li>
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
                            <th>Kisaran Harga</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $hari_ini = date("Y-m-d");
                    $no = 1;
                    // fungsi query untuk menampilkan data dari tabel Jadwal Lelang, ikan dan nelayan
                    $query = mysqli_query($mysqli, "SELECT a.id_jadwal,a.tanggal_lelang,a.waktu_lelang,a.id_masuk,a.keterangan,a.kisaran_harga,a.gambar,
                                                    b.id_masuk,b.jumlah,b.id_ikan,
                                                    c.id_ikan,c.nama_ikan
                                                    FROM jadwal as a INNER JOIN ikan_masuk as b INNER JOIN ikan as c 
                                                    ON a.id_masuk=b.id_masuk AND b.id_ikan=c.id_ikan
                                                    WHERE a.tanggal_lelang='$hari_ini'
                                                    ORDER BY a.id_jadwal DESC")
                                                    or die('Ada kesalahan pada query tampil data Jadwal Lelang: '.mysqli_error($mysqli));

                    while ($data = mysqli_fetch_assoc($query)) { 
                        $tanggal        = $data['tanggal_lelang'];
                        $tgl            = explode('-',$tanggal);
                        $tanggal_lelang = $tgl[2]."-".$tgl[1]."-".$tgl[0];

                        $a              = $data['kisaran_harga'];
                        $b              = explode('-',$a);
                        $kisaran_awal   = $b[0];
                        @$kisaran_akhir  = $b[1];

                        $hari = nama_hari($tanggal);

                        $query2 = mysqli_query($mysqli, "SELECT a.id_transaksi,sum(a.jumlah) as jml_transaksi,a.id_masuk,
                                                        b.id_masuk,b.jumlah as jml_ikan 
                                                        FROM transaksi_lelang as a INNER JOIN ikan_masuk as b
                                                        ON a.id_masuk=b.id_masuk
                                                        WHERE a.id_masuk='$data[id_masuk]'")
                                                        or die('Ada kesalahan pada query tampil data jumlah: '.mysqli_error($mysqli));

                        $data2 = mysqli_fetch_assoc($query2);
                        $stok = $data2['jml_ikan'] - $data2['jml_transaksi'];
                    ?>
                        <tr>
                            <td width="40"><?php echo $no; ?></td>
                            <td width="120"><?php echo $hari; ?>, <?php echo $tanggal_lelang; ?></td>
                            <td width="80"><?php echo $data['waktu_lelang']; ?></td>
                            <td width="130"><?php echo $data['nama_ikan']; ?></td>
                            <td width="50"><img src="images/ikan/<?php echo $data['gambar']; ?>" width="80"></td>
                            <td width="130">Rp. <?php echo format_rupiah_nol($kisaran_awal); ?> - Rp. <?php echo format_rupiah_nol($kisaran_akhir); ?></td>
                            <td width="70"><?php echo $stok; ?> Kg</td>
                            <td width="120"><?php echo $data['keterangan']; ?></td>
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