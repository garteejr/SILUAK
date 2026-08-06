<div id="modalKerusakanAlat" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center p-4 z-50 hidden" style="font-family: 'Inter', sans-serif;">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-auto overflow-hidden animate-fade-in-up">
        
        <div class="bg-dinas-blue px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white">Formulir Pelaporan Kerusakan Peralatan Kantor</h2>
            <button id="closeAlatBtn" class="text-white hover:text-gray-200 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="p-6 max-h-[80vh] overflow-y-auto">
            <form action="{{ route('layanan.store', 'alat') }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="Menunggu">
                <input type="hidden" name="prioritas" value="Belum Diatur">

                <!-- isian form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap Pelapor *</label>
                        <input type="text" name="nama" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Bidang *</label>
                        <select name="bidang" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Bidang</option>
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
                        <label class="block text-sm font-bold text-gray-700 mb-1">Jenis Peralatan *</label>
                        <select name="jenis_alat" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Jenis Peralatan</option>
                            <option value="Komputer">Komputer</option>
                            <option value="Laptop">Laptop</option>
                            <option value="Printer">Printer</option>
                            <option value="Lainnya (Tulis di Nama Barang)">Lainnya (Tulis di Nama Barang)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Barang (Merk, Type) *</label>
                        <input type="text" name="nama_alat" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: Printer HP Lasetjet P1102" required>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-0">Deskripsi Kerusakan *</label>
                        <textarea name="kerusakan" rows="2" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Jelaskan secara singkat" required></textarea>
                    </div>
                </div>  

                <!-- aksi -->
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit" class="flex-1 py-2.5 bg-dinas-blue text-white font-medium rounded-md hover:bg-blue-700">Kirim Permohonan</button>
                    <button type="button" id="batalAlatBtn" class="py-2.5 px-6 border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- js -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modalKerusakanAlat');
        const openBtns = document.querySelectorAll('#btnLaporAlat'); 
        const closeBtn = document.getElementById('closeAlatBtn');
        const batalBtn = document.getElementById('batalAlatBtn');

        const toggleModal = (show) => {
            modal.classList.toggle('hidden', !show);
            modal.classList.toggle('flex', show);
        };

        openBtns.forEach(btn => btn.addEventListener('click', () => toggleModal(true)));
        closeBtn.addEventListener('click', () => toggleModal(false));
        batalBtn.addEventListener('click', () => toggleModal(false));
    });
</script>