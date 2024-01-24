<?php
/**
 * Nama File: jadwal.php
 * Deskripsi: Ini adalah data untuk menampilan jadwal.
 * Author: Bayu Saputra & Amrizal Mustakim
 * Dibuat pada: 19/12/23
 */

include "db.php"; // Pastikan file ini benar dan sudah menyertakan koneksi ke database
include "dashboard.php";

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM Jadwal WHERE Kode_Jadwal = $delete_id";
    mysqli_query($kon, $delete_query);

    // Redirect back to jadwal.php after deletion
    header("Location: jadwal.php");
    exit();
}

// Pagination
$limit = 5; // Jumlah record per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT Jadwal.*, Kereta.Nama_Kereta
        FROM Jadwal
        JOIN Kereta ON Jadwal.Kode_Kereta = Kereta.Kode_Kereta
        ORDER BY Jadwal.Kode_Jadwal DESC
        LIMIT $start, $limit";
$result = mysqli_query($kon, $sql);

$no = $start;
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style_index.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <br>
        <div class="container">
            <br>
            <h4>
                <center>INFORMASI JADWAL KERETA</center>
            </h4>
            <table class="my-3 table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Kode Jadwal</th>
                        <th>Nama Kereta</th> <!-- Kolom Nama Kereta ditambahkan -->
                        <th>Kode Rute</th>
                        <th>Waktu Keberangkatan</th>
                        <th>Waktu Tiba</th>
                        <th>Harga Tiket</th>
                        <th colspan='2'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_array($result)) {
                        $no++;
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['Kode_Jadwal']; ?></td>
                            <td><?php echo $data['Nama_Kereta']; ?></td> <!-- Menampilkan Nama Kereta -->
                            <td><?php echo $data['Kode_Rute']; ?></td>
                            <td><?php echo $data['Waktu_Keberangkatan']; ?></td>
                            <td><?php echo $data['Waktu_Tiba']; ?></td>
                            <td><?php echo $data['Harga_Tiket']; ?></td>
                            <td>
                                <a href="update_jadwal.php?kode_jadwal=<?php echo $data['Kode_Jadwal']; ?>" class="btn btn-warning" role="button">Update</a>
                                <!-- Tambahkan konfirmasi sebelum menghapus -->
                                <a href="?delete_id=<?php echo $data['Kode_Jadwal']; ?>" class="btn btn-danger" role="button">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <!-- Link halaman paginasi -->
            <ul class="pagination justify-content-center">
                <?php
                $total_records = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM Jadwal"));
                $total_pages = ceil($total_records / $limit);

                echo "<li class='page-item'>";
                if ($page > 1) {
                    echo "<a class='page-link' href='?page=" . ($page - 1) . "'>Previous</a>";
                }
                echo "</li>";

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
                }

                echo "<li class='page-item'>";
                if ($page < $total_pages) {
                    echo "<a class='page-link' href='?page=" . ($page + 1) . "'>Next</a>";
                }
                echo "</li>";
                ?>
            </ul>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="create_jadwal.php" class="btn btn-primary" role="button">Tambah Data</a>
            </div>
        </div>
    </div>

    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>