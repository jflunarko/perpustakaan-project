<?= $this->extend('staff/components/layout') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white/10 border border-white/20 rounded-xl p-8 mb-6">
            <h1 class="text-3xl font-bold text-white mb-2">
                <?= isset($loan) ? 'Edit Peminjaman' : 'Tambah Peminjaman' ?>
            </h1>
        </div>

        <div class="bg-white/10 border border-white/20 rounded-xl p-8">
            <form action="/staff/loan/store" method="post" class="space-y-6">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($loan['id'] ?? '') ?>">

                <div>
                    <label class="text-white mb-2 block">Buku</label>
                    <select name="book_id" required class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                        <option value="">-- Pilih Buku --</option>
                        <?php foreach ($books as $book): ?>
                            <option value="<?= $book['id'] ?>" <?= isset($loan) && $loan['book_id'] == $book['id'] ? 'selected' : '' ?>>
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
                            <option value="<?= $member['id'] ?>" <?= isset($loan) && $loan['member_id'] == $member['id'] ? 'selected' : '' ?>>
                                <?= $member['username'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div>
                    <label class="text-white mb-2 block">Tanggal Pinjam</label>
                    <input type="date" name="loan_date" value="<?= esc($loan['loan_date'] ?? date('Y-m-d')) ?>" required class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                </div>

                <div>
                    <label class="text-white mb-2 block">Tanggal Jatuh Tempo</label>
                    <input type="date" name="due_date" value="<?= esc($loan['due_date'] ?? '') ?>" required class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                </div>

                <div>
                    <label class="text-white mb-2 block">Tanggal Kembali</label>
                    <input type="date" name="return_date" value="<?= esc($loan['return_date'] ?? '') ?>" class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                </div>

                <div>
                    <label class="text-white mb-2 block">Status</label>
                    <select name="status" required class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                        <option value="1" <?= isset($loan) && $loan['status'] == '1' ? 'selected' : '' ?>>Dipinjam</option>
                        <option value="2" <?= isset($loan) && $loan['status'] == '2' ? 'selected' : '' ?>>Dikembalikan</option>
                    </select>
                </div>

                <div class="pt-6 border-t border-white/20 flex justify-end gap-4">
                    <a href="/staff/loan" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700">Batal</a>
                    <button type="submit" class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700">
                        <?= isset($loan) ? 'Perbarui' : 'Simpan' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
