<ul class="nav navbar-nav navbar-right">
<?php   
// fungsi untuk pengecekan menu aktif
// jika menu home dipilih, menu home aktif
if ($_GET["page"]=="home") {
echo '  <li class="active">
            <a href="?page=home"> Home </a>
        </li>';
}
// jika tidak, menu home tidak aktif
else {
echo '  <li>
            <a href="?page=home"> Home </a>
        </li>';
}

// jika menu jadwal dipilih, menu jadwal aktif
if ($_GET["page"]=="jadwal") {
echo '  <li class="active">
            <a href="?page=jadwal"> Jadwal Lelang </a>
        </li>';
}
// jika tidak, menu jadwal tidak aktif
else {
echo '  <li>
            <a href="?page=jadwal"> Jadwal Lelang </a>
        </li>';
}

// jika menu ikan dipilih, menu ikan aktif
if ($_GET["page"]=="ikan") {
echo '  <li class="active">
            <a href="?page=ikan"> Jenis Ikan </a>
        </li>';
}
// jika tidak, menu ikan tidak aktif
else {
echo '  <li>
            <a href="?page=ikan"> Jenis Ikan </a>
        </li>';
}

/*// jika menu laporan dipilih, menu laporan aktif
if ($_GET["page"]=="laporan") {
echo '  <li class="active">
            <a href="?page=laporan"> Laporan Harian </a>
        </li>';
}
// jika tidak, menu laporan tidak aktif
else {
echo '  <li>
            <a href="?page=laporan"> Laporan Harian </a>
        </li>';
}*/

// jika menu daftar dipilih, menu daftar aktif
if ($_GET["page"]=="daftar") {
echo '  <li class="active">
            <a href="?page=daftar"> Daftar </a>
        </li>';
}
// jika tidak, menu daftar tidak aktif
else {
echo '  <li>
            <a href="?page=daftar"> Daftar </a>
        </li>';
}    

// jika menu diskusi dipilih, menu diskusi aktif
if ($_GET["page"]=="diskusi") {
echo '  <li class="active">
            <a href="?page=diskusi"> Diskusi </a>
        </li>';
}
// jika tidak, menu diskusi tidak aktif
else {
echo '  <li>
            <a href="?page=diskusi"> Diskusi </a>
        </li>';
}                      
?>
</ul>