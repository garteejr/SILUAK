<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subbag Umum dan Kepegawaian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen">

    @include('umpeg.layout.header')

    <main class="flex-grow bg-gray-50">        
        @hasSection('page_title')
            <div class="px-8 pt-8">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">@yield('page_title')</h1>
                        <p class="text-slate-500 text-sm mt-1">@yield('page_subtitle')</p>
                    </div>
                    <div>
                        @yield('page_action')
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    @include('umpeg.layout.footer')
</body>
</html>