<div id="requestModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center p-4 z-50 hidden" style="font-family: 'Inter', sans-serif;">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-auto overflow-hidden animate-fade-in-up">
        <div class="bg-dinas-blue px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white">Formulir Usulan Rencana Kebutuhan BMD</h2>
            <button id="closeModalBtn" class="text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- isian form -->
        <div class="p-6 max-h-[85vh] overflow-y-auto">
            <form id="requestForm" action="{{ route('layanan.store', 'bmd') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="nama" class="w-full px-3 py-2 border rounded-md text-sm focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border rounded-md text-sm focus:ring-blue-500" required>
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
                        <label class="block text-sm font-bold text-gray-700 mb-1">Kode Barang</label>
                        <input type="text" name="kode" class="w-full px-3 py-2 border rounded-md text-sm focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Program *</label>
                        <input type="text" name="program" class="w-full px-3 py-2 border rounded-md text-sm focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Kegiatan *</label>
                        <input type="text" name="kegiatan" class="w-full px-3 py-2 border rounded-md text-sm focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Output *</label>
                        <input type="text" name="output" class="w-full px-3 py-2 border rounded-md text-sm focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Keterangan *</label>
                        <textarea name="keterangan" rows="2" class="w-full px-3 py-2 border rounded-md" required></textarea>
                    </div>
                </div>

                <!-- ini garis -->
                <hr class="mb-6">

                <!-- daftar barang -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-md font-bold text-gray-800">Usulan Barang Milik Daerah (BMD)</h3>
                        <button type="button" id="addRowBtn" class="flex items-center gap-1 text-sm bg-dinas-blue text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Barang
                        </button>
                    </div>

                    <div id="itemContainer" class="space-y-4">
                        <div class="item-row grid grid-cols-1 md:grid-cols-10 gap-3 p-4 border rounded-lg bg-gray-50 items-end shadow-sm">
                            <div class="md:col-span-4">
                                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Nama Barang *</label>
                                <input type="text" name="items[0][nama_barang]" class="w-full px-3 py-2 border rounded-md text-sm" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Jumlah *</label>
                                <input type="number" name="items[0][jumlah]" min="1" class="w-full px-3 py-2 border rounded-md text-sm" required>
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Satuan *</label>
                                <select name="items[0][satuan]" class="w-full px-3 py-2 border rounded-md text-sm" required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="Rim">Rim</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Lusin">Lusin</option>
                                    <option value="Pak">Pak</option>
                                    <option value="Unit">Unit</option>
                                </select>
                            </div>
                            <div class="md:col-span-1 flex justify-center pb-2">
                                <button type="button" class="remove-row text-red-400 hover:text-red-600 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- aksi -->
                <div class="flex items-center gap-3 mt-8 pt-6 border-t">
                    <button type="submit" class="flex-1 py-3 bg-dinas-blue text-white font-bold rounded-lg hover:bg-blue-700 transition-all shadow-md">
                        Kirim Permohonan
                    </button>
                    <button type="button" id="cancelBtn" class="py-3 px-8 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('requestModal');
        const openModalBtns = document.querySelectorAll('#btnAjukanPermohonan'); 
        const closeBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const itemContainer = document.getElementById('itemContainer');
        const addRowBtn = document.getElementById('addRowBtn');
        let rowCount = 1;

        // Fungsi Tambah Baris
        addRowBtn.addEventListener('click', (e) => {
            e.preventDefault(); 
            e.stopImmediatePropagation();
            const newRow = document.createElement('div');
            newRow.className = 'item-row grid grid-cols-1 md:grid-cols-10 gap-3 p-4 border rounded-lg bg-gray-50 items-end shadow-sm animate-fade-in-down mt-4';
            newRow.innerHTML = `
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Nama Barang *</label>
                    <input type="text" name="items[${rowCount}][nama_barang]" class="w-full px-3 py-2 border rounded-md text-sm" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Jumlah *</label>
                    <input type="number" name="items[${rowCount}][jumlah]" min="1" class="w-full px-3 py-2 border rounded-md text-sm" required>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Satuan *</label>
                    <select name="items[${rowCount}][satuan]" class="w-full px-3 py-2 border rounded-md text-sm" required>
                        <option value="">Pilih Satuan</option>
                        <option value="Rim">Rim</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Lusin">Lusin</option>
                        <option value="Pak">Pak</option>
                        <option value="Unit">Unit</option>
                    </select>
                </div>
                <div class="md:col-span-1 flex justify-center pb-2">
                    <button type="button" class="remove-row text-red-400 hover:text-red-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            `;
            itemContainer.appendChild(newRow);
            rowCount++;
        });

        // Fungsi Hapus Baris
        itemContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-row')) {
                const rows = itemContainer.querySelectorAll('.item-row');
                if (rows.length > 1) {
                    e.target.closest('.item-row').remove();
                } else {
                    alert('Minimal harus ada satu barang yang diajukan.');
                }
            }
        });

        const toggleModal = (show) => {
            modal.classList.toggle('hidden', !show);
            modal.classList.toggle('flex', show);
        };

        if(openModalBtns) openModalBtns.forEach(btn => btn.addEventListener('click', () => toggleModal(true)));
        closeBtn.addEventListener('click', () => toggleModal(false));
        cancelBtn.addEventListener('click', () => toggleModal(false));
        modal.addEventListener('click', (e) => { if (e.target === modal) toggleModal(false); });
    });
</script>