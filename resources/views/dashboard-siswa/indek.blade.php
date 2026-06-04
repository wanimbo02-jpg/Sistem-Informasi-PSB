<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
        }
        .logout-btn {
            background: linear-gradient(135deg, #ff4d4d, #cc0000);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }
        .logout-btn:hover {
            background: linear-gradient(135deg, #cc0000, #990000);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(204, 0, 0, 0.3);
        }
    </style>
    <style>
/* Custom animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
}

@keyframes bounce-slow {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

.group:hover .group-hover\:animate-bounce-slow {
    animation: bounce-slow 1s ease-in-out infinite;
}

@keyframes spin-slow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin-slow {
    animation: spin-slow 3s linear infinite;
}

@keyframes pulse-slow {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.9;
        transform: scale(1.02);
    }
}

.animate-pulse-slow {
    animation: pulse-slow 2s ease-in-out infinite;
}

/* Hover effect for icons */
.group:hover .fa-edit,
.group:hover .fa-upload {
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% {
        transform: rotate(0deg);
    }
    25% {
        transform: rotate(10deg);
    }
    75% {
        transform: rotate(-10deg);
    }
}

/* Smooth transitions for all elements */
* {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}
</style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 bg-white h-full fixed left-0 top-0 p-6">
            <!-- Logo Sekolah (SMA N KARUBAGA) -->
            <!-- <div class="flex justify-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-center text-xs leading-tight">
                        SMA<br>N KARUBAGA
                    </span>
                </div>
            </div> -->
            
            <!-- Profile Info di Sidebar -->
 <!-- Profile Info di Sidebar - Tampilan card modern -->
<div class="mb-8">
    <!-- Icon biru di atas -->
    <div class="flex justify-center mb-4">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
            <i class="fas fa-user-graduate text-white text-2xl"></i>
        </div>
    </div>
    
    <!-- Info dalam bentuk card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-4 py-3 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
            <h3 class="text-xs font-semibold text-blue-700 uppercase tracking-wider">Identitas Siswa</h3>
        </div>
        
        <div class="p-4 space-y-3">
            <!-- Baris Nama -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-user text-blue-500 text-xs w-4"></i>
                    <span class="text-xs text-gray-500">Nama</span>
                </div>
                <span class="text-sm font-medium text-gray-800">{{ $user->name ?? $user->nama_lengkap ?? 'Manu Yikwa' }}</span>
            </div>
            
            <!-- Baris NIM/NISN/NIK -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-id-card text-blue-500 text-xs w-4"></i>
                    <span class="text-xs text-gray-500">NISN</span>
                </div>
                <span class="text-sm font-medium text-gray-800">{{ $user->nik ?? $user->nim ?? $user->nisn ?? '10033966' }}</span>
            </div>
            
            <!-- Baris Status -->
            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                <div class="flex items-center gap-2">
                    <i class="fas fa-graduation-cap text-blue-500 text-xs w-4"></i>
                    <span class="text-xs text-gray-500">Status</span>
                </div>
                <span class="inline-flex items-center bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                    <i class="fas fa-check-circle mr-1 text-green-500"></i>Calon Siswa
                </span>
            </div>
        </div>
    </div>
</div>
            
            <!-- Menu Utama -->
            <div class="mb-6">
                <p class="text-xs font-semibold text-gray-400 mb-4">MENU UTAMA</p>
                <div class="bg-blue-50 text-blue-600 p-3 rounded-xl flex items-center gap-3">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="font-medium">Dashboard</span>
                </div>
            </div>

            <!-- Menu Tambahan -->
            <div class="mb-6">
                <p class="text-xs font-semibold text-gray-400 mb-4">MENU SELEKSI</p>
                
                <!-- Seleksi Administrasi -->
                <a href="?page=seleksi-administrasi" class="block mb-3 group">
                    <div class="bg-white border border-gray-200 hover:border-teal-300 hover:bg-teal-50 p-3 rounded-xl flex items-center gap-3 transition-all duration-300">
                        <div class="bg-teal-100 rounded-lg p-2 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-file-earmark-text text-teal-600"></i>
                        </div>
                        <div class="flex-1">
                            <span class="font-medium text-gray-700 group-hover:text-teal-600 transition-colors duration-300">Seleksi Administrasi</span>
                            <p class="text-xs text-gray-500">Lihat status seleksi</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-teal-600 transition-colors duration-300"></i>
                    </div>
                </a>

                <!-- Pengumuman -->
                <a href="?page=pengumuman" class="block mb-3 group">
                    <div class="bg-white border border-gray-200 hover:border-amber-300 hover:bg-amber-50 p-3 rounded-xl flex items-center gap-3 transition-all duration-300">
                        <div class="bg-amber-100 rounded-lg p-2 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-bullhorn text-amber-600"></i>
                        </div>
                        <div class="flex-1">
                            <span class="font-medium text-gray-700 group-hover:text-amber-600 transition-colors duration-300">Pengumuman</span>
                            <p class="text-xs text-gray-500">Info terbaru</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-amber-600 transition-colors duration-300"></i>
                    </div>
                </a>
            </div>
        </div>


        
        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Navbar (HAPUS NAMA USER) -->
            <nav class="bg-white shadow-sm border-b sticky top-0 z-10">
                <div class="flex justify-end items-center h-16 px-8">
                    <div class="flex items-center space-x-4">
                        <!-- NAMA USER DIHAPUS -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <div class="p-8">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @php
                    $currentPage = request()->get('page', 'dashboard');
                @endphp

                @if($currentPage == 'seleksi-administrasi')
                    <!-- Konten Seleksi Administrasi -->
                    <div class="bg-white rounded-2xl shadow-sm p-8 mb-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-teal-100 rounded-xl p-3">
                                <i class="fas fa-file-earmark-text text-teal-600 text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Tahap 1 Seleksi Administrasi</h2>
                                <p class="text-gray-600">Status seleksi administrasi Anda</p>
                            </div>
                        </div>
                        
                        @if($seleksiAdminSiswa)
                            <!-- Menampilkan hasil seleksi administrasi tahap 1 -->
                            <div class="bg-teal-50 border-l-4 border-teal-400 p-6 rounded-r-lg mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-file-earmark-text text-teal-400 text-xl"></i>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <h4 class="text-lg font-medium text-teal-800 mb-2">{{ $seleksiAdminSiswa->judul }}</h4>
                                        <div class="text-sm text-teal-700 whitespace-pre-line mb-3">{{ $seleksiAdminSiswa->isi }}</div>
                                        <div class="text-xs text-teal-600">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ \Carbon\Carbon::parse($seleksiAdminSiswa->created_at)->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Default: Sedang Diproses -->
                            <div class="bg-teal-50 border-2 border-teal-200 p-6 rounded-xl text-center">
                                <div class="bg-teal-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-clock text-teal-600 text-3xl"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-teal-800 mb-2">Sedang Diproses</h3>
                                <p class="text-teal-700">Dokumen administrasi Anda sedang dalam proses verifikasi.</p>
                                <p class="text-sm text-teal-600 mt-2">Silakan periksa kembali secara berkala.</p>
                            </div>
                        @endif
                         <div class="mb-5">
                            <!-- <a href="?page=dashboard" class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                <i class="fas fa-arrow-left"></i>
                                <span>Back</span>
                            </a> -->
                        </div>
                         <!-- Tombol Back -->
                    <div class="mt-6">
                     <a href="?page=dashboard" 
                  class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg transition-all duration-200 border border-gray-200 hover:border-indigo-300 shadow-sm hover:shadow">
              <i class="fas fa-arrow-left text-sm"></i>
            <span class="font-medium">Kembali</span>
             </a>
               </div>
                @elseif($currentPage == 'pengumuman')
                    <!-- Konten Pengumuman -->
                    <div class="bg-white rounded-2xl shadow-sm p-8 mb-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-amber-100 rounded-xl p-3">
                                <i class="fas fa-bullhorn text-amber-600 text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Tahap 2 Hasil Pengumuman Final</h2>
                                <p class="text-gray-600">Informasi final terbaru sekolah SMAN Karubaga </p>
                            </div>
                        </div>
                        
                        @if($pengumumanSiswa)
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-6 rounded-r-lg mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <h4 class="text-lg font-medium text-blue-800 mb-2">{{ $pengumumanSiswa->judul }}</h4>
                                    <div class="text-sm text-blue-700 whitespace-pre-line mb-3">{{ $pengumumanSiswa->isi }}</div>
                                    <div class="text-xs text-blue-600">
                                        <i class="far fa-clock mr-1"></i>
                                        {{ \Carbon\Carbon::parse($pengumumanSiswa->created_at)->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-amber-50 border-2 border-amber-200 p-6 rounded-xl text-center">
                            <div class="bg-amber-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-megaphone text-amber-600 text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-amber-800 mb-2">Belum Ada Pengumuman</h3>
                            <p class="text-amber-700">Belum ada pengumuman terbaru dari sekolah.</p>
                            <p class="text-sm text-amber-600 mt-2">Silakan periksa kembali secara berkala.</p>
                        </div>
                         <div class="mb-5">
                            <!-- <a href="?page=dashboard" class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                <i class="fas fa-arrow-left"></i>
                                <span>Back</span>
                            </a> -->
                        </div>
                    @endif
                     <!-- Tombol Back -->
                    <div class="mt-6">
                     <a href="?page=dashboard" 
                  class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg transition-all duration-200 border border-gray-200 hover:border-indigo-300 shadow-sm hover:shadow">
              <i class="fas fa-arrow-left text-sm"></i>
            <span class="font-medium">Kembali</span>
             </a>
               </div>
                @else
                    <!-- Welcome Card -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-2xl p-8 mb-6 text-white shadow-lg">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <i class="fas fa-hand-peace text-3xl"></i>
                                    <h2 class="text-3xl font-bold">Halo, {{ $user->name ?? $user->nama_lengkap ?? 'Manu Yikwa' }}!</h2>
                                </div>
                                <p class="text-blue-100 text-lg mb-2">Selamat Datang di Portal Pendaftaran siswa Baru SMAN karubaga</p>
                                <p class="text-blue-100">Anda dapat mendaftar pada program yang tersedia atau melihat riwayat pendaftaran Anda di bawah ini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Alert / Lengkap Data Terlebih Dahulu -->
                    <div class="bg-yellow-50 border-2 border-yellow-200 p-4 mb-6 rounded-xl">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 rounded-full p-2 mr-3">
                                <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-yellow-800">Lengkap Data Terlebih Dahulu</p>
                                <p class="text-sm text-yellow-700">
                                    Silakan lengkap Data Pribadi dan Data Orang Tua untuk melanjutkan pendaftaran.
                                </p>
                            </div>
                        </div>
                    </div>

                   <!-- Progress Section -->
              <div class="bg-white rounded-2xl shadow-sm p-8 mb-6 border border-gray-100">
            <h3 class="text-xl font-bold mb-2">Lengkap Data Pendaftaran</h3>
           <p class="text-gray-600 mb-6">Untuk melanjutkan proses pendaftaran, lengkap data berikut:</p>
        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-2">
             <span class="text-2xl font-bold text-blue-600">{{ $progress ?? 0 }}/2</span>
              <span class="text-gray-500">langkah selesai</span>
               </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full" style="width: {{ $progress_percent ?? 0 }}%"></div>
            </div>
         </div>
        <!-- Data Pribadi Card - Tidak bisa diklik jika sudah diisi -->
        @if(isset($data_pribadi) && $data_pribadi)
        <div class="block mb-4 animate-fade-in-up" style="animation-delay: 0.1s; cursor: not-allowed;">
            <div class="border-2 border-green-200 bg-green-50 rounded-xl p-6 transition-all duration-300 relative overflow-hidden opacity-90">
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 rounded-xl p-4 shadow-lg">
                            <i class="fas fa-user text-green-600 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1 text-green-700">Data Pribadi</h4>
                            <p class="text-gray-500 text-sm">Informasi pribadi seperti nama, alamat, dan kontak</p>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm flex items-center gap-1 border border-green-200">
                        <i class="fas fa-check-circle"></i> Sudah diisi
                    </span>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-green-600"></div>
            </div>
        </div>
        @else
        <a href="{{ route('siswa.data-pribadi.index') }}" class="block mb-4 group animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="border-2 border-gray-200 hover:border-blue-300 rounded-xl p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 rounded-xl p-4 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 group-hover:bg-blue-200 shadow-lg group-hover:shadow-blue-200/50">
                            <i class="fas fa-user text-blue-600 text-2xl group-hover:animate-bounce-slow"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1 group-hover:text-blue-600 transition-colors duration-300">Data Pribadi</h4>
                            <p class="text-gray-500 text-sm group-hover:text-gray-700 transition-colors duration-300">Informasi pribadi seperti nama, alamat, dan kontak</p>
                        </div>
                    </div>
                    <div class="bg-blue-600 text-white px-6 py-3 rounded-xl flex items-center gap-2 hover:bg-blue-700 transition-all duration-300 shadow-md hover:shadow-xl group-hover:scale-105 relative overflow-hidden">
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        <i class="fas fa-edit group-hover:rotate-12 transition-transform duration-300"></i>
                        <span class="font-medium relative">Lengkapi Data</span>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
            </div>
        </a>
        @endif
        <!-- Data Orang Tua Card - Tidak bisa diklik jika sudah diisi -->
        @if(isset($data_ortu) && $data_ortu)
        <div class="block mb-4 animate-fade-in-up" style="animation-delay: 0.2s; cursor: not-allowed;">
            <div class="border-2 border-green-200 bg-green-50 rounded-xl p-6 transition-all duration-300 relative overflow-hidden opacity-90">
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 rounded-xl p-4 shadow-lg">
                            <i class="fas fa-users text-green-600 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1 text-green-700">Data Orang Tua</h4>
                            <p class="text-gray-500 text-sm">Informasi tentang orang tua/wali</p>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm flex items-center gap-1 border border-green-200">
                        <i class="fas fa-check-circle"></i> Sudah diisi
                    </span>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-green-600"></div>
            </div>
        </div>
        @else
        <a href="{{ route('siswa.data-ortu.index') }}" class="block mb-4 group animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="border-2 border-gray-200 hover:border-blue-300 rounded-xl p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 rounded-xl p-4 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 group-hover:bg-purple-100 shadow-lg group-hover:shadow-purple-200/50">
                            <i class="fas fa-users text-blue-600 text-2xl group-hover:animate-bounce-slow group-hover:text-purple-600 transition-colors duration-300"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1 group-hover:text-purple-600 transition-colors duration-300">Data Orang Tua</h4>
                            <p class="text-gray-500 text-sm group-hover:text-gray-700 transition-colors duration-300">Informasi tentang orang tua/wali</p>
                        </div>
                    </div>
                    <div class="bg-blue-600 text-white px-6 py-3 rounded-xl flex items-center gap-2 hover:bg-blue-700 transition-all duration-300 shadow-md hover:shadow-xl group-hover:scale-105 relative overflow-hidden">
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        <i class="fas fa-edit group-hover:rotate-12 transition-transform duration-300"></i>
                        <span class="font-medium relative">Lengkapi Data</span>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-purple-400 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
            </div>
        </a>
        @endif
        <!-- Upload Berkas Card - Tidak bisa diklik jika sudah diupload -->
        @if(isset($berkas) && $berkas)
        <div class="block mb-4 animate-fade-in-up" style="animation-delay: 0.3s; cursor: not-allowed;">
            <div class="border-2 border-green-200 bg-green-50 rounded-xl p-6 transition-all duration-300 relative overflow-hidden opacity-90">
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 rounded-xl p-4 shadow-lg">
                            <i class="fas fa-cloud-upload-alt text-green-600 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1 text-green-700">Upload Berkas</h4>
                            <p class="text-gray-500 text-sm">Upload KK, Ijazah, Rapor dan dokumen lainnya</p>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm flex items-center gap-1 border border-green-200">
                        <i class="fas fa-check-circle"></i> Sudah diupload
                    </span>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-green-600"></div>
            </div>
        </div>
        @else
        <a href="{{ route('siswa.berkas.index') }}" class="block mb-4 group animate-fade-in-up" style="animation-delay: 0.3s;">
            <div class="border-2 border-gray-200 hover:border-blue-300 rounded-xl p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 rounded-xl p-4 group-hover:scale-110 group-hover:-rotate-3 transition-all duration-300 group-hover:bg-orange-100 shadow-lg group-hover:shadow-orange-200/50">
                            <i class="fas fa-cloud-upload-alt text-blue-600 text-2xl group-hover:animate-bounce-slow group-hover:text-orange-600 transition-colors duration-300"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1 group-hover:text-orange-600 transition-colors duration-300">Upload Berkas</h4>
                            <p class="text-gray-500 text-sm group-hover:text-gray-700 transition-colors duration-300">Upload KK, Ijazah, Rapor dan dokumen lainnya</p>
                        </div>
                    </div>
                    <div class="bg-blue-600 text-white px-6 py-3 rounded-xl flex items-center gap-2 hover:bg-blue-700 transition-all duration-300 shadow-md hover:shadow-xl group-hover:scale-105 relative overflow-hidden">
                        <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        <i class="fas fa-upload group-hover:translate-y-[-2px] transition-transform duration-300"></i>
                        <span class="font-medium relative">Upload Berkas</span>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-orange-400 to-orange-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
            </div>
        </a>
        @endif

          <p class="text-sm text-gray-500 mt-4 bg-blue-50 p-3 rounded-lg">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
            Setelah melengkapi semua data di atas, Anda dapat melanjutkan ke proses pendaftaran berikutnya.
           </p>
        </div>

        <!-- Riwayat Pendaftaran -->
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
            <h3 class="text-xl font-bold mb-6">Riwayat Pendaftaran Anda</h3>
            <div class="text-center py-12 bg-gray-50 rounded-xl">
                <div class="bg-gray-200 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-history text-3xl text-gray-500"></i>
                </div>
                <p class="text-gray-600 text-lg mb-2">Belum ada riwayat pendaftaran</p>
                <p class="text-gray-400">Lengkapi data diri untuk memulai pendaftaran</p>
            </div>
        </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>