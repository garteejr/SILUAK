@extends('admin.layout.master')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Manajemen Menu Layanan</h2>
    <a href="{{ route('admin.layanan.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg flex items-center gap-2">
        <span class="material-symbols-outlined">add</span> Tambah Layanan Baru
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-slate-200">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-3">Nama Layanan</th>
                <th class="px-6 py-3">Icon</th>
                <th class="px-6 py-3">Status di Sidebar</th>
                <th class="px-6 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr class="border-b border-slate-100">
                <td class="px-6 py-4 font-medium">{{ $menu->nama_layanan }}</td>
                <td class="px-6 py-4"><span class="material-symbols-outlined">{{ $menu->icon }}</span></td>
                <td class="px-6 py-4">
                    <span class="{{ $menu->is_active ? 'text-emerald-600 bg-emerald-50' : 'text-red-600 bg-red-50' }} px-3 py-1 rounded-full text-xs font-bold">
                        {{ $menu->is_active ? 'Ditampilkan' : 'Disembunyikan' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('admin.layanan.toggle', $menu->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="text-slate-400 hover:text-primary">
                            <span class="material-symbols-outlined">{{ $menu->is_active ? 'visibility_off' : 'visibility' }}</span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection