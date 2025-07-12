<?= $this->extend('staff/components/layout') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white/10 border border-white/20 rounded-xl p-8 mb-6">
            <h1 class="text-3xl font-bold text-white mb-2">
                <?= isset($loan) ? 'Edit Status Peminjaman' : 'Tambah Peminjaman' ?>
            </h1>
        </div>

        <div class="bg-white/10 border border-white/20 rounded-xl p-8">
            <form action="/staff/loan/store" method="post" class="space-y-6">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($loan['id'] ?? '') ?>">

                <?php if (!isset($loan)): ?>
                    <!-- Tampil saat TAMBAH -->
                    <div>
                        <label class="text-white mb-2 block">Buku</label>
                        <select name="book_id" required class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                            <option value="">-- Pilih Buku --</option>
                            <?php foreach ($books as $book): ?>
                                <option value="<?= $book['id'] ?>" <?= old('book_id') == $book['id'] ? 'selected' : '' ?>>
                                    <?= $book['title'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-white mb-2 block">Member</label>
                        <select name="member_id" required class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                            <option value="">-- Pilih Member --</option>
                            <?php foreach ($members as $member): ?>
                                <option value="<?= $member['id'] ?>" <?= old('member_id') == $member['id'] ? 'selected' : '' ?>>
                                    <?= $member['username'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-white mb-2 block">Tanggal Pinjam</label>
                        <input type="date" name="loan_date" value="<?= esc(old('loan_date', date('Y-m-d'))) ?>" required class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                    </div>

                    <div>
                        <label class="text-white mb-2 block">Tanggal Jatuh Tempo</label>
                        <input type="date" name="due_date" value="<?= esc(old('due_date')) ?>" required class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                    </div>
                <?php endif; ?>

                <!-- Field Tanggal Kembali selalu tersedia tapi dikontrol lewat JS -->
                <div id="return-date-field" style="<?= (isset($loan) && $loan['status'] == '2') ? '' : 'display: none;' ?>">
                    <label class="text-white mb-2 block">Tanggal Kembali</label>
                    <input type="date" name="return_date" id="return_date"
                        value="<?= esc(old('return_date', $loan['return_date'] ?? '')) ?>"
                        class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                </div>

                <!-- Status -->
                <div>
                    <label class="text-white mb-2 block">Status</label>

                    <?php if (isset($loan) && $loan['status'] == '2'): ?>
                        <!-- Status sudah Dikembalikan, tidak bisa diedit -->
                        <input type="hidden" name="status" value="2">
                        <p class="w-full px-4 py-3 rounded-lg bg-white/10 text-green-400 font-semibold">Dikembalikan</p>
                    <?php else: ?>
                        <?php if (!isset($loan)): ?>
                            <!-- Saat CREATE - hanya status Dipinjam -->
                            <input type="hidden" name="status" value="1">
                            <p class="w-full px-4 py-3 rounded-lg bg-white/10 text-blue-400 font-semibold">Dipinjam</p>
                        <?php else: ?>
                            <!-- Saat EDIT - tampilkan semua status -->
                            <select name="status" id="status" required class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                                <option value="0" <?= isset($loan) && $loan['status'] == '0' ? 'selected' : '' ?>>Pending</option>
                                <option value="1" <?= isset($loan) && $loan['status'] == '1' ? 'selected' : '' ?>>Dipinjam</option>
                                <option value="2" <?= isset($loan) && $loan['status'] == '2' ? 'selected' : '' ?>>Dikembalikan</option>
                            </select>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="pt-6 border-t border-white/20 flex justify-end gap-4">
                    <a href="/staff/loan" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700">Batal</a>
                    <button type="submit" class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700">
                        <?= isset($loan) ? 'Perbarui Status' : 'Simpan' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSelect = document.querySelector('select[name="status"]');
        const statusInput = document.querySelector('input[name="status"]');
        const returnDateField = document.getElementById('return-date-field');
        const returnDateInput = document.getElementById('return_date');

        function toggleReturnDateField() {
            if (!returnDateField || !returnDateInput) return;
            
            let statusValue = '';
            if (statusSelect) {
                statusValue = statusSelect.value;
            } else if (statusInput) {
                statusValue = statusInput.value;
            }

            if (statusValue === '2') {
                returnDateField.style.display = 'block';
                
                // Set tanggal hari ini jika kosong
                if (!returnDateInput.value) {
                    const today = new Date().toISOString().split('T')[0];
                    returnDateInput.value = today;
                }
            } else {
                returnDateField.style.display = 'none';
                returnDateInput.value = '';
            }
        }

        // Jalankan saat halaman dimuat
        toggleReturnDateField();
        
        // Tambahkan event listener untuk perubahan status
        if (statusSelect) {
            statusSelect.addEventListener('change', toggleReturnDateField);
        }
    });
</script>

<?= $this->endSection() ?>