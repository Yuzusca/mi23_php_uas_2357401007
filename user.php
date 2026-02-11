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

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        <?php $activePage = 'user'; include 'sidebar.php'; ?>
        <main class="flex-1 p-8">
            <div class="max-w-5xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                                <i class="fas fa-users text-purple-600"></i>
                                Kelola User
                            </h1>
                            <p class="text-gray-500 mt-2">Manajemen pengguna admin sistem</p>
                        </div>
                        <a href="tambah_user.php" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-all duration-300 flex items-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-plus"></i>
                            Tambah User
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-purple-600 to-purple-700 text-white">
                                    <th class="px-6 py-4 text-left font-semibold">ID</th>
                                    <th class="px-6 py-4 text-left font-semibold">Username</th>
                                    <th class="px-6 py-4 text-center font-semibold">Status</th>
                                    <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($users)) { ?>
                                <tr class="border-b hover:bg-purple-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <span class="bg-gray-100 px-3 py-1 rounded-full text-sm font-semibold">#<?php echo $row['id']; ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-user text-purple-600"></i>
                                            </div>
                                            <span class="font-semibold text-gray-800"><?php echo htmlspecialchars($row['username']); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold flex items-center gap-1 w-fit mx-auto">
                                            <i class="fas fa-circle text-green-500 text-xs"></i>
                                            Aktif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-all duration-300 flex items-center gap-2 shadow hover:shadow-lg transform hover:scale-105">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            <a href="hapus_user.php?id=<?php echo $row['id']; ?>" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-all duration-300 flex items-center gap-2 shadow hover:shadow-lg transform hover:scale-105" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                <i class="fas fa-trash"></i>
                                                Hapus
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
