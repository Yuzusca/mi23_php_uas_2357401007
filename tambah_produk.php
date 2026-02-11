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

$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
$msg = "";
if (isset($_POST['simpan'])) {
    $kode_produk = mysqli_real_escape_string($conn, $_POST['kode_produk']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $id_kategori = intval($_POST['id_kategori']);
    $gambar = '';
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array(strtolower($ext), $allowed)) {
            $newName = 'produk_' . time() . '_' . rand(100,999) . '.' . $ext;
            $uploadPath = 'uploads/' . $newName;
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadPath)) {
                $gambar = $uploadPath;
            }
        }
    }
    if ($kode_produk && $nama && $harga && $stok && $id_kategori) {
        mysqli_query($conn, "INSERT INTO produk (kode_produk, nama_produk, deskripsi, gambar, harga, stok, id_kategori) VALUES ('$kode_produk', '$nama', '$deskripsi', '$gambar', $harga, $stok, $id_kategori)");
        header("Location: produk.php");
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
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        <?php $activePage = 'produk'; include 'sidebar.php'; ?>
        <main class="flex-1 p-8">
            <div class="max-w-2xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fas fa-plus-circle text-blue-600"></i>
                        Tambah Produk
                    </h1>
                    <p class="text-gray-500 mt-2">Tambahkan produk baru ke dalam sistem</p>
                </div>

                <!-- Back Button -->
                <a href="produk.php" class="inline-flex items-center gap-2 mb-6 text-gray-600 hover:text-blue-600 transition-colors duration-300">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-lg p-8 border-2 border-blue-100">
                    <?php if ($msg) { ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 flex items-center gap-3">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                            <span><?php echo $msg; ?></span>
                        </div>
                    <?php } ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block mb-3 font-semibold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-barcode text-blue-600 w-5"></i>
                                    Kode Produk
                                </label>
                                <input type="text" name="kode_produk" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300" placeholder="P001" required>
                            </div>
                            <div>
                                <label class="block mb-3 font-semibold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-box text-blue-600 w-5"></i>
                                    Nama Produk
                                </label>
                                <input type="text" name="nama_produk" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300" placeholder="Masukkan nama produk" required>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block mb-3 font-semibold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-align-left text-blue-600 w-5"></i>
                                Deskripsi Produk
                            </label>
                            <textarea name="deskripsi" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300" placeholder="Tulis deskripsi produk..." required></textarea>
                        </div>
                        <div class="mb-6">
                            <label class="block mb-3 font-semibold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-image text-green-600 w-5"></i>
                                Gambar Produk
                            </label>
                            <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300">
                            <p class="text-xs text-gray-500 mt-2">Format: jpg, jpeg, png, gif, webp</p>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block mb-3 font-semibold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-money-bill-wave text-green-600 w-5"></i>
                                    Harga (Rp)
                                </label>
                                <input type="number" name="harga" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300" placeholder="0" required>
                            </div>
                            <div>
                                <label class="block mb-3 font-semibold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-cubes text-orange-600 w-5"></i>
                                    Stok
                                </label>
                                <input type="number" name="stok" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300" placeholder="0" required>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block mb-3 font-semibold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-tags text-purple-600 w-5"></i>
                                Kategori
                            </label>
                            <select name="id_kategori" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300" required>
                                <option value="">- Pilih Kategori -</option>
                                <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nama_kategori']); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <button type="submit" name="simpan" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg hover:from-blue-700 hover:to-blue-800 font-semibold transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-save"></i>
                            Simpan Produk
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
