<!DOCTYPE html>
<html>

<head>
    <title>Form Update Jadwal</title>
    <link rel="stylesheet" href="style_form.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        <?php
        include "db.php";

        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Ambil data dari database berdasarkan Kode_Jadwal yang akan diupdate
        if (isset($_GET['kode_jadwal'])) {
            $kode_jadwal = input($_GET['kode_jadwal']);
            $queryGetJadwal = "SELECT * FROM Jadwal WHERE Kode_Jadwal = $kode_jadwal";
            $resultGetJadwal = mysqli_query($kon, $queryGetJadwal);
            $dataJadwal = mysqli_fetch_assoc($resultGetJadwal);

            if (!$dataJadwal) {
                echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
                exit();
            }
        } else {
            echo "<div class='alert alert-danger'>Kode Jadwal tidak valid.</div>";
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $kode_kereta = input($_POST["kode_kereta"]);
            $kode_rute = input($_POST["kode_rute"]);
            $waktu_keberangkatan = input($_POST["waktu_keberangkatan"]);
            $waktu_tiba = input($_POST["waktu_tiba"]);
            $harga_tiket = input($_POST["harga_tiket"]);

            // Query update data jadwal
            $queryUpdateJadwal = "UPDATE Jadwal SET Kode_Kereta='$kode_kereta', Kode_Rute='$kode_rute', Waktu_Keberangkatan='$waktu_keberangkatan', Waktu_Tiba='$waktu_tiba', Harga_Tiket='$harga_tiket' WHERE Kode_Jadwal='$kode_jadwal'";
            $resultUpdateJadwal = mysqli_query($kon, $queryUpdateJadwal);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($resultUpdateJadwal) {
                header("Location: jadwal.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>
        <br>
        <br>
        <h2>Update Data Jadwal</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"] . '?kode_jadwal=' . $kode_jadwal; ?>" method="post">
            <!-- Input untuk Kode Kereta -->
            <div class="form-group">
                <label>Kode Kereta:</label>
                <input type="text" name="kode_kereta" class="form-control" placeholder="Masukkan Kode Kereta" value="<?php echo $dataJadwal['Kode_Kereta']; ?>" required readonly />
            </div>

            <!-- Input untuk Kode Rute -->
            <div class="form-group">
                <label>Kode Rute:</label>
                <input type="text" name="kode_rute" class="form-control" placeholder="Masukkan Kode Rute" value="<?php echo $dataJadwal['Kode_Rute']; ?>" required readonly />
            </div>

            <!-- Input untuk Waktu Keberangkatan -->
            <div class="form-group">
                <label>Waktu Keberangkatan:</label>
                <input type="datetime-local" name="waktu_keberangkatan" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($dataJadwal['Waktu_Keberangkatan'])); ?>" required />
            </div>

            <!-- Input untuk Waktu Tiba -->
            <div class="form-group">
                <label>Waktu Tiba:</label>
                <input type="datetime-local" name="waktu_tiba" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($dataJadwal['Waktu_Tiba'])); ?>" required />
            </div>

            <!-- Input untuk Harga Tiket -->
            <div class="form-group">
                <label>Harga Tiket:</label>
                <input type="text" name="harga_tiket" class="form-control" placeholder="Masukkan Harga Tiket" value="<?php echo $dataJadwal['Harga_Tiket']; ?>" required />
            </div>

            <!-- Tombol Submit dan Kembali -->
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                <button type="button" name="kembali" class="btn btn-secondary" onclick="location.href='jadwal.php'">Kembali</button>
            </div>
        </form>
    </div>
    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>