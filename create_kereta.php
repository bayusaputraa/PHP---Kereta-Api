<!-- create_kereta.php -->

<!DOCTYPE html>
<html>
<!--
/**
 * Nama File: create_kereta.php
 * Deskripsi: Ini adalah halaman untuk menambahkan kereta.
 * Author: Bayu Saputra & Amrizal Mustakim
 * Dibuat pada: 19/12/23
 */
-->
<head>
    <title>Form Pendaftaran Stasiun</title>
    <link rel="stylesheet" href="style_form.css">
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
        <br>
        <h2>Input Data Kereta</h2>

        <form id="keretaForm">
            <div class="form-group">
                <label>Nama Kereta:</label>
                <input type="text" name="nama_kereta" class="form-control" placeholder="Masukkan Nama Kereta" required />
            </div>
            <div class="form-group">
                <label>Jenis Kereta:</label>
                <input type="text" name="jenis_kereta" class="form-control" placeholder="Masukkan Nama Kereta" required />
            </div>
            <div class="form-group">
                <label>Kapasitas Kereta:</label>
                <input type="text" name="kapasitas_kereta" class="form-control" placeholder="Masukkan Kapasitas Kereta" required />
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
                <button type="button" name="kembali" class="btn btn-secondary" onclick="location.href='kereta.php'">Kembali</button>
            </div>
        </form>

        <script>
            $(document).ready(function() {
                $("#submitBtn").click(function() {
                    $.ajax({
                        type: "POST",
                        url: "submit_kereta.php", // Ganti dengan file yang akan menangani data
                        data: $("#keretaForm").serialize(), // Serialize form data
                        success: function(response) {
                            // Tambahkan logika setelah berhasil mengirim data
                            console.log(response);
                            alert('Data berhasil disimpan!');
                            // Redirect atau refresh halaman jika diperlukan
                            window.location.href = 'kereta.php';
                        },
                        error: function(error) {
                            console.log(error);
                            alert('Terjadi kesalahan saat menyimpan data.');
                        }
                    });
                });
            });
        </script>
    </div>
    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>
