<?php
/**
* NIM   : 2357401007
* Nama  : Yusuf Hidayat 
* Kelas : MI23 
*/
?>

<?php
$active = basename($_SERVER['PHP_SELF']);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<aside class="bg-gradient-to-b from-blue-800 to-blue-900 text-white w-64 min-h-screen flex flex-col shadow-xl">
    <div class="p-6 border-b border-blue-700 bg-blue-900 bg-opacity-50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <i class="fas fa-chart-line text-blue-800 text-lg"></i>
            </div>
            <div>
                <div class="font-bold text-lg">Admin Panel</div>
                <div class="text-xs text-blue-200">Management System</div>
            </div>
        </div>
    </div>
    <nav class="flex-1 p-4 space-y-1">
        <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?php echo $active=='dashboard.php'?'bg-white text-blue-800 shadow-md font-semibold':'text-blue-100 hover:bg-blue-700 hover:text-white'; ?>">
            <i class="fas fa-home w-5"></i>
            <span>Dashboard</span>
        </a>
        <a href="kategori.php" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?php echo $active=='kategori.php'?'bg-white text-blue-800 shadow-md font-semibold':'text-blue-100 hover:bg-blue-700 hover:text-white'; ?>">
            <i class="fas fa-tags w-5"></i>
            <span>Kategori</span>
        </a>
        <a href="produk.php" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?php if(isset($activePage) && $activePage=='produk') echo 'bg-white text-blue-800 shadow-md font-semibold'; else echo 'text-blue-100 hover:bg-blue-700 hover:text-white'; ?>">
            <i class="fas fa-box w-5"></i>
            <span>Manajemen Produk</span>
        </a>
        <a href="user.php" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?php if(isset($activePage) && $activePage=='user') echo 'bg-white text-blue-800 shadow-md font-semibold'; else echo 'text-blue-100 hover:bg-blue-700 hover:text-white'; ?>">
            <i class="fas fa-users w-5"></i>
            <span>Kelola User</span>
        </a>
    </nav>
    <div class="p-4 border-t border-blue-700">
        <a href="logout.php" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-all duration-200 font-semibold shadow-md">
            <i class="fas fa-sign-out-alt w-5"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
