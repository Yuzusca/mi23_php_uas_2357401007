<?php
/**
* NIM   : 2357401007
* Nama  : Yusuf Hidayat 
* Kelas : MI23 
*/
?>

<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
include "koneksi.php";

$msg = "";
if (isset($_POST['simpan'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if ($username && $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password_hash')");
        header("Location: user.php");
        exit;
    } else {
        $msg = "Semua field wajib diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        <?php $activePage = 'user'; include 'sidebar.php'; ?>
        <main class="flex-1 p-8">
            <div class="max-w-lg mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fas fa-user-plus text-green-600"></i>
                        Tambah User
                    </h1>
                    <p class="text-gray-500 mt-2">Tambahkan user admin baru ke sistem</p>
                </div>

                <!-- Back Button -->
                <a href="user.php" class="inline-flex items-center gap-2 mb-6 text-gray-600 hover:text-blue-600 transition-colors duration-300">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-lg p-8 border-2 border-green-100">
                    <?php if ($msg) { ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 flex items-center gap-3">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                            <span><?php echo $msg; ?></span>
                        </div>
                    <?php } ?>
                    <form method="post">
                        <div class="mb-6">
                            <label class="block mb-3 font-semibold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-user text-green-600 w-5"></i>
                                Username
                            </label>
                            <input type="text" name="username" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-8">
                            <label class="block mb-3 font-semibold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-lock text-red-600 w-5"></i>
                                Password
                            </label>
                            <input type="password" name="password" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300" placeholder="Masukkan password" required>
                            <p class="text-gray-500 text-sm mt-2">Password harus kuat dan unik</p>
                        </div>
                        <button type="submit" name="simpan" class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 rounded-lg hover:from-green-700 hover:to-green-800 font-semibold transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-save"></i>
                            Buat User
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
