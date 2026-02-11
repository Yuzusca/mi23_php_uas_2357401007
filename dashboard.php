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

$username = $_SESSION['username'];

// Query jumlah
$jml_produk = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM produk"))[0];
$jml_kategori = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM kategori"))[0];
$jml_user = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users"))[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex">
    <?php include 'sidebar.php'; ?>
    <main class="flex-1 p-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Selamat datang, <span class="text-blue-600"><?php echo htmlspecialchars($username); ?></span>!</h1>
                <p class="text-gray-500 flex items-center gap-2">
                    <i class="fas fa-calendar-today"></i>
                    <?php
                    if (class_exists('IntlDateFormatter')) {
                        $fmt = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                        echo $fmt->format(time());
                    } else {
                        // Fallback jika ekstensi intl tidak tersedia
                        setlocale(LC_TIME, 'id_ID.UTF-8');
                        echo date('l, d F Y');
                    }
                    ?>
                </p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Produk Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-8 text-white transform hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-semibold mb-2">Total Produk</p>
                            <p class="text-5xl font-bold"><?php echo $jml_produk; ?></p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-3xl">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white border-opacity-20 flex items-center gap-2 text-sm">
                        <i class="fas fa-arrow-up text-green-300"></i>
                        <span>Aktif di sistem</span>
                    </div>
                </div>

                <!-- Kategori Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-8 text-white transform hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-semibold mb-2">Total Kategori</p>
                            <p class="text-5xl font-bold"><?php echo $jml_kategori; ?></p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-3xl">
                            <i class="fas fa-tags"></i>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white border-opacity-20 flex items-center gap-2 text-sm">
                        <i class="fas fa-arrow-up text-green-300"></i>
                        <span>Terorganisir</span>
                    </div>
                </div>

                <!-- User Card -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-8 text-white transform hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-semibold mb-2">Total User</p>
                            <p class="text-5xl font-bold"><?php echo $jml_user; ?></p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-3xl">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white border-opacity-20 flex items-center gap-2 text-sm">
                        <i class="fas fa-arrow-up text-green-300"></i>
                        <span>Admin terdaftar</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Akses Cepat</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="kategori.php" class="bg-white border-2 border-green-500 rounded-xl p-6 hover:shadow-lg transition-all duration-300 group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-500 group-hover:text-white transition-colors duration-300">
                                <i class="fas fa-tags text-2xl text-green-600 group-hover:text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 group-hover:text-green-600 transition-colors duration-300">Manajemen Kategori</h3>
                                <p class="text-sm text-gray-500">Kelola kategori produk</p>
                            </div>
                        </div>
                    </a>
                    <a href="produk.php" class="bg-white border-2 border-blue-500 rounded-xl p-6 hover:shadow-lg transition-all duration-300 group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                                <i class="fas fa-box text-2xl text-blue-600 group-hover:text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">Manajemen Produk</h3>
                                <p class="text-sm text-gray-500">Kelola data produk</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
