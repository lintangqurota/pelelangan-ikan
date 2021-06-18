<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Jenis Ikan</h2>
        <ol class="breadcrumb">
            <li><a href="?page=home">Home</a>
            </li>
            <li class="active">Ikan</li>
        </ol>
    </div>
</div>
<!-- /.row -->

<!-- Jenis Ikan -->
<div class="row">
    <div class="col-md-12">
    <?php  
    /* Pagination */
    $batas = 6;

    $jumlah_record = mysqli_query($mysqli, "SELECT * FROM ikan")
                                            or die('Ada kesalahan pada query jumlah_record: '.mysqli_error($mysqli));

    $jumlah  = mysqli_num_rows($jumlah_record);
    $halaman = ceil($jumlah / $batas);
    $page    = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
    $mulai   = ($page - 1) * $batas;
    /*-------------------------------------------------------------------*/

    // fungsi query untuk menampilkan data dari tabel ikan
    $query = mysqli_query($mysqli, "SELECT * FROM ikan ORDER BY id_ikan DESC LIMIT $mulai, $batas")
                                    or die('Ada kesalahan pada query tampil data ikan: '.mysqli_error($mysqli));

    while ($data = mysqli_fetch_assoc($query)) { 
        if ($data['gambar']=="") {
            $gambar = "no_image.gif";
        } else {
            $gambar = $data['gambar'];
        }
    ?>
        <div style="text-align:justify" class="col-md-6">
            <div style="margin-bottom:30px" class="row">
                <div class="col-md-12">
                    <h3 style="color:#3c8dbc;"><?php echo $data['nama_ikan']; ?></h3>
                </div>

                <div class="col-md-6">
                    <img style="border:1px solid #eaeaea;border-radius:2px;height:150px;" class="img-responsive img-hover" src="images/ikan/<?php echo $data['gambar']; ?>">
                </div>
                <div class="col-md-6">
                    <p><?php echo $data['keterangan']; ?></p>
                </div>
            </div>
        </div>
    <?php
    } 

    if (empty($_GET['hal'])) {
      $halaman_aktif = '1';
    } else {
      $halaman_aktif = $_GET['hal'];
    }
    ?>
    </div>
</div>
<!-- row --> 
<br>
<!-- Pagination -->
<div class="row center">
    <div class="col-lg-12">
        <ul class="pagination">
        <!-- Button untuk halaman sebelumnya -->
        <?php 
        if ($halaman_aktif<='1') { ?>
            <li class="disabled"> 
                <a href="">&laquo;</a>
            </li>
        <?php
        } else { ?>
            <li> 
                <a href="?page=ikan&hal=<?php echo $page -1 ?>">&laquo;</a>
            </li>
        <?php
        }
        ?>

        <!-- Link halaman 1 2 3 ... -->
        <?php 
        for($x=1; $x<=$halaman; $x++) { ?>
            <li class="">
                <a href="?page=ikan&hal=<?php echo $x ?>"><?php echo $x ?></a>
            </li>
        <?php
        }
        ?>
        
        <!-- Button untuk halaman selanjutnya -->
        <?php 
        if ($halaman_aktif>=$halaman) { ?>
            <li class="disabled">
                <a href="">&raquo;</a>
            </li>
        <?php
        } else { ?>
            <li>
                <a href="?page=ikan&hal=<?php echo $page +1 ?>">&raquo;</a>
            </li>
        <?php
        }
        ?>
        </ul>
    </div>
</div>