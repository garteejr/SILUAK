@if(session('success'))
    <div id="alert-success" class="fixed top-5 left-1/2 -translate-x-1/2 z-[9999] w-full max-w-md animate-in fade-in slide-in-from-top-4 duration-300">
        <div class="mx-4 bg-emerald-500 text-white p-4 rounded-2xl shadow-2xl shadow-emerald-500/30 flex items-center justify-between border border-emerald-400">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-xl">
                    <span class="material-symbols-outlined text-2xl font-bold">check_circle</span>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-black tracking-widest opacity-80 leading-none mb-1">Berhasil</p>
                    <p class="font-bold text-sm">{{ session('success') }}</p>
                </div>
            </div>
            <button onclick="document.getElementById('alert-success').remove()" class="hover:bg-white/10 p-1 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>
    </div>

    <script>
        // Menghilangkan alert otomatis setelah 4 detik
        setTimeout(() => {
            const alert = document.getElementById('alert-success');
            if(alert) {
                alert.style.transition = "all 0.5s ease";
                alert.style.opacity = "0";
                alert.style.transform = "translate(-50%, -20px)";
                setTimeout(() => alert.remove(), 500);
            }
        }, 4000);
    </script>
@endif

<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&amp;family=Noto+Sans:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: false,
            theme: {
                extend: {
                    colors: {
                        "primary": "#2566A8",
                        "background-light": "#f3f4f6",
                        "background-dark": "#020617",
                        "surface-light": "#ffffff",
                        "surface-dark": "#0f172a", 
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem", 
                        "lg": "0.5rem", 
                        "xl": "0.75rem", 
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        details > summary {
            list-style: none;
        }
        details > summary::-webkit-details-marker {
            display: none;
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-200 antialiased overflow-hidden h-screen flex">
    
    @yield('navigation')

    <div class="flex-1 flex flex-col h-full overflow-hidden relative">

        <header class="flex items-center justify-between px-6 py-3 bg-surface-light dark:bg-background-dark border-b border-slate-200 dark:border-slate-800 z-10 shrink-0">
            <div class="flex items-center gap-4 lg:hidden">
                <button class="text-slate-500 dark:text-slate-400">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
            <div class="flex-1 max-w-xl ml-4 lg:ml-0">
                <form action="{{ route('admin.search') }}" method="GET" class="relative group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400 group-focus-within:text-primary transition-colors">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input name="q" class="block w-full pl-10 pr-3 py-2 border-none rounded-lg leading-5 bg-slate-100 dark:bg-surface-dark text-slate-900 dark:text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/50 sm:text-sm transition-all" placeholder="Cari layanan, atau laporan..." type="text" value="{{ request('q') }}"/>
                </form>
            </div>
        </header>
        
        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-4 md:p-8">
            <div class="max-w-7xl mx-auto space-y-6">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>