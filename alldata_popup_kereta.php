<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Data Stasiun Asal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>Semua Data Kereta</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Kereta</th>
                    <th>Nama Kereta</th>
                    <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                </tr>
            </thead>
            <tbody>
                <?php
                /**
                 * Nama File: alldata_popup_kereta.php
                 * Deskripsi: Ini adalah halaman untuk popup data kereta.
                 * Author: Bayu Saputra & Amrizal Mustakim
                 * Dibuat pada: 19/12/23
                */
                // Sesuaikan dengan struktur tabel stasiun dan koneksi ke database
                include "db.php";

                $query = "SELECT * FROM Kereta";
                $result = mysqli_query($kon, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['Kode_Kereta'] . "</td>";
                    echo "<td>" . $row['Nama_Kereta'] . "</td>";
                    // Tambahkan kolom-kolom lain sesuai kebutuhan
                    echo "</tr>";
                }

                mysqli_close($kon);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>