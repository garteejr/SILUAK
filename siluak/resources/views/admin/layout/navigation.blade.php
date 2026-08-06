<aside class="w-64 h-full hidden lg:flex flex-col border-r border-slate-200 dark:border-slate-800 bg-surface-light dark:bg-background-dark z-20">
    <div class="flex flex-col border-b border-slate-200 dark:border-slate-800">
        <div class="px-4 pb-6">
            <div class="flex items-center gap-3 p-4 rounded-lg bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50">
                <!-- icon -->
                <div class="flex items-center justify-center rounded-full size-10 shrink-0 bg-white border border-slate-200 text-slate-500 dark:bg-slate-700 dark:border-slate-600 dark:text-slate-300">
                    <span class="material-symbols-outlined text-[24px]">person</span>
                </div>
                <div class="flex flex-col overflow-hidden">
                    <p class="text-sm font-bold text-slate-900 dark:text-white truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <!-- <p class="text-[10px] text-slate-500 truncate uppercase tracking-wider font-semibold">
                        Administrator
                    </p> -->
                </div>
            </div>
        </div>
    </div>
    
    <nav class="flex-1 overflow-y-auto py-4 px-3 flex flex-col gap-1">
        {{-- Menu Dashboard --}}
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-primary transition-colors' }}"
            href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'fill-1' : '' }}">dashboard</span>
            <span class="text-sm font-medium">Dashboard</span>
        </a>

        {{-- Menu Kebutuhan BMD --}}
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.bmd*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-primary transition-colors' }}"
            href="{{ route('admin.bmd') }}">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.bmd*') ? 'fill-1' : '' }}">inventory_2</span>
            <span class="text-sm font-medium">Kebutuhan BMD</span>
        </a>

        {{-- Dropdown Laporan --}}
        <details class="group {{ request()->routeIs('admin.laporan.*') ? 'open' : '' }}">
            <summary class="flex items-center justify-between w-full gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.laporan.*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-primary transition-colors' }} cursor-pointer select-none">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.laporan.*') ? 'fill-1' : '' }}">assignment</span>
                    <span class="text-sm font-medium">Laporan</span>
                </div>
                <span class="material-symbols-outlined text-[20px] transition-transform group-open:rotate-180">expand_more</span>
            </summary>
            <div class="flex flex-col gap-1 pl-11 mt-1">
                <a class="py-1.5 text-sm font-medium {{ request()->routeIs('admin.laporan.peralatan') ? 'text-primary' : 'text-slate-500 hover:text-primary' }} transition-colors block"
                    href="{{ route('admin.laporan.peralatan') }}">Kerusakan Peralatan</a>
                <a class="py-1.5 text-sm font-medium {{ request()->routeIs('admin.laporan.gedung') ? 'text-primary' : 'text-slate-500 hover:text-primary' }} transition-colors block"
                    href="{{ route('admin.laporan.gedung') }}">Kerusakan Gedung</a>
            </div>
        </details>

        {{-- Dropdown Peminjaman --}}
        <details class="group {{ request()->routeIs('admin.peminjaman.*') ? 'open' : '' }}">
            <summary class="flex items-center justify-between w-full gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.peminjaman.*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-primary transition-colors' }} cursor-pointer select-none">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.peminjaman.*') ? 'fill-1' : '' }}">calendar_month</span>
                    <span class="text-sm font-medium">Peminjaman</span>
                </div>
                <span class="material-symbols-outlined text-[20px] transition-transform group-open:rotate-180">expand_more</span>
            </summary>
            <div class="flex flex-col gap-1 pl-11 mt-1">
                <a class="py-1.5 text-sm font-medium {{ request()->routeIs('admin.peminjaman.kendaraan') ? 'text-primary' : 'text-slate-500 hover:text-primary' }} transition-colors block"
                    href="{{ route('admin.peminjaman.kendaraan') }}">Kendaraan Dinas</a>
                <a class="py-1.5 text-sm font-medium {{ request()->routeIs('admin.peminjaman.ruang') ? 'text-primary' : 'text-slate-500 hover:text-primary' }} transition-colors block"
                    href="{{ route('admin.peminjaman.ruang') }}">Ruangan Rapat</a>
            </div>
        </details>

        {{-- Menu Program atk --}}
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.atk*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-primary transition-colors' }}"
            href="{{ route('admin.atk.atk') }}">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.atk*') ? 'fill-1' : '' }}">school</span>
            <span class="text-sm font-medium">Permohonan ATK</span>
        </a>
        {{-- Menu Manajemen Stok --}}
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.manajemen*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-primary transition-colors' }}"
            href="{{ route('admin.manajemen') }}">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.manajemen*') ? 'fill-1' : '' }}">inventory</span>
            <span class="text-sm font-medium">Manajemen Stok</span>
        </a>

        {{-- BAGIAN MENU LAYANAN DINAMIS (KOREKSI DISINI) --}}
        @php
            $menusDinamis = \App\Models\Menu::where('is_active', true)->get();
        @endphp

        @foreach($menusDinamis as $menu)
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->is('admin/layanan/' . $menu->slug) ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-primary transition-colors' }}"
            href="/admin/layanan/{{ $menu->slug }}">
            <span class="material-symbols-outlined {{ request()->is('admin/layanan/' . $menu->slug) ? 'fill-1' : '' }}">
                {{ $menu->icon }}
            </span>
            <span class="text-sm font-medium">{{ $menu->nama_layanan }}</span>
        </a>
        @endforeach
    </nav>

    <div class="p-4 border-t border-slate-200 dark:border-slate-800 mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 transition-colors group">
                <span class="material-symbols-outlined group-hover:text-red-600 transition-colors">logout</span>
                <span class="text-sm font-medium">Keluar</span>
            </button>
        </form>
    </div>
</aside>