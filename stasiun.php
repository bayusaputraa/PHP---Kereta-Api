<!-- stasiun.php -->

<?php
/**
 * Nama File: stasiun.php
 * Deskripsi: Ini adalah halaman untuk menampilkan informasi stasiun
 * Author: Bayu Saputra & Amrizal Mustakim
 * Dibuat pada: 19/12/23
 */
include "db.php"; // Pastikan file ini benar dan sudah menyertakan koneksi ke database
include "dashboard.php";

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM Stasiun WHERE Kode_Stasiun = $delete_id";
    mysqli_query($kon, $delete_query);

    // Redirect back to stasiun.php after deletion
    header("Location: stasiun.php");
    exit();
}

// Pagination
$limit = 5; // Jumlah record per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM Stasiun ORDER BY Kode_Stasiun DESC LIMIT $start, $limit";
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
                <center>INFORMASI STASIUN</center>
            </h4>
            <table class="my-3 table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Kode Stasiun</th>
                        <th>Nama Stasiun</th>
                        <th>Lokasi</th>
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
                            <td><?php echo $data['Kode_Stasiun']; ?></td>
                            <td><?php echo $data['Nama_Stasiun']; ?></td>
                            <td><?php echo $data['Lokasi']; ?></td>
                            <td>
                                <a href="update_stasiun.php?kode_stasiun=<?php echo $data['Kode_Stasiun']; ?>" class="btn btn-warning" role="button">Update</a>
                                <!-- Tambahkan konfirmasi sebelum menghapus -->
                                <a href="?delete_id=<?php echo $data['Kode_Stasiun']; ?>" class="btn btn-danger" role="button">Delete</a>
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
                $total_records = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM Stasiun"));
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
                <a href="create_stasiun.php" class="btn btn-primary" role="button">Tambah Data</a>
            </div>
        </div>
    </div>

    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>