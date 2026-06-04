<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-600">Siswa</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 hidden sm:inline">{{ $user->name ?? $user->nama_lengkap }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-600 hover:text-red-600 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-full p-4">
                    <i class="fas fa-user-graduate text-white text-2xl"></i>
                </div>
                <div class="flex-1">
                    <span class="text-sm text-gray-500">Nomor Pendaftaran</span>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user->nomor_pendaftaran ?? 'Belum ada' }}</h2>
                    <p class="text-gray-600">{{ $user->name ?? $user->nama_lengkap }}</p>
                </div>
                <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">
                    <i class="fas fa-check-circle mr-1"></i>Calon Mahasiswa
                </span>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-100">
            <div class="flex items-center space-x-2 text-gray-600">
                <i class="fas fa-home text-blue-500"></i>
                <span class="font-medium">MENU UTAMA</span>
                <i class="fas fa-chevron-right text-sm text-gray-400"></i>
                <span class="text-blue-600 font-medium">Dashboard</span>
            </div>
        </div>

        <!-- Alert -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Silakan lengkapi Data Pribadi dan Data Orang Tua untuk melanjutkan pendaftaran.
                    </p>
                </div>
            </div>
        </div>

        <!-- Progress Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
            <h3 class="text-lg font-semibold mb-4">Lengkap Data Pendaftaran</h3>
            <p class="text-gray-600 mb-6">Untuk melanjutkan proses pendaftaran, lengkapi data berikut:</p>
            
            <!-- Progress Bar -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-2xl font-bold text-blue-600">{{ $progress }}/3</span>
                    <span class="text-gray-600">lengkap selesai</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress_percent }}%"></div>
                </div>
            </div>

            <!-- Data Pribadi Card -->
            <a href="{{ route('siswa.data-pribadi.index') }}" class="block mb-4 group">
                <div class="border-2 {{ $data_pribadi ? 'border-green-200 bg-green-50' : 'border-gray-200 hover:border-blue-300' }} rounded-xl p-5 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 rounded-full p-3 group-hover:scale-110 transition">
                                <i class="fas fa-user text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Data Pribadi</h4>
                                <p class="text-sm text-gray-600">Informasi pribadi seperti nama, alamat, dan kontak</p>
                                @if($data_pribadi)
                                    <span class="inline-flex items-center text-sm text-green-600 mt-1">
                                        <i class="fas fa-check-circle mr-1"></i>Sudah diisi
                                    </span>
                                @endif
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500 transition"></i>
                    </div>
                </div>
            </a>

            <!-- Data Orang Tua Card -->
            <a href="{{ route('siswa.data-ortu.index') }}" class="block mb-4 group">
                <div class="border-2 {{ $data_ortu ? 'border-green-200 bg-green-50' : 'border-gray-200 hover:border-blue-300' }} rounded-xl p-5 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 rounded-full p-3 group-hover:scale-110 transition">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Data Orang Tua</h4>
                                <p class="text-sm text-gray-600">Informasi tentang orang tua/wali</p>
                                @if($data_ortu)
                                    <span class="inline-flex items-center text-sm text-green-600 mt-1">
                                        <i class="fas fa-check-circle mr-1"></i>Sudah diisi
                                    </span>
                                @endif
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500 transition"></i>
                    </div>
                </div>
            </a>

            <!-- Penguploadan Berkas Card -->
            <a href="{{ route('siswa.berkas.index') }}" class="block mb-4 group">
                <div class="border-2 {{ $berkas ? 'border-green-200 bg-green-50' : 'border-gray-200 hover:border-blue-300' }} rounded-xl p-5 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 rounded-full p-3 group-hover:scale-110 transition">
                                <i class="fas fa-file-upload text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Penguploadan Berkas</h4>
                                <p class="text-sm text-gray-600">Upload berkas-berkas pendukung pendaftaran</p>
                                @if($berkas)
                                    <span class="inline-flex items-center text-sm text-green-600 mt-1">
                                        <i class="fas fa-check-circle mr-1"></i>Sudah diupload
                                    </span>
                                @endif
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500 transition"></i>
                    </div>
                </div>
            </a>

            <p class="text-sm text-gray-500 mt-4 bg-blue-50 p-3 rounded-lg">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                1. Setelah melengkapi semua data di atas, Anda dapat melanjutkan ke proses pendaftaran berikutnya.
            </p>
        </div>

        <!-- Pengumuman -->
        @if($pengumumanSiswa)
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 mb-6">
            <h3 class="text-lg font-semibold mb-4">
                <i class="fas fa-bullhorn text-blue-500 mr-2"></i>Pengumuman
            </h3>
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-lg font-medium text-blue-800 mb-2">{{ $pengumumanSiswa->judul }}</h4>
                        <div class="text-sm text-blue-700 whitespace-pre-line">{{ $pengumumanSiswa->isi }}</div>
                        <div class="text-xs text-blue-600 mt-2">
                            <i class="far fa-clock mr-1"></i>
                            {{ \Carbon\Carbon::parse($pengumumanSiswa->created_at)->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Riwayat Pendaftaran -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-lg font-semibold mb-4">Riwayat Pendaftaran Anda</h3>
            <div class="text-center py-12">
                <i class="fas fa-history text-6xl mb-4 text-gray-300"></i>
                <p class="text-gray-500 text-lg">Belum ada riwayat pendaftaran</p>
                <p class="text-gray-400 text-sm mt-2">Lengkapi data diri untuk memulai pendaftaran</p>
            </div>
        </div>
    </div>
</body>
</html>