<?php
/**
* NIM   : 2357401007
* Nama  : Yusuf Hidayat 
* Kelas : MI23 
*/
?>

<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password_input = $_POST['password'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($query) == 1) {
        $user = mysqli_fetch_assoc($query);
        $password_db = $user['password'];
        // Cek password_hash (bcrypt) atau md5
        if (password_verify($password_input, $password_db) || md5($password_input) === $password_db) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Username / Password tidak sesuai";
        }
    } else {
        $error = "Username / Password tidak sesuai";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-800 flex items-center justify-center min-h-screen">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <div class="relative z-10 w-full max-w-md">
        <!-- Card -->
        <div class="bg-white bg-opacity-95 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-white border-opacity-20">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-lock-open text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Login Admin</h2>
                <p class="text-gray-600">Kelola sistem Anda dengan aman</p>
            </div>

            <!-- Alert Error -->
            <?php if ($error) { ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-center gap-3 animate-pulse">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                    <span><?php echo $error; ?></span>
                </div>
            <?php } ?>

            <!-- Form -->
            <form method="post">
                <!-- Username Field -->
                <div class="mb-6">
                    <label class="block text-gray-800 font-semibold mb-2 flex items-center gap-2">
                        <i class="fas fa-user text-blue-600 w-5"></i>
                        Username
                    </label>
                    <div class="relative">
                        <input type="text" name="username" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 bg-gray-50" placeholder="Masukkan username" required>
                        <i class="fas fa-check-circle text-green-500 absolute right-4 top-3.5 hidden text-xl"></i>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-8">
                    <label class="block text-gray-800 font-semibold mb-2 flex items-center gap-2">
                        <i class="fas fa-lock text-red-600 w-5"></i>
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 bg-gray-50" placeholder="Masukkan password" required>
                        <i class="fas fa-check-circle text-green-500 absolute right-4 top-3.5 hidden text-xl"></i>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="login" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105 mb-6">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk Sekarang
                </button>
            </form>

            <!-- Divider -->
            <div class="relative mb-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Default Account</span>
                </div>
            </div>

            <!-- Demo Info -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200">
                <p class="text-sm text-gray-700 mb-2 font-semibold flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-600"></i>
                    Gunakan default account:
                </p>
                <div class="flex justify-between items-center text-sm">
                    <div>
                        <p class="text-gray-600">Username: <span class="font-mono bg-white px-2 py-1 rounded border border-gray-300 font-bold text-blue-600">admin</span></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Password: <span class="font-mono bg-white px-2 py-1 rounded border border-gray-300 font-bold text-blue-600">admin123</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
