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

$produk = mysqli_query($conn, "SELECT produk.*, kategori.nama_kategori FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id ORDER BY produk.id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        <?php $activePage = 'produk'; include 'sidebar.php'; ?>
        <main class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                                <i class="fas fa-box text-blue-600"></i>
                                Manajemen Produk
                            </h1>
                            <p class="text-gray-500 mt-2">Kelola semua data produk Anda</p>
                        </div>
                        <a href="tambah_produk.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-plus"></i>
                            Tambah Produk
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                                    <!-- Kolom ID dihilangkan -->
                                    <th class="px-6 py-4 text-left font-semibold">Kode Produk</th>
                                    <th class="px-6 py-4 text-left font-semibold">Nama Produk</th>
                                    <th class="px-6 py-4 text-left font-semibold">Deskripsi</th>
                                        <th class="px-6 py-4 text-center font-semibold">Gambar</th>
                                    <th class="px-6 py-4 text-left font-semibold">Kategori</th>
                                        <th class="px-6 py-4 text-left font-semibold">Harga</th>
                                    <th class="px-6 py-4 text-right font-semibold">Stok</th>
                                    <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($produk)) { ?>
                                <tr class="border-b hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-gray-700">
                                        <code class="bg-gray-100 px-2 py-1 rounded text-sm"><?php echo htmlspecialchars($row['kode_produk'] ?? ''); ?></code>
                                    </td>
                                    <td class="px-6 py-4 text-left font-semibold" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 220px;">
                                        <?php echo htmlspecialchars($row['nama_produk']); ?>
                                    </td>
                                    <td class="px-6 py-4 text-left text-gray-600" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 220px;">
                                        <?php echo htmlspecialchars($row['deskripsi'] ?? '-'); ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <?php if (!empty($row['gambar'])) { ?>
                                            <img src="<?php echo $row['gambar']; ?>" alt="Gambar Produk" class="w-16 h-16 object-cover rounded shadow mx-auto">
                                        <?php } else { ?>
                                            <span class="text-gray-400 text-xs">Tidak ada gambar</span>
                                        <?php } ?>
                                    </td>
                                    <td class="px-6 py-4 text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 120px;">
                                        <?php echo htmlspecialchars($row['nama_kategori']); ?>
                                    </td>
                                    <td class="px-6 py-4 text-left font-bold text-blue-600" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px;">
                                        Rp <?php echo number_format($row['harga'],0,',','.'); ?>
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-yellow-600" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80px;">
                                        <?php echo $row['stok']; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center" style="white-space: nowrap;">
                                        <div class="flex items-center gap-2 justify-center">
                                            <a href="edit_produk.php?id=<?php echo $row['id']; ?>" class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500 transition-all duration-300 font-semibold shadow-md">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="hapus_produk.php?id=<?php echo $row['id']; ?>" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-all duration-300 font-semibold shadow-md" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </div>
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
