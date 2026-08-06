<div id="modalPinjamRuangan" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center p-4 z-50 hidden" style="font-family: 'Inter', sans-serif;">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-auto overflow-hidden animate-fade-in-up">
        <div class="bg-dinas-blue px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white">Formulir Peminjaman Ruangan Rapat</h2>
            <button id="closeRuanganBtn" class="text-white hover:text-gray-200 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6 max-h-[80vh] overflow-y-auto">
            <form action="{{ route('layanan.store', 'ruangan') }}" method="POST">
                @csrf
                <!-- isian form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="nama" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">NIP *</label>
                        <input type="number" name="nip" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">No. Telepon/WA *</label>
                        <input type="tel" name="telepon" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Bidang *</label>
                        <select name="bidang" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option>Pilih Bidang</option>
                            <option value="Umum dan Kepegawaian (Sekretariat)">Umum dan Kepegawaian (Sekretariat)</option>
                            <option value="Keuangan (Sekretariat)">Keuangan (Sekretariat)</option>
                            <option value="Program (Sekretariat)">Program (Sekretariat)</option>
                            <option value="LPA">LPA</option>
                            <option value="PPA">PPA</option>
                            <option value="P3K">P3K</option>
                            <option value="Pengembangan Perpustakaan">Pengembangan Perpustakaan</option>
                            <option value="Pengelolaan Perpustakaan">Pengelolaan Perpustakaan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Daftar Ruang Rapat *</label>
                        <select name="ruangan" class="w-full px-3 py-2 border rounded-md">
                            <option>Pilih Ruang</option>
                            <option value="Ruang Rapat Lantai 1-Dinas Srondol">Ruang Rapat Lantai 1-Dinas Srondol</option>
                            <option value="Ruang Rapat Lantai 2-Dinas Srondol">Ruang Rapat Lantai 2-Dinas Srondol</option>
                            <option value="Ruang Rapat Lantai 4-Dinas Srondol">Ruang Rapat Lantai 4-Dinas Srondol</option>
                            <option value="Ruang Rapat Lantai 3-Perpustakaan">Ruang Rapat Lantai 3-Perpustakaan</option>
                            <option value="Ruang Rapat Lantai 4-Perpustakaan">Ruang Rapat Lantai 4-Perpustakaan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Pinjam *</label>
                        <input type="date" name="tanggal" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Waktu Mulai *</label>
                        <input type="time" name="waktu_mulai" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Waktu Selesai *</label>
                        <input type="time" name="waktu_selesai" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Acara *</label>
                        <input type="text" name="acara" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 mt-6">
                    <button type="submit" class="flex-1 py-2.5 bg-dinas-blue text-white font-medium rounded-md hover:bg-blue-700">Kirim Permohonan</button>
                    <button type="button" id="batalRuanganBtn" class="py-2.5 px-6 border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- js -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modalPinjamRuangan');
        const openBtns = document.querySelectorAll('#btnPinjamRuangan');
        const closeBtn = document.getElementById('closeRuanganBtn');
        const batalBtn = document.getElementById('batalRuanganBtn');

        const toggleModal = (show) => {
            modal.classList.toggle('hidden', !show);
            modal.classList.toggle('flex', show);
        };

        openBtns.forEach(btn => btn.addEventListener('click', () => toggleModal(true)));
        closeBtn.addEventListener('click', () => toggleModal(false));
        batalBtn.addEventListener('click', () => toggleModal(false));
    });
</script>