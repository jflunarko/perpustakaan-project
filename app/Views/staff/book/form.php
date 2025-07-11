<?= $this->extend('staff/components/layout') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white/10 border border-white/20 rounded-xl p-8 mb-8">
            <h1 class="text-3xl text-white font-bold mb-2"><?= isset($book) ? 'Edit' : 'Tambah' ?> Buku</h1>
            <p class="text-white/70">Masukkan informasi buku dengan lengkap</p>
        </div>

        <div class="bg-white/10 border border-white/20 rounded-xl p-8">
            <form action="/staff/book/store" method="post" class="space-y-6">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($book['id'] ?? '') ?>">

                <!-- Judul -->
                <div>
                    <label class="text-white block mb-1">Judul Buku</label>
                    <input type="text" name="title" required
                        value="<?= esc($book['title'] ?? '') ?>"
                        class="w-full bg-white/10 text-white border border-white/20 rounded-lg px-4 py-3">
                </div>

                <!-- Penulis -->
                <div>
                    <label class="text-white block mb-1">Penulis</label>
                    <input type="text" name="author" required
                        value="<?= esc($book['author'] ?? '') ?>"
                        class="w-full bg-white/10 text-white border border-white/20 rounded-lg px-4 py-3">
                </div>

                <!-- Penerbit -->
                <div>
                    <label class="text-white block mb-1">Penerbit</label>
                    <input type="text" name="publisher" required
                        value="<?= esc($book['publisher'] ?? '') ?>"
                        class="w-full bg-white/10 text-white border border-white/20 rounded-lg px-4 py-3">
                </div>

                <!-- Tahun Terbit -->
                <div>
                    <label class="text-white block mb-1">Tahun Terbit</label>
                    <input type="number" name="year_published" required
                        value="<?= esc($book['year_published'] ?? '') ?>"
                        class="w-full bg-white/10 text-white border border-white/20 rounded-lg px-4 py-3">
                </div>

                <!-- Stok -->
                <div>
                    <label class="text-white block mb-1">Stok Buku</label>
                    <input type="number" name="stock" required
                        value="<?= esc($book['stock'] ?? 0) ?>"
                        class="w-full bg-white/10 text-white border border-white/20 rounded-lg px-4 py-3">
                </div>

                <!-- Kategori -->
                <div>
                    <label class="text-white block mb-1">Kategori</label>
                    <select name="book_category_id" required
                            class="w-full bg-white/10 text-white border border-white/20 rounded-lg px-4 py-3">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= isset($book['book_category_id']) && $book['book_category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                <?= esc($cat['name']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="text-white block mb-1">Status</label>
                    <select name="status" required class="w-full bg-white/10 text-white border border-white/20 rounded-lg px-4 py-3">
                        <option value="available" <?= ($book['status'] ?? '') == 'available' ? 'selected' : '' ?>>Tersedia</option>
                        <option value="unavailable" <?= ($book['status'] ?? '') == 'unavailable' ? 'selected' : '' ?>>Tidak Tersedia</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="pt-4 border-t border-white/20 flex justify-end space-x-3">
                    <a href="/staff/book" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Batal</a>
                    <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                        <?= isset($book) ? 'Perbarui' : 'Simpan' ?> Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
