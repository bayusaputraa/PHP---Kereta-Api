<!-- update_user.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Form Update User</title>
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

        // Jika id tidak ada pada parameter URL, redirect ke index.php
        if (!isset($_GET['id'])) {
            header("Location: index.php");
            exit();
        }

        $id = $_GET['id'];

        // Query ambil data user berdasarkan id
        $queryGetData = "SELECT * FROM user WHERE id='$id'";
        $resultGetData = mysqli_query($kon, $queryGetData);

        // Jika data tidak ditemukan, redirect ke index.php
        if (mysqli_num_rows($resultGetData) == 0) {
            header("Location: index.php");
            exit();
        }

        $dataUser = mysqli_fetch_assoc($resultGetData);

        // Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama_user = input($_POST["nama_user"]);
            $raw_password = input($_POST["password"]);
            $password = md5($raw_password); // Enkripsi password menggunakan MD5
            $role = input($_POST["role"]);

            // Query update data user
            $sql = "UPDATE user SET Nama_User='$nama_user', Password='$password', Role='$role' WHERE id='$id'";

            // Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location: dashboard_admin.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Data Gagal diupdate.</div>";
            }
        }
        ?>
        <br>
        <br>
        <h2>Update Data User</h2>

        <!-- Form Update User -->
        <form action="<?php echo $_SERVER["PHP_SELF"] . "?id=$id"; ?>" method="post">
            <div class="form-group">
                <label>ID User:</label>
                <input type="text" name="id" class="form-control" value="<?php echo $dataUser['id']; ?>" readonly />
            </div>
            <div class="form-group">
                <label>Nama User:</label>
                <input type="text" name="nama_user" class="form-control" value="<?php echo $dataUser['Nama_User']; ?>" required />
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" value="<?php echo $dataUser['Password']; ?>" required />
            </div>
            <div class="form-group">
                <label>Role:</label>
                <select name="role" class="form-control" required>
                    <option value="admin" <?php echo ($dataUser['Role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="karyawan" <?php echo ($dataUser['Role'] == 'karyawan') ? 'selected' : ''; ?>>Karyawan</option>
                    <option value="user" <?php echo ($dataUser['Role'] == 'user') ? 'selected' : ''; ?>>User</option>
                </select>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                <button type="button" name="kembali" class="btn btn-secondary" onclick="location.href='dashboard_admin.php'">Kembali</button>
            </div>
        </form>
    </div>
    <!-- Pemanggilan file footer.php -->
    <?php include 'footer.php'; ?>
</body>

</html>
