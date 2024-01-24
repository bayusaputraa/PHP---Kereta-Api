<!-- keluar.php -->

<?php
/**
 * Nama File: keluar.php
 * Deskripsi: Ini adalah halaman untuk menanyakan apakah admin/user yakin keluar dan mengakhiri season.
 * Author: Bayu Saputra & Amrizal Mustakim
 * Dibuat pada: 19/12/23
 */

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['session_username'])) {
    // Jika belum login, arahkan ke halaman login
    header("location: login.php");
    exit();
}

// Jika sudah login, ambil informasi pengguna
$username = $_SESSION['session_username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Logout Season</title>
    <link rel="stylesheet" href="style_keluar.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Akhiri Season</div>
                    <div class="card-body">
                        <p>Hai, <?php echo $username; ?>!</p>
                        <p>Apakah Anda yakin ingin keluar?</p>
                        <a href="stasiun.php" class="btn btn-success">Kembali</a>
                        <a href="logout.php" class="btn btn-danger">Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>