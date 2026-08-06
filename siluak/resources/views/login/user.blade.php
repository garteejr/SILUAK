<!-- ini ngk jd dipake huft -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Pengguna | UMPEG</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="font-sans bg-gray-50 text-slate-900">
    <div class="relative flex min-h-screen w-full flex-col">
        <div class="flex flex-1 items-center justify-center px-4 py-20">
            <div class="flex w-full max-w-[480px] flex-col items-center rounded-xl bg-white p-8 shadow-sm border border-gray-100 sm:p-12">
                
                <div class="w-16 h-16 bg-blue-50 text-dinas-blue rounded-full flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-3xl">lock</span>
                </div>

                <h1 class="text-gray-900 text-3xl font-extrabold text-center mb-2">
                    Masuk Pengguna
                </h1>
                <p class="text-gray-500 text-sm text-center mb-8">
                    Silakan masukkan kredensial Anda untuk mengakses layanan.
                </p>

                @if(session('success'))
                    <div class="w-full mb-6 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="w-full space-y-5" action="{{ route('login.post.user') }}" method="POST">
                    @csrf 
                    
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700" for="email">Email / NIP</label>
                        <div class="relative group">
                            <input class="w-full h-12 px-4 rounded-lg bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-dinas-blue/20 focus:border-dinas-blue transition-all" 
                                   id="email" 
                                   name="email" 
                                   type="text" 
                                   placeholder="nama@email.com" 
                                   value="{{ old('email') }}" 
                                   required autofocus />
                            
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                <span class="material-symbols-outlined text-[20px]">person</span>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-semibold text-gray-700" for="password">Kata Sandi</label>
                            <a class="text-xs font-medium text-dinas-blue hover:underline" href="#">
                                Lupa Password?
                            </a>
                        </div>
                        <div class="relative group">
                            <input class="w-full h-12 px-4 pr-12 rounded-lg bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-dinas-blue/20 focus:border-dinas-blue transition-all" 
                                   id="password" 
                                   name="password" 
                                   type="password" 
                                   placeholder="Masukkan kata sandi" 
                                   required />
                            
                            <button type="button" onclick="togglePassword()" class="absolute right-0 top-0 h-full px-4 text-gray-400 hover:text-dinas-blue transition-colors flex items-center justify-center focus:outline-none">
                                <span class="material-symbols-outlined text-[20px]" id="eyeIcon">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="w-full h-12 bg-dinas-blue hover:bg-blue-700 text-white font-bold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-center gap-2 mt-4" type="submit">
                        <span>Masuk</span>
                        <span class="material-symbols-outlined text-[20px]">login</span>
                    </button>
                </form>

                <div class="relative w-full py-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-100"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="bg-white px-2 text-gray-400 uppercase tracking-widest">Atau</span>
                    </div>
                </div>

                <p class="text-gray-500 text-sm text-center">
                    Belum punya akun?  
                    <a href="{{ route('register') }}" class="font-bold text-dinas-blue underline hover:text-dinas-dark">
                        Daftar sebagai Pengguna
                    </a>
                </p>

                <a href="{{ route('login.role') }}" class="mt-8 text-xs text-gray-400 hover:text-dinas-blue transition-colors italic">
                    ← Kembali ke Pilihan Akses
                </a>
            </div>
        </div>
    </div>

    <footer class="py-6 text-center border-t border-slate-100 bg-white">
        <div class="max-w-[1200px] mx-auto px-6 flex flex-col items-center justify-center gap-2">
            <p class="text-xs text-slate-500 font-medium">
                © {{ date('Y') }} Dinas Kearsipan dan Perpustakaan Provinsi Jawa Tengah
            </p>
        </div>
    </footer>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerText = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerText = 'visibility';
            }
        }
    </script>
</body>
</html>