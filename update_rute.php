<!DOCTYPE html>
<html>

<head>
    <title>Form Update Rute</title>
    <link rel="stylesheet" href="style_form.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <?php
        include "db.php";

        // Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $dataRute = []; // Inisialisasi array untuk menyimpan data rute
        $updateSuccess = false; // Inisialisasi variabel untuk menyimpan status update

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["kode_rute"])) {
                $kode_rute = input($_GET["kode_rute"]);

                // Query untuk mendapatkan data rute berdasarkan Kode_Rute
                $queryGetRute = "SELECT * FROM Rute WHERE Kode_Rute = '$kode_rute'";
                $resultGetRute = mysqli_query($kon, $queryGetRute);

                // Periksa apakah query berhasil dan hasilnya tidak kosong
                if ($resultGetRute && mysqli_num_rows($resultGetRute) > 0) {
                    $dataRute = mysqli_fetch_assoc($resultGetRute);
                } else {
                    // Redirect atau tindakan lain jika data tidak ditemukan
                    echo "Data rute tidak ditemukan.";
                    exit();
                }
            } else {
                echo "Kode rute tidak ditemukan.";
                exit();
            }
        }

        // Pemrosesan form jika method yang digunakan adalah POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $kode_rute = input($_POST["kode_rute"]);
            $jarak_km = input($_POST["jarak_km"]);

            // Query untuk melakukan update jarak_km berdasarkan Kode_Rute
            $queryUpdateRute = "UPDATE Rute SET Jarak_KM = '$jarak_km' WHERE Kode_Rute = '$kode_rute'";
            $resultUpdateRute = mysqli_query($kon, $queryUpdateRute);

            if ($resultUpdateRute) {
                $updateSuccess = true;
            } else {
                $updateSuccess = false;
            }
        }
        ?>
        <br>
        <br>
        <h2>Update Data Rute</h2>

        <?php if ($updateSuccess) : ?>
            <!-- Notifikasi berhasil -->
            <div class="alert alert-success" role="alert">
                Data berhasil diupdate. <a href="rute.php" class="alert-link">Kembali ke halaman rute</a>.
            </div>
        <?php else : ?>
            <!-- Form untuk mengupdate data rute -->
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <!-- Input untuk Kode Rute -->
                <div class="form-group">
                    <label>Kode Rute:</label>
                    <input type="text" name="kode_rute" class="form-control" value="<?= $dataRute['Kode_Rute'] ?? ''; ?>" readonly />
                </div>

                <!-- Input untuk Jarak -->
                <div class="form-group">
                    <label>Jarak (KM):</label>
                    <input type="text" name="jarak_km" class="form-control" value="<?= $dataRute['Jarak_KM'] ?? ''; ?>" required />
                </div>

                <!-- Tombol Update dan Kembali -->
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <button type="button" name="kembali" class="btn btn-secondary" onclick="location.href='rute.php'">Kembali</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>
