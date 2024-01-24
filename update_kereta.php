<!--update_kereta.php-->

<!DOCTYPE html>
<html>

<head>
    <title>Form Update Kereta</title>
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

        // Jika Kode_Kereta tidak ada pada parameter URL, redirect ke kereta.php
        if (!isset($_GET['kode_kereta'])) {
            header("Location: kereta.php");
            exit();
        }

        $kode_kereta = $_GET['kode_kereta'];

        // Query ambil data kereta berdasarkan Kode_kereta
        $queryGetData = "SELECT * FROM Kereta WHERE Kode_kereta='$kode_kereta'";
        $resultGetData = mysqli_query($kon, $queryGetData);

        // Jika data tidak ditemukan, redirect ke kereta.php
        if (mysqli_num_rows($resultGetData) == 0) {
            header("Location: kereta.php");
            exit();
        }

        $dataKereta = mysqli_fetch_assoc($resultGetData);

        // Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama_kereta = input($_POST["nama_kereta"]);
            $jenis_kereta = input($_POST["jenis_kereta"]);
            $kapasitas_kereta = input($_POST["kapasitas_kereta"]);

            // Query update data kereta
            $sql = "UPDATE Kereta SET Nama_kereta='$nama_kereta', jenis_kereta='$jenis_kereta', kapasitas_kereta='$kapasitas_kereta' WHERE Kode_Kereta='$kode_kereta'";

            // Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location: kereta.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Data Gagal diupdate.</div>";
            }
        }
        ?>
        <br>
        <br>
        <h2>Update Data Kereta</h2>

        <!-- Form Update Kereta -->
        <form action="<?php echo $_SERVER["PHP_SELF"] . "?kode_kereta=$kode_kereta"; ?>" method="post">
            <div class="form-group">
                <label>Kode Kereta:</label>
                <input type="text" name="kode_kereta" class="form-control" value="<?php echo $dataKereta['Kode_Kereta']; ?>" readonly />
            </div>
            <div class="form-group">
                <label>Nama Kereta:</label>
                <input type="text" name="nama_kereta" class="form-control" value="<?php echo $dataKereta['Nama_Kereta']; ?>" required />
            </div>
            <div class="form-group">
                <label>Jenis Kereta:</label>
                <input type="text" name="jenis_kereta" class="form-control" value="<?php echo $dataKereta['Jenis_Kereta']; ?>" required />
            </div>
            <div class="form-group">
                <label>Kapasitas Kereta:</label>
                <input type="text" name="kapasitas_kereta" class="form-control" value="<?php echo $dataKereta['Kapasitas_Kereta']; ?>" required />
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                <button type="button" name="kembali" class="btn btn-secondary" onclick="location.href='kereta.php'">Kembali</button>
            </div>
        </form>
    </div>
    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>