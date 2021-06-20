<?php 
// fungsi pengecekan hak_akses untuk menampilkan menu sesuai dengan hak_akses
// jika hak_akses = Tata Usaha, tampilkan menu
if ($_SESSION['hak_akses']=='Admin') { ?>
    <ul class="nav nav-list">
    <?php
    // fungsi untuk pengecekan menu aktif
    // jika menu beranda dipilih, menu beranda aktif
    if ($_GET["module"] == "beranda") {
        echo '  <li class="active">
                    <a href="?module=beranda">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="menu-text"> Beranda </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    } 
    // jika tidak, menu beranda tidak aktif
    else {
        echo '  <li>
                    <a href="?module=beranda">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="menu-text"> Beranda </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    }

    // jika menu ikan dipilih, menu ikan aktif
    if ($_GET["module"] == "ikan" || $_GET["module"] == "form_ikan") {
        echo '  <li class="active open">
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <i class="menu-icon fa fa-folder-o"></i>
                        <span class="menu-text"> Data Master </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="active">
                            <a href="?module=ikan">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Ikan
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="?module=nelayan">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Nelayan
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="?module=pembeli">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Pembeli
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>';
    } 
    // jika menu nelayan dipilih, menu nelayan aktif
    elseif ($_GET["module"] == "nelayan" || $_GET["module"] == "form_nelayan") {
        echo '  <li class="active open">
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <i class="menu-icon fa fa-folder-o"></i>
                        <span class="menu-text"> Data Master </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li>
                            <a href="?module=ikan">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Ikan
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="active">
                            <a href="?module=nelayan">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Nelayan
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="?module=pembeli">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Pembeli
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>';
    } 
    // jika menu pembeli dipilih, menu pembeli aktif
    elseif ($_GET["module"] == "pembeli"  || $_GET["module"] == "form_pembeli") {
        echo '  <li class="active open">
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <i class="menu-icon fa fa-folder-o"></i>
                        <span class="menu-text"> Data Master </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li>
                            <a href="?module=ikan">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Ikan
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="?module=nelayan">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Nelayan
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="active">
                            <a href="?module=pembeli">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Pembeli
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>';
    }
    // jika tidak, menu data master tidak aktif
    else {
        echo '  <li>
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <i class="menu-icon fa fa-folder-o"></i>
                        <span class="menu-text"> Data Master </span>
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li>
                            <a href="?module=ikan">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Ikan
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="?module=nelayan">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Nelayan
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li>
                            <a href="?module=pembeli">
                                <i class="menu-icon fa fa-angle-double-right"></i>
                                Pembeli
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>';
    }

    // jika menu Ikan Masuk dipilih, menu Ikan Masuk aktif
    if ($_GET["module"] == "ikan_masuk" || $_GET["module"] == "form_ikan_masuk") {
        echo '  <li class="active">
                    <a href="?module=ikan_masuk">
                        <i class="menu-icon fa fa-edit"></i>
                        <span class="menu-text"> Ikan Masuk </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    } 
    // jika tidak, menu Ikan Masuk tidak aktif
    else {
        echo '  <li>
                    <a href="?module=ikan_masuk">
                        <i class="menu-icon fa fa-edit"></i>
                        <span class="menu-text"> Ikan Masuk </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    }

    // jika menu jadwal dipilih, menu jadwal aktif
    if ($_GET["module"] == "jadwal" || $_GET["module"] == "form_jadwal") {
        echo '  <li class="active">
                    <a href="?module=jadwal">
                        <i class="menu-icon fa fa-calendar"></i>
                        <span class="menu-text"> Jadwal Lelang </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    } 
    // jika tidak, menu jadwal tidak aktif
    else {
        echo '  <li>
                    <a href="?module=jadwal">
                        <i class="menu-icon fa fa-calendar"></i>
                        <span class="menu-text"> Jadwal Lelang </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    }

    // jika menu Transaksi Lelang dipilih, menu Transaksi Lelang aktif
    if ($_GET["module"] == "transaksi" || $_GET["module"] == "form_transaksi") {
        echo '  <li class="active">
                    <a href="?module=transaksi">
                        <i class="menu-icon fa fa-clone"></i>
                        <span class="menu-text"> Transaksi Lelang </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    } 
    // jika tidak, menu transaksi lelang tidak aktif
    else {
        echo '  <li>
                    <a href="?module=transaksi">
                        <i class="menu-icon fa fa-clone"></i>
                        <span class="menu-text"> Transaksi Lelang </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    }

    // jika menu laporan dipilih, menu laporan aktif
    if ($_GET["module"] == "lap_transaksi") {
        echo '  <li class="active">
                    <a href="?module=lap_transaksi">
                        <i class="menu-icon fa fa-file-text-o"></i>
                        <span class="menu-text"> Laporan </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    } 
    // jika tidak, menu laporan tidak aktif
    else {
        echo '  <li>
                    <a href="?module=lap_transaksi">
                        <i class="menu-icon fa fa-file-text-o"></i>
                        <span class="menu-text"> Laporan </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    }

    // jika menu diskusi dipilih, menu diskusi aktif
    if ($_GET["module"] == "diskusi" || $_GET["module"] == "form_diskusi") {
        require_once "../config/database.php";
        // fungsi query untuk menampilkan data dari tabel diskusi
        $query = mysqli_query($mysqli, "SELECT COUNT(id_diskusi) as jumlah FROM diskusi WHERE status='n'")
                                        or die('Ada kesalahan pada query tampil data diskusi: '.mysqli_error($mysqli));

        $data = mysqli_fetch_assoc($query);

        echo "  <li class='active'>
                    <a href='?module=diskusi'>
                        <i class='menu-icon fa fa-comments'></i>
                        <span class='menu-text'> Diskusi <span class='badge badge-primary'>$data[jumlah]</span> </span>
                    </a>
                    <b class='arrow'></b>
                </li>";
    } 
    // jika tidak, menu diskusi tidak aktif
    else {
        require_once "../config/database.php";
        // fungsi query untuk menampilkan data dari tabel diskusi
        $query = mysqli_query($mysqli, "SELECT COUNT(id_diskusi) as jumlah FROM diskusi WHERE status='n'")
                                        or die('Ada kesalahan pada query tampil data diskusi: '.mysqli_error($mysqli));

        $data = mysqli_fetch_assoc($query);

        echo "  <li>
                    <a href='?module=diskusi'>
                        <i class='menu-icon fa fa-comments'></i>
                        <span class='menu-text'> Diskusi <span class='badge badge-primary'>$data[jumlah]</span> </span>
                    </a>
                    <b class='arrow'></b>
                </li>";
    }
    ?>
    </ul>
<?php
} 
// jika hak_akses = Guru, tampilkan menu
elseif ($_SESSION['hak_akses']=='Dinas'){ ?>
    <ul class="nav nav-list">
    <?php
    // fungsi untuk pengecekan menu aktif
    // jika menu beranda dipilih, menu beranda aktif
    if ($_GET["module"] == "beranda") {
        echo '  <li class="active">
                    <a href="?module=beranda">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="menu-text"> Beranda </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    } 
    // jika tidak, menu beranda tidak aktif
    else {
        echo '  <li>
                    <a href="?module=beranda">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="menu-text"> Beranda </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    }

    // jika menu laporan dipilih, menu laporan aktif
    if ($_GET["module"] == "lap_ikan_masuk") {
        echo '  <li class="active">
                    <a href="?module=lap_ikan_masuk">
                        <i class="menu-icon fa fa-file-text-o"></i>
                        <span class="menu-text"> Laporan </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    } 
    // jika tidak, menu laporan tidak aktif
    else {
        echo '  <li>
                    <a href="?module=lap_ikan_masuk">
                        <i class="menu-icon fa fa-file-text-o"></i>
                        <span class="menu-text"> Laporan </span>
                    </a>
                    <b class="arrow"></b>
                </li>';
    }
    ?>
    </ul>
<?php
}
?>