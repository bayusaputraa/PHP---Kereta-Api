<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportation Dashboard</title>
    <link rel="stylesheet" href="style_index.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Mengucapkan Selamat by time kepada user -->
    <?php
    /**
     * Nama File: dashboard.php
     * Deskripsi: Ini adalah halaman untuk menampilkan tampilan karyawan.
     * Author: Bayu Saputra & Amrizal Mustakim
     * Dibuat pada: 19/12/23
    */


    session_start();
    if (!isset($_SESSION['session_username'])) {
        header("location:login.php");
        exit();
    }
    date_default_timezone_set('Asia/Jakarta'); //zona waktu Indonesia Barat

    //getting time  now  on format 24 hours
    $currentHour = date("H");

    //menentukan pesan sambutan berdasarkan waktu
    if ($currentHour >= 5 && $currentHour < 12) {
        $greeting = "Good Morning";
    } elseif ($currentHour >= 12 && $currentHour < 18) {
        $greeting = "Good Afternoon";
    } else {
        $greeting = "Good Evening";
    }
    ?>

    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1"><?php echo $greeting . "! " . $_SESSION['session_username']; ?></span>
        <button type="button" name="logout" class="btn btn-light" onclick="location.href='keluar.php'">Logout</button>
    </nav>
    <div class="container mt-5">
        <h2>Train Transportation Dashboard</h2>
        <ul class="nav nav-tabs mt-4">
            <li class="nav-item">
                <a class="nav-link" href="stasiun.php">Stasiun</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="kereta.php">Kereta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="rute.php">Rute</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="jadwal.php">Jadwal</a>
            </li>
        </ul>

        <!-- Content will be loaded here based on the selected tab -->
        <div class="tab-content mt-3" id="myTabContent">
            <!-- Content will be loaded dynamically here -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>