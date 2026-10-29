
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>{{ config('app.name', 'Perpustakaan') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen">

        {{-- SIDEBAR --}}
        <aside
            id="sidebar"
            class="fixed top-0 left-0 z-40 h-screen w-64 bg-gray-900 text-white transition-all duration-300 overflow-x-hidden">

            {{-- Logo --}}
            <div class="h-20 flex items-center px-5 border-b border-gray-700">
                <span class="text-2xl mr-3">📚</span>
                <span class="sidebar-text text-xl font-bold whitespace-nowrap">
                    Perpustakaan
                </span>
            </div>

            {{-- MENU --}}
            <nav class="mt-5 px-3 space-y-2">

                {{-- Dashboard --}}
                <a
                    href="{{ route('dashboard') }}"
                    title="Dashboard"
                    class="flex items-center px-4 py-3 rounded-lg
                    {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">

                    <span class="text-xl flex-shrink-0">▦</span>
                    <span class="sidebar-text ml-3 whitespace-nowrap">
                        Dashboard
                    </span>
                </a>

                {{-- Katalog Buku: admin dan anggota --}}
                <a
                    href="{{ route('books.index') }}"
                    title="Katalog Buku"
                    class="flex items-center px-4 py-3 rounded-lg
                    {{ request()->routeIs('books.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">

                    <span class="text-xl flex-shrink-0">📖</span>
                    <span class="sidebar-text ml-3 whitespace-nowrap">
                        {{ Auth::user()->role === 'admin' ? 'Manajemen Buku' : 'Katalog Buku' }}
                    </span>
                </a>

                {{-- Menu khusus admin --}}
                @if (Auth::user()->role === 'admin')

                    <a
                        href="{{ route('categories.index') }}"
                        title="Kategori"
                        class="flex items-center px-4 py-3 rounded-lg
                        {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">

                        <span class="text-xl flex-shrink-0">▤</span>
                        <span class="sidebar-text ml-3 whitespace-nowrap">
                            Kategori
                        </span>
                    </a>

                @endif

                {{-- Peminjaman --}}
                <a
                    href="{{ route('loans.index') }}"
                    title="Peminjaman"
                    class="flex items-center px-4 py-3 rounded-lg
                    {{ request()->routeIs('loans.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">

                    <span class="text-xl flex-shrink-0">⇄</span>
                    <span class="sidebar-text ml-3 whitespace-nowrap">
                        {{ Auth::user()->role === 'admin' ? 'Manajemen Peminjaman' : 'Peminjaman Saya' }}
                    </span>
                </a>

            </nav>

            {{-- INFORMASI PENGGUNA --}}
            <div class="absolute bottom-0 left-0 w-full border-t border-gray-700 p-4">

                <div class="flex items-center">
                    <span class="text-xl flex-shrink-0">👤</span>

                    <div class="sidebar-text ml-3 overflow-hidden">
                        <p class="text-sm font-semibold truncate">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-gray-400 truncate">
                            {{ Auth::user()->email }}
                        </p>

                        <p class="text-xs text-blue-300 mt-1">
                            {{ ucfirst(Auth::user()->role) }}
                        </p>
                    </div>
                </div>

                {{-- Profil --}}
                <a
                    href="{{ route('profile.edit') }}"
                    title="Profil"
                    class="flex items-center mt-4 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg px-2 py-2">

                    <span class="text-xl flex-shrink-0">⚙</span>
                    <span class="sidebar-text ml-3">Profil</span>
                </a>

                {{-- Keluar --}}
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf

                    <button
                        type="submit"
                        title="Keluar"
                        class="flex items-center text-sm text-red-300 hover:text-red-200 px-2 py-2">

                        <span class="text-xl flex-shrink-0">↪</span>
                        <span class="sidebar-text ml-3">Keluar</span>
                    </button>
                </form>

            </div>
        </aside>

        {{-- KONTEN UTAMA --}}
        <div
            id="main-content"
            class="min-h-screen ml-64 transition-all duration-300">

            {{-- HEADER --}}
            <header class="h-20 bg-white shadow-sm px-6 flex items-center gap-4">

                <button
                    type="button"
                    onclick="toggleSidebar()"
                    title="Ciutkan atau lebarkan menu"
                    class="p-2 rounded-md text-gray-600 hover:bg-gray-100">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>

                <h2 class="text-lg font-semibold text-gray-800">
                    @if (request()->routeIs('dashboard'))
                        Dashboard
                    @elseif (request()->routeIs('categories.*'))
                        Manajemen Kategori
                    @elseif (request()->routeIs('books.*'))
                        {{ Auth::user()->role === 'admin' ? 'Manajemen Buku' : 'Katalog Buku' }}
                    @elseif (request()->routeIs('loans.*'))
                        {{ Auth::user()->role === 'admin' ? 'Manajemen Peminjaman' : 'Peminjaman Saya' }}
                    @elseif (request()->routeIs('profile.*'))
                        Profil Saya
                    @else
                        Sistem Perpustakaan
                    @endif
                </h2>
            </header>

            {{-- KONTEN HALAMAN --}}
            <main class="p-6">
                {{ $slot }}
            </main>

        </div>
    </div>
        {{-- NOTIFIKASI SWEETALERT2 --}}
        <div
            id="sweetalert-notifications"
            data-success="{{ session('success') }}"
            data-error="{{ session('error') }}"
            data-warning="{{ session('warning') }}"
            hidden>
        </div>

        <script>
            document.querySelectorAll('.form-delete-book').forEach(function (form) {
                form.addEventListener('submit', async function (event) {
                    event.preventDefault();

                    const result = await Swal.fire({
                        title: 'Hapus buku?',
                        text: 'Data buku yang dihapus tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    });

                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
            </script>

                {{-- JAVASCRIPT SIDEBAR --}}
                <script>
                    function toggleSidebar() {
                        const sidebar = document.getElementById('sidebar');
                        const mainContent = document.getElementById('main-content');
                        const texts = document.querySelectorAll('.sidebar-text');

                        const isCollapsed = sidebar.classList.contains('w-20');

                        if (isCollapsed) {
                            sidebar.classList.remove('w-20');
                            sidebar.classList.add('w-64');

                            mainContent.classList.remove('ml-20');
                            mainContent.classList.add('ml-64');

                            texts.forEach(text => text.classList.remove('hidden'));
                        } else {
                            sidebar.classList.remove('w-64');
                            sidebar.classList.add('w-20');

                            mainContent.classList.remove('ml-64');
                            mainContent.classList.add('ml-20');

                            texts.forEach(text => text.classList.add('hidden'));
                        }
                    }
                </script>
                            <script>
                document.querySelectorAll('.form-delete-category').forEach(function (form) {
                    form.addEventListener('submit', async function (event) {
                        event.preventDefault();

                        const result = await Swal.fire({
                            title: 'Hapus kategori?',
                            text: 'Kategori yang dihapus tidak dapat dikembalikan!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc2626',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true
                        });

                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            </script>
            <script>
    // Konfirmasi pengembalian buku
    document.querySelectorAll('.form-return-loan').forEach(function (form) {
        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            const result = await Swal.fire({
                title: 'Kembalikan buku?',
                text: 'Pastikan buku sudah diterima kembali dari peminjam.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, kembalikan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            });

            if (result.isConfirmed) {
                form.submit();
            }
        });
        });

        // Konfirmasi hapus riwayat
        document.querySelectorAll('.form-delete-loan').forEach(function (form) {
            form.addEventListener('submit', async function (event) {
                event.preventDefault();

                const result = await Swal.fire({
                    title: 'Hapus riwayat peminjaman?',
                    text: 'Riwayat yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                });

                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
    </body>
</html>
