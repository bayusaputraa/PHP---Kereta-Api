<!DOCTYPE html>
<html>

<head>
    <title>Form Pendaftaran Rute</title>
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
         * Nama File: create_rute.php
         * Deskripsi: Ini adalah halaman untuk menambahkan rute.
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

            $kode_stasiun_asal = input($_POST["kode_stasiun_asal"]);
            $kode_stasiun_tujuan = input($_POST["kode_stasiun_tujuan"]);
            $jarak_km = input($_POST["jarak_km"]);

            //Query untuk mendapatkan Kode_Rute terbaru
            $queryGetMaxKode = "SELECT MAX(Kode_Rute) AS max_kode FROM Rute";
            $resultGetMaxKode = mysqli_query($kon, $queryGetMaxKode);
            $dataMaxKode = mysqli_fetch_assoc($resultGetMaxKode);
            $nextKode = $dataMaxKode['max_kode'] + 1;

            //Query input menginput data kedalam tabel stasiun
            $sql = "INSERT INTO Rute (Kode_Rute, kode_stasiun_asal, kode_stasiun_tujuan, jarak_km ) VALUES ('$nextKode', '$kode_stasiun_asal', '$kode_stasiun_tujuan', '$jarak_km')"; // Perbaikan di sini

            //Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($kon, $sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location:rute.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>
        <br>
        <br>
        <h2>Input Data Rute</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <!-- Input untuk Stasiun Asal -->
            <div class="form-group">
                <label>Kode Stasiun Asal:</label>
                <input type="text" name="kode_stasiun_asal" class="form-control" placeholder="Masukkan kode Stasiun Asal" readonly />
                <label>Nama Stasiun Asal</label>
                <input type="text" name="nama_stasiun_asal" class="form-control" placeholder="Nama Stasiun Asal" readonly />
                <!-- Tombol untuk Menampilkan Semua Data Stasiun untuk Stasiun asal-->
                <button type="button" class="btn btn-info" id="btn-all-data-asal">Semua Data Stasiun Asal</button>
            </div>

            <!-- Input untuk Stasiun Tujuan -->
            <div class="form-group">
                <label>Kode Stasiun Tujuan:</label>
                <input type="text" name="kode_stasiun_tujuan" class="form-control" placeholder="Masukkan kode Stasiun Tujuan" readonly />
                <label>Nama Stasiun Tujuan</label>
                <input type="text" name="nama_stasiun_tujuan" class="form-control" placeholder="Nama Stasiun Tujuan" readonly />
                <!-- Tombol untuk Menampilkan Semua Data Stasiun untuk Stasiun tujuan-->
                <button type="button" class="btn btn-info" id="btn-all-data-tujuan">Semua Data Stasiun Tujuan</button>
            </div>

            <!-- Input untuk Jarak -->
            <div class="form-group">
                <label>Jarak (KM):</label>
                <input type="text" name="jarak_km" class="form-control" placeholder="Masukkan Jarak (KM)" required />
            </div>

            <!-- Tombol Submit dan Kembali -->
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="button" name="kembali" class="btn btn-secondary" onclick="location.href='rute.php'">Kembali</button>
            </div>
        </form>

        <script>
            $(document).ready(function() {
                //popup ketika tombol "Semua Data" diklik untuk Stasiun Asal
                $("#btn-all-data-asal").click(function() {
                    var width = 800;
                    var height = 600;

                    var left = (window.innerWidth - width) / 2;
                    var top = (window.innerHeight - height) / 2;

                    // Membuka popup
                    var popupWindow = window.open("alldata_popup_asal.php", "_blank", "width=" + width + ", height=" + height + ", left=" + left + ", top=" + top);

                    // Menambahkan event listener untuk mendapatkan data dari popup
                    $(popupWindow).on("load", function() {
                        $("tr", popupWindow.document).on("click", function() {
                            // Mengisi input dengan nilai yang dipilih dari popup
                            var kodeStasiun = $("td:first", this).text();
                            var namaStasiun = $("td:nth-child(2)", this).text();
                            $("input[name='kode_stasiun_asal']").val(kodeStasiun);
                            $("input[name='nama_stasiun_asal']").val(namaStasiun);
                            // Menutup popup
                            popupWindow.close();
                        });
                    });
                });

                //popup ketika tombol "Semua Data" diklik untuk Stasiun Tujuan
                $("#btn-all-data-tujuan").click(function() {
                    var width = 800;
                    var height = 600;

                    var left = (window.innerWidth - width) / 2;
                    var top = (window.innerHeight - height) / 2;

                    // Membuka popup
                    var popupWindow = window.open("alldata_popup_tujuan.php", "_blank", "width=" + width + ", height=" + height + ", left=" + left + ", top=" + top);

                    // Menambahkan event listener untuk mendapatkan data dari popup
                    $(popupWindow).on("load", function() {
                        $("tr", popupWindow.document).on("click", function() {
                            // Mengisi input dengan nilai yang dipilih dari popup
                            var kodeStasiun = $("td:first", this).text();
                            var namaStasiun = $("td:nth-child(2)", this).text();
                            $("input[name='kode_stasiun_tujuan']").val(kodeStasiun);
                            $("input[name='nama_stasiun_tujuan']").val(namaStasiun);
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