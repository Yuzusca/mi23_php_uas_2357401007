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

$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        <?php $activePage = 'kategori'; include 'sidebar.php'; ?>
        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                                <i class="fas fa-tags text-green-600"></i>
                                Manajemen Kategori
                            </h1>
                            <p class="text-gray-500 mt-2">Kelola kategori produk Anda</p>
                        </div>
                        <a href="tambah_kategori.php" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-all duration-300 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-plus"></i>
                            Tambah Kategori
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-green-600 to-green-700 text-white">
                                    <th class="px-6 py-4 text-left font-semibold">Nama Kategori</th>
                                    <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
                                <tr class="border-b hover:bg-green-50 transition-colors duration-200">
                                    <!-- Kolom ID dihilangkan -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-folder text-green-600"></i>
                                            </div>
                                            <span class="font-semibold text-gray-800"><?php echo htmlspecialchars($row['nama_kategori']); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="hapus_kategori.php?id=<?php echo $row['id']; ?>" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-all duration-300 inline-flex items-center gap-2 shadow hover:shadow-lg transform hover:scale-105" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
