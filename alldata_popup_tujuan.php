<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Data Stasiun Tujuan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>Semua Data Stasiun Tujuan</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Stasiun</th>
                    <th>Nama Stasiun</th>
                    <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                </tr>
            </thead>
            <tbody>
                <?php
                /**
                 * Nama File: alldata_popup_tujuan.php
                 * Deskripsi: Ini adalah halaman untuk popup data tujuan stasiun.
                 * Author: Bayu Saputra & Amrizal Mustakim
                 * Dibuat pada: 19/12/23
                */
                // Sesuaikan dengan struktur tabel stasiun dan koneksi ke database
                include "db.php";

                $query = "SELECT * FROM Stasiun";
                $result = mysqli_query($kon, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['Kode_Stasiun'] . "</td>";
                    echo "<td>" . $row['Nama_Stasiun'] . "</td>";
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