<!-- dashboard_admin.php -->

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style_index.css">
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
    <?php
    /**
     * Nama File: dashboard_admin.php
     * Deskripsi: Ini adalah halaman untuk menampilan tampilan admin.
     * Author: Bayu Saputra & Amrizal Mustakim
     * Dibuat pada: 19/12/23
     */
    session_start();
    if (!isset($_SESSION['session_username'])) {
        header("location:login.php");
        exit();
    }

    include "db.php";

    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $delete_query = "DELETE FROM user WHERE id = $delete_id";
        mysqli_query($kon, $delete_query);
        header("Location: dashboard_admin.php");
        exit();
    }

    $limit = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $sql = "SELECT * FROM user ORDER BY id DESC LIMIT $start, $limit";
    $result = mysqli_query($kon, $sql);

    $no = $start;
    ?>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $currentHour = date("H");
    if ($currentHour >= 5 && $currentHour < 12) {
        $greeting = "Good Morning";
    } elseif ($currentHour >= 12 && $currentHour < 18) {
        $greeting = "Good Afternoon";
    } else {
        $greeting = "Good Evening";
    }
    ?>

    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1"><?php echo $greeting . "! " . $_SESSION['session_username']; ?></span>
        <button type="button" name="logout" class="btn btn-light" onclick="location.href='keluar_admin.php'">Logout</button>
    </nav>
    <div class="container">
        <br>
        <div class="container">
            <br>
            <h4>
                <center>DAFTAR USER</center>
            </h4>
            <table class="my-3 table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <!-- Sesuaikan kolom-kolom lainnya sesuai dengan struktur tabel Anda -->
                        <th colspan='2'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_array($result)) {
                        $no++;
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data["Nama_User"]; ?></td>
                            <td><?php echo $data["Role"];   ?></td>
                            <!-- Sesuaikan kolom-kolom lainnya sesuai dengan struktur tabel Anda -->
                            <td>
                                <a href="update_user.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>
                                <a href="?delete_id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <ul class="pagination justify-content-center">
                <?php
                $total_records = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM user"));
                $total_pages = ceil($total_records / $limit);

                echo "<li class='page-item'>";
                if ($page > 1) {
                    echo "<a class='page-link' href='?page=" . ($page - 1) . "'>Previous</a>";
                }
                echo "</li>";

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
                }

                echo "<li class='page-item'>";
                if ($page < $total_pages) {
                    echo "<a class='page-link' href='?page=" . ($page + 1) . "'>Next</a>";
                }
                echo "</li>";
                ?>
            </ul>
        </div>
    </div>
    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>