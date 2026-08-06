<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    
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
                
                <img src="https://th.bing.com/th/id/R.8840ace401ae601232e049dc178a26ae?rik=py3yHoYWpQkx1A&riu=http%3a%2f%2f2.bp.blogspot.com%2f-wMek_NSYupM%2fUCZUw0mU2PI%2fAAAAAAAAAAU%2fmN_07OlaSFo%2fs1600%2flogo-propinsi-jawa-tengah.jpg&ehk=9An%2bmUenuelNyFvomNMYXQ9ySakzbi%2f%2f5Q3szXP1dYY%3d&risl=&pid=ImgRaw&r=0" alt="Logo" class="h-24 w-auto">

                <h1 class="text-gray-900 text-3xl font-extrabold text-center pb-2 mt-4">
                    Masuk Admin
                </h1>

                <!-- <p class="text-gray-500 text-sm text-center mb-8">
                    Akses panel kontrol sistem.
                </p> -->

                @if($errors->any())
                    <div class="w-full mb-6 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm font-medium text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="w-full space-y-5" action="{{ route('login.post.admin') }}" method="POST">
                    @csrf 
                    
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700" for="email">Username atau Email</label>
                        <div class="relative group">
                            <input class="w-full h-12 px-4 rounded-lg bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all" 
                                   id="email" 
                                   name="email" 
                                   type="text" 
                                   placeholder="Masukkan email admin" 
                                   value="{{ old('email') }}" 
                                   required autofocus />
                            
                            <!-- <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                <span class="material-symbols-outlined text-[20px]">admin_panel_settings</span>
                            </div> -->
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-semibold text-gray-700" for="password">Kata Sandi</label>
                        </div>
                        <div class="relative group">
                            <input class="w-full h-12 px-4 pr-12 rounded-lg bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all" 
                                   id="password" 
                                   name="password" 
                                   type="password" 
                                   placeholder="Masukkan kata sandi" 
                                   required />
                            <button type="button" onclick="togglePassword()" class="absolute right-0 top-0 h-full px-4 text-gray-400 hover:text-blue-600 transition-colors flex items-center justify-center focus:outline-none">
                                <span class="material-symbols-outlined text-[20px]" id="eyeIcon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <button class="w-full h-12 bg-dinas-blue hover:bg-dinas-dark text-white font-bold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-center gap-2 mt-4" type="submit">
                        <span>Masuk</span>
                        <!-- <span class="material-symbols-outlined text-[20px]">dashboard</span> -->
                    </button>
                </form>
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