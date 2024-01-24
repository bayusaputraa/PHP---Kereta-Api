<!--update_stasiun.php-->

<!DOCTYPE html>
<html>

<head>
    <title>Form Update Stasiun</title>
    <link rel="stylesheet" href="style_form.css">
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

        // Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Jika Kode_Stasiun tidak ada pada parameter URL, redirect ke stasiun.php
        if (!isset($_GET['kode_stasiun'])) {
            header("Location: stasiun.php");
            exit();
        }

        $kode_stasiun = $_GET['kode_stasiun'];

        // Query ambil data stasiun berdasarkan Kode_Stasiun
        $queryGetData = "SELECT * FROM Stasiun WHERE Kode_Stasiun='$kode_stasiun'";
        $resultGetData = mysqli_query($kon, $queryGetData);

        // Jika data tidak ditemukan, redirect ke stasiun.php
        if (mysqli_num_rows($resultGetData) == 0) {
            header("Location: stasiun.php");
            exit();
        }

        $dataStasiun = mysqli_fetch_assoc($resultGetData);

        // Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama_stasiun = input($_POST["nama_stasiun"]);
            $lokasi = input($_POST["Lokasi"]);

            // Query update data stasiun
            $sql = "UPDATE Stasiun SET Nama_Stasiun='$nama_stasiun', Lokasi='$lokasi' WHERE Kode_Stasiun='$kode_stasiun'";

            // Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location: stasiun.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Data Gagal diupdate.</div>";
            }
        }
        ?>
        <br>
        <br>
        <h2>Update Data Stasiun</h2>

        <!-- Form Update Stasiun -->
        <form action="<?php echo $_SERVER["PHP_SELF"] . "?kode_stasiun=$kode_stasiun"; ?>" method="post">
            <div class="form-group">
                <label>Kode Stasiun:</label>
                <input type="text" name="kode_stasiun" class="form-control" value="<?php echo $dataStasiun['Kode_Stasiun']; ?>" readonly />
            </div>
            <div class="form-group">
                <label>Nama Stasiun:</label>
                <input type="text" name="nama_stasiun" class="form-control" value="<?php echo $dataStasiun['Nama_Stasiun']; ?>" required />
            </div>
            <div class="form-group">
                <label>Lokasi:</label>
                <input type="text" name="Lokasi" class="form-control" value="<?php echo $dataStasiun['Lokasi']; ?>" required />
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                <button type="button" name="kembali" class="btn btn-secondary" onclick="location.href='stasiun.php'">Kembali</button>
            </div>
        </form>
    </div>
    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>