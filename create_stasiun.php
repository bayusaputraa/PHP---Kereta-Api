<!-- create_stasiun.php -->

<!DOCTYPE html>
<html>
<!--
/**
 * Nama File: create_stasiun.php
 * Deskripsi: Ini adalah halaman untuk menambahkan data stasiun.
 * Author: Bayu Saputra & Amrizal Mustakim
 * Dibuat pada: 19/12/23
 */
-->

<head>
    <title>Form Pendaftaran Stasiun</title>
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
        <br>
        <br>
        <h2>Input Data Stasiun</h2>

        <form id="formStasiun">
            <div class="form-group">
                <label>Nama Stasiun:</label>
                <input type="text" name="nama_stasiun" class="form-control" placeholder="Masukkan Nama Stasiun" required />
            </div>
            <div class="form-group">
                <label>Lokasi:</label>
                <input type="text" name="Lokasi" class="form-control" placeholder="Masukkan Lokasi" required />
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
                <button type="button" name="kembali" class="btn btn-secondary" onclick="location.href='stasiun.php'">Kembali</button>
            </div>
        </form>
    </div>

    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>

    <script>
        $(document).ready(function() {
            $("#submitBtn").click(function() {
                $.ajax({
                    type: "POST",
                    url: "submit_stasiun.php",
                    data: $("#formStasiun").serialize(),
                    dataType: "json",  // Ensure the expected data type is JSON
                    success: function(response) {
                        alert(response.message);

                        if (response.status === 'success') {
                            window.location.href = 'stasiun.php';
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });
        });
    </script>
</body>

</html>
