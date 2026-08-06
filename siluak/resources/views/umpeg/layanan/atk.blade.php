<div id="modalATK" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center p-4 z-50 hidden" style="font-family: 'Inter', sans-serif;">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-auto overflow-hidden animate-fade-in-up">
    <!-- header modal -->
        <div class="bg-dinas-blue px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white">Formulir Permohonan Alat Tulis Kantor (ATK)</h2>
            <button id="closeATKBtn" class="text-white hover:text-gray-200 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="p-6 max-h-[85vh] overflow-y-auto">
            <form action="{{ route('layanan.store', 'atk') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- identitas/isian form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="nama" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">NIP *</label>
                        <input type="number" name="nip" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Bidang *</label>
                        <select name="bidang" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm" required>
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
                        <label class="block text-sm font-bold text-gray-700 mb-0">Nota Dinas (Maks 1MB) *</label>
                        <input type="file" name="foto" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" accept="image/*" required onchange="validateFileSize(this, 1)">
                        <small class="text-gray-500">Format: JPG, PNG</small>
                    </div>
                </div>

                <hr class="mb-6">

                <!-- daftar barang -->
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-md font-bold text-gray-800">Daftar Barang yang Diminta</h3>
                        <button type="button" id="addAtkRowBtn" class="flex items-center gap-1 text-sm bg-dinas-blue text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Barang
                        </button>
                    </div>

                    <div id="atkItemContainer" class="space-y-4">
                        <div class="item-row grid grid-cols-1 md:grid-cols-10 gap-4 p-4 border rounded-lg bg-gray-50 items-end shadow-sm">
                            <div class="md:col-span-4">
                                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Pilih Barang *</label>
                                <select name="items[0][nama_barang]" class="w-full px-3 py-2 border rounded-md text-sm focus:ring-blue-500" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach($daftarBarangGudang as $barang)
                                        <option value="{{ $barang->nama_barang }}">
                                            {{ $barang->nama_barang }} (Sisa: {{ $barang->stok }} {{ $barang->satuan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Jumlah *</label>
                                <input type="number" name="items[0][jumlah]" min="1" class="w-full px-3 py-2 border rounded-md text-sm" placeholder="0" required>
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Satuan *</label>
                                <select name="items[0][satuan]" class="w-full px-3 py-2 border rounded-md text-sm" required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="Rim">Rim</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Lusin">Lusin</option>
                                    <option value="Pack">Pack</option>
                                    <option value="Unit">Unit</option>
                                </select>
                            </div>
                            <div class="md:col-span-1 flex justify-center pb-2">
                                <button type="button" class="remove-row text-red-400 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- aksi -->
                <div class="flex items-center gap-3 mt-4 pt-6 border-t border-gray-100">
                    <button type="submit" class="flex-1 py-3 bg-dinas-blue text-white font-bold rounded-lg hover:bg-blue-700 transition-all shadow-md active:transform active:scale-95">
                        Kirim Permohonan
                    </button>
                    <button type="button" id="batalATKBtn" class="py-3 px-8 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- js -->
<script>
    function validateFileSize(input, maxSizeMB) {
        const file = input.files[0];
        if (file && file.size > maxSizeMB * 1024 * 1024) {
            alert(`Ukuran file maksimal adalah ${maxSizeMB}MB`);
            input.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modalATK');
        const openBtns = document.querySelectorAll('#btnDaftarATK');
        const closeBtn = document.getElementById('closeATKBtn');
        const batalBtn = document.getElementById('batalATKBtn');
        const addAtkRowBtn = document.getElementById('addAtkRowBtn');
        const atkItemContainer = document.getElementById('atkItemContainer');

        // Menyiapkan opsi barang dinamis untuk baris baru
        const barangOptions = `
            <option value="">Pilih Barang</option>
            @foreach($daftarBarangGudang as $barang)
                <option value="{{ $barang->nama_barang }}">
                    {{ $barang->nama_barang }} (Sisa: {{ $barang->stok }} {{ $barang->satuan }})
                </option>
            @endforeach
        `;

        let rowCount = 1;

        const createRow = (index) => `
            <div class="item-row grid grid-cols-1 md:grid-cols-10 gap-4 p-4 border rounded-lg bg-gray-50 items-end shadow-sm animate-fade-in-down">
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Pilih Barang *</label>
                    <select name="items[${index}][nama_barang]" class="w-full px-3 py-2 border rounded-md text-sm focus:ring-blue-500" required>
                        ${barangOptions}
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Jumlah *</label>
                    <input type="number" name="items[${index}][jumlah]" min="1" class="w-full px-3 py-2 border rounded-md text-sm" placeholder="0" required>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Satuan *</label>
                    <select name="items[${index}][satuan]" class="w-full px-3 py-2 border rounded-md text-sm" required>
                        <option value="">Pilih Satuan</option>
                        <option value="Rim">Rim</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Lusin">Lusin</option>
                        <option value="Pack">Pack</option>
                        <option value="Unit">Unit</option>
                    </select>
                </div>
                <div class="md:col-span-1 flex justify-center pb-2">
                    <button type="button" class="remove-row text-red-400 hover:text-red-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
        `;

        addAtkRowBtn.addEventListener('click', () => {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = createRow(rowCount);
            atkItemContainer.appendChild(tempDiv.firstElementChild);
            rowCount++;
        });

        atkItemContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-row')) {
                const rows = atkItemContainer.querySelectorAll('.item-row');
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
            document.body.style.overflow = show ? 'hidden' : 'auto';
        };

        openBtns.forEach(btn => btn.addEventListener('click', () => toggleModal(true)));
        [closeBtn, batalBtn].forEach(btn => btn.addEventListener('click', () => toggleModal(false)));
        
        modal.addEventListener('click', (e) => {
            if (e.target === modal) toggleModal(false);
        });
    });
</script>