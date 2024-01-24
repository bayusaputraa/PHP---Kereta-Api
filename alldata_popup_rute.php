<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Data Rute</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>Semua Data Rute</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Rute</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                </tr>
            </thead>
            <tbody>
                <?php
                /**
                 * Nama File: alldata_popup_rute.php
                 * Deskripsi: Ini adalah halaman untuk popup data rute stasiun kereta.
                 * Author: Bayu Saputra & Amrizal Mustakim
                 * Dibuat pada: 19/12/23
                 */

                // Sesuaikan dengan struktur tabel stasiun dan koneksi ke database
                include "db.php";

                $query = "SELECT r.*, sa.Nama_Stasiun AS Stasiun_Asal, st.Nama_Stasiun AS Stasiun_Tujuan
                FROM Rute r
                INNER JOIN Stasiun sa ON r.Kode_Stasiun_Asal = sa.Kode_Stasiun
                INNER JOIN Stasiun st ON r.Kode_Stasiun_Tujuan = st.Kode_Stasiun
                ORDER BY r.Kode_Rute DESC";
                $result = mysqli_query($kon, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['Kode_Rute'] . "</td>";
                    echo "<td>" . $row['Stasiun_Asal'] . "</td>";
                    echo "<td>" . $row['Stasiun_Tujuan'] . "</td>";
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