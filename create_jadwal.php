<!DOCTYPE html>
<html>

<head>
    <title>Form Pendaftaran Jadwal</title>
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
        /**
         * Nama File: create_jadwal.php
         * Deskripsi: Ini adalah halaman untuk menambahkan data jadwal.
         * Author: Bayu Saputra & Amrizal Mustakim
         * Dibuat pada: 19/12/23
         */
        //Include file koneksi, untuk koneksikan ke database
        include "db.php";

        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $kode_kereta = input($_POST["kode_kereta"]);
            $kode_rute = input($_POST["kode_rute"]);
            $waktu_keberangkatan = input($_POST["waktu_keberangkatan"]);
            $waktu_tiba = input($_POST["waktu_tiba"]);
            $harga_tiket = input($_POST["harga_tiket"]);

            // Query untuk mendapatkan Kode_Jadwal terbaru
            $queryGetMaxKode = "SELECT MAX(Kode_Jadwal) AS max_kode FROM Jadwal";
            $resultGetMaxKode = mysqli_query($kon, $queryGetMaxKode);
            $dataMaxKode = mysqli_fetch_assoc($resultGetMaxKode);
            $nextKode = $dataMaxKode['max_kode'] + 1;

            // Query input menginput data kedalam tabel jadwal
            $sql = "INSERT INTO Jadwal (Kode_Jadwal, Kode_Kereta, Kode_Rute, Waktu_Keberangkatan, Waktu_Tiba, Harga_Tiket) VALUES ('$nextKode', '$kode_kereta', '$kode_rute', '$waktu_keberangkatan', '$waktu_tiba', '$harga_tiket')";

            // Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location: jadwal.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>
        <br>
        <br>
        <h2>Input Data Jadwal</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <!-- Input untuk Kode Kereta -->
            <div class="form-group">
                <label>Kode Kereta:</label>
                <input type="text" name="kode_kereta" class="form-control" placeholder="Masukkan Kode Kereta" readonly />
                <!-- Tombol untuk Menampilkan Semua Data Stasiun untuk Stasiun asal-->
                <button type="button" class="btn btn-info" id="btn-all-data-kereta">Semua Data Kereta</button>
            </div>

            <!-- Input untuk Kode Rute -->
            <div class="form-group">
                <label>Kode Rute:</label>
                <input type="text" name="kode_rute" class="form-control" placeholder="Masukkan Kode Rute" readonly />
                <!-- Tombol untuk Menampilkan Semua Data Stasiun untuk Stasiun asal-->
                <button type="button" class="btn btn-info" id="btn-all-data-rute">Semua Data Rute</button>
            </div>

            <!-- Input untuk Waktu Keberangkatan -->
            <div class="form-group">
                <label>Waktu Keberangkatan:</label>
                <input type="datetime-local" name="waktu_keberangkatan" class="form-control" required />
            </div>

            <!-- Input untuk Waktu Tiba -->
            <div class="form-group">
                <label>Waktu Tiba:</label>
                <input type="datetime-local" name="waktu_tiba" class="form-control" required />
            </div>

            <!-- Input untuk Harga Tiket -->
            <div class="form-group">
                <label>Harga Tiket:</label>
                <input type="text" name="harga_tiket" class="form-control" placeholder="Masukkan Harga Tiket" required />
            </div>

            <!-- Tombol Submit dan Kembali -->
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="button" name="kembali" class="btn btn-secondary" onclick="location.href='jadwal.php'">Kembali</button>
            </div>
        </form>
        <script>
            $(document).ready(function() {
                //popup ketika tombol "Semua Data" diklik untuk Kereta
                $("#btn-all-data-kereta").click(function() {
                    var width = 800;
                    var height = 600;

                    var left = (window.innerWidth - width) / 2;
                    var top = (window.innerHeight - height) / 2;

                    // Membuka popup
                    var popupWindow = window.open("alldata_popup_kereta.php", "_blank", "width=" + width + ", height=" + height + ", left=" + left + ", top=" + top);

                    // Menambahkan event listener untuk mendapatkan data dari popup
                    $(popupWindow).on("load", function() {
                        $("tr", popupWindow.document).on("click", function() {
                            // Mengisi input dengan nilai yang dipilih dari popup
                            var kodeKereta = $("td:first", this).text();
                            $("input[name='kode_kereta']").val(kodeKereta);
                            // Menutup popup
                            popupWindow.close();
                        });
                    });
                });

                //popup ketika tombol "Semua Data" diklik untuk Rute
                $("#btn-all-data-rute").click(function() {
                    var width = 800;
                    var height = 600;

                    var left = (window.innerWidth - width) / 2;
                    var top = (window.innerHeight - height) / 2;

                    // Membuka popup
                    var popupWindow = window.open("alldata_popup_rute.php", "_blank", "width=" + width + ", height=" + height + ", left=" + left + ", top=" + top);

                    // Menambahkan event listener untuk mendapatkan data dari popup
                    $(popupWindow).on("load", function() {
                        $("tr", popupWindow.document).on("click", function() {
                            // Mengisi input dengan nilai yang dipilih dari popup
                            var kodeRute = $("td:first", this).text();
                            $("input[name='kode_rute']").val(kodeRute);
                            // Menutup popup
                            popupWindow.close();
                        });
                    });
                });
            });
        </script>
    </div>

    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>