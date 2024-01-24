<?php
/**
 * Nama File: rute.php
 * Deskripsi: Ini adalah halaman untuk menampilkan rute stasiun.
 * Author: Bayu Saputra & Amrizal Mustakim
 * Dibuat pada: 19/12/23
 */

include "db.php"; // Pastikan file ini benar dan sudah menyertakan koneksi ke database
include "dashboard.php";

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM Rute WHERE Kode_Rute = $delete_id";
    mysqli_query($kon, $delete_query);

    // Redirect back to rute.php after deletion
    header("Location: rute.php");
    exit();
}

// Pagination
$limit = 5; // Jumlah record per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT r.*, sa.Nama_Stasiun AS Stasiun_Asal, st.Nama_Stasiun AS Stasiun_Tujuan
        FROM Rute r
        INNER JOIN Stasiun sa ON r.Kode_Stasiun_Asal = sa.Kode_Stasiun
        INNER JOIN Stasiun st ON r.Kode_Stasiun_Tujuan = st.Kode_Stasiun
        ORDER BY r.Kode_Rute DESC LIMIT $start, $limit";

$result = mysqli_query($kon, $sql);

$no = $start;
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style_index.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        footer {
            background-color: #f8f8f8;
            padding: 20px 0;
            margin-top: auto;
        }
    </style>
</head>

<body>

    <div class="container">
        <br>
        <div class="container">
            <br>
            <h4>
                <center>INFORMASI RUTE</center>
            </h4>
            <table class="my-3 table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Kode Rute</th>
                        <th>Stasiun Asal</th>
                        <th>Stasiun Tujuan</th>
                        <th>Jarak (KM)</th>
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
                            <td><?php echo $data['Kode_Rute']; ?></td>
                            <td><?php echo $data['Stasiun_Asal']; ?></td>
                            <td><?php echo $data['Stasiun_Tujuan']; ?></td>
                            <td><?php echo $data['Jarak_KM']; ?></td>
                            <td>
                                <a href="update_rute.php?kode_rute=<?php echo $data['Kode_Rute']; ?>" class="btn btn-warning" role="button">Update</a>
                                <!-- Tambahkan konfirmasi sebelum menghapus -->
                                <a href="?delete_id=<?php echo $data['Kode_Rute']; ?>" class="btn btn-danger" role="button">Delete</a>
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
                $total_records = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM Rute"));
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
                <a href="create_rute.php" class="btn btn-primary" role="button">Tambah Data</a>
            </div>
        </div>
    </div>

    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>