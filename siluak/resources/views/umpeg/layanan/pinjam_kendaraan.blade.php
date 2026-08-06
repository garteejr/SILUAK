<div id="modalPinjamKendaraan" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center p-4 z-50 hidden" style="font-family: 'Inter', sans-serif;">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-auto overflow-hidden animate-fade-in-up">
        <div class="bg-dinas-blue px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white">Formulir Peminjaman Kendaraan Dinas</h2>
            <button id="closeKendaraanBtn" class="text-white hover:text-gray-200 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6 max-h-[80vh] overflow-y-auto">
            <form action="{{ route('layanan.store', 'kendaraan') }}" method="POST">
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
                        <label class="block text-sm font-bold text-gray-700 mb-1">Jenis Kendaraan *</label>
                        <select name="jenis_kendaraan" class="w-full px-3 py-2 border rounded-md">
                            <option>Pilih Kendaraan</option>
                            <option value="Mobil">Mobil</option>
                            <option value="Motor">Motor</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tujuan Kabupaten/Kota *</label>
                        <input type="text" name="tujuan" class="w-full px-3 py-2 border rounded-md" placeholder="Contoh: Kabupaten Semarang" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Kegiatan *</label>
                        <input type="text" name="kegiatan" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Pinjam *</label>
                        <input type="date" name="tgl_pinjam" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Kembali *</label>
                        <input type="date" name="tgl_kembali" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                </div>
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit" class="flex-1 py-2.5 bg-dinas-blue text-white font-medium rounded-md hover:bg-blue-700">Kirim Permohonan</button>
                    <button type="button" id="batalKendaraanBtn" class="py-2.5 px-6 border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- js -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modalPinjamKendaraan');
        const openBtns = document.querySelectorAll('#btnPinjamKendaraan'); 
        const closeBtn = document.getElementById('closeKendaraanBtn');
        const batalBtn = document.getElementById('batalKendaraanBtn');

        const toggleModal = (show) => {
            modal.classList.toggle('hidden', !show);
            modal.classList.toggle('flex', show);
        };

        openBtns.forEach(btn => btn.addEventListener('click', () => toggleModal(true)));
        closeBtn.addEventListener('click', () => toggleModal(false));
        batalBtn.addEventListener('click', () => toggleModal(false));
    });
</script>