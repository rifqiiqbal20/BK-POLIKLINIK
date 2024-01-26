<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['nama'])) {
    // Jika pengguna sudah login, tampilkan tombol "Logout"
    header("Location: berandaDokter.php?page=profilDokter");
    exit;
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM periksa WHERE id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
        document.location='index.php?page=riwayatPasien';
    </script>";
}
?>


<h2>Riwayat Pasien</h2>
<button href="index.php?page=laporan_riwayat.php">downloat PDF</button>
<br>

<div class="container">
<table class="table table-hover">
        <!--thead atau baris judul-->
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Nomor Antrian</th>
                <th scope="col">Keluhan</th>
                <th scope="col">Catatan</th>
                <th scope="col">Biaya Periksa</th>
                <th scope="col">Nama Obat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <!--tbody berisi isi tabel sesuai dengan judul atau head-->
        <tbody>
            
            <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
            <?php
                $id_dokter = $_SESSION['id'];
                $result = mysqli_query($mysqli, "SELECT daftar_poli.*, pasien.nama AS nama, jadwal_periksa.hari, periksa.tgl_periksa, periksa.catatan, periksa.biaya_periksa, obat.nama_obat AS nama_obat
                FROM daftar_poli
                JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id 
                JOIN pasien ON daftar_poli.id_pasien = pasien.id
                LEFT JOIN periksa ON daftar_poli.id = periksa.id_daftar_poli
                LEFT JOIN detail_periksa ON periksa.id = detail_periksa.id_periksa
                LEFT JOIN obat ON detail_periksa.id_obat = obat.id
                WHERE jadwal_periksa.id_dokter = '$id_dokter' AND periksa.id_daftar_poli IS NOT NULL");
                $no = 1;
                while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $no++ ?></th>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['no_antrian'] ?></td>
                    <td><?php echo $data['keluhan'] ?></td>
                    <td><?php echo $data['catatan'] ?></td>
                    <td><?php echo $data['biaya_periksa'] ?></td>
                    <td><?php echo $data['nama_obat'] ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="berandaDokter.php?page=periksa&id=<?php echo $data['id'] ?>">Ubah</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
