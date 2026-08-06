<nav class="bg-white border-b border-gray-100 py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50 shadow-sm">
    <div class="flex items-center gap-4">
        <img src="https://th.bing.com/th/id/R.8840ace401ae601232e049dc178a26ae?rik=py3yHoYWpQkx1A&riu=http%3a%2f%2f2.bp.blogspot.com%2f-wMek_NSYupM%2fUCZUw0mU2PI%2fAAAAAAAAAAU%2fmN_07OlaSFo%2fs1600%2flogo-propinsi-jawa-tengah.jpg&ehk=9An%2bmUenuelNyFvomNMYXQ9ySakzbi%2f%2f5Q3szXP1dYY%3d&risl=&pid=ImgRaw&r=0" 
                alt="Logo" class="h-12 w-auto">
        <div class="leading-tight">
            <h1 class="font-bold text-lg text-gray-800">
                <a href="{{ url('/') }}" class="hover:text-blue-600 transition">Subbag Umum dan Kepegawaian</a>
            </h1>
            <p class="text-xs text-gray-500 font-medium">Dinas Kearsipan dan Perpustakaan Provinsi Jawa Tengah</p>
        </div>
    </div>

    <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
        <a href="{{ url('/') }}#layanan" class="hover:text-blue-600 transition">Layanan</a>    
        <a href="{{ url('/') }}#jadwal" class="hover:text-blue-600 transition">Jadwal</a>
        <div class="relative group h-full flex items-center">
            <button class="flex items-center gap-1 hover:text-blue-600 transition focus:outline-none py-2">
                <span class="material-symbols-outlined text-[14px] group-hover:transition-transform duration-300">
                    Laporan
                </span>
            </button>

            <div class="absolute right-0 top-full mt-0 w-64 bg-white border border-slate-200 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 overflow-hidden">
                <div class="py-1 flex flex-col">
                    <a href="{{ route('umpeg.laporan.bmd') }}" class="px-2 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        Rencana Kebutuhan BMD
                    </a>
                    <a href="{{ route('umpeg.laporan.kerusakan_alat') }}" class="px-2 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        Kerusakan Peralatan Kantor
                    </a>
                    <a href="{{ route('umpeg.laporan.kerusakan_gedung') }}" class="px-2 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        Kerusakan Gedung & Bangunan
                    </a>
                    <a href="{{ route('umpeg.laporan.pinjam_kendaraan') }}" class="px-2 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        Peminjaman Kendaraan Dinas
                    </a>
                    <a href="{{ route('umpeg.laporan.pinjam_ruangan') }}" class="px-2 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        Peminjaman Ruangan Rapat
                    </a>
                    <a href="{{ route('umpeg.laporan.atk') }}" class="px-2 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        Permohonan ATK
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>